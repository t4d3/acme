<?php
if (!$_SESSION['loggedin']) {
    header("location: /acme");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Acme - Delete <?php echo $review['invName'] ?> Review</title>
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

                <h1>Delete <?php echo $review['invName'] ?> Review?</h1>
                <h2>This cannot be undone!</h2>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                Reviewed on
                <?php
                $date = date("M jS, Y", strtotime($review['reviewDate']));
                echo $date;
                ?>
                <form method="post" action="/acme/reviews/">
                    <input required readonly type="text" name="reviewText" value="<?php echo $review['reviewText']; ?>"><br>
                    <button type="submit">Delete Review!</button>
                    <input type="hidden" name="action" value="deleteReview">
                    <input type="hidden" name="reviewId" value="<?php echo $reviewId ?>">
                </form>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
