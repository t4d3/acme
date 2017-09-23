<?php
if (!$_SESSION['loggedin'] || ($_SESSION['clientData']['clientLevel'] == 1)) {
    header("location: /acme");
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACME - Product Management</title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav> 
        <main>
            <h1>Product Management</h1>
            <h3>Welcome to Product Management.  Please chose an option.</h3>
            <ul>
                <li><a href="/acme/products/?action=add-category">Add a new category</a></li>            
                <li><a href="/acme/products/?action=add-product">Add a new product</a></li>            
            </ul>
            <?php
            if (isset($message)) {
                echo $message;
            }
            if (isset($invList)) {
                echo $invList;
            }
            ?>

        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
<?php unset($_SESSION['message']); ?>
