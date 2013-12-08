<?php
	
	class msettingmapping extends CI_Model{
		
		
		function __construct(){
			parent::__construct();
		}
		
		function getalllistsearch($by,$val,$limit,$offset){
			$rs=$this->db->query("select distinct M.id,M.nama,MM.nama as tipe from menu M left join menu MM on M.parentid = MM.id left join detailmaptabel DMT on M.id = DMT.id where DMT.$by like '%$val%'");
			return $rs;
		}
		function countallsearch($by,$val){
			$rs=$this->db->query("select distinct M.id,nama from menu M join detailmaptabel DMT on M.id = DMT.id where DMT.$by like '%$val%'");
			$jum=0;
			foreach($rs->result() as $row){
				$jum=$row->jum;
			}
			return $jum;
		}
		function GetTable(){
			$rss = array();
			$tables = $this->db->query("SELECT table_name FROM INFORMATION_SCHEMA.TABLES
			tab WHERE table_schema = 'wahana'")->result();
			foreach($tables as $Htables){
				$rs = $this->db->query("SELECT COLUMN_NAME
				FROM INFORMATION_SCHEMA.COLUMNS
				WHERE table_name =  '$Htables->table_name'
				AND COLUMN_NAME =  'tanggal'")->result_array();
				if($rs)
					array_push($rss,$Htables->table_name);
			}
			$this->db->select("table_name");
			$this->db->from("INFORMATION_SCHEMA.TABLES");
			$this->db->where("table_schema","wahana");
			$this->db->where_in("table_name",$rss);
			$Hsl = $this->db->get()->result();
			return $Hsl;
		}
		function GetField($id){
			$fields = $this->db->query("SELECT distinct COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name ='$id' AND (DATA_TYPE = 'BIGINT' or DATA_TYPE = 'INT')");
			return $fields->result();
		}
		function GetJenis(){
			$rs=$this->db->query("select nama,id from menu where parentid in (select id from menu where parentid='0')  and parentid <> (select id from menu where nama like 'master' )");
			return $rs->result();
		}
		function GetCheck($id){
			$fields = $this->db->query("select nama from detailmaptabel DMT join detailmapfield DMF on DMT.idtab = DMF.idtab where namatabel='$id'");
			return $fields->result();
		}
		function getselect($kode){
			$rs=$this->db->query("select distinct DMT.id as tipe,namatabel from detailmapfield DMF left join detailmaptabel DMT on DMT.idtab=DMF.idtab left join menu M on M.id =DMT.id where M.id=$kode");
			return $rs;
		}
		function getparentid($id){
		$rs=$this->db->query("select M.parentid from menu M join menu MM on M.parentid = MM.id where M.id='$id' and MM.parentid <> 0");
		foreach($rs->result() as $H){
			return $H->parentid;
		}
	}
		function reset($id){
			$rs = $this->db->query("select nomoraccount  from detailmapperkiraan DP join detailmapfield DF on DP.idfield = DF.idfield join detailmaptabel DT on DT.idtab = DF.idtab where id='$id'");
			if($rs->num_rows >0){
				return false;
			}else{
				$this->db->query("delete from detailmapfield where idtab in (select idtab from detailmaptabel where id=$id)");
				$this->db->query("delete from detailmaptabel where id=$id");
				return true;
			}
		}
		function cekupdate($nmtab){
			$rs = $this->db->query("select nomoraccount  from detailmapperkiraan DP join detailmapfield DF on DP.idfield = DF.idfield join detailmaptabel DT on DT.idtab = DF.idtab where namatabel='$nmtab'");
			if($rs->num_rows >0)
				return false;
			else
				return true;
		}
		function resupdate($nmtab){
				$this->db->query("delete from detailmapfield where idtab in (select idtab from detailmaptabel where namatabel='$nmtab')");
				$this->db->query("delete from detailmaptabel where namatabel='$nmtab'");
		}
		
		function insertsetmap($id,$nama){
			$rs=$this->db->query("insert into detailmaptabel (id,namatabel) values('$id','$nama')");	
		}
		function insertsetfield($id,$nama){
			$rs=$this->db->query("insert into detailmapfield (idtab,nama) values((select max(idtab) from detailmaptabel),'$nama')");	
		}
		
	}
?>