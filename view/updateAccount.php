<?php
if (!$_SESSION['loggedin']) {
    header("location: /acme");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>ACME - Update Account</title>
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
            <div id="login">
                <h1>Update Account</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                } elseif (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                ?>
                <form action="/acme/accounts/" method="post">
                    <h5>(All Fields are required)</h5>
                    <input type="text" required placeholder="First Name" name="firstName" 
                           id="firstName"  <?php
                if (isset($firstName)) {
                    echo "value='$firstName'";
                } elseif (isset($_SESSION['clientData']['clientFirstname'])) {
                    $firstName = $_SESSION['clientData']['clientFirstname'];
                    echo "value='$firstName'";
                }
                ?>><br>
                    <input type="text" required placeholder="Last Name" name="lastName" 
                           id="lastName"  <?php
                           if (isset($lastName)) {
                               echo "value='$lastName'";
                           } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                               $lastName = $_SESSION['clientData']['clientLastname'];
                               echo "value='$lastName'";
                           }
                ?>><br>
                    <input type="email" required placeholder="Email Address" name="email" 
                           id="email"  <?php
                           if (isset($email)) {
                               echo "value='$email'";
                           } elseif (isset($_SESSION['clientData']['clientEmail'])) {
                               $email = $_SESSION['clientData']['clientEmail'];
                               echo "value='$email'";
                           }
                ?>><br>
                    <button type="submit" >Update account</button>
                    <input type="hidden" name="action" value="updateAcc">
                    <input type="hidden" name="clientId" value="<?php
                           if (isset($_SESSION['clientData']['clientId'])) {
                               echo $_SESSION['clientData']['clientId'];
                           } elseif (isset($clientId)) {
                               echo $clientId;
                           }
                ?>">
                </form>
                <hr>
                <h1>Update Password</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/acme/accounts/" method="post">
                    <span>Passwords must be at least 8 characters and contain at least 1 number, capital letter, and special character</span>
                    <input type="password" required placeholder="NEW Password"
                           name="password"  id="password"
                           pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                    <button type="submit" >Update Password</button>
                    <input type="hidden" name="action" value="updatePass">
                </form>


            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
