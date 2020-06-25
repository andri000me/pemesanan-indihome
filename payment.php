<?php include 'config/connection.php';
$payment=mysqli_fetch_array(mysqli_query($con,"SELECT * from paket  join subscribe on paket.id_paket=subscribe.id_paket right join customer on customer.NIK=subscribe.NIK where subscribe.id_subscribe='".$_GET['id']."'"));
$gateway=mysqli_fetch_array(mysqli_query($con,"SELECT * from gateway where id_gateway='".$_GET['gateway']."'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payment</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="admin/asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="admin/asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="admin/asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="admin/asset/css/plugins/animate.min.css"/>
  <link href="admin/asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="images/favicon.png">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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

  <body id="mimin">
   
  <div class="container invoice invoice-v1">

     <!-- <nav class="navbar navbar-default header invoice-v1-tool container navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
                <a href="index.html" class="navbar-brand">
                  <img src="images/logo_large.png" height="100%" alt="logo mi" /> 
                </a>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li>
                  <button class="btn btn-round btn-primary" onclick="print()" style="margin-top:10px;">Print</button>
                </li>
              </ul>
            </div>
          </div>
        </nav> -->
    <!-- start: Content -->
    <div class="panel invoice-v1-content">
        <div class="panel-body">
            <div class="col-md-12 invoice-v1-header">
              <div class="col-md-12">
                <h1><b>Konfirmasi Pembayaran</b></h1>
              </div>
              <div class="col-md-12">

                <div class="col-md-6">
                <h4>
                <address>
                  <strong>Subscribe #: <?=$payment['id_subscribe']?></strong><br>
                  Created: <?=date_format(date_create($payment['time']),'d F Y')?><br>
                </address>
                </h4>
                </div>
                <div class="col-md-6 text-right">
                    <h4>
                    <address>
                      <strong><?=$payment['nama_customer']?></strong><br>
                      <?=$payment['NIK']?><br>
                      <?=$payment['email']?><br>
                    </address>
                    </h4>
                </div>
              </div>
            </div>
            <div class="col-md-12 padding-3">
                <div class="responsive-table">
                    
                   <table class="table table-striped">
                    <tr>
                      <th>Item</th>
                      <th>Price</th>
                    </tr>
                     <?php if ($_SESSION['baru']==1): $pasang=0;?>
                      <tr>
                      <td><b><?=$payment['nama_paket']?></b><br>
                        <small>
                <?php $arr=array('internet','tv','kuota','etc');
                 for ($i=0; $i < 4; $i++) { 
                          if (strlen($payment[$arr[$i]])>0) { ?><?=strtoupper($payment[$arr[$i]])?>
                        <?php }
                        }?>
                      </small></td>
                      <td>Rp. <?=number_format($payment['harga'])?></td>
                    </tr>
                    <!-- <tr>
                      <td><b>Biaya Pasang Baru (PSB)</b><br>
                        <small>
                          Hanya akan ditagihkan pada bulan pertama saja  
                      </small></td>
                      <?php //$pasang=100000; ?>
                      <td>Rp. <?=number_format($pasang)?></td>
                    </tr> -->
                    <tr>
                      <th><b>TOTAL</b></th>
                      <th>Rp. <?=number_format($setor=$pasang+$payment['harga'])?></th>
                    </tr>
                    <?php endif ?>
                </table>
                </div>
            </div>
            <div class="col-md-12 padding-3 mt-3 mb-3" style="margin-bottom: 12px;margin-top: 12px;">
              <form action="process_payment.php" method="POST">
                <input type="hidden" name="id" value="<?=$payment['id_subscribe']?>">
                <input type="hidden" name="gateway" value="<?=$_GET['gateway']?>">
                <input type="hidden" name="setor" value="<?=$setor?>">
                <button type="submit" style="padding: 8px;border-radius: 8px;" class=" gateway text-center <?=$gateway['nama_gateway']?> col-lg-12">Lanjutkan Pembayaran menggunakan <?=strtoupper($gateway['nama_gateway'])?></button>
              </form>
              <!-- <a style="padding: 8px;border-radius: 8px;" class=" gateway text-center <?=$gateway['icon']?> col-lg-12" href="payment_process.php?id=<?=$payment['id_subscribe']?>&gateway=<?=$_GET['gateway']?>"><?=strtoupper($gateway['nama_gateway'])?></a> -->
            </div>
            <div class="col-md-12 padding-3">
                    <h4>
                    <address>
                      <strong>PT Telekomunikasi Indonesia (Persero) Tbk</strong><br>
                      Menara Jamsostek North Tower 24th floor<br>Jl. Gatot Subroto No.Kav. 38, Kuningan Bar., Kec. Mampang Prpt., Kota Jakarta Selatan, DKI Jakarta 12710
                    </address>
                    </h4>
            </div>
        </div>
    </div>
    <!-- end: content -->
  </div>

<!-- start: Javascript -->
<script src="admin/asset/js/jquery.min.js"></script>
<script src="admin/asset/js/jquery.ui.min.js"></script>
<script src="admin/asset/js/bootstrap.min.js"></script>


<!-- plugins -->
<script src="admin/asset/js/plugins/moment.min.js"></script>
<script src="admin/asset/js/plugins/jquery.nicescroll.js"></script>


<!-- custom -->
<script src="admin/asset/js/main.js"></script>
<script type="text/javascript">
</script>
<!-- end: Javascript -->
</body>
</html>