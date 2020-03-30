    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('member');?>"><small>Officer</small></a></li>
              <li class="breadcrumb-item"><small>Detail Data Keperawatan</small></li>
            </ol>
          </div>
        </div>
        <?php if(validation_errors()) : ?>
          <div class="alert alert-danger" role="alert">
            <?php echo validation_errors(); ?>
          </div>
        <?php endif?>
        <?php echo $this->session->flashdata('message'); ?>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- ./row -->
        <div class="row">
          <div class="col-12">
            <div class="card card-info card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active ml-4" id="custom-tabs-one-perawatan-tab" data-toggle="pill" href="#custom-tabs-one-perawatan" role="tab" aria-controls="custom-tabs-one-perawatan" aria-selected="true"><b>Data Perawatan</b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><b>Data Perbaikan</b></a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-perawatan" role="tabpanel" aria-labelledby="custom-tabs-one-perawatan-tab">
                   <div class="card card-info">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                      <form class="form-horizontal" action="<?php echo base_url('member/perawatanEdit/').$oneperawatan['id_perawatan'];?>" method="post">
                        <div class="form-group row ml-2">
                          <label for="addNamaPer" class="col-sm-2 col-form-label">Nama Perawatan </label>
                          <div class="col-sm-4">
                            <input type="text" name="a" class="form-control" id="addNamaPer" placeholder="Nama Perawatan" value="<?php echo $oneperawatan['nm_perawatan'];?>" disabled>
                            <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                        </div>
                        <div class="form-group row ml-2">
                          <label for="addPasswordSett" class="col-sm-2 col-form-label">Lokasi</label>
                          <div class="col-sm-4">
                            <input type="text" name="c" class="form-control" id="detKategoriPer" placeholder="Nama Perawatan" value="<?php echo $oneperawatan['nm_lokasi'];?>" disabled>
                            <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                        </div>
                        <div class="form-group row ml-2">
                          <label for="addNamaPer" class="col-sm-2 col-form-label">Lokasi Rinci </label>
                          <div class="col-sm-4">
                            <input type="text" name="d" class="form-control" id="addNamaPer" placeholder="Meja Ke /dll" value="<?php echo $oneperawatan['lokasi_rinci'];?>" disabled>
                            <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                        </div>
                        <div class="form-group row ml-2">
                          <label class="col-sm-2 col-form-label" for="kegiatanAdd">Tanggal</label>
                          <div class="col-sm-4">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="far fa-calendar-alt"></i>
                                </span>
                              </div>
                              <input type="text" name="e" class="form-control float-right" id="kegiatanAdd" value="<?php echo date('d F Y', strtotime($oneperawatan['tgl_perawatan'])) ;?>" disabled>

                            </div>
                            <?php echo form_error('e', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                        </div>
                        <div class="form-group row ml-2">
                          <label for="addEmailSetting" class="col-sm-2 col-form-label">Keterangan</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="f" id="detailUserSettAddress" rows="3" placeholder="Keterangan.." value="<?php echo $oneperawatan['keterangan'];?>" disabled><?php echo $oneperawatan['keterangan'];?></textarea>
                            <?php echo form_error('f', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer justify-content-between">
                          <a class="btn btn-info btn-sm" href="<?php echo base_url('member/perawatan');?>">
                            <i class="fas fa-arrow-left"></i>&ensp;Back To Perawatan List
                          </a>
                          <a class="btn btn-warning float-right btn-sm" href="<?php echo base_url('member/perawatanedit/'). $oneperawatan['id_perawatan'];?>">
                            <i class="fas fa-edit"></i>&ensp;Edit Data
                          </a>
                        </div>
                        <!-- /.card-footer -->
                      </form>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

                  <div class="card">
                    <div class="card-header bg-info">
                      <h4 class="card-title  mt-1 " text-align="center"><strong><?php echo $title; ?></strong></h4>
                    </div>
                    <div class="card-body">
                      <div>
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th scope="col" style="text-align: center; width: 15px;">#</th>
                              <th scope="col" style="text-align: center;">Tanggal Perbaikan</th>
                              <th scope="col" style="text-align: center;">Kebutuhan</th>
                              <th scope="col" style="text-align: center; width: 50px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=0; foreach($allperbaikan as $allper) :  $i++;?>
                            <tr>
                              <th scope="row"><?php echo $i ;?></th>
                              <td><?php echo $allper['tgl_perbaikan']; ?></td>
                              <td><?php echo $allper['kebutuhan']; ?></td>
                              <td>
                                <a style="margin-right: 10px" href="#" data-toggle="modal" data-target="#perbaikanDetailModal<?php echo $allper['id_perbaikan'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.row -->
                  </div>
                  <div class="card-footer justify-content-between">
                    <a class="btn btn-info btn-sm" href="<?php echo base_url('member/perawatan');?>">
                      <i class="fas fa-arrow-left"></i>&ensp;Back To Perawatan List
                    </a>
                    <a class="btn btn-warning float-right btn-sm" href="<?php echo base_url('member/perawatanedit/'). $oneperawatan['id_perawatan'];?>">
                      <i class="fas fa-edit"></i>&ensp;Edit Data
                    </a>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

              </div>

            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->



  <!-- Kategori Modal Detail-->
  <?php $i=0; foreach($allperbaikan as $allper) : $i++; ?>
  <div class="modal fade" id="perbaikanDetailModal<?php echo $allper['id_perbaikan'];?>">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title">Detail Perawatan "<?php echo $oneperawatan['nm_perawatan'];?>"</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
          <div class="modal-body">
            <form class="form-horizontal" action="<?php echo base_url('member/perawatanAdd')?>" method="post">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="kegiatanAdd">Tanggal Perbaikan</label>
                <div class="col-sm-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" name="e" class="form-control float-right" id="kegiatanAdd" value="<?php echo $allper['tgl_perbaikan'];?>" disabled>
                  </div>
                  <?php echo form_error('e', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row">
                <label for="addNamaPer" class="col-sm-4 col-form-label">Kode Barang</label>
                <div class="col-sm-8">
                  <input type="text" name="a" class="form-control" id="addNamaPer" placeholder="Kode Barang" value="<?php echo $allper['kd_barang'];?>" disabled>
                  <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row">
                <label for="addNamaPer" class="col-sm-4 col-form-label">Lokasi</label>
                <div class="col-sm-8">
                  <input type="text" name="c" class="form-control" id="detKategoriPer" placeholder="Nama Perawatan" value="<?php echo $oneperawatan['nm_lokasi'];?>" disabled>
                  <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row">
                <label for="detKategoriPer" class="col-sm-4 col-form-label">Jumlah</label>
                <div class="col-sm-8">
                  <input type="text" name="b" class="form-control" id="detKategoriPer" placeholder="Jumlah" value="<?php echo $allper['jumlah'];?>" disabled>
                  <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row">
                <label for="addPasswordSett" class="col-sm-4 col-form-label">Kebutuhan</label>
                <div class="col-sm-8">
                  <textarea class="form-control" name="f" id="detailUserSettAddress" rows="2" placeholder="Kebutuhan.." value="<?php echo $allper['kebutuhan'];?>" disabled><?php echo $allper['kebutuhan'];?></textarea>
                  <?php echo form_error('f', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row">
                <label for="addNamaPer" class="col-sm-4 col-form-label">Hasil </label>
                <div class="col-sm-8">
                  <textarea class="form-control" name="f" id="detailUserSettAddress" rows="2" placeholder="Hasil.." value="<?php echo $allper['hasil'];?>" disabled><?php echo $allper['hasil'];?></textarea>
                  <?php echo form_error('f', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <!-- /.card-body -->
            </form>
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



</section>
    <!-- /.content -->