<?php
	class settingneraca extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/msettingneraca'));
		}

		function index(){
			$rs=$this->msettingneraca->getlevelperkiraan();

			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$data['Lvl2']=array(); 
			$data['Lvl3']=array();
			$data['lvlctk']=$this->msettingneraca->getlevelcetak('1');

			if($rs){
				foreach($rs->result() as $row){
					if($row->level==2)
						array_push($data['Lvl2'],$row->nomoraccount);
					else if($row->level==3)
						array_push($data['Lvl3'],$row->nomoraccount);
				}
			}
			
			$this->load->view('akun/settingneraca', $data);
		}

		function Reset(){
			$this->load->model("akun/msettingneraca");
			$this->msettingneraca->ResSettingNerCetak();
			$this->getlistdata();
		}
		function SaveSettingNer(){
			if($_POST){
				$this->load->model("akun/msettingneraca");
				$this->msettingneraca->ResSettingNerCetak();
				$this->msettingneraca->updatelevel('1',$_POST['BatasCtk']);
				$i=0;
				foreach($_POST['Cetak'] as $id){
						$this->msettingneraca->SaveSettingNer($_POST['NoAk'.$id],$_POST['Nm'.$id],$_POST['From'.$id],$_POST['To'.$id],'1');
				}
				
			}
		}
		
		
		function getlistdata(){
			if($_POST){
				$this->load->model("akun/msettingneraca");
				if(isset($_POST['BatasCtk'])){ 
					$this->msettingneraca->updatelevel('1',$_POST['BatasCtk']);
					$this->msettingneraca->ResSettingNerCetak();
				}
				$levelcetak = $this->msettingneraca->getlevelcetak('1');
				if(!$levelcetak){
					echo '<tr><td colspan=5>Silahkan Klik Save Untuk Menyimpan Level Cetak Terlebih Dahulu</td></tr>';
					return false;
				}
				
				$this->load->model("akun/msettingneraca");
				$rs=$this->msettingneraca->getsettingneraca(); $a=0; $b=0; $i=0; $nml1=""; $nml2=""; $flag=0; $no2=""; $no=""; $tempno=""; $fttl=0;
				if ($rs==false){
					$rs=$this->msettingneraca->getperkiraan();
				}
				foreach($rs->result() as $Hrs){
					
					if($Hrs->level < $levelcetak){
						if($i==0){
							$a=$Hrs->level;
						}else if($i==1){
							$b=$Hrs->level;
						}
						if($levelcetak==4 && $b==$Hrs->level && $i!=1 && $Hrs->level!=1  || ($a==$Hrs->level  && $i!=0 && $levelcetak==4)){
							if($tempno){
								if($Hrs->cetak==1)
									echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no2.'"  checked /></td><td><input type=text value="'.str_repeat("&nbsp;", 3).'Total '.$nml2.'" name="Nm'.$flag.'" ></input></td>'.str_repeat("<td></td>", 3).'</tr>';
								 else
									echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no2.'"  /></td><td><input type=text value="'.str_repeat("&nbsp;", 3).'Total '.$nml2.'" name="Nm'.$flag.'" ></input></td>'.str_repeat("<td></td>", 3).'</tr>';
								$no2=""; $flag++;
							}
						}
						if($a==$Hrs->level && $i!=0 && $Hrs->level!=$levelcetak-1){ $i=0;
							if($tempno){
								if($Hrs->cetak==1)
									echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'"  checked /></td><td><input type=text value="Total '.$nml1.'" name="Nm'.$flag.'" ></input ></td>'.str_repeat("<td></td>", 3).'</tr>';
								else
									echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'"  /></td><td><input type=text value="Total '.$nml1.'" name="Nm'.$flag.'" ></input ></td>'.str_repeat("<td></td>", 3).'</tr>';
							}
						$no=""; $flag++;
						}
						$tempno=$Hrs->nomoraccount;
						
						if($Hrs->level==1){
							if($Hrs->tempnamaaccount){
								$nml1=$Hrs->tempnamaaccount;
							}else{
								$nml1=$Hrs->namaaccount;
							}
							$no=$Hrs->nomoraccount;
						}else if($Hrs->level==2){
							if($Hrs->tempnamaaccount){
								$nml2=$Hrs->tempnamaaccount;
							}else{
								$nml2=$Hrs->namaaccount;
							}
							$no2=$Hrs->nomoraccount;
						}
						//checkbox
						echo '<tr><td>';
							if($tempno){$fttl++;
								if($Hrs->cetak==1) echo '<input type=checkbox name="Cetak[]" value="'.$flag.'" id="'.$Hrs->nomoraccount.'" checked onclick=Centang(this.id,"'.$Hrs->level.'") />';
								else {
									echo '<input type=checkbox name="Cetak[]" value="'.$flag.'" id="'.$Hrs->nomoraccount.'" onclick=Centang(this.id,"'.$Hrs->level.'") />';						
								}
							}else{
								if($fttl>1){
									echo '<input type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no2.'" checked hidden  />';
								}else{
									echo '<input type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" checked hidden  />';
								}
								$fttl=0;
							}
						echo '</td>';
						// perkiraan
						echo '<td>';
							if($Hrs->level==2) echo str_repeat("&nbsp;", 4);
							else if ($Hrs->level==3) echo str_repeat("&nbsp;", 8);
							echo '<input type="hidden" value="'.$Hrs->nomoraccount.'" name="NoAk'.$flag.'"; />';
								if($Hrs->tempnamaaccount){
									echo '<input type=text  value="'.$Hrs->tempnamaaccount.'" name="Nm'.$flag.'"; style=width:80%; />';	
								}else{
									echo '<input type=text  value="'.$Hrs->namaaccount.'" name="Nm'.$flag.'"; style=width:80%; />';	
								}
									
						echo '</td>';
						//tipe
						echo '<td>';
							if($Hrs->level==$levelcetak-1)
								echo 'D';
							else{
								if($tempno)
									echo 'H';
							}
						echo '</td>';
						if($Hrs->level==$levelcetak-1){
							$Sub=0;
							if($levelcetak==2) $Sub=1;
							else if($levelcetak==3) $Sub=3;
							else if($levelcetak==4) $Sub=6;
							$Combo = $this->msettingneraca->GetCombo($Hrs->nomoraccount,$levelcetak,$Sub);
							$Max =  $this->msettingneraca->GetComboMaxMin($Hrs->nomoraccount,$levelcetak,"Max",$Sub);
							$Dari = $this->msettingneraca->GetSettingNer($Hrs->nomoraccount,"dari");
							$Sampai = $this->msettingneraca->GetSettingNer($Hrs->nomoraccount,"sampai");
							//from
							if($Combo){
								echo '<td><select name="From'.$flag.'">';
									foreach($Combo as $HCombo){
										if($Dari==$HCombo->nomoraccount)
											echo '<option value="'.$HCombo->nomoraccount.'" selected>'.$HCombo->nomoraccount.'</option>';
										else
											echo '<option value="'.$HCombo->nomoraccount.'">'.$HCombo->nomoraccount.'</option>';
									}
										
								echo '</select></td>';
								//To
								echo '<td><select name="To'.$flag.'">';
									foreach($Combo as $HCombo){
										if($Max==$HCombo->nomoraccount && $Sampai==false)
											echo '<option value="'.$HCombo->nomoraccount.'" selected >'.$HCombo->nomoraccount.'</option>';
										else if($Sampai==$HCombo->nomoraccount)
											echo '<option value="'.$HCombo->nomoraccount.'" selected >'.$HCombo->nomoraccount.'</option>';
										else 
											echo '<option value="'.$HCombo->nomoraccount.'" >'.$HCombo->nomoraccount.'</option>';
									}
								echo '</select></td>';
							}else
								echo '<td></td><td></td>';
						}else
							echo '<td></td><td></td></tr>';
						
					
					}
					$i++; $flag++;
				}
				if($levelcetak==4 ){
					if($tempno){
						if($Hrs->cetak==1)
							echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" checked /></td><td><input type=text value="'.str_repeat("&nbsp;", 3).'Total '.$nml2.'" name="Nm'.$flag.'" ></input></td>'.str_repeat("<td></td>", 3).'</tr>';
						 else
							echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" /></td><td><input type=text value="'.str_repeat("&nbsp;", 3).'Total '.$nml2.'" name="Nm'.$flag.'" ></input></td>'.str_repeat("<td></td>", 3).'</tr>';
					}
				}
				if($levelcetak!=2){
					if($tempno){
						if($Hrs->cetak==1)
							echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" checked /></td><td><input type=text value="Total '.$nml1.'" name="Nm'.$flag.'" ></input ></td>'.str_repeat("<td></td>", 3).'</tr>';
						else
							echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" /></td><td><input type=text value="Total '.$nml1.'" name="Nm'.$flag.'" ></input ></td>'.str_repeat("<td></td>", 3).'</tr>';
					}
				}
			}
		}
		
		function ViewJurnal(){
			$this->load->model("akun/msettingneraca");
			$levelcetak = $this->msettingneraca->getlevelcetak('1');
			if(!$levelcetak){
				return false;
			}
			if($_POST){
				$rs=$this->msettingneraca->getsettingneraca();$nml1=""; $nml2=""; $Ctotal=0; $Ltotal=0; $Vtotal=0; $CGtotal=0; $LGtotal=0; $VGtotal=0; $fttl=0;
				if ($rs==false){
					return false;
				}
				foreach($rs->result() as $Hrs){
					
					if($Hrs->cetak==1){
						if($Hrs->level==1){
							if($Hrs->tempnamaaccount){
								$nml1=$Hrs->tempnamaaccount;
							}else{
								$nml1=$Hrs->namaaccount;
							}
							
						}else if($Hrs->level==2){
							if($Hrs->tempnamaaccount){
								$nml2=$Hrs->tempnamaaccount;
							}else{
								$nml2=$Hrs->namaaccount;
							}
						}
						echo '<tr>';
							
						// nama perkiraan
						echo '<td>';
								if($Hrs->level==2) echo str_repeat("&nbsp;", 5);
								else if ($Hrs->level==3) echo str_repeat("&nbsp;", 10);
								if($Hrs->tempnamaaccount){
									echo $Hrs->tempnamaaccount;
								}else{
									echo $Hrs->namaaccount;
								}
								
						echo '</td>';
						if($Hrs->level==$levelcetak-1){
							if($levelcetak==2) $Sub=1;
							else if($levelcetak==3) $Sub=3;
							else if($levelcetak==4) $Sub=6;
							
							//this year
							echo '<td align=right>';
							$SaldoAwl = $this->msettingneraca->GetSaldoJurnal($Hrs->nomoraccount,date('Y'),$Sub);
							if($SaldoAwl){
								foreach($SaldoAwl as $HSaldoJur){
									$Cyear=($HSaldoJur->saldo-$HSaldoJur->kredit)+$HSaldoJur->debit;
									echo $this->Uang($Cyear);
									$Ctotal+=$Cyear;
									$CGtotal+=$Cyear;
								}
							}else {echo 'gak ada';}
							echo '</td><td></td>';
							//this last year
							echo '<td align=right>';
								$LSaldoAwl = $this->msettingneraca->GetSaldoJurnallastyear($Hrs->nomoraccount,date('Y')-1,$Sub);
								if($LSaldoAwl){
									foreach($LSaldoAwl as $HSaldo){
										$Lyear=($HSaldo->saldo-$HSaldo->kredit)+$HSaldo->debit;
										echo $this->Uang($Lyear);
										$Ltotal+=$Lyear;
										$LGtotal+=$Lyear;
									}
								}else {echo 'gak ada';}
							echo '</td><td></td>';
							//variance
							echo '<td align=right>';
								echo $this->Uang($Cyear-$Lyear);
								$Vtotal = $Ctotal-$Ltotal;
								$VGtotal = $Ctotal-$Ltotal;
							echo '</td>';
							$fttl=0;
						}else 
							if(!$Hrs->nomoraccount){ $fttl++;
								if($fttl>1){
									//total This Year
									echo '<td align=right><hr  style=margin-top:-4px;/>';
										echo $this->Uang($CGtotal);
									echo '</td><td></td>';
									//total Last Year
									echo '<td align=right><hr  style=margin-top:-4px;/>';
										echo $this->Uang($LGtotal);
									echo '</td><td></td>';
									//total Variance
									echo '<td align=right><hr  style=margin-top:-4px;/>';
										echo $this->Uang($VGtotal);
									echo '</td>';
									$CGtotal=0;
									$LGtotal=0;
									$VGtotal=0;
									$fttl=0;
								}else{
									//total This Year
									echo '<td align=right><hr  style=margin-top:-4px;/>';
										echo $this->Uang($Ctotal);
									echo '</td><td></td>';
									//total Last Year
									echo '<td align=right><hr style=margin-top:-4px;/>';
										echo $this->Uang($Ltotal);
									echo '</td><td></td>';
									//total Variance
									echo '<td align=right><hr  style=margin-top:-4px;/>';
										echo $this->Uang($Vtotal);
									echo '</td>';
									$Ctotal=0;
									$Ltotal=0;
									$Vtotal=0;
								}
							}
						echo '</tr>';
					}
				}
			}
		}
		
		function Uang($uang){
			$in_rp =number_format($uang, 0, '.', '.');
				if($in_rp < 0)
					return '('.$in_rp.')';
				else
					return $in_rp;
		 }
		function UpdateNamaPer(){
		
			echo 'asdfsafd';
		
		}
	
	
	
	
	
	
	
	
}
?>