<?php
	
	class mjurnal extends CI_Model{
		
		
		function __construct(){
			parent::__construct();
		}
		
		function getalllistsearch($by,$val,$limit,$offset){
			$rs=$this->db->query("select novoucher,tanggal,kodekaryawan from jurnal where $by like '%$val%' limit $offset,$limit");
			return $rs;
		}
		
		function getPopUp(){
			$rs=$this->db->query("select nomoraccount,type,namaaccount,saldo,level from perkiraan where level = (select MAX(level) from perkiraan)");
			return $rs;
		}
		function getPopUpSearch($by,$val){
			$rs=$this->db->query("select nomoraccount,type,namaaccount,saldo,level from perkiraan where level = (select MAX(level) from perkiraan) and $by like '%$val%'");
			return $rs;
	
		}
		function countPopUp(){
			$rs=$this->db->query("select count(*) as jum from perkiraan");
			$jum=0;
			foreach($rs->result() as $row){
				$jum=$row->jum;
			}
			return $jum;
		}
		function countallsearchPopup($by,$val){
			$rs=$this->db->query("select count(*) as jum from perkiraan where $by like '%$val%'");
			$jum=0;
			foreach($rs->result() as $row){
				$jum=$row->jum;
			}
			return $jum;
		}
		function countallsearch($by,$val){
			$rs=$this->db->query("select count(*) as jum from jurnal where $by like '%$val%'");
			$jum=0;
			foreach($rs->result() as $row){
				$jum=$row->jum;
			}
			return $jum;
		}
		
		function getselect($kode){
			$rs=$this->db->query("select * from jurnal where novoucher='$kode'");
			return $rs;
		}
		function saveheader($NoAk,$Tgl,$Uid){
			$Tglb = strtotime($Tgl);
			$NTgl = date('Y-m-d', $Tglb);
			$rs=$this->db->query("insert into jurnal values('$NoAk','$NTgl','$Uid')");
		}
		function Updateheader($NoAk,$Tgl,$Uid){
			$Tglb = strtotime($Tgl);
			$NTgl = date('Y-m-d', $Tglb);
			$rs=$this->db->query("update jurnal set tanggal='$NTgl',kodekaryawan='$Uid' where novoucher='$NoAk' ");
		}
		function deleteheader($No){
			$rs=$this->db->query("delete from jurnal where novoucher=$No");
			$this->deletedetail($No);
		}
		function savedetail($id,$NoAk,$ket,$Db,$Kr){
			$rs=$this->db->query("insert into detailjurnal (novoucher,nomoraccount,keterangan,debit,kredit) values('$id','$NoAk','$ket','$Db','$Kr')");
		}
		function deletedetail($id){
			$rs=$this->db->query("delete from detailjurnal where novoucher=$id");
		}
		
		function updatener($NoAc,$NamaPer,$Level,$Type,$NilaiSaldo,$kode){
			$rs=$this->db->query("update perkiraan set novoucher='$NoAc',namaaccount='$NamaPer',level='$Level',type='$Type',tanggalentry='".date("Y-m-d")."',kodekaryawan='".$this->session->userdata("account_id")."',saldo='$NilaiSaldo',tanggalsaldoawal='".date("Y-m-d")."' where nomoraccount='$kode'");
		}
		function generateid($from,$fieldname)
		{
			$this->db->select($fieldname);
			$this->db->order_by($fieldname,"desc");
			$hasil=$this->db->get($from,1);
			if($hasil->num_rows()>0)
				return $hasil->result();
			else return false;
		}
		function GetTableJurnal($kode){
			$rs=$this->db->query("select DJ.nomoraccount,keterangan,debit,kredit,namaaccount from detailjurnal as DJ join perkiraan as P on DJ.nomoraccount=P.nomoraccount where novoucher='$kode'");
			return $rs->result();
		}
		function GetDetailJurCtk(){
			$rs=$this->db->query("select DJ.nomoraccount,keterangan,debit,kredit,namaaccount,tanggal,namaaccount,DJ.novoucher from detailjurnal as DJ join perkiraan as P on DJ.nomoraccount=P.nomoraccount join jurnal as J on J.novoucher = DJ.novoucher ORDER BY tanggal,J.novoucher");
			return $rs->result();
		}
		function SearchDetailJurCtk($TglAwl,$TglAkhr,$NoVo1,$NoVo2){
		
			$Tgla = strtotime($TglAwl);
			$Tglb = strtotime($TglAkhr);
			$TglAwlb = date('Y-m-d', $Tgla);
			$TglAkhrb = date('Y-m-d', $Tglb);
		
			$rs=$this->db->query("select DJ.nomoraccount,keterangan,debit,kredit,namaaccount,tanggal,namaaccount,DJ.novoucher from detailjurnal as DJ join perkiraan as P on DJ.nomoraccount=P.nomoraccount join jurnal as J on J.novoucher = DJ.novoucher
			where (tanggal between '$TglAwlb' and '$TglAkhrb') and (J.novoucher between '$NoVo1' and '$NoVo2') ORDER BY tanggal,J.novoucher");
			if($rs->num_rows >0)
				return $rs->result();
			else
				return false;
		}
		
		function GetTglJurnal($Sort){
			$rs = $this->db->query("select $Sort(tanggal) as tanggal from jurnal");
			if($rs->num_rows >0){
					foreach($rs->result() as $Hrs){
						return $Hrs->tanggal;
					}
			}else
				return false;
		}
		
		function GetComboJurnal(){
			$rs = $this->db->query("select novoucher from jurnal");
			if($rs->num_rows >0)
				return $rs->result();
			else
				return false;
		}
		function GetMMJurnal($Sort){
			$rs = $this->db->query("select $Sort(novoucher) as novoucher from jurnal");
			if($rs->num_rows >0){
					foreach($rs->result() as $Hrs){
						return $Hrs->novoucher;
					}
			}else
				return false;
		}
	}