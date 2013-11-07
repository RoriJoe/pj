<?php
    class Tr_penerimaan_barang_model extends CI_Model{

        public $primary_key='No_Bpb';
        public $table_name='bpb_h';
		public $table_detail='bpb_d';

        function __construct(){
            parent::__construct();
        }

        function get_paged_list()
        {
            $q = $this->db->query("
            SELECT bpb_h.*,gudang.Nama, supplier.Perusahaan
			FROM bpb_h
			LEFT OUTER JOIN gudang
			ON bpb_h.Kode_gudang = gudang.Kode 
			LEFT OUTER JOIN supplier
			ON bpb_h.Kode_Supp = supplier.Kode
            ");
            return $q->result();
        }
		
		function get_detail_pb($id){
			$q = $this->db->query("SELECT bpb_d.*,
                barang.Nama, barang.Ukuran, barang.Satuan1
                FROM bpb_d
                LEFT OUTER JOIN barang
                ON bpb_d.Kode_brg = barang.Kode
                WHERE No_Bpb = '$id'");
            return $q->result();
        }

        //model untuk save add data
        function insert($data,$kode)
        {
            $rr=$this->db->query("select * from bpb_h where No_Bpb = '$kode'");
            if($rr->num_rows() ==  0)
            {
                $q=$this->db->insert($this->table_name, $data);
                return "ok";
            }else
            {
                return "gagal";
            }
        }
		
		function insert_det($datadet)
        {
            $this->db->insert('bpb_d', $datadet);
            
        }
		//buat update stok fisik
		function update_brg($kdbrg,$qty){
			
			$this->db->set('QtyOp', "QtyOp + '$qty'", FALSE);
			$where = "Kode = '$kdbrg' ;";
			
			$this->db->where($where);
			$this->db->update('barang');

		}
		

		function update($data, $kode)
        {
            $this->db->where('No_Bpb', $kode);
            $this->db->update('bpb_h', $data);
            return "ok";
        }
		
        function update_det($datadet,$kode)
        {
			$count1=0;
            $result = $this -> db -> query ("select Kode from bpb_d where No_Bpb = '$kode' limit 1");
            $temp = $result->result_array();
            $data['rek'] = $temp[0]['Kode'];
            
            $count1=0;
            foreach($datadet['Kode_brg'] as $d)
            {
                $save=array
                (
                    'Kode_brg' => $datadet['Kode_brg'][$count1],
                    'Qty1'=>$datadet['Qty1'][$count1],
                    'Keterangan'=>$datadet['Keterangan'][$count1]                  
                );
                $this->db->where('No_Bpb',$kode);
                $this->db->where('Kode',$data['rek']);
                $this->db->update('bpb_d',$save);
                $count1++;
                $data['rek']++;
            }
        }
		
        //model untuk delete
        function delete($kode)
        {
            $this->db->where('No_Bpb',$kode);
            $this->db->delete('bpb_h');
            return "ok";
        }
		function delete_det($kode)
        {
            $this->db->where('No_Bpb',$kode);
            $this->db->delete('bpb_d');
            //return "ok";
        }

        function get_detail_po($id){
            $q = $this->db->query("SELECT po_d.Kode_barang AS Kode_brg, po_d.Jumlah AS Qty1, po_d.Keterangan,
                barang.Nama, barang.Satuan1, barang.Ukuran, concat(barang.Nama,' ',barang.Ukuran) AS Nama
                FROM po_d
                LEFT OUTER JOIN barang
                ON po_d.Kode_Barang = barang.Kode
                WHERE Kode_po = '$id'");
            return $q->result();
        }

        function get_detail_poData($id){
            $query = $this->db->query("SELECT B.Kode AS Kode_sup, B.Perusahaan ,C.Nama, C.Kode AS Kode_gud
                FROM po_h A
                LEFT JOIN supplier B ON B.Kode = A.Kode_supplier
                LEFT JOIN gudang C ON C.Kode = A.Kode_gudang
                WHERE A.Kode = '$id'
                LIMIT 1");
            return $query->result();
        }

        function get_po_list(){
            $query = $this->db->query("
                SELECT A.Kode
                FROM po_h A
                WHERE A.Kode NOT IN (SELECT No_Po FROM bpb_h)
                ");

            return $query->result();
        }
    }