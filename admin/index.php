<?php include '../config/connection.php'; 
include '../db/function.php'; 
if ($_SESSION['level'] !='admin') {
  header('location: 404.html');
}
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location:../login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<meta name="description" content="Miminium Admin Template v.1">
	<meta name="author" content="Isna Nur Azis">
	<meta name="keyword" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Miminium</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

  <!-- plugins -->

  <link rel="stylesheet" href="asset/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

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

  <link rel="shortcut icon" href="asset/img/logomi.png">
  <link rel="shortcut icon" href="../images/favicon.png">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

<body id="mimin" class="dashboard">
      <!-- start: Header -->
        <?php include 'header.php'; ?>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu -->

        <?php include 'sidebar.php'; ?>
           
          <!-- end: Left Menu -->

          <!-- start: Content -->
          <div id="content">
            <div class="col-md-12 padding-0">
              <div class="col-md-12 padding-0">
                <div class="col-md-12 padding-0">
                  <div class="panel box-shadow-none content-header">
                      <div class="panel-body">
                        <div class="col-md-12">
                          
                            <h3 class="animated fadeInLeft"><?php if (isset($_GET['p'])) {echo $_GET['p'];}else{
                              echo "Dashboard";} ?></h3>
                            <p class="animated fadeInDown" style="line-height:.4;">
                              <?=$_SESSION['name']?>
                            </p>
                        </div>
                      </div>
                  </div>
                </div>
              <div class="col-md-12" style="background: #fff">
                <?php 

          $page = @$_GET['p'];
          $page=strtolower($page);
          $action = @$_GET['act'];

          switch ($page) {
            case 'change':
              include 'page/changepass.php';
              break;

            case 'user':
              if ($action == "create") {
                include 'page/user/create.php';
              } else if ($action == "edit") {
                include 'page/user/edit.php';
              } else {
                include 'page/user/index.php';
              }
              break;
            
            case 'profile':
              include 'page/customer/profile.php';
              break;

            case 'customer':
              if ($action == "create") {
                include 'page/customer/create.php';
              }else if ($action == "edit") {
                include 'page/customer/edit.php';
              }else if ($action == "upload") {
                include 'page/customer/upload.php';
              }else if ($action == "print") {
                include 'page/customer/print.php';
              } else {
                include 'page/customer/index.php';
              }
              break;

            case 'subscribes':
              if ($action == "create") {
                include 'page/paket/create.php';
              }else if ($action == "edit") {
                include 'page/paket/edit.php';
              }else if ($action == "upload") {
                include 'page/paket/upload.php';
              }else if ($action == "print") {
                include 'page/paket/print.php';
              } else {
                include 'page/paket/index.php';
              }
              break;

            case 'jabatan':
              if ($action == "create") {
                include 'page/jabatan/create.php';
              }else if ($action == "edit") {
                include 'page/jabatan/edit.php';
              }else{
                include 'page/jabatan/index.php';
              }
              break;

            case 'gateway':
              if ($action == "create") {
                include 'page/gateway/create.php';
              }else if ($action == "edit") {
                include 'page/gateway/edit.php';
              }else{
                include 'page/gateway/index.php';
              }
              break;

            case 'history':
                include 'page/subscribes/history.php';
              break;

            case 'request':
                include 'page/subscribes/request.php';
              break;
            case 'changepass':
                include 'page/changepass.php';
              break;
              case 'message':
                include 'page/message.php';
              break;

            default:
              include 'page/dashboard.php';
              break;
          }

         ?>      
              </div>
              <div class="col-md-6">
              
              </div>
              <div class="col-md-6">

              </div>
              </div>
            </div>
          </div>
          <!-- end: Content -->

          
      </div>
<?php include 'mobile.php'; ?>



<!-- start: Javascript -->

<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/datatables/jquery.dataTables.min.js"></script>
<script src="asset/datatables/dataTables.bootstrap.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>

<!-- plugins -->
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/flot/jquery.flot.min.js"></script>
<script src="asset/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="asset/js/plugins/flot/jquery.flot.time.min.js"></script>
<script src="asset/js/plugins/flot/jquery.flot.navigate.min.js"></script>
<script src="asset/js/plugins/flot/jquery.flot.stack.min.js"></script>

<script src="asset/js/plugins/jquery.nicescroll.js"></script>

<!-- custom -->
<script src="asset/js/main.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<!-- end: Javascript -->
</body>
</html>