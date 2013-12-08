<?php
	class settingtabeltutupthn extends CI_Controller {
	public function index(){
			$this->load->model("mtutuptahun");
			$data['Comboper']=$this->mtutuptahun->GetComboper();
			$data['pernol']=$this->mtutuptahun->getresetper();
			$data['akumulasi']=$this->mtutuptahun->getakumulasi();
			$this->load->view("tutuptahun",$data);
		}
		function prosestutup(){
			
		}
		function getcombo(){
			$this->load->model("mtutuptahun");
			$Comboper=$this->mtutuptahun->GetComboper();
				
			
			echo "<tr id=row".$_POST['rowcount']."><td><select id=minreset name=minreset[] >";
				echo '<option value="">-- Piih --</option>';
				foreach($Comboper as $HCombo){
					echo '<option value="'.$HCombo->nomoraccount.'">'.$HCombo->nomoraccount.'</option>';
				}
			echo "</select></td><td><select id=maxreset name=maxreset[] >";
				echo '<option value="">-- Piih --</option>';
				foreach($Comboper as $HCombo){
					echo '<option value="'.$HCombo->nomoraccount.'">'.$HCombo->nomoraccount.'</option>';
				}
			echo "</select></td><td><a id='row".$_POST['rowcount']."' class='linkdel'>Delete</a></td></tr>";
		}
		
		
		function save(){
			$i=0;
			$this->load->model("mtutuptahun");
			$this->mtutuptahun->resetpernol();
			foreach($_POST['minreset'] as $min){
				$this->mtutuptahun->savesetnol($min,$_POST['maxreset'][$i]);
				$i++;
			}
			$this->mtutuptahun->saveakumulasi($_POST['akumulasi'],$this->LabaRugi());
			
			//echo $_POST['tahun'];
			echo $this->LabaRugi();
		}
		
		function LabaRugi(){
			$this->load->model("msettingrugilaba");
			$levelcetak = $this->msettingrugilaba->getlevelcetak('1');
			if(!$levelcetak){
				return false;
			}
			if($_POST){
				$rs=$this->msettingrugilaba->getsettinglabarugi();$nml1=""; $nml2=""; $Ctotal=0; $CGtotal=0;  $hasil=0;
				$CTllL2=array(); $CTtl2=0;
				if ($rs==false){
					return false;
				}
				foreach($rs->result() as $Hrs){
					
					if($Hrs->cetak==1){
					
						if($Hrs->level==$levelcetak-1){
							if($levelcetak==2) $Sub=1;
							else if($levelcetak==3) $Sub=3;
							else if($levelcetak==4) $Sub=6;
							//this year
							$SaldoAwl = $this->msettingrugilaba->GetSaldoJurnal($Hrs->nomoraccount,date('Y'),$Sub);
							if($SaldoAwl){
								foreach($SaldoAwl as $HSaldoJur){
									$Cyear=($HSaldoJur->saldo-$HSaldoJur->kredit)+$HSaldoJur->debit;
									$Ctotal+=$Cyear;
									$CGtotal+=$Cyear;
								}
							}else {/*echo 'gak ada saldo';*/}

						}else 
							if($Hrs->nomoraccount=="L1"){
									array_push($CTllL2,$CGtotal);
									$CGtotal=0;
							}
							if($Hrs->nomoraccount=="L2"){							
									$jj=0;
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
											$jj++;
										}
									$hasil=$CTtl2;
									unset($CTllL2);
									$CTllL2=array();
									array_push($CTllL2,$CTtl2);
							}
					}
				}
				return $hasil;
			}
		}
		
		
		
		
		
		
		
		
		
	}
?>