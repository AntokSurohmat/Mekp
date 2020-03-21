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
