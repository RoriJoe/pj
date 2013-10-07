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
<table>
	<tr>
		<td width="80%">
			<h1 style="margin: 0">PD. PELITA JAYA</h1>
			<h4 >LAPORAN SURAT JALAN</h4><br/>
			
		</td>
		<td width="20%">
			<div>Tanggal Kirim : <?php echo $_tgl ?></div>
			
		</td>
	</tr>
</table>

<hr/>
<table class="table bod" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5;">
			<th>No SJ</th>
			<th>No SO</th>
			<th>Pelanggan</th>
			
			<th>Gudang</th>
			<th>No_PO</th>
			<th>Kendaraan</th>
			<th>Barang & Ukuran</th>
			
			<th>Qty</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i=0;$i<$totaltx;$i++){
        
            echo
            "<tr>
                <td>$sj</td>
                <td>$_do</td>
                <td>$pn</td>
				<td>$gg</td>
				<td>$po</td>
				<td>$mbl</td>
				<td>$nama[$i]</td>
				<td>$qty[$i]</td>
				
				<td>$ktr[$i]</td>
            </tr>";
        } ?>
	</tbody>
</table>
