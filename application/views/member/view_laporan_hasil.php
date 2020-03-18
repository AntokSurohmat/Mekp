            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h4 class="card-title " text-align="center"><strong><?php echo $title; ?></strong></h4>
              </div>
              <div class="card-body">
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
                                     
                  </tbody>
                </table>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


          <?php var_dump($row['tgl_masuk']);?>
            <?php 
            $tabel = $this->input->post('a');

            switch ($tabel) {
              case 'mekp_barang_masuk':
              $out = "
              <!-- Default box -->
              <div class='card'>
              <div class='card-header'>
              <h4 class='card-title '' text-align='center'><strong><?php echo $title; ?></strong></h4>
              </div>
              <div class='card-body'>
              <div>
              <table id='example1' class='table table-bordered table-striped'>
              <thead>
              <tr>
              <th scope='col'>#</th>
              <th scope='col>Barang Keluar</th>
              <th scope='col'>Lokasi</th>
              <th scope='col'>Tanggal</th>
              <th scope='col'>Action</th>
              </tr>
              </thead>
              <tbody>


              </tbody>
              </table>
              </div>
              <!-- /.row -->
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->
              ";
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
              <tbody>


              </tbody>
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
<!-- Default box -->
              <div class='card'>
              <div class='card-header'>
              <h4 class='card-title'  text-align='center'><strong><?php echo $title; ?></strong></h4>
              </div>
              <div class='card-body'>
              <div>
              <table id='example1' class='table table-bordered table-striped'>
              <thead>
              <tr>
              <th scope='col'>#</th>
              <th scope='col'>Barang Keluar</th>
              <th scope='col'>Lokasi</th>
              <th scope='col'>Tanggal</th>
              <th scope='col'>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php $i=0; foreach($row as $allper) :  $i++;?>
              <tr>
              <th scope='row'><?php echo $i ;?></th>
              <td><?php echo $allper[tgl_masuk]; ?></td>
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
<?php
foreach ($variable as $key => $value) {
  # code...
}
?>