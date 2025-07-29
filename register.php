<?php require_once("includes/header.php") ?>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="" id="alert-container"></div>
                                <div class="card-body">
                                    <form action="" method="post" id="myForm">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="firstName" type="text"
                                                        name="firstName" placeholder="Enter your first name" />
                                                    <label for="firstName">First name</label>
                                                </div>
                                                <span class="error" id="firstNameErr"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="lastName" type="text"
                                                        name="lastName" placeholder="Enter your last name" />
                                                    <label for="lastName">Last name</label>
                                                </div>
                                                <span class="error" id="lastNameErr"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-0">
                                                    <input class="form-control" id="email" type="email" name="email"
                                                        placeholder="name@example.com" />
                                                    <label for="email">Email address</label>
                                                </div>
                                                <span class="error" id="emailErr"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-0">
                                                    <input class="form-control" id="mobile" type="text" name="mobile"
                                                        placeholder="0800000000" />
                                                    <label for="mobile">Phone number (0800000000)</label>
                                                </div>
                                                <span class="error" id="mobileErr"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-3 mt-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="regNumber" type="text"
                                                        name="regNumber" placeholder="Matric Number" />
                                                    <label for="regNumber">Reg. Number (12D/360001)</label>
                                                </div>
                                                <span class="error" id="regNumberErr"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="username" type="text"
                                                        name="username" placeholder="Create a Username" />
                                                    <label for="username">Username</label>
                                                </div>
                                                <span class="error" id="usernameErr"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password" type="password"
                                                        name="password" placeholder="Create a password" />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                                <span class="error" id="passwordErr"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="passwordConfirm" type="password"
                                                        placeholder="Confirm password" />
                                                    <label for="passwordConfirm">Confirm Password</label>
                                                </div>
                                                <span class="error" id="confirmpwdErr"></span>
                                            </div>
                                        </div>
                                        <span class="error" id="pwd-confirmErr"></span>
                                        <div class="mt-4 mb-0">
                                            <input class="btn btn-primary" id="submit-button" name="submit"
                                                type="submit" value="Create account">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website <?= date("Y") ?></div>
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
    <script>
    // modal form validation
    const myForm = document.getElementById("myForm");
    const firstNameErr = document.getElementById("firstNameErr");
    const lastNameErr = document.getElementById("lastNameErr");
    const emailErr = document.getElementById("emailErr");
    const mobileErr = document.getElementById("mobileErr");
    const regNumberErr = document.getElementById("regNumberErr");
    const usernameErr = document.getElementById("usernameErr");
    const passwordErr = document.getElementById("passwordErr");
    const confirmpwdErr = document.getElementById("confirmpwdErr");
    const pwdconfirmErr = document.getElementById("pwd-confirmErr");

    myForm.addEventListener("submit", function(e) {
        e.preventDefault();

        var firstName = document.getElementById("firstName").value;
        var lastName = document.getElementById("lastName").value;
        var email = document.getElementById("email").value;
        var mobile = document.getElementById("mobile").value;
        var regNumber = document.getElementById("regNumber").value;
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var passwordConfirm = document.getElementById("passwordConfirm").value;

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

        function isValidRegNumber(regNumber) {
            // Regex pattern: 2 digits + 1 letter + "/" + 6 digits (e.g., 12D/360001)
            const regNoRegex = /^\d{2}[A-Za-z]\/\d{6}$/;
            return regNoRegex.test(regNumber);
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
        if (regNumber == "") {
            regNumberErr.textContent = "Enter Reg. Number";
            isTrue = false;
        }
        if (!isValidRegNumber(regNumber)) {
            regNumberErr.textContent = "Enter a valid Reg. Number (e.g., 12D/360001)";
            isTrue = false;
        }
        if (username == "") {
            usernameErr.textContent = "Enter Username";
            isTrue = false;
        }
        if (password == "") {
            passwordErr.textContent = "Enter password";
            isTrue = false;
        }
        if (passwordConfirm == "") {
            confirmpwdErr.textContent = "Enter password";
            isTrue = false;
        }

        if (password != "") {
            if (password.length < 6) {
                passwordErr.textContent = "password must be greater than six digit";
                isTrue = false;
            } else if (password != passwordConfirm) {
                pwdconfirmErr.textContent = "password did not match";
                isTrue = false;
            }

        }



        if (isTrue) {
            const formdata = new FormData(myForm);
            fetch("exe_registration.php", {
                    method: "POST",
                    body: formdata
                })
                .then((response) => response.json())
                .then((data) => {

                    const alertContainer = document.getElementById("alert-container");

                    if (data.success) {

                        const submitButton = document.getElementById('submit-button');
                        submitButton.disabled = true;
                        submitButton.innerHTML = 'Submitting...';

                        alertContainer.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;

                        // Redirect after a delay
                        setTimeout(() => {
                            window.location.href = "login.php"; // Replace with your target URL
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>