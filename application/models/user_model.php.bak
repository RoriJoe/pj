<?php
    class User_model extends CI_Model{

        function __construct(){
            parent::__construct();
        }

        function get_list()
        {
            $this->db->select('*');
            $q=$this->db->get('muser');
            return $q->result();
        }
        function insert($data, $id){
            $rr=$this->db->query("select * from muser where username = '$id'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert('muser', $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        function update($data, $kode)
        {
            $this->db->where('username', $kode);
            $this->db->update('muser', $data);
            return "ok";
        }

        //model untuk delete
        function delete($kode)
        {
            $this->db->where('username',$kode);
            $this->db->delete('muser');
            return "ok";
        }

        function update_image($data, $kode){
            $this->db->where('username', $kode);
            $this->db->update('muser', $data);
            return "ok";
        }
    }