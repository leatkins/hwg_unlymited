<?php
include 'databaseQuery.php';
include 'lineItems.php';
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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
            <li><a class="nav-link scrollto active" href="hwgCart.php">Cart</a></li>
          <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
            <li><a class="nav-link scrollto" href="login.php">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

 

  <main id="main">

     <!-- Single Product Display Section -->
    <section style="margin-top:75px;background-color:white" id="cart">
        <div class="container-fluid">
            <div class="container-sm">
               <!-- Product Content Starts Here -->
                <?php
                    $showProductQuery = 'SELECT * FROM products WHERE productID ="'.$_GET['productID'].'";';
                    displaySingleProd($showProductQuery);

                ?>


                <hr>
              <div class="text-center">
                  <a href="index.php#products">
                      <button class="btn btn-lg btn-outline-warning">Go Back</button>
                  </a>
              </div>
            </div>
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
             <strong>(Here We Grow UnLymited-HWG)</strong> Fragrances have no affiliation with designers nor manufacturers with our oil types.
 (HWG) (Fragrance oil types consist of essential oil mixtures to smell similar, but are not the original colognes or perfumes. It is a perfume oil version of a designer scent only. </p>
<p>The designer name(s) are trademarked and belong to the original manufacturer. The copyrights and trademarks do not belong to <strong>(HWG)</strong> Fragrances but to the manufacturer(s) and/or designer(s). We do not claim that our oils are the originals, only to be compared.</p>
<p><strong>(HWG)</strong>  Fragrances have no intention to mislead the customer into believing that our oils are original, or to infringe on the manufacture(s) or designer(s) name. </p>

            
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p> 
Our website <strong>(HWG)</strong> is in compliance with the Federal Trade Commission’s statement of policy regarding comparative advertising.
Directions for use of roll on: Place bottle in one hand and in the palm of the other hand, in a tilted position roll the ball in a circular motion to distribute fragrance.
Do not: Roll or spray directly onto clothing. These body oils are not meant to be applied directly to clothing (especially fragile fabrics such as silk and satin.)
Improper use: Laying bottle on side, upside down for an extended period of time, placing bottles in direct heat, rolling the ball against body extremities excessively instead of in the palm of your hand, and not closing securely.
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

</html>