<?php
    class Tr_surat_jalan_model extends CI_Model{

        private $primary_key='No_Sj';
        private $table_name='sj_h';

        function __construct(){
            parent::__construct();
        }

        #Model untuk load table samping
        function get_paged_list()
        {
            $q = $this->db->query("SELECT A.*,
                B.Perusahaan
                FROM sj_h A
                LEFT OUTER JOIN pelanggan B
                ON A.Kode_Plg = B.Kode");
            return $q->result();
        }
		
        //model untuk save add data
        function insertSj($data,$sj)
        {
            $rr=$this->db->query("select No_Sj from sj_h where No_Sj = '$sj' LIMIT 1");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }

        function insertSj_det($datadet,$sj)
        {
            $this->db->insert('sj_d', $datadet);
        }
        //model untuk get data update
        function getSj($sj)
        {
            $this->db->where($this->primary_key,$sj);
            $q=$this->db->get($this->table_name);
            return $q->result();
        }

        //model untuk save update
        function updateSj($data, $sj)
        {
            $this->db->where('No_Sj',$sj);
            $this->db->update('sj_h', $data);
            return "ok";
        }
        //model untuk batal
        function updateBatal($data, $sj)
        {
            $this->db->where('No_Sj',$sj);
            $this->db->update('sj_h', $data);
            return "ok";
        }

        function updateSj_det($datadet,$sj)
        {
            $count1=0;
            $result = $this -> db -> query ("select No from sj_d where No_Sj = '$sj' limit 1");
            $temp = $result->result_array();
            $data['rek'] = $temp[0]['No'];
            
            $count1=0;
            foreach($datadet['Kode_Brg'] as $d)
            {
                $save=array
                (
                    'Kode_Brg' => $datadet['Kode_Brg'][$count1],
                    'Barang'=>$datadet['Barang'][$count1],
                    'Barang_SJ'=>$datadet['Barang_SJ'][$count1],
                    'Qty1'=>$datadet['Qty1'][$count1],
                    'Keterangan'=>$datadet['Keterangan'][$count1]                  
                );
                $this->db->where('No_Sj',$sj);
                $this->db->where('No',$data['rek']);
                $this->db->update('sj_d',$save);
                $count1++;
                $data['rek']++;
            }
        }
		function update_brg($kdbrg,$qty){//SAVE utk kurangin stok opname
			
			$this->db->set('QtyOp', "QtyOp - '$qty'", FALSE);
			$where = "Kode = '$kdbrg' ;";
			
			$this->db->where($where);
			$this->db->update('barang');

		}
		function update_qtytemp($kdbrg,$qty,$do){//SAVE utk kurangin stok TEMP di SO
			
			$this->db->set('QtyTemp', "QtyTemp - '$qty'", FALSE);
			$where = "Kode_Brg = '$kdbrg'";
			$this->db->where($where);
            $this->db->where('No_Do',$do);
			$this->db->update('do_d');
		}
		
		function update_brg2($kdbrg,$qty){//kalo batal
			
			$this->db->set('QtyOp', "QtyOp + '$qty'", FALSE);
			$where = "Kode = '$kdbrg'";
			
			$this->db->where($where);
			$this->db->update('barang');

		}
		
		function update_qtytemp2($kdbrg,$qty,$do){//SAVE utk kembaliin stok TEMP di SO BATAL
			
			$this->db->set('QtyTemp', "QtyTemp + '$qty'", FALSE);
			$where = "Kode_Brg = '$kdbrg'";
			$this->db->where($where);
            $this->db->where('No_Do',$do);
			$this->db->update('do_d');

		}
        //model untuk delete
        function delete($sj)
        {
            $this->db->where('No_Sj',$sj);
            $this->db->delete('sj_h');
            return "ok";
        }

        function delete_det($sj)
        {
            $this->db->where('No_Sj',$sj);
            $this->db->delete('sj_d');
            //return "ok";
        }

        function get_detail_sj($sj){
            $this->db->select('A.Kode_Brg, A.Barang, A.Barang_SJ AS Kode_BrgSj, concat(C.Nama, '.',C.Ukuran) AS Barang_SJ, A.Qty1 AS QtyTemp, A.Keterangan, B.Nama, B.Ukuran', FALSE);
            $this->db->from('sj_d A');
            $this->db->join('barang B','B.Kode = A.Kode_Brg');
            $this->db->join('barang C','C.Kode = A.Barang_SJ', 'left');
            $this->db->where('No_Sj', $sj);
            
            return $this->db->get();
        }

        function get_h_sj($sj){
            $q = $this->db->query("SELECT sj_h.*,
                pelanggan.Perusahaan
                FROM sj_h
                LEFT OUTER JOIN pelanggan
                ON sj_h.Kode_Plg = pelanggan.Kode
                WHERE No_Sj = '$sj' LIMIT 1");
            return $q->result();
        }

        function get_detail_do($id){
            $q = $this->db->query("SELECT do_d.*, do_d.Kode_Brg AS Kode_BrgSj,
                barang.Nama, barang.Ukuran, concat(barang.Nama,' ',barang.Ukuran, ' ',do_d.Keterangan) AS Barang_SJ
                FROM do_d
                LEFT OUTER JOIN barang
                ON do_d.Kode_Brg = barang.Kode
                WHERE No_Do = '$id'");
            return $q->result();
        }

        function get_do($_do){//ambil data do
            $q = $this->db->query("SELECT do_h.*,
                pelanggan.Perusahaan
                FROM do_h
                LEFT OUTER JOIN pelanggan
                ON do_h.Kode_Plg = pelanggan.Kode
                WHERE No_Do = '$_do'");
            return $q->result();
        }

        function get_list()
        {
            $query = $this->db->query("
                SELECT A.*
                FROM pelanggan A
                WHERE A.Kode 
                IN (SELECT Kode_Plg 
                    FROM do_h
                    WHERE do_h.No_Do 
                    NOT IN (SELECT No_Do FROM sj_h)
                    )
                ");

            return $query->result();
        }

        function get_list2()
        {
            $query = $this->db->query("
                SELECT A.Kode, A.Perusahaan, A.Nama, A.Alamat1, A.Lama
                FROM pelanggan A
                WHERE A.Kode IN (SELECT Kode_Plg FROM sj_h)
                ");

            return $query->result();
        }

        function get_so_list($id){ //PILIH SO YG TDK 0 //
				/* SELECT A.No_Do
                FROM do_h A
                WHERE A.Kode_Plg = '$id' AND A.No_Do NOT IN (SELECT No_Do FROM sj_h) */
            $query = $this->db->query("
                SELECT A.No_Do
				FROM do_h A left outer join do_d ON A.No_Do=do_d.No_Do
				WHERE A.Kode_Plg = '$id' AND QtyTemp>0 AND No_Po not like '(BATAL)'
                ");

            return $query->result();
        }

        function get_sj_list($id){
            $query = $this->db->query("
                SELECT A.No_Sj
                FROM sj_h A
                WHERE A.Kode_Plg = '$id' AND A.No_Sj NOT IN (SELECT Kode_SJ FROM invoice) AND No_Do not like '(BATAL)'
                ");

            return $query->result();
        }

        function get_mobil_list(){
            $query = $this->db->query("
                SELECT A.No_mobil
                FROM mobil A
                ");

            return $query->result();
        }

        function get_kirim($id){
            $query = $this->db->query("
                SELECT A.Kirim
                FROM sj_h A
                WHERE A.No_Sj = '$id'
                LIMIT 1
                ");

            return $query->result();
        }

        function update_kirim($datas, $sj)
        {
            $this->db->where('No_Sj',$sj);
            $this->db->update('sj_h', $datas);
            return $sj;
        }
    }