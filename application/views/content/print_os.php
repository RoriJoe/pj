<h1 style="margin: 0" align="center">PD. PELITA JAYA</h1>
<h2 align="center">LAPORAN OUTSTANDING SALES ORDER</h2><hr/>
<table>
	<tr>
		<td width="80%">
			
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
			<th>No SO</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Barang</th>
			<th>Pesan</th>
			<th>Kirim</th>
			<th>OS</th>
			<th>Satuan</th>
			
		</tr>
	</thead>
	<tbody>
		<?php $no_so="";$tgl="";$plg="";$gtot=0;
		$y=1;
				foreach($hasil2 as $row)
				{$originalDate1 = $row->Tgl;
				$dmy1 = date("d-m-Y", strtotime($originalDate1));
				$duit=number_format($row->Jumlah);
				$bot=sizeof($hasil2);
				$os=$row->Qty-$row->QtyTemp;
				if($no_so != $row->No_Do){
					$no_so=$row->No_Do;$tgl=$dmy1;$plg=$row->NP;
					
					$gtot+=$row->grandttl;
					
				}else{
					$no_so="";$tgl="";$plg="";
					
				}
					echo
					"<tr>
						
						<td>$no_so</td>
						<td>$plg</td>
						<td>$tgl</td>
						<td>$row->Nama $row->Ukuran</td>
						<td align='right'>$row->Qty</td>
						<td align='right'>$row->QtyTemp</td>
						<td align='right'>$os</td>
						<td>$row->Satuan1</td>
						
					</tr>";
					$no_so=$row->No_Do;
					$gx=$row->grandttl;
				$y++;
				
				
				}
				$g=number_format($gtot);
		
         ?>
	</tbody>
</table>
