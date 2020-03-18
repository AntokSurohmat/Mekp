    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user');?>"><small>Home</small></a></li>
              <li class="breadcrumb-item active"><small>Acces Forbidden</small></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">403</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Acces Forbidden.</h3>

          <p>
           It look you dont have permission to access that pages. <br>
           you may <a href="<?php echo base_url();?>">return to Home</a>
          </p>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->