<?php
session_start();
?>
<x-web-header />

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-end align-items-center">
	<div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

		<!-- Slide 1 -->
		<div class="carousel-item active">
			<div class="carousel-container">
				<h2 class="animate__animated animate__fadeInDown">Introducing....</h2>
				<p class="animate__animated fanimate__adeInUp"><img src="assets/web_img/heroAdNo1.png"
																	alt="Products & Owner" width="90%"></p>
			</div>
		</div>

		<!-- Slide 2 -->
		<div class="carousel-item">
			<div class="carousel-container">
				<h2 class="animate__animated animate__fadeInDown">Women's &amp; Men's Fragrances</h2>
				<p class="animate__animated animate__fadeInUp"><img src="assets/web_img/fragrances_promo.png"
																	width="90%" alt="Fragrances"></p>
			</div>
		</div>

		<!-- Slide 3 -->
		<div class="carousel-item">
			<div class="carousel-container">
				<h2 class="animate__animated animate__fadeInDown">Burning Oils</h2>
				<p class="animate__animated animate__fadeInUp"><img src="assets/web_img/burningOils_promo.png"
																	width="90%" alt="Burning Oilspromotional Ad"></p>
				<a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
			</div>
		</div>

		<a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
			<span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
		</a>

		<a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
			<span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
		</a>

	</div>

	<svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
		 viewBox="0 24 150 28 " preserveAspectRatio="none">
		<defs>
			<path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
		</defs>
		<g class="wave1">
			<use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)"/>
		</g>
		<g class="wave2">
			<use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)"/>
		</g>
		<g class="wave3">
			<use xlink:href="#wave-path" x="50" y="9" fill="#fff"/>
		</g>
	</svg>

</section><!-- End Hero -->

