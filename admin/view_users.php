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
            <?php
            if (isset($_GET['del_id'])) {
                $stu_id = $conn->real_escape_string($_GET['del_id']);
                $query = "DELETE FROM tblusers WHERE user_id = $stu_id";
                $res = $conn->query($query);
                if ($res) {
                    header("location: view_users.php?status=success");
                    exit();
                }
            }
            ?>
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Users</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">users</li>
                    </ol>
                    <?php
                    if (isset($_GET['status']) && $_GET['status'] == 'success') {
                        echo '
                             <div class="alert alert-success alert-dismissible fade show" role="alert">
                            User successfully deleted!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                            ';
                    }
                    ?>
                    <div class="">
                        <input type="checkbox" name="select-all" id="select-all">
                        <label for="select-all" class="fw-bolder">Select all</label>
                        <input type="button" class="btn btn-primary mb-3" value="Delete">
                        <a href="add_user.php" class="btn btn-primary mb-3">Add User</a>
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
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `tblusers`;";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $user_id = $row["user_id"];
                                            $firstName = $row["firstName"];
                                            $lastName = $row["lastName"];
                                            $othername = $row["othername"];
                                            $email = $row["email"];
                                            $phonenumber = $row["phonenumber"];
                                            $fullname = $firstName . ' ' . $lastName;
                                    ?>
                                            <tr>
                                                <td><input type="checkbox" name="select-all"></td>
                                                <td><?= isset($firstName) ? $firstName : "Nill"; ?></td>
                                                <td><?= isset($lastName) ? $lastName : "Nill"; ?></td>
                                                <td><?= isset($othername) ? $othername : "Nill"; ?></td>
                                                <td><?= isset($email) ? $email : "Nill"; ?></td>
                                                <td><?= isset($phonenumber) ? $phonenumber : "Nill"; ?></td>
                                                <td><a href="edit_user.php?id=<?= isset($user_id) ? $user_id : "Nill"; ?>"
                                                        class="btn btn-warning text-light">Edit</a></td>
                                                <td><a onclick="return confirm('Are you sure you want to continue to delete user: <?= isset($fullname) ? $fullname : ''; ?>')"
                                                        href="view_users.php?del_id=<?= isset($user_id) ? $user_id : "Nill"; ?>"
                                                        class="btn btn-danger text-light">Delete</a></td>
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