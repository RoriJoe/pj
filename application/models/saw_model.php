<?php
    class Saw_model extends CI_Model{

        function __construct(){
            parent::__construct();
        }

        function get_list()
        {
            $q = $this->db->query("
                SELECT saw_h.*,gudang.Nama
    			FROM saw_h
    			LEFT OUTER JOIN gudang
    			ON saw_h.Kd_gudang = gudang.Kode");
            return $q->result();
        }

        function get_detail($id){
            $q = $this->db->query("SELECT saw_d.*,
                barang.Nama, barang.Ukuran, barang.Satuan1
                FROM saw_d
                LEFT OUTER JOIN barang
                ON saw_d.Kd_Brg = barang.Kode
                WHERE No_Saw = '$id'");
            return $q->result();
        }
		
		function get_barang(){
            $q = $this->db->query("
                select Kode,Ukuran,Nama,Satuan1,QtyOp,'' AS QtySaw1 
                from barang 
                ORDER BY CONCAT(Nama, Ukuran) ASC
            ");
            return $q->result();
        }

        function get_allbarang($id){
            $q = $this->db->query("SELECT saw_d.No_Saw, barang.Kode, saw_d.QtySaw1,barang.Nama, barang.Ukuran, barang.Satuan1, barang.QtyOp 
                FROM saw_d
                LEFT JOIN barang ON saw_d.Kd_Brg = barang.Kode
                WHERE saw_d.No_Saw ='$id'
                UNION 
                SELECT saw_d.No_Saw, barang.Kode, saw_d.QtySaw1,barang.Nama, barang.Ukuran, barang.Satuan1, barang.QtyOp
                FROM saw_d
                RIGHT JOIN barang ON saw_d.Kd_Brg = barang.Kode
                ");
            return $q->result();
        }

        function get_qtybarang($id){
            $q = $this->db->query("SELECT saw_d.No_Saw, saw_d.Kd_Brg AS Kode, saw_d.QtySaw1,
                barang.Nama, barang.Ukuran, barang.Satuan1, barang.QtyOp
                FROM saw_d
                LEFT OUTER JOIN barang
                ON saw_d.Kd_Brg = barang.Kode
                WHERE No_Saw = '$id'");
            return $q->result();
        }

        function get_noqtybarang($id){
            $q = $this->db->query("SELECT Kode,Ukuran,Nama,Satuan1,QtyOp,'' AS QtySaw1 
                FROM barang
                WHERE barang.Kode NOT IN (SELECT Kd_Brg FROM saw_d WHERE No_Saw = '$id')");
            return $q->result();
        }

        function insert($data,$kode)
        {
            $rr=$this->db->query("select * from saw_h where No_Saw = '$kode' LIMIT 1");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert('saw_h', $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
        
        function insert_det($datadet)
        {
            $this->db->insert('saw_d', $datadet);
            
        }

        function update_det($datadet,$kode){
            $count1=0;
            $result = $this -> db -> query ("select No from saw_d where No_Saw = '$kode' limit 1");
            $temp = $result->result_array();
            $data['rek'] = $temp[0]['No'];

            $count1=0;
            foreach($datadet['Kd_Brg'] as $d)
            {
                $save=array
                (
                    'Kd_Brg' => $datadet['Kd_Brg'][$count1],
                    'QtySaw1'=>$datadet['QtySaw1'][$count1],              
                );
                $this->db->where('No_Saw',$kode);
                $this->db->where('No',$data['rek']);
                $this->db->update('saw_d',$save);
                $count1++;
                $data['rek']++;
            }
        }

		function update_brg($kdbrg,$qty){

			$this->db->set('Qty1', "Qty1 + '$qty'", FALSE);
			$this->db->set('QtyOp', "QtyOp + '$qty'", FALSE);
            //$this->db->set('Tgl_Saw', $tgl, FALSE);
			$where = "Kode = '$kdbrg' ;";
			
			$this->db->where($where);
			$this->db->update('barang');
		}
        

        function update($data, $kode)
        {
            $this->db->where('No_Saw', $kode);
            $this->db->update('saw_h', $data);
            return "ok";
        }

        //model untuk delete
        function delete($kode)
        {
            $this->db->where('No_Saw',$kode);
            $this->db->delete('saw_h');
            return "ok";
        }
        function delete_det($kode)
        {
            $this->db->where('No_Saw',$kode);
            $this->db->delete('saw_d');
            //return "ok";
        }
    }