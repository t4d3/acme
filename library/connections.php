<?php

function acmeConnect() {
    $server = 'localhost';
    $database = 'acme';
    $user = 'iClient';
    $password = 'M9dWfazqKFV9HFyt';
    $dsn = "mysql:host=$server;dbname=$database";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

// Create the actual connection object and assign it to a variable
    try {
        $acmeLink = new PDO($dsn, $user, $password, $options);
        return $acmeLink;
//ECHO 'connection worked!';
    } catch (PDOException $e) {
        header('location: /acme/view/500.php');
    }
}
