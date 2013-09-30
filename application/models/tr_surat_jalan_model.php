<?php
    class Tr_surat_jalan_model extends CI_Model{

        private $primary_key='No_Sj';
        private $table_name='sj_h';

        function __construct(){
            parent::__construct();
        }

        #Model untuk load table samping
        function get_paged_list()
        {
            $q = $this->db->query("SELECT sj_h.*,
                pelanggan.Perusahaan
                FROM sj_h
                LEFT OUTER JOIN pelanggan
                ON sj_h.Kode_Plg = pelanggan.Kode");
            return $q->result();
        }
		
        //model untuk save add data
        function insertSj($data,$sj)
        {
            $rr=$this->db->query("select * from sj_h where No_Sj = '$sj'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }

        function insertSj_det($datadet,$sj)
        {
            $this->db->insert('sj_d', $datadet);
        }
        //model untuk get data update
        function getSj($sj)
        {
            $this->db->where($this->primary_key,$sj);
            $q=$this->db->get($this->table_name);
            return $q->result();
        }

        //model untuk save update
        function updateSj($data, $sj)
        {
            $this->db->where('No_Sj',$sj);
            $this->db->update('sj_h', $data);
            return "ok";
        }
        function updateSj_det($datadet,$sj,$nbu)
        {
			$where = "No_Sj = '$sj' AND Barang_SJ = '$nbu'";
			//$this->db->where('No_Sj',$sj);
			$this->db->where($where);
			$this->db->update('sj_d', $datadet);
        }


        //model untuk delete
        function delete($sj)
        {
            $this->db->where('No_Sj',$sj);
            $this->db->delete('sj_h');
            return "ok";
        }

        function delete_det($sj)
        {
            $this->db->where('No_Sj',$sj);
            $this->db->delete('sj_d');
            //return "ok";
        }

        function get_detail_sj($sj){
            $this->db->where('No_Sj',$sj);
            return $this->db->get('sj_d');
        }

        function get_h_sj($sj){
            $q = $this->db->query("SELECT sj_h.*,
                pelanggan.Perusahaan
                FROM sj_h
                LEFT OUTER JOIN pelanggan
                ON sj_h.Kode_Plg = pelanggan.Kode
                WHERE No_Sj = '$sj'");
            return $q->result();
        }

        function get_detail_do($id){
            $q = $this->db->query("SELECT do_d.*,
                barang.Nama, barang.Ukuran
                FROM do_d
                LEFT OUTER JOIN barang
                ON do_d.Kode_Brg = barang.Kode
                WHERE No_Do = '$id'");
            return $q->result();
        }

        function get_do($_do){//ambil data do
            $q = $this->db->query("SELECT do_h.*,
                pelanggan.Perusahaan
                FROM do_h
                LEFT OUTER JOIN pelanggan
                ON do_h.Kode_Plg = pelanggan.Kode
                WHERE No_Do = '$_do'");
            return $q->result();
        }
    }