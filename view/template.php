<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACME - Template</title>
        <meta name="viewport" content="width=device-widtch">
        <link href="/acme/css/styles.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav> 
        <main>
            <h1>Welcome to ACME!</h1>
            <h2>This is a template!</h2>
         </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
