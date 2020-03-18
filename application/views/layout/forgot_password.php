<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><b>S</b>istem<b>I</b>nventory</a>
  </div>
  <?php echo $this->session->flashdata('message'); ?>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form method="post" action="<?php echo base_url('auth/forgotpassword'); ?>">
        <div class="from-group mb-3">
          <div class="input-group">
            <input type="email" name="bb" class="form-control" id="InputFogotEmail" placeholder="Email" value="<?php echo set_value('bb');?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?php echo base_url('auth');?>">Login</a>
      </p>
      <p class="mb-0">
        <?php if($forbi['is_active'] == 0) : ?>
          <a href="<?php echo base_url('auth/register');?>" class="text-center">Register a new membership</a>
          <?php else :?>
            <p><b>Ask Admin to register</b></p>
          <?php endif ;?>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
<!-- /.login-box -->