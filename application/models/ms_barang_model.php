<?php
    class Ms_barang_model extends CI_Model{
        
        private $primary_key='Kode';
        private $table_name='barang';
        
        function __construct(){
            parent::__construct();
        }
        
        function get_barang(){ //tampilin barang
            $q=$this->db->get('barang');
            return $q->result();
        }
        
        //Get Table Detail Data
        function get_paged_list()
        {
            $q = $this->db->query("
            SELECT Kode, Ukuran, Nama, Nama2, Satuan1, Qty1
            FROM barang
            ");
            return $q->result();
        }

        function check($data){
            $this->db->select('*');
            $this->db->not_like($data);
            $q=$this->db->get($this->table_name);
            return $q->result();
            /*$q = $this->db->query("
            SELECT Kode
            FROM barang
            WHERE Kode NOT LIKE '$data'
            ");
            return $q->result();*/
        }

        //model untuk save add data
        function insert($data, $id)
        {
            $rr=$this->db->query("select * from barang where Kode = '$id'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);  
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        
        //model untuk get data update     
        function getUpdate($id)
        {
            $this->db->where($this->primary_key,$id);
            $q=$this->db->get($this->table_name);
            return $q->result();
        }
        
        //model untuk save update
        function update($data, $id)
        {
            $this->db->where($this->primary_key,$id);
            $this->db->update($this->table_name, $data);
            return "ok";
        }
        //model untuk delete
        function delete($id)
        {
            $this->db->where($this->primary_key,$id);
            $this->db->delete($this->table_name);
            return "ok";
        }
        //model untuk view detail data
        function view($id){
            $this->db->where($this->primary_key,$id);
            return $this->db->get($this->table_name);
        }
		
		function add_sat($data,$id){
			$rr=$this->db->query("select * from satuan where Value = '$id'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert('satuan', $data);  
                return "ok";
            }else
            {
                return "gagal";
            }
		}
    }