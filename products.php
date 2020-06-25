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
							<div class="home_title">Products</div>
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
<?php if (isset($_GET['product'])) {
	$product=mysqli_fetch_array(mysqli_query($con,"SELECT * from paket where id_paket=$_GET[product]"));
	if(strlen($product['img'])>0){$img=$product['img'];}else{$img='default.jpg';}
	?>

	<div class="properties">
		<div class="container">
			<div class="col-lg-12 col-xs-12 mt-3 mb-3 row">
				<div class="col-lg-1 col-xs-1"></div>
				<div class="col-lg-10 col-xs-10">
					<div class="col-lg-12 row">
						<div class="col-lg-6 col-xs-6">
							<img class="col-lg-12 col-xs-12" style="border-radius: 20px" src="images/<?=$img?>" alt="<?=$img?>" class="rounded-lg">
						</div>
						<div class="col-lg-6 col-xs-6">
							<h2 class="detail_title"><a href="products.php?product=<?=$product['id_paket']?>"><?=$product['nama_paket']?></a></h2>
							<h4 class="detail_sub ml-1">Berlangganan <?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from subscribe where id_paket=$_GET[product]")); ?></h4>
							<table class="col-lg-12 ml-1">
								<tr><td colspan="2" ><span style="color: #666;border-bottom: 2px solid rgba(200,30,45,0.8)">Benefits</span></td></tr>
								<?php $arr=array('internet','tv','tel','kuota','etc');
												for ($i=0; $i < 5; $i++) { 
													if (strlen($product[$arr[$i]])>0) { ?>
								<tr>
									<td><?=strtoupper($arr[$i])?></td><td><div style=""><?=$product[$arr[$i]]?></div></td>
								</tr>
												<?php	}
												}
												 ?>
							</table>
							<h2 style="color: rgba(200,30,45,0.8)">Rp. <?=number_format($product['harga'])?></h2>
						</div>
							<?php 
							if (isset($_SESSION['NIK'])) {
								$sql="SELECT * from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' and paket.id_paket='$_GET[product]' order by subscribe.time desc";
							}
						$subscribe=mysqli_query($con,$sql);
						$subs=mysqli_fetch_array($subscribe);
						if (mysqli_num_rows($subscribe)>0) { 
							?>
								<?php if (strtolower($subs['aktif'])=='aktif'): ?>
									<button class="col-lg-12 m-4 buy-now" data-toggle="collapse" data-target="#reg" aria-expanded="false" aria-controls="reg">Unsubscribe</button>
								<div class="col-lg-12 m-4 collapse" id="reg">	
							  		<div class="card card-body">
							  			<h3 class="text-danger text-center">Berhenti Berlangganan?</h3>
							  			<a class="btn btn-link btn-block" href="?product=<?=$_GET['product']?>">Tidak sekarang</a>
							  			<a class="btn btn-danger btn-block" onclick="return confirm('Yakin untuk berhenti berlangganan? anda bisa mengajukan permohonan berlangganan lagi nanti')" href="?product=<?=$_GET['product']?>&unsubscribe=<?=$subs['id_subscribe']?>">Ya, Berhenti berlangganan sekarang</a>

							  			<div class="col-lg-12">
							  				<hr>
							  				<center>
								  				<table class="table text-dark table-responsive table-stripped">
								  					<tbody>
								  						<th>Tanggal</th>
								  						<th>Bulan</th>
								  						<th>Bayar</th>
								  					</tbody>
								  					<tbody>
								  						<?php $payment=mysqli_query($con,"SELECT * from payment join subscribe on payment.id_subscribe=subscribe.id_subscribe where subscribe.NIK=$_SESSION[NIK]");
								  						while ($p=mysqli_fetch_array($payment)) :?>
								  							<tr>
								  								<td><?=date_format(date_create($p["time"]),"d")." ".bulan(date_format(date_create($p["time"]),"m"))." ".date_format(date_create($p["time"]),"Y")?></td>
								  								<td><?=bulan(date_format(date_create($p["time"]),"m"))?></td>
								  								<td>Rp. <?=number_format($p['setor'])?></td>
								  							</tr>
								  						<?php endwhile; ?>
								  					</tbody>
								  				</table>
							  				</center>
							  			</div>
							  		</div>
								</div>
								<?php else: ?>

							<button class="col-lg-12 m-4 buy-now"><a style="color: white" href="payment.php?id=<?=$subs['id_subscribe']?>"><?=strtoupper($subs['aktif'])?></a></button>
								<?php endif; ?>
						<?php }else{ 

							if (!isset($_SESSION['NIK'])) {?>
									<button class="col-lg-12 m-4 buy-now" data-toggle="collapse" data-target="#reg" aria-expanded="false" aria-controls="reg">subscribe now</button>
									<div class="col-lg-12 m-4 collapse" id="reg">	
								  		<div class="card card-body">
								  			<?php //include 'registration.php'; ?>
								  			<div style="border:1px solid #ccc;border-radius:8px;padding:20px;">
										        <div class="text-center">
										        	<img src="images/logo.png" width="50%">
										          <h4>Daftarkan dirimu untuk berlangganan!</h4>
										        </div>
										        <div style="height:20px;"></div>
										        <form action="registration.php" method="post" enctype="multipart/form-data"  id="formReg">
										          <input type="hidden" name="_token" value="bb09a8982f9773de2932ca004555c6ba">
										          <label for="NIK">NIK</label>
										          <input type="text" class="form-control" name="NIK" id="NIK" required placeholder="Masukkan nama lengkap Anda.." />
										                    <div style="height:15px;"></div>

										          <label for="name">Nama Lengkap</label>
										          <input type="text" class="form-control" name="nama" id="name" required placeholder="Masukkan nama lengkap Anda.." />
										                    <div style="height:15px;"></div>

										          <label for="name">Tempat Lahir</label>
										          <input type="text" class="form-control" name="pob" id="pob" required placeholder="Masukkan nama lengkap Anda.." />
										                    <div style="height:15px;"></div>

										          <label for="name">Tanggal Lahir</label>
										          <input type="date" class="form-control" name="dob" id="dob" required placeholder="Masukkan nama lengkap Anda.." />
										                    <div style="height:15px;"></div>

										          <label for="email">Email</label>
										          <input type="email" class="form-control" name="email" id="email"required placeholder="Masukkan email Anda.." />
										                    <div style="height:15px;"></div>

										          <label for="msisdn">No. Handphone</label>
										          <input type="tel" class="form-control" name="tel" id="msisdn"required placeholder="Masukkan no. handphone Anda.." />
										                    <div style="height:15px;"></div>

										          <label for="msisdn_alt">No. Handphone Alternatif</label>
										          <input type="text" class="form-control" name="tel_alt" id="msisdn_alt"  placeholder="Masukkan no. handphone alternatif Anda.." />
										                    <div style="height:15px;"></div>

										          <label for="package">Paket Pilihan</label>
										          <select class="form-control" name="package"required id="package">
										            <option selected disabled>Pilih Paket</option>
										            <?php $paket=mysqli_query($con,"SELECT * from paket");
										            while ($pak=mysqli_fetch_array($paket)) {
										            	echo "<option value='".$pak["id_paket"]."'"; 
										            	if ($_GET['product']==$pak["id_paket"]) {
										            		echo "selected";
										            	}
										            	echo">".$pak["nama_paket"]."</option>";
										            }
										             ?>
										          </select>
										                    <div style="height:15px;"></div>

										          <label for="province">Provinsi</label>
										          <select class="form-control" name="province"required id="province">
										            <option value="">Pilih Provinsi</option>
										            <?php $province=mysqli_query($con,"SELECT * from wilayah_provinsi");
										            while ($provinsi=mysqli_fetch_array($province)) {
										            	echo "<option value='".$provinsi["id"]."'>".strtoupper($provinsi["nama"])."</option>";
										            }
										             ?>
										                      </select>
										                    <div style="height:15px;"></div>

										          <label for="city">Kota</label>
										          <select class="form-control" name="city"required id="city">
										            <option value="">Pilih Kota / Kabupaten</option>
										            <?php $kab=mysqli_query($con,"SELECT * from wilayah_kabupaten");
										            while ($kota=mysqli_fetch_array($kab)) {
										            	echo "<option value='".$kota["id"]."' data-chained='".$kota["provinsi_id"]."'>".strtoupper($kota["nama"])."</option>";
										            }
										             ?>
										          </select>
										                    <div style="height:15px;"></div>

										          <label for="city">Kecamatan</label>
										          <select class="form-control" name="kecamatan"required id="kecamatan">
										            <option value="">Pilih Kecamatan </option>
										            <?php $kecamatan=mysqli_query($con,"SELECT * from wilayah_kecamatan");
										            while ($kec=mysqli_fetch_array($kecamatan)) {
										            	echo "<option value='".$kec["id"]."' data-chained='".$kec["kabupaten_id"]."'>".strtoupper($kec["nama"])."</option>";
										            }
										             ?>
										          </select>
										                    <div style="height:15px;"></div>

										           <!-- <label for="city">Kelurahan / Desa</label>
										          <select class="form-control" name="kelurahan"required id="kelurahan">
										            <option value="">Pilih Kecamatan </option>
										            <?php $kelurahan=mysqli_query($con,"SELECT * from wilayah_desa");
										            while ($kel=mysqli_fetch_array($kelurahan)) {
										            	//echo "<option value='".$kel["id"]."' data-chained='".$kel["kecamatan_id"]."'>".$kel["nama"]."</option>";
										            }
										             ?>
										          </select>
										                    <div style="height:15px;"></div>
										 -->
										 			<label for="identity">Alamat Detail</label>
										 		<textarea placeholder="Contoh: Jl. Kenangan ke 3 selamanya..." id="address" class="form-control" name="alamat" required></textarea>
										                    <div style="height:15px;"></div>
										          
										          <label for="identity">Upload Kartu Identitas</label>
										          <input type="file"required name="identity" id="identity" class="form-control" accept="image/*">
										          <small style="color: red">Foto dengan format jpeg, jpg, atau png, serta tidak melebihi 1MB.</small>
										                    <div style="height:15px;"></div>

										          <label for="selfie">Upload foto selfie dengan KTP / Kartu Pelajar (foto selfie harus sama dengan kartu identitas)</label>
										          <input type="file" name="selfie" id="selfie" class="form-control" accept="image/*">
										          <small style="color: red">Foto dengan format jpeg, jpg, atau png, serta tidak melebihi 1MB.</small>
										                    <div style="height:15px;"></div>
										 
										          
										          <div class="text-center">
										          	<button type="submit" name="submit" class="btn btn-primary">Submit</button>
										          </div>
										        </form>
										        </div>

										<script src="js/jquery-chained.js"></script>
										<script type="text/javascript">
											$("#city").chained("#province");
											$("#kecamatan").chained("#city");
											$("#kelurahan").chained("#kecamatan");
										</script>




								  		</div>
									</div>
						<?php }else{ ?>	
							<button type="" class="col-lg-12 m-4 buy-now" data-toggle="collapse" data-target="#reg" aria-expanded="false" aria-controls="reg">
								<?php 
								if ($subs['aktif']=='down'): ?>
									Resubscribe again
								<?php else: ?>
								subscribe now
								<?php endif; ?>

							</button>
							<div class="col-lg-12 m-4 collapse" id="reg">
							  <div class="card card-body">
							  	<?php //include 'registration.php'; 
							  		if (isset($_POST['simpan'])) {
							  			$field = array('NIK','id_paket','aktif','_token');	
										$isi = array($_POST['NIK'],$_POST['package'],'pending',$_POST['_token']);
										insert($field,$isi,"subscribe",$con);
							  		}
							  	?>
							  	<div>
							  		<h2 class="detail_title"><a href="products.php?product=<?=$product['id_paket']?>"><?=$product['nama_paket']?></a></h2>
							<h4 class="detail_sub ml-1">Berlangganan <?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from subscribe where id_paket=$_GET[product]")); ?></h4>
							<table class="col-lg-12 ml-1">
								<tr><td colspan="2" ><span style="color: #666;border-bottom: 2px solid rgba(200,30,45,0.8)">Benefits</span></td></tr>
								<?php $arr=array('internet','tv','tel','kuota','etc');
												for ($i=0; $i < 5; $i++) { 
													if (strlen($product[$arr[$i]])>0) { ?>
								<tr>
									<td><?=strtoupper($arr[$i])?></td><td><div style=""><?=$product[$arr[$i]]?></div></td>
								</tr>
												<?php	}
												}
												 ?>
							</table>
							<h2 style="color: rgba(200,30,45,0.8)">Rp. <?=number_format($product['harga'])?></h2>
							  	</div>
        						<form method="post" enctype="multipart/form-data"  id="formReg">
        							<input type="hidden" name="paket" value="<?=$product['id_paket']?>">
        							<input type="hidden" name="_token" value="<?=md5($_SESSION['NIK'].$product['id_paket'])?>">

        							<select name="gateway" required class="form-control col-lg-6 col-xs-12" style="border: 1px solid #999">
        								<option selected disabled>-- Payment Method --</option>
        							<?php $gateway=mysqli_query($con,"SELECT * from gateway order by nama_gateway");
        								 while ($gate=mysqli_fetch_array($gateway)) { ?>
  										<option class="gateway <?=$gate['nama_gateway']?>" value="<?=$gate['id_gateway']?>"><?=strtoupper($gate['nama_gateway'])?></option>
        							<?php } ?>
        							</select>
        							<button type="submit" name="subscribe" class="btn btn-primary mt-2 mb-2">Yes! I want to subscribe</button>
        							<a class="btn btn-link" href="products.php?product=<?=$product['id_paket']?>">
									    Not Today
									</a>
        						</form>
							  </div>
							</div>
						<?php }} ?>
					</div>
				</div>
				<div class="col-lg-1 col-xs-1"></div>
			</div>
		</div>
	</div>
<?php }else{ ?>
		<!-- Properties -->
<?php  $package=mysqli_query($con,"SELECT * from paket order by id_paket desc"); ?>
	<div class="properties">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title"><?=mysqli_num_rows($package)?> Products found</div>
					<div class="section_subtitle">Search your dream plan</div>
				</div>
			</div>
			<div class="row properties_row">
				
				<!-- Property -->

				<?php if (isset($_SESSION['NIK'])) {
					$sql="SELECT * from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' order by subscribe.time desc";
						$subscribe=mysqli_query($con,$sql);
				while ($subs=mysqli_fetch_array($subscribe)) { if(strlen($subs['img'])>0){$img=$subs['img'];}else{$img='default.jpg';}?>
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
									<?php $arr=array('internet','tv','tel','kuota','etc');
												for ($i=0; $i < 5; $i++) { 
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
					$sql="SELECT * from paket where id_paket not in (SELECT paket.id_paket from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' order by subscribe.time desc) order by id_paket desc";
				}else{
					$sql="SELECT * from paket order by id_paket desc";
				}
				$package=mysqli_query($con,$sql);
				while ($offer=mysqli_fetch_array($package)) { if(strlen($offer['img'])>0){$img=$offer['img'];}else{$img='default.jpg';}?>
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

<?php } ?>
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