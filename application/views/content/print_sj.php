<table>
	<tr>
		<td width="80%">
			<h1 style="margin: 0">PD. PELITA JAYA</h1>
			<h4 >LAPORAN SURAT JALAN</h4><br/>
			<div>PERIODE : <?php echo $periode ?></div>
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
			<th>No SJ</th>
			<th>No SO</th>
			<th>Pelanggan</th>
			<th>Kendaraan</th>
			<th>Nama Barang</th>
			<th>Jenis</th>
			<th>Qty</th>
			<th>Satuan</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($hasil2 as $row)
        {
            echo
            "<tr>
                <td>$row->No_Sj</td>
                <td>$row->No_Do</td>
                <td>$row->NP</td>
				<td>$row->No_Mobil</td>
				<td>$row->Nama</td>
				<td>$row->Ukuran</td>
				<td>$row->Qty1</td>
				<td>$row->Satuan1</td>
            </tr>";
        } ?>
	</tbody>
</table>
