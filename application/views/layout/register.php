<div class="register-box">
  <div class="register-logo">
    <a href="<?php echo base_url();?>"><b>S</b>istem<b>I</b>nventory</a>
  </div>
  <?php echo $this->session->flashdata('message'); ?>
  <!-- /.Register-logo -->
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?php echo base_url('auth/register')?>" method="post">
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="text" name="a" class="form-control" placeholder="Username" value="<?php echo set_value('a');?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
        </div>
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="email" name="bb" class="form-control" placeholder="Email" value="<?php echo set_value('bb');?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('bb', '<small class="text-danger pl-3">', '</small>');?>
        </div>
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="password" name="c" class="form-control" placeholder="Password" >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
        </div>
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="password" name="d" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?> 
        </div>
        <div class="row">
          <div class="col-8">

         </div>
         <!-- /.col -->
         <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="<?php echo base_url('auth');?>" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div><!-- /.card -->
</div>