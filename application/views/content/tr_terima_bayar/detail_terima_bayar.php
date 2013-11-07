<script>
/*Tampilkan jQuery Tanggal*/
/* $(function() {
    $( "#_tglc1").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
        defaultDate: new Date()
    });
    $( "#_tglc2").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
    });
}); */
</script>
<div class="table CSSTabel" style="overflow: auto; height: 195px">
<table id="tb_detail">
    <thead>
	<tr>
		<th rowspan="2"><center>Jenis</center></th>
		<th colspan="3"><center>Dari</center></th>
		<th colspan="2"><center>Tgl</center></th>
		<th rowspan="2"><center>Nilai</center></th>
		<th colspan="2"><center>Terima</center></th>
	</tr>
	<tr>
		<th>Bank</th>
        <th>Rek</th>
        <th>No Ref.</th>
        <th>Giro/Cek</th>
        <th>Cair</th>
        <th>Bank</th>
		<th>Rek</th>
	</tr>
        
        
    </thead>
    <tbody id="itemlistdet">
	
    <?php
   $i=1;
    foreach($hasil as $row)
    {$originalDate1 = $row->TglGiro;
     $dmy1 = date("d-m-Y", strtotime($originalDate1));
	 $originalDate2 = $row->TglCair;
     $dmy2 = date("d-m-Y", strtotime($originalDate1));
	$duit=number_format($row->Nilai);
        echo "<tr>
        <td> <input value='$row->Jenis' disabled='disabled' style='width: 70px; margin-left: 5px;' id='sljenis$i' name='sljenis$i' type='text' ></td>

        <td><input value='$row->DariBank' disabled='disabled' style='width: 80px; margin-left: 5px;' id='slbank$i' name='slbank$i' type='text' ></td>
		
		<td><input value='$row->DariRek' disabled='disabled' style='width:60px;margin-right: 5px;' id='reken$i' name='reken$i' type='text' ></td>
	
		<td><input value='$row->Ref' disabled='disabled' style='width:60px;margin-right: 5px;' id='noref$i' name='noref$i' type='text' ></td>
	
        <td><input  value='$dmy1' disabled='disabled' style='width:65px;margin-right: 5px;' id='_tglc1$i' name='_tglc1$i' type='text' autocomplete='off' ></td>
	
		<td><input value='$dmy2' disabled='disabled' style='width:60px;margin-right: 5px;' id='_tglc2$i' name='_tglc2$i' type='text' autocomplete='off' ></td>
	
		<td><input value='$duit' disabled='disabled' style='width:60px;margin-right: 5px;text-align: right;' id='_tglc2$i' name='_tglc2$i' type='text' autocomplete='off' ></td>
	
	
		<td><input value='$row->TerimaBank' disabled='disabled' style='width: 70px; margin-left: 5px;' id='slbank$i' name='slbank$i' type='text' ></td>
		<td><input value='$row->TerimaRek' disabled='disabled' style='width: 105px; margin-left: 5px;' id='slbank$i' name='slbank$i' type='text' ></td>
	
        </tr>
        ";
        $i++;
    }  ?>
    </tbody>
</table>
</div>