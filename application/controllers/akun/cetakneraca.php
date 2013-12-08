<?php
	class cetakneraca extends CI_Controller {
		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/msettingneraca'));
		}
		
		function index(){
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->load->view("akun/cetakneraca", $data);
		}
		
		function searchjurnal(){			
			$this->load->model("akun/msettingneraca");
			$levelcetak = $this->msettingneraca->getlevelcetak('1');
			if(!$levelcetak){
				return false;
			}
			if($_POST){
				$rs=$this->msettingneraca->getsettingneraca();$nml1=""; $nml2=""; $Ctotal=0; $Ltotal=0; $CGtotal=0; $LGtotal=0; $fttl=0;
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
							$SaldoAwl =$this->msettingneraca->SearchSaldoJurnal($Hrs->nomoraccount,$_POST['thn'],$_POST['bln'],$Sub);
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
								$LSaldoAwl = $this->msettingneraca->SearchSaldoJurnal($Hrs->nomoraccount,$_POST['thn']-1,$_POST['bln'],$Sub);
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
							echo '</td>';
							$fttl=0;
						}else 
							if(!$Hrs->nomoraccount){ $fttl++;
								if($fttl>1){
									//total This Year
									echo '<td align=right><hr  size="3"/>';
										echo $this->Uang($CGtotal);
									echo '</td><td></td>';
									//total Last Year
									echo '<td align=right><hr  size="3"/>';
										echo $this->Uang($LGtotal);
									echo '</td><td></td>';
									//total Variance
									echo '<td align=right><hr  size="3"/>';
										echo $this->Uang($CGtotal-$LGtotal);
									echo '</td>';
									$CGtotal=0;
									$LGtotal=0;
									$fttl=0;
								}else{
									//total This Year
									echo '<td align=right><hr  size="3"/>';
										echo $this->Uang($Ctotal);
									echo '</td><td></td>';
									//total Last Year
									echo '<td align=right><hr  size="3"/>';
										echo $this->Uang($Ltotal);
									echo '</td><td></td>';
									//total Variance
									echo '<td align=right><hr  size="3"/>';
										echo $this->Uang($Ctotal-$Ltotal);
									echo '</td>';
									$Ctotal=0;
									$Ltotal=0;
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
	}
?>