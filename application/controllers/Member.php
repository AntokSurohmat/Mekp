<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

		//untuk mengatasi error confirm form resubmission
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
	}

	public function index(){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Home";
		$this->template->load('layout/template','member/view_home',$data);
	}

	public function profile(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Profile";
		$this->template->load('layout/template','layout/profile',$data);
	}

	public function editProfile(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		
		$this->form_validation->set_rules('a','Fullname','required|trim');
		$this->form_validation->set_rules('c','Email','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Profile";
			$this->template->load('layout/template','layout/profile',$data);

		}else{

			//check jika ada gmabar yang akan diupload, "f" itu nama inputnya
			$upload_image = $_FILES['f']['name'];

			if($upload_image){
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '5120'; // dalam hitungan kilobyte(kb), aslinya 1mb itu 1024kb
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('f')){

					$old_image = $data['mekp_user']['image'];

					if($old_image != 'default.jpg'){
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('member');
				}
			}

			$data = [

				'fullname' => $this->input->post('a'),
				'email' => $this->input->post('c'),
				'phone' => $this->input->post('d'),
				'address' => $this->input->post('e')
			];

			$this->db->where('id', $this->input->post('b'));
			$this->db->update('mekp_user',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Profile updated!</div>');
			redirect('member/profile');
		}
	}
	
	public function changePassword(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		
		$this->form_validation->set_rules('aa', 'Current Password','required|trim');
		$this->form_validation->set_rules('bb', 'New Password','required|trim|min_length[6]|matches[cc]');
		$this->form_validation->set_rules('cc', 'Confirm New Password','required|trim|min_length[6]|matches[bb]');

		if($this->form_validation->run() == false){
			$data['title'] = "Profile";
			$this->template->load('layout/template','layout/profile',$data);

		}else{

			$current_password = $this->input->post('aa');
			$new_password = $this->input->post('bb');
			if(!password_verify($current_password, $data['mekp_user']['password'])){

				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong current password!</div>');
				redirect('member/profile');
			}else{
				if($current_password == $new_password){

					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
					redirect('member/profile');
				}else{
					//password ok
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('id', $this->input->post('dd'));
					$this->db->update('mekp_user');

					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password change!</div>');
					redirect('member/profile');
				}
			}
		}
	}

	public function master(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['kategori'] = "Data kategori";
		$data['kategoridata'] = $this->db->get('mekp_kategori')->result_array();
		$data['kondisi'] = "Data kondisi";
		$data['kondisidata'] = $this->db->get('mekp_kondisi')->result_array();	
		$data['status'] = "Data status";
		$data['statusdata'] = $this->db->get('mekp_status_barang')->result_array();
		$data['merk'] = "Data merk";
		$data['merkdata'] = $this->db->get('mekp_merk')->result_array();

		$this->load->model('Member_model','barang');
		$data['allba'] = $this->barang->getAllBarang();
		$data['barang'] = "Data Barang";

		$data['title'] = "Data Master";
		$this->template->load('layout/template','member/view_master',$data);

	}

	public function kategoriAdd(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['kategori'] = "Data kategori";
		$data['kategoridata'] = $this->db->get('mekp_kategori')->result_array();

		$this->form_validation->set_rules('a','Kategori','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Data Master";
			$this->template->load('layout/template','member/view_master',$data);

		}else{


			$this->db->insert('mekp_kategori',['nm_kategori' => $this->input->post('a')]);

			
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Kategori added!</div>');
			redirect('member/master');

		}
		
	}

	public function kategoriEdit(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['kategori'] = "Data kategori";
		$data['kategoridata'] = $this->db->get('mekp_kategori')->result_array();

		$this->form_validation->set_rules('a','Kategori','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Data Master";
			$this->template->load('layout/template','member/view_master',$data);

		}else{

			$data=[
				'nm_kategori' => $this->input->post('a') 
			];
			$this->db->where('id_kategori', $this->input->post('b'));
			$this->db->update('mekp_kategori',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Kategori updated!</div>');
			redirect('member/master');

		}

	}

	public function kategoridelete($id){
		$this->db->delete('mekp_kategori',['id_kategori' => $id]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Kategori deleted!</div>');
		redirect('member/master');
	}

	public function kondisiAdd(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['kondisi'] = "Data kondisi";
		$data['kondisidata'] = $this->db->get('mekp_kondisi')->result_array();

		$this->form_validation->set_rules('a','Kondisi','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Data Master";
			$this->template->load('layout/template','member/view_master',$data);

		}else{


			$this->db->insert('mekp_kondisi',['nm_kondisi' => $this->input->post('a')]);

			
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Kondisi added!</div>');
			redirect('member/master');

		}
		
	}

	public function kondisiEdit(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['kondisi'] = "Data kondisi";
		$data['kondisidata'] = $this->db->get('mekp_kondisi')->result_array();

		$this->form_validation->set_rules('a','Kondisi','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Data Master";
			$this->template->load('layout/template','member/view_master',$data);

		}else{

			$data=[
				'nm_kondisi' => $this->input->post('a') 
			];
			$this->db->where('id_kondisi', $this->input->post('b'));
			$this->db->update('mekp_kondisi',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Kondisi updated!</div>');
			redirect('member/master');

		}

	}

	public function kondisidelete($id){
		$this->db->delete('mekp_kondisi',['id_kondisi' => $id]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Kondisi deleted!</div>');
		redirect('member/master');
	}

	public function merkAdd(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['merk'] = "Data merk";
		$data['merkdata'] = $this->db->get('mekp_merk')->result_array();

		$this->form_validation->set_rules('a','Merk','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Data Master";
			$this->template->load('layout/template','member/view_master',$data);

		}else{


			$this->db->insert('mekp_merk',['nm_merk' => $this->input->post('a')]);

			
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Merk added!</div>');
			redirect('member/master');

		}
		
	}

	public function merkEdit(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['merk'] = "Data merk";
		$data['merkdata'] = $this->db->get('mekp_merk')->result_array();

		$this->form_validation->set_rules('a','Merk','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Data Master";
			$this->template->load('layout/template','member/view_master',$data);

		}else{

			$data=[
				'nm_merk' => $this->input->post('a') 
			];
			$this->db->where('id_merk', $this->input->post('b'));
			$this->db->update('mekp_merk',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Merk updated!</div>');
			redirect('member/master');

		}

	}

	public function merkdelete($id){
		$this->db->delete('mekp_merk',['id_merk' => $id]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Merk deleted!</div>');
		redirect('member/master');
	}

	public function statusAdd(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['status'] = "Data status";
		$data['statusdata'] = $this->db->get('mekp_status_barang')->result_array();

		$this->form_validation->set_rules('a','Status','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Data Master";
			$this->template->load('layout/template','member/view_master',$data);

		}else{


			$this->db->insert('mekp_status_barang',['nm_status' => $this->input->post('a')]);

			
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Status added!</div>');
			redirect('member/master');

		}
		
	}

	public function statusEdit(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['status'] = "Data status";
		$data['statusdata'] = $this->db->get('mekp_status_barang')->result_array();

		$this->form_validation->set_rules('a','Status','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Data Master";
			$this->template->load('layout/template','member/view_master',$data);

		}else{

			$data=[
				'nm_status' => $this->input->post('a') 
			];
			$this->db->where('id_status', $this->input->post('b'));
			$this->db->update('mekp_status_barang',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Status updated!</div>');
			redirect('member/master');

		}

	}

	public function statusdelete($id){
		$this->db->delete('mekp_status_barang',['id_status' => $id]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Status deleted!</div>');
		redirect('member/master');
	}

	public function barangAdd(){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['kategori'] = "Data kategori";
		$data['kategoridata'] = $this->db->get('mekp_kategori')->result_array();
		$data['kondisi'] = "Data kondisi";
		$data['kondisidata'] = $this->db->get('mekp_kondisi')->result_array();	
		$data['status'] = "Data status";
		$data['statusdata'] = $this->db->get('mekp_status_barang')->result_array();
		$data['merk'] = "Data merk";
		$data['merkdata'] = $this->db->get('mekp_merk')->result_array();

		$this->load->model('Member_model','barang');
		$data['allba'] = $this->barang->getAllBarang();
		$data['kd'] = $this->barang->getKDBarang();

		$this->form_validation->set_rules('a','Kode Barang','required|trim');		
		$this->form_validation->set_rules('b', 'Nama Barang','required|trim');
		$this->form_validation->set_rules('c', 'Merk','required');
		$this->form_validation->set_rules('d', 'Kategori','required');
		$this->form_validation->set_rules('e', 'Status','required');
		$this->form_validation->set_rules('f', 'Kondisi','required');
		$this->form_validation->set_rules('g', 'Jumlah','required');
		$this->form_validation->set_rules('h', 'Tahun Pengadaan','required');
		$this->form_validation->set_rules('i', 'Tanggal Masuk','required');
		$this->form_validation->set_rules('j', 'Asal','required|trim');




		if($this->form_validation->run() == false){
			$data['title'] = "Data Barang Add";
			$this->template->load('layout/template','member/view_barang_add',$data);


		}else{

			$data = [

				'tgl_masuk' => $this->input->post('i'),
				'kd_barang' =>ucfirst($this->input->post('a')),
				'jumlah' =>$this->input->post('g'),
				'dari_ke' =>$this->input->post('j'),
				'catatan' =>$this->input->post('k')

			];

			$this->db->insert('mekp_barang_masuk',$data);
			$id_barang_masuk = $this->db->insert_id();

			//cek jika kode barang sudah ada
			$this->load->model('Member_model','barang');
			$data['kd'] = $this->barang->getKDBarang();
			$kd = $this->barang->getKDBarang();	
			
			if ($kd == NULL) {

				$barang = [

					'kd_barang' =>ucfirst($this->input->post('a')),
					'nm_barang' =>$this->input->post('b'),
					'merk' =>$this->input->post('c'),
					'kategori' =>$this->input->post('d'),
					'status' =>$this->input->post('e'),
					'kondisi' =>$this->input->post('f'),
					'jumlah' =>$this->input->post('g'),
					'thn_pengadaan' =>$this->input->post('h'),
					'catatan' =>$this->input->post('k'),

				];

			// insert db barang

				$this->db->insert('mekp_barang',$barang);
			}

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Barang added!</div>');
			redirect('member/master');

		}
	}

	public function barangHistoryMasuk($kd){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Member_model','barang');
		$data['allba'] = $this->barang->getAllBarang();
		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();

		$data['allhisbama'] = $this->barang->getHistoryBarangMasuk($kd);
		$data['allhisbake'] = $this->barang->getHistoryBarangKeluar($kd);

		$data['title'] = "History Barang";
		$this->template->load('layout/template','member/view_barang_history',$data);
	}

	public function barangHistoryMasukEdit($kd){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();

		$this->load->model('Member_model','barang');
		$data['allba'] = $this->barang->getAllBarang();


		$data['allhisbama'] = $this->barang->getHistoryBarangMasuk($kd);
		$data['allhisbake'] = $this->barang->getHistoryBarangKeluar($kd);

		$this->form_validation->set_rules('a', 'Kode Barang','required|trim');
		$this->form_validation->set_rules('b', 'Jumlah','required|trim');
		$this->form_validation->set_rules('c', 'Tanggal Masuk','required|trim');
		$this->form_validation->set_rules('d', 'Asal','required');

		$kode = $this->input->post('a');

		if($this->form_validation->run() == false){

			$data['title'] = "History Barang";
			$this->template->load('layout/template','member/view_barang_history',$data);
		}else{

			$data = [

				'kd_barang' => ucfirst($this->input->post('a')),
				'jumlah' => $this->input->post('b'),
				'tgl_masuk' => $this->input->post('c'),
				'dari_ke' => $this->input->post('d'),
				'catatan' => $this->input->post('e')


			];

			$this->db->where('id_barang_masuk', $this->input->post('zz'));
			$this->db->update('mekp_barang_masuk',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Barang updated!</div>');
			redirect('member/barangHistoryMasuk/'.$kode);

		}
	}


	public function barangHistoryMasukDelete($id = 0, $kd = 0){

		$data['kegiatan'] = $this->db->get_where('mekp_barang_masuk',['kd_barang' => $id_kegiatan] )->row_array();
		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();
		$this->db->delete('mekp_barang_masuk',['id_barang_masuk' => $id]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">History deleted!</div>');
		redirect('member/barangHistoryMasuk/'.$kd);
	}

	public function barangHistoryKeluarEdit($kd){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();

		$this->load->model('Member_model','barang');
		$data['allba'] = $this->barang->getAllBarang();

		$data['allhisbama'] = $this->barang->getHistoryBarangMasuk($kd);
		$data['allhisbake'] = $this->barang->getHistoryBarangKeluar($kd);

		$this->form_validation->set_rules('a', 'Kode Barang','required|trim');
		$this->form_validation->set_rules('b', 'Jumlah','required');
		$this->form_validation->set_rules('c', 'Tanggal Keluar','required');
		$this->form_validation->set_rules('d', 'Lokasi','required');
		$this->form_validation->set_rules('e', 'Kebutuhan','required');

		$kode = $this->input->post('a');

		if($this->form_validation->run() == false){

			$data['title'] = "History Barang";
			$this->template->load('layout/template','member/view_barang_history',$data);
		}else{

			$data = [

				'kd_barang' => ucfirst($this->input->post('a')),
				'jumlah' => $this->input->post('b'),
				'tgl_keluar' => $this->input->post('c'),
				'dari_ke' => $this->input->post('d'),
				'kebutuhan' => $this->input->post('e'),
				'catatan' => $this->input->post('f')


			];

			$this->db->where('id_barang_keluar', $this->input->post('zz'));
			$this->db->update('mekp_barang_keluar',$data);

			$barang = [

				'kd_barang' => $this->input->post('a'),
				'lokasi' => $this->input->post('d'),
				'kebutuhan' => $this->input->post('e'),
				'tgl_perbaikan' => $this->input->post('c'),
				'jumlah' => $this->input->post('b'),
				'hasil' => $this->input->post('f')

			];
			$this->db->where('id_perbaikan', $this->input->post('xx'));
			$this->db->update('mekp_perbaikan',$barang);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Barang updated!</div>');
			redirect('member/barangHistoryMasuk/'.$kode);

		}
	}

	public function barangHistoryKeluarDelete($id = 0, $id_perbaikan = 0,$kd = 0){

		$data['kegiatan'] = $this->db->get_where('mekp_barang_keluar',['kd_barang' => $id_kegiatan] )->row_array();
		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();
		$this->db->delete('mekp_barang_keluar',['id_barang_keluar' => $id]);
		$this->db->delete('mekp_perbaikan',['id_perbaikan' => $id_perbaikan]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">History deleted!</div>');
		redirect('member/barangHistoryMasuk/'.$kd);
	}

	public function barangDetail($id){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['kategori'] = "Data kategori";
		$data['kategoridata'] = $this->db->get('mekp_kategori')->result_array();
		$data['kondisi'] = "Data kondisi";
		$data['kondisidata'] = $this->db->get('mekp_kondisi')->result_array();	
		$data['status'] = "Data status";
		$data['statusdata'] = $this->db->get('mekp_status_barang')->result_array();
		$data['merk'] = "Data merk";
		$data['merkdata'] = $this->db->get('mekp_merk')->result_array();

		$this->load->model('Member_model','barang');
		$data['allba'] = $this->barang->getAllBarang();
		$data['oneba'] = $this->barang->getOneBarang($id);
		// $data['allhisba'] = $this->barang->getHistoryBarang($id);

		$data['title'] = "Detail Barang";
		$this->template->load('layout/template','member/view_barang_detail',$data);
	}

	public function barangEdit($id){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['merk'] = "Data merk";
		$data['merkdata'] = $this->db->get('mekp_merk')->result_array();
		$data['kategori'] = "Data kategori";
		$data['kategoridata'] = $this->db->get('mekp_kategori')->result_array();
		$data['kondisi'] = "Data kondisi";
		$data['kondisidata'] = $this->db->get('mekp_kondisi')->result_array();
		$data['status'] = "Data status";
		$data['statusdata'] = $this->db->get('mekp_status_barang')->result_array();

		$this->load->model('Member_model','barang');
		$data['allba'] = $this->barang->getAllBarang();
		$data['oneba'] = $this->barang->getOneBarang($id);

		$this->form_validation->set_rules('a', 'Kode Barang','required|trim');
		$this->form_validation->set_rules('b', 'Nama Barang','required|trim');
		$this->form_validation->set_rules('c', 'Merk','required|trim');
		$this->form_validation->set_rules('d', 'Kategori','required');
		$this->form_validation->set_rules('e', 'Kondisi','required|trim');
		$this->form_validation->set_rules('f', 'Status','required');
		$this->form_validation->set_rules('g', 'Jumlah','required');
		$this->form_validation->set_rules('h', 'Tahun Pengadaan','required|trim');


		if($this->form_validation->run() == false){

			$data['title'] = "Edit Barang";
			$this->template->load('layout/template','member/view_barang_edit',$data);

		}else{

			$data = [

				'kd_barang' => ucfirst($this->input->post('a')),
				'nm_barang' => $this->input->post('b'),
				'merk' => $this->input->post('c'),
				'kategori' => $this->input->post('d'),
				'kondisi' => $this->input->post('e'),
				'status' => $this->input->post('f'),
				'jumlah' => $this->input->post('g'),
				'thn_pengadaan' => $this->input->post('h'),
				'catatan' => $this->input->post('i')

			];

			$this->db->where('id_barang', $this->input->post('zz'));
			$this->db->update('mekp_barang',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Barang updated!</div>');
			redirect('member/master');
		}
	}

	public function barangdelete($id){
		$this->db->delete('mekp_barang',['id_barang' => $id]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Barang deleted!</div>');
		redirect('member/master');
	}

	public function perawatan(){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();

		$this->load->model('Member_model','perawatan');
		$data['allperawatan'] = $this->perawatan->getAllPerawatan();

		$data['title'] = "Data Perawatan";
		$this->template->load('layout/template','member/view_perawatan',$data);
	}

	public function perawatanAdd(){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();

		$this->form_validation->set_rules('a', 'Nama Perawatan','required|trim');
		$this->form_validation->set_rules('b', 'Lokasi','required');
		$this->form_validation->set_rules('c', 'Lokasi Rinci','required');
		$this->form_validation->set_rules('d', 'Tanggal Perawatan','required');


		if($this->form_validation->run() == false){

			$data['title'] = "Data Perawatan Add";
			$this->template->load('layout/template','member/view_perawatan_add',$data);

		}else{

			$data = [

				'nm_perawatan' => $this->input->post('a'),
				'lokasi' => $this->input->post('b'),
				'lokasi_rinci' => $this->input->post('c'),
				'tgl_perawatan' => $this->input->post('d'),
				'keterangan' => $this->input->post('e')

			];

			$this->db->insert('mekp_perawatan',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Data added!</div>');
			redirect('member/perawatan');
		}
	}

	public function perawatanDetail($id){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();

		$this->load->model('Member_model','perawatan');
		$data['allperawatan'] = $this->perawatan->getAllPerawatan();
		$data['oneperawatan'] = $this->perawatan->getOnePerawatan($id);
		$data['allperbaikan'] = $this->perawatan->getAllPerbaikan($id);
		$data['barang'] = $this->db->get('mekp_barang')->result_array();

		$data['title'] = "Detail Perawatan";
		$this->template->load('layout/template','member/view_perawatan_detail',$data);
	}

	public function perawatanEdit($id){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();
		$data['kategoridata'] = $this->db->get('mekp_kategori')->result_array();

		$this->load->model('Member_model','perawatan');
		$data['allperawatan'] = $this->perawatan->getAllPerawatan();
		$data['oneperawatan'] = $this->perawatan->getOnePerawatan($id);
		$data['allperbaikan'] = $this->perawatan->getAllPerbaikan($id);
		$data['barang'] = $this->db->get('mekp_barang')->result_array();

		$this->form_validation->set_rules('a', 'Nama Perawatan','required|trim');
		$this->form_validation->set_rules('b', 'Lokasi','required');
		$this->form_validation->set_rules('c', 'Lokasi Rinci','required');
		$this->form_validation->set_rules('d', 'Tanggal','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Edit Perawatan";
			$this->template->load('layout/template','member/view_perawatan_edit',$data);
		}else{

			$data = [

				'nm_perawatan' => $this->input->post('a'),
				'lokasi' => $this->input->post('b'),
				'lokasi_rinci' => $this->input->post('c'),
				'tgl_perawatan' => $this->input->post('d'),
				'keterangan' => $this->input->post('e')

			];

			$this->db->where('id_perawatan', $this->input->post('zz'));
			$this->db->update('mekp_perawatan',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data updated!</div>');
			redirect('member/perawatan');
		}
	}

	public function perawatandelete($id){
		$this->db->delete('mekp_perawatan',['id_perawatan' => $id]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data deleted!</div>');
		redirect('member/perawatan');
	}

	public function perbaikanAdd($id){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();

		$this->load->model('Member_model','perawatan');
		$data['allperawatan'] = $this->perawatan->getAllPerawatan();
		$data['oneperawatan'] = $this->perawatan->getOnePerawatan($id);
		$data['allperbaikan'] = $this->perawatan->getAllPerbaikan($id);
		$data['barang'] = $this->db->get('mekp_barang')->result_array();

		$this->form_validation->set_rules('aa', 'tanggal Perbaikan','required|trim');
		$this->form_validation->set_rules('bb', 'Kode Barang','required|trim');
		$this->form_validation->set_rules('xx', 'Lokasi','required');
		$this->form_validation->set_rules('cc', 'Jumlah','required');
		$this->form_validation->set_rules('dd', 'Kebutuhan Rinci','required');


		if($this->form_validation->run() == false){

			$data['title'] = "Edit Perawatan";
			$this->template->load('layout/template','member/view_perawatan_edit',$data);
		}else{

			$data = [

				'id_perawatan' => $id,
				'tgl_perbaikan' => $this->input->post('aa'),
				'lokasi' => $this->input->post('xx'),
				'kd_barang' => $this->input->post('bb'),
				'jumlah' => $this->input->post('cc'),
				'kebutuhan' => $this->input->post('dd'),
				'hasil' => $this->input->post('ee')

			];



			$this->db->insert('mekp_perbaikan',$data);
			$id_perbaikan = $this->db->insert_id();

			// add data to table barang keluar 
			$barang = [

				'tgl_keluar' => $this->input->post('aa'),
				'dari_ke' => $this->input->post('xx'),
				'kd_barang' => $this->input->post('bb'),
				'jumlah' => $this->input->post('cc'),
				'kebutuhan' => $this->input->post('dd'),
				'catatan' => $this->input->post('ee'),
				'id_perbaikan' => $id_perbaikan

			];

			$this->db->insert('mekp_barang_keluar',$barang);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Data added!</div>');
			redirect('member/perbaikanEdit/'.$id);

		}

	}

	public function perbaikanEdit($id){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();
		$data['kategoridata'] = $this->db->get('mekp_kategori')->result_array();

		$this->load->model('Member_model','perawatan');
		$data['allperawatan'] = $this->perawatan->getAllPerawatan();
		$data['oneperawatan'] = $this->perawatan->getOnePerawatan($id);
		$data['allperbaikan'] = $this->perawatan->getAllPerbaikan($id);
		$data['barang'] = $this->db->get('mekp_barang')->result_array();

		$this->form_validation->set_rules('aa', 'tanggal Perbaikan','required|trim');
		$this->form_validation->set_rules('bb', 'Kode Barang','required|trim');
		$this->form_validation->set_rules('cc', 'Jumlah','required');
		$this->form_validation->set_rules('xx', 'Lokasi','required');
		$this->form_validation->set_rules('dd', 'Kebutuhan Rinci','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Edit Perawatan";
			$this->template->load('layout/template','member/view_perawatan_edit',$data);
		}else{

			$data = [

				'id_perawatan' => $id,
				'tgl_perbaikan' => $this->input->post('aa'),
				'lokasi' => $this->input->post('xx'),
				'kd_barang' => $this->input->post('bb'),
				'jumlah' => $this->input->post('cc'),
				'kebutuhan' => $this->input->post('dd'),
				'hasil' => $this->input->post('ee')

			];

			$this->db->where('id_perbaikan', $this->input->post('zz'));
			$this->db->update('mekp_perbaikan',$data);

			$barang = [

				'tgl_keluar' => $this->input->post('aa'),
				'dari_ke' => $this->input->post('xx'),
				'kd_barang' => $this->input->post('bb'),
				'jumlah' => $this->input->post('cc'),
				'kebutuhan' => $this->input->post('dd'),
				'catatan' => $this->input->post('ee'),
				'id_perbaikan' => $this->input->post('zz')

			];
			$this->db->where('id_perbaikan', $this->input->post('zz'));
			$this->db->update('mekp_barang_keluar',$barang);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Perbaikan Updated!</div>');
			redirect('member/perbaikanEdit/'.$id);

		}
	}

	public function perbaikanDelete($id = 0,$id_perbaikan = 0){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['lokasidata'] = $this->db->get('mekp_lokasi')->result_array();
		$data['kategoridata'] = $this->db->get('mekp_kategori')->result_array();

		$this->load->model('Member_model','perawatan');
		$data['allperawatan'] = $this->perawatan->getAllPerawatan();
		$data['oneperawatan'] = $this->perawatan->getOnePerawatan($id);
		$data['allperbaikan'] = $this->perawatan->getAllPerbaikan($id);
		$data['barang'] = $this->db->get('mekp_barang')->result_array();
		$this->db->delete('mekp_perbaikan',['id_perbaikan' => $id_perbaikan]);
		$this->db->delete('mekp_barang_keluar',['id_perbaikan' => $id_perbaikan]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Perawatan deleted!</div>');
		redirect('member/perbaikanEdit/'.$id);
	}

	public function laporan(){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

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


		$this->form_validation->set_rules('a', 'Pilih Tabel','required');
		$this->form_validation->set_rules('b', 'Awal Periode','required');
		$this->form_validation->set_rules('c', 'Akhir Periode','required');


		if($this->form_validation->run() == false){
			
			$data['title'] = "Data Laporan";
			$this->template->load('layout/template','member/view_laporan',$data);
		}else{

			$tabel = $this->input->post('a');
			$awal = $this->input->post('b');
			$akhir = $this->input->post('c');

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

			$data['alllaporan'] = $this->db->query($queryLaporan)->result_array();
			$data['title'] = "Data Laporan";
			$this->template->load('layout/template','member/view_laporan',$data);
			// redirect('member/laporan');

		}
	}
	public function laporanhasil(){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

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


		$this->form_validation->set_rules('a', 'Pilih Tabel','required');
		$this->form_validation->set_rules('b', 'Awal Periode','required');
		$this->form_validation->set_rules('c', 'Akhir Periode','required');


		if($this->form_validation->run() == false){
			
			$data['title'] = "Data Laporan";
			$this->template->load('layout/template','member/view_laporan_hasil',$data);
		}else{

			$tabel = $this->input->post('a');
			$awal = $this->input->post('b');
			$akhir = $this->input->post('c');

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

			$data['alllaporan'] = $this->db->query($queryLaporan)->result_array();
			$data['title'] = "Data Laporan";
			$this->template->load('layout/template','member/view_laporan',$data);
			// redirect('member/laporan');

		}
	}

}