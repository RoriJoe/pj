<?php
	
	class mmappingperkiraan extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		function getalllistsearch($by,$val,$limit,$offset){
			$rs=$this->db->query("select distinct MJ.id,MJ.nama as jenis,MM.nama as tipe from detailmapperkiraan DP join detailmapfield DF on DP.idfield = DF.idfield join detailmaptabel DT on DF.idtab = DT.idtab join menu MJ on DT.id=MJ.id left join menu MM on MJ.parentid = MM.id  where $by like '%$val%' limit $offset,$limit");
			return $rs;
		}

		function GetJenis(){
			$rs=$this->db->query("select nama,id from menu where parentid in (select id from menu where parentid='0')  and parentid <> (select id from menu where nama like 'master' )");
			return $rs->result();
		}
		function GetTipe($id){
			$rs=$this->db->query("select nama,id from menu where parentid='$id'");
			return $rs->result();
		}
		function getparentid($id){
			$rs=$this->db->query("select M.parentid from menu M join menu MM on M.parentid = MM.id where M.id='$id' and MM.parentid <> 0");
			foreach($rs->result() as $H){
				return $H->parentid;
			}
		}
		function GetTableName($id){
			$rs=$this->db->query("select namatabel,idtab from detailmaptabel where id='$id'");
			return $rs->result();
		}
		function GetFieldNameView($noaccount,$idmenu){
			$rs=$this->db->query("select DF.idfield,nama from detailmapfield DF left join detailmaptabel DT on DF.idtab = DT.idtab left join detailmapperkiraan DP on DP.idfield = DF.idfield where DT.id = '$idmenu' and DF.idtab = (select DMT.idtab from detailmapfield DF join detailmapperkiraan DP on DF.idfield = DP.idfield join detailmaptabel DMT on DMT.idtab=DF.idtab where nomoraccount='$noaccount' and id='$idmenu')");
			return $rs->result();
		}
		
		function GetFieldName($id){
			$rs=$this->db->query("select nama,idfield from detailmapfield where idtab='$id'");
			return $rs->result();
		}
		 function GetIdMap($kd){
			$id=$this->db->query("select idtab from detailmaptabel where id='$kd'");
			foreach($id->result() as $Hid)
				return $Hid->idtab;
		}
		function savedetail($Nid,$NoAk,$DK){
			$rs=$this->db->query("insert into detailmapperkiraan values('$Nid','$NoAk','$DK')");
		}
		function deletedetail($id){
				$rs=$this->db->query("delete from detailmapperkiraan where idfield in (select idfield from detailmapfield MF join detailmaptabel MT on MF.idtab=Mt.idtab where id='$id')");
			}
		function Updateheader($id,$Jenis){
				$rs=$this->db->query("update mappingperkiraan set jenis='$Jenis' where idtab='$id' ");
		}
		function countallsearch($by,$val){
			$rs=$this->db->query("select count(*) as jum from mappingperkiraan where $by like '%$val%'");
			$jum=0;
			foreach($rs->result() as $row){
				$jum=$row->jum;
			}
			return $jum;
		}
		
		function getselect($kode){
			$rs=$this->db->query("SELECT distinct M.id
				FROM detailmaptabel DT
				JOIN detailmapfield DF ON DT.idtab = DF.idtab
				JOIN menu M ON M.id = DT.id
				WHERE M.id ='$kode'");
			return $rs;
		}
		function SetCetak($id,$nama){
			$this->db->query("update detailmapfield set cetak=0 where idtab='$id'");
			$rs=$this->db->query("update detailmapfield set cetak=1 where nama='$nama'");
			return $rs;
		}
			
		function GetTableMap($kode){
			$rs=$this->db->query("select distinct DP.nomoraccount,debitkredit,namaaccount,DP.idfield from detailmapperkiraan DP join perkiraan as P on DP.nomoraccount=P.nomoraccount join detailmapfield DF on DF.idfield=DP.idfield join detailmaptabel DMP on DF.idtab = DMP.idtab where id='$kode'");
			return $rs->result();
		}
		function GetIdTab($idacc,$kode){
			$rs=$this->db->query("select distinct DMP.idtab from detailmapperkiraan DP join detailmapfield DF on DP.idfield = DF.idfield join detailmaptabel DMP on DF.idtab = DMP.idtab where nomoraccount='$idacc' and id='$kode'");
			foreach($rs->result() as $H)
				return $H->idtab;
		}
	
	}
