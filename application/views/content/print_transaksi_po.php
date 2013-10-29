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
			<h2 align="center">PEMBELIAN/PO</h2><hr/>
<table>
	<tr>
		<td colspan=4>
			
			
		</td>
		
	</tr>
	<tr>
		<td width="30%">Nomor PO : </td>
		<td width="25%"><?php echo $po; ?></td>
		<td width="30%">Permintaan : </td>
		<td><?php echo $permintaan; ?></td>
	</tr>
	<tr>
		<td>Tanggal PO : </td>
		<td><?php echo $_tgl1; ?></td>
		<td>Currency : </td>
		<td><?php echo $cur; ?></td>
	</tr>
	<tr>
		<td>Tanggal Kirim </td>
		<td><?php echo $_tgl2; ?></td>
		<td>Urgent </td>
		<td><?php echo $urg; ?></td>
	</tr>
	<tr>
		<td>Kirim Ke </td>
		<td><?php echo $kd_gud.$proy; ?></td>
		<td>Supplier </td>
		<td><?php echo $kd_sup; ?></td>
	</tr>
</table>
<br/>
<table class="table bod" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5;">
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Jumlah</th>
			
			<th>Satuan</th>
			<th>Harga</th>
			<th>Nilai</th>
			
		</tr>
	</thead>
	<tbody>
		<?php for($i=0;$i<$totalRow;$i++){
        
            echo
            "<tr>
                <td>$arrKode[$i]</td>
                <td>$arrNamabrg[$i]</td>
                <td align='right'>$arrJumlah[$i]</td>
				<td>$arrSatuan[$i]</td>
				<td align='right'>$arrHarga[$i]</td>
				<td align='right'>$arrNilai[$i]</td>
				
            </tr>";
        }  ?>
	</tbody>
</table>
<br/>
<table class="bod" style="margin-top:10px;">
	<tr>
		<td>DPP : <?php echo $dpp; ?></td>
		</tr>
		<tr>
			<td>PPN : <?php echo $ppn; ?></td>
		</tr>
		<tr>
			<td>Total : <?php echo $to; ?></td>
		</tr>
</table>
