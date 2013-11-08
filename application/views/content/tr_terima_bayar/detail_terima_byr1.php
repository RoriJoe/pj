<div class="table CSSTabel" style="margin-bottom:0px;">
<table>
	<thead>
		<tr>
        	<th style="vertical-align:middle;">Pembayaran</th>
			<th style=" text-align: right; padding:0">
				<a href='#'id="add2" mode="new" class="btn btn-mini" title="Tambah Pembayaran" onclick="addBayar()"><i class="icon-plus"></i>Pembayaran</a> 
			</th>
		</tr>
		<tr>
			<th>Jenis</th>
			<th align="center">Nilai</th>
		</tr>
	</thead>	
</table>

<div class="" style="overflow-y:scroll;height:80px;">
<table class="table" id="tb_detail">
    <tbody id="itemlist2">
	<?php
	   $i=1;
	   $t=0;
	    foreach($hasil as $row)
	    {
		$duit=number_format($row->Nilai);
		$t=number_format($row->Total);
	        echo "<tr>
	        <td> <input value='$row->Jenis' disabled='disabled' style='width: 135px; margin-left: 5px;  margin-bottom:0;' id='_sl$i' name='_sl$i' type='text' ></td>
			<td><input value='$duit' disabled='disabled' style='width: 130px; margin-left: 5px;text-align: right;  margin-bottom:0;' id='nilaiB$i' name='nilaiB' type='text' ></td>

	       
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
			<td style="text-align:right;vertical-align:middle;"><b>Total</b>
			<input style="width:85px;margin-right: 14px;text-align: right;margin-bottom:0;" value="<?php echo $t; ?>" id="totByr" name="totByr" type="text" readonly="true"></td>
		</tr>
    </tfoot>
</table>
</div>