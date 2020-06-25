<?php 
  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from customer where NIK='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=customer'</script>";
    } else {
      echo mysqli_error($con);
    }
  }elseif (isset($_POST['message'])) {
    include 'page/send-message.php';
  }elseif (isset($_POST['accept'])) {
    $accept=mysqli_query($con,"UPDATE subscribe SET aktif='aktif' where id_subscribe='".$_POST['id']."'");
    if ($accept) {
      echo "<script>alert('Pembayaran Terkonfirmasi')</script>";
    }
  }elseif (isset($_POST['reject'])) {
    $reject=mysqli_query($con,"DELETE from subscribe where id_subscribe='".$_POST['id']."'");
    if ($reject) {
      echo "<script>alert('Sian bat ditolak')</script>";
    }
  }
 ?>
<style type="text/css">
  .select{
    border-radius: 5px;
    border:1px solid lightblue;
    width: 99px;
  }
</style>
<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title d-print-block">Subscription Active</h3>
          <!-- <a href="page/customer/print.php?act=print<?=$dom?>" class="btn btn-primary no-print d-print-none"><i class="fa fa-print"></i> Print</a> -->
          <br>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Visual</th>
              <th>Alamat</th>
              <th>Payment</th>
              <th class="no-print d-print-none"></th>
            </tr>
            </thead>
            <tbody>
            	<?php 
                $no=0;
                $sql="SELECT * from subscribe JOIN customer on subscribe.nik=customer.nik where aktif='aktif' order by time desc";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)):
                  $no++;
                  $nik=$row['NIK'];
                  $ttl=$row['tempatlahir'].', '.$row['tanggallahir'];
                  if (strlen($row['alamat']) > 100){

                    $str = substr($row['alamat'], 0, 100) . '<a href="?p=customer&act=edit&id='.$nik.'&n"> .. Read more</a>';
                  }else{
                    $str=$row['alamat'];
                  }
                  $dom=mysqli_fetch_array(mysqli_query($con,"SELECT wilayah_provinsi.nama as provinsi, wilayah_kabupaten.nama as kota, wilayah_kecamatan.nama as kecamatan from wilayah_kecamatan join wilayah_kabupaten on wilayah_kecamatan.kabupaten_id=wilayah_kabupaten.id join wilayah_provinsi on wilayah_kabupaten.provinsi_id where wilayah_kecamatan.id='".$row['kecamatan']."' and wilayah_kabupaten.id='".$row['kota']."' and wilayah_provinsi.id='".$row['provinsi']."'"));
                  $additional=" Kecamatan ".$dom['kecamatan'].",<br> Kota ".$dom['kota'].",<br> Provinsi ".$dom['provinsi'];
               ?>
               <tr>
                <td><?=$no?></td>
                <td>  <i class="fa fa-toggle-up"></i>   &nbsp;    <?= $nik ?><br>
                      <i class="fa fa-user"></i>        &nbsp;    <b><?= $row['nama_customer'] ?></b><br>
                      <i class="fa fa-calendar"></i>    &nbsp;    <?= $ttl ?><br>
                      <i class="fa fa-phone"></i>       &nbsp;    <?= $row['tel'] ?><br>
                      <i class="fa fa-envelope"></i>    &nbsp;    <?= $row['email'] ?><br>
                </td>
                <td>
                      <img width="50px" src="../img/selfie/<?=$nik.$row['img']?>" title="<?php 
                      if( $row['nama_customer']=='Pink Guy'      ||
                          $row['nama_customer']=='pinkguy'       ||
                          $row['nama_customer']=='Filthy Frank'  ||
                          $row['nama_customer']=='filthy frank'  ||
                          $row['nama_customer']=='filthyfrank'   ||
                          $row['nama_customer']=='pink guy'      ){ 
                            echo 'Are he is Joji?';
                        }elseif($row['nama_customer']=='Arnoldpo'){
                            echo 'Hilih kintil!';
                        }else{ 
                            echo $row['nama_customer']; 
                        } ?>">

                    <img width="50px" src="../img/identity/<?=$nik.$row['identity']?>" title="<?php 
                      if( $row['nama_customer']=='Pink Guy'      ||
                          $row['nama_customer']=='pinkguy'       ||
                          $row['nama_customer']=='Filthy Frank'  ||
                          $row['nama_customer']=='filthy frank'  ||
                          $row['nama_customer']=='filthyfrank'   ||
                          $row['nama_customer']=='pink guy'      ){ 
                            echo 'Are he is Joji?';
                        }elseif($row['nama_customer']=='Arnoldpo'){
                            echo 'Hilih kintil!';
                        }else{ 
                            echo $row['nama_customer']; 
                        } ?>">
                </td>
                <td><?= $str ?>, <br><?=$additional?></td>
                <td>
                    <button type="button" class="btn" style="color: white;background: #333" title="Invoice" data-toggle="modal" data-target="#payment<?=$row['id_subscribe']?>"><i class="fa fa-money"></i></button></td>
                <td class="no-print d-print-none"><!-- 
                  <form method="POST">
                    <input type="hidden" name="id" value="<?=$row['id_subscribe']?>">
                    <button type="submit" class="btn btn-success" class="" title="Accept request" name="accept" value="Pemasangan"><i class="fa fa-check"></i></button>
                    <button type="submit" class="btn btn-danger" name="reject" title="Reject request" value="Pemasangan"><i class="fa fa-times"></i></button> -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" title="Send message" data-target="#message<?=$row['id_subscribe']?>"><i class="fa fa-envelope"></i></button>
                  <!-- </form> -->
                </td>
               </tr>
              <?php endwhile;

                $sql="SELECT * from subscribe where aktif='pending' order by time desc";
                $query = mysqli_query($con, $sql);
                 while ($row = mysqli_fetch_assoc($query)):
                  $no++;
                  $nik=$row['NIK'];
                  $ttl=$row['tempatlahir'].', '.$row['tanggallahir'];
                  if (strlen($row['alamat']) > 100){

                    $str = substr($row['alamat'], 0, 100) . '<a href="?p=customer&act=edit&id='.$nik.'&n"> .. Read more</a>';
                  }else{
                    $str=$row['alamat'];
                  }
                  $dom=mysqli_fetch_array(mysqli_query($con,"SELECT wilayah_provinsi.nama as provinsi, wilayah_kabupaten.nama as kota, wilayah_kecamatan.nama as kecamatan from wilayah_kecamatan join wilayah_kabupaten on wilayah_kecamatan.kabupaten_id=wilayah_kabupaten.id join wilayah_provinsi on wilayah_kabupaten.provinsi_id where wilayah_kecamatan.id='".$row['kecamatan']."' and wilayah_kabupaten.id='".$row['kota']."' and wilayah_provinsi.id='".$row['provinsi']."'"));
                  $additional=" Kecamatan ".$dom['kecamatan'].",<br> Kota ".$dom['kota'].",<br> Provinsi ".$dom['provinsi'];
               ?>
               <tr>
                <td><?=$no?></td>
                <td>  <i class="fa fa-toggle-up"></i>   &nbsp;    <?= $nik ?><br>
                      <i class="fa fa-user"></i>        &nbsp;    <b><?= $row['nama_customer'] ?></b><br>
                      <i class="fa fa-calendar"></i>    &nbsp;    <?= $ttl ?><br>
                      <i class="fa fa-phone"></i>       &nbsp;    <?= $row['tel'] ?><br>
                      <i class="fa fa-envelope"></i>    &nbsp;    <?= $row['email'] ?><br>
                </td>
                <td>
                      <img width="50px" src="../img/selfie/<?=$nik.$row['img']?>" title="<?php 
                      if( $row['nama_customer']=='Pink Guy'      ||
                          $row['nama_customer']=='pinkguy'       ||
                          $row['nama_customer']=='Filthy Frank'  ||
                          $row['nama_customer']=='filthy frank'  ||
                          $row['nama_customer']=='filthyfrank'   ||
                          $row['nama_customer']=='pink guy'      ){ 
                            echo 'Are he is Joji?';
                        }elseif($row['nama_customer']=='Arnoldpo'){
                            echo 'Hilih kintil!';
                        }else{ 
                            echo $row['nama_customer']; 
                        } ?>">

                    <img width="50px" src="../img/identity/<?=$nik.$row['identity']?>" title="<?php 
                      if( $row['nama_customer']=='Pink Guy'      ||
                          $row['nama_customer']=='pinkguy'       ||
                          $row['nama_customer']=='Filthy Frank'  ||
                          $row['nama_customer']=='filthy frank'  ||
                          $row['nama_customer']=='filthyfrank'   ||
                          $row['nama_customer']=='pink guy'      ){ 
                            echo 'Are he is Joji?';
                        }elseif($row['nama_customer']=='Arnoldpo'){
                            echo 'Hilih kintil!';
                        }else{ 
                            echo $row['nama_customer']; 
                        } ?>">
                </td>
                <td><?= $str ?>, <br><?=$additional?></td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message<?=$row['id_subscribe']?>"><i class="fa fa-envelope"></i></button><br><small>Belum ada pembayaran</small></td>
                <!-- <td class="no-print d-print-none">
                </td -->>
               </tr>
              <?php endwhile;


               ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

