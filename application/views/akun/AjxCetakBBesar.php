
		<?php
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
		?>
		<b>Perkiraan : <label id="nomorP"></label> - <label id="namaP"></label></b>
		<table border="1" id="tabledetilindoor" cellspacing="0" style=min-width:100%>
			<tr>
				<th width=20px;>No</th><th width=90px;>Tanggal</th><th width=180px;>Deskripsi</th><th width=90px; >Debit</th><th width=90px;>Kredit</th><th width=90px;>Saldo</th>
			</tr>
		<?php 
			if($BukuBesar){
				$i=1; $NoP=""; $SaldoAwl=0; $j=1;
				foreach($BukuBesar as $BB){
				if($i==1){
					echo '<script>document.getElementById("namaP").innerHTML="'.$BB->namaaccount.'";document.getElementById("nomorP").innerHTML="'.$BB->nomoraccount.'";</script>';
					$NoP=$BB->nomoraccount;
					echo '<tr><td>'.$j.'</td><td>'.GantiDate($BB->tanggalsaldoawal).'</td><td>Saldo Awal</td><td style=text-align:right;>'.Uang($BB->saldo).'</td><td style=text-align:right;>0</td><td style=text-align:right;>'.Uang($BB->saldo).'</td></tr>';
					$SaldoAwl=$BB->saldo; $j++;
				}
				if($NoP!=$BB->nomoraccount && $i!=1){ $j=1;
					echo '</table></br>
					<b>Perkiraan : '.$BB->nomoraccount.' - '.$BB->namaaccount.'</b>
					<table border="1" id="tabledetilindoor" cellspacing="0" style=min-width:100><tr><th width=20px;>No</th><th width=90px;>Tanggal</th><th width=180px;>Deskripsi</th><th width=90px;>Debit</th><th width=90px;>Kredit</th><th width=90px;>Saldo</th></tr>';
					echo '<tr><td>'.$j.'</td><td>'.GantiDate($BB->tanggalsaldoawal).'</td><td>Saldo Awal</td><td style=text-align:right;>'.Uang($BB->saldo).'</td><td style=text-align:right;>0</td><td style=text-align:right;>'.Uang($BB->saldo).'</td></tr>';
					$NoP=""; $j++; $SaldoAwl=$BB->saldo;
				}
					$SaldoAwl+=$BB->debit;
					$SaldoAwl-=$BB->kredit;
					echo '<tr>
						<td>'.$j.'</td><td>'.GantiDate($BB->tanggal).'</td><td>'.$BB->keterangan.'</td><td style=text-align:right;>'.Uang($BB->debit).'</td><td style=text-align:right;>'.Uang($BB->kredit).'</td><td style=text-align:right;>'.Uang($SaldoAwl).'</td>
					</tr>';
				$i++; $j++;
				$NoP=$BB->nomoraccount;
				}
			}
		?>
		</table>