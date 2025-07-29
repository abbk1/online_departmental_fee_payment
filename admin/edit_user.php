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
        if (isset($_GET['id'])) {
            $user_id = $conn->escape_string($_GET['id']);
        } else {
            header("Location: view_users.php");
            exit();
        }

        $sql = "SELECT * FROM `tblusers` WHERE `user_id` = $user_id";
        // $sql = "SELECT * FROM `tblstudents` WHERE `stu_id` = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $lastname = $row["lastName"];
                $firstname = $row["firstName"];
                $othername = $row["othername"];
                $email = $row["email"];
                $phonenumber = $row["phonenumber"];
                $password = $row["password"];
            }
        }
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">UPDATE USER</h3>
                                </div>
                                <div class="mt-2 mx-2" id="alert-container"></div>
                                <div class="card-body">
                                    <form action="" method="post" id="myForm">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="firstName" type="text"
                                                        name="firstName" value="<?= $firstname ? $firstname : ''; ?>"
                                                        placeholder="Enter your first name" />
                                                    <label for="firstName">First name</label>
                                                </div>
                                                <span class="error" id="firstNameErr"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="lastName" type="text"
                                                        name="lastName" value="<?= $lastname ? $lastname : ''; ?>"
                                                        placeholder="Enter your last name" />
                                                    <label for="lastName">Last name</label>
                                                </div>
                                                <span class="error" id="lastNameErr"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="othername" type="text"
                                                        value="<?= $othername ? $othername : ''; ?>" name="othername"
                                                        placeholder="Other Name" />
                                                    <label for="othername">Other Name</label>
                                                </div>
                                                <span class="error" id="othernameErr"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-0">
                                                    <input class="form-control" id="email" type="email" name="email"
                                                        value="<?= $email ? $email : ''; ?>"
                                                        placeholder="name@example.com" />
                                                    <label for="email">Email address</label>
                                                </div>
                                                <span class="error" id="emailErr"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-3 mt-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-0">
                                                    <input class="form-control" id="mobile" type="text" name="mobile"
                                                        value="<?= $phonenumber ? $phonenumber : ''; ?>"
                                                        placeholder="0800000000" />
                                                    <label for="mobile">Phone number (0800000000)</label>
                                                </div>
                                                <span class="error" id="mobileErr"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password" type="password"
                                                        value="<?= $password ? $password : ''; ?>" name="password"
                                                        placeholder="Create a password" />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                                <span class="error" id="passwordErr"></span>
                                            </div>
                                        </div>

                                        <div class="">
                                            <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>">
                                        </div>
                                        <span class="error" id="pwd-confirmErr"></span>
                                        <div class="mt-4 mb-0">
                                            <input class="btn btn-primary" id="submit-button" name="submit"
                                                type="submit" value="UPDATE USER" />
                                        </div>
                                    </form>
                                </div>
                                <!-- <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // modal form validation
                    const myForm = document.getElementById("myForm");
                    const firstNameErr = document.getElementById("firstNameErr");
                    const lastNameErr = document.getElementById("lastNameErr");
                    const emailErr = document.getElementById("emailErr");
                    const mobileErr = document.getElementById("mobileErr");
                    const passwordErr = document.getElementById("passwordErr");
                    const othernameErr = document.getElementById("othernameErr");

                    myForm.addEventListener("submit", function(e) {
                        e.preventDefault();

                        var firstName = document.getElementById("firstName").value;
                        var lastName = document.getElementById("lastName").value;
                        var email = document.getElementById("email").value;
                        var mobile = document.getElementById("mobile").value;
                        var othername = document.getElementById("othername").value;
                        var password = document.getElementById("password").value;
                        var user_id = document.getElementById("user_id").value;

                        var isTrue = true;

                        function hasNumbersOrSymbols(name) {
                            return /[0-9!@#$%^&*(),.?":{}|<>]/.test(name);
                        }

                        function isValidNigerianPhone(phone) {
                            // Regex allows:
                            // - Local format: 08063044690 (starts with 0, followed by 10 digits)
                            // - International format: +2348063044690 (starts with +234, followed by 10 digits)
                            const phoneRegex = /^(0\d{10}|\+234\d{10})$/;
                            return phoneRegex.test(phone);
                        }



                        if (firstName == "") {
                            firstNameErr.textContent = "Enter first name";
                            isTrue = false;
                        }
                        if (hasNumbersOrSymbols(firstName)) {
                            firstNameErr.textContent = "First name should not contain numbers or symbols";
                            isTrue = false;
                        }
                        if (lastName == "") {
                            lastNameErr.textContent = "Enter last name";
                            isTrue = false;
                        }
                        if (hasNumbersOrSymbols(lastName)) {
                            lastNameErr.textContent = "Last name should not contain numbers or symbols";
                            isTrue = false;
                        }
                        if (email == "") {
                            emailErr.textContent = "Enter email";
                            isTrue = false;
                        }
                        if (mobile == "") {
                            mobileErr.textContent = "Enter Phone number";
                            isTrue = false;
                        }
                        if (!isValidNigerianPhone(mobile)) {
                            mobileErr.textContent = "Enter a valid Nigerian phone number";
                            isTrue = false;
                        }


                        if (password == "") {
                            passwordErr.textContent = "Enter password";
                            isTrue = false;
                        }


                        if (isTrue) {
                            const formdata = new FormData(myForm);
                            fetch("edit_user_exe.php", {
                                    method: "POST",
                                    body: formdata
                                })
                                .then((response) => response.json())
                                .then((data) => {

                                    const alertContainer = document.getElementById("alert-container");

                                    if (data.success) {

                                        const submitButton = document.getElementById('submit-button');
                                        submitButton.disabled = true;
                                        submitButton.innerHTML = 'Updating...';

                                        alertContainer.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;

                                        // Redirect after a delay
                                        setTimeout(() => {
                                            location.reload();
                                            // window.location.href = "view_students.php"; // Redirect to view students page
                                            // submitButton.disabled = false;
                                        }, 3000); // Redirect after 3 seconds

                                    } else {
                                        // Show failure alert

                                        alertContainer.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Failed to submit the form. ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
                                    }
                                }).catch(((error) => {

                                    console.log("Error submitting the form", error);
                                }))

                        }
                    });
                </script>





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