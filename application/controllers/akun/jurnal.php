<?php 

	if ( ! defined('BASEPATH')){
		exit('No direct script access allowed');
	}
	
	class jurnal extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/mjurnal'));
		}

		private $limit=2;
		function generateid($hurufD){
			$this->load->model("akun/mjurnal");
			$generate=$this->mjurnal->generateid("jurnal","novoucher");
			
			if($generate!=false){
				foreach($generate as $noid)
				{
					$a = $noid->novoucher;
					$b = substr($a, -3)+1;
					$c = substr($a, -3);
					$tanggal = substr($a,0,4);
					$now = date("ym");
					
					if($tanggal != $now && $c != "001")
					{	
						return $hurufD.$now.'001';
					}else
					{
						if($b < 10)
						{
							return $hurufD.$tanggal.'00'.$b;
						}
						else if($b < 100 && $b>=10)
						{
							return $hurufD.$tanggal.'0'.$b;
						}
						else
						{
							return $hurufD.$tanggal.$b;
						}	
					}
				}
			}
			else
			{	
				$now = date("ym");
				return $hurufD.$now.'001';
			}
		}
		public function index(){
			$id['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$id['id']=$this->generateid("");
			$this->load->view("akun/jurnal",$id);
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
				$this->load->model("akun/mjurnal");
				$rs=$this->mjurnal->getalllistsearch($_POST['byser'],$_POST['valser'],$_POST['limit'],$_POST['offset']);
				foreach($rs->result() as $row){
					echo "
					<tr>
						<td>$row->novoucher</td>
						<td>$row->kodekaryawan</td>
						<td>$row->tanggal</td>
						<td style='text-align:center;'>
							<a id='$row->novoucher' class='imgupdate btn'>
								<i class='icon-pencil'></i>
							</a>
							<a id='$row->novoucher' class='imgdelete btn'>
								<i class='icon-trash'></i>
							</a>
						</td>
					</tr>";
				}
			}
		}
		function SaveNer(){
			$this->load->model("akun/mjurnal");
			$id = $this->generateid("");
			$NoAk = $_POST['NoAk'];
			$ket = $_POST['ket'];
			$Db = $_POST['Db'];
			$Kr = $_POST['Kr'];
			$flagaction = $_POST['flagaction'];
				if($flagaction==1){
					 $this->mjurnal->saveheader($id,$_POST['Tgl'],$this->session->userdata('account_id'));
					for($i=0; $i<count($NoAk); $i++){
						$this->mjurnal->savedetail($id,$NoAk[$i],$ket[$i],$Db[$i],$Kr[$i]);
					} 
				}else if($flagaction==2){
					$this->mjurnal->Updateheader($_POST['NoVo'],$_POST['Tgl'],$this->session->userdata('account_id'));
					$this->mjurnal->deletedetail($_POST['NoVo']);
					for($j=0; $j<count($NoAk); $j++){
						$this->mjurnal->savedetail($_POST['NoVo'],$NoAk[$j],$ket[$j],$Db[$j],$Kr[$j]);
					}
				}
		}
		function pagination(){    
		 	if($_POST){
				$this->load->model("akun/mjurnal");
				$count=$this->mjurnal->countallsearch($_POST['byser'],$_POST['valser']);
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
		
		function getpagging(){
			if($_POST){
				$this->load->model("akun/mjurnal");
				$count=$this->mjurnal->countallsearch($_POST['byser'],$_POST['valser']);
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
		}
		
		function getselect(){ 
			if($_POST){
				$kode=$_POST['kode'];
				$this->load->model("akun/mjurnal");
				$rs=$this->mjurnal->getselect($kode);
				foreach($rs->result() as $row){
					$Tgl = strtotime($row->tanggal); 
					$TglAwl = date('d F Y', $Tgl);
					echo $row->novoucher."#".$row->kodekaryawan."#".$TglAwl;
				}
			}
		}

		function GetTablejurnal(){
			$this->load->model("akun/mjurnal");
			$Data['Data']=$this->mjurnal->GetTableJurnal($_POST['kode']);
			$this->load->view('akun/AjaxTableJurnal',$Data);
		}

		function deleteheader(){
			if($_POST){
				$this->load->model("akun/mjurnal");
				$this->mjurnal->deleteheader($_POST['kode']);
				
			}
		}
		
		function NewTablejurnal(){
			$id=$this->generateid("");
			echo '
				<input type=hidden value="'.$id.'" id="NewId"/>
				<table class="table table-bordered" style="margin-bottom:0px;" id="tabledetilindoor" style="margin-bottom:0px;">
					<thead>
						<tr>
							<th>No Perkiraan</th>
							<th>Nama Perkiraan</th>
							<th>Keterangan</th>
							<th>Debit</th>
							<th>Kredit</th>
							<th class=action>Action</th>
						</tr>
					</thead>
						<tr id="row0">
							<td align=center>
								<input type="text"  style="width:100px;cursor:pointer;" class="NoAk" name="NoAk[]" id="NoAk0" readonly />
							</td>
							<td align=center>
								<input type="text"  style="width:140px;cursor:pointer;" id="NNoAk0" class="NoAk" readonly />
							</td>
							<td>
								<textarea style="width:120px;height:30px;font-size:11px; resize:none;" class="ket" name="ket[]" id="ket0" ></textarea>
							</td>
							<td align=right>
								<input type="text"  style="width:100px;text-align:right;" class="Db" name="Db[]" id="Db0" onclick="DisDK(0,this.id)" />
							</td>
							<td align=right>
								<input type="text" style="width:100px;text-align:right;"  class="Kr" id="Kr0" name="Kr[]" onclick="DisDK(1,this.id)" />
							</td>
							<td class=action>
								<a id="row0" class="linkdel" style="cursor:pointer;">Delete</a>
							</td>
						</tr>
					</table>
					<table border=0>
						<tr>
							<td width=410px; style=text-align:center;>Balance</td>
							<td width=97px style="text-align:right" >
								<label id="TDb" >0</label>
							</td>
							<td width=98px style="text-align:right">
								<label id="TKr" >0</label>
							</td>
							<td width=35px class=action></td>
						</tr>
					</table>';
		}
	}