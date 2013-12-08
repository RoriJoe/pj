<?php
	
	class mperkiraan extends CI_Model{
		
		
		function __construct(){
			parent::__construct();
		}
		
		function getalllistsearch($by,$val,$limit,$offset){
			$rs=$this->db->query("select nomoraccount,namaaccount,type,level from perkiraan where $by like '%$val%' limit $offset,$limit");
			return $rs;
		}
		function countallsearch($by,$val){
			$rs=$this->db->query("select count(*) as jum from perkiraan where $by like '%$val%'");
			$jum=0;
			foreach($rs->result() as $row){
				$jum=$row->jum;
			}
			return $jum;
		}
		
		function getselect($kode){
			$rs=$this->db->query("select * from perkiraan where nomoraccount='$kode'");
			return $rs;
		}
		
		function deleteperkiraan($NoAc){
			$cek = $this->db->query("select P.nomoraccount from perkiraan P join detailjurnal DJ on P.nomoraccount=DJ.nomoraccount where P.nomoraccount='$NoAc'");
			if($cek->num_rows() >0){
				echo '<font >Nomor Perkiraan Telah Di jurnal, Tidak Dapat Dihapus';
			}else
				$rs=$this->db->query("delete from perkiraan where nomoraccount='$NoAc'");
		}
		
		function insertperkiraan($NoAc,$NamaPer,$Level,$Type,$NilaiSaldo,$Tgl){
			$Tglb = strtotime($Tgl);
			$TglSaldoAwl = date('Y-m-d', $Tglb);
			$rs=$this->db->query("insert into perkiraan values('$NoAc','$NamaPer','$Level','$Type','".date("Y-m-d")."','".$this->session->userdata('wahanalogrole')."','$TglSaldoAwl','$NilaiSaldo')");
			
		}
		
		function updateperkiraan($NoAc,$NamaPer,$Level,$Type,$NilaiSaldo,$kode,$Tgl){
			$Tglb = strtotime($Tgl);
			$TglSaldoAwl = date('Y-m-d', $Tglb);
			$rs=$this->db->query("update perkiraan set nomoraccount='$NoAc',namaaccount='$NamaPer',level='$Level',type='$Type',tanggalentry='".date("Y-m-d")."',kodekaryawan='".$this->session->userdata("wahanalogrole")."',saldo='$NilaiSaldo',tanggalsaldoawal='$TglSaldoAwl' where nomoraccount='$kode'");
		}
		
		function CekAcc($val){
			$this->db->select('nomoraccount');
			$this->db->where('nomoraccount',$val);
			if($_POST['FlagAc']==2){
				$this->db->where_not_in('nomoraccount',$_POST['Kode']);
			}
			$rs=$this->db->get('perkiraan');
			
			if($rs->num_rows() < 1)
				return 0;
			else
				return 1;
		}
		
	}
?>