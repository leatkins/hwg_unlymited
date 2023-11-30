<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>HWG Unlymited</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="{{asset('assets/img/favicon.png')}}" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
		  rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="{{asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('public/assets/app-0ce2a50e.css')}}">

	<!-- Template Main CSS File -->
	<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('customStyles.css')}}" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/77e9e84f23.js" crossorigin="anonymous"></script>

	<!-- =======================================================
    * Template Name: Selecao - v4.1.0
    * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center  header-transparent">
	<div class="container d-flex align-items-center justify-content-between">

		<div class="logo">
			<h1><a href="./"><img src="{{asset('assets/web_img/hwg_logo101721.png')}}" class="img-fluid"
										 alt="Company Logo"></a></h1>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
		</div>

		<nav id="navbar" class="navbar">
			<ul>
				<li><a class="nav-link scrollto" href="/">Home</a></li>
				<li><a class="nav-link scrollto" href="/#about">About</a></li>

				<li class="dropdown"><a href="./products"><span>Products</span> <i class="bi bi-chevron-down"></i></a>
					<ul>
						<li><a href="./products?categorySelection=Women+Roll-On+Fragrance">Women's Fragrances</a></li>
						<li><a href="./products?categorySelection=Men+Roll-On+Fragrance">Men's Fragrances</a></li>
						<li><a href="./products?categorySelection=Burning+Oil">Burning Oils &amp; Burners</a></li>

					</ul>
				</li>

				<li>
					<a class="nav-link scrollto" href="./cart">
						<i class="fa-sharp fa-solid fa-cart-shopping"></i> &nbsp;
						@if(!empty(session()->get('lineItems')))
							<span style="background-color:#fa3e3e; border-radius: 10em; color: white; padding:5px"><strong>{{count(session()->get('lineItems'))}}</strong></span>
						@endif
					</a>

				</li>

				<li><a class="nav-link scrollto" href="./#contact">Contact</a></li>
				<li><a class="nav-link scrollto" href="/login">Login</a></li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav><!-- .navbar -->

	</div>
</header><!-- End Header -->
