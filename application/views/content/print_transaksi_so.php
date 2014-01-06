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
<h2 align="center">SALES ORDER</h2><hr/>
<table cellpadding="2">
	<tr>
		<td>Nomor SO </td>
		<td width="120px">: <?php echo $so; ?></td>
		<td>Nomor PO </td>
		<td>: <?php echo $po; ?></td>
	</tr>
	<tr>
		<td>Tanggal SO </td>
		<td>: <?php echo $tglSo; ?></td>
		<td>Tanggal PO </td>
		<td>: <?php echo $tglPo; ?></td>
	</tr>
	<tr>
		<td>Pelanggan </td>
		<td width="120px">: <?php echo $pl; ?></td>
		<td>Sales </td>
		<td>: <?php echo $sl; ?></td>
	</tr>
	
</table>
<br/>
<table class="table bod" width="100%" style="font-size: 11px; border: 1px solid #000;">
	<thead>
		<tr style="background: #C5C5C5;">
			<th>Kode Barang</th>
			<th>Nama</th>
			<th>Qty</th>
			<th>Harga Satuan</th>
			<th>Jumlah</th>
			<th>Keterangan</th>
			
		</tr>
	</thead>
	<tbody >
		<?php for($i=0;$i<$totalRow;$i++){
        
            echo
            "<tr>
                <td>$arrKode[$i]</td>
				<td>$arrNama[$i]</td>
                <td align='right'>$arrQty[$i]</td>
				<td align='right'>$arrHarga[$i]</td>
				<td align='right'>$arrJumlah[$i]</td>
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
