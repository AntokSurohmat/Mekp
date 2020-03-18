    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $title; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?php echo $user['username']; ?></h3>
                <p class="text-muted text-center"><?php echo $user['email']; ?></p>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p class="text-muted text-center">Member since <?php echo date('F d Y', $user['date_created']); ?></p>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#detailProfile" data-toggle="tab">Detail Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#EditProfile" data-toggle="tab">Update Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content container-fluid">
                  <div class="active tab-pane" id="detailProfile">
                    <form>
                      <?php if(validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo validation_errors(); ?>
                        </div>
                      <?php endif?>
                      <?php echo $this->session->flashdata('message'); ?>
                      <div class="form-group row">
                        <label for="profileUsername" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control" id="profileUsername" value="<?php echo $user['username']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="profileUserFullname" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control" id="profileUserFullname" value="<?php echo $user['fullname']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="profileUserEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control" id="profileUserEmail" value="<?php echo $user['email']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="profileUserPhone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control" id="profileUserPhone" value="<?php echo $user['phone']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="profileUserAddress"  class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" readonly name="e" id="inputProfilAddress" placeholder="Address" ><?php echo $user['address']; ?></textarea>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="EditProfile">
                     <?php echo form_open_multipart('member/editprofile');?>
                     <input type="hidden" name="b" readonly value="<?php echo $user['id'];?>"  class="form-control" >
                      <div class="form-group row">
                        <label for="inputProfileUsrename" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputProfileUsrename" value="<?php echo $user['username']?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputProfileFullname" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="a" class="form-control" id="inputProfileFullname" value="<?php echo $user['fullname']?>">
                          <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputProfilEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" name="c" class="form-control" id="inputProfilEmail" placeholder="Email" value="<?php echo $user['email']; ?>">
                          <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputProfilPhone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" name="d" class="form-control" id="inputProfilPhone" placeholder="Number Phone" value="<?php echo $user['phone']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputProfilAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="e" id="inputProfilAddress" placeholder="Address" ><?php echo $user['address']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-2">
                         <label for="inputProfilAddress"  class="col-form-label">Picture</label>
                        </div>
                        <div class="col-sm-10">
                          <div class="row">
                            <div class="col-sm-3">
                              <img src="<?php echo base_url('assets/img/profile/').$user['image'];?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                              <div class="custom-file">
                                <input type="file" name="f" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="<?php echo base_url('member/changepassword');?>" method="post">
                      <input type="hidden" name="dd" readonly value="<?php echo $user['id'];?>"  class="form-control" >
                      <div class="form-group row">
                        <label for="inputCurrentPass" class="col-sm-3 col-form-label">Current Password</label>
                        <div class="col-sm-6">
                          <input type="password" name="aa" class="form-control" id="inputCurrentPass" placeholder="Current Password">
                          <?php echo form_error('aa', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputNewPass" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-6">
                          <input type="password" name="bb" class="form-control" id="inputNewPass" placeholder="New Password">
                          <?php echo form_error('bb', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputRepeatPass" class="col-sm-3 col-form-label">Repeat Password</label>
                        <div class="col-sm-6">
                          <input type="password" name="cc" class="form-control" id="inputRepeatPass" placeholder="Repeat Password">
                          <?php echo form_error('cc', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-3 col-sm-10">
                          <button type="submit" class="btn btn-danger">Change</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->