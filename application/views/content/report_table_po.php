<script type="text/javascript" src="<?php echo base_url().'assets/js/dragtable.js';?>" ></script>
<style>
	th {
		background: #C24F4F !important;
		color: #fff;
	}
	.mytable th, td {
		padding: 3px;
		line-height: 15px;
		border-collapse:collapse;
	}
	.mytable tr:nth-child(odd) {
		background-color: #E7E7E7;;
	}
</style>

<label id="lab1"><b>Laporan Purchase Order</b>
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
		<table border='1' id="tablesorter" class="mytable draggable" style="width:100%;font-size:11px;">
			<thead><tr>
			<th>No PO</th>
			<th>Supplier</th>
			<th>Tgl PO</th>
			<th>Tgl Kirim</th>
			<th>Nama Barang</th>
			<th>Qty</th>
			
			<th>Satuan</th>
			<th style='text-align:center;'>Nilai</th>
			</tr></thead>
			
			<?php
				$no_so="";$tgl="";$plg="";$gtot=0;
				foreach($hasil2 as $row)
				{$originalDate1 = $row->Tgl_po;
				$dmy1 = date("d-m-Y", strtotime($originalDate1));
				$originalDate2 = $row->Tgl_kirim;
				$dmy2 = date("d-m-Y", strtotime($originalDate2));
				$duit=number_format($row->Nilai);
				if($no_so != $row->Kode_po){
					$no_so=$row->Kode_po;$tgl=$dmy1;$plg=$row->NP; $tgl2=$dmy2;
					
					
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
				}
			?>
			
		</table>
		
		
	</div>
</div>
				
