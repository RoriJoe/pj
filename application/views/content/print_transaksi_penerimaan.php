<style type="text/css">
	.bod td, th
	{
		border:1px solid black;
	}
	thead{
		border:1px solid black;
	}
	table{
		border-collapse:collapse;
	}
</style>
<h2 style="margin: 0">PD. PELITA JAYA</h2>
Pangeran Jaya Karta No.30, Jakarta Pusat
			<h2 align="center">PENERIMAAN BARANG</h2>
			<hr/>
<table cellspacing="2">
	<tr>
		<td colspan=4>
			
			
		</td>
		
	</tr>
	<tr>
		<td>Nomor BPB </td>
		<td width="140px">: <?php echo $_bpb; ?></td>
		<td>Tanggal BPB </td>
		<td>: <?php echo $_tgl; ?></td>
		
	</tr>
	<tr>
		<td>Supplier </td>
		<td>: <?php echo $_sp; ?></td>
		<td>Nomor Reff </td>
		<td>: <?php echo $_ref; ?></td>
	</tr>
	<tr>
		<td>Gudang </td>
		<td>: <?php echo $_gd; ?></td>
	</tr>
	
</table>
<br/>

<table class="table bod" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5;">
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
				
				<td align='right'>$_arrQty[$i]</td>
				<td>$_arrKet[$i]</td>
				
            </tr>";
        }  ?>
	</tbody>
</table>
