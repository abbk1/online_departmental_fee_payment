<?php ob_start(); ?>
<?php
session_start();
if (!isset($_SESSION['is_active']) || $_SESSION['is_active'] !== true) {
    header("Location: login.php"); // Redirects to login
    exit();
}
?>
<?php require_once("includes/header.php"); ?>

<body class="sb-nav-fixed">
    <?php include("includes/navbar.php"); ?>
    <div id="layoutSidenav">
        <?php include("includes/sidebar.php"); ?>
        <div id="layoutSidenav_content">
            <main>



                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Student Payment Receipt</li>
                    </ol>
                </div>
                <div class="container">
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-8">
                            <div class="card shadow border-0">
                                <div class="card-body p-4">
                                    <div class="text-center mb-4">
                                        <h4><strong>Payment Receipt</strong></h4>
                                        <h4><strong>Computer Science Department</strong></h4>
                                    </div>
                                    <?php
                                    if (!isset($_GET['id']) && !isset($_GET['lvl'])) {
                                        header("Location: index.php");
                                        exit();
                                    } else {
                                        $id = $_GET['id'];
                                        $lvl = $_GET['lvl'];

                                        $sql = "SELECT firstName, lastName, reference_no, `session`, `tblpayment_reference`.stu_id, ";
                                        $sql .= " `tblpayment_reference`.regNumber, `tblpayment_reference`.email,level, amount, ";
                                        $sql .= "  LEVEL, payment_type, payment_date, status FROM `tblstudents` INNER JOIN ";
                                        $sql .= " `tblpayment_reference` ON `tblstudents`.stu_id = `tblpayment_reference`.`stu_id` ";
                                        $sql .= " WHERE `tblpayment_reference`.stu_id = $id AND level = '$lvl';";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                $stu_id = $row["stu_id"];
                                                $firstName = $row["firstName"];
                                                $lastName = $row["lastName"];
                                                $regNumber = $row["regNumber"];
                                                $email = $row["email"];
                                                $payment_type = $row["payment_type"];
                                                $session = $row["session"];
                                                $payment_date = $row["payment_date"];
                                                $reference_no = $row["reference_no"];
                                                $level = $row["level"];
                                                $amount = $row["amount"];
                                                $status = $row["status"];
                                                $description = "Departmental Fee Payment";
                                    ?>
                                    <p><strong>Received From:</strong><br>
                                        <?= $firstName . " " . $lastName; ?><br>
                                        <strong>Payment Type:</strong> <?= ucfirst($payment_type); ?><br>
                                        <strong>Payment Status:</strong> <?= ucfirst($status); ?><br>
                                        <strong>Payment for:</strong> <?= $description; ?>
                                    </p>

                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Description</th>
                                                <th>Amount (₦)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $description ?> (<?= $level ?>)</td>
                                                <td><?= number_format($amount, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <th><?= number_format($amount, 2) ?></th>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <p><strong>Payment Method:</strong> <?= ucfirst($payment_type); ?><br>
                                    <p style="margin-top: -15px;;"><strong>Session:</strong>
                                        <?= ucfirst($session); ?><br>
                                        <strong>Payment Date:</strong> <?= $payment_date; ?>
                                    </p>

                                    <p class="mt-3">Thank you for your payment. Your transaction reference number is
                                        <strong><?= $reference_no ? $reference_no : "Not Available"; ?></strong>. Please
                                        keep this receipt for your
                                        records.
                                    </p>

                                    <div class="text-center mt-4">
                                        <button class="btn btn-primary" onclick="window.print()">Print Receipt</button>
                                    </div>
                                    <?php
                                            }
                                        } else {
                                            echo "<p>No payment details found.</p>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>








                <footer class="py-4 bg-light mt-auto">
                    <div class="container px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Departmental-fee-payment-system <?= date("Y") ?>
                            </div>
                            <!-- <div>
                                <a href="#">Privacy Policy</a> &middot; <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>