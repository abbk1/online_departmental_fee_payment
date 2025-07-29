<?php
session_start();
if (!isset($_SESSION['is_active']) || $_SESSION['is_active'] !== true) {
    header("Location: login.php"); // Redirects to login
    exit();
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
                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];
                        if ($status == 'success') {
                            echo ' 
                         <div class="row justify-content-center mb-4 mx-4 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">Payment was successful!
                                 <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                            </div>';
                        } else {
                            echo ' 
                         <div class="row justify-content-center mb-4 mx-4 ">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">Something went wrong || Payment was not successful!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                       aria-label="Close"></button>
                       </div>';
                        }
                    }
                    ?>
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-6">
                            <div class="card shadow border-0">
                                <div class="card-header bg-primary text-white text-center">
                                    <h4>Confirm Payment</h4>
                                </div>
                                <div class="card-body">
                                    <form action="confirm_payment_exe.php" method="get">
                                        <div class="mb-3">
                                            <label for="regNumber" class="form-label">Reference Number:</label>

                                            <input type="text" class="form-control" id="regNumber" name="reference">
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">Proceed</button>
                                        </div>

                                    </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>