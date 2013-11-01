<div class="table CSSTabel" style="overflow: auto; height: 130px;width: 300px;">
<table id="tb_detail">
    <tr align="center">
        <th>Pembayaran</th>
		<th><a href='#'id="add2" mode="new" class="btn btn-small" title="Tambah Pembayaran" onclick="addBayar()" style="margin-left:30px;"><i class="icon-plus"></i>Pembayaran</a> </th>
		</tr>
		<tr>
			<th>Jenis</th>
			<th align="center">Nilai</th>
			
		</tr>
		
    <tbody id="itemlist2">
		<?php
   $i=1;
   $t=0;
    foreach($hasil as $row)
    {
	$duit=number_format($row->Nilai);
	$t=number_format($row->Total);
        echo "<tr>
        <td> <input value='$row->Jenis' disabled='disabled' style='width: 110px; margin-left: 5px;' id='_sl$i' name='_sl$i' type='text' ></td>
		<td><input value='$duit' disabled='disabled' style='width: 110px; margin-left: 5px;text-align: right;' id='nilaiB$i' name='nilaiB' type='text' ></td>

       
        </tr>
        ";
        $i++;
    }  ?>
    </tbody>
	<tr>
		<td><b>Total</b></td>
		<td><input style="width:110px;margin-right: 5px;text-align: right;" value="<?php echo $t; ?>" id="totByr" name="totByr" type="text" readonly="true"></td>
	</tr>
</table>
</div>