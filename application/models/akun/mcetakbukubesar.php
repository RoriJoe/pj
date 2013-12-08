<?php
	
	class mcetakbukubesar extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function SearchBukuBesar($TglAwl,$TglAkhr,$NoVo1,$NoVo2){
			$Tgla = strtotime($TglAwl);
			$Tglb = strtotime($TglAkhr);
			$TglAwlb = date('Y-m-d', $Tgla);
			$TglAkhrb = date('Y-m-d', $Tglb);
		
			$rs=$this->db->query("(select P.nomoraccount,namaaccount,saldo,debit,kredit,keterangan,tanggal,tanggalsaldoawal from perkiraan P join detailjurnal DJ on P.nomoraccount=DJ.nomoraccount join jurnal J on DJ.novoucher=J.novoucher where level=(select max(level) from perkiraan) and saldo<>0 and tanggal between '$TglAwlb' and '$TglAkhrb' and J.novoucher between '$NoVo1' and '$NoVo2')");
			return $rs->result();
		}
		function GetTable($kode){
			$rs = $this->db->query("SELECT namatabel, DF.nama, MM.nama AS tipe, debitkredit, M.nama AS namamenu
				FROM detailmapperkiraan MP
				JOIN detailmapfield DF ON DF.idfield = MP.idfield
				JOIN detailmaptabel DT ON DT.idtab = DF.idtab
				JOIN menu M ON M.id = DT.id
				JOIN menu MM ON M.parentid = MM.id
				WHERE nomoraccount =  '$kode'");
			if($rs->num_rows >0)
				return $rs->result();
			else
				return false;
		
		}
		function GetOther($namatabel,$field){
			$rs = $this->db->query('select sum('.$field.') as total from '.$namatabel.'');
			if($rs->num_rows >0)
				return $rs->result();
			else
				return false;
		
		}
		
		
		function GetTglPer($Sort){
			$rs = $this->db->query("select $Sort(tanggal) as tanggal from jurnal");
			if($rs->num_rows >0){
					foreach($rs->result() as $Hrs){
						return $Hrs->tanggal;
					}
			}else
				return false;
		}
		
		function GetMMJurnal($Sort){
			$rs = $this->db->query("select $Sort(nomoraccount) as nomoraccount from perkiraan where level = (select max(level) from perkiraan)");
			if($rs->num_rows >0){
					foreach($rs->result() as $Hrs){
						return $Hrs->nomoraccount;
					}
			}else
				return false;
		}
		function GetComboJurnal(){
			$rs = $this->db->query("select nomoraccount,namaaccount from perkiraan where level = (select max(level) from perkiraan)");
			if($rs->num_rows >0)
				return $rs->result();
			else
				return false;
		}
	
	
	
	
	
	
	
	
	
	
	
	}
	
?>