<style type="text/css">
  div.dashboard{
    background: #fff;
    border-radius: 8px;
    border: 2px solid #1c84c6;
    margin: 4px;
    padding: 8px;
    color: #1c84c6;
  }
</style>
<div class="col-lg-12 row">
  
  <div class="col-lg-5 dashboard btn-3d row">
    <div class="col-lg-8">
        <span class="fa fa-heart"></span>
      <h2>Customer</h2>
      <?php $num=mysqli_num_rows(mysqli_query($con,"SELECT * from Customer")); ?>
    </div>
    <div class="col-lg-4">
      <button class=" btn btn-circle btn-3d btn-lg btn-primary" value="primary">
        <?=$num?>
      </button>
    </div>
  </div>

  <div class="col-lg-5 dashboard btn-3d row">
    <div class="col-lg-8">
        <span class="fa fa-paper-plane-o"></span>
      <h2>Berlanganan</h2>
      <?php $num=mysqli_num_rows(mysqli_query($con,"SELECT * from subscribe")); ?>
    </div>
    <div class="col-lg-4">
      <button class=" btn btn-circle btn-3d btn-lg btn-primary" value="primary">
        <?=$num?>
      </button>
    </div>
  </div>

</div>
