<div class="table CSSTabel" style="margin-bottom:0px; width:95%;">
<table>
	<thead>
		<tr>
	        <th colspan="2" style="vertical-align:middle;">Purchase Order</th>
			<th style=" text-align: right; padding:0"><a href='#'id="add" mode="new" class="btn btn-mini" title="Tambah PO" onclick="addInvoice()"><i class="icon-plus"></i>Invoice</a> </th>
		</tr>
		<tr>
			<th>No PO</th>
			<th>Nilai PO</th>
			<th>Nilai Bayar</th>
		</tr>
	</thead>
</table>
<div class="" style="overflow-y:scroll;height:80px;">
	<table class="table" id="tb_detail">
	<tbody id="itemlist">
		<?php
	   $i=1;
	   $t=0;
	    foreach($hasil as $row)
	    {$t=number_format($row->Total);
		$duit=number_format($row->NilaiPo);
		$duit2=number_format($row->NilaiBayar);
	        echo "<tr>
	        <td><input value='$row->No_po' disabled='disabled' style='width: 85px; margin-bottom:0;' id='invoi$i' name='_sl$i' type='text' ></td>
			<td><input value='$duit' disabled='disabled' style='width: 100px; text-align: right; margin-bottom:0;' id='ninvo$i' name='ninvo$i' type='text' ></td>
			<td><input value='$duit2' disabled='disabled' style='width: 100px; text-align: right; margin-bottom:0;' id='nbayar$i' name='nbayar$i' type='text' ></td>
	        </tr>
	        ";
	        $i++;
	    }  ?>
	</tbody>	
	</table>
</div>
<table>
	<tfoot>
		<tr>
			<td style="text-align:right;"><b>Total</b>
			<input style="width:85px;margin-right: 14px;text-align: right;margin-bottom:0;" id="totInvo" value="<?php echo $t; ?>" name="totInvo" type="text" readonly="true"></td>
		</tr>
	</tfoot>
</table>
</div>