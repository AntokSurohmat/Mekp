<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

	}
	public function index(){

		// $this->load->library('mypdf');
		// $this->mypdf->generate('laporan/dompdf');

		$tabel = $this->input->post('aa');
		$awal = $this->input->post('bb');
		$akhir = $this->input->post('cc');

		if ($tabel == 'mekp_barang_masuk') {
			$tgl = 'tgl_masuk';
		}elseif ($tabel == 'mekp_barang_keluar') {
			$tgl = 'tgl_keluar';
		}elseif ($tabel == 'mekp_perawatan') {
			$tgl = 'tgl_perawatan';
		}elseif ($tabel == 'mekp_perbaikan') {
			$tgl = 'tgl_perbaikan';
		};

		$queryLaporan = "SELECT * FROM $tabel WHERE ($tgl BETWEEN '$awal' AND '$akhir')";
			// $row = $query->result_array();

		$data['allpdf'] = $this->db->query($queryLaporan)->result_array();
		$data['title'] = "Print";
		$this->template->load('layout/template','member/view_laporan',$data);
			// redirect('member/laporan');




	}

	
}
