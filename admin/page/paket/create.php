<?php 
  if (isset($_POST['simpan'])) {

     $img=$_FILES['img']['name'];
    if(strlen($img)>0) {
      if (is_uploaded_file($_FILES['img']['tmp_name'])) {
              move_uploaded_file($_FILES['img']['tmp_name'], "../images/".$img);
            }
      $image=",'".$img."'";
    }else{$image=",''";}
    $query="INSERT INTO paket 
    (nama_paket,deskripsi,harga,durasi,internet,tv,tel,etc,kuota,badge,img) values 
    ('".$_POST['nama']."','".$_POST['deskripsi']."','".$_POST['harga']."','".$_POST['durasi']."','".$_POST['internet']."','".$_POST['tv']."','".$_POST['tel']."','".$_POST['etc']."','".$_POST['kuota']."','".$_POST['badge']."' $image)";
    $sql=mysqli_query($con,$query);
    if ($sql) {
      echo "<script>alert('Data berhasil ditambah!');window.location.href='index.php?p=Subscribes'</script>";
    }else{
      echo "<script>alert('Penambahan data gagal!');window.location.href='index.php?p=Subscribes'</script>";
    }
  }

 ?>
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah paket</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">NAMA PAKET</label>
              <input required type="text" name="nama"  class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Harga (dalam rupiah)</label>
              <input type="number" name="harga"  class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Durasi (hari)</label>
              <input type="text" name="durasi"  class="form-control input-lg">
            </div>
            <?php $arr=array('internet','tv','tel','kuota','etc');
                 for ($i=0; $i < 5; $i++) { //if(strlen($row[$arr[$i]])>0) { 
                  // echo strtoupper($row[$arr[$i]])."<br>"; ?>

                  <div class="form-group">
                    <label><?=strtoupper($arr[$i])?><span class="pull-right" style="color: red">*) Kosongkan bila tidak ada fitur <?=$arr[$i]?></span></label>
                    <input type="text" class="form-control" name="<?=$arr[$i]?>">
                  </div>
                <?php }//}?>
            <div class="form-group">
              <label>DESKRIPSI</label>
              <textarea class="form-control" name="deskripsi" required  id="editor"></textarea>
            </div>
            <div class="form-group">
              <label>Badge</label>
              <select class="form-control" name="badge">
                <option value="Featured">Featured</option>
                <option value="Offer">Offer</option>
                <option value="Hottest" >Hottest</option>
              </select>
            </div>
            <div class="form-group">
              <label>GAMBAR </label>
              <input type="file" name="img" class="form-control" accept="image/*">
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
