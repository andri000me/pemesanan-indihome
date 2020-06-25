
<?php 
  $id=$_GET['id'];
  $edit=mysqli_fetch_array(mysqli_query($con,"SELECT * from Gateway where id_gateway='$id'"));
  if (isset($_POST['simpan'])) {
    $query="UPDATE gateway SET nama_gateway='".$_POST['nama']."',VA_start='".$_POST['VA']."',bg='".$_POST['bg']."',font='".$_POST['font']."' where id_gateway='".$id."'";
    $sql=mysqli_query($con,$query);
    // echo $query;
    if ($sql) {
      echo "<script>alert('Pengubahan data berhasil!');window.location.href='?p=Gateway'</script>";
    }else{
      echo "<script>alert('Pengubahan data gagal!');window.location.href='?p=Gateway'</script>";
    }
  }

 ?>
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form edit Gateway</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">NAMA GATEWAY</label>
              <input required type="text" name="nama" value="<?php echo $edit['nama_gateway'];?>" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Virtual Account Start</label>
              <input type="number" name="VA" value="<?php echo $edit['VA_start'];?>" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Background Color</label>
              <input type="color" name="bg" value="<?php echo $edit['bg'];?>" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Font Color</label>
              <input type="color" name="font" value="<?php echo $edit['font'];?>" class="form-control input-lg">
            </div>
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </div>

  </div>
