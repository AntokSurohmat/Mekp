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
              <a class="btn btn-sm btn-outline-info float-right" data-toggle="modal" data-target="#subMenuNewModal">
                <i class="fas fa-plus"></i> Add Sub Menu
              </a>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Url</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Active</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach ($subMenu as $sm) :  $i++;?>
                  <tr>
                    <th scope="row"><?php echo $i ;?></th>
                    <td><?php echo $sm['title']; ?></td>
                    <td><?php echo $sm['parents']; ?></td>
                    <td><?php echo $sm['url']; ?></td>
                    <td><?php echo $sm['icon']; ?></td>
                    <td><?php echo $sm['is_active']; ?></td>
                    <td>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#subMenuDetailModal<?php echo $sm['id'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#subMenuEditModal<?php echo $sm['id'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                      <a href="#" data-toggle="modal" data-target="#subMenuDeleteModal<?php echo $sm['id'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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

    <!-- Sub Menu Modal Add-->
    <div class="modal fade" id="subMenuNewModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title">Add New Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('setting/submenu'); ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="a" class="form-control" id="InputSubMenuTitle" placeholder="Submenu title">
              </div>
              <div class="form-group">
                <select name="b" id="InputSubMenuMenu" class="form-control">
                  <option for="InputSubMenuMenu" value="">Select menu</option>
                  <?php foreach($menu as $m) : ?>
                    <option for="InputSubMenuMenu"  value="<?php echo $m['id']?>"><?php echo $m['parents'];?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <input type="text" name="c" class="form-control" id="InputSubMenuUrl" placeholder="Submenu url">
              </div>
              <div class="form-group">
                <input type="text" name="d" class="form-control" id="InputSubMenuIcon" placeholder="Submenu icon">
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" value="1" name="e" type="checkbox" value="1" id="InputSubMenuActive" checked>
                  <label class="form-check-label" for="InputSubMenuActive">
                    Active?
                  </label>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-warning btn-sm"><span aria-hidden="true">Close</span></button>
              <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&ensp;Add</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Sub Menu Detail Modal -->
    <?php $i=0; foreach($subMenu as $sm) : $i++; ?>
    <div class="modal fade" id="subMenuDetailModal<?php echo $sm['id'];?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h5 class="modal-title">Detail Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="a" disabled class="form-control" id="InputSubMenuTitle" placeholder="Submenu title" value="<?php echo $sm['title'];?>">
              </div>
              <div class="form-group">
                <input type="text" name="b" disabled class="form-control" id="InputSubMenuMenu" placeholder="Submenu title" value="<?php echo $sm['parents'];?>">
              </div>
              <div class="form-group">
                <input type="text" name="c" disabled class="form-control" id="InputSubMenuUrl" placeholder="Submenu url" value="<?php echo $sm['url'];?>">
              </div>
              <div class="form-group">
                <input type="text" name="d" disabled class="form-control" id="InputSubMenuIcon" placeholder="Submenu icon" value="<?php echo $sm['icon'];?>">
              </div>
              <div class="form-group">
                <div class="form-check">
                  <?php if($sm['is_active'] == 1) : ?>
                    <input class="form-check-input" value="" name="e" type="checkbox"  id="checkActive" checked disabled>
                    <?php else : ?>
                      <input class="form-check-input" value="" name="e" type="checkbox"  id="checkActive" disabled>
                    <?php endif;?>
                    <label class="form-check-label" for="checkActive">
                      Active?
                    </label>
                  </div>
                </div>
              </div>
              <div class="modal-footer" style='clear:both'>
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary btn-sm"><span aria-hidden="true">Close</span></button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <?php endforeach; ?>
    <!-- /.modal -->

    <!-- Sub Menu Edit Modal -->
    <?php $i=0; foreach($subMenu as $sm) : $i++; ?>
    <div class="modal fade" id="subMenuEditModal<?php echo $sm['id'];?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header btn-warning">
            <h5 class="modal-title">Edit Sub Menu "<?php echo $sm['title'];?>"</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo base_url('setting/submenuedit'); ?>" method="post">
            <div class="modal-body">

              <input type="hidden" readonly value="<?php echo $sm['id'];?>" name="f" class="form-control" >

              <div class="form-group">
                <input type="text" name="a" class="form-control" id="InputSubMenuTitle" placeholder="Submenu title" value="<?php echo $sm['title'];?>">
              </div>
              <div class="form-group">
                <select name="b" id="InputSubMenuMenu" class="form-control">
                  <?php foreach($menu as $m) : ?>
                    <?php if($sm['menu_id'] == $m['id']) : ?>
                      <option for="InputSubMenuMenu"  value="<?php echo $m['id']?>" selected><?php echo $m['parents'];?></option>
                      <?php else :?>
                        <option for="InputSubMenuMenu"  value="<?php echo $m['id']?>" ><?php echo $m['parents'];?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" name="c" class="form-control" id="InputSubMenuUrl" placeholder="Submenu url" value="<?php echo $sm['url'];?>">
                </div>
                <div class="form-group">
                  <input type="text" name="d" class="form-control" id="InputSubMenuIcon" placeholder="Submenu icon" value="<?php echo $sm['icon'];?>">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <?php if($sm['is_active'] == 1) : ?>
                      <input class="form-check-input" value="1" name="e" type="checkbox" value="" id="InputSubMenuActive" checked>
                      <?php else : ?>
                        <input class="form-check-input" value="1" name="e" type="checkbox" value="" id="InputSubMenuActive" >
                      <?php endif; ?>
                      <label class="form-check-label" for="InputSubMenuActive">
                        Active?
                      </label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><span aria-hidden="true">Close</span></button>
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
    <?php $i=0; foreach($subMenu as $sm) : $i++; ?>
    <div class="modal fade" id="subMenuDeleteModal<?php echo $sm['id'];?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title">Hapus <?php echo $sm['title'];?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Pilih "Hapus" dibawah untuk menghapus <?php echo $title;?> <?php echo $sm['title'];?>.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <a class="btn btn-danger" href="<?php echo base_url('setting/submenudelete/'); ?><?php echo $sm['id'];?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
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
