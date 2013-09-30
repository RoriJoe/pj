<?php
	class combo_model extends CI_MODEL{
        //new
        function list_gudang(){
            $query = $this->db->get('gudang');
            return $query->result();
        }
		
		function list_satuan(){
            $query = $this->db->get('satuan');
            return $query->result();
        }
        
        function list_currency(){
            $query = $this->db->get('currency');
            return $query->result();
        }
        
        function getang()//ambil no sj akhir
        {
            $q=$this->db->query("select * from sj_h order by no_sj desc limit 1");
            return $q->result();
        }

        function getbrg()//ambil no barang akhir
        {
            $q=$this->db->query("select * from barang order by kode desc limit 1");
            return $q->result();
        }
        
        function getpel()//ambil no pelanggan akhir
        {
            $q=$this->db->query("select * from pelanggan order by kode desc limit 1");
            return $q->result();
        }
        
        function getsup()//ambil no pelanggan akhir
        {
            $q=$this->db->query("select * from supplier order by kode desc limit 1");
            return $q->result();
        }
        
        function getgd()//ambil no pelanggan akhir
        {
            $q=$this->db->query("select * from gudang order by kode desc limit 1");
            return $q->result();
        }
        
        function getso()//ambil no so akhir
        {
            $q=$this->db->query("select * from do_h order by no_do desc limit 1");
            return $q->result();
        }
		
		function getbpb()//ambil no bpb akhir
        {
            $q=$this->db->query("select * from bpb_h order by no_bpb desc limit 1");
            return $q->result();
        }
        
        function getpo()//ambil no po akhir
        {
            $q=$this->db->query("select Kode from po_h order by Kode desc limit 1");
            return $q->result();
        }
        function getSaw()//ambil no po akhir
        {
            $q=$this->db->query("select No_Saw from saw_h order by No_Saw desc limit 1");
            return $q->result();
        }
	}