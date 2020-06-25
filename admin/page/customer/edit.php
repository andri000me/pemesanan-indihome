<?php 
  $NIK=$_GET['id'];
  $edit=mysqli_fetch_array(mysqli_query($con,"SELECT * from customer where NIK = '".$NIK."'"));
  if (isset($_POST['simpan'])) {
    //if(($_POST['photo'])!=null) {
      
      $a=$_FILES['photo']['name'];

        if (strlen($a)>0) {
            if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
              move_uploaded_file($_FILES['photo']['tmp_name'], "asset/img/customer/".$a);
              //$img=",img='".$_POST['photo']."'";
              $img=",img='".$a."'";
            }
          //}
    }else{
      $img="";
    }
    $query="UPDATE customer SET NIK='".$_POST['NIK']."', nama_customer='".$_POST['nama']."', tempatlahir='".$_POST['pob']."', tanggallahir='".$_POST['dob']."', tel='".$_POST['tel']."',email='".$_POST['email']."',alamat='".$_POST['alamat']."',rw='".$_POST['rw']."',rt='".$_POST['rt']."' $img where NIK='".$NIK."'";
    $sql=mysqli_query($con,$query);
    if ($sql) {
        mysqli_query($con,"UPDATE user set nama='".$_POST['nama']."', username='".$_POST['NIK']."' where username='".$NIK."'");
      echo "<script>alert('Data berhasil diubah!');window.location.href='?p=customer'</script>";
    }else{
      echo "<script>alert('Pengubahan data gagal!');window.location.href='?p=customer'</script>";
      //echo $query;
    }
  }

 ?>
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form ubah data customer</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post"  enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama customer</label>
              <input required type="text" name="nama" value="<?=$edit['nama_customer']?>" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">NIK</label>
              <input required type="text" name="NIK" value="<?=$edit['NIK']?>" class="form-control input-lg" maxlength="16" minlength="16">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tempat Lahir</label>
              <input required type="text" name="pob" value="<?=$edit['tempatlahir']?>" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Lahir</label>
              <input required type="date" name="dob" value="<?=$edit['tanggallahir']?>"  class="form-control input-lg">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">No. Telp / WA</label>
              <input required type="tel" name="tel" value="<?=$edit['tel']?>"  class="form-control input-lg">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">E-mail</label>
              <input required type="email" name="email" value="<?=$edit['email']?>" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Alamat</label>
              <textarea required name="alamat" placeholder="Masukan Job Description" class="form-control input-lg" id="exampleInputEmail1"><?=$edit['alamat']?></textarea>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">RW</label>
                  <input type="text" name="rw" value="<?=$edit['rw']?>" class="form-control input-lg">

                  <!-- <select required id="rw" name="rw" class="form-control input-lg">
                    <option selected disabled>-- Pilih RW --</option>
                    <?php $RW=mysqli_query($con,"SELECT * from rw order by rw");
                     while ($rw=mysqli_fetch_array($RW)) {?>
                      <option value="<?=$rw['rw']?>"><?=$rw['rw']?></option>
                    <?php } ?>
                  </select> -->
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">RT</label>
                  <input type="text" name="rt" value="<?=$edit['rt']?>" class="form-control input-lg">
                  <!-- <select required id="rt" name="rt" class="form-control custom-select input-lg">
                    <option selected disabled>-- Pilih RT --</option>
                    <?php 
                    $RW=mysqli_query($con,"SELECT * from rw order by rw");
                     while ($rw=mysqli_fetch_array($RW)) {
                    $RT=mysqli_query($con,"SELECT * from rt where rw='".$rw['rw']."' order by rt");
                     while ($rt=mysqli_fetch_array($RT)) {?>
                      <option data-chained="<?=$rw['rw']?>" value="<?=$rt['rt']?>"><?=$rt['rt']?></option>
                    <?php }} ?>
                  </select> -->
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-10">
                  <label for="exampleInputEmail1">Pas Foto<small class="text-danger"> *)</small></label>
                  <input type="file" accept="image/*" name="photo" class="form-control input-lg">
                  <small class="text-danger">*) Kosongkan jika tidak ingin diubah</small>
                </div>
                <div class="col-md-2">
                  <label for="exampleInputEmail1">Sebelumnya</label>
                  <img width="100%" alt="<?=$edit['img']?>" title="<?=$edit['img']?>" src="asset/img/customer/<?=$edit['img']?>">
                </div>
              </div>
              
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
  <script type="text/javascript" src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script type="text/javascript" src="assets/plugins/jQuery/data-chained.js"></script>
  <script type="text/javascript">
    $("#rt").chained("#rw");
  </script>