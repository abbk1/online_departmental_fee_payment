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

                <?php
                if (isset($_GET['id'])) {
                    $stu_id = $conn->escape_string($_GET['id']);


                    $sql = "SELECT st.stu_id, st.username, st.firstName, st.lastName, st.othername, st.email, st.phoneNumber,";
                    $sql .= " st.regNumber, pm.reference_no, pm.level, pm.payment_type, pm.payment_date, pm.status";
                    $sql .= " FROM tblstudents AS st RIGHT JOIN tblpayment_reference AS pm ON st.stu_id=pm.stu_id WHERE st.stu_id = $stu_id";

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
                            $status = $row["status"];
                            $level = $row["level"];
                            // $status = "paid";
                            // $level = "100lvl";
                        }
                ?>

                        <div class="container-fluid mt-4">
                            <div class="row">
                                <!-- Left Column: Student Biodata -->
                                <div class="col-md-6">
                                    <div class="card shadow">
                                        <div class="card-header bg-primary text-white">
                                            <h5>Student Biodata</h5>
                                        </div>
                                        <div class="card-body">

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><strong>Name:</strong>
                                                    <?= $firstName . " " . $othername . " " . $lastName  ?></li>
                                                <li class="list-group-item"><strong>Matric No:</strong>
                                                    <?= $regNumber; ?></li>
                                                <li class="list-group-item"><strong>Email:</strong> <?= $email; ?>
                                                </li>
                                                <li class="list-group-item"><strong>Phone:</strong> <?= $phonenumber; ?>
                                                </li>
                                                <li class="list-group-item"><strong>Department:</strong>
                                                    <?= $student['department'] = "Computer Science" ?></li>
                                                <li class="list-group-item"><strong>Username:</strong> <?= $username; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Table with ID, Level, Action -->
                                <div class="col-md-6">
                                    <div class="card shadow">
                                        <div class="card-header bg-primary text-white">
                                            <h5>Student Academic Levels</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Sample data – replace with dynamic DB data
                                                    $records = [
                                                        ['id' => 1, 'level' => '100lvl', 'status' => (updStatus('100lvl', $stu_id) ? "Paid" : "Not Paid")],
                                                        ['id' => 2, 'level' => '200lvl', 'status' => (updStatus('200lvl', $stu_id) ? "Paid" : "Not Paid")],
                                                        ['id' => 3, 'level' => '300lvl', 'status' => (updStatus('300lvl', $stu_id) ? "Paid" : "Not Paid")],
                                                        ['id' => 4, 'level' => '400lvl', 'status' => (updStatus('400lvl', $stu_id) ? "Paid" : "Not Paid")]
                                                    ];

                                                    foreach ($records as $rec) {
                                                        echo "<tr>
                                    <td>{$rec['id']}</td>
                                    <td>{$rec['level']}</td>
                                    <td>{$rec['status']}</td>
                                    <td>
                                        <a href='print_reciept.php?id={$stu_id}&lvl={$rec['level']}' class='btn btn-primary btn-sm'>Print</a>
                                    </td>
                                </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                        <?php
                    } else {
                        echo "<div class='alert alert-warning mt-5 mx-4 text-center'>No Payment Yet Initiated by this User!!!.</div>";
                    }
                }

                        ?>

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