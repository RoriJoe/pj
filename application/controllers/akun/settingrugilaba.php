<?php
	class settingrugilaba extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/msettingneraca'));
		}

		function index(){
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->load->model("akun/msettingrugilaba");
			$data['Lvl2']=array(); $data['Lvl3']=array(); 
			$rs=$this->msettingrugilaba->getlevelperkiraan();
			$data['lvlctk']=$this->msettingrugilaba->getlevelcetak('1');
			if($rs){
				foreach($rs->result() as $row){
					if($row->level==2)
						array_push($data['Lvl2'],$row->nomoraccount);
					else if($row->level==3)
						array_push($data['Lvl3'],$row->nomoraccount);
				}
			}
			
			$this->load->view("akun/settingrugilaba",$data);
		}
		function Reset(){
			$this->load->model("akun/msettingrugilaba");
			$this->msettingrugilaba->ResSettingNerCetak();
			$this->getlistdata();
		}
		function SaveSettingNer(){
			if($_POST){
				$this->load->model("akun/msettingrugilaba");
				$this->msettingrugilaba->ResSettingNerCetak();
				$this->msettingrugilaba->updatelevel('1',$_POST['BatasCtk']);
				$i=0;
				foreach($_POST['Cetak'] as $id){
						$this->msettingrugilaba->SaveSettingNer($_POST['NoAk'.$id],$_POST['Nm'.$id],$_POST['From'.$id],$_POST['To'.$id],'1',$_POST[$id]);
				}
			}
		}
		function getlistdata(){
			if($_POST){
				$this->load->model("akun/msettingrugilaba");
				if(isset($_POST['BatasCtk'])){ 
					$this->msettingrugilaba->updatelevel('1',$_POST['BatasCtk']);
					$this->msettingrugilaba->ResSettingNerCetak();
				}
				$levelcetak = $this->msettingrugilaba->getlevelcetak('1');
				if(!$levelcetak){
					echo '<tr><td colspan=5>Silahkan Klik Save Untuk Menyimpan Level Cetak Terlebih Dahulu</td></tr>';
					return false;
				}
				
				$this->load->model("akun/msettingrugilaba");
				$rs=$this->msettingrugilaba->getsettinglabarugi(); $a=0; $b=0; $j=0; $i=0; $nml1=""; $nml2=""; $flag=0; $no2=""; $no=""; $tempno=""; $Flg=0;
				if ($rs==false){
					$rs=$this->msettingrugilaba->getperkiraan();
				}
				foreach($rs->result() as $Hrs){
					
					if($Hrs->level < $levelcetak){
						if($i==0){
							$a=$Hrs->level;
						}else if($i==1){
							$b=$Hrs->level;
						}
						if($levelcetak==4 && $b==$Hrs->level && $i!=1 && $Hrs->level!=1  || ($a==$Hrs->level  && $i!=0 && $levelcetak==4)){
							if($tempno != "L1" && $tempno != "L2" && $tempno != "L0"){
								if($Hrs->cetak==1)
									echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no2.'"  checked hidden /></td><td><input type="hidden" value="L0" name="NoAk'.$flag.'"; /><input type=text value="'.str_repeat("&nbsp;", 3).'Total '.$nml2.'" name="Nm'.$flag.'" ></input></td>'.str_repeat("<td></td>", 3).'</tr>';
								 else
									echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no2.'" hidden /></td><td><input type="hidden" value="L0" name="NoAk'.$flag.'"; /><input type=text value="'.str_repeat("&nbsp;", 3).'Total '.$nml2.'" name="Nm'.$flag.'" ></input></td>'.str_repeat("<td></td>", 3).'</tr>';
								$no2=""; $flag++;
							}
						}
						if($a==$Hrs->level && $i!=0 && $Hrs->level!=$levelcetak-1){ $i=0;
						
							if($tempno != "L1" && $tempno != "L2" && $tempno != "L0"){
								if($Hrs->cetak==1)
									echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'"  checked hidden /></td><td><input type="hidden" value="L1" name="NoAk'.$flag.'"; /><input type=text value="Total '.$nml1.'" name="Nm'.$flag.'" ></input ></td>'.str_repeat("<td></td>", 3).'</tr>';
								else
									echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" hidden /></td><td><input type="hidden" value="L1" name="NoAk'.$flag.'"; /><input type=text value="Total '.$nml1.'" name="Nm'.$flag.'" ></input ></td>'.str_repeat("<td></td>", 3).'</tr>';
							}
						$no=""; $flag++;
						}
						$tempno=$Hrs->nomoraccount;
						if($tempno=="L1" || $tempno=="L0"){
							$Flg++;
						}
						
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
						echo '<tr id="'.$flag.'"><td>';
							if($Hrs->nomoraccount != "L1" && $Hrs->nomoraccount != "L2" && $Hrs->nomoraccount != "L0"){
								if($Hrs->cetak==1) echo '<input type=checkbox name="Cetak[]" value="'.$flag.'" id="'.$Hrs->nomoraccount.'" checked onclick=Centang(this.id,"'.$Hrs->level.'") />';
								else{
									if($Hrs->level!=$levelcetak-1)
										echo '<input type=checkbox name="Cetak[]" value="'.$flag.'" id="'.$Hrs->nomoraccount.'" onclick=Centang(this.id,"'.$Hrs->level.'") />';
									else
										echo '<input type=checkbox name="Cetak[]" value="'.$flag.'" id="'.$Hrs->nomoraccount.'" onclick=Centang(this.id,"'.$Hrs->level.'") disabled />';
								}
							}else{
								if($Hrs->nomoraccount == "L2"){
									echo '<input type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no2.'" checked hidden  />';
								}else{
									echo '<input type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" checked hidden  />';
								}
							}
						echo '</td>';
						// perkiraan
						echo '<td>';
							if($Hrs->level==2) echo str_repeat("&nbsp;", 4);
							else if ($Hrs->level==3) echo str_repeat("&nbsp;", 8);
							echo '<input type="hidden" value="'.$Hrs->nomoraccount.'" name="NoAk'.$flag.'"; />';
								if($Hrs->tempnamaaccount){
									echo '<input type=text style=width:150px; value="'.$Hrs->tempnamaaccount.'" name="Nm'.$flag.'"; />';	
								}else{
									echo '<input type=text style=width:150px; value="'.$Hrs->namaaccount.'" name="Nm'.$flag.'"; />';	
								}
									
						echo '</td>';
						//tipe
						echo '<td align=center >';
							if($Hrs->level==$levelcetak-1)
								echo 'D';
							else{
								if($Hrs->nomoraccount != "L1" && $Hrs->nomoraccount != "L2"&& $Hrs->nomoraccount != "L0"){
									echo 'H';
								}else{
									if($Flg>1){ 
										echo '<input type="button" id="N'.$j.'" value="New" class="butformemploy" onclick=AddRows("'.$flag.'","N'.($j).'"); />';
										if($Hrs->nomoraccount == "L2"){
											echo '<input type="button" class="btn" id="" value="Del" class="butformemploy" onclick=DelRows("'.$flag.'","N'.($j-1).'"); />';
											echo '<script>document.getElementById("N'.($j-1).'").hidden="hidden";</script>';
											echo '<script>document.getElementById("N'.($j).'").hidden="hidden";</script>';
										}
									}
								}
							}
						echo '</td>';
						if($Hrs->level==$levelcetak-1){
							$Sub=0;
							if($levelcetak==2) $Sub=1;
							else if($levelcetak==3) $Sub=3;
							else if($levelcetak==4) $Sub=6;
							$Combo = $this->msettingrugilaba->GetCombo($Hrs->nomoraccount,$levelcetak,$Sub);
							$Max =  $this->msettingrugilaba->GetComboMaxMin($Hrs->nomoraccount,$levelcetak,"Max",$Sub);
							$Dari = $this->msettingrugilaba->GetSettingNer($Hrs->nomoraccount,"dari");
							$Sampai = $this->msettingrugilaba->GetSettingNer($Hrs->nomoraccount,"sampai");
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
						}else{
							if($Hrs->operator!=0){
								echo '<td colspan=2 align=center>';
								if($Hrs->operator==1)
									echo '<input type=radio name="'.$flag.'" value="1" checked >+</input>&nbsp;&nbsp;<input type=radio value="2"  name="'.$flag.'" >-</input>';
								else
									echo '<input type=radio name="'.$flag.'" value="1" >+</input>&nbsp;&nbsp;<input type=radio value="2"  name="'.$flag.'" checked >-</input>';
								echo '</td></tr>';
							}else
								echo '<td></td><td></td></tr>';
						}
					}
					$i++; $flag++; $j++;
				}
				if($levelcetak==4 ){
					if($Hrs->nomoraccount != "L1" && $Hrs->nomoraccount != "L2" && $Hrs->nomoraccount != "L0"){
						if($Hrs->cetak==1)
							echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" checked hidden /></td><td><input type=text value="'.str_repeat("&nbsp;", 3).'Total '.$nml2.'" name="Nm'.$flag.'" ></input></td>'.str_repeat("<td></td>", 3).'</tr>';
						 else
							echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" hidden /></td><td><input type=text value="'.str_repeat("&nbsp;", 3).'Total '.$nml2.'" name="Nm'.$flag.'" ></input></td>'.str_repeat("<td></td>", 3).'</tr>';
					}
				}
				if($levelcetak!=2){
					if($Hrs->nomoraccount != "L1" && $Hrs->nomoraccount != "L2" && $Hrs->nomoraccount != "L0"){
						if($Hrs->cetak==1)
							echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" checked hidden /></td><td><input type=text value="Total '.$nml1.'" name="Nm'.$flag.'" ></input ></td>'.str_repeat("<td></td>", 3).'</tr>';
						else
							echo '<tr><td><input  type=checkbox name="Cetak[]" value="'.$flag.'" id="T'.$no.'" hidden /></td><td><input type=text value="Total '.$nml1.'" name="Nm'.$flag.'" ></input ></td><td></td><td></td><td></td></tr>';
					}
				}
			}
		}
		
		function ViewJurnal(){
			$this->load->model("akun/msettingrugilaba");
			$levelcetak = $this->msettingrugilaba->getlevelcetak('1');
			if(!$levelcetak){
				return false;
			}
			if($_POST){
				$rs=$this->msettingrugilaba->getsettinglabarugi();$nml1=""; $nml2=""; $Ctotal=0; $Ltotal=0; $CGtotal=0; $LGtotal=0; $VGtotal=0;  $fttl=0;
				$CTllL2=array(); $LTllL2=array(); $VTllL2=array(); $CTtl2=0; $LTtl2=0;
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
						echo '<td valign="bottom">';
							if($Hrs->nomoraccount=="L2")echo '<b>';
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
							$SaldoAwl = $this->msettingrugilaba->GetSaldoJurnal($Hrs->nomoraccount,date('Y'),$Sub);
							if($SaldoAwl){
								foreach($SaldoAwl as $HSaldoJur){
									//echo $HSaldoJur->saldo.'--';
									$Cyear=($HSaldoJur->saldo-$HSaldoJur->kredit)+$HSaldoJur->debit;
									$Table = $this->msettingrugilaba->GetTable($Hrs->nomoraccount);
									if($Table){
										foreach($Table as $Htable){
											$this->load->model("akun/MCetakBukuBesar");
											$Other = $this->MCetakBukuBesar->GetOther($Htable->namatabel,$Htable->nama);
											foreach($Other as $Hother){
												if($Htable->debitkredit==0){
													$Cyear+=$Hother->total;
												}else{
													$Cyear-=$Hother->total;
												}
											}
										}
									}
									echo $this->Uang($Cyear);
									$Ctotal+=$Cyear;
									$CGtotal+=$Cyear;
								}
								
							}else {echo 'gak ada';}
							echo '</td><td></td>';
							//this last year
							echo '<td align=right>';
								$LSaldoAwl = $this->msettingrugilaba->GetSaldoJurnal($Hrs->nomoraccount,date('Y')-1,$Sub);
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
								$VGtotal+=($Cyear-$Lyear);
							echo '</td>';

						}else 
							if($Hrs->nomoraccount=="L1"){
							
									//total This Year
									echo '<td align=right><hr style=margin-top:-4px; />';
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
									array_push($CTllL2,$CGtotal);
									array_push($LTllL2,$LGtotal);
									array_push($VTllL2,$VGtotal);
									$CGtotal=0;
									$LGtotal=0;
									$VGtotal=0;
									$fttl=0;
							}
							if($Hrs->nomoraccount=="L2"){							
									$jj=0;
									echo '<td align=right><hr  style=margin-top:-4px;/><b>';
										foreach($CTllL2 as $T2){
											if($jj==0){
												$CTtl2=$T2;
											}else{
												if($Hrs->operator==2){
													$CTtl2-=$T2;
												}else{ 
													$CTtl2+=$T2;
												}
											}
											$jj++; //echo '--'.$T2.'--';
										}
										echo $this->Uang($CTtl2);
									unset($CTllL2);
									$CTllL2=array();
									array_push($CTllL2,$CTtl2);
									echo '</b></td><td></td>';
									//total Last Year
									echo '<td align=right><hr  style=margin-top:-4px;/><b>';
										$kk=0;
											foreach($LTllL2 as $L2){
												if($kk==0){
													$LTtl2=$L2;
												}else{
													if($Hrs->operator==2){
														$LTtl2-=$L2;
													}else{ 
														$LTtl2+=$L2;
													}
												}
												$kk++;// echo '--'.$L2.'--';
											}
										echo $this->Uang($LTtl2);
										unset($LTllL2);
										$LTllL2=array();
										array_push($LTllL2,$LTtl2);
									echo '</b></td><td></td>';
									//total Variance
									echo '<td align=right><hr  style=margin-top:-4px;/><b>';
										//echo $this->Uang($CTtl2-$LTtl2);
										$ll=0;
											foreach($VTllL2 as $V2){
												if($ll==0){
													$VTtl2=$V2;
												}else{
													if($Hrs->operator==2){
														$VTtl2-=$V2;
													}else{ 
														$VTtl2+=$V2;
													}
												}
												$ll++;
											}
										echo $this->Uang($VTtl2);
										unset($VTllL2);
										$VTllL2=array();
										array_push($VTllL2,$VTtl2);
										
									echo '</b></td></tr><tr><td colspan=7 height="15px"></td></tr>';
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
	
}
?>