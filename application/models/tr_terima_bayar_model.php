<?php
    class Tr_terima_bayar_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_list(){
			$this->db->select('t.*,B.Nama');
        	$this->db->from('terima_bayar t');
        	
        	$this->db->join('pelanggan B', 'B.Kode = t.Kode_plg', 'left');
			
        	
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
            $this->db->select('Kode');
            $this->db->from('terima_bayar');
            $this->db->where('Kode', $id);
            $query = $this->db->get();

            if($query->num_rows() ==  0)
            {
                $q=$this->db->insert('terima_bayar', $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
		
		function insert_det1($datadet)
        {
            $this->db->insert('terima_byr_d2', $datadet);
        }
		function insert_det2($datadet)
        {
            $this->db->insert('terima_byr_d3', $datadet);
        }
		function insert_det3($datadet)
        {
            $this->db->insert('terima_byr_d', $datadet);
        }
		
        function update($data, $id)
        {
            $this->db->where('Kode',$id);
            $this->db->update('invoice', $data);
            return "ok";
        }
                
        function delete_d($id)
        {
            $this->db->where('Kode',$id);
            $this->db->delete('terima_byr_d');
            
        }
		function delete_d2($id)
        {
            $this->db->where('Kode',$id);
            $this->db->delete('terima_byr_d2');
            
        }
		function delete_d3($id)
        {
            $this->db->where('Kode',$id);
            $this->db->delete('terima_byr_d3');
            
        }
		function delete($id)
        {
            $this->db->where('Kode',$id);
            $this->db->delete('terima_bayar');
            return "ok";
        }
		function get_invoice_list($id){
            $query = $this->db->query("
                SELECT *
                FROM invoice
                WHERE Kode_Plg = '$id' 
                ");

            return $query->result();
        }
		function get_invo($invo){//ambil data do
            $q = $this->db->query("SELECT *
                FROM invoice
                WHERE Kode = '$invo' ");
            return $q->result();
        }
		function get_list_inv()
        {
            $query = $this->db->query("
                SELECT A.*
                FROM pelanggan A
                WHERE A.Kode IN (SELECT Kode_plg FROM invoice)
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
		function get_detail_invo($no){
            $query = $this->db->query("
                SELECT *
                FROM terima_byr_d
				
                where Kode = '$no';
                ");
            return $query->result();
        }
		
		function get_detail_bayar($no){
            $query = $this->db->query("
                SELECT *
                FROM terima_byr_d3
				
                where Kode = '$no';
                ");
            return $query->result();
        }
		
		function get_detail_invoic($no){
            $query = $this->db->query("
                SELECT *
                FROM terima_byr_d2
				
                where Kode = '$no';
                ");
            return $query->result();
        }
    }