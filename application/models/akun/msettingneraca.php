<?php
	
	class msettingneraca extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		function getalllistsearch($limit,$offset){
			$rs=$this->db->query("select namaaccount,nomoraccount,level from perkiraan where level <=3 limit $offset,$limit");
			return $rs;
		}
		function getsettingneraca(){
			$rs=$this->db->query("select SN.tempnamaaccount,level,dari,sampai,SN.cetak,namaaccount,SN.nomoraccount from settingneraca SN left join perkiraan P on SN.nomoraccount = P.nomoraccount ");
			if($rs->num_rows >0)
				return $rs;
			else
				return false;
		}
		function getperkiraan(){
			$rs=$this->db->query("select SN.tempnamaaccount,level,dari,sampai,SN.cetak,namaaccount,P.nomoraccount from perkiraan P left join settingneraca SN on SN.nomoraccount = P.nomoraccount");
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
			$rs=$this->db->query("select dari,sampai from settingneraca where nomoraccount = '$No'");
			$F="";$T="";
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hrs){
					$F = $Hrs->dari;
					$T = $Hrs->sampai;
				}
			}
			$rs=$this->db->query("select saldo ,SUM(debit) as debit, SUM(kredit) as kredit from perkiraan P left join detailjurnal DJ on P.nomoraccount = DJ.nomoraccount join jurnal J on J.novoucher=DJ.novoucher where substring(P.nomoraccount,1,$Sub)='$No' and YEAR(tanggal)='$Thn' and P.nomoraccount between '$F' and '$T'");
			return $rs->result();
		}
		
		function GetSaldoJurnallastyear($No,$Thn,$Sub){
			$rs=$this->db->query("select dari,sampai from settingneraca where nomoraccount = '$No'");
			$F="";$T="";
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hrs){
					$F = $Hrs->dari;
					$T = $Hrs->sampai;
				}
			}
			$rs=$this->db->query("select saldo ,SUM(debit) as debit, SUM(kredit) as kredit from tt_historitutuptahun P left join detailjurnal DJ on P.nomoraccount = DJ.nomoraccount join jurnal J on J.novoucher=DJ.novoucher where substring(P.nomoraccount,1,$Sub)='$No' and tahun='$Thn' and P.nomoraccount between '$F' and '$T'");
			return $rs->result();
		}
		
		function SearchSaldoJurnal($No,$Thn,$Bln,$Sub){
			$rs=$this->db->query("select dari,sampai from settingneraca where nomoraccount = '$No'");
			$F="";$T="";
			if($rs->num_rows() > 0){
				foreach($rs->result() as $Hrs){
					$F = $Hrs->dari;
					$T = $Hrs->sampai;
				}
			}
			$rs=$this->db->query("select saldo ,SUM(debit) as debit, SUM(kredit) as kredit from perkiraan P left join detailjurnal DJ on P.nomoraccount = DJ.nomoraccount join jurnal J on J.novoucher=DJ.novoucher where substring(P.nomoraccount,1,$Sub)='$No' and YEAR(tanggal)='$Thn' and P.nomoraccount between '$F' and '$T'");
			return $rs->result();
		}

		function SaveSettingNer($No,$Nama,$F,$T,$Ctk){
			$this->db->query("insert into settingneraca (nomoraccount,tempnamaaccount,dari,sampai,cetak) values('$No','$Nama','$F','$T','$Ctk')");
		}
		
		function GetSettingNer($No,$Sort){
			$rs=$this->db->query("select $Sort from settingneraca where nomoraccount='$No'");
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
			$this->db->query("update settingneraca SET cetak='$val' where nomoraccount='$kd'");
		
		}
		function ResSettingNerCetak(){
			$this->db->query("delete from settingneraca");
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
	}