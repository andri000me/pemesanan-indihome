<?php 
if (isset($_POST["message"])) {
	include 'admin/page/send-message.php';
}elseif (isset($_POST['changepass'])) {
  $old=$_POST['old'];
  $password=$_POST['Password'];
  $cpassword=$_POST['CPassword'];
  if ($password!=$cpassword) {
    $fail=2;
      echo "<script>alert('Password tidak cocok!');</script>";
  }else{
    $md5=md5($_POST['Password']);
  $cek=mysqli_query($con,"SELECT * from user where (password='$password' or password='$md5') and  id_user='".$_SESSION['id_user']."'");
  if (mysqli_num_rows($cek)>0) {
    $change=mysqli_query($con,"UPDATE user set password='".$md5."' where id_user='".$_SESSION['id_user']."'");
    if ($change) {
        echo "<script>alert('Password berhasil diubah!');</script>";
        $fail="none";
    }else{
        $fail="yes";
    }
  }else{
    $fail=3;
        echo "<script>alert('Password salah!');</script>";
  }
  }
}
 ?>
<style type="text/css">
.chat-enemy{
	position: relative;
	background: #ae0d11;
	padding: 4px;
	border-radius: .4em;
 	word-wrap: break-word;
	color: white;
}
.chat-enemy:after {
	content: '';
	position: absolute;
	top: 50%;
	border: 6px solid transparent;
	border-right-color: #ae0d11;
	border-left: 0;
	margin-top: -6px;
	margin-left: -6px;
}
.chat-ally {
	position: relative;
	background: #ecd2d3;
	border-radius: .4em;
	padding: 4px;
	  word-wrap: break-word;
	color: black;
}

.chat-ally:after {
	content: '';
	position: absolute;
	top: 50%;
	border: 6px solid transparent;
	border-left-color: #ecd2d3;
	border-right: 0;
	margin-top: -6px;
	margin-right: -6px;
}
</style>

<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_content d-flex flex-row align-items-center justify-content-start">
						<div class="logo">
							<a href="index.php"><img src="images/logo_large.png" alt=""></a>
						</div>
						<nav class="main_nav">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a href="about.php">About us</a></li>
								<li><a href="products.php">Properties</a></li>
							</ul>
						</nav>
						
						<div class="phone_num ml-auto">
							<?php if (isset($_SESSION['id_user'])) { ?>
									<!-- <button type="button" class="phone_num_inner" data-toggle="modal" data-target="#login">Tambah Data</button> -->
							<!-- <div class="phone_num_inner" style="color: white;">
								<i class="fa fa-user"></i><span> <?=$_SESSION['nama']?></span>
							</div> -->
							<button type="button" class="phone_num_inner" style="color: white;" data-toggle="modal" data-target="#headmodal">
								<i class="fa fa-user"></i><span> <?=$_SESSION['nama']?></span>
							</button>
							<?php }else{ ?>
							
							<a href="login.php" class="btn " style="background: white;color: white;"> 
									<div class="mt-1 mb-3" style="color: rgba(200,30,45,1);">
										<b>
										<i class="fa fa-login"></i> Login to continue	
									</b>
									</div>
							</a>
						<?php } ?>
						</div>
						<?php $notifications=mysqli_query($con,"SELECT * from messages where destination ='".$_SESSION['NIK']."' group by author "); ?>
						<?php if (mysqli_num_rows($notifications)>0): ?>
							
						<div>
							<button type="button" class="btn" data-toggle="modal" data-target="#messages" style="background: transparent; color: white">
							  <i class="fa fa-bell"></i> 
							  	<sup><span class="badge badge-light" style="color: rgba(200,30,45,1)">
							  		<?php echo mysqli_num_rows($notifications); ?>
							  	</span></sup>
							  <span class="sr-only">incoming messages</span>
							</button>
						</div>
						<?php endif ?>
						<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Modal -->
	<div class="modal fade" id="headmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user"></i><span> <?=$_SESSION['nama']?></span></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="background: linear-gradient(to bottom, rgba(200,30,45,1), rgba(200,30,45,0.8));">
	      	<ul id="accordion">

			<li class="menu_item">
		      		<a data-toggle="collapse" href="#Profile" role="button" aria-expanded="false" data-parent="#accordion" aria-controls="collapseExample">
					    Profile
					</a>
				</li>
			<div class="collapse" id="Profile">
			  <div class="card card-body">
			  	<?=$_SESSION['nama']?>
			  </div>
			</div>
				<li class="menu_item">
		      		<a data-toggle="collapse" href="#Subcribe" role="button" aria-expanded="false" data-parent="#accordion" aria-controls="collapseExample">
					    My Subcribe
					</a>
				</li>
			<div class="collapse" id="Subcribe">
			  <div class="card card-body">
			  	<ul>
			  	<?php $sql="SELECT * from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' order by subscribe.time desc";

		$package=mysqli_query($con,$sql);
				while ($offer=mysqli_fetch_array($package)) { ?>
					<li class="alert alert-link" role="alert" style="border:1px solid #999">
						<a href="<?=$offer['id_paket']?>" class="alert-link"><?=$offer['nama_paket']?></a>
						<small></small>
						<span class="pull-right">Rp. <?=number_format($offer['harga'])?></span>
					</li>
				<?php } ?>
					<li class="alert"><label>Monthly cost</label>
						<span class="pull-right">Rp.  <?php
						$duit="SELECT harga from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' and aktif != 'overdue' order by subscribe.time desc";
						$d=mysqli_query($con,$duit);
						$cost=0;
						while ($price = mysqli_fetch_array($d)) {
							$cost = $cost + $price['harga'];
						}
						echo number_format($cost);
						?></span>
					</li>

					<?php $bul=date("m"); 
					$payment=mysqli_fetch_array(mysqli_query($con,"SELECT * from payment join subscribe on payment.id_subscribe=subscribe.id_subscribe where subscribe.NIK='$_SESSION[NIK]' and aktif = 'aktif' order by subscribe.time desc"));?>
					<?php if ($payment["setor"]==$cost): ?>
					<?php else: ?>
					<li><span class="pull-right"><a class="btn btn-primary" href="bayar-tagihan.php?bulan=<?=$bul?>">Bayar tagihan bulan <?php echo bulan($bul);?></a></span></li>
					<?php endif; ?>
				</ul>
			  </div>
			</div>
				<li class="menu_item">
		      		<a data-toggle="collapse" href="#Change" role="button" aria-expanded="false" data-parent="#accordion" aria-controls="collapseExample">
					    Change Password
					</a>
				</li>
			<div class="collapse" id="Change">
			  <div class="card card-body">

