<?php 

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from paket where id_paket='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=Subscribes'</script>";
    } else {
      echo mysqli_error($con);
    }
  }

 ?>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <span class=" pull-right"><a href="?p=Subscribes&act=create" class="btn btn-success"><i class="fa fa-calendar"></i> Tambah Data paket</a></span>
          <h3 class="box-title">Data paket</h3><br>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Nama Paket</th>
              <th>Deskripsi</th>
              <th>Fitur</th>
              <th>Harga</th>
              <th>Badge</th>
              <th><?php //echo date('Y-m-d H:i:s');?></th>
            </tr>
            </thead>
            <tbody>
            	<?php 
                $no=0;
                $sql = "SELECT * from paket  order by id_paket desc ";
                $query = mysqli_query($con, $sql);
                //echo $sql;
                while ($row = mysqli_fetch_assoc($query)):
                  $no++;
                  if (strlen($row['deskripsi']) > 100){
                    $str = substr($row['deskripsi'], 0, 100) . '<a href="?p=Subscribes&act=edit&id='.$row['id_paket'].'&n#editor"> .. Read more</a>';
                  }else{
                    $str=$row['deskripsi'];
                  }
               ?>
               <tr>
                <td><?=$no?></td>
                <td width="20%"><?=$row['nama_paket']?></td>
                <td><?= $str ?></td>
                <td><?php $arr=array('internet','tv','kuota','etc');
                 for ($i=0; $i < 4; $i++) { if(strlen($row[$arr[$i]])>0) { echo strtoupper($row[$arr[$i]])."<br>"; }}?></td>
                <td>Rp.<?=number_format($row['harga'])?></td>
                <td><?=$row['badge']?></td>
                <td>
                  <a href="index.php?p=Subscribes&act=edit&id=<?= $row['id_paket'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  <a href="index.php?p=Subscribes&delete&id=<?= $row['id_paket'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                </td>
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