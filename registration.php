<?php 
  include 'config/connection.php';
  include 'db/function.php';
  if ($_POST['_token']=='bb09a8982f9773de2932ca004555c6ba') {
    $identity=$_FILES['identity']['name'];
    $selfie=$_FILES['selfie']['name'];
    
  	$field = array('NIK','nama_customer','tempatlahir','tanggallahir','tel','tel_alt','email','provinsi','kota','kecamatan','alamat','identity','img');
  	$isi = array($_POST['NIK'],$_POST['nama'],$_POST['pob'],$_POST['dob'],$_POST['tel'],$_POST['tel_alt'],$_POST['email'],$_POST['province'],$_POST['city'],$_POST['kecamatan'],$_POST['alamat'],$identity,$selfie);

	insert($field,$isi,"customer",$con);


	$field = array('NIK','id_paket','aktif','_token');	
	$isi = array($_POST['NIK'],$_POST['package'],'pending',$_POST['_token']);
	insert($field,$isi,"subscribe",$con);


	if (is_uploaded_file($_FILES['identity']['tmp_name'])) {
              move_uploaded_file($_FILES['identity']['tmp_name'], "img/identity/".$_POST['NIK'].$identity);
              //$img=",KTP='".$a."'";
            }
    if (is_uploaded_file($_FILES['selfie']['tmp_name'])) {
              move_uploaded_file($_FILES['selfie']['tmp_name'], "img/selfie/".$_POST['NIK'].$selfie);
              //$img=",KTP='".$a."'";
            }
  $field = array('nama','username','password','level');	
	$isi = array($_POST['nama'],$_POST['NIK'],$_POST['NIK'],'pending');
	insert($field,$isi,"user",$con);
  $img=mysqli_fetch_assoc(mysqli_query($con,"SELECT * from customer where NIK='".$data['username']."'"));
      $_SESSION['logged'] = $data['level'];
      $_SESSION['last']= $data['last_activity'];
      $_SESSION['id_user'] = $data['id_user'];
      $_SESSION['name'] = $data['nama'];
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['img'] = $img['img'];
      $_SESSION['NIK'] = $img['NIK'];
  header('location: index.php');
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Bluesky template project">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/responsive.css">
  	<link rel="shortcut icon" href="images/favicon.png">
</head>
<body>
<div class="container" >
  <div class="row">
  	<div class="col-xs-2 col-sm-2"></div>
    <div class="col-xs-8 col-sm-8 col-sm-offset-2">
      <img src="https://www.indihome.co.id/assets/lfh/banner.jpg" width="100%">

      <div class="text-center">
        <h3>IndiHome Learning From Home</h3>
        <h4>Belajar online dari rumah jadi semakin lancar! Waktu belajar pun jadi lebih efisien.</h4>
        <p>Kini, IndiHome Paket Learning From Home hadir untuk mendukung kegiatan belajar! Koneksi internet yang stabil, bisa Kamu dapatkan untuk mengerjakan tugas harian hingga persiapan ulangan tanpa perlu bepergian ke manapun. Semua hal tersebut dapat dilakukan di rumah, sehingga aktivitas belajar jadi lebih menyenangkan dan efisien!
          <br/><br/>
          Segera berlangganan IndiHome Paket Learning From Home sekarang dan rasakan kemudahannya!
        </p>
        <!-- <button type="button" id="btnScroll" class="btn btn-secondary">Isi Form Registrasi Sekarang</button>
        <br/>
        <br/>
        <a data-toggle="modal" data-target="#skb" href="#">Syarat & Ketentuan</a> -->
      </div>

      <div style="height:20px;"></div>
      <!-- <img id="paketCat" src="https://www.indihome.co.id/assets/lfh/package.png" width="100%"> -->
      <div style="height:20px;"></div>

      <div style="border:1px solid #ccc;border-radius:8px;padding:20px;">
        <div class="text-center">
        	<img src="images/logo.png" width="50%">
          <h4>Daftarkan dirimu untuk berlangganan!</h4>
        </div>
        <div style="height:20px;"></div>
        <form action="" method="post" enctype="multipart/form-data"  id="formReg">
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
            	echo "<option value='".$pak["id_paket"]."'>".$pak["nama_paket"]."</option>";
            }
             ?>
          </select>
          <!-- <small><a href="#paket" id="paketDetail">Klik di sini untuk melihat detail paket</a></small> -->
                    <div style="height:15px;"></div>

          <!-- <label for="address">Alamat Lengkap</label>
          <input type="text" class="form-control" name="address"required id="address" placeholder="Masukkan alamat lengkap Anda.." />
                    <div style="height:15px;"></div> -->

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
      <div style="height:50px;"></div>
    </div>

  	<div class="col-xs-2 col-sm-2"></div>
  </div>
</div>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="js/jquery-chained.js"></script>
<script type="text/javascript">
	$("#city").chained("#province");
	$("#kecamatan").chained("#city");
	$("#kelurahan").chained("#kecamatan");
</script>
</body>
</html>