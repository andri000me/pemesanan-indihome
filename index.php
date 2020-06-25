<?php 
  // error_reporting(0);
	include 'config/connection.php';
	include 'db/function.php';
  // if ($_SESSION['id_user'] == null) {
  //   echo "<script>alert('Harap login terlebih dahulu');window.location.href='login.php'</script>";
  // }
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
<title>Indihome</title>
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
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<?php include 'include/nav.php'; ?>
	<!-- Home -->

	<div class="home">
		
		<!-- Home Slider -->
		<div class="home_slider_container">
			<div class="owl-carousel owl-theme home_slider">
				<?php $package=mysqli_query($con,"SELECT * from paket order by id_paket desc limit 1");
							$banner=mysqli_fetch_array($package); ?>
				<!-- Slide -->
				<div class="owl-item">
					<div class="home_slider_background" style="background:grey;background-image:url(images/landmark.jpg);"></div>
					<div class="slide_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="slide_content">
										<div class="home_details" style="background: rgba(100,100,100,0.5);">
											<ul class="home_details_list d-flex flex-row align-items-center justify-content-start">
												<!-- <?php $arr=array('internet','tv','tel','kuota','etc');
											for ($i=0; $i < 5; $i++) { 
												if (strlen($banner[$arr[$i]])>0) { ?>
													<li><span><?=$banner[$arr[$i]]?></span></li>
											<?php	}}?> -->
											<li>
													<div class="home_details_image" ><img src="images/icon_1.png" alt=""></div>
													<span> Rp. <?=number_format($banner['harga'])?></span>
												</li>
												<!-- <li>
													<div class="home_details_image"><img src="images/icon_1.png" alt=""></div>
													<span> 650 Ftsq</span>
												</li>
												<li>
													<div class="home_details_image"><img src="images/icon_2.png" alt=""></div>
													<span> 3 Bedrooms</span>
												</li>
												<li>
													<div class="home_details_image"><img src="images/icon_3.png" alt=""></div>
													<span> 2 Bathrooms</span>
												</li> -->
											</ul>
										</div>
										<div class="home_title"><?=$banner['nama_paket']?></div>
										<div class="home_subtitle ml-1">	<?php $arr=array('internet','tv','tel','kuota','etc');
											for ($i=0; $i < 5; $i++) { 
												if (strlen($banner[$arr[$i]])>0) { ?>
													<div><span><?=$banner[$arr[$i]]?></span></div>
											<?php	}}?></div>
										<!-- <div class="home_price">Rp. <?=number_format($banner['harga'])?></div> -->
										<div>
											<form action="products.php" method="GET">
												<input type="hidden" name="product" value="<?=$banner['id_paket']?>">
											<button type="submit" class="search_form_button ml-auto mt-2" style="padding: 16px">SUBSCRIBE NOW</button>
											</form>
										</div>
										<br>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>

	<!-- Home Search -->
	<div class="home_search">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_search_container">
						<div class="home_search_content">
							<form action="search.php" method="GET" class="search_form d-flex flex-row align-items-start justfy-content-start">
								<div class="search_form_content d-flex flex-row align-items-start justfy-content-start flex-wrap">
									<div>
										<select class="search_form_select" name="internet">
											<option disabled selected>Internet</option>
											<?php $pack=mysqli_query($con,"SELECT * from paket order by id_paket desc"); ?>
											<?php while ($opt=mysqli_fetch_array($pack)) {
												$string=$opt["internet"];
												if (strlen($string)>0) {
													echo "<option value='".$string."'>".$string."</option>";
												}
											} ?>
										</select>
									</div>
									<div>
										<select class="search_form_select" name="tv">
											<option disabled selected>TV</option>
											<?php $pack=mysqli_query($con,"SELECT * from paket order by id_paket desc"); ?>
											<?php while ($opt=mysqli_fetch_array($pack)) {
												$string=$opt["tv"];
												if (strlen($string)>0) {
													echo "<option value='".$string."'>".$string."</option>";
												}
											} ?>
										</select>
									</div>
									<div>
										<select class="search_form_select" name="tel">
											<option disabled selected>Telpon</option>
											<?php $pack=mysqli_query($con,"SELECT * from paket order by id_paket desc"); ?>
											<?php while ($opt=mysqli_fetch_array($pack)) {
												$string=$opt["tel"];
												if (strlen($string)>0) {
													echo "<option value='".$string."'>".$string."</option>";
												}
											} ?>
										</select>
									</div>
									<div>
										<select class="search_form_select" name="etc">
											<option disabled selected>Lainnya</option>
											<?php $pack=mysqli_query($con,"SELECT * from paket order by id_paket desc"); ?>
											<?php while ($opt=mysqli_fetch_array($pack)) {
												$string=$opt["etc"];
												if (strlen($string)>0) {
													echo "<option value='".$string."'>".$string."</option>";
												}
											} ?>
										</select>
									</div>
									<div>
										<select class="search_form_select" name="harga">
											<option disabled selected>Harga</option>
											<?php $pack=mysqli_query($con,"SELECT * from paket order by id_paket desc"); ?>
											<?php while ($opt=mysqli_fetch_array($pack)) {
												$string=$opt["harga"];
												if (strlen($string)>0) {
													echo "<option value='".$string."'>Rp. ".number_format($string)."</option>";
												}
											} ?>
										</select>
									</div>
								</div>
								<button class="search_form_button ml-auto">search</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Recent -->
