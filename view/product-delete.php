<?php
if (!$_SESSION['loggedin'] || ($_SESSION['clientData']['clientLevel'] == 1)) {
    header("location: /acme");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Acme - <?php
            if (isset($invInfo['invName'])) {
                echo "Delete $invInfo[invName] ";
            } elseif (isset($invName)) {
                echo $invName;
            }
            ?></title>
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

                <h1>Delete <?php
                    if (isset($invInfo['invName'])) {
                        echo " $invInfo[invName] ";
                    } elseif (isset($invName)) {
                        echo $invName;
                    }
                    ?></h1>
                <h2><?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?></h2>
                <form method="post" action="/acme/products/">
                    <input required readonly type="text" placeholder="Inventory Name" name="invName" id="invName" <?php
                    if (isset($invName)) {
                        echo "value='$invName'";
                    } elseif (isset($invInfo['invName'])) {
                        echo "value='$invInfo[invName]'";
                    }
                    ?>><br>
                    <input readonly type="text" placeholder="Inventory Description" name="invDescription" id="invDescription" <?php
                           if (isset($invDescription)) {
                               echo "value='$invDescription'";
                           } elseif (isset($invInfo['invDescription'])) {
                               echo "value='$invInfo[invDescription]'";
                           }
                           ?>><br>
                    <button type="submit">Delete Item!</button>
                    <input type="hidden" name="action" value="deleteProd">
                    <input type="hidden" name="invId" value="<?php
                    if (isset($invInfo['invId'])) {
                        echo $invInfo['invId'];
                    } elseif (isset($invId)) {
                        echo $invId;
                    }
                    ?>">
                </form>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
