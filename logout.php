<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['is_active'] = false;
$_SESSION['stu_id'] = null;
$_SESSION['email'] = null;
$_SESSION['firstName'] = null;
$_SESSION['lastName'] = null;
$_SESSION['regNumber'] = null;


// Unset all session variables
session_unset();
// Destroy the session
session_destroy();
// Redirect to the login page

header('location: login.php');
exit();
