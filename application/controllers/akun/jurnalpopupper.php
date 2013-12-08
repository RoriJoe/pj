<?php 

	if ( ! defined('BASEPATH')){
		exit('No direct script access allowed');
	}
	
	class jurnalpopupper extends CI_Controller {

		private $limit=2;
		
		public function index(){
			
			if($_POST){
				$this->load->model("MJurnal");	
				$pagination = "";
				$by=$_POST['by'];
				$pagination .= "<div class='boxlight' align='center'><div align='right' style='margin-bottom:5px;' ><img src='".base_url().'asset/close.png'."'  width='30' height='30' class='icoclose'/></div><div><div><form method='post'><font size='+1'>Search by</font> &nbsp;<select id='popfilterby' name='popfilterby'><option value='nomoraccount'>Kode</option><option value='namaaccount' ".$by.">Nama</option></select><input type='text' name='popvalsearch' id='popvalsearch' /></form></div><div class='clear'></div></div><div class='clear'></div><div id='boxisi' style=overflow:auto;height:500px;><br /><table width='280' height='' border='1' id='poptableNer' class='tablesorter' cellpadding='0' cellspacing='0'><thead><tr><th width='100'>No Akun</th><th width='100'>Nama</th><th>Action</th></tr></thead><tbody>";
					$rs = $this->MJurnal->getPopUp();
					$count= $this->MJurnal->countPopUp();
					foreach($rs->result() as $row){
            			 $pagination .= "<tr><td>$row->nomoraccount</td><td>$row->namaaccount</td><td align='center'><input type='button'  style='border:1px solid green;margin-top:2px; margin-bottom:2px;cursor:pointer;' value='Pilih' class='but' id='$row->nomoraccount#$row->namaaccount'/></td></tr>";
					}
					$pagination .= "</tbody></table><br /></div></div>";
					echo $pagination;
					
			}
		}
		function callsearch(){
			if($_POST){
				$this->load->model("MJurnal");
				$rs="";
				$count=0;
				$pagination = "";
				$rs=$this->MJurnal->getPopUpSearch($_POST['byser'],$_POST['isiser']);
	
				foreach($rs->result() as $row){
					$pagination .= "<tr><td>$row->nomoraccount</td><td>$row->namaaccount</td><td align='center'><input type='button'  style='border:1px solid green;margin-top:2px; margin-bottom:2px;cursor:pointer;' value='Pilih' class='but' id='$row->nomoraccount#$row->namaaccount'/></td></tr>";
				}
					echo $pagination;
				
			}
		}
		
	}
?>