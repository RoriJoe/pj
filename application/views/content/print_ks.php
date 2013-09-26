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

<table style="border-bottom: 2px solid #000;" width="100%">
	<tr>
		<td>
			NAMA BARANG :
		</td>
	</tr>
	<tr>
		<td>
			JENIS BARANG :
		</td>
	</tr>
	<tr>
		<td>
			SIZE/UKURAN :
		</td>
	</tr>
</table>

<table class="table" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5; border-bottom: 1px solid #000">
			<th>Tanggal</th>
			<th>Keterangan/th>
			<th>No. Sj.</th>
			<th>No. Do.</th>
			<th>No. Btb.</th>
			<th>Jumlah</th>
			<th>Sisa</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($hasil2 as $row)
        {
            echo
            "<tr>
                <td>$row->No_Sj</td>
                <td>$row->No_Do</td>
                <td>$row->Nama</td>
            </tr>";
        } ?>
	</tbody>
</table>
