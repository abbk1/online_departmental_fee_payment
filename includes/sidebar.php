<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Actions</div>
                <a class="nav-link" href="payment.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Payment
                </a>
                <a class="nav-link" href="confirm_payment.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Verify Payment
                </a>
                <a class="nav-link" href="student_edit.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Profile
                </a>
                <a class="nav-link" href="./logout.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-right"></i></div>
                    Log Out
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <span
                class="text-danger fw-bolder"><?= $_SESSION['firstName'] ? $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] : '';  ?></span>
        </div>
    </nav>
</div>