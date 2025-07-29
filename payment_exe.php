<?php
ob_start();
require_once("includes/header.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect form input
    $regNumber  = $_POST['regNumber'];
    $email      = $_POST['email'];
    $amount     = $_POST['amount'] * 100; // Convert Naira to Kobo
    $session     = $_POST['session'];
    $lvl        = trim($_POST['lvl']);
    $stu_id     = $_POST['stu_id'];
    // $amount = $_POST['amount'] * 100; // Convert Naira to Kobo


    $sql = "SELECT * FROM `tblpayment_reference` WHERE `stu_id` = $stu_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $level = $row["level"];
            if ($lvl == $level) {
                // Payment reference already exists for this student and level
                header("Location: payment.php?msg=exists");
                exit();
            }
        }
    }


    // Paystack endpoint
    $url = "https://api.paystack.co/transaction/initialize";
    // Fields required by Paystack
    $fields = [
        'email' => $email,
        'amount' => $amount,
        'callback_url' => "http://localhost/departmental_fee_system/payment.php?id=$stu_id&status=success&level=$lvl",
    ];

    // Convert fields to URL encoded string
    $fields_string = http_build_query($fields);

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer sk_test_5434f622e146765623c95db285f5899f21da5074", // Replace with your actual secret key
        "Cache-Control: no-cache",
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL
    $result = curl_exec($ch);
    $response = json_decode($result, true);


    if ($response && $response['status']) {

        $amount = $amount / 100; // Convert Kobo back to Naira for database storage
        // Insert new payment reference
        $sql = "INSERT INTO `tblpayment_reference` (`stu_id`, `regNumber`, `email`, `amount`, `session`, `level`,`payment_type`,`status`) VALUES ('$stu_id', '$regNumber', '$email', '$amount', '$session', '$lvl','bank','not paid')";
        if ($conn->query($sql) === TRUE) {
            // Payment reference inserted successfully
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die("Error inserting payment reference: " . $conn->error);
        }

        // Redirect user to Paystack payment page
        header('Location: ' . $response['data']['authorization_url']);
        exit();
    } else {
        echo "Payment initialization failed. " . $response['message'];
        header("Location: payment.php?msg=fail");
        exit();
    }
} else {
    echo "Invalid request.";
}

ob_end_flush();