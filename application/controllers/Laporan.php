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

		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

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



			$queryLaporan = "SELECT * FROM $tabel WHERE ('tgl_masuk' BETWEEN '$awal' AND '$akhir')";
			// $row = $query->result_array();

			$data['alllaporan'] = $this->db->query($queryLaporan)->result_array();

			print_r($alllaporan);

			$object = new PHPExcel();

			$object->getProperties()->setCreator("Sistem Inventory");
			$object->getProperties()->setLastModifiedBy("Framewok indonesia");
			$object->getProperties()->setTitle("Framewok indonesia");



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
				$object->getActiveSheet()->setCellValue('A'.$baris,$all->$no++);
				$object->getActiveSheet()->setCellValue('B'.$baris,$all->kd_barang);
				$object->getActiveSheet()->setCellValue('C'.$baris,$all->nm_barang);
				$object->getActiveSheet()->setCellValue('D'.$baris,$all->jumlah);
				$object->getActiveSheet()->setCellValue('E'.$baris,$all->tgl_masuk);
				$object->getActiveSheet()->setCellValue('F'.$baris,$all->asal);
				$object->getActiveSheet()->setCellValue('G'.$baris,$all->catatan);
				$baris ++;

			}

			$filename="Data Barang Masuk".'xlsx';
			$object->getActiveSheet()->setTitle("Data barangmasuk");

			header('Content-Type : application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition : attachment;filename="'.$filename.'"');
			header('Cache-Control : max-age=0');

			$Writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
			$Writer->save('php://output');

			exit;

		}

	}
}
