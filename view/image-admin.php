<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACME - Image management</title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav> 
        <main>
            <h2>Add New Product Image</h2>
            <h4>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </h4>
            <form action="/acme/uploads/" method="post" enctype="multipart/form-data">
                <label for="invItem">Product</label><br>
                <?php echo $prodSelect; ?><br><br>
                <label>Upload Image:</label><br>
                <input type="file" name="file1"><br>
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>
            <hr>
            <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            }
            ?>

        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
<?php unset($_SESSION['message']); ?>
