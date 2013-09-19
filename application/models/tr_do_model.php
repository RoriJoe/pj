<?php
    class Tr_do_model extends CI_Model{

        private $primary_key='No_Do';
        private $table_name='do_h';

        function __construct(){
            parent::__construct();
        }

        function get_paged_list()
        {
            $q = $this->db->query("SELECT do_h.*,
                pelanggan.Perusahaan
                FROM do_h
                LEFT OUTER JOIN pelanggan
                ON do_h.Kode_Plg = pelanggan.Kode");
            return $q->result();
        }

        function get_detail_do($id){
            $this->db->select('*');
            $this->db->from('do_d');
            $this->db->join('barang','barang.Kode = do_d.Kode_brg');
            $this->db->where($this->primary_key, $id);
            
            $query = $this->db->get();
            return $query->result();
        }

        function find($keyword){
            $this->db->like('No_Do',$keyword,'after');
            $query=$this->db->get('do_h');
            return $query->result_array();
        }
		
		function insertDo($data,$so)
        {
            $rr=$this->db->query("select * from do_h where No_Do = '$so'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        
        function insertDo_det($datadet,$so)
        {
            $this->db->insert('do_d', $datadet);
        }
		
		
		function updateDo($data, $so)
        {
            $this->db->where('No_Do',$so);
            $this->db->update('do_h', $data);
            return "ok";
        }
		
        function updateDo_det($datadet,$so,$kb)
        {
			$where = "No_Do = '$so' AND Kode_Brg = '$kb'";
			
			$this->db->where($where);
			$this->db->update('do_d', $datadet);
        }
		
		function delete($so)
        {
            $this->db->where('No_Do',$so);
            $this->db->delete('do_h');
            return "ok";
        }
		function delete_det($so)
        {
            $this->db->where('No_Do',$so);
            $this->db->delete('do_d');
            //return "ok";
        }
    }