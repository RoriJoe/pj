<?php
	class Dashboard_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		function get_penjualan($start, $end){
			$this->db->select('Tgl');
			$this->db->select_sum('grandttl');
			$this->db->from('do_h');
			$this->db->where('Tgl >=', $start);
			$this->db->where('Tgl <=', $end);
			$this->db->group_by("Tgl");
			$this->db->order_by("Tgl", "desc");

			$query = $this->db->get(); 
			return $query->result();
		}
	}