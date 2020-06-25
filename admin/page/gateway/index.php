<?php 

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from Gateway where id_Gateway='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=Gateway'</script>";
    } else {
      echo mysqli_error($con);
    }
  }

 ?>

<link rel="stylesheet" type="text/css" href="../styles/method.css">
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
<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <span class=" pull-right"><a href="?p=Gateway&act=create" class="btn btn-success"><i class="fa fa-calendar"></i> Tambah Data Gateway</a></span>
          <h3 class="box-title">Daftar Gateway</h3><br>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Nama Gateway</th>
              <th title="Virtual Account number starting">VA Start</th>
              <th><?php //echo date('Y-m-d H:i:s');?></th>
            </tr>
            </thead>
            <tbody>
            	<?php $no=0;
            $subs=mysqli_query($con,"SELECT * from gateway");
            while($row=mysqli_fetch_array($subs)): $no++; ?>
              <tr>
                <td><?=$no?></td>
                <a href="?p=Gateway&act=edit&id=<?= $row['id_gateway'] ?>">
                <td>
                    <label class="element-animation1 btn btn-lg btn-block <?=$row["nama_gateway"]?> ">
                      <span class="btn-label">
                        <i class="glyphicon glyphicon-chevron-right"></i>
                      </span>
                      <!-- <input type="radio" name="gateway" required value="<?=$row["id_gateway"]?>"> -->
                      <?=strtoupper($row["nama_gateway"])?>
                    </label>
                </td>
                </a>
                <td><?=$row["VA_start"]?></td>
                <td>
                  <a href="?p=Gateway&act=edit&id=<?= $row['id_gateway'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  <a href="?p=Gateway&delete&id=<?= $row['id_gateway'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                </td>
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