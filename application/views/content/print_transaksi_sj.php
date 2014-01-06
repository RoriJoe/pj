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
			<h2 align="center">SURAT JALAN </h2>
			<h3>Reprint <?php echo $count;?></h3><hr/>
<table>
	<tr>
		<td colspan=2>
			
			
		</td>
	</tr>
	<tr>
		<td>Nomor SJ </td>
		<td width="120px">: <?php echo $sj; ?></td>
		<td>Tgl Kirim </td>
		<td width="120px">: <?php echo $_tgl; ?></td>
	</tr>
	<tr>
		<td>Nomor SO </td>
		<td>: <?php echo $_do; ?></td>
		<td>Gudang </td>
		<td>: <?php echo $gg; ?></td>
	</tr>
	<tr>
		<td>Pelanggan </td>
		<td>: <?php echo $pn; ?></td>
		<td>No PO </td>
		<td>: <?php echo $po; ?></td>
	</tr>
	<tr>
		<td>Nomor Mobil </td>
		<td>: <?php echo $mbl; ?></td>
		
	</tr>
</table>

<br/>
<table class="table bod" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5;">
			<th>Kode</th>
			<th>Barang & Ukuran</th>
			<th>Qty</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i=0;$i<$totaltx;$i++){
        
            echo
            "<tr>
				<td>$kd_brg[$i]</td>
				<td>$nbu[$i]</td>
				<td align='right'>$qty[$i]</td>
				<td>$ktr[$i]</td>
            </tr>";
        } ?>
	</tbody>
</table>
