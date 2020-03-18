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
        <div class="row">
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="<?php echo base_url('member/laporan')?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <select name="a" class="form-control">
                      <option value="">-- Pilih Tabel --</option>
                      <option value="mekp_barang_masuk">Tabel Barang Masuk</option>
                      <option value="mekp_barang_keluar">Tabel Barang Keluar</option>
                      <option value="mekp_perawatan">Tabel Perawatan</option>
                      <option value="mekp_perbaikan">Tabel Perbaiakan</option>
                    </select>
                    <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label>Date range:</label>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" name="b" class="form-control float-right" id="reservation">
                          <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- /.input group -->
                      </div>
                      <div class="mt-1">
                        <p >s.d</p>
                      </div>
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" name="c" class="form-control float-right" id="akhir">
                          <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
                        <?php //var_dump($alllaporan);?>
          <div class="col-md-12">

            <?php 
            $tabel = $this->input->post('a');

            switch ($tabel) {
              case 'mekp_barang_masuk':
              $out = '<div class="card">
              <div class="card-header">
              <h4 class="card-title " text-align="center"><strong><?php echo $title; ?></strong></h4>
              </div>
              <div class="card-body">
              <div>
              <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">Barang Masuk</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Action</th>
              </tr>
              </thead>
              <tbody>
              <?php var_dump($alllaporan)?>
              </tbody>
              </table>
              </div>
              <!-- /.row -->
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->';
              break;

              case 'mekp_barang_keluar':
              $out = '            
              <!-- Default box -->
              <div class="card">
              <div class="card-header">
              <h4 class="card-title " text-align="center"><strong><?php echo $title; ?></strong></h4>
              </div>
              <div class="card-body">
              <div>
              <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">Barang Keluar</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Action</th>
              </tr>
              </thead>
              <tbody>';
              foreach($alllaporan as $lap):
                 $out .='<td>'. $lap['kd_barang'] .'</td>';
                 $out .='<td></td>';
              endforeach;
              
              $out = '</tbody>
              </table>
              </div>
              <!-- /.row -->
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->';
              break;

              default:
              $out = '<div class="row">
              <div class="col-12">
              <div class="callout callout-danger">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Silahkan Melengkapi Form Untuk Menampilkan Data
              </div>
              </div>
              <!--/. Col -->
              </div>
              <!--/. Row -->';
              break;
            };
            echo $out;
            ?>
          </div>
        </div>
        <!-- Default box -->

      </section>
    <!-- /.content -->