<?php
if (!$_SESSION['loggedin'] || ($_SESSION['clientData']['clientLevel'] == 1)) {
    header("location: /acme");
}
?>
<?php
$catList = '<select name="categoryId" id="categoryId">';
$catList .= " <option>Select a category</option>";
foreach ($categories as $category) {
    $catList .= " <option value='$category[categoryId]'";
    if (isset($categoryId)) {
        if ($category['categoryId'] === $categoryId) {
            $catList .= ' selected ';
        }
    }
    $catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>ACME - Add Product</title>
        <meta name = "viewport" content = "width=device-widtch">
        <link href = "/acme/css/styles.css" rel = "stylesheet" type = "text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php';
        ?>
        <nav>
            <?php echo $navList; ?>
        </nav> 
        <main>   
            <div id="addCategory">

                <h1>Welcome to ACME!</h1>
                <h2>Please do the thing</h2>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="post" action="/acme/products/">
                    <?php echo $catList; ?><br>
                    <input required type="text" placeholder="Inventory Name" name="invName" id="invName" <?php
                    if (isset($invName)) {
                        echo "value='$invName'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Description" name="invDescription" id="invDescription" <?php
                    if (isset($invDescription)) {
                        echo "value='$invDescription'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Image" name="invImage" id="invImage" <?php
                    if (isset($invImage)) {
                        echo "value='$invImage'";
                    }
                    ?>value="/images/no-image/no-image.png" ><br>
                    <input required type="text" placeholder="Inventory Thumbnail" name="invThumbnail" id="invThumbnail" <?php
                    if (isset($invThumbnail)) {
                        echo "value='$invThumbnail'";
                    }
                    ?>value="/images/no-image/no-image.png" ><br>
                    <input required type="text" placeholder="Inventory Price" name="invPrice" id="invPrice" <?php
                    if (isset($invPrice)) {
                        echo "value='$invPrice'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Stock" name="invStock" id="invStock" <?php
                    if (isset($invStock)) {
                        echo "value='$invStock'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Size" name="invSize" id="invSize" <?php
                    if (isset($invSize)) {
                        echo "value='$invSize'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Weight" name="invWeight" id="invWeight" <?php
                    if (isset($invWeight)) {
                        echo "value='$invWeight'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Location" name="invLocation" id="invLocation" <?php
                    if (isset($invLocation)) {
                        echo "value='$invLocation'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Vendor" name="invVendor" id="invVendor" <?php
                    if (isset($invVendor)) {
                        echo "value='$invVendor'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Style" name="invStyle" id="invStyle" <?php
                           if (isset($invStyle)) {
                               echo "value='$invStyle'";
                           }
                           ?>><br>
                    <button type="submit">Add Item!</button>
                    <input type="hidden" name="action" value="addPro">
                </form>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
