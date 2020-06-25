                    <li class="<?php if (!isset($_GET['p'])){echo 'active';} ?> ripple">
                      <a class="nav-header" href="../admin"><span class="fa-home fa"></span> Dashboard 
                      </a>
                    </li>
                    <li class="<?php if (isset($_GET['p']) && strtolower($_GET['p'])=='user'){echo 'active';} ?> ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa-users fa"></span> User
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="?p=User">Data User</a></li>
                      </ul>
                    </li>                    
                    <li class="<?php if (isset($_GET['p']) && strtolower($_GET['p'])=='subscribes'){echo 'active';} ?> ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa-sticky-note fa"></span> Paket
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="?p=Subscribes">Data Paket</a></li>
                      </ul>
                    </li>
                    <li class="<?php if (isset($_GET['p']) && (strtolower($_GET['p'])=='request' || strtolower($_GET['p'])=='History')){echo 'active';} ?> ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa-clone fa"></span> Subscribes
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="?p=Request">Permintaan Pemesanan</a></li>
                        <li><a href="?p=History">Riwayat Pemesanan</a></li>
                      </ul>
                    </li>
                    <li class="<?php if (isset($_GET['p']) && strtolower($_GET['p'])=='customer'){echo 'active';} ?> ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa-paper-plane-o fa"></span> Customer
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="?p=Customer">Data Customer</a></li>
                      </ul>
                    </li>
                    <li class="<?php if (isset($_GET['p']) && strtolower($_GET['p'])=='gateway'){echo 'active';} ?> ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa-money fa"></span> Payment Gateway
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="?p=Gateway">Daftar Gateway</a></li>
                      </ul>
                    </li>
                    
          <br><br><br><br><br><br><br><br><br><br>