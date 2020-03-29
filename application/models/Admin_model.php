<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function getCountRoles(){

		$query = "SELECT COUNT(access) as access FROM mekp_role";

		return $this->db->query($query)->row()->access;
	}

	public function getCountUser(){

		$query = "SELECT COUNT(email) as email FROM mekp_user";

		return $this->db->query($query)->row()->email;
	}

	public function getCountMenu(){

		$query = "SELECT COUNT(parents) as parents FROM mekp_menu";

		return $this->db->query($query)->row()->parents;
	}

	public function getCountSubMenu(){

		$query = "SELECT COUNT(title) as title FROM mekp_sub_menu";

		return $this->db->query($query)->row()->title;
	}

	public function getCountForbi(){

		$query = "SELECT COUNT(name) as name FROM mekp_forbi";

		return $this->db->query($query)->row()->name;
	}




}