<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/fontawesome-free/css/all.min.css">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <!-- Theme style -->
<!--   <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/dist/css/adminlte.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
  .line-title{
    border: 0;
    border-style: inset;
    border-top: 1px solid #000;

  }
</style>
<body >
      <?php echo $contents; ?>
  <!-- jQuery -->
  <script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url();?>assets/AdminLTE-master/dist/js/adminlte.min.js"></script>

</body>
</html>
