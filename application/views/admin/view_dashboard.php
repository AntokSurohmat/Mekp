    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $title ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('setting');?>"><small>Admin</small></a></li>
              <li class="breadcrumb-item"><small><?php echo $title; ?></small></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-danger">
              <h5><i class="fas fa-info"></i> Note:</h5>
              <p class="text-justify">Petunjuk Singkat Penggunaan Aplikasi ini bisa dilihat di bagian <b><i>Navbar</i></b> <a href="#" data-toggle="modal" data-target="#modal-detail"><b>Detail</b></a> , dan penjelasan tentang aplkasi ini bisa dilihat di <b><i>Navbar</i></b> <a href="#" data-toggle="modal" data-target="#modal-about"><b>About</b></a> .</p>
            </div>
          </div>
          <!--/. Col -->
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $countrole; ?></h3>

                <p>Access Menu</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="<?php echo base_url('admin/role');?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $countforbi; ?></h3>

                <p>Forbidden Menu</p>
              </div>
              <div class="icon">
                <i class="fas fa-ban"></i>
              </div>
              <a href="<?php echo base_url('admin/forbidden');?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $countmenu; ?></h3>

                <p>Menu</p>
              </div>
              <div class="icon">
                <i class="fas fa-folder"></i>
              </div>
              <a href="<?php echo base_url('setting');?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $countsubmenu; ?></h3>

                <p>Sub Menu</p>
              </div>
              <div class="icon">
                <i class="fas fa-folder-open"></i>
              </div>
              <a href="<?php echo base_url('setting/submenu');?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $countuser; ?></h3>

                <p>User Register</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="<?php echo base_url('setting/user');?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><strong>Selamat Datang</strong></h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box">
                  <div class="inner">
                    <br>
                    <br>
                    <i class="fas fa-home"></i>
                    <br>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="fas fa-home"></i>
                  </div>
                  <a href="<?php echo base_url();?>" class="small-box-footer bg-info">
                    Home
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box">
                  <div class="inner">
                    <br>
                    <br>
                    <i class="fas fa-book"></i>
                    <br>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="fas fa-book"></i>
                  </div>
                  <a href="<?php echo base_url('member/master');?>" class="small-box-footer bg-info">
                    Data Master
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box">
                  <div class="inner">
                    <br>
                    <br>
                    <i class="fas fa-tools"></i>
                    <br>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="fas fa-tools"></i>
                  </div>
                  <a href="<?php echo base_url('member/pertukaran');?>" class="small-box-footer bg-info">
                    Data Perawatan
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box">
                  <div class="inner">
                    <br>
                    <br>
                    <i class="fas fa-file-alt"></i>
                    <br>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="fas fa-file-alt"></i>
                  </div>
                  <a href="<?php echo base_url('member/laporan');?>" class="small-box-footer bg-info">
                    Data Laporan
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box">
                  <div class="inner">
                    <br>
                    <br>
                    <i class="fas fa-sign-out-alt"></i>
                    <br>
                    <br>
                  </div>
                  <div class="icon">
                    <i class="fas fa-sign-out-alt"></i>
                  </div>
                  <a href="<?php echo base_url('auth/logout')?>" class="small-box-footer bg-info" data-toggle="modal" data-target="#logOutModal">Sign out</a>
                </div>
              </div>

              <!-- ./col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div><!-- /.container-fluid -->


    </section>