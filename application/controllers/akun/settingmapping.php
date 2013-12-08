<?php if ( ! defined('BASEPATH')){exit('No direct script access allowed');}
	class settingmapping extends CI_Controller {
		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/msettingmapping'));
		}
		private $limit=2;
			
		function index(){
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->load->model("akun/msettingmapping");
			$data['Combo']=$this->msettingmapping->GetJenis();
			$data['Table']=$this->msettingmapping->GetTable();
			
			$this->load->view("akun/settingmapping", $data);
		}
		
		function getlistdata(){
			if($_POST){ 
				$this->load->model("akun/msettingmapping");
				$rs=$this->msettingmapping->getalllistsearch($_POST['byser'],$_POST['valser'],$_POST['limit'],$_POST['offset']);
				foreach($rs->result() as $row){
					echo "<tr><td style=display:none;>$row->id</td><td>$row->tipe $row->nama</td><td style='text-align:center'><a id='$row->id' class='imgupdate btn'><i class='icon-pencil'></i></a><a id='$row->id' class='imgdelete btn'><i class='icon-trash'></i></a></td><tr>";
				}
			}
		}
			
		function pagination(){    
			 	if($_POST){
					$this->load->model("akun/msettingmapping");
					$count=$this->msettingmapping->countallsearch($_POST['byser'],$_POST['valser']);
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
		
		
			function getselect(){ 
				if($_POST){
					$kode=$_POST['kode'];
					$this->load->model("akun/msettingmapping");
					$rs=$this->msettingmapping->getselect($kode);
					foreach($rs->result() as $row){
						$parent =$this->msettingmapping->getparentid($row->tipe);
						echo  $row->tipe."#".$parent."#".$row->namatabel."*";
					}
				}
			} 
			function GetField(){
				$this->load->model("akun/msettingmapping");
				$Attr=$this->msettingmapping->GetField($_POST['id']);
				$Check=$this->msettingmapping->GetCheck($_POST['id']);
					if($Attr){
						echo ' Attribute : ';
							foreach($Attr as $HAttr){ $flag=0;
								foreach ($Check as $hc){
									if($hc->nama == $HAttr->COLUMN_NAME){
										$flag=1; break;
									}else{
										$flag=0;
									}
								}
								if($flag==0){
									echo '<input type=checkbox class=check value="'.$HAttr->COLUMN_NAME.'" id="" name="Atttabel'.$_POST['idx'].'[]"">'.$HAttr->COLUMN_NAME.'</input>';
								}else{
									echo '<input type=checkbox class=check value="'.$HAttr->COLUMN_NAME.'" id="" name="Atttabel'.$_POST['idx'].'[]"" checked>'.$HAttr->COLUMN_NAME.'</input>';
								}
							}
					}
			
			}
			
			function insertsetmap(){
				if($_POST){
					$this->load->model("akun/msettingmapping");
					$id="";
					if(isset($_POST['TipeTran']))
						$id=$_POST['TipeTran'];
					else
					$id=$_POST['jenis'];
					if($_POST['flagaction']==0){
						for($i=1;$i<=4;$i++){
							if($_POST['Tabel'.$i]){
									$this->msettingmapping->insertsetmap($id,$_POST['Tabel'.$i]);
								foreach($_POST['Atttabel'.$i] as $h){
									$this->msettingmapping->insertsetfield($id,$h);
								}
							}
						}
					}else{
						$msg="";
						for($i=1;$i<=4;$i++){
							if($_POST['UpTabel'.$i] != $_POST['Tabel'.$i]){
								$flag=true; $fmsg=0;
								if($_POST['UpTabel'.$i]){
									$cek = $this->msettingmapping->cekupdate($_POST['UpTabel'.$i]);
									if($cek==true){
										$this->msettingmapping->resupdate($_POST['UpTabel'.$i]);
									}else{ $flag=false;
										if($_POST['Tabel'.$i]=='0'){
											$msg.=$_POST['UpTabel'.$i];
											$fmsg=1;
										}
									}
								}
								if($flag==true){
									if($_POST['Tabel'.$i]){
										$cek = $this->msettingmapping->cekupdate($_POST['Tabel'.$i]);
										if($cek==true){
											$this->msettingmapping->resupdate($_POST['Tabel'.$i]);
											$this->msettingmapping->insertsetmap($id,$_POST['Tabel'.$i]);
											if($_POST['Atttabel'.$i]){
												foreach($_POST['Atttabel'.$i] as $h){
													$this->msettingmapping->insertsetfield($id,$h);
												}
											}
										}
									}
								}else{
									if($fmsg==0)
										$msg.=$_POST['UpTabel'.$i];
								}
							}
						}
						if($msg)
							echo '<font color="red"><i>'.$msg.' Sedang di gunakan di menu mapping perkiraan</i></label>';
					}
				}
			}
			function deletesetmap(){
				if($_POST){
					$this->load->model("akun/msettingmapping");
					$cek = $this->msettingmapping->reset($_POST['kode']);
					if($cek==false){
						echo '<font color="red"><i>Sedang di gunakan di mapping perkiraan</i></label>';
					}else{
						echo '<font color="green">Sukses</font>';
					}
				}
			}
		}