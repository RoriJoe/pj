<?php
    class Tr_po_model extends CI_Model{

        private $primary_key='Kode';
        private $table_name='po_h';

        function __construct(){
            parent::__construct();
        }

        function get_paged_list()
        {
            $q = $this->db->query("SELECT po_h.Kode, po_h.Tgl_po,
                supplier.Perusahaan
                FROM po_h
                LEFT OUTER JOIN supplier
                ON po_h.Kode_supplier = supplier.Kode
                ORDER BY po_h.Tgl_po DESC");

            return $q->result();
        }

        function get_h_po($id){
            $q = $this->db->query("SELECT po_h.*,
                supplier.Perusahaan, gudang.Nama
                FROM po_h
                LEFT OUTER JOIN supplier
                ON po_h.Kode_supplier = supplier.Kode
                LEFT OUTER JOIN gudang
                ON po_h.Kode_gudang = gudang.Kode
                WHERE po_h.Kode = '$id' LIMIT 1");
            return $q->result();
        }
        
		function find($keyword){
            $this->db->like('Kode',$keyword,'after');
            $query=$this->db->get('po_h');
            return $query->result_array();
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
                barang.Nama, barang.Satuan1, barang.Ukuran
                FROM po_d
                LEFT OUTER JOIN barang
                ON po_d.Kode_barang = barang.Kode
                WHERE Kode_po = '$id'");
            return $q->result();
        }

        function insertPo($data,$po)
        {
            $rr=$this->db->query("select Kode from po_h where Kode = '$po'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        
        function insertPo_det($datadet,$po)
        {
            $this->db->insert('po_d', $datadet);
        }
        //update stok jual
		function update_brg($kdbrg,$qty){
			
			$this->db->set('Qty1', "Qty1 + '$qty'", FALSE);
			$where = "Kode = '$kdbrg' ;";
			
			$this->db->where($where);
			$this->db->update('barang');

		}
        
        function updatePo($data, $po)
        {
            $this->db->where('Kode',$po);
            $this->db->update('po_h', $data);
            return "ok";
        }

        function updatePo_det($datadet,$kode)
        {
			$count1=0;
            $result = $this -> db -> query ("select No from po_d where Kode_po = '$kode' limit 1");
            $temp = $result->result_array();
            $data['rek'] = $temp[0]['No'];

            $count1=0;
            foreach($datadet['Kode_barang'] as $d)
            {
                $save=array
                (
                    'Kode_barang' 	=>$datadet['Kode_barang'][$count1],
                    'Jumlah'		=>$datadet['Jumlah'][$count1],
                    'Harga'			=>$datadet['Harga'][$count1],
                    'Nilai'			=>$datadet['Nilai'][$count1],                 
                );
                $this->db->where('Kode_po',$kode);
                $this->db->where('No',$data['rek']);
                $this->db->update('po_d',$save);
                $count1++;
                $data['rek']++;
            }
        }
                
        function delete($po)
        {
            $this->db->where('Kode',$po);
            $this->db->delete('po_h');
            return "ok";
        }
        function delete_det($po)
        {
            $this->db->where('Kode_po',$po);
            $this->db->delete('po_d');
            //return "ok";
        }

        function get_kirim($id){
            $query = $this->db->query("
                SELECT A.Counter
                FROM po_h A
                WHERE A.Kode = '$id'
                LIMIT 1
                ");

            return $query->result();
        }

        function update_kirim($datas, $id)
        {
            $this->db->where('Kode',$id);
            $this->db->update('po_h', $datas);
            return $id;
        }
    }
/*
 * End Of File
 * location: model/tr_po_model
 */