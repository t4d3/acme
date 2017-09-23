<?php

// Create or access a Session
session_start();

require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
require_once '../model/accounts-model.php';
require_once '../model/review-model.php';
require_once '../library/functions.php';

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
        $action = 'Login';
    }
}

switch ($action) {
    case 'Login':
        include '../view/login.php';
        break;
    case 'Registration':
        include '../view/registration.php';
        break;
    case 'Logout':
        session_destroy();
        header("location: /acme");
        break;
    case 'Register':
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $email = checkEmail($email);
        $checkPassword = checkPassword($password);

        $existingEmail = checkExistingEmail($email);

// Check for existing email address in the table
        if ($existingEmail) {
            $message = '<p class="notice">That email address already exists. Do you want to '
                    . '<a href="/acme/accounts/?action=Login">login</a> instead?</p>';
            include '../view/registration.php';
            exit;
        }

// Check for missing data
        if (empty($firstname) || empty($lastname) || empty($email) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }
        // Hash the checked password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $regOutcome = regVisitor($firstname, $lastname, $email, $password);

        // Check and report the result
        if ($regOutcome === 1) {
            setcookie('firstname', $firstname, strtotime('+1 year'), '/');
            $message = "<p>Thanks for registering $firstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $firstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $email = checkEmail($email);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($password);

// Run basic checks, return if errors
        if (empty($email) || empty($passwordCheck)) {
            $message = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }

// A valid password exists, proceed with the login process
// Query the client data based on the email address
        $clientData = getClient($email);
// Compare the password just submitted against
// the hashed password for the matching client
        $hashCheck = password_verify($password, $clientData['clientPassword']);
// If the hashes don't match create an error
// and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
// A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        setcookie('firstname', '', time() - 3600, '/');
// Remove the password from the array
// the array_pop function removes the last
// element from an array
        array_pop($clientData);
// Store the array into the session
        $_SESSION['clientData'] = $clientData;
        $_SESSION['message'] = "You have succesfully logged in!";
// Send them to the admin view
        header('location: /acme/accounts?action=Admin');
        break;
    case 'Admin':
        $reviewList = "";
        $clientReviews = getClientReviews($_SESSION['clientData']['clientId']);
        if (!empty($clientReviews[0]['invName'])) {
            $reviewList = buildClientReviews($clientReviews);
        }
        include '../view/admin.php';
        break;
    case 'updateAccount':
        include '../view/updateAccount.php';
        break;
    case 'updateAcc':
        $firstname = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

        if (empty($firstname) || empty($lastname) || empty($email)) {
            $message = "<p>Please make sure all fields are filled out</p>";
            include '../view/updateAccount.php';
            exit;
        }
        if ($_SESSION['clientData']['clientEmail'] != $email) {
            if (checkExistingEmail($email)) {
                $message = "That email is already in use! Pick another.";
                include '../view/updateAccount.php';
                exit;
            }
        }
        $updateResult = updateAccount($firstname, $lastname, $email, $_SESSION['clientData']['clientId']);
        if ($updateResult) {
            $message = "<p>Your account was successfully updated.</p>";
            $_SESSION['message'] = $message;
            $_SESSION['clientData'] = getClient($email);
            header('location: /acme/accounts?action=Admin');
            exit;
        } else {
            $message = "<p>There was an error updating your account.</p>";
            include '../view/updateAccount.php';
            exit;
        }
        break;
    case 'updatePass':
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $checkPassword = checkPassword($password);
// Check for existing email address in the table
// Check for missing data
        if (empty($checkPassword)) {
            $message = '<p>Please enter a valid password.</p>';
            include '../view/updateAccount.php';
            exit;
        }
        // Hash the checked password
        $password = password_hash($password, PASSWORD_DEFAULT);
        $updateResult = updatePassword($password, $_SESSION['clientData']['clientId']);

        // Check and report the result
        if ($updateResult) {
            $message = "<p>Your account was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/accounts?action=Admin');
            exit;
        } else {
            $message = "<p>There was an error updating your account.</p>";
            include '../view/updateAccount.php';
            exit;
        }
        break;

    default:
        include '../view/image-admin.php';
        break;
}
    