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
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-6">
                            <div class="card shadow border-0">
                                <div class="card-header bg-primary text-white text-center">
                                    <h4>Make a Payment</h4>
                                </div>
                                <div class="card-body">
                                    <form action="process_payment.php" method="post">
                                        <div class="mb-3">
                                            <label for="studentId" class="form-label">Student ID:</label>
                                            <input type="text" class="form-control" id="studentId" name="studentId"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount:</label>
                                            <input type="number" class="form-control" id="amount" name="amount"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="paymentMethod" class="form-label">Payment Method:</label>
                                            <select class="form-control" id="paymentMethod" name="paymentMethod"
                                                required>
                                                <option value="credit_card">Credit Card</option>
                                                <option value="paypal">PayPal</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                            </select>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">Submit Payment</button>
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