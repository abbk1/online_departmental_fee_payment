<?php
// Include the database connection file
header('Content-Type: application/json');

$response = [];

try {
    // Ensure only POST requests are allowed
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }


    require_once 'includes/db.php'; // Include the database connection file
    // Check if the connection was successful   
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // Retrieve and sanitize inputs
    $firstName = isset($_POST['firstName']) ? $conn->real_escape_string($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? $conn->real_escape_string($_POST['lastName']) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $mobile = isset($_POST['mobile']) ? $conn->real_escape_string($_POST['mobile']) : '';
    $regNumber = isset($_POST['regNumber']) ? $conn->real_escape_string($_POST['regNumber']) : '';
    $username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
    $password = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : '';


    $query = "SELECT * FROM `tblstudents` WHERE `email` = '$email' OR `username` = '$username'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        throw new Exception("Email:{$email} or username:{$username} already exists.");
    }

    $query = "SELECT * FROM `tblstudents` WHERE `regNumber` = '$regNumber'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        throw new Exception("The Matric No: {$regNumber} already exists.");
    }


    // Example query
    $query = "INSERT INTO `tblstudents`(`firstName`, `lastName`, `email`, `phoneNumber`, `regNumber`, `username`, `password`) ";
    $query .= " VALUES ('$firstName','$lastName','$email','$mobile','$regNumber','$username','$password')";

    // Check if the query was successful
    if (!$conn->query($query)) {
        throw new Exception('Error inserting data: ' . $conn->error);
    }

    // Success response
    $response = [
        'success' => true,
        'message' => 'Your form has been submitted successfully!',
    ];
} catch (Exception $e) {
    // Error response
    $response = [
        'success' => false,
        'message' => $e->getMessage(),
        'error' => $e->getMessage(), // Include the error message for debugging (only in dev)
    ];
}

// Send the JSON response
echo json_encode($response);
