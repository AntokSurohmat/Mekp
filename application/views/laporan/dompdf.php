<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title><?php echo $title;?></title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/dist/css/adminlte.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

</head><body>
	<?php echo $this->input->post('aa');?>
	<?php echo $this->input->post('bb');?>
	<?php echo $this->input->post('cc');?>
	<?php 

	$tabel = $this->input->post('aa');
	$awal = $this->input->post('bb');
	$akhir = $this->input->post('cc');
	switch ($tabel) {
		case 'mekp_barang_masuk':
		$out = '<div class="card">
		<div class="card-header border-0 bg-gray">
		<h3 class="card-title ">';
		$out .= $barangmasuk;
		$out .= '</h3>
		</div>
		<div class="card-body">
		<div>
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
		<th scope="row">#</th>
		<th scope="col">Kode </th>
		<th scope="col">Nama </th>
		<th scope="col">Jumlah</th>
		<th scope="col">Tanggal </th>
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
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/dist/js/adminlte.js"></script>





<!-- DataTables -->
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-master/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>


</body></html>