<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

	public function getAllBarang(){

		$query = "SELECT `a`.`id_barang`,`a`.`kd_barang`,`a`.`nm_barang`, `a`.`jumlah`,`a`.`thn_pengadaan`,`a`.`catatan`, `b`.`nm_merk`,`c`.`nm_kategori`,`d`.`nm_status`,`e`.`nm_kondisi` FROM 
		`mekp_barang` `a` JOIN `mekp_merk` `b` ON `a`.`merk` = `b`.`id_merk` 
		JOIN `mekp_kategori` `c` ON `a`.`kategori` = `c`.`id_kategori`
		JOIN `mekp_status_barang` `d` ON `a`.`status` = `d`.`id_status`
		JOIN `mekp_kondisi` `e` ON `a`.`kondisi` = `e`.`id_kondisi`
		";

		return $this->db->query($query)->result_array();
	}

	public function getOneBarang($id){

		$query = "SELECT a.*, `b`.`nm_merk`,`c`.`nm_kategori`,`d`.`nm_status`,`e`.`nm_kondisi` FROM 
		`mekp_barang` `a` JOIN `mekp_merk` `b` ON `a`.`merk` = `b`.`id_merk` 
		JOIN `mekp_kategori` `c` ON `a`.`kategori` = `c`.`id_kategori`
		JOIN `mekp_status_barang` `d` ON `a`.`status` = `d`.`id_status`
		JOIN `mekp_kondisi` `e` ON `a`.`kondisi` = `e`.`id_kondisi`
		WHERE `a`.`id_barang` = $id
		";

		return $this->db->query($query)->row_array();
	}

	public function getHistoryBarangMasuk($kd){

		$query = "SELECT a.* FROM `mekp_barang_masuk` `a`
		JOIN `mekp_barang` `b`
		ON `a`.`kd_barang` = `b`.`kd_barang`
		WHERE `a`.`kd_barang` LIKE '%$kd%'
		";

		return $this->db->query($query)->result_array();
	}

	public function getHistoryBarangKeluar($kd){

		$query = "SELECT a.*, a.catatan as catatana, c.* FROM `mekp_barang_keluar` `a`
		JOIN `mekp_barang` `b`ON `a`.`kd_barang` = `b`.`kd_barang`
		JOIN mekp_lokasi c ON a.dari_ke = c.id_lokasi
		WHERE `a`.`kd_barang` LIKE '%$kd%'
		";

		return $this->db->query($query)->result_array();
	}

	public function getAllPerawatan(){

		$query = "SELECT a.*, b.*  FROM mekp_perawatan a 
		JOIN mekp_lokasi b ON a.lokasi = b.id_lokasi ORDER BY `id_perawatan`
		";

		return $this->db->query($query)->result_array();
	}

	public function getOnePerawatan($id){

		$query = "SELECT a.*, b.*  FROM mekp_perawatan a 
		JOIN mekp_lokasi b ON a.lokasi = b.id_lokasi
		WHERE a.id_perawatan = $id
		";

		return $this->db->query($query)->row_array();
	}

	public function getAllPerbaikan($id){
		$query = "SELECT * FROM `mekp_perbaikan`
		JOIN mekp_perawatan ON mekp_perbaikan.lokasi = mekp_perawatan.lokasi
		WHERE `mekp_perbaikan`.`id_perawatan` = $id ORDER BY `id_perbaikan`
		";

		return $this->db->query($query)->result_array();
	}

	public function getOnePerbaikan($id){

		$query = "SELECT a.*, b.*  FROM mekp_perbaikan a 
		JOIN mekp_lokasi b ON a.lokasi = b.id_lokasi
		WHERE a.id_perbaikan = $id
		";

		return $this->db->query($query)->row_array();
	}

	public function getKDBarang(){
		
		$match = $this->input->post('a');
		$this->db->like('kd_barang',$match);

    	$query = $this->db->get('mekp_barang');      //pass data to query
    	return $query->row_array();

    }

    public function getLaporan($tabel,$tgl,$awal,$akhir){

    	$query = "SELECT * FROM $tabel WHERE ($tgl BETWEEN '$awal' AND '$akhir'
    	";
    	return $this->db->query($query)->result_array();
    }

}