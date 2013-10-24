<?php
class report_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	
	function print_do($radio,$tgl,$tgl2){
	
/*SELECT do_h.*,
			pelanggan.Nama
			FROM do_h
			LEFT OUTER JOIN pelanggan
			ON do_h.Kode_Plg = pelanggan.Kode*/
			
			if($radio=="Semua"){
			$q = $this->db->query("SELECT do_d.No_Do, do_h.No_Po, pelanggan.Nama as NP, barang.Nama, Ukuran, Qty, Satuan1
			FROM do_d
			LEFT OUTER JOIN do_h ON do_d.No_Do = do_h.No_Do
			LEFT OUTER JOIN pelanggan ON do_h.Kode_Plg = pelanggan.Kode
			LEFT OUTER JOIN barang ON do_d.Kode_Brg = barang.Kode
			");
			return $q->result();
			}else{
			$q = $this->db->query("SELECT do_d.No_Do, do_h.No_Po, pelanggan.Nama as NP, barang.Nama, Ukuran, Qty, Satuan1
			FROM do_d
			LEFT OUTER JOIN do_h ON do_d.No_Do = do_h.No_Do
			LEFT OUTER JOIN pelanggan ON do_h.Kode_Plg = pelanggan.Kode
			LEFT OUTER JOIN barang ON do_d.Kode_Brg = barang.Kode
			where do_h.Tgl between ('$tgl') and ('$tgl2')");
			return $q->result();
			}
	
	}
	
	function print_sj($radio,$tgl,$tgl2){
		if($radio=="Semua"){
		$q = $this->db->query("SELECT sj_h.No_Sj, sj_h.No_Do, pelanggan.Perusahaan as NP,sj_h.No_Mobil ,barang.Nama, Ukuran, sj_d.Qty1, Satuan1
				FROM sj_h
				LEFT OUTER JOIN sj_d ON sj_h.No_Sj = sj_d.No_Sj
				LEFT OUTER JOIN pelanggan ON sj_h.Kode_Plg = pelanggan.Kode
				LEFT OUTER JOIN barang ON sj_d.Kode_Brg = barang.Kode");
				return $q->result();
		}else{
		$q = $this->db->query("SELECT sj_h.No_Sj, sj_h.No_Do, pelanggan.Perusahaan as NP,sj_h.No_Mobil ,barang.Nama, Ukuran, sj_d.Qty1, Satuan1
			FROM sj_h
			LEFT OUTER JOIN sj_d ON sj_h.No_Sj = sj_d.No_Sj
			LEFT OUTER JOIN pelanggan ON sj_h.Kode_Plg = pelanggan.Kode
			LEFT OUTER JOIN barang ON sj_d.Kode_Brg = barang.Kode
			where Tgl between ('$tgl') and ('$tgl2')");
			return $q->result();
		}
	}
	
	function print_penerimaan($radio,$tgl,$tgl2){
		if($radio=="Semua"){
		$q = $this->db->query("SELECT bpb_h.Tgl_Bpb, bpb_h.No_Bpb, supplier.Nama as NS,bpb_h.No_Reff ,barang.Nama, Ukuran, bpb_d.Qty1, Satuan1
			FROM bpb_h
			LEFT OUTER JOIN bpb_d ON bpb_h.No_Bpb = bpb_d.No_Bpb
			LEFT OUTER JOIN supplier ON bpb_h.Kode_Supp = supplier.Kode
			LEFT OUTER JOIN barang ON bpb_d.Kode_Brg = barang.Kode");
			return $q->result();
		}else{
		$q = $this->db->query("SELECT bpb_h.Tgl_Bpb, bpb_h.No_Bpb, supplier.Nama as NS,bpb_h.No_Reff ,barang.Nama, Ukuran, bpb_d.Qty1, Satuan1
			FROM bpb_h
			LEFT OUTER JOIN bpb_d ON bpb_h.No_Bpb = bpb_d.No_Bpb
			LEFT OUTER JOIN supplier ON bpb_h.Kode_Supp = supplier.Kode
			LEFT OUTER JOIN barang ON bpb_d.Kode_Brg = barang.Kode
			where Tgl_Bpb between ('$tgl') and ('$tgl2')");
			return $q->result();
		}
	}
	
	function print_kartustock($barang1,$barang2){ //Sementara
		
		$q = $this->db->query("
		
SELECT Kode,saw_h.Tgl as tglsaw, Nama, Ukuran, Nama2,Satuan1,QtySaw1 as SAW, SUM(bpb_d.Qty1) as terima,SUM(sj_d.Qty1) as keluar
		
    from barang 
	
    LEFT OUTER JOIN saw_d ON barang.Kode = saw_d.Kd_Brg
	LEFT OUTER JOIN saw_h ON saw_d.No_Saw = saw_h.No_Saw
    LEFT OUTER JOIN bpb_d ON barang.Kode = bpb_d.Kode_brg
    LEFT OUTER JOIN sj_d ON barang.Kode = sj_d.Kode_brg
    where Kode between '$barang1' and '$barang2'
    group by barang.Kode;");
				return $q->result();
		
	}
	
	function print_mutasi($barang1,$barang2,$tgl,$tgl2){ 
		
		$q = $this->db->query("SELECT Kode, Nama, Ukuran, Nama2,Satuan1,
SAW.saldoawal as saw,
bpb.terima as terima,
sj.kirim as keluar

		
    from barang 
	LEFT outer JOIN 
        ( Select a.Kd_Brg,SUM(a.QtySaw1) as saldoawal
        from saw_d as a
        Inner JOIN saw_h as b ON a.No_Saw=b.No_Saw
        where (b.Tgl between '$tgl' and '$tgl2')
        group by a.Kd_Brg
        ) as SAW ON barang.Kode = SAW.Kd_Brg
        LEFT outer JOIN
        (Select a.Kode_brg,SUM(a.Qty1) as terima
        from bpb_d as a
        INNER JOIN bpb_h as b ON a.No_Bpb=b.No_Bpb
        where (b.Tgl_Bpb between '$tgl' and '$tgl2')
        group by a.Kode_brg
        ) as bpb ON barang.Kode = bpb.Kode_brg
    	LEFT Outer Join
    	(Select a.Kode_Brg,SUM(a.Qty1) as kirim
        from sj_d as a
        INNER JOIN sj_h as b ON a.No_Sj=b.No_Sj
        where (b.Tgl between '$tgl' and '$tgl2')
        group by a.Kode_Brg
        ) as sj ON barang.Kode = sj.Kode_Brg
        
   
    where Kode between '$barang1' and '$barang2'
    order by barang.Kode;");
				return $q->result();
		
	}
	
	function print_os(){ //Sementara
		
		$q = $this->db->query("SELECT do_d.No_Do, pelanggan.Perusahaan as NP, do_h.Tgl, barang.Nama, Ukuran, Qty, Satuan1
			FROM do_d
			LEFT OUTER JOIN do_h ON do_d.No_Do = do_h.No_Do
			LEFT OUTER JOIN pelanggan ON do_h.Kode_Plg = pelanggan.Kode
			LEFT OUTER JOIN barang ON do_d.Kode_Brg = barang.Kode
		");
				return $q->result();
		
	}
	
	function print_master_barang(){
		$q = $this->db->query("SELECT * from barang ");
		return $q->result();
	}
	
	function print_master_pelanggan(){
		$q = $this->db->query("SELECT * from pelanggan ");
		return $q->result();
	}
	function print_master_supplier(){
		$q = $this->db->query("SELECT * from supplier ");
		return $q->result();
	}
	function print_master_gudang(){
		$q = $this->db->query("SELECT * from gudang ");
		return $q->result();
	}
	
}
?>