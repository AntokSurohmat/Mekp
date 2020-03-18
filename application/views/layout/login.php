<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><b>S</b>istem<b>I</b>nventory</a>
  </div>
  <?php echo $this->session->flashdata('message'); ?>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo base_url('auth');?>" method="post">
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="email" name="a" class="form-control" placeholder="Email" value="<?php echo set_value('a');?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
        </div>
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="password" name="b" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="<?php echo base_url('auth/forgotPassword');?>">I forgot my password</a>
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