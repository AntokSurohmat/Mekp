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

            switch ($tabel) {

              case 'mekp_barang_masuk':
              echo '<div class="card">';
              echo '<div class="card-header">';
              echo '<h4 class="card-title " text-align="center"><strong>Tabel Barang Masuk</strong></h4>';
              echo '</div>';
              echo '<div class="card-body">';
              echo '<div>';
              echo '<table id="example1" class="table table-bordered table-striped">';
              echo '<thead>';
              echo '<tr>';
              echo '<th scope="col">#</th>';
              echo '<th scope="col">Kode Barang</th>';
              echo '<th scope="col">Nama Barang</th>';
              echo '<th scope="col">Jumlah</th>';
              echo '<th scope="col">Tanggal Masuk</th>';
              echo '<th scope="col">Asal</th>';
              echo '<th scope="col">Catatan</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody';
              $i=0; foreach ($alllaporan as $lab) : $i++;
              echo '<tr>';
              echo '<th scope="row">' .$i.'</th>';
              echo '<td>' .$lab['kd_barang']. '</td>';
              foreach ($allbarang as $allbar) :
                if ($allbar['kd_barang'] == $lab['kd_barang']) : 
                  echo '<td>'.$allbar['nm_barang'].'</td>';
                endif;
              endforeach;
              echo '<td>' .$lab['jumlah']. '</td>';
              echo '<td>' . date('d F Y', strtotime($lab['tgl_masuk'])). '</td>';
              echo '<td>' .$lab['dari_ke']. '</td>';
              echo '<td>' .$lab['catatan']. '</td>';
              echo '</tr>';endforeach;
              echo '</tbody>';
              echo '</table';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              break;

              case 'mekp_barang_keluar':
              echo '<div class="card">';
              echo '<div class="card-header">';
              echo '<h4 class="card-title " text-align="center"><strong>Tabel Barang Keluar</strong></h4>';
              echo '</div>';
              echo '<div class="card-body">';
              echo '<div>';
              echo '<table id="example1" class="table table-bordered table-striped">';
              echo '<thead>';
              echo '<tr>';
              echo '<th scope="col">#</th>';
              echo '<th scope="col">Kode Barang</th>';
              echo '<th scope="col">Nama Barang</th>';
              echo '<th scope="col">Jumlah</th>';
              echo '<th scope="col">Tanggal Keluar</th>';
              echo '<th scope="col">Untuk</th>';
              echo '<th scope="col">Kebutuhan</th>';
              echo '<th scope="col">Catatan</th>';
              echo '<th scope="col">ID Perbaikan</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody';
              $i=0; foreach ($alllaporan as $lab) : $i++;
              echo '<tr>';
              echo '<th scope="row">' .$i.'</th>';
              echo '<td>' .$lab['kd_barang']. '</td>';
              foreach ($allbarang as $allbar) :
                if ($allbar['kd_barang'] == $lab['kd_barang']) : 
                  echo '<td>'.$allbar['nm_barang'].'</td>';
                endif;
              endforeach;
              echo '<td>' .$lab['jumlah']. '</td>';
              echo '<td>' . date('d F Y', strtotime($lab['tgl_keluar'])). '</td>';
              foreach ($lokasidata as $lodat) :
                if ($lodat['id_lokasi'] == $lab['dari_ke']) : 
                  echo '<td>'.$lodat['nm_lokasi'].'</td>';
                endif;
              endforeach;
              echo '<td>' .$lab['kebutuhan']. '</td>';
              echo '<td>' .$lab['catatan']. '</td>';
              foreach ($allperbaikan as $allperba) :
                if ($allperba['id_perbaikan'] == $lab['id_perbaikan'] ) : 
                  echo '<td>'.$allperba['id_perbaikan'].'</td>';
                endif;
              endforeach;
              echo '</tr>';endforeach;
              echo '</tbody>';
              echo '</table';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              break;

              case 'mekp_perawatan':
              echo '<div class="card">';
              echo '<div class="card-header">';
              echo '<h4 class="card-title " text-align="center"><strong>Tabel Perawatan</strong></h4>';
              echo '</div>';
              echo '<div class="card-body">';
              echo '<div>';
              echo '<table id="example1" class="table table-bordered table-striped">';
              echo '<thead>';
              echo '<tr>';
              echo '<th scope="col">#</th>';
              echo '<th scope="col">Nama Perawatan</th>';
              echo '<th scope="col">Tanggal Perawatan</th>';
              echo '<th scope="col">Lokasi</th>';
              echo '<th scope="col">Lokasi Rinci</th>';
              echo '<th scope="col">Keterangan</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody';
              $i=0; foreach ($alllaporan as $lab) : $i++;
              echo '<tr>';
              echo '<th scope="row">' .$i.'</th>';
              echo '<td>'.$lab['nm_perawatan'].'</td>';
              echo '<td>'. date('d F Y', strtotime($lab['tgl_perawatan'])).'</td>';
              foreach ($lokasidata as $lodat) :
                if ($lodat['id_lokasi'] == $lab['lokasi']) : 
                  echo '<td>'.$lodat['nm_lokasi'].'</td>';
                endif;
              endforeach;
              echo '<td>'.$lab['lokasi_rinci'].'</td>';
              echo '<td>'.$lab['keterangan'].'</td>';
              echo '</tr>';endforeach;
              echo '</tbody>';
              echo '</table';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              //echo var_dump($lokasidata);
              break;

              case 'mekp_perbaikan':
              echo '<div class="card">';
              echo '<div class="card-header">';
              echo '<h4 class="card-title " text-align="center"><strong>Tabel Perbaikan</strong></h4>';
              echo '</div>';
              echo '<div class="card-body">';
              echo '<div>';
              echo '<table id="example1" class="table table-bordered table-striped">';
              echo '<thead>';
              echo '<tr>';
              echo '<th scope="col">#</th>';
              echo '<th scope="col">Nama Perawatan</th>';
              echo '<th scope="col">Tanggal Perbaikan</th>';
              echo '<th scope="col">Lokasi</th>';
              echo '<th scope="col">kebutuhan</th>';
              echo '<th scope="col">kode Barang</th>';
              echo '<th scope="col">Jumlah</th>';
              echo '<th scope="col">Hasil</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody';
              $i=0; foreach ($alllaporan as $lab) : $i++;
              echo '<tr>';
              echo '<th scope="row">' .$i.'</th>';
              foreach ($allperawatan as $allper) :
                if ($allper['id_perawatan'] == $lab['id_perawatan']) : 
                  echo '<td>'.$allper['nm_perawatan'].'</td>';
                endif;
              endforeach;
              echo '<td>'. date('d F Y', strtotime($lab['tgl_perbaikan'])).'</td>';
              foreach ($lokasidata as $lodat) :
                if ($lodat['id_lokasi'] == $lab['lokasi']) : 
                  echo '<td>'.$lodat['nm_lokasi'].'</td>';
                endif;
              endforeach;
              echo '<td>'.$lab['kebutuhan'].'</td>';
              echo '<td>'.$lab['kd_barang'].'</td>';
              echo '<td>'.$lab['jumlah'].'</td>';
              echo '<td>'.$lab['hasil'].'</td>';
              echo '</tr>';endforeach;
              echo '</tbody>';
              echo '</table';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              break;

              default:
              echo '<div class="row">';
              echo '<div class="col-12">';
              echo '<div class="callout callout-danger">';
              echo '<h5><i class="fas fa-info"></i> Note:</h5>';
              echo 'Silahkan Melengkapi Form Untuk Menampilkan Data';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              break;
            };
            ?>
          </div>
        </div>
        <!-- Default box -->

      </section>
      <!-- /.content -->



      public function excel(){

    $data['barangmasuk'] = "Data Barang Masuk";
    $data['barangkeluar'] = "Data Barang Keluar";
    $data['perawatan'] = "Data Perawatan";
    $data['perbaikan'] = "Data Perbaikan";
    //menampilkan lokasi
    $data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();
    //menampilkan nama perawatan
    $data['allperawatan'] = $this->db->get('mekp_perawatan')->result_array();
    //menampilkan nama barang 
    $data['allbarang'] = $this->db->get('mekp_barang')->result_array();
    // $this->load->model('Member_model','barang');
    // $data['allba'] = $this->barang->getAllBarang();
    //menampilkan nama barang 
    $data['allperbaikan'] = $this->db->get('mekp_perbaikan')->result_array();

    require(APPPATH. 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
    require(APPPATH. 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    $this->form_validation->set_rules('aa', 'Pilih Tabel','required');
    $this->form_validation->set_rules('bb', 'Awal Periode','required');
    $this->form_validation->set_rules('cc', 'Akhir Periode','required');


    if($this->form_validation->run() == false){

      $data['title'] = "Data Laporan";
      $this->template->load('layout/template','member/view_laporan',$data);
    }else{


      $tabel = $this->input->post('aa');
      $awal = $this->input->post('bb');
      $akhir = $this->input->post('cc');

      if ($tabel == 'mekp_barang_masuk') {
        $tgl = 'tgl_masuk';
        $name = 'Data Barang Masuk';
      }elseif ($tabel == 'mekp_barang_keluar') {
        $tgl = 'tgl_keluar';
        $name = 'Data Barang Keluar';
      }elseif ($tabel == 'mekp_perawatan') {
        $tgl = 'tgl_perawatan';
        $name = 'Data Perawatan';
      }elseif ($tabel == 'mekp_perbaikan') {
        $tgl = 'tgl_perbaikan';
        $name = 'Data Perbaiakan';
      };

      $queryLaporan = "SELECT * FROM $tabel WHERE ($tgl BETWEEN '$awal' AND '$akhir')";
      // $row = $query->result_array();

      $data['alllaporan'] = $this->db->query($queryLaporan)->result_array();

      $object = new PHPExcel();

      $object->getProperties()->setCreator("Sistem Inventory");
      $object->getProperties()->setLastModifiedBy("Framewok indonesia");
      $object->getProperties()->setTitle($name);


      if ($tabel == 'mekp_barang_masuk') {
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->setCellValue('A1','No');
        $object->getActiveSheet()->setCellValue('B1','Kode Barang');
        $object->getActiveSheet()->setCellValue('C1','Nama Barang');
        $object->getActiveSheet()->setCellValue('D1','Jumlah');
        $object->getActiveSheet()->setCellValue('E1','Tgl Masuk');
        $object->getActiveSheet()->setCellValue('F1','Asal');
        $object->getActiveSheet()->setCellValue('G1','Catatan');


        $baris = 2;
        $no = 1;
        foreach ($data['alllaporan'] as $all) {
          $object->getActiveSheet()->setCellValue('A',$baris,$all->$no++);
          $object->getActiveSheet()->setCellValue('B',$baris,$all->kd_barang);
          $object->getActiveSheet()->setCellValue('C',$baris,$all->nm_barang);
          $object->getActiveSheet()->setCellValue('D',$baris,$all->jumlah);
          $object->getActiveSheet()->setCellValue('E',$baris,$all->tgl_masuk);
          $object->getActiveSheet()->setCellValue('F',$baris,$all->asal);
          $object->getActiveSheet()->setCellValue('G',$baris,$all->catatan);
          $baris ++;

        }


      }elseif ($tabel == 'mekp_barang_keluar') {
        $tgl = 'tgl_keluar';
        $name = 'Data Barang Keluar';
      }elseif ($tabel == 'mekp_perawatan') {
        $tgl = 'tgl_perawatan';
        $name = 'Data Perawatan';
      }elseif ($tabel == 'mekp_perbaikan') {
        $tgl = 'tgl_perbaikan';
        $name = 'Data Perbaiakan';
      };

      $filename="Data Barang Masuk".'xlsx';
      $object->getActiveSheet()->setTitle("Data barangmasuk");

      header('Content-Type : application/vnd.openxmlformat-officedocument.spreadsheetml.sheet');
      header('Content-Disposition : attachment;filename="'.$filename.'"');
      header('Cache-Control : max-age=0');

      $Writer=PHPExcel_IOFactory::Createwriter($object, 'Excel2007');
      $Writer->save('php://outpust');

      exit;

    }

  }