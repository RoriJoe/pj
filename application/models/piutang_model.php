<?php if ( ! defined('BASEPATH')) exit('Hacking Attemp Detected!');

class Piutang_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_list()
	{
		$query = $this->db->query("
			SELECT A.Kode, A.Perusahaan, A.Piutang, A.Limit, A.Kota
			FROM pelanggan A
			LEFT JOIN do_h B 
			ON B.Kode_Plg = A.Kode
			WHERE B.No_Do IN (SELECT Kode_SO FROM invoice)
			");

		return $query->result();
	}

	function get_invo_list($id){
		$this->db->select('B.Kode');
		$this->db->from('do_h A');
		$this->db->join('invoice B','B.Kode_SO = A.No_Do','left');
		$this->db->where('A.Kode_Plg', $id);

		$query = $this->db->get();

    	return $query->result();
	}

	function find($id){
		$this->db->select('B.Tgl, B.Term, B.Status, A.No_Po, A.Total');
		$this->db->from('do_h A');
		$this->db->join('invoice B','B.Kode_SO = A.No_Do','left');
		$this->db->where('B.Kode', $id);

		$query = $this->db->get();

    	return $query->result();
	}
}