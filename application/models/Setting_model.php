<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

	public function getSubMenu(){

		$query = "SELECT `mekp_sub_menu`.*, `mekp_menu`.`parents`
				FROM `mekp_sub_menu` JOIN `mekp_menu`
				ON `mekp_sub_menu`.`menu_id` = `mekp_menu`.`id`
		";

		return $this->db->query($query)->result_array();
	}
	public function getUserAll(){
		$query = "SELECT `mekp_user`.*, `mekp_role`.`access`
		FROM `mekp_user` JOIN `mekp_role`
		ON `mekp_user`.`role_id` = `mekp_role`.`id`
		";

		return $this->db->query($query)->result_array();
	}

	public function getUserRole($id){
		$query = "SELECT `mekp_user`.*, `mekp_role`.`access`
		FROM `mekp_user` JOIN `mekp_role`
		ON `mekp_user`.`role_id` = `mekp_role`.`id`
		WHERE `mekp_user`.`id` = $id
		";

		return $this->db->query($query)->row_array();
	}
}