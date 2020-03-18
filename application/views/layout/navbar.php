    <div class="container-fluid">  
      <ul class="navbar-nav">
        <li class="nav-item ml-2">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>


      <div class="collapse navbar-collapse order-3 ml-2" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index3.html" class="nav-link">Penggunaan</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">About</a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?php echo $user['username']; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-info">
              <img src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>" class="img-circle elevation-2" alt="User Image">

              <p>
                <?php echo $user['username']; ?>
                <small>Member since <?php echo date('F d Y', $user['date_created']); ?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="<?php echo base_url('member/profile')?>" class="btn btn-default btn-flat">Profile</a>
              <a href="<?php echo base_url('auth/logout')?>" class="btn btn-default btn-flat float-right" data-toggle="modal" data-target="#logOutModal">Sign out</a>
            </li>
          </ul>
        </li>
        <li class="nav-item mt-2">
          <button class="navbar-toggler" style="font-size: 1rem;" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-bars"></span>
          </button>
        </li>
      </ul>

    </div>