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
<h1 >PD. PELITA JAYA</h1>
<h2 align="center">DAFTAR BARANG (STOCK)</h2>
<hr/>
<h4>PERIODE : <?php echo $tanggal; ?></h4>


<table class="table bod" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5;">
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama</th>
			
			<th>Ukuran</th>
			<th>Qty</th>
			<th>Satuan</th>
			<th>Keterangan</th>
			
		</tr>
	</thead>
	<tbody>
		<?php $i=1;
		foreach($hasil2 as $row){
        
            echo
            "<tr>
				<td>$i</td>
                <td>$row->Kode</td>
                <td>$row->Nama</td>
				<td>$row->Ukuran</td>
				<td align='right'>$row->Qty1</td>
				<td>$row->Satuan1</td>
				<td>$row->Nama2</td>
				
            </tr>";$i++;
        }  ?>
	</tbody>
</table>
