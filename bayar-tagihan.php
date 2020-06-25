<?php include 'config/connection.php';
$bul=$_GET['bulan'];
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tagihan Bulanan</title>
<link rel="shortcut icon" href="images/favicon.png">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" type="text/css" href="styles/method.css">
<style type="text/css">
	.container{
		margin: 24px;
	}
	.card{
		padding: 16px;
	}


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
<form method="POST">
<div class="container">
	<div class="col-lg-12 row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8 col-xs-12">
			<div class="card">
				<div class="col-lg-12 col-xs-12 text-center">
					<h2>Detail Pembayaran</h2>
					<h5>Tagihan bulan <?php echo bulan($bul);?></h5>
					<hr>
				</div>
				<div class="col-lg-12 col-xs-12">
					<ul>
						<li>
							<div class="col-lg-12 row">
								<div class="col-lg-9">
									<h5>Package</h5>
								</div>
								<div class="col-lg-3">
									<h5>Pricing</h5>
								</div>
							</div>
						</li>
						<?php $list=0;
						$sum=0;
						$subs=mysqli_query($con,"SELECT * from subscribe join paket on subscribe.id_paket=paket.id_paket where subscribe.aktif='aktif' and subscribe.NIK='".$_SESSION['NIK']."'");
						while($row=mysqli_fetch_array($subs)){ $list++;
							$sum=$sum+$row['harga'];
						if ($list>1): ?>
						<hr>
						<li>
							<div class="col-lg-12 row text-dark">
								<div class="col-lg-9">
									<?=$row['nama_paket']?>
								</div>
								<div class="col-lg-3">
									<h4>Rp. <?=number_format($row['harga']);?> </h4>
								</div>
							</div>
						</li>
						<?php else: ?>
						<li>
							<div class="col-lg-12 row text-dark">
								<div class="col-lg-9">
									<?=$row['nama_paket']?>
								</div>
								<div class="col-lg-3">
									<h4>Rp. <?=number_format($row['harga']);?></h4>
								</div>
							</div>
						</li>
						<?php endif; }  ?>
					</ul>
				</div>
				<div class="col-lg-12 col-xs-12">
					<ul>
						<li><hr></li>
						<li><div class="col-lg-12 row">
								<div class="col-lg-9 col-xs-12">Metode Pembayaran</div>
								<div class="col-lg-3 col-xs-12">
									<a style="color: blue;text-decoration: underline;" data-toggle="collapse" data-target="#gateway" aria-expanded="true" aria-controls="gateway">Pilih Metode</a>
								</div>
							</div></li>
						<div id="gateway" class="collapse" aria-labelledby="headingOne">
					      <div class="card-body text-dark">

					    <div class="quiz" id="quiz" data-toggle="buttons">
						<?php $list=0;
						$subs=mysqli_query($con,"SELECT * from gateway");
						while($row=mysqli_fetch_array($subs)): ?>
           					<label class="element-animation1 btn btn-lg btn-block <?=$row["nama_gateway"]?> ">
           						<span class="btn-label">
           							<i class="glyphicon glyphicon-chevron-right"></i>
           						</span>
           						<input type="radio" name="gateway" required value="<?=$row["id_gateway"]?>"><?=strtoupper($row["nama_gateway"])?>
	           				</label>
						<?php endwhile; ?>
	           			</div>
					      </div>
					    </div>
					</ul>
				</div>

				<div class="col-lg-12 col-xs-12">
					<ul>
						<li><hr></li>
						<li>
							<div class="col-lg-12 row text-dark">
								<div class="col-lg-9">Tanggal</div>
								<div class="col-lg-3">
									<h5><?=date("d")." ".bulan(date("m"))." ".date("Y")?></h5>
								</div>
							</div>
						</li>
						<li>
							<div class="col-lg-12 row text-dark">
								<div class="col-lg-9">QTY</div>
								<div class="col-lg-3">
									<h5><?=mysqli_num_rows($subs)?></h5>
								</div>
							</div>
						</li>
						<li>
							<div class="col-lg-12 row text-dark">
								<div class="col-lg-9">Total bayar</div>
								<div class="col-lg-3">
									<h4 class="text-danger"><b>Rp. <?php echo number_format($sum);?></b></h4>
								</div>
							</div>
						</li>
						<li>
							<div class="col-lg-12">
								<button type="submit" class="btn btn-lg btn-block btn-danger" name="submit">Proses</button>
							</div>
						</li>
					</ul>
			</div>
		</div>
		<div class="col-lg-2"></div>
	</div>
</div>
</form>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function(){
    
    $("label.btn").on('click',function () {
    	var choice = $(this).find('input:radio').val();
    	$('#loadbar').show();
    	// $('#quiz').fadeOut();
    	setTimeout(function(){
           // $( "#answer" ).html(  $(this).checking(choice) );      
            $('#quiz').show();
            // $('#loadbar').fadeOut();
           /* something else */
    	}, 1000);
    });
});	

</script>
</body>
</html>