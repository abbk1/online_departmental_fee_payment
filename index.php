<?php
session_start();
if (!isset($_SESSION['is_active']) || $_SESSION['is_active'] !== true) {
    header("Location: login.php"); // Redirects to login
    exit();
}
?>
<?php include("includes/header.php"); ?>

<body class="sb-nav-fixed">

    <?php include("includes/navbar.php") ?>

    <div id="layoutSidenav">

        <?php require_once("includes/sidebar.php") ?>

        <?php

        if (isset($_GET['del_id']) && isset($_GET['lvl'])) {
            $stu_id = $conn->real_escape_string($_GET['del_id']);
            $leve = $conn->real_escape_string($_GET['lvl']);

            $query = "DELETE FROM tblpayment_reference WHERE stu_id = $stu_id AND `level` = '$leve'";
            // $query = "DELETE FROM tblpayment_reference WHERE user_id = $stu_id AND `level` = '$leve'";
            $res = $conn->query($query);
            if ($res) {
                header("location: index.php?status=success");
                exit();
            }
        }
        ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Student</li>
                    </ol>
                </div>
                <?php

                if (isset($_GET['status']) && $_GET['status'] == 'success') {
                    echo ' <div class="container">
                         <div id="autoDismissAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                             <strong>Payment!</strong> history successfully deleted.
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>';
                }


                ?>

                <div class="row mb-4">
                    <div class="col-md-6 mb-4 text-center">
                        <div class="card shadow border-0">
                            <div class="card-header bg-primary text-light text-center">
                                <h4>Departmental Fee Payment System</h4>
                            </div>
                            <div class="card-body" style="background-color: blue;">
                                <div class="row">
                                    <div class="col-md-12 title-img">
                                        <div class="row">
                                            <div class="col-md-6 d-flex justify-content-center">
                                                <!-- <img src="assets/img/logo.jpg" alt="" class="animated-image"> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 text-left">
                        <div class="card shadow border-0">
                            <div class="card-header bg-primary text-white text-center">
                                <h4 class="user-profile">User Profile</h4>
                            </div>
                            <div id="usernotfound" class="mt-3"></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive user-profil-card">
                                            <?php

                                            $user_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : "";

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
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">NAME:</th>
                                                                <td scope="col">
                                                                    <?= isset($row["firstName"]) ? $row["firstName"] . " " . $row["lastName"] : ''; ?>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="">
                                                                <th scope="row">Email:</th>
                                                                <td><?= isset($row["email"]) ? $row["email"] : ''; ?>
                                                                </td>
                                                            </tr>
                                                            <tr class="">
                                                                <th scope="row">Phone:</th>
                                                                <td><?= isset($row["phoneNumber"]) ? $row["phoneNumber"] : ''; ?>
                                                                </td>
                                                            </tr>
                                                            <tr class="">
                                                                <th scope="row">Username:</th>
                                                                <td><?= isset($row["username"]) ? $row["username"] : ''; ?>
                                                                </td>
                                                            </tr>
                                                            <tr class="">
                                                                <th scope="row">Reg No:</th>
                                                                <td><?= isset($row["regNumber"]) ? $row["regNumber"] : ''; ?>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>

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
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="student_edit.php" class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="roww">
                    <div class="col-12">
                        <div class="mb-4">
                            <button class="btn btn-primary" id="hide-print">Hide History</button>
                            <button class="btn btn-primary d-none" id="show-print1">Display History</button>
                        </div>
                        <div class="card mb-4 tbl-card">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Payment History
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Level</th>
                                            <th>Transaction Reference</th>
                                            <th>Payment Method</th>
                                            <th>Session</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Reciept</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT firstName, lastName, reference_no, `tblpayment_reference`.stu_id, `tblpayment_reference`.regNumber, `tblpayment_reference`.email,level, amount,session, LEVEL, payment_type, payment_date, status FROM `tblstudents` INNER JOIN `tblpayment_reference` ON `tblstudents`.stu_id = `tblpayment_reference`.`stu_id` WHERE `tblpayment_reference`.stu_id = $user_id;";
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
                                                $payment_date = $row["payment_date"];
                                                $reference_no = $row["reference_no"];
                                                $level = $row["level"];
                                                $amount = $row["amount"];
                                                $session = $row["session"];
                                                $status = $row["status"];
                                                $description = "Departmental Fee Payment";
                                        ?>
                                                <tr>
                                                    <td><?= $firstName ? $firstName . " " . $lastName : ''; ?></td>
                                                    <td><?= $level ? $level : ''; ?></td>
                                                    <td><?= $reference_no ? $reference_no : ''; ?></td>
                                                    <td><?= $payment_type ? ucfirst($payment_type) : ''; ?></td>
                                                    <td><?= $session ? ucfirst($session) : ''; ?></td>
                                                    <td><?= $payment_date ? $payment_date : ''; ?></td>
                                                    <td><?= $status ? ucfirst($status) : ''; ?></td>
                                                    <td><a class="btn btn-primary btn-print"
                                                            href="print_reciept.php?id=<?= $stu_id; ?>&lvl=<?= $level; ?>"><i
                                                                class="fas fa-print"></i>Print</a></td>
                                                    <td><a class="btn btn-danger btn-delete text-center"
                                                            onclick="return confirm('Are you sure you want to delete this payment history?');"
                                                            href="index.php?del_id=<?= $stu_id; ?>&lvl=<?= $level; ?>"><i
                                                                class="fas fa-remove mx-2"></i></a></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr>
                                                        <td colspan="8" class="text-center">No Payment History Found</td>
                                                    </tr>';
                                        }
                                        $conn->close();
                                        ?>

                                    </tbody>
                                </table>
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
        </div>
    </div>
    </main>
    </div>

    <script>
        $(function() {
            $("#hide-print").click(function() {
                $(".tbl-card").slideToggle(2000);
                $("#hide-print").addClass("d-none");
                $("#show-print1").removeClass("d-none");
                $("#show-print1").animate({
                    "margin-left": "1000px"
                }, 2000, "linear");
            });

            $("#show-print1").click(function() {
                $(".tbl-card").slideToggle(1000);
                $("#show-print1").addClass("d-none");
                $("#hide-print").removeClass("d-none");
                $("#hide-print").animate({
                    "margin-right": "900px"
                }, 2000);
            });

            // Add a click event listener to the print button
            // document.querySelectorAll('.btn-print').forEach(button => {
            //     button.addEventListener('click', function() {
            //         const recieptId = this.getAttribute('data-id');
            //         window.location.href = `print_reciept.php?id=${recieptId}`;
            //     });
            // });
        });


        // Automatically close the alert after 5 seconds (5000ms)
        setTimeout(function() {
            const alert = document.getElementById('autoDismissAlert');
            if (alert) {
                // Fade out the alert
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }
        }, 5000);
    </script>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>