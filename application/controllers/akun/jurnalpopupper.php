<?php 

	if ( ! defined('BASEPATH')){
		exit('No direct script access allowed');
	}
	
	class jurnalpopupper extends CI_Controller {

		private $limit=2;
		
		public function index(){
			
			if($_POST){
				$this->load->model("akun/MJurnal");	
				$pagination = "";
				$by=$_POST['by'];
				$pagination .= "
				<div class='boxlight' align='center'></div>
				<div>
					<div>
						<form method='post'>
						Search by &nbsp;<select id='popfilterby' name='popfilterby'>
							<option value='nomoraccount'>Kode</option><option value='namaaccount' ".$by.">Nama</option></select>
							<input type='text' name='popvalsearch' id='popvalsearch' style='margin-bottom:0px;'/>
						</form></div><div class='clear'></div></div><div class='clear'>
					</div>
					<div id='boxisi' style=overflow:auto;height:300px;>
					<br />
					<table id='poptableNer' class='tablesorter table table-bordered CSSTabel'>
						<thead>
							<tr>
								<th>No Akun</th>
								<th>Nama</th>
								<th>Action</th>
							</tr>
						</thead>
					<tbody>";
						$rs = $this->MJurnal->getPopUp();
						$count= $this->MJurnal->countPopUp();
						foreach($rs->result() as $row){
	            			$pagination .= "
	            			<tr>
	            				<td>$row->nomoraccount</td>
	            				<td>$row->namaaccount</td>
	            				<td align='center'>
	            					<input type='button' value='Pilih' class='btn' id='$row->nomoraccount#$row->namaaccount'/>
	            				</td>
	            			</tr>";
						}
					$pagination .= "</tbody></table><br /></div></div>";
					echo $pagination;
					
			}
		}
		function callsearch(){
			if($_POST){
				$this->load->model("akun/MJurnal");
				$rs="";
				$count=0;
				$pagination = "";
				$rs=$this->MJurnal->getPopUpSearch($_POST['byser'],$_POST['isiser']);
	
				foreach($rs->result() as $row){
					$pagination .= "
					<tr>
						<td>$row->nomoraccount</td>
						<td>$row->namaaccount</td>
						<td align='center'>
							<input type='button' value='Pilih' class='btn' id='$row->nomoraccount#$row->namaaccount'/>
						</td>
					</tr>";
				}
				echo $pagination;
			}
		}
		
	}
?>