<table>
	<tr>
		<td colspan=4>
			<h1 style="margin: 0">PD. PELITA JAYA</h1>
			<h4 >LAPORAN PENERIMAAN BARANG</h4><br/>
			
		</td>
		
	</tr>
	<tr>
		<td width="30%">Nomor BPB : </td>
		<td width="25%"><?php echo $_bpb; ?></td>
		<td width="30%">Gudang : </td>
		<td><?php echo $_gd; ?></td>
	</tr>
	<tr>
		<td>Supplier : </td>
		<td><?php echo $_sp; ?></td>
		<td>Nomor Reff : </td>
		<td><?php echo $_ref; ?></td>
	</tr>
	<tr>
		<td>Tanggal BPB </td>
		<td><?php echo $_tgl; ?></td>
		
	</tr>
	
</table>

<hr/>
<table class="table" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5; border-bottom: 1px solid #000">
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Ukuran</th>
			
			<th>Qty</th>
			<th>Keterangan</th>

		</tr>
	</thead>
	<tbody>
		<?php for($i=0;$i<$totalRow;$i++){
        
            echo
            "<tr>
                <td>$_arrKd_brg[$i]</td>
                <td>$_arrNm_brg[$i]</td>
                <td>$_arrUkur[$i]</td>
				
				<td>$_arrQty[$i]</td>
				<td>$_arrKet[$i]</td>
				
            </tr>";
        }  ?>
	</tbody>
	
	
</table>
