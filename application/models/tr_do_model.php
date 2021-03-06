<?php
    class Tr_do_model extends CI_Model{

        private $primary_key='No_Do';
        private $table_name='do_h';

        function __construct(){
            parent::__construct();
        }

        function get_paged_list()
        {
            $q = $this->db->query("SELECT do_h.No_Do,
                pelanggan.Perusahaan
                FROM do_h
                LEFT OUTER JOIN pelanggan
                ON do_h.Kode_Plg = pelanggan.Kode");
            return $q->result();
        }

        function get_h_so($id){
            $q = $this->db->query("SELECT do_h.*,
                pelanggan.Perusahaan, pelanggan.Lama
                FROM do_h
                LEFT OUTER JOIN pelanggan
                ON do_h.Kode_Plg = pelanggan.Kode
                WHERE No_Do = '$id' LIMIT 1");
            return $q->result();
        }

        function get_detail_do($id){
            $this->db->select('do_d.*, barang.Nama, barang.Ukuran, barang.Satuan1, barang.Qty1');
            $this->db->from('do_d');
            $this->db->join('barang','barang.Kode = do_d.Kode_brg');
            $this->db->where($this->primary_key, $id);
            
            $query = $this->db->get();
            return $query->result();
        }

        function find($keyword){
            $this->db->like('No_Do',$keyword,'after');
            $query=$this->db->get('do_h');
            return $query->result_array();
        }
		
		function insertDo($data,$so)
        {
            $rr=$this->db->query("select * from do_h where No_Do = '$so'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        
        function insertDo_det($datadet,$so)
        {
            $this->db->insert('do_d', $datadet);
        }
		
		//update stok jual
		function update_brg($kdbrg,$qty){
			
			$this->db->set('Qty1', "Qty1 - '$qty'", FALSE);
			$where = "Kode = '$kdbrg' ;";
			
			$this->db->where($where);
			$this->db->update('barang');

		}

        function updateTerm($term,$pl){
            $this->db->where('Kode',$pl);
            $this->db->update('pelanggan', $term);
        }
		
		
		function updateDo($data, $so)
        {
            $this->db->where('No_Do',$so);
            $this->db->update('do_h', $data);
            return "ok";
        }
		
        function updateDo_det($datadet,$kode)
        {
			$count1=0;
            $result = $this -> db -> query ("select No from do_d where No_Do = '$kode' limit 1");
            $temp = $result->result_array();
            $data['rek'] = $temp[0]['No'];

            $count1=0;
            foreach($datadet['Kode_Brg'] as $d)
            {
                $save=array
                (
                    'Kode_Brg' => $datadet['Kode_Brg'][$count1],
                    'Qty'=>$datadet['Qty'][$count1],
                    'Harga'=>$datadet['Harga'][$count1],
                    'Jumlah'=>$datadet['Jumlah'][$count1],
                    'Keterangan'=>$datadet['Keterangan'][$count1]                  
                );
                $this->db->where('No_Do',$kode);
                $this->db->where('No',$data['rek']);
                $this->db->update('do_d',$save);
                $count1++;
                $data['rek']++;
            }
        }

        function update_qty_brg($arrKode,$arrReQty){
            
            $this->db->set('Qty1', "'$arrReQty'", FALSE);
            $where = "Kode = '$arrKode' ;";
            
            $this->db->where($where);
            $this->db->update('barang');
        }
		
		function update_brg2($arrKode,$arrQty){//kalo batal
			
			$this->db->set('Qty1', "Qty1 + '$arrQty'", FALSE);
			$where = "Kode = '$arrKode' ;";
			
			$this->db->where($where);
			$this->db->update('barang');

		}
		//model untuk batal
        function updateBatal($data, $so)
        {
            $this->db->where('No_Do',$so);
            $this->db->update('do_h', $data);
            return "ok";
        }
		
		function delete($so)
        {
            $this->db->where('No_Do',$so);
            $this->db->delete('do_h');
            return "ok";
        }
		function delete_det($so)
        {
            $this->db->where('No_Do',$so);
            $this->db->delete('do_d');
            //return "ok";
        }

        function delete_update_det($datadet,$kode){
            $q = $this->db->query("
                DELETE FROM do_d
                WHERE No_Do = '$kode' AND Kode_Brg NOT IN ('".join("','", $datadet['Kode_Brg'])."')
            ");
            return $query->result(); 
        }
        function view(){
            $this->db->select('A.No_Do, A.Tgl, A.Total, A.Kode_Plg, B.Perusahaan, B.Alamat1');
            $this->db->from('do_h A');
            $this->db->join('pelanggan B', 'B.Kode = A.Kode_Plg', 'left');
            $query = $this->db->get();

            return $query->result();    
        }
    }