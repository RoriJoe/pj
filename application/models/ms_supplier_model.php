<?php
    class Ms_supplier_model extends CI_Model{
        
        private $primary_key='Kode';
        private $table_name='supplier';
        
        function __construct(){
            parent::__construct();
        }
        
        //Get Table Detail Data
        function get_paged_list()
        {
            $q = $this->db->query("
            SELECT Kode,Nama, Perusahaan, Alamat1, Kota, Telp, Telp1, Telp2, Fax1, Fax2, Limit_Kredit
            FROM supplier
            ");
            return $q->result();
        }
        
        //model untuk save add data
        function insert($data, $id)
        {
            $rr=$this->db->query("select * from supplier where Kode = '$id'");
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
		
		function find($keyword){
            $this->db->like('Perusahaan',$keyword);
            $query=$this->db->get('supplier');
            return $query->result_array();
        }
    }