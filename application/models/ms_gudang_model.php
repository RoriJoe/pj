<?php
    class Ms_gudang_model extends CI_Model{
        
        private $primary_key='Kode';
        private $table_name='gudang';
        
        function __construct(){
            parent::__construct();
        }
        
        //Get List Table
        function get_paged_list()
        {
            $q = $this->db->query("
                SELECT Kode,Nama,Alamat,Kota,Telp,Telp1,Fax,Fax1
                FROM gudang
            ");
            return $q->result();
        }

        //Save New Data
        function insert($data, $id)
        {
            $rr=$this->db->query("select * from gudang where Kode = '$id'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);  
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        //Update Data
        function update($data, $id)
        {
            $this->db->where($this->primary_key,$id);
            $this->db->update($this->table_name, $data);
            return "ok";
        }
        //Delete Data
        function delete($id)
        {
            $this->db->where($this->primary_key,$id);
            $this->db->delete($this->table_name);
            return "ok";
        }
        //View List Gudang
        function view()
        {
            $q = $this->db->query("
                SELECT Kode,Nama,Alamat,Kota,Telp
                FROM gudang
            ");
            return $q->result();
        }
        //Suggestion
		function find($keyword){
            $this->db->like('Nama',$keyword);
            $query=$this->db->get('gudang');
            return $query->result_array();
        }
    }