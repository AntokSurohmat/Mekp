<?php

function is_logged_in(){

	$ci = get_instance();
	if (!$ci->session->userdata('email')){

		redirect('auth');

	}else{

		$role_id = $ci->session->userdata('role_id');
		$parents = $ci->uri->segment(1);

		$queryMenu = $ci->db->get_where('mekp_menu', ['parents' => $parents])->row_array();
		$menu_id = $queryMenu['id'];

		$userAcces = $ci->db->get_where('mekp_access_menu',[
			'role_id' => $role_id, 
			'menu_id' => $menu_id] 
		);

		if($userAcces->num_rows($role_id) >= 2 ){
			redirect('auth/blocked');
		}
	}
}


function check_access($role_id,$menu_id){

	$ci = get_instance();
	$ci->db->where('role_id', $role_id);
	$ci->db->where('menu_id', $menu_id);
	$result = $ci->db->get('mekp_access_menu');
	if($result->num_rows() > 0 ){
		return "checked='checked'";
	}
}