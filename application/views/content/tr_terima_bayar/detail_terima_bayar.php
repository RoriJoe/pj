<div class="table CSSTabel" style="overflow: auto; height: 170px; margin-bottom:5px;">
<table id="tb_detail">
    <thead>
        <th>Jenis</th>
        <th>Dari Bank</th>
        <th>Dari Rek</th>
        <th>Referensi</th>
        <th>Tgl Giro/Cek</th>
        <th>Tgl Cair</th>
		<th>Nilai</th>
        <th>Terima Bank</th>
		<th>Terima Rek</th>
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