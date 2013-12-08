<?php
	class cetakbukubesar extends CI_Controller {
		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/mcetakbukubesar'));
		}
		function index(){
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->load->model("akun/mcetakbukubesar");
			$Tgla = strtotime($this->mcetakbukubesar->GetTglPer("MIN"));
			$Tglb = strtotime($this->mcetakbukubesar->GetTglPer("MAX"));
			$TglAwlb = date('d F Y', $Tgla);
			$TglAkhrb = date('d F Y', $Tglb);
			$data['TglAwl']=$TglAwlb;
			$data['TglAkhr']=$TglAkhrb;
			$data['Combo']=$this->mcetakbukubesar->GetComboJurnal();
			$data['ComboMin']=$this->mcetakbukubesar->GetMMJurnal("MIN");
			$data['ComboMax']=$this->mcetakbukubesar->GetMMJurnal("MAX");
			$this->load->view("akun/cetakbukubesar",$data);
		}
		function CariBukuBesar(){
			$this->load->model("akun/mcetakbukubesar");
			$BukuBesar=$this->mcetakbukubesar->SearchBukuBesar($_POST['TglAwl'],$_POST['TglAkhr'],$_POST['NoVo1'],$_POST['NoVo2']);
			
		echo'<b>Perkiraan : <label id="nomorP" style="display:none;"></label> - <label id="namaP" style="display:none;"></label></b>
			<table class="table table-bordered"  id="tabledetilindoor" style="min-width:100%; margin-bottom:0px;"">
			<tr>
				<th width=20px;>No</th><th width=90px;>Tanggal</th><th width=180px;>Deskripsi</th><th width=90px; >Debit</th><th width=90px;>Kredit</th><th width=90px;>Saldo</th>
			</tr>';
	
			if($BukuBesar){
				$i=1; $NoP=""; $SaldoAwl=0; $j=1;
				foreach($BukuBesar as $BB){
				if($i==1){
					echo '<script>document.getElementById("namaP").innerHTML="'.$BB->namaaccount.'";document.getElementById("nomorP").innerHTML="'.$BB->nomoraccount.'";</script>';
					$NoP=$BB->nomoraccount;
					echo '<tr><td>'.$j.'</td><td>'.$this->GantiDate($BB->tanggalsaldoawal).'</td><td>Saldo Awal</td><td style=text-align:right;>'.$this->Uang($BB->saldo).'</td><td style=text-align:right;>0</td><td style=text-align:right;>'.$this->Uang($BB->saldo).'</td></tr>';
					$SaldoAwl=$BB->saldo; $j++;
				}
				if($NoP!=$BB->nomoraccount && $i!=1){ 
					$Table = $this->mcetakbukubesar->GetTable($NoP);
					if($Table){
						foreach($Table as $Htable){
							$Other = $this->mcetakbukubesar->GetOther($Htable->namatabel,$Htable->nama);
							foreach($Other as $Hother){
								echo '<tr><td>'.$j.'</td><td></td><td>'.$Htable->tipe.' '.$Htable->namamenu.'</td>';
								if($Htable->debitkredit==0){
									$SaldoAwl+=$Hother->total;
									echo '<td align=right>'.$this->Uang($Hother->total).'</td><td align=right>0</td>';
								}else{
									$SaldoAwl-=$Hother->total;
									echo '<td align=right>0</td><td align=right>'.$this->Uang($Hother->total).'</td>';
								}
								echo '<td align=right>'.$this->Uang($SaldoAwl).'</td></tr>';
							}
							$j++;
						}
					}
					$j=1;
					echo '</table></br>
					<b>Perkiraan : '.$BB->nomoraccount.' - '.$BB->namaaccount.'</b>
					<table border="1" id="tabledetilindoor" cellspacing="0" style=min-width:600px><tr><th width=20px;>No</th><th width=90px;>Tanggal</th><th width=180px;>Deskripsi</th><th width=90px;>Debit</th><th width=90px;>Kredit</th><th width=90px;>Saldo</th></tr>';
					echo '<tr><td>'.$j.'</td><td>'.$this->GantiDate($BB->tanggalsaldoawal).'</td><td>Saldo Awal</td><td style=text-align:right;>'.$this->Uang($BB->saldo).'</td><td style=text-align:right;>0</td><td style=text-align:right;>'.$this->Uang($BB->saldo).'</td></tr>';
					$NoP=""; $j++; $SaldoAwl=$BB->saldo;
				}
				
				
				
					$SaldoAwl+=$BB->debit;
					$SaldoAwl-=$BB->kredit;
					echo '<tr>
						<td>'.$j.'</td><td>'.$this->GantiDate($BB->tanggal).'</td><td>'.$BB->keterangan.'</td><td style=text-align:right;>'.$this->Uang($BB->debit).'</td><td style=text-align:right;>'.$this->Uang($BB->kredit).'</td><td style=text-align:right;>'.$this->Uang($SaldoAwl).'</td>
					</tr>';
				$i++; $j++;
				$NoP=$BB->nomoraccount;
				}
				
				$Table = $this->mcetakbukubesar->GetTable($NoP);
					if($Table){
						foreach($Table as $Htable){
							$Other = $this->mcetakbukubesar->GetOther($Htable->namatabel,$Htable->nama);
							foreach($Other as $Hother){
								echo '<tr><td>'.$j.'</td><td></td><td>'.$Htable->tipe.' '.$Htable->namamenu.'</td>';
								if($Htable->debitkredit==0){
									$SaldoAwl+=$Hother->total;
									echo '<td align=right>'.$this->Uang($Hother->total).'</td><td align=right>0</td>';
								}else{
									$SaldoAwl-=$Hother->total;
									echo '<td align=right>0</td><td align=right>'.$this->Uang($Hother->total).'</td>';
								}
								echo '<td align=right>'.$this->Uang($SaldoAwl).'</td></tr>';
							}
							$j++;
						}
					}
			}
			echo'</table>';
		}
		function PrintJurnal(){
			$this->load->model("akun/mcetakbukubesar");
			$data['Jurnal']=$this->mcetakbukubesar->SearchDetailJurCtk($_POST['TglAwl'],$_POST['TglAkhr'],$_POST['NoVo1'],$_POST['NoVo2']);
			$this->load->view("akun/PrintJurnal",$data);
		}
		function Uang($uang){
			if(!$uang)
				return 0;
			else
				return $in_rp =number_format($uang, 0, '.', '.');
		 }
		function GantiDate($date){
			if(!$date)
				return "";
			else
			return date('d F Y', strtotime($date));
		}
	
	}
?>