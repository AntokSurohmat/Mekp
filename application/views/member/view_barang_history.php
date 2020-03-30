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



        <div class="row">
          <div class="col-12">
            <div class="callout callout-danger">
              <h5><i class="fas fa-info"></i> Note:</h5>
              <dl>
                <dd>
                  History Barang Disini Menjelaskan Masuk Dan Keluarnya Barang.
                  <ul>
                    <li>
                      Jumlah Barang akan bertambah ketika barang yang sama di masukkan
                    </li>
                    <li>
                      sedangkan jumlah barang berkurang ketika kita memasukkan jumlah barang di <b><i>Tabel Data Perbaikan</i></b>
                    </li>
                  </ul>
                </dd>
              </dl>
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
              </div>
            </div>
            <div class="card-body">
              <table class="table table-striped table-bordered" id="example1">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Barang</th>
                    <th>Tanggal Masuk</th>
                    <th>Asal</th>
                    <th>Jumlah</th>
                    <th style="width: 100px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach($allhisbama as $ahbm) :  $i++;?>
                  <tr>
                    <th scope="row"><?php echo $i ;?></th>
                    <td><?php echo $ahbm['kd_barang']; ?></td>
                    <td><?php echo date('d F Y', strtotime($ahbm['tgl_masuk'])) ;?></td>
                    <td><?php echo $ahbm['dari_ke'] ;?></td>
                    <td><?php echo $ahbm['jumlah']; ?></td>
                    <td>
                      <a style="margin-right:10px" href="#"  data-toggle="modal" data-target="#DetailModal<?php echo $ahbm['id_barang_masuk'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#EditModal<?php echo $ahbm['id_barang_masuk'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                      <a href="#" data-toggle="modal" data-target="#DeleteModal<?php echo $ahbm['id_barang_masuk'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <br>
            <hr>
            <br>
            <table class="table table-striped table-bordered" id="example2">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Barang</th>
                  <th>Tanggal Keluar</th>
                  <th>Untuk</th>
                  <th>Jumlah</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($allhisbake as $ahbk) :  $i++;?>
                <tr>
                  <th scope="row"><?php echo $i ;?></th>
                  <td><?php echo $ahbk['kd_barang']; ?></td>
                  <td><?php echo date('d F Y', strtotime($ahbk['tgl_keluar'])); ?></td>
                  <td><?php echo $ahbk['nm_lokasi']; ?></td>
                  <td><?php echo $ahbk['jumlah']; ?></td>
                  <td>
                    <a style="margin-right:10px" href="#"  data-toggle="modal" data-target="#DetailModalKe<?php echo $ahbk['id_barang_keluar'];?>" title="Detail"><i class="fas fa-book-open text-info"></i></a>
                    <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#EditModalKe<?php echo $ahbk['id_barang_keluar'];?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                    <a href="#" data-toggle="modal" data-target="#DeleteModalKe<?php echo $ahbk['id_barang_keluar'];?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer justify-content-between">
          <a class="btn btn-info btn-sm" href="<?php echo base_url('member/master');?>">
            <i class="fas fa-arrow-left"></i>&ensp;Back To Master List
          </a>
        </div>
        <!-- /.card-footer -->
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.Left col --> 
  </div>
  <!-- / .row (Bot row) -->
</div>
<!--/. container-fluid -->


<!-- History Modal Detail-->
<?php $i=0; foreach($allhisbama as $ahbm) : $i++; ?>
<div class="modal fade" id="DetailModal<?php echo $ahbm['id_barang_masuk'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">Detail History Data "<?php echo $ahbm['kd_barang'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">
          <div class="form-group row ml-2">
            <label for="DetailKodeBarang" class="col-sm-4 col-form-label">Kode Barang</label>
            <div class="col-sm-8">
              <input type="text" name="a" class="form-control" id="DetailKodeBarang" placeholder="Kode Barang" value="<?php echo $ahbm['kd_barang'];?>" disabled>
              <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="detailJumlahBarang" class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-sm-8">
              <input type="text" name="b" class="form-control" id="detailJumlahBarang" placeholder="Kode Barang" value="<?php echo $ahbm['jumlah'];?>" disabled>
              <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="detailTanggalMasuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-8">
              <input type="text" name="c" class="form-control" id="detailTanggalMasuk" placeholder="Kode Barang" value="<?php echo $ahbm['tgl_masuk'];?>" disabled>
              <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="detailAsalBArang" class="col-sm-4 col-form-label">Asal</label>
            <div class="col-sm-8">
              <input type="text" name="d" class="form-control" id="detailAsalBArang" placeholder="Kode Barang" value="<?php echo $ahbm['dari_ke'];?>" disabled>
              <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="detailCatatanBarang" class="col-sm-4 col-form-label">Catatan</label>
            <div class="col-sm-8">
              <input type="text" name="e" class="form-control" id="detailCatatanBarang" placeholder="Kode Barang" value="<?php echo $ahbm['catatan'];?>" disabled>
              <?php echo form_error('e', '<small class="text-danger pl-3">', '</small>');?>
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
<!-- /.modal -->
<?php endforeach; ?>

