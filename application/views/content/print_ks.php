<table>
	<tr>
		<td width="80%">
			<h1 style="margin: 0">PD. PELITA JAYA</h1>
			<h4 >KARTU STOCK</h4><br/>
			<div>PERIODE : </div>
		</td>
		<td width="20%">
			<div>Tanggal : <?php echo $tanggal ?></div>
			<div>Jam : <?php echo $jam ?></div>
		</td>
	</tr>
</table>

<hr/>
<?php foreach($hasil2 as $row)
        {$terima =$row->terima;
		$keluar = $row->keluar;
		$kode=$row->Kode;
		$saw = $row->SAW;
		$saldo = ($saw + $terima) - $keluar;
		$originalDate1 = $row->tglsaw;
			$dmy1 = date("d-m-Y", strtotime($originalDate1));
		echo"
<table style='border-bottom: 2px solid #000;' width='100%'>
	<tr>
		<td>
			NAMA BARANG : $row->Nama
		</td>
	</tr>
	<tr>
		<td>
			JENIS BARANG :$row->Nama2
		</td>
	</tr>
	<tr>
		<td>
			SIZE/UKURAN : $row->Ukuran
		</td>
	</tr>
</table>

<table class='table' width='100%' style='font-size: 11px'>
	<thead>
		<tr style='background: #C5C5C5; border-bottom: 1px solid #000'>
			<th>Tanggal</th>
			<th>Keterangan</th>
			<th>No. Sj.</th>
			<th>No. Do.</th>
			<th>No. Btb.</th>
			<th>Jumlah</th>
			<th>Sisa</th>
		</tr>
	</thead>
	<tbody>
	<?php
		
         
            <tr>
                <td>$dmy1</td>
                <td>Saldo awal</td>
				<td>$row->terima</td>
				<td></td>
				<td>$row->keluar</td>
				<td></td>
				<td>$saldo</td>
            </tr>
			
		</tbody>
</table>
<hr/>";} ?>
        
	
