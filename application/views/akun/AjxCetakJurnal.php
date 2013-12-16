<?php
	function Uang($uang){
		return $in_rp =number_format($uang, 0, '.', '.');
	 }
	function GantiDate($date){
		return date('d F Y', strtotime($date));
	}
	
	$TV=""; $i=0; $TtDb=0; $TtKr=0; $GTtKr=0; $GTtDb=0; $j=1; $NV="";
	echo '<b>Tanggal: </b><input type="text" id="Tgl" value="" style="width: 100px;" readonly />';
	echo '
		<table id="tableemploy" class="table table-bordered" style=min-width:770px;margin-bottom:0px;>
			<thead>
				<tr>
					<th>No</th><th>No Voucher</th><th>No Perkiraan</th><th>Nama Perkiraan</th><th style=min-width:200px;>Keterangan</th><th  width=70px;>Debit</th><th width=70px;>Kredit</th>
				</tr>
			</thead>';
				foreach($Jurnal as $Hdata){ 
				if($i==0){
					echo '<script>document.getElementById("Tgl").value="'.GantiDate($Hdata->tanggal).'";</script>';
				}
				
				if($TV!=$Hdata->tanggal && $i!=0){$j=1;
				echo '
				<tr class=Bold>
					<td colspan=5 align=center >Total</td>
					<td class=FieldDK>'.Uang($TtDb).'</td>
					<td class=FieldDK>'.Uang($TtKr).'</td>
				</tr>
		</table></br>
		
		<b>Tanggal: </b> <input type="text" value="'.GantiDate($Hdata->tanggal).'" style="width:100px;" readonly />
		<table id="tableemploy" class="table table-bordered" style=min-width:770px;margin-bottom:0px;>
			<thead>
				<tr>
					<th>No</th><th>No Voucher</th><th>No Perkiraan</th><th>Nama Perkiraan</th><th style=min-width:200px;>Keterangan</th><th width=70px;>Debit</th><th width=70px;>Kredit</th>
				</tr>
			</thead>';
				$TtDb=0; $TtKr=0;
				}
				if($NV!=$Hdata->novoucher){
					if($j!=1)
						echo '<tr class=Bold><td colspan=5 align=center >Total</td><td class=FieldDK>'.Uang($TtDb).'</td><td class=FieldDK>'.Uang($TtKr).'</td></tr>';
						echo '<tr><td style=border-bottom:none;>'.$j.'</td><td style=border-bottom:none;>'.$Hdata->novoucher;
						$j++;$TtDb=0; $TtKr=0;
				}
				else echo '<tr><td style=border-top:none;border-bottom:none;></td><td style=border-top:none;border-bottom:none;>';
			echo '</td>
				<td>'.$Hdata->nomoraccount.'</td>
				<td>'.$Hdata->namaaccount.'</td>
				<td>'.$Hdata->keterangan.'</td>
				<td class=FieldDK>'.Uang($Hdata->debit).'</td>
				<td class=FieldDK>'.Uang($Hdata->kredit).'</td>
			</tr>';
				$TV=$Hdata->tanggal; $NV=$Hdata->novoucher; $TtDb+=$Hdata->debit; $TtKr+=$Hdata->kredit; $GTtKr+=$Hdata->kredit; $GTtDb+=$Hdata->kredit; 
			$i++;
			}
	echo '<tr class=Bold><td colspan=5 align=center>Total</td><td class=FieldDK>'.Uang($TtDb).'</td><td class=FieldDK>'.Uang($TtKr).'</td></tr></table>';
	echo '<table><tr style="font-weight:bold"><td align=right width=600>Balance :</td><td class=FieldDK width=70px;>'.Uang($GTtDb).'</td><td class=FieldDK width=70px;>'.Uang($GTtKr).'</td></tr></table>';
?>