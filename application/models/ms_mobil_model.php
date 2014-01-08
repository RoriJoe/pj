<?php
    class Ms_mobil_model extends CI_Model{
        
        private $primary_key='No_mobil';
        private $table_name='mobil';
        
        function __construct(){
            parent::__construct();
        }
        
        //Get List Table
        function get_paged_list()
        {
            $q = $this->db->query("
                SELECT *
                FROM mobil
            ");
            return $q->result();
        }

        //Save New Data
        function insert($data, $id)
        {
            $rr=$this->db->query("select * from mobil where No_mobil = '$id'");
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
    }