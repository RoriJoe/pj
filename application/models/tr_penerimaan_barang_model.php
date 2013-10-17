<?php
    class Tr_penerimaan_barang_model extends CI_Model{

        public $primary_key='No_Bpb';
        public $table_name='bpb_h';
		public $table_detail='bpb_d';

        function __construct(){
            parent::__construct();
        }

        function get_paged_list()
        {
            $q = $this->db->query("
            SELECT bpb_h.*,gudang.Nama, supplier.Perusahaan
			FROM bpb_h
			LEFT OUTER JOIN gudang
			ON bpb_h.Kode_gudang = gudang.Kode 
			LEFT OUTER JOIN supplier
			ON bpb_h.Kode_Supp = supplier.Kode
            ");
            return $q->result();
        }
		
		function get_detail_pb($id){
			$q = $this->db->query("SELECT bpb_d.*,
                barang.Nama, barang.Ukuran
                FROM bpb_d
                LEFT OUTER JOIN barang
                ON bpb_d.Kode_brg = barang.Kode
                WHERE No_Bpb = '$id'");
            return $q->result();
        }

        //model untuk save add data
        function insert($data,$kode)
        {
            $rr=$this->db->query("select * from bpb_h where No_Bpb = '$kode'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
		
		function insert_det($datadet)
        {
            $this->db->insert('bpb_d', $datadet);
            
        }
		

		function update($data, $kode)
        {
            $this->db->where('No_Bpb', $kode);
            $this->db->update('bpb_h', $data);
            return "ok";
        }
		
        function update_det($datadet,$kode,$kb)
        {
			$where = "No_Bpb = '$kode' AND Kode_brg = '$kb'";
			
			$this->db->where($where);
			$this->db->update('bpb_d', $datadet);
        }
		
        //model untuk delete
        function delete($kode)
        {
            $this->db->where('No_Bpb',$kode);
            $this->db->delete('Bpb_h');
            return "ok";
        }
		function delete_det($kode)
        {
            $this->db->where('No_Bpb',$kode);
            $this->db->delete('Bpb_d');
            //return "ok";
        }
    }