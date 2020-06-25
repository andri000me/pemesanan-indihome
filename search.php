<?php 
  // error_reporting(0);
	include 'config/connection.php';

  // if ($_SESSION['id_user'] == null) {
  //   echo "<script>alert('Harap login terlebih dahulu');window.location.href='login.php'</script>";
  // }
	
if (!isset($_GET['gateway'])) {
 	$sql="SELECT * from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' and paket.id_paket='$_GET[product]' order by subscribe.time desc";
	$subscribe=mysqli_query($con,$sql);
	$subs=mysqli_fetch_array($subscribe);
	if (mysqli_num_rows($subscribe)>0) {
		if ($subs['aktif']=='pending' && isset($_GET['gateway'])) {

		}elseif ($subs['aktif']=='pending' && !isset($_GET['gateway'])) {
			mysqli_query($con,"DELETE FROM subscribe where NIK='$_SESSION[NIK]' and id_paket='$_GET[product]' and aktif='pending'");
		}
 	}
 }
if (isset($_POST['email'])) {
	$subscribe= mysqli_query($con,"INSERT INTO inquiry (email) values ('$_POST[email]')");
	if ($subscribe) {
		$_SESSION['subscribe']=1;
	}
}elseif (isset($_GET['unsubscribe'])) {
	$subscribe= mysqli_query($con,"UPDATE subscribe set aktif='down' where id_subscribe='$_GET[unsubscribe]' and NIK='$_SESSION[NIK]'");
	mysqli_query($con,"DELETE from subscribe where id_subscribe='$_GET[unsubscribe]' and aktif='down'");
	header('location: products.php');
}elseif (isset($_POST['subscribe'])) {
	$subscribe= mysqli_query($con,"INSERT INTO subscribe (NIK,id_paket,aktif,_token) values ('$_SESSION[NIK]','$_POST[paket]','pending','$_POST[_token]')");
	if ($subscribe) {
		$kontlo="SELECT * from subscribe where NIK = '$_SESSION[NIK]' and id_paket = '$_POST[paket]' and aktif='pending' and _token='$_POST[_token]'";
		$_SESSION['baru']=1;
		// echo $sql;
		$cek=mysqli_fetch_array(mysqli_query($con,$kontlo));
		// echo $cek['id_subscribe'];
		echo "<script>alert('Confirm the payment');window.location.href='payment.php?id=".$cek['id_subscribe']."&gateway=$_POST[gateway]'</script>";

    	// header('Location:payment.php?id='.$cek['id_subscribe']);
		// echo "<script>alert('$kontlo');window.location.href='payment.php?id=".$cek['id_subscribe']."'</script>";
	}else{
		echo "<script>alert('Request failed')</script>";
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
<title>Properties</title>
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
<link rel="stylesheet" type="text/css" href="styles/properties.css">
<link rel="stylesheet" type="text/css" href="styles/properties_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/radio.css">
<style type="text/css">
  
<?php $subs=mysqli_query($con,"SELECT * from gateway");
  while($row=mysqli_fetch_array($subs)){ ?>
  .<?=$row["nama_gateway"]?>{
    background: 
    <?=$row["bg"]?>;
    color: 
    <?=$row["font"]?>;
  }
  .<?=$row["nama_gateway"]?>:hover{
    background: <?=$row["font"]?>;
    color: <?=$row["bg"]?>;
  }

<?php } ?>
</style>
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<?php include 'include/nav.php'; ?>
 
	<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/properties.jpg" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content d-flex flex-row align-items-end justify-content-start">
							<div class="home_title">Search Results</div>
							<div class="breadcrumbs ml-auto">
								<ul>
									<li><?php //echo $kontlo; ?></li>
									<!-- <li>Search Results</li> -->
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		<!-- Properties -->
<?php  //$package=mysqli_query($con,"SELECT * from paket order by id_paket desc"); ?>
	<div class="properties">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title">Products found</div>
					<div class="section_subtitle">Depends on search, 
						<?php $arr=array('internet','tv','tel','kuota','etc','harga'); $num=0; $where="";
											for ($i=0; $i < 6; $i++) { 
												if (strlen($_GET[$arr[$i]])>0) { $kill=1;?>
													<?=@$_GET[$arr[$i]].' | '?>
													<?php if ($num==0){
														$where = $where . (" $arr[$i] = '".$_GET[$arr[$i]]."'");
													}else{
														$where = $where . (" or $arr[$i] = '".$_GET[$arr[$i]]."'");
													} $num++; ?>
											<?php	}}?>
					</div>
				</div>
			</div>
			<div class="row properties_row">
				
				<!-- Property -->

				<?php if (isset($_SESSION['NIK'])) {
					if ($kill==1) {

					$sql="SELECT * from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' and $where order by subscribe.time desc";
					}else{
					$sql="SELECT * from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' order by subscribe.time desc";
				} 
				
						$subscribe=mysqli_query($con,$sql);

				while ($subs=mysqli_fetch_array($subscribe)) { 
					if(strlen($subs['img'])>0){$img=$subs['img'];}else{$img='default.jpg';}
					 ?>
					<a href="products.php?product=<?=$subs['id_paket']?>">
					<div class="col-xl-4 col-lg-6 property_col">
						<div class="property">
							<div class="property_image">
								<img src="images/<?=$img?>" alt="">
								<div class=" property_tag"><a href="products.php?product=<?=$subs['id_paket']?>" class="<?php 
											if ($subs['aktif']=='active'){ echo 'btn btn-success'; }
											elseif ($subs['aktif']=='pending'){ echo 'btn btn-warning'; }
											elseif ($subs['aktif']=='overdue'){ echo 'btn btn-danger'; }
											else{} ?>"><?=strtoupper($subs['aktif'])?></a></div>
							</div>
							<div class="property_body text-center">
								<div class="property_location"><?=$subs['durasi']?></div>
								<div class="property_title"><a href="products.php?product=<?=$subs['id_paket']?>"><?=$subs['nama_paket']?></a></div>
								<div class="property_price">Rp. <?=number_format($subs['harga'])?></div>
							</div>
							<div class="property_footer d-flex flex-row align-items-center justify-content-start">
									<?php  $arr=array('internet','tv','tel','kuota','etc','harga');
												for ($i=0; $i < 6; $i++) { 
													if (strlen($subs[$arr[$i]])>0) { ?>
														<div><span><?=$subs[$arr[$i]]?></span></div>
												<?php	}
												}
												 ?>
												 
							</div>
						</div>
					</div>
				</a>
				<?php }}

				if (isset($_SESSION['NIK'])) {
					if ($kill==1) {

					$sql="SELECT * from paket where id_paket not in (SELECT paket.id_paket from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' and $where order by subscribe.time desc) order by id_paket desc";
					}else{

					$sql="SELECT * from paket where id_paket not in (SELECT paket.id_paket from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' order by subscribe.time desc) order by id_paket desc";
				} 
				}else{
					if ($kill==1) {
					$sql="SELECT * from paket where $where order by id_paket desc";

					}else{
					$sql="SELECT * from paket order by id_paket desc";
					}
				}
				// echo $sql;
				$package=mysqli_query($con,$sql);
				while ($offer=mysqli_fetch_array($package)) { if(strlen($offer['img'])>0){$img=$offer['img'];}else{$img='default.jpg';} ?>
				<a href="products.php?product=<?=$offer['id_paket']?>">
					<div class="col-xl-4 col-lg-6 property_col">
						<div class="property">
							<div class="property_image">
								<img src="images/<?=$img?>" alt="">
								<div class="<?php 
											if ($offer['badge']=='Featured'){ echo 'tag_featured'; }
											elseif ($offer['badge']=='Offer'){ echo 'tag_offer'; }
											elseif ($offer['badge']=='Hottest'){ echo 'tag_hottest'; }
											else ?> property_tag"><a href="products.php?product=<?=$offer['id_paket']?>"><?=$offer['badge']?></a></div>
							</div>
							<div class="property_body text-center">
								<div class="property_location"><?=$offer['durasi']?></div>
								<div class="property_title"><a href="products.php?product=<?=$offer['id_paket']?>"><?=$offer['nama_paket']?></a></div>
								<div class="property_price">Rp. <?=number_format($offer['harga'])?></div>
							</div>
							<div class="property_footer d-flex flex-row align-items-center justify-content-start">
									<?php $arr=array('internet','tv','tel','kuota','etc');
												for ($i=0; $i < 5; $i++) { 
													if (strlen($offer[$arr[$i]])>0) { ?>
														<div><span><?=$offer[$arr[$i]]?></span></div>
												<?php	}
												}
												 ?>
												 
							</div>
						</div>
					</div>
				</a>

				<?php } ?>

			</div>
			<!-- <div class="row">
				<div class="col">
					<div class="pagination">
						<ul>
							<li class="active"><a href="#">01.</a></li>
							<li><a href="#">02.</a></li>
							<li><a href="#">03.</a></li>
							<li><a href="#">04.</a></li>
						</ul>
					</div>
				</div>
			</div> -->
		</div>
	</div>

	<!-- Newsletter -->

	<!-- <div class="newsletter">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/newsletter.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_content d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="newsletter_title_container">
							<div class="newsletter_title">Are you buying or selling?</div>
							<div class="newsletter_subtitle">Search your dream home</div>
						</div>
						<div class="newsletter_form_container">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" placeholder="Your e-mail address" required="required">
								<button class="newsletter_button">subscribe now</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

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

<script src="js/custom.js"></script>
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
<script src="js/properties.js"></script>
</body>
</html>