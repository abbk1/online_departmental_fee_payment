<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['is_admin_active'] = false;
$_SESSION['user_id'] = null;
$_SESSION['email'] = null;
$_SESSION['firstName'] = null;
$_SESSION['lastName'] = null;


// Unset all session variables
session_unset();
// Destroy the session
session_destroy();
// Redirect to the login page

header('location: login.php');
exit();
