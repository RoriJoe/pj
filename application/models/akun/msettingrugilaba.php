<?php
	
	class msettingrugilaba extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		function getalllistsearch($limit,$offset){
			$rs=$this->db->query("select namaaccount,nomoraccount,level from perkiraan where level <=3 limit $offset,$limit");
			return $rs;
		}
		function getsettinglabarugi(){
			$rs=$this->db->query("select SN.tempnamaaccount,level,dari,sampai,SN.cetak,namaaccount,SN.nomoraccount,operator from settinglabarugi SN left join perkiraan P on SN.nomoraccount = P.nomoraccount ");
			if($rs->num_rows >0)
				return $rs;
			else
				return false;
		}
		function getperkiraan(){
			$rs=$this->db->query("select SN.tempnamaaccount,level,dari,sampai,SN.cetak,namaaccount,P.nomoraccount,operator from perkiraan P left join settinglabarugi SN on SN.nomoraccount = P.nomoraccount");
			if($rs->num_rows >0)
				return $rs;
			else
				return false;
		}
		function getlevelperkiraan(){
			$rs=$this->db->query("select nomoraccount,level from perkiraan");
			if($rs->num_rows >0)
				return $rs;
			else
				return false;
		}
		
		function GetViewNeraca(){
			$rs=$this->db->query("select namaaccount,nomoraccount,level,tempnamaaccount from perkiraan where level <=3 and cetak=1");
			return $rs;
		}
		
		function countallsearch(){
			$rs=$this->db->query("select count(*) as jum from perkiraan");
			$jum=0;
			foreach($rs->result() as $row){
				$jum=$row->jum;
			}
			return $jum;
		}
		
		function GetCombo($No,$lvl,$Sub){
			$rs=$this->db->query("select nomoraccount from perkiraan where level = '$lvl' and substring(nomoraccount,1,$Sub)='$No'");
			if($rs->num_rows() > 0)
				return $rs->result();
			else
				return false;
		}
		function GetComboMaxMin($No,$lvl,$Sort,$Sub){
			$rs=$this->db->query("select $Sort(nomoraccount) as MaxMinAcc from perkiraan where level = '$lvl' and substring(nomoraccount,1,$Sub)='$No'");
			if($rs->num_rows >0){
					foreach($rs->result() as $Hrs){
						return $Hrs->MaxMinAcc;
					}
			}else
				return false;
		}
		
		function GetSaldoJurnal($No,$Thn,$Sub){
			$rs=$this->db->query("select dari,sampai from settinglabarugi where nomoraccount = '$No'");
			$F="";$T="";
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hrs){
					$F = $Hrs->dari;
					$T = $Hrs->sampai;
				}
			}
			$rs=$this->db->query("select saldo ,SUM(debit) as debit, SUM(kredit) as kredit from perkiraan P left join detailjurnal DJ on P.nomoraccount = DJ.nomoraccount left join jurnal J on J.novoucher=DJ.novoucher where  P.nomoraccount between '$F' and '$T' and (YEAR(tanggal)='$Thn' or YEAR(tanggalsaldoawal)='$Thn')");
			return $rs->result();
		}
		function GetSaldoJurnalSrc($No,$Thn,$SThn,$Bln,$SBln,$Sub){
			$rs=$this->db->query("select dari,sampai from settinglabarugi where nomoraccount = '$No'");
			$F="";$T="";
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hrs){
					$F = $Hrs->dari;
					$T = $Hrs->sampai;
				}
			}
			$MulaiTgl="";
			$SampaiTgl="";
			$Mtgl = $this->db->query("SELECT LAST_DAY('$Thn-$Bln-01') as tanggal")->result();
			foreach($Mtgl as $Htgl){
				$MulaiTgl= $Htgl->tanggal;
			}
			$Stgl = $this->db->query("SELECT LAST_DAY('$SThn-$SBln-01') as tanggal")->result();
			foreach($Stgl as $HStgl){
				$SampaiTgl = $HStgl->tanggal;
			}
			$rs=$this->db->query("select SUM(saldo) as saldo ,SUM(debit) as debit, SUM(kredit) as kredit from perkiraan P left join detailjurnal DJ on P.nomoraccount = DJ.nomoraccount left join jurnal J on J.novoucher=DJ.novoucher where  (P.nomoraccount between '$F' and '$T') and (tanggal between '$MulaiTgl' and '$SampaiTgl')  ");
			foreach($rs->result() as $Hrs){
				if($Hrs->saldo &&$Hrs->debit &&$Hrs->kredit ){
					return $rs->result();
				}else{
					$rss = $this->db->query("select SUM(saldo) as saldo, SUM(saldo) as debit, SUM(saldo) as kredit from perkiraan where nomoraccount between '$F' and '$T' and tanggalsaldoawal between '$MulaiTgl' and '$SampaiTgl' ");
					return $rss->result();
				}
			}
		}
		function GetSaldoJurnalSrcLast($No,$Thn,$SThn,$Bln,$SBln,$Sub){
			$rs=$this->db->query("select dari,sampai from settinglabarugi where nomoraccount = '$No'");
			$F="";$T="";
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hrs){
					$F = $Hrs->dari;
					$T = $Hrs->sampai;
				}
			}
			$MulaiTgl="";
			$SampaiTgl="";
			$Mtgl = $this->db->query("SELECT LAST_DAY('$Thn-$Bln-01') as tanggal")->result();
			foreach($Mtgl as $Htgl){
				$MulaiTgl= $Htgl->tanggal;
			}
			$Stgl = $this->db->query("SELECT LAST_DAY('$SThn-$SBln-01') as tanggal")->result();
			foreach($Stgl as $HStgl){
				$SampaiTgl = $HStgl->tanggal;
			}
			$rs=$this->db->query("select SUM(saldo) as saldo ,SUM(debit) as debit, SUM(kredit) as kredit from tt_historitutuptahun P left join detailjurnal DJ on P.nomoraccount = DJ.nomoraccount left join jurnal J on J.novoucher=DJ.novoucher where  P.nomoraccount between '$F' and '$T' and P.tahun between '$Thn' and '$SThn' and tanggal between '$MulaiTgl' and '$SampaiTgl' ");
			foreach($rs->result() as $Hrs){
				if($Hrs->saldo &&$Hrs->debit &&$Hrs->kredit ){
					return $rs->result();
				}else{
					$rss = $this->db->query("select SUM(saldo) as saldo, SUM(saldo) as debit, SUM(saldo) as kredit from tt_historitutuptahun where nomoraccount between '$F' and '$T' and tahun between '$Thn' and '$SThn' ");
					return $rss->result();
				}
			}
		}
		
		function SearchSaldoJurnal($No,$Thn,$Bln,$Sub){
			$rs=$this->db->query("select dari,sampai from settinglabarugi where nomoraccount = '$No'");
			$F="";$T="";
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hrs){
					$F = $Hrs->dari;
					$T = $Hrs->sampai;
				}
			}
			$rs=$this->db->query("select saldo ,SUM(debit) as debit, SUM(kredit) as kredit from perkiraan P left join detailjurnal DJ on P.nomoraccount = DJ.nomoraccount left join jurnal J on J.novoucher=DJ.novoucher where  P.nomoraccount between '$F' and '$T' and (YEAR(tanggal)='$Thn' or YEAR(tanggalsaldoawal)='$Thn')");
			return $rs->result();
		}
		function SaveSettingNer($No,$Nama,$F,$T,$Ctk,$Opr){
			$this->db->query("insert into settinglabarugi (nomoraccount,tempnamaaccount,dari,sampai,cetak,operator) values('$No','$Nama','$F','$T','$Ctk','$Opr')");
		}
		
		function GetSettingNer($No,$Sort){
			$rs=$this->db->query("select $Sort from settinglabarugi where nomoraccount='$No'");
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hr){
					if($Sort=='dari')
						return $Hr->dari;
					else 
						return $Hr->sampai;
				}
			}
			else
				return false;
		
		}
		
		function UpdateSettingNer($kd,$val){
			$this->db->query("update perkiraan SET tempnamaaccount='$val' where nomoraccount='$kd'");
		
		}
		function UpdateSettingNerCetak($kd,$val){
			$this->db->query("update settinglabarugi SET cetak='$val' where nomoraccount='$kd'");
		
		}
		function ResSettingNerCetak(){
			$this->db->query("delete from settinglabarugi");
		}
		function updatelevel($no,$val){
			$rs1 = $this->db->query("select level from settinglevel where nomorlevel='$no'");
				if($rs1->num_rows() >0)
					$this->db->query("update settinglevel SET level='$val' where nomorlevel='$no'");
				else
					$this->db->query("insert settinglevel values('$no','$val')");
		}
		
		
		function getlevelcetak($No){
			$rs=$this->db->query("select level from settinglevel where nomorlevel='$No'");
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hr){
					return $Hr->level;
				}
			}
			else
				return false;
		}
		
		function GetTable($No){
			$rs=$this->db->query("select dari,sampai from settinglabarugi where nomoraccount = '$No'");
			$F="";$T="";
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hrs){
					$F = $Hrs->dari;
					$T = $Hrs->sampai;
				}
			}
			$rs = $this->db->query("SELECT namatabel, DF.nama,debitkredit
				FROM detailmapperkiraan MP
				JOIN detailmapfield DF ON DF.idfield = MP.idfield
				JOIN detailmaptabel DT ON DT.idtab = DF.idtab
				WHERE nomoraccount between '$F' and '$T'");
			if($rs->num_rows >0)
				return $rs->result();
			else
				return false;
		}
		
		function GetOther($namatabel,$field,$Thn,$SThn,$Bln,$SBln){
			$rs = $this->db->query("select sum($field) as total from $namatabel where tanggal >= '$Thn-$Bln-DAY(DATE_ADD(tanggal,INTERVAL -1 DAY))' and tanggal <= '$SThn-$SBln-DAY(DATE_ADD(tanggal,INTERVAL -1 DAY))' ");
			if($rs->num_rows >0)
				return $rs->result();
			else
				return false;
		
		}
		
	}
?>