<?php
	class tutuptahun extends CI_Controller {
		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/mtutuptahun'));
		}

		function index(){
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->load->model("akun/mtutuptahun");
			$data['Comboper']=$this->mtutuptahun->GetComboper();
			$data['pernol']=$this->mtutuptahun->getresetper();
			$data['akumulasi']=$this->mtutuptahun->getakumulasi();
			$this->load->view("akun/tutuptahun",$data);
		}

		function getcombo(){
			$this->load->model("akun/mtutuptahun");
			$Comboper=$this->mtutuptahun->GetComboper();
				
			
			echo "<tr id=row".$_POST['rowcount']."><td><select id=minreset name=minreset[] >";
				echo '<option value="">-- Piih --</option>';
				foreach($Comboper as $HCombo){
					echo '<option value="'.$HCombo->nomoraccount.'">'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
				}
			echo "</select></td><td><select id=maxreset name=maxreset[] >";
				echo '<option value="">-- Piih --</option>';
				foreach($Comboper as $HCombo){
					echo '<option value="'.$HCombo->nomoraccount.'">'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
				}
			echo "</select></td><td><a id='row".$_POST['rowcount']."' class='linkdel' href='#'><u>Delete</u></a></td></tr>";
		}
		
		function save(){
		 	$i=0;
			$this->load->model("akun/mtutuptahun");
			$this->mtutuptahun->resetpernol();
			$this->mtutuptahun->savehistory($_POST['tahun']);
			foreach($_POST['minreset'] as $min){
				$this->mtutuptahun->savesetnol($min,$_POST['maxreset'][$i],$_POST['tahun']);
				$i++;
			}
			$this->mtutuptahun->saveakumulasi($_POST['akumulasi'],$this->LabaRugi(),$_POST['tahun']);
			$this->mtutuptahun->marktutuptahun($_POST['tahun'],1);
			
			$file=date("DdMY").'_backup_data_'.time().'.sql';
	
			//panggil fungsi dengan memberi parameter untuk koneksi dan nama file untuk backup
			$this->backup_tables("localhost","root","","wahana",$file);
		}
			
		function backup_tables($host,$user,$pass,$name,$nama_file,$tables = '*'){
			//untuk koneksi database
			$link = mysql_connect($host,$user,$pass);
			mysql_select_db($name,$link);
			
			if($tables == '*')
			{
				$tables = array();
				$result = mysql_query('SHOW TABLES');
				while($row = mysql_fetch_row($result))
				{
					$tables[] = $row[0];
				}
			}else{
				//jika hanya table-table tertentu
				$tables = is_array($tables) ? $tables : explode(',',$tables);
			}
			
			//looping dulu ah
			foreach($tables as $table)
			{
				$result = mysql_query('SELECT * FROM '.$table);
				$num_fields = mysql_num_fields($result);
				
				//menyisipkan query drop table untuk nanti hapus table yang lama
				$return= 'DROP TABLE '.$table.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
				$return.= "\n\n".$row2[1].";\n\n";
				
				for ($i = 0; $i < $num_fields; $i++) 
				{
					while($row = mysql_fetch_row($result))
					{
						//menyisipkan query Insert. untuk nanti memasukan data yang lama ketable yang baru dibuat. so toy mode : ON
						$return.= 'INSERT INTO '.$table.' VALUES(';
						for($j=0; $j<$num_fields; $j++) 
						{
							//akan menelusuri setiap baris query didalam
							$row[$j] = addslashes($row[$j]);
							//$row[$j] = reg_replace("\n","\\n",$row[$j]);
							if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							if ($j<($num_fields-1)) { $return.= ','; }
						}
						$return.= ");\n";
					}
				}
				$return.="\n\n\n";
			}
			
			//simpan file di folder yang anda tentukan sendiri. kalo saya sech folder "DATA"
			$nama_file;
			
			$handle = fopen('./assets/'.$nama_file,'w+');
			fwrite($handle,$return);
			fclose($handle);
		}
		
		function BatalTutup(){
			$this->load->model("akun/mtutuptahun");
			$_POST['tahun'];
			$this->mtutuptahun->marktutuptahun($_POST['tahun'],0);
		}

		function LabaRugi(){
			$this->load->model("akun/msettingrugilaba");
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

						}//else 
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