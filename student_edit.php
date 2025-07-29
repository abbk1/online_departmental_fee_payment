<?php
session_start();
if (!isset($_SESSION['is_active']) || $_SESSION['is_active'] !== true) {
    header("Location: login.php"); // Redirects to login
    exit();
}
$user_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : "";

?>
<?php require_once("includes/header.php"); ?>

<body class="sb-nav-fixed">

    <?php include("includes/navbar.php") ?>

    <div id="layoutSidenav">

        <?php include "includes/sidebar.php" ?>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Capture form data
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $regNumber = $_POST['regNumber'];
            $username = $_POST['username'];
            $password = $_POST['password']; // Consider hashing the password before storing it

            // image file upload code
            $target_dir = "passport/";
            $image          = basename($_FILES['image']['name']);
            $target_file     = $target_dir . $image;
            $image_type     = $_FILES['image']['type'];
            $image_size     = $_FILES['image']['size'];
            $image_error    = $_FILES['image']['error'];
            $image_tmp_name = $_FILES['image']['tmp_name'];

            $fileExt = explode('.', $image);
            $fileActualExt = strtolower(end($fileExt)); // Convert extension to lowercase

            $allowed = ['jpg', 'jpeg', 'png'];


            if (!in_array($fileActualExt, $allowed)) {
                $message = "<span style='color:cyan;'>Invalid file format...</span>";
            } elseif ($image_error !== UPLOAD_ERR_OK) {
                $message = "<span style='color:green;'>Error: Uploading image...</span>";
            } elseif ($image_size > 1048576) {
                $message = "<span style='color:cyan;'>Error: File size is too large...</span>";
            } elseif (file_exists($target_file)) {
                $message = "<span style='color:cyan;'>Error: File already exists...</span>";
            } else {
                // Move the uploaded file to the target directory
                if (move_uploaded_file($image_tmp_name, $target_file)) {
                    $stud_image = $image;
                } else {
                    $message = "<span style='color:green;'>Error: Failed to upload image...</span>";
                }

                // Validate form data (basic example)
                if (empty($firstName) || empty($lastName) || empty($email) || empty($mobile) || empty($regNumber) || empty($image) || empty($username) || empty($password)) {
                    $message = "<span style='color:red;'>All fields are required</span>";
                } else {
                    // Prepare and bind
                    $stmt = $conn->prepare("UPDATE tblstudents SET firstName=?, lastName=?, email=?, phoneNumber=?, regNumber=?, stud_image=?, username=?, password=? WHERE stu_id=?");
                    $stmt->bind_param("ssssssssi", $firstName, $lastName, $email, $mobile, $regNumber, $stud_image, $username, $password, $user_id);

                    // Execute the statement
                    if ($stmt->execute()) {
                        echo "";
                        $message = "<span style='color:green;'>Record updated successfully.</span>";
                    } else {
                        echo "Error updating record: " . $stmt->error;
                    }

                    // Close the statement
                    $stmt->close();
                }
            }
        }

        ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Edit-Profile</li>
                    </ol>
                </div>
                <div id="noimg"></div>
                <div class="container">
                    <div id="noimg"></div>
                    <div class="row justify-content-center mb-4">
                        <div class="text-center mb-2">
                            <div id="usernotfound"></div>
                            <?php if (isset($message)): ?>
                                <div class="text-center justify-content-center" style="margin-right: 105px;">
                                    <div class="alert alert-warning alert-dismissible fade show offset-1 " role="alert">
                                        <?= isset($message) ? $message : ''; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            <?php endif;

                            $sql = "SELECT * FROM `tblstudents` WHERE `stu_id` = $user_id";
                            // $sql = "SELECT * FROM `tblstudents` WHERE `stu_id` = '$user_id'";
                            $query = $conn->query($sql);

                            if ($query->num_rows > 0) {
                                // output data of each row
                                $row = $query->fetch_assoc();
                                $userImage = $row['stud_image'];
                                $firstName = $row['firstName'];
                                $lastname = $row['lastName'];

                            ?>

                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card shadow border-0">
                                <div class="card-header bg-primary text-white text-center">
                                    <h4>Student Profile</h4>
                                </div>
                                <div class="card-body text-center">

                                    <img src=<?= isset($userImage) ? 'passport/' . $userImage : "https://placehold.co/200x100"; ?>
                                        alt="Profile Image" class="img-thumbnail" style="width: 150px; height: 150px;">
                                    <h5 class="text-center mt-3">Welcome,
                                        <?= isset($lastName) && isset($firstName) ? $firstName . " " . $lastName : ''; ?>
                                    </h5>

                                <?php
                            }
                                ?>
                                <!-- <p class="text-center">Edit your profile here. <span id="upload"><a
                                                href="">upload</a></span> </p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-left">
                            <div class="card shadow border-0">
                                <div class="card-header bg-primary text-white text-center">
                                    <h4>Student Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <?php
                                        $sql = "SELECT * FROM `tblstudents` WHERE `stu_id` = $user_id";
                                        // $sql = "SELECT * FROM `tblstudents` WHERE `stu_id` = '$user_id'";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                $row["lastName"];
                                                $row["firstName"];
                                                $row["email"];
                                                $row["phoneNumber"];
                                                $row["regNumber"];
                                                $row["username"];
                                        ?>

                                                <div class="col-md-12">
                                                    <form enctype="multipart/form-data" action="" method="post">
                                                        <div class="mb-3">
                                                            <label for="firstName" class="form-label">First Name:</label>
                                                            <input type="text"
                                                                value="<?= isset($row["firstName"]) ? $row["firstName"] : ''; ?>"
                                                                class="form-control" id="firstName" name="firstName" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="lastName" class="form-label">Last Name:</label>
                                                            <input type="text"
                                                                value="<?= isset($row["lastName"]) ? $row["lastName"] : ''; ?>"
                                                                class="form-control" id="lastName" name="lastName">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email:</label>
                                                            <input type="email"
                                                                value="<?= isset($row["email"]) ? $row["email"] : ''; ?>"
                                                                class="form-control" id="email" name="email" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="mobile" class="form-label">Mobile:</label>
                                                            <input type="text"
                                                                value="<?= isset($row["phoneNumber"]) ? $row["phoneNumber"] : ''; ?>"
                                                                class="form-control" id="mobile" name="mobile" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="regNumber" class="form-label">Matric No:</label>
                                                            <input type="text"
                                                                value="<?= isset($row["regNumber"]) ? $row["regNumber"] : ''; ?>"
                                                                class="form-control" id="regNumber" name="regNumber" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="regNumber" class="form-label">Passport:</label>
                                                            <input type="file" class="form-control" id="regNumber" name="image">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Username:</label>
                                                            <input type="text"
                                                                value="<?= isset($row["username"]) ? $row["username"] : ''; ?>"
                                                                class="form-control" id="username" name="username" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Password:</label>
                                                            <input type="password" class="form-control" id="username"
                                                                name="password" required>
                                                        </div>

                                                        <div class="d-grid gap-2">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>

                                                    </form>

                                            <?php

                                            }
                                        } else {

                                            echo '<script>
                                                    var userNotFound = document.getElementById("usernotfound");
                                                    userNotFound.innerHTML = `
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    No Data Available
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`; 
                                                    </script>';
                                        }
                                        $conn->close();
                                            ?>
                                                </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <footer class="py-4 my-1 bg-light mt-auto">
                            <div class="container px-4">
                                <div class="d-flex align-items-center justify-content-between small">
                                    <div class="text-muted">Copyright &copy; Departmental-fee-payment-system
                                        <?= date("Y") ?></div>
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
            </main>
        </div>
    </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>