<?php $sql="SELECT * from subscribe JOIN customer on subscribe.nik=customer.nik order by time desc";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)): ?>
                                <div class="modal fade modal-v2" id="message<?=$row['id_subscribe']?>">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="col-md-3 modal-content-left">
                                            <center><b class="modal-content-left-percent"><i class="fa fa-envelope"></i></b>
                                            <p class="modal-content-left">Encrypted</p>
                                            </center>
                                        </div>  
                                        <div class="col-md-9 modal-content-right">
                                          <form method="POST">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <p>Send a message to <?=$row['nama_customer']?>.</p>
                                            <input type="hidden" name="author" value="<?=$_SESSION['name']?>">
                                            <input type="hidden" name="_encrypt" value="<?=md5($row['NIK']).md5($row['id_subscribe'])?>">
                                            <!-- <input type="hidden" name="id_subscribe" class="modal-content-right-text-mail" value="<?=$row['id_subscribe']?>"> -->
                                            <input type="hidden" name="subject" value="subscribe">
                                            <input type="hidden" name="destination" class="modal-content-right-text-mail" value="<?=$row['NIK']?>">
                                            <input type="text" name="message" class="modal-content-right-text-mail" />
                                            <button type="submit" class="btn btn-primary">Send <i class="fa fa-paper-plane"></i></button>
                                          </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

