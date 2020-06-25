
<?php 
  $id=$_GET['id'];
  $edit=mysqli_fetch_array(mysqli_query($con,"SELECT * from paket where id_paket='$id'"));
  if (isset($_POST['simpan'])) {
     $img=$_FILES['img']['name'];
    if(strlen($img)>0) {
      if (is_uploaded_file($_FILES['img']['tmp_name'])) {
              move_uploaded_file($_FILES['img']['tmp_name'], "../images/".$img);
            }
      $image=",img=".$img;
    }else{$image="";}
    $query="UPDATE paket SET nama_paket='".$_POST['nama']."',deskripsi='".$_POST['deskripsi']."',harga='".$_POST['harga']."',durasi='".$_POST['durasi']."',internet='".$_POST['internet']."',tv='".$_POST['tv']."',tel='".$_POST['tel']."',etc='".$_POST['etc']."',kuota='".$_POST['kuota']."',badge='".$_POST['badge']."' $image where id_paket='".$id."'";
    $sql=mysqli_query($con,$query);
    echo $query;
    if ($sql) {
      echo "<script>alert('Pengubahan data berhasil!');window.location.href='index.php?p=Subscribes'</script>";
    }else{
      // echo "<script>alert('Pengubahan data gagal!');window.location.href='index.php?p=Subscribes'</script>";
    }
  }

 ?>
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form edit paket</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">NAMA PAKET</label>
              <input required type="text" name="nama" value="<?php echo $edit['nama_paket'];?>" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Harga (dalam rupiah)</label>
              <input type="number" name="harga" value="<?php echo $edit['harga'];?>" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label>Durasi (hari)</label>
              <input type="text" name="durasi" value="<?php echo $edit['durasi'];?>" class="form-control input-lg">
            </div>
            <?php $arr=array('internet','tv','tel','kuota','etc');
                 for ($i=0; $i < 5; $i++) { //if(strlen($row[$arr[$i]])>0) { 
                  // echo strtoupper($row[$arr[$i]])."<br>"; ?>

                  <div class="form-group">
                    <label><?=strtoupper($arr[$i])?><span class="pull-right" style="color: red">*) Kosongkan bila tidak ada fitur <?=$arr[$i]?></span></label>
                    <input type="text" class="form-control" value="<?=$edit[$arr[$i]]?>" name="<?=$arr[$i]?>">
                  </div>
                <?php }//}?>
            <div class="form-group">
              <label>DESKRIPSI</label>
              <textarea class="form-control" name="deskripsi" required  id="editor"><?php echo $edit['deskripsi'];?></textarea>
            </div>
            <div class="form-group">
              <label>Badge</label>
              <select class="form-control" name="badge">
                <option value="Featured" <?php if ($edit['badge']=='Featured'){echo "selected";} ?>>Featured</option>
                <option value="Offer" <?php if ($edit['badge']=='Offer'){echo "selected";} ?>>Offer</option>
                <option value="Hottest" <?php if ($edit['badge']=='Hottest'){echo "selected";} ?>>Hottest</option>
              </select>
            </div>
            <div class="form-group">
              <label>GAMBAR <span class="pull-right" style="color: red">*) abaikan bila tidak ada pengubahan</span></label>
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