<main id="main">

	<!-- ======= About Section ======= -->

	<section>
		<div class="container-fluid" style="background-color:white">
			<div class="container-lg">
				<div class="row text-center">


				</div>
				<div class="row" id="about">
					<div class="col-lg-5">
						<img src="assets/web_img/coverAd_HWG.png" width="100%" alt="Cover Ad">

						<div class="section-title" data-aos="zoom-out">
							<h2>About</h2>
							<p>Who we are</p>
						</div>

						<h4>Oils chose me before I recognized the path that my life would, later take, in scented oil
							fragrances. I have always found myself drawn to different scents of freshness, clean smells,
							as well as a nice fragrance that enhanced my mood with my appearance – rather around the
							house, or an evening out.
							I love being able to walk into a room and change the aroma until someone asks, “Excuse me
							sir, what do you have on?” It brightens my day! In my doing what I enjoy and love, people
							began to ask me to provide them with what I had, and so, what was once a hobby, has now
							become my business. Thus, birthing, <strong>“Here We Grow UnLymited LLC” </strong>in June
							2020!”
						</h4><br><h4>In maturing, God allowed me to realize that the attraction to the natural oils
							symbolized the spiritual that he has placed on my life.
							The ultimate goal is that when men, women, young men, and ladies wear these fragrances,
							their scent will hopefully match how they feel, and that they are increased in confidence,
							as this business is inspired by God, to inspire others.</h4>
					</div>
					<div class="col-lg-7">
						<img src="assets/web_img/JasonL_CEO.png" height="50%" alt="Jason LeMons">

						<div class="section-title" data-aos="zoom-out">
							<h2>Founder</h2>
							<p>Jason LeMons</p>
							<div class="text-center" style="padding-top:20px">

								<a href="https://www.facebook.com/jason.j.lemons" target="_blank"><h3><i
												class="bi bi-facebook"></i> Like us on Facebook</h3></a>
								<br>
								<a href="https://www.instagram.com/jayboolem/" target="blank"><h3><i
												class="bi bi-instagram"></i> Follow us on Instagram</h3></a>

							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	


	<!-- ======= Portfolio Section ======= -->
	<section id="portfolio" class="portfolio" style="background-color:navajowhite">
		<div class="container">

			<div class="section-title" data-aos="zoom-out">
				<h2>Portfolio</h2>
				<p>Gallery</p>
			</div>

			<ul id="portfolio-flters" class="d-flex justify-content-end" data-aos="fade-up">
				<li data-filter="*" class="filter-active">All</li>
				<li data-filter=".filter-app">App</li>
				<li data-filter=".filter-card">Card</li>
				<li data-filter=".filter-web">Web</li>
			</ul>

			<div class="row portfolio-container" data-aos="fade-up">

				<div class="col-lg-4 col-md-6 portfolio-item filter-app">
					<div class="portfolio-img"><img src="assets/web_img/gallery_img/galleryPhoto1.png" class="img-fluid"
													alt=""></div>
					<div class="portfolio-info">
						<h4>App 1</h4>
						<p>App</p>
						<a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery"
						   class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
						<a href="portfolio-details.html" class="details-link" title="More Details"><i
									class="bx bx-link"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-web">
					<div class="portfolio-img"><img src="assets/web_img/gallery_img/galleryPhoto2.png" class="img-fluid"
													alt=""></div>
					<div class="portfolio-info">
						<h4>Web 3</h4>
						<p>Web</p>
						<a href="assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery"
						   class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
						<a href="portfolio-details.html" class="details-link" title="More Details"><i
									class="bx bx-link"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-app">
					<div class="portfolio-img"><img src="assets/web_img/gallery_img/galleryPhoto3.png" class="img-fluid"
													alt=""></div>
					<div class="portfolio-info">
						<h4>App 2</h4>
						<p>App</p>
						<a href="assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery"
						   class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
						<a href="portfolio-details.html" class="details-link" title="More Details"><i
									class="bx bx-link"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-card">
					<div class="portfolio-img"><img src="assets/web_img/gallery_img/galleryPhoto4.png" class="img-fluid"
													alt=""></div>
					<div class="portfolio-info">
						<h4>Card 2</h4>
						<p>Card</p>
						<a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery"
						   class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
						<a href="portfolio-details.html" class="details-link" title="More Details"><i
									class="bx bx-link"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-web">
					<div class="portfolio-img"><img src="assets/web_img/gallery_img/galleryPhoto5.png" class="img-fluid"
													alt=""></div>
					<div class="portfolio-info">
						<h4>Web 2</h4>
						<p>Web</p>
						<a href="assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery"
						   class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
						<a href="portfolio-details.html" class="details-link" title="More Details"><i
									class="bx bx-link"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-app">
					<div class="portfolio-img"><img src="assets/web_img/gallery_img/galleryPhoto6.png" class="img-fluid"
													alt=""></div>
					<div class="portfolio-info">
						<h4>App 3</h4>
						<p>App</p>
						<a href="assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery"
						   class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
						<a href="portfolio-details.html" class="details-link" title="More Details"><i
									class="bx bx-link"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-card">
					<div class="portfolio-img"><img
								src="../hwg-unlymited.com/assets/web_img/8111b6593b8bb416799f03b864347d101603b9b5-1.jpg"
								class="img-fluid" alt=""></div>
					<div class="portfolio-info">
						<h4>Card 1</h4>
						<p>Card</p>
						<a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery"
						   class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
						<a href="portfolio-details.html" class="details-link" title="More Details"><i
									class="bx bx-link"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-card">
					<div class="portfolio-img"><img src="assets/web_img/gallery_img/galleryPhoto7.png" class="img-fluid"
													alt=""></div>
					<div class="portfolio-info">
						<h4>Card 3</h4>
						<p>Card</p>
						<a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery"
						   class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
						<a href="portfolio-details.html" class="details-link" title="More Details"><i
									class="bx bx-link"></i></a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 portfolio-item filter-web">
					<div class="portfolio-img"><img src="assets/web_img/gallery_img/galleryPhoto8.png" class="img-fluid"
													alt=""></div>
					<div class="portfolio-info">
						<h4>Web 3</h4>
						<p>Web</p>
						<a href="assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery"
						   class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
						<a href="portfolio-details.html" class="details-link" title="More Details"><i
									class="bx bx-link"></i></a>
					</div>
				</div>

			</div>

		</div>
	</section><!-- End Portfolio Section -->

    <x-testimonials />

	<!-- ======= Contact Section ======= -->
	<section id="contact" class="team">
		<div class="container">

			<div class="section-title" data-aos="zoom-out">
				<h2>Contact</h2>
				<p>Contact Us</p>
			</div>

			<div class="row mt-5">

				<div class="col-lg-4" data-aos="fade-right">
					<div class="info">

						<div class="email">
							<i class="bi bi-envelope"></i>
							<h4>Email:</h4>
							<p><a href="mailto:jason@hwg-unlymited.com">jason@hwg-unlymited.com</a></p>
							<p><a href="mailto:brunetta@hwg-unlymited.com">brunetta@hwg-unlymited.com</a></p>
						</div>

						<div class="phone">
							<i class="bi bi-phone"></i>
							<h4>Call:</h4>
							<p>(725)-696-2226</p>
						</div>

					</div>

				</div>

				<div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">

					<form action="contact.php" method="POST">
						<div class="row">
							<div class="col-md-6 form-group">
								<input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
									   required>
							</div>
							<div class="col-md-6 form-group mt-3 mt-md-0">
								<input type="email" class="form-control" name="email" id="email"
									   placeholder="Your Email" required>
							</div>
						</div>
						<div class="form-group mt-3">
							<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
								   required>
						</div>
						<div class="form-group mt-3">
							<textarea class="form-control" name="message" rows="5" placeholder="Message"
									  required></textarea>
						</div>

						<div class="form-group form-control-lg">
							<p><strong>I am not a robot? Check here:
									<bi class="bi-arrow-right"></bi>&nbsp;</strong><input type="checkbox"
																						  name="notARobot"/></p>

						</div>

						<div class="text-center" style="padding-top:35px">
							<button name="contactSubmit">Send Message</button>
							<br/>
						</div>
					</form>

				</div>

			</div>

		</div>
	</section><!-- End Contact Section -->

</main><!-- End #main -->
<x-disclaimer />
<x-web-footer />