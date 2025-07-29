<?php ob_start();
session_start(); ?>
<?php include("includes/header.php"); ?>
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
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['stu_id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['regNumber'] = $row['regNumber'];
            }
            $row = mysqli_fetch_assoc($result);

            $_SESSION['is_active'] = true;
            $_SESSION['user_id'] = $user_id;

            // die("Login successful" . $_SESSION['user_id'] . var_dump($_SESSION['is_active']) . "ok");
            header("Location: index.php");
            exit();
        } else {
            $error['loginfail'] = "<p class='text-center text-danger'>Invalid email or password</p>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">

                                    <?= !empty($error['loginfail']) ? $error['loginfail'] : '' ?>
                                    <form action="" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" name="email"
                                                value="<?= isset($email) ? htmlspecialchars($email) : ''; ?>"
                                                placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                            <span
                                                class="text-danger"><?= !empty($error['email']) ? $error['email'] : ''; ?></span>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password"
                                                name="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                            <span
                                                class="text-danger"><?= !empty($error['password']) ? $error['password'] : ''; ?></span>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                                value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember
                                                Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <input type="submit" class="btn btn-primary" name="submit" value="Login">
                                            <!-- <a class="btn btn-primary" href="index.html">Login</a> -->
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>