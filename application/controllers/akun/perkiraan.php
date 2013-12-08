<?php 

	if ( ! defined('BASEPATH')){
		exit('No direct script access allowed');
	}
	
	class perkiraan extends CI_Controller {

		private $limit=2;
		
		public function index(){
			$this->load->view("perkiraan");
		}
		function GetType($T){
			if($T==1) return 'Asset';
			else if($T==1) return 'Asset';
			else if($T==2) return 'Liability';
			else if($T==3) return 'Revenue';
			else if($T==4) return 'Expense';
			else if($T==5) return 'Equity';
		}
		function Tgl($tgl){
			$Tgl = strtotime($tgl); 
			return date('d F Y', $Tgl);
		}
		 function Uang($uang){
			return $in_rp =number_format($uang, 0, '.', '.');
		 }
		function getlistdata(){
			if($_POST){ 
				$this->load->model("mperkiraan");
				$rs=$this->mperkiraan->getalllistsearch($_POST['byser'],$_POST['valser'],$_POST['limit'],$_POST['offset']);
				foreach($rs->result() as $row){
					echo "<tr><td>$row->nomoraccount</td><td>$row->namaaccount</td><td>".$this->GetType($row->type)."</td><td align=right>".$row->level."</td><td align='center'><img id='$row->nomoraccount' class='imgupdate' src='".base_url()."asset/deskripsi.png' width='30' height='18'/>&nbsp;&nbsp;&nbsp;<img id='$row->nomoraccount' class='imgdelete' src='".base_url()."asset/delete.png' width='30' height='18'/></td><tr>";
				}
			}
		}
		
	function pagination(){    
		 	if($_POST){
				$this->load->model("mperkiraan");
				$count=$this->mperkiraan->countallsearch($_POST['byser'],$_POST['valser']);
				$adjacents = "2";
		 		$page=$_POST['offset'];
				$page = ($page == 0 ? 1 : $page); 
				$start = ($page - 1) * $_POST['limit'];                              
				 
				if($_POST['offset']-$_POST['limit']<=0){
					$prev =0;
				}else{
					$prev = $_POST['offset']-$_POST['limit'];
				}    
				
				$lastpage = ceil($count/$_POST['limit']);
				if($_POST['offset']+$_POST['limit']>($lastpage*$_POST['limit'])-$_POST['limit']){
					$next=($lastpage*$_POST['limit'])-$_POST['limit'];
				}else{
					$next = $_POST['offset']+$_POST['limit'];
				}
				$lpm1 = $lastpage - 1;				
				$lpage=($_POST['offset']/$_POST['limit'])+1;
				$pagination = "";
				if($lastpage > 1)
				{  	
					$pagination .= "<ul class='pagination'>";
									
					if ($_POST['offset'] > 0){
						$pagination.= "<li><a class='current' id='0'>First</a></li>";
						$pagination.= "<li><a class='current' id='$prev''>Previous</a></li>";										
					}
					
			
					$pagination .= "<li class='details'>Page $lpage of $lastpage</li>";
					
					
					if ($lastpage < 7 + ($adjacents * 2))
					{  
						for ($counter = 1; $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<li><a class='current' id='".($counter-1)*$_POST['limit']."'>$counter</a></li>";
							else
								$pagination.= "<li><a id='".($counter-1)*$_POST['limit']."'>$counter</a></li>";                   
						}
					}
					elseif($lastpage > 5 + ($adjacents * 2))
					{
						if($page < 1 + ($adjacents * 2))    
						{
							for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
							{
								if ($counter == $page)
									$pagination.= "<li><a class='current' id='".($counter-1)*$_POST['limit']."'>$counter</a></li>";
								else
									$pagination.= "<li><a id='".($counter-1)*$_POST['limit']."'>$counter</a></li>";                   
							}
							$pagination.= "<li class='dot'>...</li>";
							$pagination.= "<li><a id='$lpm1'>$lpm1</a></li>";
							$pagination.= "<li><a id='$lastpage'>$lastpage</a></li>";     
						}
						elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
						{
							$pagination.= "<li><a id='1'>1</a></li>";
							$pagination.= "<li><a id='2'>2kljkl</a></li>";
							$pagination.= "<li class='dot'>...</li>";
							for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
							{
								if ($counter == $page)
									$pagination.= "<li><a class='current' id='".($counter-1)*$_POST['limit']."'>$counter</a></li>";
								else
									$pagination.= "<li><a id='".($counter-1)*$_POST['limit']."'>$counter</a></li>";                   
							}
							$pagination.= "<li class='dot'>..</li>";
							$pagination.= "<li><a id='$lpm1'>$lpm1</a></li>";
							$pagination.= "<li><a id='$lastpage'>$lastpage</a></li>";     
						}
						else
						{
							$pagination.= "<li><a id='1'>1</a></li>";
							$pagination.= "<li><a id='2'>2</a></li>";
							$pagination.= "<li class='dot'>..</li>";
							for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
							{
								if ($counter == $page)
									$pagination.= "<li><a class='current' id='".($counter-1)*$_POST['limit']."'>$counter</a></li>";
								else
									$pagination.= "<li><a id='".($counter-1)*$_POST['limit']."'>$counter</a></li>";                   
							}
						}
					}
					 
					if ($lpage<$lastpage){
						$pagination.= "<li><a id='$next'>Next</a></li>";
						$pagination.= "<li><a id='".($lastpage-1)*$_POST['limit']."'>Last</a></li>";
					}
					$pagination.= "</ul>\n";     
				}          
				echo $pagination;
			}
		} 			
		
		/* function getpagging(){
			if($_POST){
				$this->load->model("mperkiraan");
				$count=$this->mperkiraan->countallsearch($_POST['byser'],$_POST['valser']);
				if($_POST['offset']-$_POST['limit']>=0){
						echo "<a id='0' class='linkpaging2'>First</a> - ";
						echo "<a id='".($_POST['offset']-$_POST['limit'])."' class='linkpaging2'>Previous</a> - ";
					}else{
						echo "First - Previous - "; 
					}
					if ($_POST['offset']+$_POST['limit']<ceil($count/$_POST['limit'])*$_POST['limit']) { 
						echo "<a id='".($_POST['offset']+$_POST['limit'])."' class='linkpaging2'>Next</a> - "; 
						echo "<a id='".((ceil($count/$_POST['limit'])*$_POST['limit'])-$_POST['limit'])."' class='linkpaging2'>Last</a> "; 
					}else{
						echo "Next - Last ";  
				}
			}
		} */
		
		function getselect(){ 
			if($_POST){
				$kode=$_POST['kode'];
				$this->load->model("mperkiraan");
				$rs=$this->mperkiraan->getselect($kode);
				foreach($rs->result() as $row){
					$Tgl = strtotime($row->tanggalsaldoawal); 
					$TglAwl = date('d-m-Y', $Tgl);
					echo $row->nomoraccount."#".$row->namaaccount."#".$row->level."#".$row->type."#".$row->tanggalentry."#".$TglAwl."#".$row->saldo;
				}
			}
		}
		function insertper(){
			if($_POST){
				$this->load->model("mperkiraan");		
				$this->mperkiraan->insertperkiraan($_POST['NoAc'],$_POST['NamaPer'],$_POST['Level'],$_POST['Type'],$_POST['NilaiSaldo'],$_POST['TglSaldoAwl']);
			}
		}
		
		function updateper(){ 
			 if($_POST){
				$this->load->model("mperkiraan");
				$this->mperkiraan->updateperkiraan($_POST['NoAc'],$_POST['NamaPer'],$_POST['Level'],$_POST['Type'],$_POST['NilaiSaldo'],$_POST['Kode'],$_POST['TglSaldoAwl']);
			}
		}
		function deleteper(){
			if($_POST){
				$this->load->model("mperkiraan");
				$this->mperkiraan->deleteperkiraan($_POST['kode']);
			}
		}
		function CekNoAcc(){
			$this->load->model("mperkiraan");
			$Str = $_POST['Val'];
			$a = substr($Str,0,strripos($Str,"."));
			$CekAwl = $this->mperkiraan->CekAcc($Str);
			if($CekAwl==0){
				if($a=="")
					echo 0;
				else{
					$b = $this->mperkiraan->CekAcc($a);
					if($b==1){
						echo 0;
					}else
					echo 2;
					}
			}else
				echo 1;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>