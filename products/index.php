<?php

// Create or access a Session
session_start();

require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../model/review-model.php';
require_once '../library/functions.php';

// Get the array of categories
$categories = getCategories();

// var_dump($categories);
// exit;
// Build a navigation bar using the $categories array
$navList = buildNav($categories);

// Build a navigation bar using the $categories array
// $catList = buildCatList($categories);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'product-management';
    }
}

switch ($action) {
    case 'product-management':
        $products = getProductBasics();
        if (count($products) > 0) {
            $invList = '<table>';
            $invList .= '<thead>';
            $invList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $invList .= '</thead>';
            $invList .= '<tbody>';
            foreach ($products as $product) {
                $invList .= "<tr><td>$product[invName]</td>";
                $invList .= "<td><a href='/acme/products?action=modify&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $invList .= "<td><a href='/acme/products?action=delete&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $invList .= '</tbody></table>';
        } else {
            $message = '<p class="notify">Sorry, no products were returned.</p>';
        }
        include '../view/product-management.php';
        break;
    case 'add-category':
        include '../view/add-category.php';
        break;
    case 'add-product':
        include '../view/add-product.php';
        break;
    case 'addCat':
        $categoryname = filter_input(INPUT_POST, 'categoryname');
        if (empty($categoryname)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-category.php';
            exit;
        }
        $insOutcome = insertCategory($categoryname);

        // Check and report the result
        if ($insOutcome === 1) {
//            $message = "<p>Thanks for adding $categoryname. I hope it worked!</p>";
            header('location: ./');
            exit;
        } else {
            $message = "<p>Sorry, but $categoryname was not added properly.  Please try agian.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'addPro':
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_VALIDATE_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_VALIDATE_FLOAT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) ||
                empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) ||
                empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-product.php';
            exit;
        }
        $insOutcome = insertProuduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

        // Check and report the result
        if ($insOutcome === 1) {
            $message = "<p>Thanks for adding $invName. I hope it worked!</p>";
            include '../view/add-product.php';
            exit;
        } else {
            $message = "<p>Sorry, but $invName was not added properly.  Please try agian.</p>";
            include '../view/add-product.php';
            exit;
        }
        break;
    case 'modify':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getProductInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/product-update.php';
        exit;
        break;
    case 'updateProd':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_VALIDATE_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_VALIDATE_FLOAT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        if (empty($invId) || empty($invName) || empty($categoryId) || empty($invDescription) || empty($invImage) || empty($invThumbnail) ||
                empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) ||
                empty($invLocation) || empty($invVendor) || empty($invStyle)) {
            $message = '<p>Please complete all information for the new item! Double check the category of the item.</p>';
            include '../view/product-update.php';
            exit;
        }
        $updateResult = updateProduct($invId, $invName, $categoryId, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);
        if ($updateResult) {
            $message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p>Error. $invName was not updated.</p>";
            include '../view/product-update.php';
            exit;
        }
        break;
    case 'delete':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getProductInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/product-delete.php';
        exit;
        break;
    case 'deleteProd':
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteProduct($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invName was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        break;
    case 'category':
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($type);
        if (!count($products)) {
            $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
        } else {
            $prodDisplay = buildProductsDisplay($products);
        }
        include '../view/category.php';
        break;

    case 'productDetail':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $product = getProductInfo($invId);
        if (isset($product['invName'])) {
            $productInfo = buildProductDetailDisplay($product);
        } else {
            $productInfo = "That product doesn't exist!";
        }
        $thumbnails;
        $prodThumbnails = getProThumbnails($invId);
        if (isset($prodThumbnails)) {
            $thumbnails = buildThumbnails($prodThumbnails, $product['invName']);
        }
        $customerReview = "";
        if (isset($_SESSION['loggedin'])) {
            $customerReview = buildReviewForm($product);
        }
        $rawReviews = getInvReviews($invId);
        $reviews = "";
        if (is_array($rawReviews)) {
            if (isset($rawReviews[0])) {
                $reviews = buildProductReviews($rawReviews);
            }
        }
        include '../view/product-detail.php';
        break;

    default :
        echo $action;
        include '../view/404.php';
        break;
}
