    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $title ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('member');?>"><small>Officer</small></a></li>
              <li class="breadcrumb-item"><small><?php echo $title; ?></small></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if(validation_errors()) : ?>
          <div class="alert alert-danger" role="alert">
            <?php echo validation_errors(); ?>
          </div>
        <?php endif?>
        <?php echo $this->session->flashdata('message'); ?>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Card Data Kategori -->
            <div class="card">
              <div class="card-header bg-info border-0">
                <h3 class="card-title mt-1">
                  <i class="fas fa-th mr-1"></i>
                  <?php echo $kategori ;?>
                </h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm bg-primary btn-outline-primary float-left" data-toggle="modal" data-target="#kategoriNewModal">
                    <i class="fas fa-plus"></i> Add Data
                  </a>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-sm table-striped" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 15px">#</th>
                      <th>Kategori</th>
                      <th style="width: 120px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach($kategoridata as $kat) :  $i++;?>
                    <tr>
                      <th scope="row"><?php echo $i ;?></th>
                      <td><?php echo $kat['nm_kategori']; ?></td>
                      <td>
                        <a style="margin-right: 10px" href="#" data-toggle="modal" data-target="#kategoriDetailModal<?php echo $kat['id_kategori'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                        <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#kategoriEditModal<?php echo $kat['id_kategori'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                        <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#kategoriDeleteModal<?php echo $kat['id_kategori'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
          <!-- Card Data Kategori -->
          <div class="card">
            <div class="card-header bg-info border-0">
              <h3 class="card-title mt-1">
                <i class="fas fa-th mr-1"></i>
                <?php echo $kondisi ;?>
              </h3>
              <div class="card-tools">
                <a href="#" class="btn btn-sm bg-primary btn-outline-primary float-left" data-toggle="modal" data-target="#kondisiNewModal">
                  <i class="fas fa-plus"></i> Add Data
                </a>
                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-sm table-striped" id="example2">
                <thead>
                  <tr>
                    <th style="width: 15px">#</th>
                    <th>Kondisi</th>
                    <th style="width: 100px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach($kondisidata as $kondat) :  $i++;?>
                  <tr>
                    <th scope="row"><?php echo $i ;?></th>
                    <td><?php echo $kondat['nm_kondisi']; ?></td>
                    <td>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#kondisiDetailModal<?php echo $kondat['id_kondisi'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#kondisiEditModal<?php echo $kondat['id_kondisi'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#kondisiDeleteModal<?php echo $kondat['id_kondisi'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-6 connectedSortable">
        <!-- Card Data Kategori -->
        <div class="card">
          <div class="card-header bg-info border-0">
            <h3 class="card-title mt-1">
              <i class="fas fa-th mr-1"></i>
              <?php echo $merk ;?>
            </h3>
            <div class="card-tools">
              <a href="#" class="btn btn-sm bg-primary btn-outline-primary float-left" data-toggle="modal" data-target="#merkNewModal">
                <i class="fas fa-plus"></i> Add Data
              </a>
              <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-sm table-striped" id="example3">
              <thead>
                <tr>
                  <th style="width: 15px">#</th>
                  <th>Merk</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($merkdata as $medat) :  $i++;?>
                <tr>
                  <th scope="row"><?php echo $i ;?></th>
                  <td><?php echo $medat['nm_merk']; ?></td>
                  <td>
                    <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#merkDetailModal<?php echo $medat['id_merk'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                    <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#merkEditModal<?php echo $medat['id_merk'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                    <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#merkDeleteModal<?php echo $medat['id_merk'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
      <!-- Card Data Kategori -->
      <div class="card">
        <div class="card-header bg-info border-0">
          <h3 class="card-title mt-1">
            <i class="fas fa-th mr-1"></i>
            <?php echo $status ;?>
          </h3>

          <div class="card-tools">
            <a href="#" class="btn btn-sm bg-primary btn-outline-primary float-left" data-toggle="modal" data-target="#statusNewModal">
              <i class="fas fa-plus"></i> Add Data
            </a>
            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-sm table-striped" id="example4">
            <thead>
              <tr>
                <th style="width: 15px">#</th>
                <th>Status</th>
                <th style="width: 100px">Action</th>
              </tr>
            </thead>
            <tbody>
             <?php $i=0; foreach($statusdata as $stadat) :  $i++;?>
             <tr>
              <th scope="row"><?php echo $i ;?></th>
              <td><?php echo $stadat['nm_status']; ?></td>
              <td>
                <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#statusDetailModal<?php echo $stadat['id_status'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#statusEditModal<?php echo $stadat['id_status'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#statusDeleteModal<?php echo $stadat['id_status'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
