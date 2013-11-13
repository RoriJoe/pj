<h1 style="margin: 0" align="center">PD. PELITA JAYA</h1>
<h2 align="center">LAPORAN PURCHASE ORDER</h2><hr/>
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
			<th>No PO</th>
				<th>Supplier</th>
				<th>Tgl PO</th>
				<th>Tgl Kirim</th>
				<th>Nama Barang</th>
				<th>Qty</th>
				
				<th>Satuan</th>
				<th style='text-align:center;'>Nilai</th>
		</tr>
	</thead>
	<tbody>
		<?php $no_so="";$tgl="";$plg="";$gtot=0;$y=1;
					foreach($hasil2 as $row)
					{$originalDate1 = $row->Tgl_po;
					$dmy1 = date("d-m-Y", strtotime($originalDate1));
					$originalDate2 = $row->Tgl_kirim;
					$dmy2 = date("d-m-Y", strtotime($originalDate2));
					$duit=number_format($row->Nilai);
					$bot=sizeof($hasil2);
					if($no_so != $row->Kode_po){
						$no_so=$row->Kode_po;$tgl=$dmy1;$plg=$row->NP; $tgl2=$dmy2;
						$gtot+=$row->Total;
						if($y!=1){
					$st=number_format($gx);
						echo "<tr style='background: #C5C5C5; border-bottom: 1px solid #000'><td colspan='6' align='center'><b>Sub Total</b></td><td  align='right' colspan='2'>$st</td>
					</tr>";
					}
					}else{
						$no_so="";$tgl="";$plg="";
						
					}
						echo
						"<tr>
							
							<td>$no_so</td>
							<td>$plg</td>
							<td>$tgl</td>
							<td>$tgl2</td>
							<td>$row->Nama $row->Ukuran</td>
							<td align='right'>$row->Jumlah</td>
							
							<td>$row->Satuan1</td>
							<td style='text-align:right;'>$duit</td>
						</tr>";
						$no_so=$row->Kode_po;
						$gx=$row->Total;
						$y++;
				
						if($y==$bot+1){
						$st=number_format($gx);
							echo "<tr style='background: #C5C5C5; border-bottom: 1px solid #000'><td colspan='7' align='center'><b>Sub Total</b></td><td  align='right' colspan='2'>$st</td>
						</tr>";
						}
					}
					$g=number_format($gtot);
			echo "<tr style='background: #C5C5C5; border-bottom: 1px solid #000'><td colspan='7' align='center'><b>Grand Total</b></td><td  align='right' colspan='2'>$g</td>
			</tr>";
		
				
         ?>
	</tbody>
</table>
