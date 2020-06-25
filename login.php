<?php 
  include 'config/connection.php';
  if (isset($_POST['signin'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $md5 = md5($_POST['password']);
    $sql = "SELECT * from user where (password='$pass' or password='$md5') and username='$user'";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
    $row = mysqli_num_rows($query);
    if ($row > 0) {

      $_SESSION['level'] = $data['level'];
      if ($data['level'] !='admin' ) {
        $img=mysqli_fetch_assoc(mysqli_query($con,"SELECT * from customer where NIK='".$data['username']."'"));
        $_SESSION['logged'] = $data['level'];
      }else{
        $_SESSION['logged'] = null;
      }
      $_SESSION['last']= $data['last_activity'];
      $_SESSION['id_user'] = $data['id_user'];
      $_SESSION['name'] = $data['nama'];

      $_SESSION['nama'] = $data['nama'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['img'] = $img['img'];
      $_SESSION['NIK'] = $img['NIK'];
      
      if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'Admin') {
        //header('location: admin/index.php');
        echo "<script>alert('Login berhasil!');window.location.href='admin'</script>";
      }else{
        echo "<script>alert('Selamat datang ".$_SESSION['name']." !');window.location.href='index.php'</script>";
      }
        
    }
     else {
        echo "<script>alert('Username atau Password salah!')</script>";
    }
  }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Login Indihome
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->

  <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!--  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
  <!-- CSS Files -->

  <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
  <link href="styles/material-kit.css?v=2.0.7" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  <div class="page-header header-filter" style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="POST">
              <div class="card-header card-header-primary text-center">
                <img src="images/logo_large.png" width="70%" alt="indihom">
                <h4 class="card-title"></h4>
              </div>

                <!-- <img src="images/logo.png" width="70%" alt="indihom"> -->
              <p class="description text-center"><b>Login</b></p>
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-user"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="username" value="<?=$_POST['username']?>" placeholder="Username...">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" name="password" placeholder="Password...">
                </div>
              </div>
              <button type="submit" class="kusus" name="signin"><b>Login</b></button>
              <p align="center">Belum punya akun?<br><b><a href="registration.php" style="color: rgba(200,30,45,1)">Daftarkan dirimu sekarang juga!</a></b></p>
              <p align="center"><a href="index.php">Kembali kehalaman utama</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="copyright float-right">
          &copy;
          <script>
            document.write(new Date().getFullYear())
          </script>, made with <i class="fa fa-heart"></i> by
          <a href="https://gihub.com/pottsed" target="_blank">Pottsed</a>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="../assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
</body>

</html>