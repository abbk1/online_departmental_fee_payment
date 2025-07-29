<?php
// Include the database connection file
header('Content-Type: application/json');

$response = [];

try {
    // Ensure only POST requests are allowed
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }


    require_once '../includes/db.php'; // Include the database connection file
    // Check if the connection was successful   
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // Retrieve and sanitize inputs
    $firstName = isset($_POST['firstName']) ? $conn->real_escape_string($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? $conn->real_escape_string($_POST['lastName']) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $mobile = isset($_POST['mobile']) ? $conn->real_escape_string($_POST['mobile']) : '';
    $othername = isset($_POST['othername']) ? $conn->real_escape_string($_POST['othername']) : '';
    $password = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : '';
    $stu_id = isset($_POST['user_id']) ? $conn->real_escape_string($_POST['user_id']) : '';



    // Example query
    $query = "UPDATE `tblusers` SET `firstName`='$firstName',`lastName`='$lastName',`othername`='$othername',`email`='$email',`phonenumber`='$mobile',`password`='$password' WHERE `user_id`= $stu_id ";
    // Check if the query was successful
    if (!$conn->query($query)) {
        throw new Exception($user_id . 'Error inserting data: ' . $conn->error);
    }

    // Success response
    $response = [
        'success' => true,
        'message' => 'Record Updated successfully!',
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
