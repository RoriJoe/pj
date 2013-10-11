<table>
	<tr>
		<td width="80%">
			<h1 style="margin: 0">PD. PELITA JAYA</h1>
			<h4 >MUTASI STOCK</h4><br/>
			<div>PERIODE : </div> <!--ambil berdasarkan input radio dari user -->
		</td>
		<td width="20%">
			<div>Tanggal : <?php echo $tanggal ?></div>
			<div>Jam : <?php echo $jam ?></div>
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
				<td>$row->SAW</td>
				<td>$row->terima</td>
				<td>$row->keluar</td>
				<td>$saldo</td>
				<td>$row->Satuan1</td>
            </tr>";
			$i++;$k=$kode;
		} ?>
	</tbody>
</table>
