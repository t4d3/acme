<?php

// Create or access a Session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';
require_once 'library/functions.php';

// Get the array of categories
$categories = getCategories();

// var_dump($categories);
// exit;
// Build a navigation bar using the $categories array
$navList = buildNav($categories);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'Home';
    }
}

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'Home':
        include 'view/home.php';
        break;
    case 'Template':
        include 'view/template.php';
        break;
    case 'Cannon':
        include 'view/template.php';
        break;
    case 'Explosive':
        include 'view/template.php';
        break;
    case 'Misc':
        include 'view/template.php';
        break;
    case 'Rocket':
        include 'view/template.php';
        break;
    case 'Trap':
        include 'view/template.php';
        break;
    default :
        include 'view/404.php';
}
