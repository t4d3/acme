<?php
if (!$_SESSION['loggedin'] || ($_SESSION['clientData']['clientLevel'] == 1)) {
    header("location: /acme");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACME - Add Category</title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav> 
        <main>
            <div id="addProduct">
                <h1>Welcome to ACME!</h1>
                <h2>Please add a category</h2>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="post" action="/acme/products/">
                    <input required type="text" placeholder="Category name" name="categoryname">
                    <button type="submit">Add Category!</button>
                    <input type="hidden" name="action" value="addCat">
                </form>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
