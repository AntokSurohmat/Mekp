<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $title;?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/dist/css/adminlte.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/daterangepicker/daterangepicker.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" >
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-white navbar-light">
      <?php include "navbar.php" ;?>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <?php include "sidebar.php" ;?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $contents; ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
     <?php include "footer.php" ;?>
   </footer>
 </div>
 <!-- ./wrapper -->

 <!--Modal Penggunaan -->
 <div class="modal fade" id="modal-detail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if($this->session->userdata('role_id') == 1) :?>
          <dl class="row container-fluid">
            <dt class="col-sm-3">Dashbord</dt>
            <dd class="col-sm-8">Disinilah kita diarahkan setelah login jika <b><i>"roleId"</i></b> kita 1(Admin). Disini mempunyai jumlah <b>Access Menu, Forbidden Menu, Menu, SubMenu, User</b></dd>
            <hr class="col-sm-12">
            <dt class="col-sm-3">Access Menu</dt>
            <dd class="col-sm-8">Di Fitur ini Mengatur <i><b>Menu</b></i> yang boleh diakses.Contoh <b><i>"roleId"</i></b> Admin bisa Mengakses Semua <i><b>Menu</b></i> meliputi :  
              <ol>
                <li>Admin</li>
                <li>Settings</li>
                <li>Officer</li>
                <li>Dan Menu baru yang akan ditambahkan secara otomatis Admin Bisa MengAccess nya.</li>
              </ol>
              Sedangkan Untuk <b><i>"roleId"</i></b> Officer secara Default Hanya Bisa mengAccess <i><b>Menu</b></i>
              <ol>
                <li>Officer</li>
              </ol>
              Disini Kita bisa Memberikan Hak Access kepada officer jika dia membutuhkan tersebut <i><b>Menu</b></i> tersebut, 
              dan secara default <b><i>menu</i></b> <b>Admin</b> <i><b>hanya bisa di access oleh Admin saja.</b></i> 
            </dd>
            <hr class="col-sm-12">
            <dt class="col-sm-3">Forbidden Menu</dt>
            <dd class="col-sm-8">Di Fitur Ini Bisa memblock Suatu Url. Contoh Kasus jika ada Officer baru yang belum mempunyai akun,cara membuat akunnya mempunyai 2 cara:
              <ol>
                <li>Admin bisa mengkatifkan Fitur <b>Register</b> supaya officer baru bisa mendaftar dengan sendiri, yang semula fitur <b>Register</b> tidak aktif</li>
                <li>Admin bisa membuatkan langsung account untuk ofiicer tersebut di button Add User yang tertera di <b>User</b></li>
              </ol>
            </dd>
            <hr class="col-sm-12">
            <dt class="col-sm-3">Menu</dt>
            <dd class="col-sm-8">Fitur Ini untuk Membuat New <b><i>Menu</i></b> yang nantinya di gunakan di <b><i>Access Menu</i></b> untuk memanajemen Menu tersebut ditujukan untuk Admin atau juga bisa di access oleh officer juga</dd>
            <hr class="col-sm-12">
            <dt class="col-sm-3">SubMenu</dt>
            <dd class="col-sm-8">Di fitur ini digunakan untuk membuat New <b>SubMenu</b> yang didalamnya kita bisa mengedit:
              <ul>
                <li>Name SubMenu</li>
                <li>Icon SubMenu</li>
                <li>Url</li>
                <li>Dll</li>
              </ul>
            </dd>
            <hr class="col-sm-12">
            <dt class="col-sm-3">User</dt>
            <dd class="col-sm-8">Ketika suatu user baru register website kita disinilah kita bisa melihat semua data user yang telah register di website kita, didalamnya mempunyai fitur 
              <ul>
                <li>Add</li>
                <li>Detail</li>
                <li>Edit</li>
                <li>Delete</li>
              </ul>
            </dd>
            <hr class="col-sm-12">
            <dt class="col-sm-3">Home</dt>
            <dd class="col-sm-8">
              Ketika kita masuk dengan <i>Role</i> Officer disinilah kita diarahkan. Dihalaman mempunyai button yang mempermudah officer menuju halaman yang diinginkan.
            </dd>
            <hr class="col-sm-12">          
            <dt class="col-sm-3">Data Master</dt>
            <dd class="col-sm-8">Data Master atau bisa kita sebut dengan Data Barang karena disini menampilakan data - data yang nantinya digunakan untuk mengisi Data Barang. contoh <b> Tabel Data Kategori, Tabel Data Merk, Tabel Data kondisi,</b> dan <b>Tabel Data Status</b> dan disetiap data dilengkapi fitur <b><i>add, Detail, Edit, Delete</i></b> supaya Officer dimudahkan ketika memanagemen Data Barang.<br> Sedangkan Tabel Master Sendiri Mempunyai fitur <b><i>Add, Detail, Edit, Delete</i></b> dan juga mempunyai fitur <b><i>History</i></b> yang digunakan untuk melihat Data Masuk keluarnya dari suatu barang tersebut.</dd>
            <hr class="col-sm-12">
            <dt class="col-sm-3">Data Perawatan</dt>
            <dd class="col-sm-8">Difitur ini Mejelaskan Data dari suatu Perawatan yang di dalam Data Perawatan tersebut mempunyai <b>Data Perbaikan</b>. Sedangkan Ketika kita Melakukan Perbaikan kita membutuhkan Data Perawatan terlebih dahulu.</dd>
            <dd class="col-sm-8 offset-sm-3">
              <ul>
                <li>
                  Contoh Kasus Perawatan Ada suatu komputer yang membutuhkan perawatan <i>"install ulang"</i>, dari penjelasan tersebut apakah membutuhkan perbaikan ataupun apakah perlu barang yang diganti jawabanya <b>Tidak</b>.
                </li>
                <li>
                  Contoh Kasus Perbaikan yaitu suatu komputer membutuhkan perbaikan keyboard dikarenakan keyboardnya sudah rusak, dari penjelasan tersebut kita mesakukkan <b>Data Perawatan</b> dengan nama : <i>Perbaikan Keyboard</i> kita check apakah kita bisa kita perbaiki tanpa mengganti hardware tersebut,jika tidak bisa kita bisa menambahkan <b>Data Perbaikan</b> di fitur <b>Edit Data Perawatan</b>, bisa dibilang <b>Data perbaikan</b> adalah data - data yang memerlukan hardware untuk diperbaiki ataupun di ganti.
                </li>
              </ul>
            </dd>
            <hr class="col-sm-12">
            <dt class="col-sm-3">Data Laporan</dt>
            <dd class="col-sm-8">Disini Menampilankan 5 Tabel Meliputi : 
              <ul>
                <li><b>Tabel Barang</b> yang ditampilakan secara default ketika kita memasuki Data Laporan</li>
                <li><b>Tabel Barang Masuk, Tabel Barang Keluar, Tabel Perawatan,</b> dan <b>Tabel Perbaikan</b> yang bisa kita pilih berdasarkan tanggal awal sampai tanggal akhir yang akan kita tampilkan</li>.
              </ul>
              Disetiap Tabel Juga Mempunyai Fitir Export Pdf dan Export Excel supaya Memudahkan Officer untuk membackup data terserbut yang natinya bisa kita gunakan untuk validasi dikemudian hari.
            </dd>
          </dl>
          <?php elseif($this->session->userdata('role_id') == 2) : ?>
            <dl class="row container-fluid">
              <dt class="col-sm-3">Home</dt>
              <dd class="col-sm-8">
                Ketika kita masuk dengan <i>Role</i> Officer disinilah kita diarahkan. Dihalaman mempunyai button yang mempermudah officer menuju halaman yang diinginkan.
              </dd>
              <hr class="col-sm-12">
              <dt class="col-sm-3">Data Master</dt>
              <dd class="col-sm-8">Data Master atau bisa kita sebut dengan Data Barang karena disini menampilakan data - data yang nantinya digunakan untuk mengisi Data Barang. contoh <b> Tabel Data Kategori, Tabel Data Merk, Tabel Data kondisi,</b> dan <b>Tabel Data Status</b> dan disetiap data dilengkapi fitur <b><i>add, Detail, Edit, Delete</i></b> supaya Officer dimudahkan ketika memanagemen Data Barang.<br> Sedangkan Tabel Master Sendiri Mempunyai fitur <b><i>Add, Detail, Edit, Delete</i></b> dan juga mempunyai fitur <b><i>History</i></b> yang digunakan untuk melihat Data Masuk keluarnya dari suatu barang tersebut.</dd>
              <hr class="col-sm-12">
              <dt class="col-sm-3">Data Perawatan</dt>
              <dd class="col-sm-8">Difitur ini Mejelaskan Data dari suatu Perawatan yang di dalam Data Perawatan tersebut mempunyai <b>Data Perbaikan</b>. Sedangkan Ketika kita Melakukan Perbaikan kita membutuhkan Data Perawatan terlebih dahulu.</dd>
              <dd class="col-sm-8 offset-sm-3">
                <ul>
                  <li>
                    Contoh Kasus Perawatan Ada suatu komputer yang membutuhkan perawatan <i>"install ulang"</i>, dari penjelasan tersebut apakah membutuhkan perbaikan ataupun apakah perlu barang yang diganti jawabanya <b>Tidak</b>.
                  </li>
                  <li>
                    Contoh Kasus Perbaikan yaitu suatu komputer membutuhkan perbaikan keyboard dikarenakan keyboardnya sudah rusak, dari penjelasan tersebut kita mesakukkan <b>Data Perawatan</b> dengan nama : <i>Perbaikan Keyboard</i> kita check apakah kita bisa kita perbaiki tanpa mengganti hardware tersebut,jika tidak bisa kita bisa menambahkan <b>Data Perbaikan</b> di fitur <b>Edit Data Perawatan</b>, bisa dibilang <b>Data perbaikan</b> adalah data - data yang memerlukan hardware untuk diperbaiki ataupun di ganti.
                  </li>
                </ul>
              </dd>
              <hr class="col-sm-12">
              <dt class="col-sm-3">Data Laporan</dt>
              <dd class="col-sm-8">Disini Menampilankan 5 Tabel Meliputi : 
                <ul>
                  <li><b>Tabel Barang</b> yang ditampilakan secara default ketika kita memasuki Data Laporan</li>
                  <li><b>Tabel Barang Masuk, Tabel Barang Keluar, Tabel Perawatan,</b> dan <b>Tabel Perbaikan</b> yang bisa kita pilih berdasarkan tanggal awal sampai tanggal akhir yang akan kita tampilkan</li>.
                </ul>
                Disetiap Tabel Juga Mempunyai Fitir Export Pdf dan Export Excel supaya Memudahkan Officer untuk membackup data terserbut yang natinya bisa kita gunakan untuk validasi dikemudian hari.
              </dd>
            </dl>
          <?php endif;?>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!--Modal Penggunaan -->
  <div class="modal fade" id="modal-about">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title">About</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <dl>
            <dd>
             <ol>
              <li>
               Aplikasi Sitem Inventory digunakan untuk mempermudah Admin maupun officer untuk mendata barang - barang yang ada di laboratorium yang didalamnya mempunyai fitur :
               <ul>
                <li>managemen Access Menu</li>
                <li>managemen Forbidden Menu</li>
                <li>Managemen Menu</li>
                <li>Managemen SubMenu</li>
                <li>Managemen User</li>
              </ul>
              Fitur Diatas Dikhususkan Untuk Admin.
              <hr class="col-sm-10">
              <ul>
                <li>Managemen Data Master/ Barang</li>
                <li>Managemen Data Barang Masuk</li>
                <li>Managemen Data Barang Keluar</li>
                <li>Managemen Data Perawatan</li>
                <li>managemen Data Perbaikan</li>
              </ul>
              Sedangkan fitur tersebut bisa dikelola oleh Officer Maupun Admin.
            </li>
            <hr class="col-sm-12">
            <li>
              Aplikasi Ini juga digunakan Untuk Kerja Praktek, di buat oleh <b>Rahmat Rudianto</b> dengan NIM <b>0755201130109</b> yang berlokasi KP di : 
              <b>Fakultas Teknik dan ilmu Komputer UNSIQ di Wonosobo</b>, yang diuntukkan bisa membantu pekerjaan admin maupun officer untuk mengelola barang - barang di laboratorium.
            </li>
          </ol>
        </dd>

      </dl>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Logout Modal-->
