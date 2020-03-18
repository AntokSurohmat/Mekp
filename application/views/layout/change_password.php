<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><b>S</b>istem<b>I</b>nventory</a>
  </div>
  <?php echo $this->session->flashdata('message'); ?>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h4 class=" mb-4"><?php echo $this->session->userdata('reset_email');?></h4>
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

      <form method="post" action="<?php echo base_url('auth/changepassword'); ?>">
        <div class="form-group mb-3" >
          <div class="input-group">
            <input type="password" name="a" class="form-control" id="InputFogotPassword" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
        </div>
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="password" name="b"  class="form-control" id="InputFogotConfirmPassword" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?php echo base_url('auth'); ?>">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->