<div class="row">
    <div class="col-md-8">
      	<div class="box box-primary">
        	<div class="box-header with-border">
          		<h3 class="box-title">Ubah Password</h3>
          	</div>
          	<div class="box-body">
          		<form method="POST">
          			<div class="form-group">
          				<label>Old Password</label>
          				<input type="Password" class="form-control input-lg" name="old" required>
          			</div>
          			<div class="form-group">
          				<label>New Password</label>
          				<input type="Password" class="form-control input-lg" name="Password" required id="">
          			</div>
          			<div class="form-group">
          				<label>Confirm Password</label>
          				<input type="Password" class="form-control input-lg" name="CPassword" required>
          			</div>
          			<div class="form-group">
          				<button type="submit" name="changepass" class="btn btn-success"><i class="fa fa-save"></i>Save Changes</button>
          			</div>
          		</form>
          	</div>
        </div>
    </div>
</div>
			  </div>
			</div>
	      	</ul>


	      </div>
	      <div class="modal-footer">
	        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
	        <a class="btn btn-danger" href="?logout">Logout</a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="menu trans_500">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo menu_logo">
				<a href="#">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="images/logo_large.png" alt=""></div></div>
					</div>
				</a>
			</div>
			<ul>
				<li class="menu_item"><a href="index.php">Home</a></li>
				<li class="menu_item">
					
							<a class="btn" data-toggle="modal" data-target="#messages" style="background: transparent; color: white"><!-- 
							  <i class="fa fa-bell"></i>  -->
							  Notifications
							  <?php if (mysqli_num_rows($notifications)>0): ?>
							  	<sup><span class="badge badge-light" style="color: rgba(200,30,45,1)">
							  		<?php echo mysqli_num_rows($notifications); ?>
							  	</span></sup>
							  <?php endif ?>
							  <span class="sr-only">incoming messages</span>
							</a>
				</li>
				<li class="menu_item"><a href="about.php">About us</a></li>
				<li class="menu_item"><a href="properties.php">Properties</a></li>
			</ul>
			<ul id="accordion">
				<li class="menu_item">
		      		<a data-toggle="collapse" href="#Profile" role="button"  aria-expanded="false" data-parent="#accordion" aria-controls="collapseExample">
					    Profile
					</a>
				</li>
			<div class="collapse" id="Profile">
			  <div class="card card-body">
			  	<?=$_SESSION['nama']?>
			  </div>
			</div>
				<li class="menu_item">
		      		<a data-toggle="collapse" href="#Subcribe" role="button"  aria-expanded="false" data-parent="#accordion" aria-controls="collapseExample">
					    My Subcribe
					</a>
				</li>
			<div class="collapse" id="Subcribe">
			  <div class="card card-body">
			  	<ul>
			  	<?php $sql="SELECT * from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' order by subscribe.time desc";

		$package=mysqli_query($con,$sql);
				while ($offer=mysqli_fetch_array($package)) { ?>
					<li class="alert alert-link" role="alert" style="border:1px solid #999">
						<a href="products.php?product=<?=$offer['id_paket']?>" class="alert-link"><?=$offer['nama_paket']?></a>
						<small></small>
						<span class="pull-right">Rp. <?=number_format($offer['harga'])?></span>
					</li>
				<?php } ?>
					<li class="alert"><label>Monthly cost</label>
						<span class="pull-right">Rp.  <?php
						$duit="SELECT harga from paket join subscribe on paket.id_paket=subscribe.id_paket where subscribe.NIK='$_SESSION[NIK]' and aktif != 'overdue' order by subscribe.time desc";
						$d=mysqli_query($con,$duit);
						$cost=0;
						while ($price = mysqli_fetch_array($d)) {
							$cost = $cost + $price['harga'];
						}
						echo number_format($cost);
						?></span>
					</li>
					<?php $bul=date("m"); ?>
					<li><span class="pull-right"><a class="btn btn-primary" href="bayar-tagihan.php?bulan=<?=$bul?>">Bayar tagihan bulan <?php echo bulan($bul);?></a></span></li>

				</ul>
			  </div>
			</div>
				<li class="menu_item">
		      		<a data-toggle="collapse" href="#Change" role="button"  aria-expanded="false" data-parent="#accordion" aria-controls="collapseExample">
					    Change Password
					</a>
				</li>
			<div class="collapse" id="Change">
			  <div class="card card-body">

