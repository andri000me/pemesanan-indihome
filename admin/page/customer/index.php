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
          <span class="pull-right"><a href="?p=customer&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Data customer</a></span>
          <h3 class="box-title d-print-block">Data customer</h3>
          <!-- <a onclick="javascript:window.print()" class="btn btn-primary no-print d-print-none"><i class="fa fa-print"></i> Print</a> -->
          <!-- <a href="page/customer/print.php?act=print<?=$dom?>" class="btn btn-primary no-print d-print-none"><i class="fa fa-print"></i> Print</a> -->
          <br>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>TTL</th>
              <th>No. Telp/WA</th>
              <th>E-mail</th>
              <th>Alamat</th>
              <!-- <th class="no-print d-print-none"></th> -->
            </tr>
            </thead>
            <tbody>
            	<?php 
                $no=0;
                  $sql = "SELECT * from customer order by nik";
            		$query = mysqli_query($con, $sql);
            		while ($row = mysqli_fetch_assoc($query)):
                   $dom=mysqli_fetch_array(mysqli_query($con,"SELECT wilayah_provinsi.nama as provinsi, wilayah_kabupaten.nama as kota, wilayah_kecamatan.nama as kecamatan from wilayah_kecamatan join wilayah_kabupaten on wilayah_kecamatan.kabupaten_id=wilayah_kabupaten.id join wilayah_provinsi on wilayah_kabupaten.provinsi_id where wilayah_kecamatan.id='".$row['kecamatan']."' and wilayah_kabupaten.id='".$row['kota']."' and wilayah_provinsi.id='".$row['provinsi']."'"));
                  $additional=" Kecamatan ".$dom['kecamatan'].",<br> Kota ".$dom['kota'].",<br> Provinsi ".$dom['provinsi'];
                  $no++;
                  $nik=$row['NIK'];
                  $ttl=$row['tempatlahir'].', '.$row['tanggallahir'];
                  if (strlen($row['alamat']) > 100){

                    $str = substr($row['alamat'], 0, 100) . '<a href="?p=customer&act=edit&id='.$nik.'&n"> .. Read more</a>';
                  }else{
                    $str=$row['alamat'];
                  }
            	 ?>
            	 <tr>
                <td><?=$no?></td>
                <td><?= $nik ?></td>
            	 	<td>
                  <div class="row">
                    <div class="col-lg-6">
                      <?= $row['nama_customer'] ?>
                    </div>
                    <div class="col-lg-6">
                      <img width="50px" src="asset/img/customer/<?=$row['img']?>" title="<?php 
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
                    </div>
                    
                  </div>
                </td>
                <td><?= $ttl ?></td>
                <td><?= $row['tel'] ?><br><?= $row['tel_alt'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $str ?>, <br><?=$additional?></td>
                <!-- <td class="no-print d-print-none">
                  <a href="index.php?p=customer&act=edit&id=<?= $row['NIK'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  <a href="index.php?p=customer&delete&id=<?= $row['NIK'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                </td> -->
            	 </tr>
            	<?php endwhile; ?>
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
