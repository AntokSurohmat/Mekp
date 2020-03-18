    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('setting');?>"><small>Member</small></a></li>
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
            <?php echo form_error('a','<div class="alert alert-danger" role="alert">','</div>'); ?>
            <?php echo $this->session->flashdata('message'); ?>
            <div>
              <a class="btn btn-sm btn-outline-info float-right" href="<?php echo base_url('member/perawatanAdd')?>">
                <i class="fas fa-plus"></i> Add Data
              </a>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach($allperawatan as $allper) :  $i++;?>
                  <tr>
                    <th scope="row"><?php echo $i ;?></th>
                    <td><?php echo $allper['nm_perawatan']; ?></td>
                    <td><?php echo $allper['nm_lokasi']; ?></td>
                    <td><?php echo date('d F Y', strtotime($allper['tgl_perawatan'])); ?></td>
                    <td>
                      <a style="margin-right:10px" href="<?php echo base_url('member/perawatandetail/'). $allper['id_perawatan'];?>"  title="Detail"><i class="fas fa-book-open text-info"></i></a>
                      <a style="margin-right:10px" href="<?php echo base_url('member/perawatanedit/'). $allper['id_perawatan'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                      <a href="#" data-toggle="modal" data-target="#perawatanDeleteModal<?php echo $allper['id_perawatan'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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

    <!-- Barang Hapus Modal-->
    <?php $i=0; foreach($allperawatan as $allper) : $i++; ?>
    <div class="modal fade" id="perawatanDeleteModal<?php echo $allper['id_perawatan'];?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header btn-danger">
            <h5 class="modal-title">Hapus <?php echo $allper['nm_perawatan'];?> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Pilih "Hapus" dibawah untuk menghapus Perawatan <?php echo $allper['nm_perawatan'];?>.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <a class="btn btn-danger" href="<?php echo base_url('member/perawatanDelete/')?><?php echo $allper['id_perawatan'];?>">Hapus</a>
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