<?php 	
if (isset($_SESSION['NIK'])) {

$sql="SELECT * from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' and subscribe.aktif='Aktif' order by subscribe.time desc";
		$package=mysqli_query($con,$sql);
		if (mysqli_num_rows($package)>0) { ?>


		<div class="recent" id="subscribes">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title">My Subcriptions</div>
					<div class="section_subtitle">Active packages</div>
					<small><label>Monthly cost Rp. <?php
					$duit="SELECT harga from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' and aktif != 'overdue' order by subscribe.time desc";
					$d=mysqli_query($con,$duit);
					$cost=0;
					while ($price = mysqli_fetch_array($d)) {
						$cost = $cost + $price['harga'];
					}
					echo number_format($cost);
					?></label></small>
				</div>
			</div>
			<div class="col-lg-12 row recent_row">
				
							<?php 
							while ($offer=mysqli_fetch_array($package)) { if(strlen($offer['img'])>0){$img=$offer['img'];}else{$img='default.jpg';}?>
							<!-- Slide -->
							<div class="col-lg-4">
								<div class="recent_item">

							<a href="products.php?product=<?=$offer['id_paket']?>">
									<div class="recent_item_inner">
										<div class="recent_item_image">
											<img height="250px" src="images/<?=$img?>" alt="">
											<div class=" property_tag"><a style="color: white" class="
												<?php 
											if ($offer['aktif']=='active'){ echo 'btn btn-success'; }
											elseif ($offer['aktif']=='pending'){ echo 'btn btn-warning'; }
											elseif ($offer['aktif']=='overdue'){ echo 'btn btn-danger'; }
											else{} ?>"><?=strtoupper($offer['aktif'])?></a></div>
										</div>
										<div class="recent_item_body text-center">
											<div class="recent_item_location"><?=$offer['durasi']?></div>
											<div class="recent_item_title"><a href="#"><?=$offer['nama_paket']?></a></div>
											<div class="recent_item_price">Rp. <?=number_format($offer['harga'])?></div>
										</div>
										<div class="recent_item_footer d-flex flex-row align-items-center justify-content-start text-center">
											<?php $arr=array('internet','tv','tel','kuota','etc');
											for ($i=0; $i < 5; $i++) { 
												if (strlen($offer[$arr[$i]])>0) { ?>
													<div><span><?=$offer[$arr[$i]]?></span></div>
											<?php	}
											}
											 ?>
											 
										</div>
									</div>
									</a>
								</div>
							</div>
							<?php } ?>

						</div>
					</div>
					<div class="button recent_button"><a href="products.php">History</a></div>
				</div>

		 <?php }} ?>


		<div class="recent">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title">Recent Offer</div>
					<div class="section_subtitle">Search your dream package</div>
				</div>
			</div>
			<div class="col-lg-12 row recent_row">
				
							<?php $package=mysqli_query($con,"SELECT * from paket order by id_paket desc limit 3");
							while ($offer=mysqli_fetch_array($package)) { if(strlen($offer['img'])>0){$img=$offer['img'];}else{$img='default.jpg';} ?>
							<!-- Slide -->
							<div class="col-lg-4">
								<div class="recent_item">

							<a href="products.php?product=<?=$offer['id_paket']?>">
									<div class="recent_item_inner">
										<div class="recent_item_image">
											<img height="250px" src="images/<?=$img?>" alt="">
											<div class="<?php 
											if ($offer['badge']=='Featured'){ echo 'tag_featured'; }
											elseif ($offer['badge']=='Offer'){ echo 'tag_offer'; }
											elseif ($offer['badge']=='Hottest'){ echo 'tag_hottest'; }
											else ?> property_tag"><a href="#"><?=$offer['badge']?></a></div>
										</div>
										<div class="recent_item_body text-center">
											<div class="recent_item_location"><?=$offer['durasi']?></div>
											<div class="recent_item_title"><a href="#"><?=$offer['nama_paket']?></a></div>
											<div class="recent_item_price">Rp. <?=number_format($offer['harga'])?></div>
										</div>
										<div class="recent_item_footer d-flex flex-row align-items-center justify-content-start text-center">
											<?php $arr=array('internet','tv','tel','kuota','etc');
											for ($i=0; $i < 5; $i++) { 
												if (strlen($offer[$arr[$i]])>0) { ?>
													<div><span><?=$offer[$arr[$i]]?></span></div>
											<?php	}
											}
											 ?>
											 
										</div>
									</div>
									</a>
								</div>
							</div>
							<?php } ?>

						</div>

					</div>
					<div class="button recent_button"><a href="products.php">see more</a></div>
				</div>

	<!-- Cities -->

	<!-- <div class="cities">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title">Find properties in these cities</div>
					<div class="section_subtitle">Search your dream home</div>
				</div>
			</div>
		</div>
		
		<div class="cities_container d-flex flex-row flex-wrap align-items-start justify-content-between">

			<div class="city">
				<img src="images/city_1.jpg" alt="https://unsplash.com/@dnevozhai">
				<div class="city_overlay">
					<a href="#" class="d-flex flex-column align-items-center justify-content-center">
						<div class="city_title">Ibiza Town</div>
						<div class="city_subtitle">Rentals from $450/month</div>
					</a>	
				</div>
			</div>

		</div>
	</div> -->

	<!-- Testimonials -->

	<!-- <div class="testimonials">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title">What our clients say</div>
					<div class="section_subtitle">Search your dream home</div>
				</div>
			</div>
			<div class="row testimonials_row">
				
				<div class="col-lg-4 testimonial_col">
					<div class="testimonial">
						<div class="testimonial_title">Amazing home for me</div>
						<div class="testimonial_text">Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul.</div>
						<div class="testimonial_author_image"><img src="images/testimonial_1.jpg" alt=""></div>
						<div class="testimonial_author"><a href="#">Diane Smith</a><span>, Client</span></div>
						<div class="rating_r rating_r_5 testimonial_rating"><i></i><i></i><i></i><i></i><i></i></div>
					</div>
				</div>


			</div>
		</div>
	</div> -->

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/telkom.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_content d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="newsletter_title_container">
							<div class="newsletter_title">Ingin update informasi paket terbaru?</div>
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
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>