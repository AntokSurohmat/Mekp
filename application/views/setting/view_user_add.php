    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><small>Setting</small></a></li>
              <li class="breadcrumb-item"><small><?php echo $title; ?></small></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $title; ?>&ensp;</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('setting/useradd')?>" method="post">
            <div class="card-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="form-group row ml-3">
              <label for="addUserSetting" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" name="a" class="form-control" id="addUserSetting" placeholder="Username" value="<?php echo set_value('a');?>">
                <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-3">
              <label for="addEmailSetting" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" name="bb" class="form-control" id="addEmailSetting" placeholder="Email" value="<?php echo set_value('bb');?>">
                <?php echo form_error('bb', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-3">
              <label for="addPasswordSett" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="text" name="c" class="form-control" id="addPasswordSett" placeholder="Password">
                <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-3">
              <label for="addPasswordSetting" class="col-sm-2 col-form-label">Retry Password</label>
              <div class="col-sm-10">
                <input type="text" name="d" class="form-control" id="addPasswordSetting" placeholder="Retry Password" >
                <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?> 
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-info btn-sm" href="<?php echo base_url('setting/user');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back To User List
              </a>
              <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-user-plus"></i>&ensp;Add User</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
