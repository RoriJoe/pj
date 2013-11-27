
<table>
	<tr>
		<td width="80%">
			<h2 style="margin: 0">PD. PELITA JAYA</h2>
			
		</td>
		<td width="20%" rowspan="2">
			Tanggal : <?php echo $tanggal ?>
			<div>Jam : <?php echo $jam ?></div>
			<div>PERIODE : <?php echo $periode ?></div> <!--ambil berdasarkan input radio dari user -->
		</td>
	</tr>
	<tr>
		<td width="80%">
			<h3>LAPORAN MUTASI STOCK</h3><br/>
		</td>
		
	</tr>
</table>
<hr/>
<table class="table" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5; border-bottom: 1px solid #000">
			<th>No</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>Ukuran</th>
			<th>Jenis</th>
			<th>SAW</th>
			<th>Terima</th>
			<th>Kirim</th>
			<th>Saldo</th>
			<th>Satuan</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1;$k="";
		
		foreach($hasil2 as $row)
        {
		$terima =$row->terima;
		$keluar = $row->keluar;
		$kode=$row->Kode;
		$saw = $row->SAW;
		$saldo = ($saw + $terima) - $keluar;
		

            echo
            "<tr>
				<td>$i</td>
                <td>$row->Kode</td>
                <td>$row->Nama</td>
                <td>$row->Ukuran</td>
				<td>$row->Nama2</td>
				<td align='right'>$row->saw</td>
				<td align='right'>$row->terima</td>
				<td align='right'>$row->keluar</td>
				<td align='right'>$saldo</td>
				<td>$row->Satuan1</td>
            </tr>";
			$i++;$k=$kode;
		} ?>
	</tbody>
</table>
