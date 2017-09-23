<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACM - Register</title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <div id="login" action="/acme/accounts/index.php">
                <h1>ACME Registration</h1>
                <h5>(All Fields are required)</h5>

                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="post" action="/acme/accounts/">
                    <input type="text"  required placeholder="First Name" name="firstname"
                           id="firstname" <?php
                           if (isset($firstname)) {
                               echo "value='$firstname'";
                           }
                           ?>><br>
                    <input type="text"  required placeholder="Last Name" name="lastname"
                           id="lastname" <?php
                           if (isset($lastname)) {
                               echo "value='$lastname'";
                           }
                           ?>><br>
                    <input type="email" required placeholder="Email Address" name="email" 
                           id="email"  <?php
                           if (isset($email)) {
                               echo "value='$email'";
                           }
                           ?>><br>
                    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
                    <input type="password" required placeholder="Password"
                           name="password"  id="password"
                           pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                    <button type="submit">Create Account</button>
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="Register">
                </form>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
