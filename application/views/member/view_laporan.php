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
                <h3 class="card-title">Form Laporan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="<?php echo base_url('member/laporan')?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tabel</label>
                    <select name="a" class="form-control">
                      <option value="">-- Pilih Tabel --</option>
                      <option value="mekp_barang_masuk">Tabel Barang Masuk</option>
                      <option value="mekp_barang_keluar">Tabel Barang Keluar</option>
                      <option value="mekp_perawatan">Tabel Perawatan</option>
                      <option value="mekp_perbaikan">Tabel Perbaikan</option>
                    </select>
                    <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label>Periode:</label>
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

                <div class="card-footer justify-content-between">
                  <a class="btn btn-sm btn-danger" href="<?php echo base_url('member/laporan');?>">Reset</a>
                  <button type="submit" class="btn btn-sm btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-12">



            <?php 

            $tabel = $this->input->post('a');
            $awal = $this->input->post('b');
            $akhir = $this->input->post('c');
            switch ($tabel) {
              case 'mekp_barang_masuk':
              $out = '<div class="card">
              <div class="card-header border-0 bg-gray">
              <h3 class="card-title mt-2">
              <i class="fas fa-th mr-1"></i>';
              $out .= $barangmasuk;
              $out .= '</h3>
              <div class="btn-group float-right">
              <div class="row">
              <form action="'. base_url('laporan').'" method="post" >
              <input type="hidden" readonly value="mekp_barang_masuk" name="aa" class="form-control" >
              <input type="hidden" readonly value ="'.set_value('b').'" name="bb" class="form-control" >
              <input type="hidden" readonly value="'.set_value('c').'" name="cc" class="form-control" >
              <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
              </form>
              &ensp;
              <form action="'. base_url('laporan/excel').'" method="post" >
              <input type="hidden" readonly value="mekp_barang_masuk" name="aa" class="form-control" >
              <input type="hidden" readonly value ="$awal" name="bb" class="form-control" >
              <input type="hidden" readonly value="$akhir" name="cc" class="form-control" >
              <button type="submit" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i>&ensp;Export Excel</button>
              </form>
              </div>

              
              </div>
              </div>
              <div class="card-body">
              <div>
              <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">Kode Barang</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Tanggal Masuk</th>
              <th scope="col">Asal</th>
              <th scope="col">Catatan</th>
              </tr>
              </thead>
              <tbody>';

              $i=0; foreach($alllaporan as $lap): $i++;
              $out .='<tr>';
              $out .='<th scope="row">' .$i.'</th>';                
              $out .='<td>'. $lap['kd_barang'] .'</td>';
              foreach ($allbarang as $allbar) :
                if ($allbar['kd_barang'] == $lap['kd_barang']) : 
                  $out .= '<td>'.$allbar['nm_barang'].'</td>';
                endif;
              endforeach;
              $out .='<td>' .$lap['jumlah']. '</td>';
              $out .='<td>' . date('d F Y', strtotime($lap['tgl_masuk'])). '</td>';
              $out .='<td>' .$lap['dari_ke']. '</td>';
              $out .='<td>' .$lap['catatan']. '</td>';
              $out .='</tr>';
            endforeach;

            $out .= '</tbody>
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
            <div class="card-header border-0 bg-gray">
            <h3 class="card-title mt-2">
            <i class="fas fa-th mr-1"></i>';
            $out .= $barangkeluar;
            $out .= '</h3>
            <div class="btn-group float-right">
            <div class="row">
            <form action="'. base_url('laporan').'" method="post" >
            <input type="hidden" readonly value="mekp_barang_keluar" name="aa" class="form-control" >
            <input type="hidden" readonly value ="'.set_value('b').'" name="bb" class="form-control" >
            <input type="hidden" readonly value="'.set_value('c').'" name="cc" class="form-control" >
            <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
            </form>
            &ensp;
            <form action="'. base_url('laporan/excel').'" method="post" >
            <input type="hidden" readonly value="mekp_barang_masuk" name="aa" class="form-control" >
            <input type="hidden" readonly value ="$awal" name="bb" class="form-control" >
            <input type="hidden" readonly value="$akhir" name="cc" class="form-control" >
            <button type="submit" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i>&ensp;Export Excel</button>
            </form>
            </div>
            </div>
            </div>
            <div class="card-body">
            <div>
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Kode Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Tanggal Keluar</th>
            <th scope="col">Untuk</th>
            <th scope="col">Kebutuhan</th>
            <th scope="col">Catatan</th>
            <th scope="col">ID Perbaikan</th>
            </tr>
            </thead>
            <tbody>';

            $i=0; foreach($alllaporan as $lap): $i++;
            $out.='<tr>';
            $out .='<th scope="row">' .$i.'</th>';                
            $out .='<td>'. $lap['kd_barang'] .'</td>';
            foreach ($allbarang as $allbar) :
              if ($allbar['kd_barang'] == $lap['kd_barang']) : 
                $out .='<td>'.$allbar['nm_barang'].'</td>';
              endif;
            endforeach;
            $out .='<td>' . $lap['jumlah'] . '</td>';
            $out .='<td>' . date('d F Y', strtotime($lap['tgl_keluar'])) . '</td>';
            foreach ($lokasidata as $lodat) :
              if ($lodat['id_lokasi'] == $lap['dari_ke']) : 
                $out .= '<td>'.$lodat['nm_lokasi'].'</td>';
              endif;
            endforeach;
            $out .='<td>' . $lap['kebutuhan'] . '</td>';
            $out .='<td>' . $lap['catatan'] . '</td>';
            foreach ($allperbaikan as $allperba) :
              if ($allperba['id_perbaikan'] == $lap['id_perbaikan'] ) : 
                $out .= '<td>'.$allperba['id_perbaikan'].'</td>';
              endif;
            endforeach;
            $out.='</tr>';
          endforeach;
          $out .= '</tbody>
          </table>
          </div>
          <!-- /.row -->
          </div>
          <!-- /.card-body -->
          </div>
          <!-- /.card -->';


          break;
          case 'mekp_perawatan':

          $out = '            
          <!-- Default box -->
          <div class="card">
          <div class="card-header border-0 bg-gray">
          <h3 class="card-title mt-2">
          <i class="fas fa-th mr-1"></i>';
          $out .= $perawatan;
          $out .='</h3>
          <div class="btn-group float-right">
          <div class="row">
          <form action="'. base_url('laporan').'" method="post" >
          <input type="hidden" readonly value="mekp_perawatan" name="aa" class="form-control" >
          <input type="hidden" readonly value ="'.set_value('b').'" name="bb" class="form-control" >
          <input type="hidden" readonly value="'.set_value('c').'" name="cc" class="form-control" >
          <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
          </form>
          &ensp;
          <form action="'. base_url('laporan/excel').'" method="post" >
          <input type="hidden" readonly value="mekp_barang_masuk" name="aa" class="form-control" >
          <input type="hidden" readonly value ="$awal" name="bb" class="form-control" >
          <input type="hidden" readonly value="$akhir" name="cc" class="form-control" >
          <button type="submit" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i>&ensp;Export Excel</button>
          </form>
          </div>
          </div>
          </div>
          <div class="card-body">
          <div>
          <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Perawatan</th>
          <th scope="col">Tanggal Perawatan</th>
          <th scope="col">Lokasi</th>
          <th scope="col">Lokasi Rinci</th>
          <th scope="col">Keterangan</th>
          </tr>
          </thead>
          <tbody>';

          $i=0; foreach($alllaporan as $lap): $i++;
          $out.='<tr>';
          $out .='<th scope="row">' .$i.'</th>';                
          $out .='<td>'. $lap['nm_perawatan'] .'</td>';
          $out .='<td>'. date('d F Y', strtotime($lap['tgl_perawatan'])).'</td>';
          foreach ($lokasidata as $lodat) :
            if ($lodat['id_lokasi'] == $lap['lokasi']) : 
              $out .='<td>'.$lodat['nm_lokasi'].'</td>';
            endif;
          endforeach;
          $out .= '<td>'.$lap['lokasi_rinci'].'</td>';
          $out .= '<td>'.$lap['keterangan'].'</td>';
          $out.='</tr>';
        endforeach;
        $out .= '</tbody>
        </table>
        </div>
        <!-- /.row -->
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->';


        break;
        case 'mekp_perbaikan':

        $out = '            
        <!-- Default box -->
        <div class="card">
        <div class="card-header border-0 bg-gray">
        <h3 class="card-title mt-2">
        <i class="fas fa-th mr-1"></i>';
        $out .= $perbaikan;
        $out .= '</h3>
        <div class="btn-group float-right">
        <div class="row">
        <form action="'. base_url('laporan').'" method="post" >
        <input type="hidden" readonly value="mekp_perbaikan" name="aa" class="form-control" >
        <input type="hidden" readonly value ="'.set_value('b').'" name="bb" class="form-control" >
        <input type="hidden" readonly value="'.set_value('c').'" name="cc" class="form-control" >
        <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
        </form>
        &ensp;
        <form action="'. base_url('laporan/excel').'" method="post" >
        <input type="hidden" readonly value="mekp_barang_masuk" name="aa" class="form-control" >
        <input type="hidden" readonly value ="$awal" name="bb" class="form-control" >
        <input type="hidden" readonly value="$akhir" name="cc" class="form-control" >
        <button type="submit" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i>&ensp;Export Excel</button>
        </form>
        </div>
        </div>
        </div>
        <div class="card-body">
        <div>
        <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Perawatan</th>
        <th scope="col">Tanggal Perbaikan</th>
        <th scope="col">Lokasi</th>
        <th scope="col">kebutuhan</th>
        <th scope="col">kode Barang</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Hasil</th>
        </tr>
        </thead>
        <tbody>';

        $i=0; foreach($alllaporan as $lap): $i++;
        $out.='<tr>';
        $out .='<th scope="row">' .$i.'</th>';
        foreach ($allperawatan as $allper) :
          if ($allper['id_perawatan'] == $lap['id_perawatan']) : 
            $out .= '<td>'.$allper['nm_perawatan'].'</td>';
          endif;
        endforeach;
        $out .= '<td>'. date('d F Y', strtotime($lap['tgl_perbaikan'])).'</td>';
        foreach ($lokasidata as $lodat) :
          if ($lodat['id_lokasi'] == $lap['lokasi']) : 
            $out .= '<td>'.$lodat['nm_lokasi'].'</td>';
          endif;
        endforeach;
        $out .= '<td>'.$lap['kebutuhan'].'</td>';
        $out .= '<td>'.$lap['kd_barang'].'</td>';
        $out .= '<td>'.$lap['jumlah'].'</td>';
        $out .= '<td>'.$lap['hasil'].'</td>';               
        $out.='</tr>';
      endforeach;
      $out .= '</tbody>
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
      Silahkan Melengkapi Form Untuk Menampilkan Data yang di inginkan
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
      <div class="card-header border-0 bg-gray">
      <h3 class="card-title mt-2">
      <i class="fas fa-th mr-1"></i>';
      $out .= $barang;
      $out .= '</h3>
      <div class="btn-group float-right">
      <form action="'. base_url('laporan/laporanall').'" method="post" >
      <input type="hidden" readonly value="mekp_barang" name="aa" class="form-control" >
      <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
      </form>
      &ensp;
      <form action="'. base_url('laporan/excel').'" method="post" >
      <input type="hidden" readonly value="mekp_barang_masuk" name="aa" class="form-control" >
      <input type="hidden" readonly value ="$awal" name="bb" class="form-control" >
      <input type="hidden" readonly value="$akhir" name="cc" class="form-control" >
      <button type="submit" class="btn btn-sm btn-success float-right"><i class="fas fa-file-excel"></i>&ensp;Export Excel</button>
      </form>
      </div>
      </div>
      <div class="card-body">
      <table class="table table-striped table-bordered" id="example5">
      <thead>
      <tr>
      <th style="width: 10px">#</th>
      <th>Kode Barang</th>
      <th>Barang</th>
      <th>Merk</th>
      <th>Kategori</th>
      <th>Status</th>
      <th>kondisi</th>
      <th>Jumlah</th>
      <th>Thn pengadaan</th>
      <th>catatan</th>
      </tr>
      </thead>
      <tbody>';
      $i=0; foreach($allba as $lb) :  $i++;
      $out .= '<tr>';
      $out .= '<th scope="row">'. $i .'</th>';
      $out .= '<td>'. $lb['kd_barang'].'</td>';
      $out .= '<td>'. $lb['nm_barang'].'</td>';
      $out .= '<td>'. $lb['nm_merk']. '</td>';
      $out .= '<td>'. $lb['nm_kategori'].'</td>';
      $out .= '<td>'. $lb['nm_status'].'</td>';
      $out .= '<td>'. $lb['nm_kondisi'].'</td>';
      $out .= '<td>'. $lb['jumlah']. '</td>';
      $out .= '<td>'. $lb['thn_pengadaan'].'</td>';
      $out .= '<td>'. $lb['catatan'].'</td>';
      $out .= '</tr>';
    endforeach; 
    $out .='</tbody>
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
    </div>';
    break;

  };

  echo $out;
  ?>
</div>
</div>
<!-- Default box -->

</section>
            <!-- /.content -->