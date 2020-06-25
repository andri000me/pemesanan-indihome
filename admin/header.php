<nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="#" class="navbar-brand"> 
                 <b><img height="30px" src="../images/logo_large.png"></b>
                </a>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name">
                  <span class="pull-right">
                            <?php $notifications=mysqli_query($con,"SELECT * from messages where destination ='admin' group by author"); ?>
                            <?php if (mysqli_num_rows($notifications)>0): ?>
                            <a  class="btn" href="?p=message" style="background: transparent; color: white;border:none">
                            <i class="fa fa-bell"></i> 
                              <sup><span class="badge badge-light" style="background: white; color: rgba(200,30,45,1)">
                                <?php echo mysqli_num_rows($notifications); ?>
                              </span></sup>
                            <span class="sr-only">incoming messages</span>
                          </a>

                            <?php endif ?>
                          </span>
                </li>
                <li class="user-name"><span><?=$_SESSION['name']?></span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li><a href="#"><span class="fa fa-user"></span> My Profile</a></li>
                     <!-- <li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li> -->
                     <li role="separator" class="divider"></li>
                     <li class="more">
                      <ul>
                        <li><a href=""><span class="fa fa-cogs"></span></a></li>
                        <li><a href="?p=changepass"><span class="fa fa-lock"></span></a></li>
                        <li><a href="?logout"><span class="fa fa-power-off "></span></a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <!-- <li ><a href="#" class="opener-right-menu"><span class="fa fa-coffee"></span></a></li> -->
              </ul>
            </div>
          </div>
        </nav>