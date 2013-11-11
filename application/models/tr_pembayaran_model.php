<?php
    class Tr_pembayaran_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_list(){
			$this->db->select('t.*,B.Perusahaan');
        	$this->db->from('pembayaran t');
        	
        	$this->db->join('supplier B', 'B.Kode = t.Kode_supplier', 'left');
			
        	
        	$query = $this->db->get();

        	return $query->result();
        }
        function get_so($id){
        	$this->db->select('A.No_Do, A.Kode_Plg, B.Perusahaan, B.Alamat1');
        	$this->db->from('do_h A');
        	$this->db->join('pelanggan B', 'B.Kode = A.Kode_Plg', 'left');
        	$this->db->where('A.No_Do', $id);
        	$query = $this->db->get();

        	return $query->result();	
        }
        function insert($data,$id)
        {
           
            $query = $this->db->query("Select Kode from pembayaran where Kode = '$id' ");

            if($query->num_rows() ==  0)
            {
                $q=$this->db->insert('pembayaran', $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
		
		function insert_det1($datadet)
        {
            $this->db->insert('pembayaran_d2', $datadet);
        }
		function insert_det2($datadet)
        {
            $this->db->insert('pembayaran_d3', $datadet);
        }
		function insert_det3($datadet)
        {
            $this->db->insert('pembayaran_d', $datadet);
        }
		
        function update($data, $id)
        {
            $this->db->where('Kode',$id);
            $this->db->update('pembayaran', $data);
            return "ok";
        }
                
        function delete_d($id)
        {
            $this->db->where('Kode',$id);
            $this->db->delete('pembayaran_d');
            
        }
		function delete_d2($id)
        {
            $this->db->where('Kode',$id);
            $this->db->delete('pembayaran_d2');
            
        }
		function delete_d3($id)
        {
            $this->db->where('Kode',$id);
            $this->db->delete('pembayaran_d3');
            
        }
		function delete($id)
        {
            $this->db->where('Kode',$id);
            $this->db->delete('pembayaran');
            return "ok";
        }
		function get_po_list($id){
            $query = $this->db->query("
                SELECT *
                FROM po_h
                WHERE Kode_supplier = '$id' 
                ");

            return $query->result();
        }
		function get_invo($invo){//ambil data po
            $q = $this->db->query("SELECT *
                FROM po_h
                WHERE Kode = '$invo' ");
            return $q->result();
        }
		function get_list_po()
        {
            $query = $this->db->query("
                SELECT A.*
                FROM supplier A
                WHERE A.Kode IN (SELECT Kode_supplier FROM po_h)
                ");

            return $query->result();
        }
		
		//bank
		function get_bank_list(){
            $query = $this->db->query("
                SELECT bank_h.kode_bank,nama_bank,bank_d.no_rekening
                FROM bank_h left outer join
				bank_d ON bank_h.kode_bank=bank_d.kode_bank;
               
                ");

            return $query->result();
        }
		function get_rek_list($bank){
            $query = $this->db->query("
                SELECT bank_h.kode_bank,nama_bank,bank_d.no_rekening
                FROM bank_h left outer join
				bank_d ON bank_h.kode_bank=bank_d.kode_bank
                where nama_bank = '$bank';
                ");

            return $query->result();
        }
		function get_detail_po($no){
            $query = $this->db->query("
                SELECT *
                FROM pembayaran_d
				
                where Kode = '$no';
                ");
            return $query->result();
        }
		
		function get_detail_bayar($no){
            $query = $this->db->query("
                SELECT *
                FROM pembayaran_d3
				
                where Kode = '$no';
                ");
            return $query->result();
        }
		
		function get_detail_purc($no){
            $query = $this->db->query("
                SELECT *
                FROM pembayaran_d2
				
                where Kode = '$no';
                ");
            return $query->result();
        }
    }