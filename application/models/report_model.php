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
		$q = $this->db->query("SELECT sj_h.No_Sj, sj_h.No_Do, pelanggan.Nama as NP,sj_h.No_Mobil ,barang.Nama, Ukuran, sj_d.Qty1, Satuan1
				FROM sj_h
				LEFT OUTER JOIN sj_d ON sj_h.No_Sj = sj_d.No_Sj
				LEFT OUTER JOIN pelanggan ON sj_h.Kode_Plg = pelanggan.Kode
				LEFT OUTER JOIN barang ON sj_d.Kode_Brg = barang.Kode");
				return $q->result();
		}else{
		$q = $this->db->query("SELECT sj_h.No_Sj, sj_h.No_Do, pelanggan.Nama as NP,sj_h.No_Mobil ,barang.Nama, Ukuran, sj_d.Qty1, Satuan1
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
	
	
	function print_mutasi($barang1,$barang2){ //Sementara
		
		$q = $this->db->query("SELECT Kode, Nama, Ukuran from barang where Kode between '$barang1' and '$barang2';");
				return $q->result();
		
	}
	
	function print_os(){ //Sementara
		
		$q = $this->db->query("SELECT do_d.No_Do, pelanggan.Nama as NP, barang.Nama, Ukuran, Qty, Satuan1
			FROM do_d
			LEFT OUTER JOIN do_h ON do_d.No_Do = do_h.No_Do
			LEFT OUTER JOIN pelanggan ON do_h.Kode_Plg = pelanggan.Kode
			LEFT OUTER JOIN barang ON do_d.Kode_Brg = barang.Kode
		");
				return $q->result();
		
	}
}
?>