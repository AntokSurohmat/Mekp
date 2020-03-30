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
              <li class="breadcrumb-item"><small><?php echo $title; ?></small></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <!-- Horizontal Form -->
       <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title"><?php echo $title ;?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="#" method="post">
          <div class="card-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="form-group row ml-2">
              <label for="DetailKodeBarang" class="col-sm-2 col-form-label">Kode Barang</label>
              <div class="col-sm-10">
                <input type="text" name="a" class="form-control" id="DetailKodeBarang" placeholder="Kode Barang" value="<?php echo $oneba['kd_barang'];?>" disabled>
                <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-2">
              <label for="DetailNamaBarang" class="col-sm-2 col-form-label">Nama Barang</label>
              <div class="col-sm-10">
                <input type="text" name="b" class="form-control" id="DetailNamaBarang" placeholder="Nama Barang" value="<?php echo $oneba['nm_barang'];?>" disabled>
                <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-2">
              <label for="DetailMerkBarang" class="col-sm-2 col-form-label">Merk</label>
              <div class="col-sm-10">
                <input type="text" name="c" class="form-control" id="DetailMerkBarang" placeholder="Nama Barang" value="<?php echo $oneba['nm_merk'];?>" disabled>
                <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-2">
              <label for="DetailKategoriBarang" class="col-sm-2 col-form-label">Kategori</label>
              <div class="col-sm-10">
                <input type="text" name="d" class="form-control" id="DetailKategoriBarang" placeholder="Nama Barang" value="<?php echo $oneba['nm_kategori'];?>" disabled>
                <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-2">
              <label for="DetailStatusBarang" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <input type="text" name="e" class="form-control" id="DetailStatusBarang" placeholder="Nama Barang" value="<?php echo $oneba['nm_status'];?>" disabled>
                <?php echo form_error('e', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-2">
              <label for="DetailKondisiBarang" class="col-sm-2 col-form-label">Kondisi</label>
              <div class="col-sm-10">
                <input type="text" name="f" class="form-control" id="DetailKondisiBarang" placeholder="Nama Barang" value="<?php echo $oneba['nm_kondisi'];?>" disabled>
                <?php echo form_error('f', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-2">
              <label for="addEmailSetting" class="col-sm-2 col-form-label">Jumlah</label>
              <div class="col-sm-10">
                <input type="text" name="g" class="form-control" id="addEmailSetting" placeholder="Jumlah Barang" value="<?php echo $oneba['jumlah'];?>" disabled>
                <?php echo form_error('g', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-2">
              <label for="addEmailSetting" class="col-sm-2 col-form-label">Tahun Pengadaan</label>
              <div class="col-sm-10">
                <input type="text" name="h" class="form-control" id="addEmailSetting" placeholder="Tahun Pengadaan Barang" value="<?php echo $oneba['thn_pengadaan'] ;?>" disabled>
                <?php echo form_error('h', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-2">
              <label for="addEmailSetting" class="col-sm-2 col-form-label">Catatan</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="k" id="detailUserSettAddress" rows="3" placeholder="Catatan.." value="" disabled><?php echo $oneba['catatan'];?></textarea>
                <?php echo form_error('k', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
                <a class="btn btn-info btn-sm" href="<?php echo base_url('member/master');?>">
                  <i class="fas fa-arrow-left"></i>&ensp;Back To Master List
                </a>
                <a class="btn btn-warning btn-sm float-right" href="<?php echo base_url('member/barangEdit/'). $oneba['id_barang'];?>">
                  <i class="fas fa-edit"></i>&ensp;Edit Barang
                </a>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
