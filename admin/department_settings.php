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

            if (isset($_POST['submit'])) {
                $session = $_POST['session'];
                $fees = $_POST['fees'];
                $errors = [];
                if (empty($session)) {
                    $errors[] = "Session is required";
                    $submit_data = false;
                }
                if (empty($fees)) {
                    $errors[] = "Fees is required";
                    $submit_data = false;
                }
                if (empty($errors)) {
                    $sql = "UPDATE `tblfees` SET `session`='$session',`fee`='$fees' WHERE `id`=1";
                    // Assuming you want to update the first record, you can change the WHERE clause as needed.
                    // If you want to insert a new record instead, use INSERT INTO instead of UPDATE.
                    // For example:
                    // $sql = "INSERT INTO `tblfees` (`session`, `fee`) VALUES ('$session', '$fees')";
                    if ($conn->query($sql) === TRUE) {
                        $submit_data = true;
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
                        $submit_data = false;
                    }
                }
            }


            ?>
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Department Details</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department Settings</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="row mx-2">
                            <div class="col-md-6 my-4">
                                <?php
                                if (isset($errors) && !empty($errors)) {
                                    echo "
                                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                        There were errors in your submission:
                                        <br>
                                        Please check your input.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'
                                            aria-label='Close'></button>
                                    </div>
        ";
                                }
                                if (isset($submit_data) && $submit_data === true) {
                                    echo "
                                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Data updated successfully!
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'
                                            aria-label='Close'></button>
                                    </div>
                                     ";
                                }

                                ?>
                                <form action="" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon2">Session</span>
                                        <input type="text" name="session" class="form-control"
                                            placeholder="eg. 2023/2024" aria-label="Session"
                                            aria-describedby="basic-addon2">
                                    </div>
                                    <div class="input-group mt-3 mb-3">
                                        <span class="input-group-text">Fees</span>
                                        <input type="number" name="fees" class="form-control" placeholder="eg. 2000"
                                            aria-label="Dollar amount (with dot and two decimal places)">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Update">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 my-4 ">
                                <table class="table table-hover">



                                    <caption>Department Fees</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Session</th>
                                            <th scope="col">Fees</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `tblfees`";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $count = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                        <th scope='row'>" . $count . "</th>
                                                        <td>" . $row['session'] . "</td>
                                                        <td>" . $row['fee'] . "</td>
                                                    </tr>";
                                                $count++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No fees found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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