</section>
<!-- right col -->
</div>
<!-- /.row (main row) -->

<div class="row">
  <div class="col-12">
    <div class="callout callout-danger">
      <h5><i class="fas fa-info"></i> Note:</h5>
      Data Master Adalah Data Jumlah Barang
    </div>
  </div>
  <!--/. Col -->
</div>
<!--/. Row -->

<!-- Bot row -->
<div class="row">
 <!-- Left col -->
 <section class="col-lg-12 connectedSortable">
  <!-- Card Data Kategori -->
  <div class="card">
    <div class="card-header border-0 bg-info">
      <h3 class="card-title mt-1">
        <i class="fas fa-th mr-1"></i>
        <?php echo $title; ?>
      </h3>
      <div class="btn-group float-right">
        <a class="btn btn-sm bg-gray btn-outline-gray" href="<?php echo base_url('member/barangAdd')?>">
          <i class="fas fa-plus"></i> Add Barang
        </a>
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"> Add other&nbsp;</button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#kategoriNewModal"> <i class="fas fa-plus"></i>&nbsp;&nbsp; Add Kategori</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#merkNewModal"> <i class="fas fa-plus"></i>&nbsp;&nbsp; Add Merk</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#kondisiNewModal"> <i class="fas fa-plus"></i>&nbsp;&nbsp; Add Kondisi</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#statusNewModal"> <i class="fas fa-plus"></i>&nbsp;&nbsp; Add Status</a>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-striped table-bordered" id="example5">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Barang</th>
            <th>Merk</th>
            <th>Jumlah</th>
            <th style="width: 100px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($allba as $lb) :  $i++;?>
          <tr>
            <th scope="row"><?php echo $i ;?></th>
            <td><?php echo $lb['nm_barang']; ?></td>
            <td><?php echo $lb['nm_merk']; ?></td>
            <td><?php echo $lb['jumlah']; ?></td>
            <td>
              <a style="margin-right:10px" href="<?php echo base_url('member/baranghistoryMasuk/'). $lb['kd_barang'];?>" title="History"><i class="fas fa-history text-secondary"></i></a>
              <a style="margin-right:10px" href="<?php echo base_url('member/barangdetail/'). $lb['id_barang'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
              <a style="margin-right:10px" href="<?php echo base_url('member/barangedit/'). $lb['id_barang'];?>" title="Edit"><i class="fas fa-edit text-warning"></i></a>
              <a href="#" data-toggle="modal" data-target="#barangDeleteModal<?php echo $lb['id_barang'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->
</section>
<!-- /.Left col --> 
</div>
<!-- / .row (Bot row) -->
</div>
<!--/. container-fluid -->

<!-- kategori Modal Add-->
<div class="modal fade" id="kategoriNewModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Add New Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('member/kategoriAdd'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="a" class="form-control" id="InputNewKategori" placeholder="Kategori Name">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus">&ensp;</i>Add</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Kategori Modal Detail-->
<?php $i=0; foreach($kategoridata as $kat) : $i++; ?>
<div class="modal fade" id="kategoriDetailModal<?php echo $kat['id_kategori'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">Detail Kategori "<?php echo $kat['nm_kategori'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="a" disabled class="form-control" id="DetailNewKategori" placeholder="Kategori Name" value="<?php echo $kat['nm_kategori'];?>">
          </div>
        </div>
        <div class="modal-footer" style='clear:both'>
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><span aria-hidden="true">Close</span></button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>

