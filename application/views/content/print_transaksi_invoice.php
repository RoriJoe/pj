<style type="text/css">
	.bod td, th
	{
		border:1px solid black;
	}
	table{
		border-collapse:collapse;
	}
</style>
<h2 style="margin: 0">PD. PELITA JAYA</h2>
Pangeran Jaya Karta No.30, Jakarta Pusat
			<h2 align="center">INVOICE</h2><hr/>
<table>
	<tr>
		<td colspan=4>
			
			
		</td>
		
	</tr>
	<tr>
		<td>Nomor Invoice </td>
		<td width="140px">: <?php echo $id; ?></td>
		<td>Pelanggan </td>
		<td>: <?php echo $plg; ?></td>
	</tr>
	<tr>
		<td>Tanggal </td>
		<td>: <?php echo $_tgl; ?></td>
		<td>Nomor SJ </td>
		<td>: <?php echo $so; ?></td>
	</tr>
	<tr>
		<td>Term </td>
		<td>: <?php echo $term; ?> Hari</td>
		<td>Alamat </td>
		<td>: <?php echo $to; ?></td>
	</tr>
	
</table>
<br/>
<table class="table bod" width="100%" style="font-size: 11px; border: 1px solid #000;">
	<thead>
		<tr style="background: #C5C5C5;">
			<th>Kode</th>
			<th>Nama Barang</th>
			<th>Satuan</th>
			<th>Qty</th>
			<th>Hrg Satuan(Rp)</th>
			<th>Jumlah</th>
			<th>Keterangan</th>
			
		</tr>
	</thead>
	<tbody >
		<?php for($i=0;$i<$totalRow;$i++){
       
            echo
            "<tr>
				
                <td class=' sorting_1'>$arrKode[$i]</td>
				<td>$arrBrg[$i]</td>
				<td>$arrSat[$i]</td>
                <td align='right'>$arrQty[$i]</td>
                
				<td align='right'>$arrHrg[$i]</td>
				<td align='right'>$arrJml[$i]</td>
				<td>$arrKet[$i]</td>
				
            </tr>";
        }  ?>
	</tbody>
</table>
<br/>
<br/>
<table>
	<tr>
			<td>Total </td>
			<td>: <?php echo $to; ?></td>
	</tr>
	<tr>
			<td>Discount </td>
			<td>: <?php echo $disc." % ".$discT; ?></td>
	</tr>
	<tr>
			<td>DPP </td>
			<td>: <?php echo $dpp; ?></td>
	</tr>
	<tr>
			<td>PPN </td>
			<td>: <?php echo $ppn." % ".$ppnT; ?></td>
	</tr>
	<tr>
			<td>Grand Total </td>
			<td>: <?php echo $grant; ?></td>
	</tr>
</table>
