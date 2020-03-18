    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('setting');?>"><small>Admin</small></a></li>
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
            <h4 class="card-title " text-align="center"><strong><?php echo $title; ?></strong></h4>
          </div>
          <div class="card-body">
           <?php if(validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
              <?php echo validation_errors(); ?>
            </div>
          <?php endif?>
          <?php echo $this->session->flashdata('message'); ?>
          <div>
            <a class="btn btn-sm btn-outline-info float-right" data-toggle="modal" data-target="#addForbidden">
              <i class="fas fa-plus"></i> Add Forbidden
            </a>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name&ensp;Menu</th>
                  <th scope="col">Active</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($forbi as $fi) :  $i++;?>
                <tr>
                  <th scope="row"><?php echo $i ;?></th>
                  <td><?php echo $fi['name']; ?></td>
                  <?php if($fi['is_active'] == 1) : ?>
                    <td>Yes</td>
                    <?php elseif($fi['is_active'] == 0) : ?>
                      <td>No</td>
                    <?php endif ;?>
                    <td>
                      <a style="margin-right:10px" href="" data-toggle="modal" data-target="#forbiDetailModal<?php echo $fi['id'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#forbiEditModal<?php echo $fi['id'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#forbiDeleteModal<?php echo $fi['id'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->

    <!-- Menu Modal Add-->
    <div class="modal fade" id="addForbidden">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title">Add New Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('admin/forbidden'); ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="a" class="form-control" id="InputNewMenu" placeholder="Menu Name">
              </div>
              <div class="form-group">
                <input type="text" name="b" class="form-control" id="InputNewUrl" placeholder="URL Example = '<'php echo base_url('') ';?>'">
              </div>
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline" id="updateUserSettActive">
                  <input class="form-check-input" value="1" name="c" type="checkbox" value="" id="checkboxPrimaryStatus" checked>
                  <label for="checkboxPrimaryStatus">
                    &nbsp;Active&nbsp;?
                  </label>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&ensp;Add</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Menu Modal Detail-->
    <?php $i=0; foreach($forbi as $fi) : $i++; ?>
    <div class="modal fade" id="forbiDetailModal<?php echo $fi['id'];?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h5 class="modal-title">Detail New Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="#" method="post">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="a" class="form-control" id="InputNewMenu" placeholder="Menu Name" value="<?php echo $fi['name']?>" disabled>
              </div>
              <div class="form-group">
                <input type="text" name="b" class="form-control" id="InputNewUrl" placeholder="URL Example = '<'php echo base_url('') ';?>'" value="<?php echo $fi['url']?>" disabled>
              </div>
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline" id="updateUserSettActive">
                  <?php if($fi['is_active'] == 1) : ?>
                    <input class="form-check-input" value="1" name="c" type="checkbox" value="" id="checkboxPrimaryStatus" checked disabled>
                    <?php else : ?>
                      <input class="form-check-input" value="1" name="c" type="checkbox" value="" id="checkboxPrimaryStatus" disabled>
                    <?php endif; ?>
                    <label for="checkboxPrimaryStatus">
                      &nbsp;Active&nbsp;?
                    </label>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <?php endforeach; ?>
    <!-- /.modal -->

    <!-- Menu Modal Edit-->
    <?php $i=0; foreach($forbi as $fi) : $i++; ?>
    <div class="modal fade" id="forbiEditModal<?php echo $fi['id'];?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title">Detail New Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('admin/forbiddenedit')?>" method="post">
            <div class="modal-body">

              <input type="hidden" readonly value="<?php echo $fi['id'];?>" name="d" class="form-control" >

              <div class="form-group">
                <input type="text" name="a" class="form-control" id="InputNewMenu" placeholder="Menu Name" value="<?php echo $fi['name']?>" >
              </div>
              <div class="form-group">
                <input type="text" name="b" class="form-control" id="InputNewUrl" placeholder="URL Example = '<'php echo base_url('') ';?>'" value="<?php echo $fi['url']?>" >
              </div>
              <div class="form-group">
                <div class="form-check">
                  <?php if($fi['is_active'] == 1) : ?>
                    <input class="form-check-input" value="1" name="c" type="checkbox" value="" id="editMenuActive" checked>
                    <?php else : ?>
                      <input class="form-check-input" value="1" name="c" type="checkbox" value="" id="editMenuActive" >
                    <?php endif; ?>
                    <label class="form-check-label" for="editMenuActive">
                      Active?
                    </label>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>&ensp;Update</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <?php endforeach; ?>
    <!-- /.modal -->

        <!-- Barang Hapus Modal-->
    <?php $i=0; foreach($forbi as $fi) : $i++; ?>
    <div class="modal fade" id="forbiDeleteModal<?php echo $fi['id'];?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title">Hapus <?php echo $fi['name'];?> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Pilih "Hapus" dibawah untuk menghapus <?php echo $title;?> <?php echo $fi['name'];?>.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <a class="btn btn-danger" href="<?php echo base_url('admin/forbiddendelete/'); ?><?php echo $fi['id'];?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <?php endforeach; ?>


  </section>
    <!-- /.content -->