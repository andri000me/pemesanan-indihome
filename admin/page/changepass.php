<?php 
if (isset($_POST['simpan'])) {
$old=$_POST['old'];
$password=$_POST['Password'];
$cpassword=$_POST['CPassword'];
if ($password!=$cpassword) {
  $fail=2;
}else{
  $md5=md5($_POST['Password']);
$cek=mysqli_query($con,"SELECT * from user where (password='$password' or password='$md5') and  id_user='".$_SESSION['id_user']."'");
if (mysqli_num_rows($cek)>0) {
  $change=mysqli_query($con,"UPDATE user set password='".$md5."' where id_user='".$_SESSION['id_user']."'");
  if ($change) {
      // echo "<script>alert('Password berhasil diubah!');</script>";
      $fail="none";
  }else{
      $fail="yes";
  }
}else{
  $fail=1;
}
}
}
 ?>

<div class="row">
    <div class="col-md-8">
      	<div class="box box-primary">
        	<div class="box-header with-border">
              <?php if ($fail==1): ?>
              <span class="alert alert-danger col-lg-12"><strong>Password</strong> salah!</span>
              <?php elseif ($fail=="none"): ?>
              <span class="alert alert-success col-lg-12"><strong>Password</strong> berhasil diubah!!</span>
              <?php elseif ($fail=="yes"): ?>
              <span class="alert alert-warning col-lg-12"><strong>Password</strong> gagal diubah!!</span>
              <?php endif; ?>
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
                  <?php if ($fail==2): ?>
                    <span class="text-danger">Password tidak cocok</span>
                  <?php endif ?>
          			</div>
          			<div class="form-group">
          				<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"></i>Save Changes</button>
          			</div>
          		</form>
          	</div>
        </div>
    </div>
</div>