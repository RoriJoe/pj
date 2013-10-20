<?php
    class Ms_bank_model extends CI_Model{
        
        private $primary_key='kode_bank';
        private $table_name='bank_h';
        
        function __construct(){
            parent::__construct();
        }
        
        function get_bank(){
            $q=$this->db->get('bank');
            return $q->result();
        }
        
        //Get Table Detail Data
        function get_paged_list()
        {
            $q = $this->db->query("
            SELECT kode_bank, nama_bank, alamat
            FROM bank_h
            ");
            return $q->result();
        }

        function get_detail($id){
            $this->db->select('kode_bank, no_rekening, atas_nama, tipe, cabang, no_perkiraan');
            $this->db->from('bank_d');
            $this->db->where('kode_bank', $id);
            $query = $this->db->get();

            return $query->result();
        }

        function insert($data,$id)
        {
            $this->db->select('kode_bank');
            $this->db->from('bank_h');
            $this->db->where('kode_bank', $id);
            $query = $this->db->get();

            if($query->num_rows() ==  0)
            {
                $q=$this->db->insert('bank_h', $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }

        function insert_det($data_det){
            $this->db->insert('bank_d', $data_det);
        }

        function delete($kode)
        {
            $this->db->where('kode_bank',$kode);
            $this->db->delete('bank_h');
            return "ok";
        }
        function delete_det($kode)
        {
            $this->db->where('kode_bank',$kode);
            $this->db->delete('bank_d');
        }

        function update($data, $kode)
        {
            $this->db->where('kode_bank', $kode);
            $this->db->update('bank_h', $data);
            return "ok";
        }

        function add_tipe($data,$id){
            $rr=$this->db->query("select * from tipe_rekening where Value = '$id'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert('tipe_rekening', $data);  
                return "ok";
            }else
            {
                return "gagal";
            }
        }

    }