<script type="text/javascript" src="<?php echo base_url().'assets/js/dragtable.js';?>" ></script>

<div class="table CSSTabel table-list2">
	<label id="lab1"><b>Laporan SALES ORDER</b>
	</label>
	<table width="100%">
		<tr>
			<td width="70%">
				<div><b>PERIODE : <?php echo $periode ?></b></div> <!--ambil berdasarkan input radio dari user -->
			</td>
			<td width="30%" style="text-align:right;">
				<b>Tanggal : <?php echo $tanggal ?></b>
				
			</td>
		</tr>
	</table>

	<div id="LimitTab">
		<div id="TableLaporanSPK" style=overflow:auto; class='CssTblLaporan' >
			<table border='0px' id="tablesorter" class="draggable" style="width:100%;font-size:11px;">
				<thead><tr><th>No SO</th><th>No PO</th><th>Pelanggan</th><th>Nama Barang</th><th>Tanggal</th><th>Qty</th><th style="text-align:center;">Jumlah</th><th>Sub-Total</th><th>Satuan</th></tr></thead>
				
				<?php
					$no_so="";$tgl="";$plg="";$gtot=0;
					foreach($hasil2 as $row)
					{$originalDate1 = $row->Tgl;
					$dmy1 = date("d-m-Y", strtotime($originalDate1));
					$duit=number_format($row->Jumlah);
					if($no_so != $row->No_Do){
						$no_so=$row->No_Do;$tgl=$dmy1;$plg=$row->NP;
						$duit2=number_format($row->grandttl);
						$gtot+=$row->grandttl;
					}else{
						$no_so="";$tgl="";$plg="";
						$duit2="";
					}
						echo
						"<tr>
							<td>$no_so</td>
							<td>$row->No_Po</td>
							<td>$plg</td>
							<td>$row->Nama $row->Ukuran</td>
							<td>$tgl</td>
							<td align='right'>$row->Qty</td>
							<td style='text-align:right;'>$duit</td>
							<td style='text-align:right;'>$duit2</td>
							<td>$row->Satuan1</td>
							
						</tr>";
						$no_so=$row->No_Do;
					}
					
				?>
				
			</table>
			<div style=" margin-right: 60px; margin-top: 5px;height: 20px;float: right;"><?php echo number_format($gtot); ?></label></div>
			<div style=" margin-right: 60px;margin-top: 5px;height: 20px;float: right;"><label><b>Grand Total<b></label></div>
			
			
		</div>
	</div>
</div>
				
