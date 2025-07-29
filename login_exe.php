<?php ob_start(); ?>
<?php include("includes/db.php") ?>
<?php
if (isset($_POST["submit"])) {

    $error = array();
    $email = $_POST['email'] ? $_POST['email'] : '';
    $password = $_POST['password'] ? $_POST['password'] : '';

    // Validate email and password

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    // Hash the password


    if (empty($email)) {
        $error['email'] = "Email is required";
    } else if (empty($password)) {
        $error['password'] = "Password is required";
    } else {
        $query = "SELECT * FROM tblstudents WHERE email='$email' AND password='$password' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // die("Login successful");
            // $_SESSION['stu_id'] = $row['stu_id'];

            header("Location: index.php");
            ob_end_flush(); // Optional: Sends the output and turns off buffering
            exit();
        } else {
            $error['loginfail'] = "<p class='text-center text-danger'>Invalid email or password</p>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
