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

        function get_h_so($id){
            $q = $this->db->query("SELECT B.No_Do, B.No_Sj, A.Total, A.dpp, A.discount, A.ppn, A.grandttl
                FROM sj_h B
                LEFT OUTER JOIN do_h A
                ON A.No_Do = B.No_Do
                WHERE B.No_Sj = '$id' LIMIT 1");
            return $q->result();
        }

        function get_detail_sj($id){
            $query = $this->db->query("
                SELECT A.No_Sj, A.Kode_Brg, A.Keterangan, A.Barang,A.Qty1, B.Ukuran,B.Satuan1,D.No_Sj,E.Harga
                FROM sj_d A
                LEFT JOIN barang B ON B.Kode = A.Kode_Brg
                LEFT JOIN sj_h D ON D.No_Sj = A.No_Sj
                LEFT JOIN do_d E ON E.Kode_Brg = A.Barang_SJ
                WHERE E.No_Do = D.No_Do
                AND A.No_Sj = '$id'
            ");
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