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
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><?php echo $title; ?>&ensp;</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('member/barangEdit/'). $oneba['id_barang'];?>" method="post">
            <div class="card-body">
              <?php echo $this->session->flashdata('message'); ?>

              <input type="hidden" readonly value="<?php echo $oneba['id_barang'];?>" name="zz" class="form-control" >

              <div class="form-group row ml-2">
                <label for="addUserSetting" class="col-sm-2 col-form-label">Kode Barang</label>
                <div class="col-sm-10">
                  <input type="text" name="a" class="form-control" id="addUserSetting" placeholder="Kode Barang" value="<?php echo $oneba['kd_barang'];?>">
                  <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-2">
                <label for="addEmailSetting" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                  <input type="text" name="b" class="form-control" id="addEmailSetting" placeholder="Nama Barang" value="<?php echo $oneba['nm_barang'];?>">
                  <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-2">
                <label for="addPasswordSett" class="col-sm-2 col-form-label">Merk</label>
                <div class="col-sm-10">
                  <select name="c" id="InputSubMenuMenu" class="form-control">
                    <option for="InputSubMenuMenu" value="">Select Merk</option>
                    <?php foreach($merkdata as $medat) : ?>
                      <?php if($medat['id_merk'] == $oneba['merk']) : ?>
                        <option for="InputSubMenuMenu"  value="<?php echo $medat['id_merk']?>" selected><?php echo $medat['nm_merk'];?></option>
                        <?php else :?>
                          <option for="InputSubMenuMenu"  value="<?php echo $medat['id_merk']?>"><?php echo $medat['nm_merk'];?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                </div>
                <div class="form-group row ml-2">
                  <label for="addPasswordSett" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select name="d" id="InputSubMenuMenu" class="form-control">
                      <option for="InputSubMenuMenu" value="">Select Kategori</option>
                      <?php foreach($kategoridata as $katda) : ?>
                        <?php if($katda['id_kategori'] == $oneba['kategori']) : ?>
                          <option for="InputSubMenuMenu" value="<?php echo $katda['id_kategori']?>" selected><?php echo $katda['nm_kategori'];?></option>
                          <?php else :?>
                            <option for="InputSubMenuMenu" value="<?php echo $katda['id_kategori']?>"><?php echo $katda['nm_kategori'];?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                  </div>
                  <div class="form-group row ml-2">
                    <label for="addPasswordSett" class="col-sm-2 col-form-label">Kondisi</label>
                    <div class="col-sm-10">
                      <select name="e" id="InputSubMenuMenu" class="form-control">
                        <option for="InputSubMenuMenu" value="">Select Kondisi</option>
                        <?php foreach($kondisidata as $kondat) : ?>
                          <?php if($kondat['id_kondisi'] == $oneba['kondisi']) : ?>
                            <option for="InputSubMenuMenu"  value="<?php echo $kondat['id_kondisi']?>" selected><?php echo $kondat['nm_kondisi'];?></option>
                            <?php else :?>
                              <option for="InputSubMenuMenu"  value="<?php echo $kondat['id_kondisi']?>"><?php echo $kondat['nm_kondisi'];?></option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('e', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                    </div>
                    <div class="form-group row ml-2">
                      <label for="addPasswordSett" class="col-sm-2 col-form-label">Status</label>
                      <div class="col-sm-10">
                        <select name="f" id="InputSubMenuMenu" class="form-control">
                          <option for="InputSubMenuMenu" value="">Select Status</option>
                          <?php foreach($statusdata as $stadat) : ?>
                            <?php if($stadat['id_status'] == $oneba['status']) : ?>
                              <option for="InputSubMenuMenu"  value="<?php echo $stadat['id_status']?>" selected><?php echo $stadat['nm_status'];?></option>
                              <?php else :?>
                                <option for="InputSubMenuMenu"  value="<?php echo $stadat['id_status']?>"><?php echo $stadat['nm_status'];?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                          <?php echo form_error('f', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row ml-2">
                        <label for="addEmailSetting" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                          <input type="text" name="g" class="form-control" id="addEmailSetting" placeholder="Jumlah Barang" value="<?php echo $oneba['jumlah'];?>">
                          <?php echo form_error('g', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row ml-2">
                        <label for="addEmailSetting" class="col-sm-2 col-form-label">Tahun Pengadaan</label>
                        <div class="col-sm-10">
                          <input type="text" name="h" class="form-control" id="addEmailSetting" placeholder="Tahun Pengadaan Barang" value="<?php echo $oneba['thn_pengadaan'];?>">
                          <?php echo form_error('h', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row ml-2">
                        <label for="addEmailSetting" class="col-sm-2 col-form-label">Catatan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="i" id="detailUserSettAddress" rows="3" placeholder="Catatan.." value="<?php echo set_value('e');?>"><?php echo $oneba['catatan'];?></textarea>
                          <?php echo form_error('i', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer justify-content-between">
                        <a class="btn btn-info btn-sm" href="<?php echo base_url('member/master');?>">
                          <i class="fas fa-arrow-left"></i>&ensp;Back To Master List
                        </a>
                        <button type="submit" class="btn btn-warning btn-sm float-right"><i class="fas fa-edit"></i>&ensp;Update Barang</button>
                      </div>
                      <!-- /.card-footer -->
                    </form>
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.container-fluid -->
              </section>
              <!-- /.content -->
