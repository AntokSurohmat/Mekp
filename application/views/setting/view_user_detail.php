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
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><?php echo $title; ?>&ensp;"<?php echo $userrole['username'];?>"</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="card-body">
             <?php if(validation_errors()) : ?>
              <div class="alert alert-danger" role="alert">
                <?php echo validation_errors(); ?>
              </div>
            <?php endif?>
            <div class="form-group row ml-3">
              <label for="detailUserSettUsername" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="detailUserSettUsername" placeholder="Email" value="<?php echo $userrole['username'];?>" disabled>
              </div>
            </div>
            <div class="form-group row ml-3">
              <label for="detailUserSettFullname" class="col-sm-2 col-form-label">Full Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="detailUserSettFullname" placeholder="Fullname" value="<?php echo $userrole['fullname']?>" disabled>
              </div>
            </div>
            <div class="form-group row ml-3">
              <label for="detailUserSettEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" name="c" class="form-control" id="detailUserSettEmail" placeholder="Email" value="<?php echo $userrole['email']; ?>" disabled>
              </div>
            </div>
            <div class="form-group row ml-3">
              <div class="col-sm-2">
               <label for="detailUserSettImage"  class="col-form-label">Picture</label>
             </div>
             <div class="col-sm-10">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?php echo base_url('assets/img/profile/').$userrole['image'];?>" id="detailUserSettImage" class="img-thumbnail" disabled>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row ml-3">
            <label for="detailUserSettPhone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
              <input type="text" name="d" class="form-control" id="detailUserSettPhone" placeholder="Number Phone" value="<?php echo $userrole['phone']; ?>" disabled>
            </div>
          </div>
          <div class="form-group row ml-3">
            <label for="detailUserSettAddress" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="detailUserSettAddress" rows="3" placeholder="Addess" disabled><?php echo $userrole['address']; ?></textarea>
            </div>
          </div>
          <div class="form-group row ml-3">
            <label for="detailUserSettRole" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
              <?php if($userrole['role_id'] < 1) : ?>
                <input type="text" name="d" class="form-control" id="detailUserSettRole" placeholder="Number Phone" value="<?php echo $userrole['access']; ?>" disabled>
                <?php else : ?>
                  <input type="text" name="d" class="form-control" id="detailUserSettRole" placeholder="Number Phone" value="<?php echo $userrole['access']; ?>" disabled>
                <?php endif;?>
              </div>
            </div>
            <div class="form-group row ml-3">
              <label for="detailUserSettActive" class="col-sm-2 col-form-label">Active</label>
              <div class="col-sm-10">
                <?php if($userrole['is_active'] > 0) : ?>
                  <?php $active = "Active";?>
                  <input type="text" name="d" class="form-control" id="detailUserSettActive" placeholder="Number Phone" value="<?php echo $active; ?>" disabled>
                  <?php else : ?>
                   <?php $active = "Belum";?>
                   <input type="text" name="d" class="form-control" id="detailUserSettActive" placeholder="Number Phone" value="<?php echo $active; ?>" disabled>
                 <?php endif;?>
               </div>
             </div>
             <div class="form-group row ml-3">
              <label for="detailUserSettCreated" class="col-sm-2 col-form-label">Date Created</label>
              <div class="col-sm-10">
                <input type="text" name="d" class="form-control" id="detailUserSettCreated" placeholder="Number Phone" value="<?php echo date('F d Y',$userrole['date_created']); ?>" disabled>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a class="btn btn-info btn-sm" href="<?php echo base_url('setting/user');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Back To User List
            </a>
            <a class="btn btn-warning btn-sm float-right" href="<?php echo base_url('setting/userEdit/'). $userrole['id'];?>">
              <i class="fas fa-user-edit"></i>&ensp;Edit User
            </a>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
