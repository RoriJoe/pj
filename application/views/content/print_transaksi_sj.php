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
			<h2 align="center">SURAT JALAN</h2><hr/>
<table>
	<tr>
		<td colspan=2>
			
			
		</td>
	</tr>
	<tr>
		<td width="30%">Nomor SJ : </td>
		<td width="25%"><?php echo $sj; ?></td>
		<td width="30%">Tgl Kirim : </td>
		<td><?php echo $_tgl; ?></td>
	</tr>
	<tr>
		<td width="30%">Nomor SO : </td>
		<td width="25%"><?php echo $_do; ?></td>
		<td width="30%">Gudang : </td>
		<td><?php echo $gg; ?></td>
	</tr>
	<tr>
		<td width="30%">Pelanggan : </td>
		<td width="25%"><?php echo $pn; ?></td>
		<td width="30%">No PO : </td>
		<td><?php echo $po; ?></td>
	</tr>
	<tr>
		<td width="30%">Nomor Mobil : </td>
		<td width="25%"><?php echo $mbl; ?></td>
		
	</tr>
</table>

<br/>
<table class="table bod" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5;">
			<th>Kode</th>
			<th>Barang & Ukuran</th>
			<th>Barang SJ</th>
			<th>Qty</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i=0;$i<$totaltx;$i++){
        
            echo
            "<tr>
                
				<td>$kd_brg[$i]</td>
				<td>$nama[$i]</td>
				<td>$nbu[$i]</td>
				<td align='right'>$qty[$i]</td>
				
				<td>$ktr[$i]</td>
            </tr>";
        } ?>
	</tbody>
</table>
