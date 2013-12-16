<?php if ( ! defined('BASEPATH')){exit('No direct script access allowed');
}
	class mappingperkiraan extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/msettingneraca'));
		}

		private $limit=2;
		
		function index(){
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->load->model("akun/mmappingperkiraan");
			$data['Combo']=$this->mmappingperkiraan->GetJenis();
			$this->load->view("akun/mappingperkiraan",$data);
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
				$this->load->model("akun/mmappingperkiraan");
				$rs=$this->mmappingperkiraan->getalllistsearch($_POST['byser'],$_POST['valser'],$_POST['limit'],$_POST['offset']);
				foreach($rs->result() as $row){
					echo "<tr><td style=display:none;>$row->id</td><td>$row->tipe $row->jenis</td><td style='text-align:center;'><a id='$row->id' class='imgupdate btn'><i class='icon-pencil'></i></a><a id='$row->id' class='imgdelete btn'><i class='icon-trash'></i></a></td></tr>";
				}
			}
		}
		
		function getselect(){ 
			if($_POST){
				$kode=$_POST['kode'];
				$this->load->model("akun/mmappingperkiraan");
				$rs=$this->mmappingperkiraan->getselect($kode);
				foreach($rs->result() as $row){
					$parent =$this->mmappingperkiraan->getparentid($row->id);
					echo $row->id."#".$parent;
				}
			}
		}

		function pagination(){    
		 	if($_POST){
				$this->load->model("akun/mmappingperkiraan");
				$count=$this->mmappingperkiraan->countallsearch($_POST['byser'],$_POST['valser']);
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
				if($_POST['offset']+$_POST['limit']>=$lastpage){
					$next=$lastpage-1;
				}else{
					$next = $_POST['offset']+$_POST['limit'];
				}
				$lpm1 = $lastpage - 1;				
				$lpage=($_POST['offset']/$_POST['limit'])+1;
				$pagination = "";
				if($lastpage > 1)
				{  	
					$pagination .= "<ul class='pagination'>";
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
							$pagination.= "<li><a id='2'>2</a></li>";
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
					 
					if ($page < $counter - 1){
						$pagination.= "<li><a id='$next'>Next</a></li>";
						$pagination.= "<li><a id='".($lastpage-1)*$_POST['limit']."'>Last</a></li>";
					}else{
						$pagination.= "<li><a class='current' id='".($lpage-1)*$_POST['limit']."'>Next</a></li>";
						$pagination.= "<li><a class='current' id='".($lpage-1)*$_POST['limit']."'>Last</a></li>";
					}
					$pagination.= "</ul>\n";     
				}          
				echo $pagination;
			}
		} 		
		
		function getpagging(){
			if($_POST){
				$this->load->model("akun/mmappingperkiraan");
				$count=$this->mmappingperkiraan->countallsearch($_POST['byser'],$_POST['valser']);
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

		function GetTabMapPer(){
			$this->load->model("akun/mmappingperkiraan");
			$Data=$this->mmappingperkiraan->GetTableMap($_POST['kode']);
			$i=0;
			foreach($Data as $HData){
				echo '<tr id="row'.$i.'">
						<td align=center><input type="text"  style="width:100px;cursor:pointer;" class="NoAk" name="NoAk[]" kode="'.$i.'" id="NoAk'.$i.'" value="'.$HData->nomoraccount.'" readonly /></td>
						<td align=center><input type="text"  style="width:200px;background-color:rgb(240,240,240);" kode="'.$i.'" id="NNoAk'.$i.'" class="NoAk" value="'.$HData->namaaccount.'" readonly /></td>';
					if($HData->debitkredit==0){
						echo '<td><input  style=width:15px; value="0" name="DK'.$i.'" type="radio" checked class="DbKr" ></input></td>
						<td><input  style=width:15px; value="1" name="DK'.$i.'" type="radio" class="DbKr" ></input></td>';
					}else{
						echo '<td><input  style=width:15px; value="0" name="DK'.$i.'" type="radio" class="DbKr" ></input></td>
						<td><input  style=width:15px; value="1" name="DK'.$i.'" type="radio" checked class="DbKr" ></input></td>';
					}
				echo '<td>'; 
					$tabel = $this->mmappingperkiraan->GetTableName($_POST['id']);
					echo '<select onchange="GetAtt(this.value)" class="">';
					echo '<option value="" >-- pilih --</option>';
					foreach($tabel as $Htabel){
						if($this->mmappingperkiraan->GetIdTab($HData->nomoraccount,$_POST['kode']) ==$Htabel->idtab )
							echo '<option value="'.$Htabel->idtab.'" selected>'.$Htabel->namatabel.'</option>';
						else
							echo '<option value="'.$Htabel->idtab.'" >'.$Htabel->namatabel.$Htabel->idtab.'</option>';
					}
					echo '</select>';
				echo '</td>';
				echo '<td><div id="Attr1">';
						$field = $this->mmappingperkiraan->GetFieldNameView($HData->nomoraccount,$_POST['id']);
						foreach($field as $Hfield){
							if($HData->idfield == $Hfield->idfield)
								echo '<input type="radio" class="" style=width:15px; name="Attr'.$i.'" value="'.$Hfield->idfield.'" checked >'.$Hfield->nama.'</input></br>';
							else
								echo '<input type="radio" class="" style=width:15px; name="Attr'.$i.'" value="'.$Hfield->idfield.'" >'.$Hfield->nama.'</input></br>';
						}
				echo '</div></td>';
				echo '<td class=action><a id="row'.$i.'" class="linkdel">Delete</a></td></tr>';
				$i++;
			}
			echo '<script>rowcount="'.$i.'";</script>';
		}

		function deleteheader(){
			if($_POST){
				echo $_POST['kode'];
				$this->load->model("akun/mmappingperkiraan");
				$this->mmappingperkiraan->deletedetail($_POST['kode']);
			}
		}

		function SaveMap(){
			$this->load->model("akun/mmappingperkiraan");	
			$flagaction = $_POST['flagaction'];
			$NoAk=$_POST['NoAk'];
			$id =  $this->mmappingperkiraan->GetIdMap($_POST['TipeTran']);
				if($flagaction==1){
					for($i=0; $i<count($NoAk); $i++){
						$this->mmappingperkiraan->savedetail($_POST['Attr'.$i],$NoAk[$i],$_POST['DK'.$i]);
						
					}
				}else if($flagaction==2){
					$this->mmappingperkiraan->deletedetail($id);
					for($j=0; $j<count($NoAk); $j++){
						$this->mmappingperkiraan->savedetail($_POST['Attr'.$j],$NoAk[$j],$_POST['DK'.$j]);
					}
				}
			/* foreach($_POST['NamaTabel'] as $Htab){
				foreach( $_POST[$Htab] as $Hfield){
					$this->mmappingperkiraan->SetCetak($id,$Hfield);
				}
			} */
		}

		function GetNmTab(){
			if($_POST){
				$this->load->model("akun/mmappingperkiraan");
				$tabel = $this->mmappingperkiraan->GetTableName($_POST['id']);
				echo '<select onchange=GetAtt(this.value,"'.$_POST['idxcmb'].'"); class="idxcmb">';
				echo '<option value="" >-- pilih --</option>';
				foreach($tabel as $Htabel){
					echo '<option value="'.$Htabel->idtab.'" >'.$Htabel->namatabel.'</option>';
				}
				echo '</select>';
			}
		}

		function GetAttr(){
			if($_POST){
				$this->load->model("akun/mmappingperkiraan");
				$field = $this->mmappingperkiraan->GetFieldName($_POST['id']);
				foreach($field as $Hfield){
						echo '<input type="radio" style=width:15px; name="Attr'.$_POST['row'].'" value="'.$Hfield->idfield.'" >'.$Hfield->nama.'</input></br>';
				}
			}
		}

		function GetTipe(){
			$this->load->model("akun/mmappingperkiraan");
			$tipe=$this->mmappingperkiraan->GetTipe($_POST['id']);
			if($tipe){
				echo ' Tipe : <select id="TipeTran" name="TipeTran" >';
					foreach($tipe as $Htipe){
						echo '<option value="'.$Htipe->id.'">'.$Htipe->nama.'</option>';
					}
				echo '</select>';
			}
		}
		
		function NewTablejurnal(){
			echo '<table class="table table-bordered" id="tabledetilindoor" cellspacing="0">
					<thead>
						<tr>
							<th>No Perkiraan</th><th>Nama Perkiraan</th><th width=10px;>D</th><th>K</th><th>Table</th><th>Attribute</th><th class=action >Action</th>
						</tr>
					</thead>
					<tr id="row0">
						<td align=center>
                            <input type="text" kode=0 class="span2 NoAk" id="NoAk0" id="appendedInputButton" name="NoAk[]" style=width:100px;cursor:pointer;margin-bottom:8px;height: 24px;" title="click to show list" readonly/>
                        </td>
						<td align=center>
                            <input type="text" kode=0 class="span2 NoAk" id="NNoAk0" id="appendedInputButton" style=width:200px;margin-bottom:8px;cursor:pointer;height: 24px;" title="click to show list" readonly/>
						</td>
						<td><input  style=width:15px; value="0" name="DK0" type="radio" checked ></input></td>
						<td><input  style=width:15px; value="1" name="DK0" type="radio" ></td>
						<td><div id="ListAtt0"><select><option value="">-- pilih --</option></select></div></td>
						<td><div id="Attr0"></div></td>
						<td class=action><a id="row0" class="linkdel" style="cursor:pointer">Delete</a></td>
					</tr>
					
				</table>';
		}
	}