<!-- History Modal Edit-->
<?php $i=0; foreach($allhisbama as $ahbm) : $i++; ?>
<div class="modal fade" id="EditModal<?php echo $ahbm['id_barang_masuk'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit History Data "<?php echo $ahbm['kd_barang'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('member/barangHistoryMasukEdit/'). $ahbm['id_barang_masuk'];?>" method="post">
        <div class="modal-body">

          <input type="hidden" name="zz" readonly value="<?php echo $ahbm['id_barang_masuk'];?>"  class="form-control" >

          <div class="form-group row ml-2">
            <label for="EditKodeBarang" class="col-sm-4 col-form-label">Kode Barang</label>
            <div class="col-sm-8">
              <input type="text" name="a" class="form-control" id="EditKodeBarang" placeholder="Kode Barang" value="<?php echo $ahbm['kd_barang'];?>" readonly>
              <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="EditJumlahBarang" class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-sm-8">
              <input type="text" name="b" class="form-control" id="EditJumlahBarang" placeholder="JUmlah" value="<?php echo $ahbm['jumlah'];?>">
              <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="editTanggalMasuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-8">
              <input type="text" name="c" class="form-control" id="editTanggalMasuk" placeholder="Tanggal Masuk" value="<?php echo $ahbm['tgl_masuk'];?>" readonly>
              <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="editAsalBarang" class="col-sm-4 col-form-label">Asal</label>
            <div class="col-sm-8">
              <input type="text" name="d" class="form-control" id="editAsalBarang" placeholder="Pembelian/Pinjam/Pemberian" value="<?php echo $ahbm['dari_ke'];?>">
              <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="editCatatanBarang" class="col-sm-4 col-form-label">Catatan</label>
            <div class="col-sm-8">
              <input type="text" name="e" class="form-control" id="editCatatanBarang" placeholder="Catatan" value="<?php echo $ahbm['catatan'];?>">
              <?php echo form_error('e', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
         <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-warning btn-sm"><span aria-hidden="true">Tutup</span></button>
         <button type="submit" class="btn btn-primary btn-sm">Update</button>
       </div>
     </form>
   </div>
   <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>

<!-- Barang Hapus Modal-->
<?php $i=0; foreach($allhisbama as $ahbm) : $i++; ?>
<div class="modal fade" id="DeleteModal<?php echo $ahbm['id_barang_masuk'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus <?php echo $ahbm['kd_barang'];?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus Data <?php echo $ahbm['kd_barang'] ;?> yang masuk tanggal <?php echo $ahbm['tgl_masuk'] ;?> .</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?php echo base_url('member/baranghistoryMasukDelete/')?><?php echo $ahbm['id_barang_masuk'];?>/<?php echo $ahbm['kd_barang'];?>">Hapus</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>


<!-- History Modal Detail-->
<?php $i=0; foreach($allhisbake as $ahbk) : $i++; ?>
<div class="modal fade" id="DetailModalKe<?php echo $ahbk['id_barang_keluar'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">Detail History Data "<?php echo $ahbk['kd_barang'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">
          <div class="form-group row ml-2">
            <label for="DetailKodeBarang" class="col-sm-4 col-form-label">Kode Barang</label>
            <div class="col-sm-8">
              <input type="text" name="a" class="form-control" id="DetailKodeBarang" placeholder="Kode Barang" value="<?php echo $ahbk['kd_barang'];?>" disabled>
              <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="detailJumlahBarang" class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-sm-8">
              <input type="text" name="b" class="form-control" id="detailJumlahBarang" placeholder="Kode Barang" value="<?php echo $ahbk['jumlah'];?>" disabled>
              <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="detailTanggalMasuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-8">
              <input type="text" name="c" class="form-control" id="detailTanggalMasuk" placeholder="Kode Barang" value="<?php echo $ahbk['tgl_keluar'];?>" disabled>
              <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="detailAsalBArang" class="col-sm-4 col-form-label">Untuk</label>
            <div class="col-sm-8">
              <input type="text" name="d" class="form-control" id="detailAsalBArang" placeholder="Kode Barang" value="<?php echo $ahbk['nm_lokasi'];?>" readonly>
              <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="detailAsalBArang" class="col-sm-4 col-form-label">Kebutuhan</label>
            <div class="col-sm-8">
              <input type="text" name="d" class="form-control" id="detailAsalBArang" placeholder="Kode Barang" value="<?php echo $ahbk['kebutuhan'];?>" readonly>
              <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="detailCatatanBarang" class="col-sm-4 col-form-label">Catatan</label>
            <div class="col-sm-8">
              <input type="text" name="e" class="form-control" id="detailCatatanBarang" placeholder="Kode Barang" value="<?php echo $ahbk['catatana'];?>" disabled>
              <?php echo form_error('e', '<small class="text-danger pl-3">', '</small>');?>
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
<!-- /.modal -->
<?php endforeach; ?>

<!-- History Modal Edit-->
<?php $i=0; foreach($allhisbake as $ahbk) : $i++; ?>
<div class="modal fade" id="EditModalKe<?php echo $ahbk['id_barang_keluar'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit History Data "<?php echo $ahbk['kd_barang'];?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('member/barangHistoryKeluarEdit/'). $ahbk['id_barang_keluar'];?>" method="post">
        <div class="modal-body">

          <input type="hidden" name="zz" readonly value="<?php echo $ahbk['id_barang_keluar'];?>"  class="form-control" >

          <input type="hidden" name="xx" readonly value="<?php echo $ahbk['id_perbaikan'];?>"  class="form-control" >

          <div class="form-group row ml-2">
            <label for="EditKodeBarang" class="col-sm-4 col-form-label">Kode Barang</label>
            <div class="col-sm-8">
              <input type="text" name="a" class="form-control" id="EditKodeBarang" placeholder="Kode Barang" value="<?php echo $ahbk['kd_barang'];?>"readonly>
              <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="EditJumlahBarang" class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-sm-8">
              <input type="text" name="b" class="form-control" id="EditJumlahBarang" placeholder="JUmlah" value="<?php echo $ahbk['jumlah'];?>">
              <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="editTanggalMasuk" class="col-sm-4 col-form-label">Tanggal Keluar</label>
            <div class="col-sm-8">
              <input type="text" name="c" class="form-control" id="editTanggalMasuk" placeholder="Tanggal Masuk" value="<?php echo $ahbk['tgl_keluar'];?>">
              <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="editAsalBarang" class="col-sm-4 col-form-label">Lokasi</label>
            <div class="col-sm-8">
              <select name="d" id="AddKategoriPer" class="form-control">
                <option for="AddKategoriPer" disabled>Otomatis Sesuai Lokasi Perawatan</option>
                <?php foreach($lokasidata as $lodat) : ?>
                  <?php if($lodat['id_lokasi'] == $ahbk['dari_ke']) : ?>
                   <option for="AddKategoriPer" name="xx" value="<?php echo $lodat['id_lokasi']?>" selected><?php echo $lodat['nm_lokasi'];?></option>
                   <?php else :?>

                   <?php endif; ?>
                 <?php endforeach; ?>
               </select>
               <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
             </div>
           </div>
           <div class="form-group row ml-2">
            <label for="editAsalBarang" class="col-sm-4 col-form-label">Kebutuhan</label>
            <div class="col-sm-8">
              <input type="text" name="e" class="form-control" id="detailAsalBArang" placeholder="Kode Barang" value="<?php echo $ahbk['kebutuhan'];?>">
              <?php echo form_error('e', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-2">
            <label for="editCatatanBarang" class="col-sm-4 col-form-label">Catatan</label>
            <div class="col-sm-8">
              <input type="text" name="f" class="form-control" id="editCatatanBarang" placeholder="Catatan" value="<?php echo $ahbk['catatana'];?>">
              <?php echo form_error('f', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
         <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-warning btn-sm"><span aria-hidden="true">Tutup</span></button>
         <button type="submit" class="btn btn-primary btn-sm">Update</button>
       </div>
     </form>
   </div>
   <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>

<!-- Barang Hapus Modal-->
<?php $i=0; foreach($allhisbake as $ahbk) : $i++; ?>
<div class="modal fade" id="DeleteModalKe<?php echo $ahbk['id_barang_keluar'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus <?php echo $ahbk['kd_barang'];?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus Data <?php echo $ahbk['kd_barang'] ;?> yang masuk tanggal <?php echo $ahbk['tgl_keluar'] ;?> .</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?php echo base_url('member/baranghistoryKeluarDelete/')?><?php echo $ahbk['id_barang_keluar'];?>/<?php echo $ahbk['id_perbaikan'];?>/<?php echo $ahbk['kd_barang'];?>">Hapus</a>
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