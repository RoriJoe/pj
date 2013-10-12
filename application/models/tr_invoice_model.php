<?php
    class Tr_invoice_model extends CI_Model{
        function __construct(){
            parent::__construct();
        }

        function get_list(){
        	$this->db->select('I.*, B.Perusahaan, B.Alamat1');
        	$this->db->from('invoice I');
        	$this->db->join('do_h D', 'D.No_Do = I.Kode_SO');
        	$this->db->join('pelanggan B', 'B.Kode = D.Kode_Plg', 'left');
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
    }