<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACME - Home</title>
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
            <div id="top">
                <div id="topText">
                    <h2>Get Dinner Rocket</h2>
                    <h5>Quick Lightning fuse</h5>
                    <h5>NHTSA approved seat belts</h5>
                    <h5>mobile launch stand included</h5>
                    <img id="buyNow" src="/acme/images/site/iwantit.gif" alt="I want it now!"/>
                </div>
            </div>
            <div id="bottom">
                <div id="foodPic">
                    <figure>
                        <img src="/acme/images/recipes/bbqsand.jpg" alt=""/>
                        <figcaption>Pulled Roadrunner BBQ</figcaption>
                    </figure>
                    <figure>
                        <img src="/acme/images/recipes/potpie.jpg" alt=""/>
                        <figcaption>Roadrunner Pot Pie</figcaption>
                    </figure>
                    <figure>
                        <img src="/acme/images/recipes/soup.jpg" alt=""/>
                        <figcaption>Roadrunner Soup</figcaption>
                    </figure>
                    <figure>
                        <img src="/acme/images/recipes/taco.jpg" alt=""/>
                        <figcaption>Roadrunner Tacos</figcaption>
                    </figure>
                </div>
                <div id="foodAd">
                    <h4>Get Dinner Rocket reviews</h4>
                    <ul>
                        <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                        <li>"That thing was fast!" (4/5)</li>
                        <li>"Talk about fast delivery." (5/5)</li>
                        <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                        <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                    </ul>
                </div>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/modules/footer.php'; ?>
    </body>
</html>
