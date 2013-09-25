<?php
    class Tr_po_model extends CI_Model{

        private $primary_key='Kode';
        private $table_name='po_h';

        function __construct(){
            parent::__construct();
        }

        function get_paged_list()
        {
            $q = $this->db->query("SELECT po_h.*,
                supplier.Perusahaan, gudang.Nama
                FROM po_h
                LEFT OUTER JOIN supplier
                ON po_h.Kode_supplier = supplier.Kode
                LEFT OUTER JOIN gudang
                ON po_h.Kode_gudang = gudang.Kode");
            return $q->result();
            
            //$this->db->select('po_h.*, supplier.Perusahaan, gudang.Nama');
            //$this->db->from('po_h');
            //$this->db->join('supplier','supplier.Kode = po_h.Kode_supplier');
            //$this->db->join('gudang','gudang.Kode = po_h.Kode_gudang');
            
            //$query = $this->db->get();
            //return $query->result();
        }
        
        function add_cur($data,$id){
            $rr=$this->db->query("select * from currency where value = '$id'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert('currency', $data);  
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        
        function get_detail_po($id){
            $q = $this->db->query("SELECT po_d.*,
                barang.Nama, barang.Satuan1
                FROM po_d
                LEFT OUTER JOIN barang
                ON po_d.Kode_barang = barang.Kode
                WHERE Kode_po = '$id'");
            return $q->result();
        }
    }
/*
 * End Of File
 * location: model/tr_po_model
 */