<?php

/*
 * Sessions
 */
session_start();
$_SESSION['object'] = 'basketball';
$_SESSION['tool'] = 'pen';
$_SESSION['target'] = 'duckey';
$tissues = array('number1' . 'number2' . 'number3');
$_SESSION['cleanup'] = $tissues;



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'Play':
        $value = $_SESSION['object'];
        include '../view/sandbox.php';
        break;
    case 'Draw':
        $value = $_SESSION['tool'];
        include '../view/sandbox.php';
        break;
    case 'squeek':
        $value = $_SESSION['target'];
        include '../view/sandbox.php';
        break;
    case 'sneeze':
        $value = $_SESSION['cleanup'];
        include '../view/sandbox.php';
        break;
}