

<h1 style="margin: 0" align="center">PD. PELITA JAYA</h1>
			<h2 align="center">LAPORAN DELIVERY ORDER</h2><br/>
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
			<th>No PO</th>
			<th>Tanggal</th>
			<th>Pelanggan</th>
			<th>Nama Barang</th>
			<th>Qty</th>
			<th>Satuan</th>
			<th>Nilai</th>
		</tr>
	</thead>
	<tbody>
		<?php 	$no_so="";$tgl="";$plg="";$gtot=0;$gx=0;
			$y=1;
			foreach($hasil2 as $row)
			{$originalDate1 = $row->Tgl;
			$dmy1 = date("d-m-Y", strtotime($originalDate1));
			$duit=number_format($row->Jumlah);
			$bot=sizeof($hasil2);
			if($no_so != $row->No_Do){
				$no_so=$row->No_Do;$tgl=$dmy1;$plg=$row->NP;
				$gtot+=$row->grandttl;
				
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
					<td>$row->No_Po</td>
					<td>$tgl</td>
					<td>$plg</td>
					<td>$row->Nama $row->Ukuran</td>
					<td align='right'>$row->Qty</td>
					<td>$row->Satuan1</td>
					<td style='text-align:right;'>$duit</td>
					
				</tr>";

				$no_so=$row->No_Do;
				$gx=$row->grandttl;
				$y++;
				
				if($y==$bot+1){
				$st=number_format($gx);
					echo "<tr style='background: #C5C5C5; border-bottom: 1px solid #000'><td colspan='6' align='center'><b>Sub Total</b></td><td  align='right' colspan='2'>$st</td>
				</tr>";
				}
			}
			$g=number_format($gtot);
			echo "<tr style='background: #C5C5C5; border-bottom: 1px solid #000'><td colspan='6' align='center'><b>Grand Total</b></td><td  align='right' colspan='2'>$g</td>
			</tr>";
			
		          ?>
	</tbody>
</table>
