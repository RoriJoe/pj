<script type="text/javascript" src="<?php echo base_url().'assets/js/dragtable.js';?>" ></script>

<div class="table CSSTabel table-list2">
<label id="lab1"style="
    margin-left: 5px;"><b>Laporan Outstanding Sales Order</b></label>
<!--
<table width="100%;">
	<tr>
		<td width="70%">
			<div><b>PERIODE : Semua</b></div> 
		</td>
		<td width="30%" style="text-align:right;">
			<b>Tanggal : <?php //echo $tanggal ?></b>
		</td>
	</tr>
</table>-->
	<div id="LimitTab">
		
			<table border='0px' id="tablesorter" class="draggable" style="width:100%;font-size:11px;">
				<thead><tr>
				<th>No SO</th>
				<th>Nama Pelanggan</th>
				
				
					<th>Pesan</th>
				
				
			
				<th>Nama Barang</th>
				<th>Tanggal</th>
				<th>Kirim</th>
				<th>OS</th>
				<th>Satuan</th>
				</tr>
				</thead>
				
				<?php
					$no_so="";$tgl="";$plg="";$gtot=0;
					foreach($hasil2 as $row)
					{$originalDate1 = $row->Tgl;
					$dmy1 = date("d-m-Y", strtotime($originalDate1));
					$duit=number_format($row->Jumlah);
					
					$outs=$row->Qty - $row->QtyTemp;
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
							
							<td align='right'>$row->Qty</td>
							
							
							<td>$row->Nama $row->Ukuran</td>

							<td>$tgl</td>
							
							
							<td align='right'>$row->QtyTemp</td>
							<td align='right'>$outs</td>
							<td>$row->Satuan1</td>
							
						</tr>";
						$no_so=$row->No_Do;
					}
						?>
			</table>
			
		
	</div>
	<!--</div>-->
</div>
				
