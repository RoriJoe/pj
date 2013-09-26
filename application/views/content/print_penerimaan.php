<table>
	<tr>
		<td width="80%">
			<h1 style="margin: 0">PD. PELITA JAYA</h1>
			<h4 >LAPORAN PENERIMAAN</h4><br/>
			<div>PERIODE : <?php echo $periode ?></div> <!--ambil berdasarkan input radio dari user -->
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
			<th>Tanggal</th>
			<th>No. BPB.</th>
			<th>Supplier</th>
			<th>No. Reff.</th>
			<th>Nama Barang</th>
			<th>Jenis Barang</th>
			<th>Qty1</th>
			<th>Satuan</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($hasil2 as $row)
        {
            echo
            "<tr>
                <td>$row->Tgl_Bpb</td>
                <td>$row->No_Bpb</td>
                <td>$row->NS</td>
				<td>$row->No_Reff</td>
				<td>$row->Nama</td>
				<td>$row->Ukuran</td>
				<td>$row->Qty1</td>
				<td>$row->Satuan1</td>
            </tr>";
        } ?>
	</tbody>
</table>
