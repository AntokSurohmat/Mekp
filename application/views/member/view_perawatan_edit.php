    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>"><small>Home</small></a></li>
              <li class="breadcrumb-item"><small>Edit Data Perawatan</small></li>
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
            <div class="card card-gray card-tabs">
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
                      <form class="form-horizontal" action="<?php echo base_url('member/perawatanEdit/'). $oneperawatan['id_perawatan'];?>" method="post">


                        <input type="hidden" readonly value="<?php echo $oneperawatan['id_perawatan'];?>" name="zz" class="form-control" >

                        <div class="form-group row ml-2">
                          <label for="addNamaPer" class="col-sm-2 col-form-label">Nama Perawatan </label>
                          <div class="col-sm-4">
                            <input type="text" name="a" class="form-control" id="addNamaPer" placeholder="Nama Perawatan" value="<?php echo $oneperawatan['nm_perawatan'];?>">
                            <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                        </div>
                        <div class="form-group row ml-2">
                          <label for="addPasswordSett" class="col-sm-2 col-form-label">Lokasi</label>
                          <div class="col-sm-4">
                            <select name="b" id="AddKategoriPer" class="form-control">
                              <option for="AddKategoriPer" value="">Select Lokasi</option>
                              <?php foreach($lokasidata as $lodat) : ?>
                                <?php if($lodat['id_lokasi'] == $oneperawatan['lokasi']) : ?>
                                 <option for="AddKategoriPer" value="<?php echo $lodat['id_lokasi']?>" selected><?php echo $lodat['nm_lokasi'];?></option>
                                 <?php else :?>
                                   <option for="AddKategoriPer" value="<?php echo $lodat['id_lokasi']?>"><?php echo $lodat['nm_lokasi'];?></option>
                                 <?php endif; ?>

                               <?php endforeach; ?>
                             </select>
                             <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
                           </div>
                         </div>
                         <div class="form-group row ml-2">
                          <label for="addNamaPer" class="col-sm-2 col-form-label">Lokasi Rinci </label>
                          <div class="col-sm-4">
                            <input type="text" name="c" class="form-control" id="addNamaPer" placeholder="Meja Ke /dll" value="<?php echo $oneperawatan['lokasi_rinci'];?>">
                            <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
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
                              <input type="date" name="d" class="form-control float-right" id="kegiatanAdd" value="<?php echo $oneperawatan['tgl_perawatan'];?>">
                            </div>
                            <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                        </div>
                        <div class="form-group row ml-2">
                          <label for="addEmailSetting" class="col-sm-2 col-form-label">Keterangan</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="e" id="detailUserSettAddress" rows="3" placeholder="Keterangan.." value="<?php echo $oneperawatan['keterangan'];?>"><?php echo $oneperawatan['keterangan'];?></textarea>
                            <?php echo form_error('e', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer justify-content-between">
                          <a class="btn btn-info btn-sm" href="<?php echo base_url('member/perawatan');?>">
                            <i class="fas fa-arrow-left"></i>&ensp;Back To Perawatan List
                          </a>
                          <button type="submit" class="btn btn-warning btn-sm float-right"><i class="fas fa-edit"></i>&ensp;Update Data</button>
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
                      <a class="btn btn-sm btn-primary btn-outline-primary float-right" href="#" data-toggle="modal" data-target="#perbaikanAddModal">
                        <i class="fas fa-plus"></i> Add Data
                      </a>
                    </div>
                    <div class="card-body">
                      <div>
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th scope="col" style="text-align: center;">#</th>
                              <th scope="col" style="text-align: center;">Tanggal Perbaikan</th>
                              <th scope="col" style="text-align: center;">Kebutuhan</th>
                              <th scope="col" style="text-align: center; width: 100px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=0; foreach($allperbaikan as $allper) :  $i++;?>
                            <tr>
                              <th scope="row"><?php echo $i ;?></th>
                              <td><?php echo date('d F Y', strtotime($allper['tgl_perbaikan'])); ?></td>
                              <td><?php echo $allper['kebutuhan']; ?></td>
                              <td>
                                <a style="margin-right: 10px" href="#" data-toggle="modal" data-target="#perbaikanDetailModal<?php echo $allper['id_perbaikan'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                                <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#perbaikanEditModal<?php echo $allper['id_perbaikan'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                                <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#perbaikanDeleteModal<?php echo $allper['id_perbaikan'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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




  <!-- Perbaikan Add Modal -->
  <div class="modal fade" id="perbaikanAddModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title">Add Data Perbaikan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url('member/perbaikanAdd/'). $oneperawatan['id_perawatan'];?>" method="post">
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="kegiatanAdd">Tanggal Perbaikan</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="date" name="aa" class="form-control float-right" id="kegiatanAdd" value="<?php echo set_value('aa');?>">
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="addPasswordSett" class="col-sm-4 col-form-label">Lokasi</label>
              <div class="col-sm-8">
                <select name="xx" id="AddKategoriPer" class="form-control">
                  <option for="AddKategoriPer" disabled>Otomatis Sesuai Lokasi Perawatan</option>
                  <?php foreach($lokasidata as $lodat) : ?>
                    <?php if($lodat['id_lokasi'] == $oneperawatan['lokasi']) : ?>
                     <option for="AddKategoriPer" name="xx" value="<?php echo $lodat['id_lokasi']?>" selected><?php echo $lodat['nm_lokasi'];?></option>
                     <?php else :?>

                     <?php endif; ?>
                   <?php endforeach; ?>
                 </select>
               </div>
             </div>
             <div class="form-group row">
              <label for="addNamaPer" class="col-sm-4 col-form-label">Kode Barang</label>
              <div class="col-sm-8">
               <select name="bb" id="AddKategoriPer" class="form-control">
                <option for="AddKategoriPer" value="">Select Barang</option>
                <?php foreach($barang as $br) : ?>
                  <option for="AddKategoriPer" value="<?php echo $br['kd_barang']?>"><?php echo $br['kd_barang'];?> = <?php echo $br['nm_barang'];?> </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="detKategoriPer" class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-sm-8">
              <input type="text" name="cc" class="form-control" id="detKategoriPer" placeholder="Jumlah" value="<?php echo set_value('cc');?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="addPasswordSett" class="col-sm-4 col-form-label">Kebutuhan</label>
            <div class="col-sm-8">
              <textarea class="form-control" name="dd" id="detailUserSettAddress" rows="2" placeholder="Kebutuhan.."><?php echo set_value('dd');?></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="addNamaPer" class="col-sm-4 col-form-label">Hasil</label>
            <div class="col-sm-8">
              <textarea class="form-control" name="ee" id="detailUserSettAddress" rows="2" placeholder="Hasil.."><?php echo set_value('ee');?></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-warning btn-sm"><span aria-hidden="true">Tutup</span></button>
          <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&ensp;Add</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Perbaikan Modal Detail-->
<?php $i=0; foreach($allperbaikan as $allper) : $i++; ?>
<div class="modal fade" id="perbaikanDetailModal<?php echo $allper['id_perbaikan'];?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">Detail Perbaikan "<?php echo $oneperawatan['nm_perawatan'];?>"</h5>
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
              <label for="addNamaPer" class="col-sm-4 col-form-label">Lokasi</label>
              <div class="col-sm-8">
                <select name="xx" id="AddKategoriPer" class="form-control"disabled>
                  <option for="AddKategoriPer" value="">Select Lokasi</option>
                  <?php foreach($lokasidata as $lodat) : ?>
                    <?php if($lodat['id_lokasi'] == $oneperawatan['lokasi']) : ?>
                     <option for="AddKategoriPer" name="xx" value="<?php echo $lodat['id_lokasi']?>" selected><?php echo $lodat['nm_lokasi'];?></option>
                     <?php else :?>
                       <option for="AddKategoriPer" name="xx" value="<?php echo $lodat['id_lokasi']?>"><?php echo $lodat['nm_lokasi'];?></option>
                     <?php endif; ?>
                   <?php endforeach; ?>
                 </select>
                 <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
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
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary btn-sm"><span aria-hidden="true">Close</span></button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>

<!-- Perbaikan Edit Modal -->
<?php $i=0; foreach($allperbaikan as $allper) : $i++; ?>
<div class="modal fade" id="perbaikanEditModal<?php echo $allper['id_perbaikan'];?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Perbaikan Data Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('member/perbaikanEdit/'). $oneperawatan['id_perawatan'];?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="zz" readonly value="<?php echo $allper['id_perbaikan'];?>"  class="form-control" >

          <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="kegiatanAdd">Tanggal Perbaikan</label>
            <div class="col-sm-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="date" name="aa" class="form-control float-right" id="kegiatanAdd" value="<?php echo $allper['tgl_perbaikan'];?>">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="addNamaPer" class="col-sm-4 col-form-label">Kode Barang</label>
            <div class="col-sm-8">
              <select name="bb" id="AddKategoriPer" class="form-control" readonly>
                <?php foreach($barang as $br) : ?>
                  <?php if($br['kd_barang'] == $allper['kd_barang']) : ?>
                    <option for="AddKategoriPer" value="<?php echo $br['kd_barang']?>" selected><?php echo $br['kd_barang'];?> = <?php echo $br['nm_barang'];?> </option>
                    <?php else :?>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="addNamaPer" class="col-sm-4 col-form-label">Lokasi</label>
              <div class="col-sm-8">
                <select name="xx" id="AddKategoriPer" class="form-control" readonly>
                  <?php foreach($lokasidata as $lodat) : ?>
                    <?php if($lodat['id_lokasi'] == $allper['lokasi']) : ?>
                     <option for="AddKategoriPer" name="xx" value="<?php echo $lodat['id_lokasi']?>" selected><?php echo $lodat['nm_lokasi'];?></option>
                     <?php else :?>
                     <?php endif; ?>
                   <?php endforeach; ?>
                 </select>
                 <?php echo form_error('xx', '<small class="text-danger pl-3">', '</small>');?>
               </div>
             </div>
             <div class="form-group row">
              <label for="detKategoriPer" class="col-sm-4 col-form-label">Jumlah</label>
              <div class="col-sm-8">
                <input type="text" name="cc" class="form-control" id="detKategoriPer" placeholder="Jumlah" value="<?php echo $allper['jumlah'];?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="addPasswordSett" class="col-sm-4 col-form-label">Kebutuhan</label>
              <div class="col-sm-8">
                <textarea class="form-control" name="dd" id="detailUserSettAddress" rows="2" placeholder="Kebutuhan.." value="<?php echo $allper['kebutuhan'];?>"><?php echo $allper['kebutuhan'];?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="addNamaPer" class="col-sm-4 col-form-label">Hasil</label>
              <div class="col-sm-8">
                <textarea class="form-control" name="ee" id="detailUserSettAddress" rows="2" placeholder="Hasil.." value="<?php echo $allper['hasil'];?>"><?php echo $allper['hasil'];?></textarea>
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

<!-- Kategori Hapus Modal-->
<?php $i=0; foreach($allperbaikan as $allper) : $i++; ?>
<div class="modal fade" id="perbaikanDeleteModal<?php echo $allper['id_perbaikan'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Hapus <?php echo $allper['tgl_perbaikan'];?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus Data Tanggal <?php echo $allper['tgl_perbaikan'];?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?php echo base_url('member/perbaikanDelete/')?><?php echo $allper['id_perawatan'];?>/<?php echo $allper['id_perbaikan'];?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
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