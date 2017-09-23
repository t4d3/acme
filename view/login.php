<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACME - Login</title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <div id="login">
                <h1>Acme Login</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/acme/accounts/" method="post">
                    <h5>(All Fields are required)</h5>
                    <input type="email" required placeholder="Email Address" name="email" 
                           id="email"  <?php
                           if (isset($email)) {
                               echo "value='$email'";
                           }
                           ?>><br>
                    <span>Passwords must be at least 8 characters and contain at least 1 number, capital letter, and special character</span>
                    <input type="password" required placeholder="Password"
                           name="password"  id="password"
                           pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                    <button type="submit" >Login</button>
                    <input type="hidden" name="action" value="login">
                </form>
                <a href="/acme/accounts?action=Registration">Create Account</a>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