<!-- kategori Modal Edit-->
<?php $i=0; foreach($kategoridata as $kat) : $i++; ?>
<div class="modal fade" id="kategoriEditModal<?php echo $kat['id_kategori'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit Kategori "<?php echo $kat['nm_kategori'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('member/kategoriEdit'); ?>" method="post">
        <div class="modal-body">

          <input type="hidden" name="b" readonly value="<?php echo $kat['id_kategori'];?>"  class="form-control" >

          <div class="form-group">
            <input type="text" name="a" class="form-control" id="EditNewKategori" placeholder="Kategori Name" value="<?php echo $kat['nm_kategori'];?>">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><span aria-hidden="true">Tutup</span></button>
          <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit">&ensp;</i>Update</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>
<!--End Modal -->

<!-- Kategori Hapus Modal-->
<?php $i=0; foreach($kategoridata as $kat) : $i++; ?>
<div class="modal fade" id="kategoriDeleteModal<?php echo $kat['id_kategori'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Hapus <?php echo $kat['nm_kategori'];?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus kategori <?php echo $kat['nm_kategori'];?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?php echo base_url('member/kategoriDelete/')?><?php echo $kat['id_kategori'];?>"><i class="fas fa-trash">&ensp;</i>Hapus</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>



<!-- Kondisi Modal Add-->
<div class="modal fade" id="kondisiNewModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Add New Kondisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('member/kondisiAdd'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="a" class="form-control" id="InputNewKondisi" placeholder="Kondisi Name">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus">&ensp;</i>Add</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Kondisi Modal Detail-->
<?php $i=0; foreach($kondisidata as $kondat) : $i++; ?>
<div class="modal fade" id="kondisiDetailModal<?php echo $kondat['id_kondisi'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">Detail Kondisi "<?php echo $kondat['nm_kondisi'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="a" disabled class="form-control" id="DetailNewKondisi" placeholder="Kondisi Name" value="<?php echo $kondat['nm_kondisi'];?>">
          </div>
        </div>
        <div class="modal-footer" style='clear:both'>
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><span aria-hidden="true">Close</span></button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>

<!-- Kondisi Modal Edit-->
<?php $i=0; foreach($kondisidata as $kondat) : $i++; ?>
<div class="modal fade" id="kondisiEditModal<?php echo $kondat['id_kondisi'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit Menu "<?php echo $kondat['nm_kondisi'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('member/kondisiEdit'); ?>" method="post">
        <div class="modal-body">

          <input type="hidden" name="b" readonly value="<?php echo $kondat['id_kondisi'];?>"  class="form-control" >

          <div class="form-group">
            <input type="text" name="a" class="form-control" id="EditNewKondisi" placeholder="Kondisi Name" value="<?php echo $kondat['nm_kondisi'];?>">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><span aria-hidden="true">Tutup</span></button>
          <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit">&ensp;</i>Update</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>


<!-- Kondisi Hapus Modal-->
<?php $i=0; foreach($kondisidata as $kondat) : $i++; ?>
<div class="modal fade" id="kondisiDeleteModal<?php echo $kondat['id_kondisi'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Hapus <?php echo $kondat['nm_kondisi'];?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus <?php echo $kondisi; ?> <?php echo $kondat['nm_kondisi'];?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?php echo base_url('member/kondisiDelete/')?><?php echo $kondat['id_kondisi'];?>">Hapus</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>



<!-- Merk Modal Add-->
<div class="modal fade" id="merkNewModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Add New Merk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('member/merkAdd'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="a" class="form-control" id="InputNewMerk" placeholder="Merk Name">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Add</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Merk Modal Detail-->
<?php $i=0; foreach($merkdata as $medat) : $i++; ?>
<div class="modal fade" id="merkDetailModal<?php echo $medat['id_merk'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">Detail Merk "<?php echo $medat['nm_merk'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="a" disabled class="form-control" id="DetailNewMerk" placeholder="Kategori Name" value="<?php echo $medat['nm_merk'];?>">
          </div>
        </div>
        <div class="modal-footer" style='clear:both'>
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><span aria-hidden="true">Close</span></button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>

<!-- Merk Modal Edit-->
<?php $i=0; foreach($merkdata as $medat) : $i++; ?>
<div class="modal fade" id="merkEditModal<?php echo $medat['id_merk'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit Merk "<?php echo $medat['nm_merk'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('member/merkEdit'); ?>" method="post">
        <div class="modal-body">

          <input type="hidden" name="b" readonly value="<?php echo $medat['id_merk'];?>"  class="form-control" >

          <div class="form-group">
            <input type="text" name="a" class="form-control" id="EditNewMerk" placeholder="Merk Name" value="<?php echo $medat['nm_merk'];?>">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><span aria-hidden="true">Tutup</span></button>
          <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit">&ensp;</i>Update</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>

<!-- Merk Hapus Modal-->
<?php $i=0; foreach($merkdata as $medat) : $i++; ?>
<div class="modal fade" id="merkDeleteModal<?php echo $medat['id_merk'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Hapus <?php echo $medat['nm_merk'];?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus kategori <?php echo $medat['nm_merk'];?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?php echo base_url('member/merkDelete/')?><?php echo $medat['id_merk'];?>"><i class="fas fa-trash">&ensp;</i>Hapus</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>



<!-- Status Modal Add-->
<div class="modal fade" id="statusNewModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Add New Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('member/statusAdd'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="a" class="form-control" id="InputNewStatus" placeholder="Status Name">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Add</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Status Modal Detail-->
<?php $i=0; foreach($statusdata as $stadat) : $i++; ?>
<div class="modal fade" id="statusDetailModal<?php echo $stadat['id_status'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">Detail Kategori "<?php echo $stadat['nm_status'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="a" disabled class="form-control" id="DetailNewStatus" placeholder="Kategori Name" value="<?php echo $stadat['nm_status'];?>">
          </div>
        </div>
        <div class="modal-footer" style='clear:both'>
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><span aria-hidden="true">Close</span></button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>

<!-- Statusx Modal Edit-->
<?php $i=0; foreach($statusdata as $stadat) : $i++; ?>
<div class="modal fade" id="statusEditModal<?php echo $stadat['id_status'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit Menu "<?php echo $stadat['nm_status'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('member/statusEdit'); ?>" method="post">
        <div class="modal-body">

          <input type="hidden" name="b" readonly value="<?php echo $stadat['id_status'];?>"  class="form-control" >

          <div class="form-group">
            <input type="text" name="a" class="form-control" id="EditNewStatus" value="<?php echo $stadat['nm_status'];?>">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><span aria-hidden="true">Tutup</span></button>
          <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit">&ensp;</i>Update</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>
<!--End Modal -->

<!-- Kondisi Hapus Modal-->
<?php $i=0; foreach($statusdata as $stadat) : $i++; ?>
<div class="modal fade" id="statusDeleteModal<?php echo $stadat['id_status'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Hapus <?php echo $stadat['nm_status'];?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus <?php echo $kondisi; ?> <?php echo $stadat['nm_status'];?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?php echo base_url('member/statusDelete/')?><?php echo $stadat['id_status'];?>">Hapus</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>


<!-- Barang Hapus Modal-->
<?php $i=0; foreach($allba as $lb) : $i++; ?>
<div class="modal fade" id="barangDeleteModal<?php echo $lb['id_barang'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Hapus <?php echo $lb['nm_barang'];?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus <?php echo $barang; ?> <?php echo $lb['nm_barang'];?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?php echo base_url('member/barangDelete/')?><?php echo $lb['id_barang'];?>"><i class="fas fa-trash">&ensp;</i>Hapus</a>
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