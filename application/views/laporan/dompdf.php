<img src="assets/img/fastikom.jpg" style="position: absolute; width: 60px; height: 60px;">
<table style="width: 100%">
	<tr>
		<td align="center">
			<span style="line-height: 1.6; font-weight: bold;">
				FAKULTAS TEKNIK DAN ILMU KOMPUTER
				<br>FASTIKOM 
			</span>
		</td>
	</tr>
</table>
<hr class="line-title">

<table>
	<tr>
		<td style="font-weight: bold;">Nama Data</td>
		<td></td>
		<td>:</td>
		<td ><?php echo $title;?></td>
	</tr>
	<tr>
		<td style="font-weight: bold;">Dari Tanggal</td>
		<td></td>
		<td>:</td>
		<td><?php echo date('d F Y', strtotime($this->input->post('bb')))  ;?></td>
		<td style="font-weight: bold;">Sampai Tanggal</td>
		<td></td>
		<td>:</td>
		<td><?php echo date('d F Y', strtotime($this->input->post('cc')))  ;?></td>
	</tr>
</table>
<br>
<br>
<?php 

$tabel = $this->input->post('aa');
$awal = $this->input->post('bb');
$akhir = $this->input->post('cc');
switch ($tabel) {
	case 'mekp_barang_masuk':
	$out = '
	<table class="table table-sm">
	<thead>
	<tr>
	<th scope="col">#</th>
	<th scope="col">Kode </th>
	<th scope="col">Nama </th>
	<th scope="col">Jumlah</th>
	<th scope="col">Tgl Masuk </th>
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
	$out .='</tr>';endforeach;

	$out .= '
	</tbody>
	</table>';
	break;


	case 'mekp_barang_keluar':

	$out = '
	<table id="example1" class="table  table-sm">
	<thead>
	<tr>
	<th scope="col">#</th>
	<th scope="col">Kode</th>
	<th scope="col">Nama</th>
	<th scope="col">Jumlah</th>
	<th scope="col">Tgl Keluar</th>
	<th scope="col">Untuk</th>
	<th scope="col">Kebutuhan</th>
	<th scope="col">Catatan</th>
	<th scope="col">ID Perba</th>
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
	$out.='</tr>';endforeach;
	$out .= '
	</tbody>
	</table>';

	break;
	case 'mekp_perawatan':

	$out = '            
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
	$out.='</tr>';endforeach;
	$out .= '</tbody>
	</table>';

	break;


	case 'mekp_perbaikan':

	$out = '            
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
	$out.='</tr>';endforeach;
	$out .= '</tbody>
	</table>';

	break;

	case 'mekp_barang':

	$out = '            
	<table id="example1" class="table table-bordered table-striped">
	<thead>
	<tr >
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
	$out .= '</tr>';endforeach; 
	$out .= '</tbody>
	</table>';

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
	<!--/. Row -->';
	break;

};

echo $out;
?>
