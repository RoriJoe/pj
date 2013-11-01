<div class="table CSSTabel" style="overflow: auto; height:160px;width: 370px;">
<table id="tb_detail">
    <tr>
        <th colspan="2" >Invoice</th>
		<th><a href='#'id="add" mode="new" class="btn btn-small" title="Tambah Invoice" onclick="addInvoice()" style="margin-left:30px;"><i class="icon-plus"></i>Invoice</a> </th>
	</tr>
		<tr>
			<th>No Invoice</th>
			<th>Nilai Invoice</th>
			<th>Nilai Bayar</th>
			
		</tr>
    
   
	<tbody id="itemlist">
	<?php
   $i=1;
   $t=0;
    foreach($hasil as $row)
    {$t=number_format($row->Total);
	$duit=number_format($row->NilaiInvoice);
	$duit2=number_format($row->NilaiBayar);
        echo "<tr>
        <td> <input value='$row->NoInvoice' disabled='disabled' style='width: 80px; margin-left: 5px;' id='invoi$i' name='_sl$i' type='text' ></td>
		<td><input value='$duit' disabled='disabled' style='width: 85px; margin-left: 5px;text-align: right;' id='ninvo$i' name='ninvo$i' type='text' ></td>
		<td><input value='$duit2' disabled='disabled' style='width: 85px; margin-left: 5px;text-align: right;' id='nbayar$i' name='nbayar$i' type='text' ></td>

       
        </tr>
        ";
        $i++;
    }  ?>
	
	</tbody>
	<tr>
		<td colspan="2" ><b>Total</b></td>
		<td><input style="width:85px;margin-right: 5px;text-align: right;" id="totInvo" value="<?php echo $t; ?>" name="totInvo" type="text" readonly="true"></td>
	</tr>
</table>
</div>