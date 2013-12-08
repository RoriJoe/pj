
	<table class="table table-bordered" id="tabledetilindoor">
		<thead>
			<tr>
				<th>No Perkiraan</th><th>Nama Perkiraan</th><th>Keterangan</th><th>Debit</th><th>Kredit</th><th class=action>Action</tr>
			</tr>
		</thead>
<?php $i=0; $TKr=0; $TDb=0;
		function Uang($uang){
			return $in_rp =number_format($uang, 0, '.', '.');
		 }
	foreach($Data as $HData){
	echo"<tr id='row".$i."'>
			<td align=center><input type='text'  style='width:100px;cursor:pointer;' class='NoAk' name='NoAk[]' value=".$HData->nomoraccount." id=NK".$i." readonly /></td>
			<td align=center><input type='text'  style='width:140px;background-color:rgb(240,240,240);' class='NoAk' id='NNK".$i."' value='".$HData->namaaccount."' readonly /></td>
			<td><textarea wrap='soft'  style='width:270px;height:30px;font-size:11px;resize:none' class='ket' name='ket[]' id='ket".$i."' >".$HData->keterangan."</textarea></td>
			<td align=right><input type='text'  style='width:100px;text-align:right' class='Db' id='Db".$i."' name='Db[]' value=".Uang($HData->debit)." onclick='DisDK(0,this.id)' /></td>
			<td align=right><input type='text' style='width:100px;text-align:right'  class='Kr' id='Kr".$i."' name='Kr[]' value=".Uang($HData->kredit)." onclick='DisDK(1,this.id)' /></td>
			<td class=action><a id='row".$i."' class='linkdel'>Delete</a></td>
		</tr>";
		$i++; $TDb+=$HData->debit; $TKr+=$HData->kredit;
	}
?>
	</table>
	<table style=min-width:700px border=0>
		<tr>
			<td width=528px; style=text-align:center;>Balance</td><td width=98px style="text-align:right" ><label id="TDb" ><?php echo Uang($TDb);?></label></td><td width=98px style="text-align:right"><label id="TKr" ><?php echo Uang($TKr);?></label></td><td width=35px class=action></td>
		</tr>
	</table>
	<script>
		rowcount="<?php echo ($i-1)?>";
	</script>