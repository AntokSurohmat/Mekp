<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Laporan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		//untuk mengatasi error confirm form resubmission
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');

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

	}

	public function excel(){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
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

			// $data['alllaporan'] = $this->db->query($queryLaporan)->result_array();
			
			// Load plugin PHPExcel nya
			require APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
			require APPPATH.'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

		    // Panggil class PHPExcel nya
			$excel = new PHPExcel();
		    // Settingan awal fil excel
			$excel->getProperties()->setCreator(''.$this->session->userdata('email').'')
			->setLastModifiedBy(''.$this->session->userdata('email').'-'.date('d F Y', time()).'')
			->setTitle(''.$name.'')
			->setSubject('Laporan '.$name.'')
			->setDescription('Laporan Semua '.$name.'')
			->setKeywords(''.$name.'');

		    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
			$style_col = array(
				// Set font nya jadi bold
				'font' => array('bold' => true), 
				'alignment' => array(
		      		// Set text jadi ditengah secara horizontal (center)
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        	// Set text jadi di tengah secara vertical (middle)
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
				),
				'borders' => array(
					// Set border top dengan garis tipis
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		        	// Set border right dengan garis tipis
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  
		       		// Set border bottom dengan garis tipis
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		        	// Set border left dengan garis tipis
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
				)
			);

		    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
			$style_row = array(
				'alignment' => array(
					// Set text jadi di tengah secara vertical (middle)
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
				),
				'borders' => array(
					// Set border top dengan garis tipis
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		        	// Set border right dengan garis tipis
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		        	// Set border bottom dengan garis tipis
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		        	// Set border left dengan garis tipis
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
				)
			);

			// Set kolom A1 dengan tulisan "DATA SISWA"
			$excel->setActiveSheetIndex(0)->setCellValue('A1', $name);
			// Set Merge Cell pada kolom A1 sampai H1
			$excel->getActiveSheet()->mergeCells('A1:H1');
    		// Set bold kolom A1
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
    		// Set font size 15 untuk kolom A1
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); 
    		// Set text center untuk kolom A1
			$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			//Set Dari Tanggal
			$excel->getActiveSheet()->setCellValue('A2', "Dari Tanggal :");
			// Set Merge Cell pada kolom A1 sampai C1
			$excel->getActiveSheet()->mergeCells('A2:B2');			 
			//Set $awal
			$excel->getActiveSheet()->setCellValue('C2', date('d F Y', strtotime($this->input->post('bb'))));
			// Set Merge Cell pada kolom C2 sampai D2
			$excel->getActiveSheet()->mergeCells('C2:D2');
			// Set bold kolom A1
			$excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(TRUE);

			//Set Sampai Tanggal
			$excel->getActiveSheet()->setCellValue('E2', "Sampai Tanggal :");
			// Set Merge Cell pada kolom A1 sampai C1
			$excel->getActiveSheet()->mergeCells('E2:F2');			 
			//Set $awal
			$excel->getActiveSheet()->setCellValue('G2', date('d F Y', strtotime($this->input->post('cc'))));
			// Set Merge Cell pada kolom G2 sampai H2
			$excel->getActiveSheet()->mergeCells('G2:H2');
			// Set bold kolom A1
			$excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(TRUE);

    		// Buat header tabel nya pada baris ke 4
			if ($tabel == 'mekp_barang_masuk') {
				// Set kolom A4 dengan tulisan "NO"
				$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); 
    			// Set kolom B4 dengan tulisan "KODE BARANG"
				$excel->setActiveSheetIndex(0)->setCellValue('B4', "KODE BARANG"); 
    			// Set kolom C4 dengan tulisan "NAMA BARANG"
				$excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA BARANG"); 
    			// Set kolom D4 dengan tulisan "JUMLAH"
				$excel->setActiveSheetIndex(0)->setCellValue('D4', "JUMLAH"); 
    			// Set kolom E4 dengan tulisan "TANGGAL MASUK"
				$excel->setActiveSheetIndex(0)->setCellValue('E4', "TANGGAL MASUK");
    			// Set kolom F4 dengan tulisan "ASAL"
				$excel->setActiveSheetIndex(0)->setCellValue('F4', "ASAL");
    			// Set kolom G4 dengan tulisan "CATATAN"
				$excel->setActiveSheetIndex(0)->setCellValue('G4', "CATATAN");

    			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
				$excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);

    			// Panggil function alllaporan untuk menampilkan semua data
				$data['alllaporan'] = $this->db->query($queryLaporan)->result_array();

				$no = 1; // Untuk penomoran tabel, di awal set dengan 1
    			$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 5

    			foreach ($data['alllaporan'] as $data) {
    				$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
    				$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['kd_barang']);
    				$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['kd_barang']);
    				$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['jumlah']);
    				$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, date('d F Y', strtotime($data['tgl_masuk'])));
    				$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['dari_ke']);
    				$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['catatan']);


				    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    				$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
    				$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
    				$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
    				$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
    				$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
    				$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
    				$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);

				    $no++; // Tambah 1 setiap kali looping
				    $numrow++; // Tambah 1 setiap kali looping

				}

    			// Set width kolom
				$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
				$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
				$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
				$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
				$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); 

			}elseif ($tabel == 'mekp_barang_keluar') {
				// Set kolom A4 dengan tulisan "NO"
				$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); 
    			// Set kolom B4 dengan tulisan "KODE BARANG"
				$excel->setActiveSheetIndex(0)->setCellValue('B4', "KODE BARANG"); 
    			// Set kolom C4 dengan tulisan "NAMA BARANG"
				$excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA BARANG"); 
    			// Set kolom D4 dengan tulisan "JUMLAH"
				$excel->setActiveSheetIndex(0)->setCellValue('D4', "JUMLAH"); 
    			// Set kolom E4 dengan tulisan "TANGGAL KELUAR"
				$excel->setActiveSheetIndex(0)->setCellValue('E4', "TANGGAL KELUAR");
    			// Set kolom F4 dengan tulisan "UNTUK"
				$excel->setActiveSheetIndex(0)->setCellValue('F4', "UNTUK");
    			// Set kolom G4 dengan tulisan "KEBUTUHAN"
				$excel->setActiveSheetIndex(0)->setCellValue('G4', "KEBUTUHAN");
    			// Set kolom H4 dengan tulisan "CATATAN"
				$excel->setActiveSheetIndex(0)->setCellValue('H4', "CATATAN");
    			// Set kolom I4 dengan tulisan "ID PERBAIKAN"
				$excel->setActiveSheetIndex(0)->setCellValue('I4', "ID PERBAIKAN");

    			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
				$excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('I4')->applyFromArray($style_col);

    			// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    			// Untuk penomoran tabel, di awal set dengan 1
				$no = 1;
    			// Set baris pertama untuk isi tabel adalah baris ke 4
				$numrow = 4; 
				// Lakukan looping pada variabel siswa

    			// Set width kolom
				$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
				$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
				$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
				$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
				$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); 
			}elseif ($tabel == 'mekp_perawatan') {
				// Set kolom A4 dengan tulisan "NO"
				$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); 
    			// Set kolom B4 dengan tulisan "NAMA PERAWATAN"
				$excel->setActiveSheetIndex(0)->setCellValue('B4', "NAMA PERAWATAN"); 
    			// Set kolom C4 dengan tulisan "TANGGAL PERAWATAN"
				$excel->setActiveSheetIndex(0)->setCellValue('C4', "TANGGAL PERAWATAN"); 
    			// Set kolom D4 dengan tulisan "LOKASI"
				$excel->setActiveSheetIndex(0)->setCellValue('D4', "LOKASI"); 
    			// Set kolom E4 dengan tulisan "LOKASI RINCI"
				$excel->setActiveSheetIndex(0)->setCellValue('E4', "LOKASI RINCI");
    			// Set kolom F4 dengan tulisan "KETERANGAN"
				$excel->setActiveSheetIndex(0)->setCellValue('F4', "KETERANGAN");

    			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
				$excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);

    			// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    			// Untuk penomoran tabel, di awal set dengan 1
				$no = 1;
    			// Set baris pertama untuk isi tabel adalah baris ke 4
				$numrow = 4; 
				// Lakukan looping pada variabel siswa

    			// Set width kolom
				$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
				$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
				$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
				$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
				$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

			}elseif ($tabel == 'mekp_perbaikan') {
				// Set kolom A3 dengan tulisan "NO"
				$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); 
    			// Set kolom B4 dengan tulisan "NAMA PERAWATAN"
				$excel->setActiveSheetIndex(0)->setCellValue('B4', "NAMA PERAWATAN"); 
    			// Set kolom C4 dengan tulisan "TANGGAL PERBAIKAN"
				$excel->setActiveSheetIndex(0)->setCellValue('C4', "TANGGAL PERBAIKAN"); 
    			// Set kolom D4 dengan tulisan "LOKASI"
				$excel->setActiveSheetIndex(0)->setCellValue('D4', "LOKASI"); 
    			// Set kolom E4 dengan tulisan "KEBUTUHAN"
				$excel->setActiveSheetIndex(0)->setCellValue('E4', "KEBUTUHAN");
    			// Set kolom F4 dengan tulisan "KODE BARANG"
				$excel->setActiveSheetIndex(0)->setCellValue('F4', "KODE BARANG");
    			// Set kolom G4 dengan tulisan "JUMLAH"
				$excel->setActiveSheetIndex(0)->setCellValue('G4', "JUMLAH");
    			// Set kolom H4 dengan tulisan "HASIL"
				$excel->setActiveSheetIndex(0)->setCellValue('H4', "HASIL");

    			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
				$excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);
				$excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_col);

    			// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    			// Untuk penomoran tabel, di awal set dengan 1
				$no = 1;
    			// Set baris pertama untuk isi tabel adalah baris ke 4
				$numrow = 4; 
				// Lakukan looping pada variabel siswa

    			// Set width kolom
				$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
				$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
				$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
				$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
				$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
				$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);


			};


			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			$filename=$name.'.xlsx';
			header('Content-Disposition: attachment; filename="'.$filename.'" '); 
    		// Set nama file excel nya
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');


		}

	}
}
