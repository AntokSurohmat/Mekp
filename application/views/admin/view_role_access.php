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
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h4 class="card-title " text-align="center"><?php echo $title; ?> : <strong><?php echo $role['access'];?></strong></h4>
          </div>
          <div class="card-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div>
             <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Access</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($menu as $m) :  $i++;?>
                <tr>
                  <th scope="row"><?php echo $i ;?></th>
                  <td><?php echo $m['parents']; ?></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" <?php echo check_access($role['id'], $m['id']); ?> data-role="<?php echo $role['id'] ; ?>" data-menu="<?php echo $m['id'] ; ?>">
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.row -->
        <div class="card-footer justify-content-between">
          <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/role');?>">
            <i class="fas fa-arrow-left"></i>&ensp;Back To Access Menu List
          </a>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.container-fluid -->
</section>
    <!-- /.content -->