<div class="row">
    <div class="col-md-8">
      	<div class="box box-primary">
        	<div class="box-header with-border">
          		<h3 class="box-title">Ubah Password</h3>
          	</div>
          	<div class="box-body">
          		<form method="POST">
          			<div class="form-group">
          				<label>Old Password</label>
          				<input type="Password" class="form-control input-lg" name="old" required>
          			</div>
          			<div class="form-group">
          				<label>New Password</label>
          				<input type="Password" class="form-control input-lg" name="Password" required id="">
          			</div>
          			<div class="form-group">
          				<label>Confirm Password</label>
          				<input type="Password" class="form-control input-lg" name="CPassword" required>
          			</div>
          			<div class="form-group">
          				<button type="submit" name="changepass" class="btn btn-success"><i class="fa fa-save"></i>Save Changes</button>
          			</div>
          		</form>
          	</div>
        </div>
    </div>
</div>
			  </div>
			</div>
				<li class="menu_item"><a href="?logout">Logout</a></li>
			</ul>


		</div>
		<div class="menu_phone">

								<!-- &copy;<script>document.write(new Date().getFullYear());</script> <a href="https://github.com/pottsed" style="color: white">Pottsed</a> | Made with <i class="fa fa-heart-o" aria-hidden="true"></i>  -->
		</div>
	</div>



