<?php
if (!$_SESSION['loggedin'] || ($_SESSION['clientData']['clientLevel'] == 1)) {
    header("location: /acme");
}
?>
<?php
// Build the categories option list
$catList = '<select name="categoryId" id="categoryId">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'";
    if (isset($categoryId)) {
        if ($category['categoryId'] === $categoryId) {
            $catList .= ' selected ';
        }
    } elseif (isset($invInfo['categoryId'])) {
        if ($category['categoryId'] === $invInfo['categoryId']) {
            $catList .= ' selected ';
        }
    }
    $catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Acme - <?php
            if (isset($invInfo['invName'])) {
                echo "Modify $invInfo[invName] ";
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

                <h1>Modify <?php
                    if (isset($invInfo['invName'])) {
                        echo " $invInfo[invName] ";
                    } elseif (isset($invName)) {
                        echo $invName;
                    }
                    ?></h1>
                <h2>Please do the thing</h2>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="post" action="/acme/products/">

                    <input required type="text" placeholder="Inventory Name" name="invName" id="invName" <?php
                    if (isset($invName)) {
                        echo "value='$invName'";
                    } elseif (isset($invInfo['invName'])) {
                        echo "value='$invInfo[invName]'";
                    }
                    ?>><br>
                           <?php echo $catList . '<br>'; ?>
                    <input required type="text" placeholder="Inventory Description" name="invDescription" id="invDescription" <?php
                    if (isset($invDescription)) {
                        echo "value='$invDescription'";
                    } elseif (isset($invInfo['invDescription'])) {
                        echo "value='$invInfo[invDescription]'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Image" name="invImage" id="invImage" <?php
                    if (isset($invImage)) {
                        echo "value='$invImage'";
                    } elseif (isset($invInfo['invImage'])) {
                        echo "value='$invInfo[invImage]'";
                    }
                    ?>value="/images/no-image/no-image.png" ><br>
                    <input required type="text" placeholder="Inventory Thumbnail" name="invThumbnail" id="invThumbnail" <?php
                    if (isset($invThumbnail)) {
                        echo "value='$invThumbnail'";
                    } elseif (isset($invInfo['invThumbnail'])) {
                        echo "value='$invInfo[invThumbnail]'";
                    }
                    ?>value="/images/no-image/no-image.png" ><br>
                    <input required type="text" placeholder="Inventory Price" name="invPrice" id="invPrice" <?php
                    if (isset($invPrice)) {
                        echo "value='$invPrice'";
                    } elseif (isset($invInfo['invPrice'])) {
                        echo "value='$invInfo[invPrice]'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Stock" name="invStock" id="invStock" <?php
                    if (isset($invStock)) {
                        echo "value='$invStock'";
                    } elseif (isset($invInfo['invStock'])) {
                        echo "value='$invInfo[invStock]'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Size" name="invSize" id="invSize" <?php
                    if (isset($invSize)) {
                        echo "value='$invSize'";
                    } elseif (isset($invInfo['invSize'])) {
                        echo "value='$invInfo[invSize]'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Weight" name="invWeight" id="invWeight" <?php
                    if (isset($invWeight)) {
                        echo "value='$invWeight'";
                    } elseif (isset($invInfo['invWeight'])) {
                        echo "value='$invInfo[invWeight]'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Location" name="invLocation" id="invLocation" <?php
                    if (isset($invLocation)) {
                        echo "value='$invLocation'";
                    } elseif (isset($invInfo['invLocation'])) {
                        echo "value='$invInfo[invLocation]'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Vendor" name="invVendor" id="invVendor" <?php
                    if (isset($invVendor)) {
                        echo "value='$invVendor'";
                    } elseif (isset($invInfo['invVendor'])) {
                        echo "value='$invInfo[invVendor]'";
                    }
                    ?>><br>
                    <input required type="text" placeholder="Inventory Style" name="invStyle" id="invStyle" <?php
                           if (isset($invStyle)) {
                               echo "value='$invStyle'";
                           } elseif (isset($invInfo['invStyle'])) {
                               echo "value='$invInfo[invStyle]'";
                           }
                           ?>><br>
                    <button type="submit">Modify Item!</button>
                    <input type="hidden" name="action" value="updateProd">
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
