<?php
if (!$_SESSION['loggedin']) {
    header("location: /acme");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACME - <?php
            if ($_SESSION['clientData']['clientLevel'] == 3) {
                echo 'Admin';
            } else {
                echo 'User';
            }
            ?></title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav> 
        <main>
            <h1>Account information</h1>
            <?php
            if (isset($message)) {
                echo "<h3>" . $message . "</h3>";
            } elseif (isset($_SESSION['message'])) {
                echo "<h3>" . $_SESSION['message'] . "</h3>";
            }
            ?>
            <?php
            echo 'Welcome ' . $_SESSION['clientData']['clientFirstname'];
            echo ' ' . $_SESSION['clientData']['clientLastname'];

            echo '<ul>';
            foreach ($_SESSION['clientData'] as $name => $item) {
                if (($name != 'clientPassword') && ($name != 'clientId') && ($name != 'clientLevel')) {
//              if (!($name == 'clientId') || ($name == 'clientLevel')) {
                    echo '<li>' . $name . ': ' . $item . '</li>';
                }
            }
            echo '</ul>';
            ?>
            <?php
            echo "<a href='/acme/accounts/?action=updateAccount' title='Update Account Information'>Update Account Information</a>";

            if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo '<hr><h2>Admin tools:</h2>';
                echo "<a href='/acme/products/?action=product-management' title='View the Acme Products page.'>Click here to manage products in the inventory!</a>";
            }
            ?>
            <?php echo $reviewList; ?>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
<?php unset($_SESSION['message']); ?>