<!-- Modal -->
<div class="modal fade" id="messages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Messages</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="accordion" id="msg">
        <?php $notifications=mysqli_query($con,"SELECT * from messages where destination ='".$_SESSION['NIK']."'  group by author order by time desc"); ?>
        <?php while($msg=mysqli_fetch_array($notifications)):?>
			  <div class="card">
			  	<a data-toggle="collapse" data-target="#<?=$msg['author']?>" aria-expanded="true" aria-controls="collapseOne">
			    <div class="card-header" style="background: linear-gradient(to right, rgba(200,30,45,1), rgba(200,30,45,0.7)); color: white" id="<?=$msg['id_messages']?>">
			      <!-- <h2 class="mb-0"> -->
			        <!-- <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> -->
			        	<!-- <b><?=$msg['subject']?></b> -->
			        <!-- </button> -->
			        <div class="form-row">
			        	<div class="col-lg-9">
			        		<b><?=$msg['subject']?></b><br>
			        		<span class="pull-left"><?=$msg['author']?></span>
			        	</div>

			        	<div class="col-lg-3">
			        		<span class="pull-right">
			        			<h4><small><b>
			        		<?php 
			        		$datenow=date('Y-m-d');
			        		$date=date_format(date_create($msg['time']),'Y-m-d');
			        		if ($date==$datenow) {
			        			echo date_format(date_create($msg['time']),'H:i');
			        		}else{
			        			echo date_format(date_create($msg['time']),'H:i d F Y');
			        		} ?></b>
			        	</small></h4>
			        		</span>
			        	</div>
			        </div>
			        
			      <!-- </h2> -->
			    </div>
			</a>
			    <div id="<?=$msg['author']?>" class="collapse " aria-labelledby="<?=$msg['id_messages']?>" data-parent="#msg">

			      <div class="card-body">
			      	<form  method="POST" class="form-row">
			      		<div class="col-lg-10">
			      			<input type="hidden" name="_encrypt" value="<?=md5($_SESSION['NIK'].$msg['author'])?>">
			      			<input type="hidden" name="destination" class="form-control" value="<?=$msg['author']?>">
			      			<input type="hidden" name="subject" class="form-control" value="<?=$msg['subject']?>">
			      			<input type="hidden" name="author" class="form-control" value="<?=$_SESSION['NIK']?>">
			      			<input type="text" name="message" class="form-control" placeholder="Send a reply...">
			      		</div>
			      		<div class="col-lg-2">
			      			<button type="submit" class="btn btn-primary" name="send"><i class="fa fa-send"></i></button>
			      		</div>
			      	</form>
			      </div>
			    	<div class="card-body col-lg-12">
			      	<?php 
			      	$bubble=mysqli_query($con,"SELECT * from messages where (destination ='".$_SESSION['NIK']."' and author ='".$msg['author']."' ) or (destination='".$msg['author']."' and author='".$_SESSION['NIK']."') order by time desc");
			      	while ($chat=mysqli_fetch_array($bubble)): ?>
			      		<?php if ($_SESSION['NIK']==$chat['author']): ?>
			      			<div class="col-lg-12 row pull-right" style="margin: 12px;">

			      				<div class="col-lg-3"></div>
			      				<div class="col-lg-8">
			      				<p class="chat-ally text-right">
			      					<?=$chat['message']?>
			      					<br><small style="color: #999">
			      						<?php 
			        		$datenow=date('Y-m-d');
			        		$date=date_format(date_create($chat['time']),'Y-m-d');
			        		if ($date==$datenow) {
			        			echo date_format(date_create($chat['time']),'H:i');
			        		}else{
			        			echo date_format(date_create($chat['time']),'H:i d F Y');
			        		} ?>
			      					</small>
			      				</p>
			      				</div>
			      				<div class="col-lg-1">
			      				<img class="rounded-circle" width="20px" height="20px" src="<?php if (strlen($_SESSION['img'])>0): ?>
			      					admin/asset/img/customer/<?=$_SESSION['img']?>
			      				<?php else: ?>
			      					admin/asset/img/avatar.jpg
			      				<?php endif ?>">
			      				</div>

			      			<br><br>
			      			</div>
			      		<?php elseif ($_SESSION['NIK']==$chat['destination']): ?>
			      			<div class="col-lg-12 row pull-left" style="margin: 12px;">

			      				<div class="col-lg-1">
			      				<img class="rounded-circle" width="20px" height="20px" src="<?php if($chat['author']=="admin" || $chat['author']=="Admin" || $chat['author']=="ADMIN"): ?>
			      					admin/asset/img/avatar2.png
			      				<?php elseif (strlen($chat['author'])>0): ?>
			      					admin/asset/img/customer/<?=$chat['author']?>
			      				<?php else: ?>
			      					admin/asset/img/avatar.jpg
			      				<?php endif ?>">
			      				</div>
			      				<div class="col-lg-8">
			      					<p class="chat-enemy">
			      					<?=$chat['message']?>
			      					<br><small style="color: #999">
			      						<?php 
			        		$datenow=date('Y-m-d');
			        		$date=date_format(date_create($chat['time']),'Y-m-d');
			        		if ($date==$datenow) {
			        			echo date_format(date_create($chat['time']),'H:i');
			        		}else{
			        			echo date_format(date_create($chat['time']),'H:i d F Y');
			        		} ?>
			      					</small>
			      				</p>
			      				</div>

			      				<div class="col-lg-3"></div>
			      			<br><br>
			      			</div>
			      		<?php endif ?>
			      	<?php endwhile; ?>
			      	<br>
			      	<br>
			      </div>
			      
			      
			    </div>
			  </div>
        <?php endwhile; ?>
    	</div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

