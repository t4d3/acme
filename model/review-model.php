<?php

function addReview($invId, $clientId, $review) {
// Create a connection object using the acme connection function
    $db = acmeConnect();
// The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
           VALUES (:reviewText, :invId, :clientId)';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $review, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

function getInvReviews($invId) {
    $db = acmeConnect();
    $sql = 'SELECT clients.clientFirstname, clients.clientLastname, reviews.reviewText, reviews.reviewDate FROM reviews INNER JOIN clients ON clients.clientId=reviews.clientId WHERE reviews.invId = :invId ORDER BY reviews.reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rawReviews = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $rawReviews;
}

function getClientReviews($clientId) {
    $db = acmeConnect();
    $sql = 'SELECT clients.clientFirstname, reviews.reviewText, reviews.reviewId, reviews.reviewDate, inventory.invName FROM reviews INNER JOIN clients ON clients.clientId=reviews.clientId INNER JOIN inventory ON inventory.invId=reviews.invId WHERE reviews.clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rawReviews = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $rawReviews;
}

function getReview($reviewId) {
    $db = acmeConnect();
    $sql = 'SELECT inventory.invName, reviews.reviewText, reviews.clientId, reviews.reviewDate FROM reviews INNER JOIN inventory ON inventory.invId=reviews.invId WHERE reviews.reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetch(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $review;
}

function updateReview($reviewId, $reviewText) {
    // Create a connection object from the acme connection function
    $db = acmeConnect();
// The SQL statement
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

function deleteReview($reviewId) {
    $db = acmeConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
