<?php
    class Tr_invoice_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_list(){
        	$this->db->select('I.*, B.Perusahaan, B.Alamat1');
        	$this->db->from('invoice I');
        	$this->db->join('sj_h D', 'D.No_Sj = I.Kode_SJ');
        	$this->db->join('pelanggan B', 'B.Kode = D.Kode_Plg', 'left');
        	$query = $this->db->get();

        	return $query->result(); 
        }

        function get_h_invoice($id){
            $this->db->select('I.*, B.Perusahaan, B.Alamat1');
            $this->db->from('invoice I');
            $this->db->join('sj_h D', 'D.No_Sj = I.Kode_SJ');
            $this->db->join('pelanggan B', 'B.Kode = D.Kode_Plg', 'left');
            $this->db->where('I.Kode',$id);
            $this->db->limit(1);
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
            $this->db->from('invoice');
            $this->db->where('Kode', $id);
            $query = $this->db->get();

            if($query->num_rows() ==  0)
            {
                $q=$this->db->insert('invoice', $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }

        function get_detail_sj($sj){
            $this->db->select('A.Kode_Brg, A.Barang, A.Barang_SJ, A.Qty1 AS Qty, A.Keterangan,B.Satuan1, B.Nama, B.Ukuran');
            $this->db->from('sj_d A');
            $this->db->join('barang B','B.Kode = A.Kode_Brg');
            $this->db->join('do_d C','C.No_Do = A.Kode_Brg');
            $this->db->where('No_Sj', $sj);
            
            $query = $this->db->get();
            return $query->result();
        }

        function get_h_so($id){
            $q = $this->db->query("SELECT B.No_Do, B.No_Sj, A.Total, A.dpp, A.discount, A.ppn, A.grandttl
                FROM sj_h B
                LEFT OUTER JOIN do_h A
                ON A.No_Do = B.No_Do
                WHERE B.No_Sj = '$id' LIMIT 1");
            return $q->result();
        }

        function get_detail_do($id){
            $this->db->select('sj_h.No_Do, sj_h.No_Sj, do_d.*, barang.Nama, barang.Satuan1');
            $this->db->from('sj_h');
            $this->db->join('do_d','do_d.No_DO = sj_h.No_Do');
            $this->db->join('barang','barang.Kode = do_d.Kode_brg');
            $this->db->where('No_Sj', $id);
            
            $query = $this->db->get();
            return $query->result();
        }

        function update($data, $id)
        {
            $this->db->where('Kode',$id);
            $this->db->update('invoice', $data);
            return "ok";
        }
                
        function delete($id)
        {
            $this->db->where('Kode',$id);
            $this->db->delete('invoice');
            return "ok";
        }
		
		function find($keyword){
            $this->db->like('Kode',$keyword,'after');
            $query=$this->db->get('invoice');
            return $query->result_array();
        }
    }