<?php
    class Ms_perkiraan_model extends CI_Model{
        
        private $primary_key='nomoraccount';
        private $table_name='perkiraan';
        
        function __construct(){
            parent::__construct();
        }
        
        //Get List Table
        function get_paged_list()
        {
            $q = $this->db->query("
                SELECT nomoraccount,namaaccount,type,level
                FROM perkiraan
            ");
            return $q->result();
        }

        function CekAcc($val){
            $this->db->select('nomoraccount');
            $this->db->where('nomoraccount',$val);
            if($_POST['FlagAc']==2){
                $this->db->where_not_in('nomoraccount',$_POST['Kode']);
            }
            $rs=$this->db->get('perkiraan');
            
            if($rs->num_rows() < 1)
                return 0;
            else
                return 1;
        }

        function get_selected($id)
        {
            $q = $this->db->query("
            SELECT nomoraccount,namaaccount,type,level, tanggalentry,tanggalsaldoawal,saldo
            FROM perkiraan
            WHERE nomoraccount = '$id' LIMIT 1
            ");
            return $q->result();
        }

        function insert($data, $id)
        {
            $rr=$this->db->query("select nomoraccount from perkiraan where nomoraccount = '$id'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);  
                return "ok";
            }else
            {
                return "gagal";
            }
        }

        function update($data, $id)
        {
            $this->db->where($this->primary_key,$id);
            $this->db->limit(1);
            $this->db->update($this->table_name, $data);
            return "ok";
        }
        //model untuk delete
        function delete($id)
        {
            $this->db->where($this->primary_key,$id);
            $this->db->limit(1);
            $this->db->delete($this->table_name);
            return "ok";
        }
    }