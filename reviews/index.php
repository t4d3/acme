<?php

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../model/review-model.php';

// Get the array of categories
$categories = getCategories();

// var_dump($categories);
// exit;
// Build a navigation bar using the $categories array
$navList = buildNav($categories);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'addReview':
        $prodId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
        $review = filter_input(INPUT_POST, 'invReview', FILTER_SANITIZE_STRING);
        if (empty($review) || empty($prodId)) {
            $_SESSION['message'] = "Please include a review for this product.";
            header("location: /acme/products/?action=productDetail&invId=$prodId");
            exit;
        }
        $addReviewResult = addReview($prodId, $_SESSION['clientData']['clientId'], $review);

        if ($addReviewResult) {
            $_SESSION['message'] = "Your review was succesfully added!";
            header("location: /acme/products/?action=productDetail&invId=$prodId");
        }
        break;
    case 'modify':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $review = getReview($reviewId);
        if ($_SESSION['clientData']['clientId'] == $review['clientId']) {
            if (is_array($review)) {
                $date = date("M jS, Y", strtotime($review['reviewDate']));
                $review['reviewDate'] = $date;
                include '../view/review-update.php';
                exit;
            } else {
                $message = "there was a problem with your request!";
                include '../view/admin.php';
                exit;
            }
        } else {
            $_SESSION['message'] = "It doesn't seem like that is your review to edit!";
            header("location: /acme/accounts/?action=Admin");
            exit;
        }
        break;
    case 'modifyReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        if (empty($reviewText) || $reviewText == '') {
            $_SESSION['message'] = "Review cannot be empty.";
            header("location: /acme/reviews?action=modify&reviewId=$reviewId");
            exit;
        }
        $review = getReview($reviewId);
        if ($reviewText == $review['reviewText']) {
            $message = "There was no change in your review.";
            include '../view/review-update.php';
            exit;
        } else {
            $success = updateReview($reviewId, $reviewText);
            if ($success) {
                $_SESSION['message'] = "Your review was updated succesfully.";
                header("location: /acme/accounts/?action=Admin");
            } else {
                $_SESSION['message'] = "There was an error processing your review modification.";
                header("location: /acme/accounts/?action=Admin");
            }
        }
        break;
    case 'delete':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $review = getReview($reviewId);

        include '../view/review-delete.php';
        break;
    case 'deleteReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT);
        $success = deleteReview($reviewId);
        if ($success) {
            $_SESSION['message'] = "Your review was deleted succesfully.";
            header("location: /acme/accounts/?action=Admin");
        } else {
            $_SESSION['message'] = "There was an error deleting your review.";
            header("location: /acme/accounts/?action=Admin");
        }

        break;
    default:
        header("location: /acme/accounts/?action=Admin");
        break;
}
