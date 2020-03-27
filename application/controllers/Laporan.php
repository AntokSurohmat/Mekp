<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Laporan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();


	}
	public function index(){

		$this->load->library('mypdf');


		//title

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
			$data['title'] = $name;

			$html = $this->template->load('layout/templatepdf','laporan/dompdf',$data, true);
			$filename = $name;
			$orientation = 'portait';
			$this->mypdf->generate($html,$filename, $orientation);

							//untuk mengatasi error confirm form resubmission
			header('Cache-Control: no-cache, must-revalidate, max-age=0');
			header('Cache-Control: post-check=0, pre-check=0',false);
			header('Pragma: no-cache');


		}
	}
	public function laporanAll(){

		$this->load->library('mypdf');
		$data['barang'] = "Data List Barang";

				//menampilkan nama barang 
		$this->load->model('Member_model','barang');
		$data['allba'] = $this->barang->getAllBarang();
		$this->form_validation->set_rules('aa', 'Pilih Tabel','required');



		if($this->form_validation->run() == false){
			
			$data['title'] = "Data Laporan";
			$this->template->load('layout/template','member/view_laporan',$data);
		}else{

			$tabel = $this->input->post('aa');


			$queryLaporan = "SELECT * FROM $tabel ";
			// $row = $query->result_array();
			$name ="List Data Barang";
			$data['alllaporan'] = $this->db->query($queryLaporan)->result_array();
			$data['title'] = $name;

			$html = $this->template->load('layout/templatepdf','laporan/dompdf',$data, true);
			$filename = $name;
			$orientation = 'landscape';
			$this->mypdf->generate($html,$filename, $orientation);

		}

						//untuk mengatasi error confirm form resubmission
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');

	}

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

			// if ($tabel == 'mekp_barang_masuk') {
			// 	$tgl = 'tgl_masuk';
			// 	$name = 'Data Barang Masuk';
			// }elseif ($tabel == 'mekp_barang_keluar') {
			// 	$tgl = 'tgl_keluar';
			// 	$name = 'Data Barang Keluar';
			// }elseif ($tabel == 'mekp_perawatan') {
			// 	$tgl = 'tgl_perawatan';
			// 	$name = 'Data Perawatan';
			// }elseif ($tabel == 'mekp_perbaikan') {
			// 	$tgl = 'tgl_perbaikan';
			// 	$name = 'Data Perbaiakan';
			// };

			$queryLaporan = "SELECT * FROM $tabel WHERE ('tgl_masuk' BETWEEN '$awal' AND '$akhir')";
			// $row = $query->result_array();

			$data['alllaporan'] = $this->db->query($queryLaporan)->result_array();
			
					// Load plugin PHPExcel nya
		    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		    
		    // Panggil class PHPExcel nya
		    $excel = new PHPExcel();
		    // Settingan awal fil excel
		    $excel->getProperties()->setCreator('My Notes Code')
		                 ->setLastModifiedBy('My Notes Code')
		                 ->setTitle("Data Siswa")
		                 ->setSubject("Siswa")
		                 ->setDescription("Laporan Semua Data Siswa")
		                 ->setKeywords("Data Siswa");
		    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		    $style_col = array(
		      'font' => array('bold' => true), // Set font nya jadi bold
		      'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		      )
		    );
		    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		    $style_row = array(
		      'alignment' => array(
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		      )
		    );
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($alllaporan as $data){ // Lakukan looping pada variabel siswa
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->kd_barang);

      
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      
      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Siswa.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');


		}

	}
}
