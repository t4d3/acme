<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acme - <?php echo $type; ?> Products</title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav> 
        <main id="prod-displayMain">
            <h1><?php echo $type; ?> Products</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <?php
            if (isset($prodDisplay)) {
                echo $prodDisplay;
            }
            ?>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
