<?php
if (!$_SESSION['loggedin']) {
    header("location: /acme");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Acme - Modify <?php echo $review['invName'] ?> Review</title>
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
            <div id="addCategory">
                <h1>Modify <?php echo $review['invName'] ?> Review</h1>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                } elseif (isset($message)) {
                    echo $message;
                }
                ?>
                <h3>Reviewed on <?php echo $review['reviewDate']; ?></h3>
                <form method="post" action="/acme/reviews/">
                    <input required type="text" placeholder="Review Message" name="reviewText" id="invSize" value="<?php echo $review['reviewText']; ?>">
                    <button type="submit">Modify Review!</button>
                    <input type="hidden" name="action" value="modifyReview">
                    <input type="hidden" name="reviewId" value="<?php echo $reviewId; ?>">
                </form>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
