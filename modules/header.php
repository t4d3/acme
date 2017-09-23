<header>
    <div>
        <a id="amceWebsite" href="/acme/"><img src="/acme/images/site/logo.gif" title="ACME website" alt="Acme" width="230" height="91"></a>
    </div>
    <div id="myAccount">
        <?php
        if (isset($_SESSION['loggedin'])) {
            echo "<a href='/acme/accounts/?action=Admin'>Welcome " . $_SESSION['clientData']['clientFirstname'];
            echo "<img src='/acme/images/site/account.gif' alt='account' height='30' width='35'/></a>\n\t\t";
            echo "<a href='/acme/accounts/?action=Logout'>Logout</a>";
        } else {
            echo "<a href='/acme/accounts/?action=Login'>My Account";
            echo "<img src='/acme/images/site/account.gif' alt='account' height='30' width='35'/></a>";
        }
        ?>
    </div>
</header>
