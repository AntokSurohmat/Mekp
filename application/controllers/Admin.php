<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();

	}
	public function index(){
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();

		//Count 
		$this->load->model('Admin_model','count');
		$data['countrole'] = $this->count->getCountRoles();
		$data['countuser'] = $this->count->getCountUser();
		$data['countmenu'] = $this->count->getCountMenu();
		$data['countsubmenu'] = $this->count->getCountSubMenu();

		$data['title'] = "Dashboard";
		$this->template->load('layout/template','admin/view_dashboard',$data);
	}

	public function role(){
		
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('mekp_role')->result_array();

		$this->form_validation->set_rules('a','Access','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Access Menu";
			$this->template->load('layout/template','admin/view_role',$data);

		}else{

			$this->db->insert('mekp_role',['access' => $this->input->post('a')]);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Role added!</div>');
			redirect('admin/role');

		}
		
	}

	public function roleAccess($role_id){
		
		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('mekp_role',['id' => $role_id])->row_array();
		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('mekp_menu')->result_array();
		$data['title'] = "Access Menu";
		$this->template->load('layout/template','admin/view_role_access',$data);

	}

	public function changeaccess(){

		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [

			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('mekp_access_menu', $data);

		if($result->num_rows() < 1 ){
			$this->db->insert('mekp_access_menu',$data);
		}else{
			$this->db->delete('mekp_access_menu',$data);
		}

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Access Changed!</div>');
	}

	public function editRole(){


		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('mekp_role')->result_array();
		$this->form_validation->set_rules('a','Parents','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Edit Access Menu";
			$this->template->load('home/layout/template','home/view_role',$data);

		}else{

			$data=[
				'access' => $this->input->post('a') 
			];
			$this->db->where('id', $this->input->post('b'));
			$this->db->update('mekp_role',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data role updated!</div>');
			redirect('admin/role');

		}

	}

	public function deleteRole($id){

		$this->db->delete('mekp_role',['id' => $id]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Role deleted!</div>');
		redirect('admin/role');
	}

	public function forbidden(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['forbi'] = $this->db->get('mekp_forbi')->result_array();

		$this->form_validation->set_rules('a','Name Menu','required');
		$this->form_validation->set_rules('b','Url','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Forbidden Menu";
			$this->template->load('layout/template','setting/view_forbidden',$data);
		}else{

			$data = [
				'name' => $this->input->post('a'),
				'url' => $this->input->post('b'),
				'is_active' => $this->input->post('c')
			];

			$this->db->insert('mekp_forbi',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Menu Forbidden added!</div>');
			redirect('admin/forbidden');
		}
	}

	public function forbiddenEdit(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['forbi'] = $this->db->get('mekp_forbi')->result_array();

		$this->form_validation->set_rules('a','Name Menu','required');
		$this->form_validation->set_rules('b','Url','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Forbidden Menu";
			$this->template->load('layout/template','setting/view_forbidden',$data);
		}else{

			$data = [
				'name' => $this->input->post('a'),
				'url' => $this->input->post('b'),
				'is_active' => $this->input->post('c')
			];

			$this->db->where('id', $this->input->post('d'));
			$this->db->update('mekp_forbi',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Menu Forbidden Updated!</div>');
			redirect('admin/forbidden');
		}
	}

	public function forbiddenDelete($id){

		$this->db->delete('mekp_forbi',['id' => $id]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Menu deleted!</div>');
		redirect('admin/forbidden');

	}
	
}