<?php endwhile; ?>

<?php $sql="SELECT * from  payment  order by payment.time desc";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)):

$setor=mysqli_fetch_array(mysqli_query($con,"SELECT * from payment join subscribe on payment.id_subscribe=subscribe.id_subscribe  where subscribe.id_subscribe='".$row['id_subscribe']."'"));
$payment=mysqli_fetch_array(mysqli_query($con,"SELECT * from paket  join subscribe on paket.id_paket=subscribe.id_paket right join customer on customer.NIK=subscribe.NIK where subscribe.id_subscribe='".$row['id_subscribe']."'"));
$gateway=mysqli_fetch_array(mysqli_query($con,"SELECT * from gateway where id_gateway='".$setor['gateway']."'"));

                 ?>
                                <div class="modal fade bd-example-modal-xl" id="payment<?=$row['id_subscribe']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                      <!-- <?php include '../invoice.php?id='.$row['id_subscribe']; ?> -->
                                      <div class="panel invoice-v1-content">
        <div class="panel-body">
            <div class="col-md-12 invoice-v1-header">
              <div class="col-md-12">
                <h2 class="text-center"><b>Pembayaran Berhasil</b></h2>
                <h1><b>Invoice</b></h1>
              </div>
              <div class="col-md-12">

                <div class="col-md-6">
                <h4>
                <address>
                  <strong>Subscribe #: <?=$payment['id_subscribe']?></strong><br>
                  Created: <?=date_format(date_create($payment['time']),'d F Y')?><br>
                  Method: <?=strtoupper($gateway['nama_gateway'])?>
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
                </table>
                </div>
            </div>
            <div class="col-md-12 padding-3">
                    <h6>
                    <address>
                      <strong>PT Telekomunikasi Indonesia (Persero) Tbk</strong><br>
                      Menara Jamsostek North Tower 24th floor<br>Jl. Gatot Subroto No.Kav. 38, Kuningan Bar., Kec. Mampang Prpt., Kota Jakarta Selatan, DKI Jakarta 12710
                    </address>
                    </h6>
            </div>

            <div class="col-md-12 padding-3">
            <!-- <form method="POST" class="form-row"> -->
                    <!-- <input type="hidden" name="id" value="<?=$row['id_subscribe']?>"> -->
                    <!-- <button type="submit" class="col-lg-4 col-md-4 col-xs-12 btn btn-success" class="" title="Accept request" name="accept" value="Pemasangan"><i class="fa fa-check"></i></button> -->
                    <!-- <button type="submit" class="col-lg-4 col-md-4 col-xs-12 btn btn-danger " name="reject" title="Reject request" value="Pemasangan"><i class="fa fa-times"></i></button> -->
                    <!-- <button type="button" class="col-lg-4 col-md-4 col-xs-12 btn-block btn btn-primary " data-toggle="modal" title="Send message" data-target="#message<?=$row['id_subscribe']?>"><i class="fa fa-envelope"></i></button> -->
                  <!-- </form> -->
            </div>
        </div>
    </div>
                                    </div>
                                  </div>
                                </div>

<?php endwhile; ?>