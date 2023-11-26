<?php
include 'databaseQuery.php';
if ($_SESSION['loggedIn'] === FALSE) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>HWG Unlymited</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="customStyles.css" rel="stylesheet" type="text/css">

    <!-- =======================================================
    * Template Name: Selecao - v4.1.0
    * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body style="background-color:#101115">

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h1><a href="index.php"><img src="assets/web_img/hwg_logo101721.png" alt="Company Logo"></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="index.php#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="index.php#about">About</a></li>

                <li class="dropdown"><a href="#products"><span>Products</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="index.php#womens_collection">Women's Fragrances</a></li>
                        <li><a href="index.php#mens_collection">Men's Fragrances</a></li>
                        <li><a href="index.php#burning_oils">Burning Oils &amp; Burners</a></li>

                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="hwgCart.php">Cart</a></li>
                <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                <li><a class="nav-link scrollto" href="login.php">Contact</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->


<main id="main">

    <div class="row container-fluid"
         style="background-color:whitesmoke;margin-top:100px;margin-bottom:100px;padding-bottom:25px">
        <div class="col-3 text-center">
            <div class="container" style="margin-top:25px">
                <img src="assets/web_img/hwg_logo101721.png" width="200px" alt="Company Logo"/>
                <h3 style="color:dimgrey">Management Console</h3>
                <p>
                    <?php
                    echo "Welcome, &nbsp; <strong style='color:orangered'>" . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</strong>";
                    ?>
                </p>
                <table class="text-center" style="background-color:lightgrey;width:100%" ;>
                    <tr>
                        <td style="padding:15px">
                            <a href="orders_console.php?statusQuery=PENDING">
                                <button style="width:100%" class="btn btn-primary btn-lg">
                                    <bi class="bi-cart-plus">&nbsp;</bi>
                                    Orders
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>

                        <td style="padding:15px">
                            <a href="inventory_console.php">
                                <button style="width:100%" class="btn btn-primary btn-lg" width="100%">
                                    <bi class="bi-box">&nbsp;</bi>
                                    Inventory
                                </button>
                            </a>
                        </td>

                    </tr>
                    <tr>
                        <a href="#">
                            <td style="padding:15px">
                                <button style="width:100%" class="btn btn-primary btn-lg active" width="100%">
                                    <bi class="bi-person-circle">&nbsp;</bi>
                                    User Management
                                </button>
                            </td>
                        </a>
                    </tr>
                    <tr>

                        <td style="padding:15px">
                            <a href="login.php?loginStatus=CHECK">
                                <button style="width:100%" class="btn btn-warning btn-lg" width="100%">Logout</button>
                            </a>
                        </td>

                    </tr>
                </table>
            </div>


        </div>
        <div class="col-lg-8">
            <h1>Delete User? </h1>
            <h2><?php echo $_GET['firstName'] . ' ' . $_GET['lastName']; ?></h2>

            <br />
            <a href="manageUsers.php">
                <button class="btn btn-warning btn-lg"><bi class="bi-arrow-90deg-left"></bi> &nbsp; Go Back</button>
            </a>
            <br />

            <form method="POST" action="">
                <div class="form-control">
                    <div class="text-center"><h3>Are you sure? </h3>
                        <button class="btn btn-lg btn-danger" name="yesBtn">Yes</button>

                        <br />

                        <?php
                        if (isset($_POST['yesBtn'])){
                            $deleteQuery = 'DELETE FROM loginUsers WHERE userID = "'.$_GET['userID'].'";';
                            updateQuery($deleteQuery);
                        }

                        ?>

                    </div>
                </div>
            </form>
        </div>

    </div>

</main>


<!-- Vendor JS Files -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>


</body>

</html>//7