<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACME - 
            <?php
            if (isset($product['invName'])) {
                echo $product['invName'];
            } else {
                echo 'Product not found!';
            }
            ?>
        </title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav> 
        <main id="item-display">
            <?php echo $productInfo; ?>
            <?php echo $thumbnails; ?>
            <?php echo $customerReview; ?>
            <?php echo $reviews; ?>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
