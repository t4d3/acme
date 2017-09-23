<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function checkEmail($email) {
    $sanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $valEmail = filter_var($sanEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($password) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    return preg_match($pattern, $password);
}

function buildNav($categories) {
    $navList = '<ul>';
    $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category) {
        $navList .= "<li><a href='/acme/products/?action=category&type=$category[categoryName]' "
                . "title='View our $category[categoryName] product line'>$category[categoryName]</a>
</li>";
    }
    $navList .= '</ul>';
    return $navList;
}

function buildCatList($categories) {
    $catList = '<select name="categoryId" id="categoryId">';
    $catList .= " <option>Select a category</option>";
    foreach ($categories as $category) {
        $catList .= " <option value=$category[categoryId]";
        if (isset($categoryId)) {
            if ($category['categoryId'] === $categoryId) {
                $catList .= ' selected ';
            }
        }
        $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
    return $catList;
}

function buildProductsDisplay($products) {
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $pd .= "<li><a href='/acme/products/?action=productDetail&invId=$product[invId]'> ";
        $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
        $pd .= "<hr>";
        $pd .= "<h2>$product[invName]</h2></a>";
        $pd .= "<span>$$product[invPrice]</span>";
        $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}

function buildProductDetailDisplay($product) {
    $superCoolVariableName = "<h1 id='inventoryItemTitle'>$product[invName]</h1>";
    $superCoolVariableName .= "<section id=productDetail><img id='productImage' src='$product[invImage]' alt='Image of $product[invName] on Acme.com'>\n";
    $superCoolVariableName .= "<ul>\n";
    $superCoolVariableName .= "<li>$product[invDescription]</li>\n";
    $superCoolVariableName .= "<li><hr></li>\n";
    $superCoolVariableName .= "<li>Made by: $product[invVendor]</li>\n";
    $superCoolVariableName .= "<li>Primary material: $product[invStyle]</li>\n";
    $superCoolVariableName .= "<li>Weight: $product[invWeight]</li>\n";
    $superCoolVariableName .= "<li>product size: $product[invSize]</li>\n";
    $superCoolVariableName .= "<li>Ships from: $product[invLocation]</li>\n";
    $superCoolVariableName .= "<li>Product left in stock: $product[invStock]</li>\n";
    $superCoolVariableName .= "<li id=prodPrice> $$product[invPrice]</li>";
    $superCoolVariableName .= "</ul></section>\n";
    return $superCoolVariableName;
}

/* * *********************************
 * Functions for working with images
 * ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
        $id .= "<p><a href='/acme/uploads?action=delete&id=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

// Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invItem" id="invItem">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
// Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
// Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
// Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
// Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
// Moves the file to the target folder
        move_uploaded_file($source, $target);
// Send file for further processing
        processImage($image_dir_path, $filename);
// Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
// Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
// Set up the variables
    $dir = $dir . '/';

// Set up the image path
    $image_path = $dir . '/' . $filename;

// Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

// Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

// Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {

// Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

// Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    }

// Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

// Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

// If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

// Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

// Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

// Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

// Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

// Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
// Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
// Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
// Free any memory associated with the old image
    imagedestroy($old_image);
}

function buildThumbnails($prodThumbnails, $prodName) {
    $variable = "<hr><ul id='productThumbnails'>";
    foreach ($prodThumbnails as $thumbnail) {
        $variable .= "<li><img src='$thumbnail[imgPath]' alt='Image of $prodName on Acme.com'></li>";
    }
    $variable .= '</ul>';
    return $variable;
}

function buildReviewForm($product) {
    $htmlCode = "<hr>\n<section id=review>\n<h2>Leave your own review!</h2>\n";
    if (isset($_SESSION['message'])) {
        $htmlCode .= $_SESSION['message'];
    }
    $screenName = $_SESSION['clientData']['clientFirstname'][0] . $_SESSION['clientData']['clientLastname'];

    $htmlCode .= "<h3>Review the $product[invName]</h3>\n";
    $htmlCode .= "Screen name: " . $screenName . "<br>\nReview:\n"
            . "<form method='post' action='/acme/reviews/'>\n"
            . "<input required type='text' placeholder='Enter Review here' name='invReview' id='invReview'>\n"
            . "<button type='submit'>Add review!</button>\n"
            . "<input type='hidden' name='action' value='addReview'>\n"
            . "<input type='hidden' name='invId' value=$product[invId]>\n"
            . "</form>\n</section>";
    return $htmlCode;
}

function buildProductReviews($rawReviews) {
    $reviews = "<section id=productReviews><hr><h2>Product Reviews</h2><ul id=reviews>";
    foreach ($rawReviews as $currReview) {
        $date = date("M jS, Y", strtotime($currReview['reviewDate']));
        $screenName = $currReview['clientFirstname'][0] . $currReview['clientLastname'];
        $reviews .= "<li>"
                . "<section>"
                . "<h4>" . $screenName . " </h4> "
                . "<h5> (Writen on " . $date . ")</h5>"
                . "</section>"
                . "<article>" . $currReview['reviewText'] . "</article>\n"
                . "</li>";
    }
    $reviews .= "</ul></section>";
    return $reviews;
}

function buildClientReviews($clientReviews) {
    $reviewList = '<hr><h2>Your reviews</h2><table id=clientReviews>';
    foreach ($clientReviews as $currReview) {
        $reviewList .= "<tr>";
        $reviewList .= "<td><h4>$currReview[invName]</h4></td>";
        $reviewList .= "<td><h5>(Reviewed on " . $currReview['reviewDate'] . ")</h5></td>";
        $reviewList .= "<td><a href='/acme/reviews?action=modify&reviewId=$currReview[reviewId]' title='Click to modify'>Modify</a></td>";
        $reviewList .= "<td><a href='/acme/reviews?action=delete&reviewId=$currReview[reviewId]' title='Click to delete'>Delete</a></td>";
        $reviewList .= "</tr>";
    }
    $reviewList .= '</table>';
    return $reviewList;
}
