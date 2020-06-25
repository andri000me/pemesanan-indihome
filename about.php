<?php 
	include 'config/connection.php';

if (isset($_POST['email'])) {
	$subscribe= mysqli_query($con,"INSERT INTO inquiry (email) values ('$_POST[email]')");
	if ($subscribe) {
		$_SESSION['subscribe']=1;
	}
}
  if (isset($_GET['logout'])) {
    session_destroy();
    header('Location:login.php');
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>About us</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Bluesky template project">
<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="images/favicon.png">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/about.css">
<link rel="stylesheet" type="text/css" href="styles/about_responsive.css">

<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<?php include 'include/nav.php'; ?>

	<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/about.jpg" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content d-flex flex-row align-items-end justify-content-start">
							<div class="home_title">About</div>
							<div class="breadcrumbs ml-auto">
								<ul>
									<li><a href="index.htmo">Home</a></li>
									<li>About</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- About -->

	<div class="about">
		<div class="container">
			<div class="row">

				<div class="col-lg-2"></div>
				<!-- About Content -->
				<div class="col-lg-8">
					<center>	
					<div class="about_content">
						<div class="section_title">Apa Itu IndiHome?</div>
						<div class="section_subtitle">Kenali IndiHome sekarang</div>
						<div class="about_image" style="margin-top: 12px;"><img src="https://www.indihome.co.id/assets/images/pusatbantuan/illus.svg" alt=""></div>
						<div class="about_text text-justify">
							<p>Layanan digital yang menyediakan Internet Rumah, Telepon Rumah dan TV Interaktif (IndiHome TV) dengan beragam pilihan paket. Saat ini, jaringan IndiHome sudah tersebar di seluruh wilayah Indonesia, dan terus berinovasi untuk memenuhi kebutuhan internet yang lebih baik bagi masyarakat.</p>
						</div>
					</div>
					</center>
				</div>

				<!-- About Image -->
				<div class="col-lg-2"></div>
			</div>
			<div class="row milestones_row">

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone d-flex flex-row align-items-center justify-content-start">
						<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="images/milestones_1.png" alt=""></div>
						<?php $num=mysqli_num_rows(mysqli_query($con,"SELECT * from Customer group by kecamatan")); ?>
						<div class="milestone_content">
							<div class="milestone_counter" data-end-value="<?=$num?>">0</div>
							<div class="milestone_text">Zona Terjangkau</div>
						</div>
					</div>
				</div>

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone d-flex flex-row align-items-center justify-content-start">
						<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="images/milestones_2.png" alt=""></div>
						<?php $num=mysqli_num_rows(mysqli_query($con,"SELECT * from Customer")); ?>
						<div class="milestone_content">
							<div class="milestone_counter" data-end-value="<?=$num?>">0</div>
							<div class="milestone_text">Happy Customer</div>
						</div>
					</div>
				</div>

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone d-flex flex-row align-items-center justify-content-start">
						<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="images/milestones_3.png" alt=""></div>
						<?php $num=mysqli_num_rows(mysqli_query($con,"SELECT * from subscribe")); ?>
						<div class="milestone_content">
							<div class="milestone_counter" data-end-value="<?=$num?>">0</div>
							<div class="milestone_text">Subscibes</div>
						</div>
						
					</div>
				</div>

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone d-flex flex-row align-items-center justify-content-start">
						<div class="milestone_icon d-flex flex-column align-items-center justify-content-center"><img src="images/milestones_4.png" alt=""></div>
						<?php $num=mysqli_num_rows(mysqli_query($con,"SELECT * from paket")); ?>
						<div class="milestone_content">
							<div class="milestone_counter" data-end-value="<?=$num?>">0</div>
							<div class="milestone_text">Paket Terpercaya</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


	<!-- Newsletter -->

	
	<div class="newsletter">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/telkom.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_content d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="newsletter_title_container">
							<div class="newsletter_title">Ingin berlangganan berita dan paket terbaru?</div>
							<div class="newsletter_subtitle">Cari paket impianmu</div>
						</div>
						<div class="newsletter_form_container">
							<form method="POST" class="newsletter_form">

								<input type="email" class="newsletter_input" name="email" placeholder="Your e-mail address" required="required">
								<button type="submit" name="subscribe" class="newsletter_button">subscribe now</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Footer -->

	<footer class="footer">
		<div class="footer_bar">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_bar_content d-flex flex-row align-items-center justify-content-start">
							<div class="cr">
								&copy;<script>document.write(new Date().getFullYear());</script> <a href="https://github.com/pottsed">Pottsed</a> | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/about.js"></script>
</body>
</html>