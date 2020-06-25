<?php 
  if (isset($_POST['simpan'])) {
    // $field = array('');
    // $fill = array('');
    // input()
    $query="INSERT INTO gateway 
    (nama_gateway,font,bg,VA_start) values 
    ('".$_POST['nama']."','".$_POST['bg']."','".$_POST['font']."','".$_POST['VA']."')";
    $sql=mysqli_query($con,$query);
    if ($sql) {
      echo "<script>alert('Data berhasil ditambah!');window.location.href='?p=gateway'</script>";
    }else{
      echo "<script>alert('Penambahan data gagal!');window.location.href='?p=gateway'</script>";
    }
  }

 ?>
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah gateway</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
         <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">NAMA GATEWAY</label>
              <input required type="text" name="nama" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Virtual Account Start</label>
              <input type="number" name="VA" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Background Color</label>
              <input type="color" name="bg" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Font Color</label>
              <input type="color" name="font" class="form-control input-lg">
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
