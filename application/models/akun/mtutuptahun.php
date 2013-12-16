<?php
	
	class mtutuptahun extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		function GetComboper(){
			$rs = $this->db->query('select nomoraccount,namaaccount from perkiraan where level = (select max(level) from perkiraan)');
			return $rs->result();
		}
		function getresetper(){
		 return $this->db->get("tt_resetperkiraan")->result();
		}
		function getakumulasi(){
		 return $this->db->get("tt_akumulasilaba")->result();
		}
		
		function savesetnol($min,$max,$tahun){
			$this->db->query("insert into tt_resetperkiraan (dari,sampai) values('$min','$max')");
			$this->db->query("update perkiraan set saldo=0 where nomoraccount between '$min' and '$max' ");
		}
		function saveakumulasi($per,$labarugi,$tahun){
			$rs = $this->db->query("select nomoraccount,saldo from perkiraan where nomoraccount='$per'")->result();
			foreach($rs as $Hrs){
				$this->db->query("insert into tt_historitutuptahun values('$per','$labarugi','$tahun','1')");
			}
			$this->db->query("insert into tt_akumulasilaba (nomoraccount) values('$per')");
			$this->db->query("update perkiraan set saldo='$labarugi' where nomoraccount='$per'");
		}
		function savehistory($tahun){
			$rs = $this->db->query("select nomoraccount,saldo from perkiraan")->result();
			foreach($rs as $Hrs){
				$this->db->query("insert into tt_historitutuptahun values('$Hrs->nomoraccount','$Hrs->saldo','$tahun','0')");
			}
		}
		function resetpernol(){
			$this->db->query("delete from tt_resetperkiraan");
			$this->db->query("delete from tt_akumulasilaba");
		}
		function marktutuptahun($tahun,$flg){
			$rss = array();
			$tables = $this->db->query("SELECT table_name FROM INFORMATION_SCHEMA.TABLES
				tab WHERE table_schema = 'db_pelita'")->result();
				foreach($tables as $Htables){
					$rs = $this->db->query("SELECT TABLE_NAME
					FROM INFORMATION_SCHEMA.COLUMNS
					WHERE table_name =  '$Htables->table_name'
					AND COLUMN_NAME ='tutuptahun'")->result_array();
				if($rs)
					array_push($rss,$Htables->table_name);
			}
			if($rss){
				foreach($rss as $Hrs){
					$this->db->query("update $Hrs set tutuptahun='$flg' where year(tanggal)='$tahun' ");
					echo '-'.$Hrs.'-';
				}
			}
		}
		
		
		
		
		
		
		
		
		
		
		
	}
	
?>