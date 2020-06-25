<div class="col-lg-12" style="padding: 8px;">
  
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Messages</h5>
      </div>
      <div class="modal-body" style="background: white;">
          <div class="accordion" id="msg">
        <?php $notifications=mysqli_query($con,"SELECT * from messages where destination ='admin'  group by author order by time desc"); ?>
        <?php while($msg=mysqli_fetch_array($notifications)):
          $cust=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM customer where NIK=$msg[author]"));
          
          $author=$cust['nama_customer'];
          ?>
          <hr>
        <div class="card">
          <a data-toggle="collapse" data-target="#<?=$msg['author']?>" aria-expanded="true" aria-controls="collapseOne">
          <div class="card-header" style="color: linear-gradient(to right, rgba(200,30,45,1), rgba(200,30,45,0.7));" id="<?=$msg['id_messages']?>">
              <div class="form-row">
                <div class="col-lg-9">
                  <b><?=$msg['subject']?></b><br>
                  <span class="pull-left"><?=$author?></span>
                </div>

                <div class="col-lg-3">
                  <span class="pull-right">
                    <h4><small><b>
                  <?php 
                  $datenow=date('Y-m-d');
                  $date=date_format(date_create($msg['time']),'Y-m-d');
                  if ($date==$datenow) {
                    echo date_format(date_create($msg['time']),'H:i');
                  }else{
                    echo date_format(date_create($msg['time']),'H:i d F Y');
                  } ?></b>
                </small></h4>
                  </span>
                </div>
              </div>
              
            <!-- </h2> -->
          </div>
      </a>
          <div id="<?=$msg['author']?>" class="collapse " aria-labelledby="<?=$msg['id_messages']?>" data-parent="#msg">

            <div class="card-body">
              <form  method="POST" class="form-row">
                <div class="col-lg-10">
                  <input type="hidden" name="_encrypt" value="<?=md5('admin'.$msg['author'])?>">
                  <input type="hidden" name="destination" class="form-control" value="<?=$msg['author']?>">
                  <input type="hidden" name="subject" class="form-control" value="<?=$msg['subject']?>">
                  <input type="hidden" name="author" class="form-control" value="admin">
                  <input type="text" name="message" class="form-control" placeholder="Send a reply...">
                </div>
                <div class="col-lg-2">
                  <button type="submit" class="btn btn-primary" name="send"><i class="fa fa-send"></i></button>
                </div>
              </form>
            </div>
            <div class="card-body col-lg-12">
              <?php 
              $bubble=mysqli_query($con,"SELECT * from messages where (destination ='admin' and author ='".$msg['author']."' ) or (destination='".$msg['author']."' and author='admin') order by time desc");
              while ($chat=mysqli_fetch_array($bubble)): ?>
                <?php if ($chat['author']=='admin'): ?>
                  <div class="col-lg-12 row pull-right" style="margin: 12px;">

                    <div class="col-lg-3"></div>
                    <div class="col-lg-8">
                    <p class="chat-ally text-right">
                      <?=$chat['message']?>
                      <br><small style="color: #999">
                        <?php 
                  $datenow=date('Y-m-d');
                  $date=date_format(date_create($chat['time']),'Y-m-d');
                  if ($date==$datenow) {
                    echo date_format(date_create($chat['time']),'H:i');
                  }else{
                    echo date_format(date_create($chat['time']),'H:i d F Y');
                  } ?>
                      </small>
                    </p>
                    </div>
                    <div class="col-lg-1">
                    <img class="rounded-circle" width="20px" height="20px" src="<?php if (strlen($_SESSION['img'])>0): ?>
                      asset/img/customer/<?=$_SESSION['img']?>
                    <?php else: ?>
                      asset/img/avatar.jpg
                    <?php endif ?>">
                    </div>

                  <br><br>
                  </div>
                <?php elseif ($chat['destination']=='admin'): ?>
                  <div class="col-lg-12 row pull-left" style="margin: 12px;">

                    <div class="col-lg-1">
                    <img class="rounded-circle" width="20px" height="20px" src="<?php if($chat['author']=="admin" || $chat['author']=="Admin" || $chat['author']=="ADMIN"): ?>
                      asset/img/avatar2.png
                    <?php elseif (strlen($chat['author'])>0): ?>
                      asset/img/customer/<?=$chat['author']?>
                    <?php else: ?>
                      asset/img/avatar.jpg
                    <?php endif ?>">
                    </div>
                    <div class="col-lg-8">
                      <p class="chat-enemy">
                      <?=$chat['message']?>
                      <br><small style="color: #999">
                        <?php 
                  $datenow=date('Y-m-d');
                  $date=date_format(date_create($chat['time']),'Y-m-d');
                  if ($date==$datenow) {
                    echo date_format(date_create($chat['time']),'H:i');
                  }else{
                    echo date_format(date_create($chat['time']),'H:i d F Y');
                  } ?>
                      </small>
                    </p>
                    </div>

                    <div class="col-lg-3"></div>
                  <br><br>
                  </div>
                <?php endif ?>
              <?php endwhile; ?>
              <br>
              <br>
            </div>
            
            
          </div>
        </div>
        <br><br>
        <?php endwhile; ?>
      </div>
      </div>
</div>