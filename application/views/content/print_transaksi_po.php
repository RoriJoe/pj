<table>
	<tr>
		<td colspan=4>
			<h1 style="margin: 0">PD. PELITA JAYA</h1>
			<h4 >LAPORAN PEMBELIAN/PO</h4><br/>
			
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

<hr/>
<table class="table" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5; border-bottom: 1px solid #000">
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
                <td>$arrJumlah[$i]</td>
				<td>$arrSatuan[$i]</td>
				<td>$arrHarga[$i]</td>
				<td>$arrNilai[$i]</td>
				
            </tr>";
        }  ?>
	</tbody>
	
	<tbody>
		<tr>
			<td>DPP : <?php echo $dpp; ?></td>
		</tr>
		<tr>
			<td>PPN : <?php echo $ppn; ?></td>
		</tr>
		<tr>
			<td>Total : <?php echo $to; ?></td>
		</tr>
	</tbody>
</table>