<div class="modal fade" id="logOutModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Ready to Leave?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Select "Logout" below if you are ready to end your current session.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url('auth/logout')?>"><i class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/dist/js/demo.js"></script>


<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/chart.js/Chart.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/moment/moment.min.js"></script>
<!-- PAGE SCRIPTS -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/dist/js/pages/dashboard.js"></script>

<!-- Bootstrap Switch -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<!-- Table script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example2").DataTable();
    $("#example3").DataTable();
    $("#example4").DataTable();
    $("#example5").DataTable();

      //Initialize Select2 Elements
      $('.select2').select2()
    });

      //Date picker
 //Date range picker
 $('#reservation').daterangepicker({
  singleDatePicker : true,
  showDropdowns : true,
  locale: {
    format: 'YYYY/MM/DD'
  }
});
 $('#akhir').daterangepicker({
  singleDatePicker : true,
  showDropdowns : true,
  locale: {
    format: 'YYYY/MM/DD'
  }
});
    //Date range picker with time picker
    // $('#reservationtime').daterangepicker({
    //   timePicker: true,
    //   timePickerIncrement: 30,
    //   locale: {
    //     format: 'MM/DD/YYYY hh:mm A'
    //   }
    // });

  // $("input[data-bootstrap-switch]").each(function(){
  //   $(this).bootstrapSwitch('state', $(this).prop('checked'));
  // });
</script>
<script>
  $('.custom-file-input').on('change', function(){
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);

  });

  $('.form-check-input').on('click', function(){
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');


    $.ajax({
      url : "<?php echo base_url('admin/changeaccess') ; ?>",
      type : 'post',
      data : {
        //menuId/roleId pertama objeck data, menuId/roleId kedua variabel
        menuId : menuId,
        roleId : roleId
      },
      success : function(){
        document.location.href = "<?php echo base_url('admin/roleaccess/') ; ?>" + roleId;
      }
    });

  });

</script>
</body>
</html>
