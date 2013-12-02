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


<table>
	<tr>
		<td width="80%">
			<h2 style="margin: 0">PD. PELITA JAYA</h2>
			
		</td>
		<td width="20%" >

			Halaman : 1 <!--ambil berdasarkan input radio dari user -->
		</td>
	</tr>
	<tr>
		<td width="70%">
			<b>Daftar Stock Opname</b><br/>
		</td>
		
	</tr>
	<tr>
		<td>
			<b>PERIODE : <?php echo $tanggal; ?> </b><!--ambil berdasarkan input radio dari user -->
		</td>
		
	</tr>
</table>


<table class="table bod" width="100%" style="font-size: 11px">
	<thead>
		<tr style="background: #C5C5C5;">
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama</th>
			
			
			<th>Fisik</th>
			<th>Jual</th>
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
                <td>$row->Nama $row->Ukuran</td>
				
				<td align='right'>$row->Qty1</td>
				<td align='right'>$row->QtyOp</td>
				<td>$row->Satuan1</td>
				
				<td>$row->Nama2</td>
				
            </tr>";$i++;
        }  ?>
	</tbody>
</table>
