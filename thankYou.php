<?php
session_start();
include 'lineItems.php';
if (!isset($_SESSION['lineItems'])) {
    $_SESSION['lineItems'] = [];
}

if (isset($_POST['submitOrder'])){

    $orderData2 = json_decode($_POST['orderObject']);

    //Discovered Variables
    $firstName = $orderData2 -> payer -> name -> given_name;
    $lastName = $orderData2 -> payer -> name -> surname;
    $emailAddress = $orderData2 -> payer -> email_address;
    $shipAddress = $orderData2 -> purchase_units[0] -> shipping -> address -> address_line_1;
    $shipAddress2 = $orderData2 -> purchase_units[0] -> shipping -> address -> address_line_2;
    //City
    $shipCity = $orderData2 -> purchase_units[0] -> shipping -> address -> admin_area_2;
    //State
    $shipState = $orderData2 -> purchase_units[0] -> shipping -> address -> admin_area_1;
    //Postal Code
    $shipZipCode = $orderData2 -> purchase_units[0] -> shipping -> address -> postal_code;

    include 'checkOutScript.php';
    submitOrder($firstName, $lastName, $emailAddress, $shipAddress, $shipAddress2, $shipCity,  $shipState, $shipZipCode );
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

    <script src="https://www.paypal.com/sdk/js?client-id=AUmSN7a1kL3_OxZ3-1jkvope1uPNgRDvAn1_4EGOvgAYjDXdmLcMEHpP1K12lOG6dFvMufFNGwa8LYnM&currency=USD"></script>
</head>

<body style="background-color:#101115">

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h1><a href="index.php"><img src="assets/web_img/hwg_logo101721.png" class="img-fluid"
                                         alt="Company Logo"></a></h1>
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
                <li><a class="nav-link scrollto active" href="hwgCart.php">Cart</a></li>
                <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                <li><a class="nav-link scrollto" href="login.php?loginStatus=CHECK">Login</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->


<main id="main">

    <!-- Shopping Cart -->
    <section style="margin-top:75px;background-color:white" id="cart">
        <div class="container-fluid">
            <div class="container-lg">
                <div class="section-title" data-aos="zoom-out">
                    <h2>Here We Grow UnLymited </h2>
                    <p>Thank you!</p>


                </div>
                <h4 style="color:orangered">Your order has been successfully processed</h4>

                <button class="btn btn-success" onclick="window.print()"><bi class="bi-printer-fill"></bi>&nbsp; Print Page</button>

                <div style="text-align:right;padding-top:20px">



                    <br>
                    <p><strong>ORDER NUMBER: </strong><?php echo $_SESSION['customerOrderInfo'][8]; ?></p><hr />
                    <p><strong>SHIP TO:  </strong><?php echo $_SESSION['customerOrderInfo'][0] . " ". $_SESSION['customerOrderInfo'][1]; ?> |<bi class="bi-envelope-open"></bi> <span style="color:orangered"><?php echo $_SESSION['customerOrderInfo'][2]; ?></span></p>
                    <p><?php echo $_SESSION['customerOrderInfo'][3] . " ". $_SESSION['customerOrderInfo'][4]; ?></p>
                    <p><?php echo $_SESSION['customerOrderInfo'][5] . ", ". $_SESSION['customerOrderInfo'][6]. " ". $_SESSION['customerOrderInfo'][7]; ?></p>

                </div>

                <h4><strong>PRODUCTS ORDERED</strong></h4>

                <hr>
                <!-- Cart Items Go Here -->
                <h1 id="emptyCart"></h1>
                <div id="theCart" class="container"></div>
                <?php
                function addToSession($x)
                {
                    array_push($_SESSION['lineItems'], $x);
                    return $_SESSION['lineItems'];
                }

                if (isset($_POST['addToCart'])) {
                    $customerRequest = new ProductOrder
                    (
                        $_POST['productID'],
                        $_POST['prodName'],
                        $_POST['prodDescription'],
                        $_POST['quantity']
                    );

                    $customerRequest->setItemPrice($_POST['price'], $_POST['quantity']);
                    $myJSON = json_encode($customerRequest);
                    $lineItemData = (array)json_decode($myJSON);
                    addToSession($lineItemData);

                }
                if (!empty($_SESSION['lineItems'])) {
                    $subTotal = 0;
                    $handlingFee = 5.99;
                    $taxRate = 0.081;
                    $cartDisplay = $_SESSION['lineItems'];
                    foreach ($cartDisplay as $row) {
                        echo '<table style="width:100%">
                                <tr style="padding-top:25px;border-bottom:black;border-style:solid">';
                        foreach ($row as $item => $value) {
                            if ($item === 'productID') {
                                $item = '';
                                $value = '<img src="dbImages/' . $value . '.png" height="100px" alt="product">';
                            }
                            if ($item === 'productName') {
                                $item = 'Product';
                            }
                            if ($item === 'lineTotal') {
                                $item = 'Line Total';
                                $subTotal = $subTotal + $value;
                                $taxes = $subTotal * $taxRate;
                                $taxAmount = number_format($taxes, 2);
                                $value = number_format($value, 2);
                            }
                            if ($item === 'prodDescription') {
                                $item = 'Description';
                            }
                            if ($item === 'quantity') {
                                $item = "QTY";
                            }
                            if ($item === 'itemPrice') {
                                $item = 'Price';
                                $value = number_format($value, 2);
                            }
                            echo '<td><strong>' . $item . '</strong> <span style="color:orangered">|</span> ' . $value . '</td>';
                        }

                        echo '</tr></table>';
                    }
                    $grandTotal = $handlingFee + $subTotal + $taxes;
                    $_SESSION['grandTotal'] = $grandTotal;
                    echo '<div class="container-sm" style="padding-top:100px;padding-left:75%;text-align:right">
                                    <h4><span style="color:orangered">Sub Total:&nbsp; </span>$' . number_format($subTotal, 2) . '</h4>
                                     <h4><span style="color:orangered">Tax:&nbsp; </span>$' . number_format($taxes, 2) . '</h4>
                                    <h4><span style="color:orangered">S &amp; H: &nbsp;</span>$' . number_format($handlingFee, 2) . '</h4>
                                    <h4><span style="color:orangered"><strong>Grand Total:</strong> &nbsp; </span>$' . number_format($grandTotal, 2) . '</h4>
                                    <input type="hidden" id="payPalGrandTotal" value="' . $grandTotal . '"/>
                             </div>';
                }
                ?>


            </div>
        </div>
    </section>

    <section id="customerForm" style="background-color:whitesmoke">
        <div class="container-sm">

        </div>
    </section>

    <section class="disclaimer" style="background-color:#FC4A1A">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
                <h2>Disclaimer</h2>

            </div>

            <div class="row content" data-aos="fade-up">
                <div class="col-lg-6">
                    <p>
                        <strong>(Here We Grow UnLymited-HWG)</strong> Fragrances have no affiliation with designers nor
                        manufacturers with our oil types.
                        (HWG) (Fragrance oil types consist of essential oil mixtures to smell similar, but are not the
                        original colognes or perfumes. It is a perfume oil version of a designer scent only. </p>
                    <p>The designer name(s) are trademarked and belong to the original manufacturer. The copyrights and
                        trademarks do not belong to <strong>(HWG)</strong> Fragrances but to the manufacturer(s) and/or
                        designer(s). We do not claim that our oils are the originals, only to be compared.</p>
                    <p><strong>(HWG)</strong> Fragrances have no intention to mislead the customer into believing that
                        our oils are original, or to infringe on the manufacture(s) or designer(s) name. </p>


                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <p>
                        Our website <strong>(HWG)</strong> is in compliance with the Federal Trade Commission’s
                        statement of policy regarding comparative advertising.
                        Directions for use of roll on: Place bottle in one hand and in the palm of the other hand, in a
                        tilted position roll the ball in a circular motion to distribute fragrance.
                        Do not: Roll or spray directly onto clothing. These body oils are not meant to be applied
                        directly to clothing (especially fragile fabrics such as silk and satin.)
                        Improper use: Laying bottle on side, upside down for an extended period of time, placing bottles
                        in direct heat, rolling the ball against body extremities excessively instead of in the palm of
                        your hand, and not closing securely.
                    </p>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Contact Section ======= -->
    <!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <img src="assets/web_img/hwg_logo101721.png" width="200px" alt="Company logo">
        <p>I have planted, Apollos watered; but God gave the increase. <br>1 Corinthians 3:6kjv</p>
        <div class="social-links">

            <a href="https://www.facebook.com/jason.j.lemons" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://www.instagram.com/jayboolem/" class="instagram"><i class="bx bxl-instagram"></i></a>

        </div>
        <div class="copyright">
            &copy; Copyright <strong><span>Selecao</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/selecao-bootstrap-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="js/duplicateAddress.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>


</body>

</html>