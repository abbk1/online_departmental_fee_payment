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

        <?php

        if (isset($_GET['del_id'])) {
            $stu_id = $conn->real_escape_string($_GET['del_id']);

            $query = "DELETE FROM tblstudents WHERE stu_id = $stu_id";
            $res = $conn->query($query);
            if ($res) {
                header("location: view_students.php?deleted=success");
                exit();
            }
        }



        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Students</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                    <div class="">
                        <input type="checkbox" name="select-all" id="select-all">
                        <label for="select-all" class="fw-bolder">Select all</label>
                        <input type="button" class="btn btn-primary mb-3" value="Delete">
                        <a href="add_student.php" class="btn btn-primary mb-3">Add Student</a>
                    </div>
                    <div class="card mb-4">
                        <!-- <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div> -->
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th><input type="hidden" name="select-all" id="select-all"></th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Other Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Reg. Number</th>
                                        <?= isset($_GET['lvl']) ? '<th>Transaction Id</th>' : ''; ?>
                                        <?= isset($_GET['lvl']) ? '<th>Payment Type</th>' : ''; ?>
                                        <?= isset($_GET['lvl']) ? '<th>Payment Date</th>' : ''; ?>
                                        <?= isset($_GET['lvl']) ? '<th>Level</th>' : ''; ?>
                                        <?= isset($_GET['lvl']) ? '<th>Status</th>' : ''; ?>
                                        <th>Username</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['lvl'])) {
                                        $level = $conn->escape_string($_GET['lvl']);
                                        $sql = "SELECT st.stu_id, st.username, st.firstName, st.lastName, st.othername, st.email, st.phoneNumber, st.regNumber, pm.reference_no, pm.level, pm.payment_type, pm.payment_date, pm.status FROM tblstudents AS st RIGHT JOIN tblpayment_reference AS pm ON st.stu_id=pm.stu_id WHERE level = '$level'";
                                    } else {

                                        $sql = "SELECT * FROM `tblstudents`;";
                                    }
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $user_id = $row["stu_id"];
                                            $firstName = $row["firstName"];
                                            $lastName = $row["lastName"];
                                            $othername = $row["othername"];
                                            $fullname = $firstName . ' ' . $lastName;
                                            $email = $row["email"];
                                            $phonenumber = $row["phoneNumber"];
                                            $regNumber = $row["regNumber"];
                                            isset($_GET['lvl']) ? $reference_no = $row["reference_no"] : '';
                                            isset($_GET['lvl']) ? $payment_type = $row["payment_type"] : '';
                                            isset($_GET['lvl']) ? $payment_date = $row["payment_date"] : '';
                                            isset($_GET['lvl']) ? $level = $row["level"] : '';
                                            isset($_GET['lvl']) ? $status = $row["status"] : '';
                                            $username = $row["username"];
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="select-all"></td>
                                        <td><?= isset($firstName) ? $firstName : "Nill"; ?></td>
                                        <td><?= isset($lastName) ? $lastName : "Nill"; ?></td>
                                        <td><?= isset($othername) ? $othername : "Nill"; ?></td>
                                        <td><?= isset($email) ? $email : "Nill"; ?></td>
                                        <td><?= isset($phonenumber) ? $phonenumber : "Nill"; ?></td>
                                        <td><?= isset($regNumber) ? $regNumber : "Nill"; ?></td>
                                        <?= isset($_GET['lvl']) ? "<td>{$reference_no}</td>" : ''; ?>
                                        <?= isset($_GET['lvl']) ? "<td>{$payment_type}</td>" : ''; ?>
                                        <?= isset($_GET['lvl']) ? "<td>{$payment_date}</td>" : ''; ?>
                                        <?= isset($_GET['lvl']) ? "<td>{$level}</td>" : ''; ?>
                                        <?= isset($_GET['lvl']) ? "<td>{$status}</td>" : ''; ?>
                                        <td><?= isset($username) ? $username : "Nill"; ?></td>
                                        <td><a href="view_student.php?id=<?= isset($user_id) ? $user_id : "Nill"; ?>"
                                                class="btn btn-primary text-light">View</a></td>
                                        <td><a href="edit_student.php?id=<?= isset($user_id) ? $user_id : "Nill"; ?>"
                                                class="btn btn-warning text-light">Edit</a></td>
                                        <td>
                                            <a onclick="return confirm('Are you sure you want to continue to delete student: <?= isset($fullname) ? $fullname : ''; ?>')"
                                                href="view_students.php?del_id=<?= isset($user_id) ? $user_id : "Nill"; ?>"
                                                id="deleteId" class="btn btn-danger text-light">Delete</a>
                                        </td>
                                    </tr>

                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <script>
                            $("#select-all").change(function() {
                                $("input:checkbox").not(this).prop('checked', this.checked);
                            });
                            </script>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>