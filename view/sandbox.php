<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Demo</title>
        <meta name="viewport" content="width=device-widtch">

    </head>
    <body>
        <main>
            <?php
            if (is_array($value)) {
                foreach ($value as $item) {
                    echo $item;
                }
            } else {
                echo $value;
            }
            ?>
        </main>
    </body>
</html>
