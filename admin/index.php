<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["user_role"]) || $_SESSION["user_role"] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<?php include("includes/header.php") ?>

<body class="sb-nav-fixed">
    <?php include("includes/nav.php") ?>
    <div id="layoutSidenav">
        <?php include("includes/sidebar.php") ?>
        <?php include("../includes/db.php") ?>
        <?php include("functions.php") ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Wecome to Admin Panel</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body fw-bolder">Students <span class="fw-bolder mx-4"
                                        style="font-size: 30px;"><?= countStudent(); ?>
                                        </spanb>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_students.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body fw-bolder">Total Users <span class="fw-bolder mx-4"
                                        style="font-size: 30px;"><?= countuser(); ?>
                                        </spanb>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_users.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body fw-bolder">Total Paid 100 level <span class="fw-bolder mx-4"
                                        style="font-size: 30px;"><?= hundredLevel(); ?>
                                        </spanb>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_students.php?lvl=100lvl">View
                                        Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body fw-bolder">Total Paid 200 level <span class="fw-bolder mx-4"
                                        style="font-size: 30px;"><?= twoHundredLevel(); ?>
                                        </spanb>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_students.php?lvl=200lvl">View
                                        Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-dark text-white mb-4">
                                <div class="card-body fw-bolder">Total Paid 300 level <span class="fw-bolder mx-4"
                                        style="font-size: 30px;"><?= threeHundredLevel(); ?>
                                        </spanb>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_students.php?lvl=300lvl">View
                                        Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body fw-bolder">Total Paid 400 level <span class="fw-bolder mx-4"
                                        style="font-size: 30px;"><?= fourHhundredLevel(); ?>
                                        </spanb>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_students.php?lvl=400lvl">View
                                        Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Payment Percentage
                                </div>
                                <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Paymennt Status
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-user"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Other Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Reg. Number</th>
                                        <th>Username</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `tblstudents`;";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $user_id = $row["stu_id"];
                                            $firstName = $row["firstName"];
                                            $lastName = $row["lastName"];
                                            $othername = $row["othername"];
                                            $email = $row["email"];
                                            $phonenumber = $row["phoneNumber"];
                                            $regNumber = $row["regNumber"];
                                            $username = $row["username"];
                                    ?>
                                            <tr>
                                                <td><?= isset($firstName) ? $firstName : "Nill"; ?></td>
                                                <td><?= isset($lastName) ? $lastName : "Nill"; ?></td>
                                                <td><?= isset($othername) ? $othername : "Nill"; ?></td>
                                                <td><?= isset($email) ? $email : "Nill"; ?></td>
                                                <td><?= isset($phonenumber) ? $phonenumber : "Nill"; ?></td>
                                                <td><?= isset($regNumber) ? $regNumber : "Nill"; ?></td>
                                                <td><?= isset($username) ? $username : "Nill"; ?></td>
                                                <td><a href="edit_student.php?id=<?= isset($user_id) ? $user_id : ""; ?>"
                                                        class="btn btn-warning text-light">Edit</a></td>
                                            </tr>

                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("includes/footer.php"); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>