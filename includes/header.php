<?php ob_start(); ?>
<?php include("db.php") ?>
< <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dep. Fee Payment</title>
        <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->
        <link rel="stylesheet" href="css/style.min.css">
        <link href="css/styles.css" rel="stylesheet" />
        <!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


        <script src="js/all.js"></script>
        <script src="js/jquery.js"></script>
        <style>
        .title-img {
            background-image: url("assets/img/dep_image.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            height: 300px;
            /* opacity: 0.5; */

            animation: fade 8s ease-in-out infinite;
            /* Adjust duration and timing function as needed */

        }

        .card1 {
            background-image: url("assets/img/logo.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            height: 300px;
            /* opacity: 0.5; */
            /* Adjust duration and timing function as needed */

        }

        .error {
            color: red;
        }

        /* Keyframes for the animation */
        @keyframes fade {
            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }
        </style>
    </head>