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
		$data['barang'] = "Data List Barang";
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
		$this->load->model('Member_model','barang');
		$data['allba'] = $this->barang->getAllBarang();
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
			// $html = $this->template->load('layout/template','member/view_laporan',$data);

			// $this->mypdf->generate('Laporan/dompdf');
			// $html = $this->load->view('layout/templatepdf', $data, true);
			// $html = $this->load->view('laporan/dompdf', $data, true);
			$html = $this->template->load('layout/templatepdf','laporan/dompdf',$data, true);
			$filename = $name;
			$this->mypdf->generate($html,$filename);

		}
	}
}
