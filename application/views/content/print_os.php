<h1 style="margin: 0" align="center">PD. PELITA JAYA</h1>
<h2 align="center">LAPORAN TOTAL OUTSTANDING ORDER</h2><hr/>
<table>
	<tr>
		<td width="80%">
			
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
			<th>Tanggal</th>
			<th>No DO</th>
			<th>Nama Pelanggan</th>
			<th>Nama Barang</th>
			<th>Jenis Barang</th>
			<th>Qty</th>
			<th>Satuan</th>
		</tr>
	</thead>
	<tbody>
		<?php $s="";$d="";
		foreach($hasil2 as $row)
        {$dmy = date("d-m-Y", strtotime($row->Tgl));
			if($dmy==$s||$d==$row->No_Do){
				$dmy="";
			}
            echo
            "<tr>
				<td>$dmy</td>
                <td>$row->No_Do</td>
                <td>$row->NP</td>
                <td>$row->Nama</td>
				<td>$row->Ukuran</td>
				<td align='right'>$row->Qty</td>
				<td>$row->Satuan1</td>
            </tr>";$s=$dmy;$d=$row->No_Do;
        } ?>
	</tbody>
</table>
