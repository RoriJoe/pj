<?php
	class cetaklabarugi extends CI_Controller {
		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/msettingrugilaba'));
		}

		function index(){
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->load->view("akun/cetaklabarugi", $data);
		}
		
		function searchlabarugi(){	
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
							$SaldoAwl = $this->msettingrugilaba->GetSaldoJurnalSrc($Hrs->nomoraccount,$_POST['thn'],$_POST['Smpthn'],$_POST['bln'],$_POST['Smpbln'],$Sub);
							if($SaldoAwl){
								foreach($SaldoAwl as $HSaldoJur){
									//echo $HSaldoJur->saldo.'--';
									$Cyear=($HSaldoJur->saldo-$HSaldoJur->kredit)+$HSaldoJur->debit;
									$Table = $this->msettingrugilaba->GetTable($Hrs->nomoraccount);
									if($Table){
										foreach($Table as $Htable){
											$this->load->model("akun/MCetakBukuBesar");
											$Other = $this->msettingrugilaba->GetOther($Htable->namatabel,$Htable->nama,$_POST['thn'],$_POST['Smpthn'],$_POST['bln'],$_POST['Smpbln']);
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
								$LSaldoAwl = $this->msettingrugilaba->GetSaldoJurnalSrcLast($Hrs->nomoraccount,$_POST['thn']-1,$_POST['Smpthn']-1,$_POST['bln'],$_POST['Smpbln'],$Sub);
								if($LSaldoAwl){
									foreach($LSaldoAwl as $HSaldo){
										$Lyear=($HSaldo->saldo-$HSaldo->kredit)+$HSaldo->debit;
										
										$Table = $this->msettingrugilaba->GetTable($Hrs->nomoraccount);
										if($Table){
											foreach($Table as $Htable){
												$this->load->model("akun/MCetakBukuBesar");
												$Other = $this->msettingrugilaba->GetOther($Htable->namatabel,$Htable->nama,$_POST['thn']-1,$_POST['Smpthn']-1,$_POST['bln'],$_POST['Smpbln']);
												foreach($Other as $Hother){
													if($Htable->debitkredit==0){
														$Cyear+=$Hother->total;
													}else{
														$Cyear-=$Hother->total;
													}
												}
											}
										}
										
										
										
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
			return $in_rp =number_format($uang, 0, '.', '.');
		 }
	}
?>