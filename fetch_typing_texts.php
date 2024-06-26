<?php
require_once('classes/database.php');
session_start();

$con = new database();


// Fetch typing_texts from the home table
$query = "SELECT typing_texts FROM home WHERE home_id = 1"; // Adjust query as per your structure
$result = $con->executeQuery($query);

if ($result) {
    $row = $con->fetchArray($result);
    $typing_texts = $row['typing_texts'];

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode(['typing_texts' => $typing_texts]);
} else {
    echo json_encode(['error' => 'Failed to fetch data']); // Handle error case
}
