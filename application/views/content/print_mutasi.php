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
