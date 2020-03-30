    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('setting');?>"><small>Setting</small></a></li>
              <li class="breadcrumb-item"><small><?php echo $title; ?></small></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title"><?php echo $title; ?>&ensp;"<?php echo $userrole['username'];?>"</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?php echo form_open_multipart('setting/useredit/'. $userrole['id']);?>

            <div class="card-body">
             <?php if(validation_errors()) : ?>
              <div class="alert alert-danger" role="alert">
                <?php echo validation_errors(); ?>
              </div>
            <?php endif?>
            <?php echo $this->session->flashdata('message'); ?>
            <input type="hidden" name="zz" readonly value="<?php echo $userrole['id'];?>"  class="form-control">

            <div class="form-group row ml-3">
              <label for="updateUserSettUsername" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" name="a" class="form-control" id="updateUserSettUsername" placeholder="Email" value="<?php echo $userrole['username'];?>">
              </div>
            </div>
            <div class="form-group row ml-3">
              <label for="updateUserSettFullname" class="col-sm-2 col-form-label">Full Name</label>
              <div class="col-sm-10">
                <input type="text" name="b" class="form-control" id="updateUserSettFullname" placeholder="Fullname" value="<?php echo $userrole['fullname']?>">
              </div>
            </div>
            <div class="form-group row ml-3">
              <label for="updateUserSettEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" name="c" class="form-control" id="updateUserSettEmail" placeholder="Email" value="<?php echo $userrole['email']; ?>">
              </div>
            </div>
            <div class="form-group row ml-3">
              <div class="col-sm-2">
               <label for="updateUserSettImage"  class="col-form-label">Picture</label>
             </div>
             <div class="col-sm-10">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?php echo base_url('assets/img/profile/').$userrole['image'];?>" id="updateUserSettImage" class="img-thumbnail">
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input type="file" name="d" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
              </div>
            </div>`
          </div>
          <div class="form-group row ml-3">
            <label for="updateUserSettPhone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
              <input type="text" name="e" class="form-control" id="updateUserSettPhone" placeholder="Number Phone" value="<?php echo $userrole['phone']; ?>">
            </div>
          </div>
          <div class="form-group row ml-3">
            <label for="updateUserSettAddress" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="f" id="updateUserSettAddress" rows="3" placeholder="Addess"><?php echo $userrole['address']; ?></textarea>
            </div>
          </div>
          <div class="form-group row ml-3">
            <label for="updateUserSettRole" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
              <select name="g" id="updateUserSettRole" class="form-control select2" style="width: 100%;">
                <?php
               $queryRole =  "SELECT *
               FROM `mekp_role`
               ";
               $roleQuery = $this->db->query($queryRole)->result_array(); ?>
               <?php foreach($roleQuery as $rQ) : ?>
                <?php if( $userrole['role_id'] ==  $rQ['id'] ) :?>
                  <option for="updateUserSettRole" value="<?php echo $rQ['id'];?>" selected><?php echo $rQ['access'];?></option>
                  <?php else : ?>
                    <option for="updateUserSettRole"  value="<?php echo $rQ['id'];?>" ><?php echo $rQ['access'];?></option>
                  <?php endif;?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group row ml-3">
            <label for="updateUserSettActive" class="col-sm-2 col-form-label">Active</label>
            <div class="col-sm-10">
              <!-- checkbox -->
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline" id="updateUserSettActive">
                  <?php if($userrole['is_active'] == 1) : ?>
                    <input class="form-check-input" value="1" name="h" type="checkbox" value="" id="checkboxPrimaryStatus" checked>
                    <?php else : ?>
                      <input class="form-check-input" value="1" name="h" type="checkbox" value="" id="checkboxPrimaryStatus" >
                    <?php endif; ?>
                    <label for="checkboxPrimaryStatus">
                      Status
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-info btn-sm" href="<?php echo base_url('setting/user');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back To User List
              </a>
              <button type="submit" class="btn btn-warning btn-sm float-right "><i class="fas fa-user-edit"></i>&ensp;Update</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
