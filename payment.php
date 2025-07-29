<?php
session_start();
if (!isset($_SESSION['is_active']) || $_SESSION['is_active'] !== true) {
    header("Location: login.php"); // Redirects to login
    exit();
}
?>
<?php
include('includes/db.php');
if (isset($_GET['id']) && isset($_GET['status']) && isset($_GET['reference']) && isset($_GET['level'])) {

    $id = $_GET['id'];
    $status = $_GET['status'];
    $reference = $_GET['reference'];
    $level = trim($_GET['level']);
    $payment_date = date("Y-m-d");

    $sql = "UPDATE `tblpayment_reference` SET `reference_no`='$reference',`payment_date`='$payment_date',`status`='paid' WHERE `stu_id` = $id AND `level` ='$level'";

    $result = $conn->query($sql);
}
?>
<?php require_once("includes/header.php"); ?>

<body class="sb-nav-fixed">
    <?php include("includes/navbar.php") ?>

    <div id="layoutSidenav">

        <?php include "includes/sidebar.php" ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Student Payment</li>
                    </ol>
                </div>



                <div class="container">
                    <?php
                    if (isset($_GET['msg']) && $_GET['msg'] == 'fail') {
                        echo '
                     <div class="row justify-content-center mb-4 mx-4 ">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">Error: Please check your internet connection...
                                 <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                            </div>';
                    }

                    if (isset($_GET['msg']) && $_GET['msg'] == 'exists') {
                        echo '
                        <div class="row justify-content-center mb-4 mx-4 ">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">Payment for this level already exists! Please select another level.
                                 <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                            </div>';
                    }

                    if (isset($_GET['status']) && $_GET['status'] == 'success') {
                        echo '
                        <div class="row justify-content-center mb-4 mx-4 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">Your Payment was Successful!
                                 <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                            </div>';
                    }
                    ?>
                    <div class="row justify-content-center mb-4 ">
                        <div class="col-md-6">
                            <div class="card shadow border-0">
                                <div class="card-header bg-primary text-white text-center">
                                    <h4>Make a Payment</h4>
                                </div>
                                <div class="card-body">
                                    <?php

                                    $sql = "SELECT * FROM `tblfees`";
                                    // $sql = "SELECT * FROM `tblstudents` WHERE `stu_id` = '$user_id'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $amount = $row["fee"];
                                            $session = $row["session"];
                                        }
                                    }

                                    $user_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : "";
                                    $sql = "SELECT * FROM `tblstudents` WHERE `stu_id` = $user_id";
                                    // $sql = "SELECT * FROM `tblstudents` WHERE `stu_id` = '$user_id'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $row["stu_id"];
                                            $row["lastName"];
                                            $row["firstName"];
                                            $row["email"];
                                            $row["phoneNumber"];
                                            $row["regNumber"];
                                            $row["username"];
                                    ?>
                                            <form action="payment_exe.php" method="POST">
                                                <div class="mb-3">
                                                    <label for="regNumber" class="form-label">Reg. ID:</label>
                                                    <input type="text" class="form-control" value='<?= $row["regNumber"]; ?>'
                                                        disabled>
                                                    <input type="hidden" class="form-control" value='<?= $row["regNumber"]; ?>'
                                                        id="regNumber" name="regNumber">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="studentId" class="form-label">Student Email:</label>
                                                    <input type="text" class="form-control" value="<?= $row["email"]; ?>"
                                                        disabled>
                                                    <input type="hidden" class="form-control" value="<?= $row["email"]; ?>"
                                                        id="email" name="email">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Amount:</label>
                                                    <input type="number" value="<?= isset($amount) ? $amount : ""; ?>"
                                                        class="form-control" disabled>
                                                    <input type="hidden" value="<?= isset($amount) ? $amount : ""; ?>"
                                                        class="form-control" id="amount" name="amount">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Session:</label>
                                                    <input type="text" value="<?= isset($session) ? $session : ""; ?>"
                                                        class="form-control" disabled>
                                                    <input type="hidden" value="<?= isset($session) ? $session : ""; ?>"
                                                        class="form-control" id="session" name="session">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="paymentMethod" class="form-label">Level:</label>
                                                    <select class="form-control" id="lvl" name="lvl" required>
                                                        <option value="">--select--</option>
                                                        <option value="100lvl">100-level</option>
                                                        <option value="200lvl">200-level</option>
                                                        <option value="300lvl">300-level</option>
                                                        <option value="400lvl">400-level</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="hidden" class="form-control" value="<?= $row["stu_id"]; ?>"
                                                        id="stu_id" name="stu_id">
                                                </div>
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary">Proceed with Payment</button>
                                                </div>
                                        <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                        ?>
                                            </form>
                                </div>
                                <!-- </div> -->
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
        <!-- ending navbarcontent -->

    </div>
    <!-- ending layoutsidebarnav -->

    </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>