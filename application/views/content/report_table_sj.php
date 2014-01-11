<script type="text/javascript" src="<?php echo base_url().'assets/js/dragtable.js';?>" ></script>
<style>
	th {
		background: #C24F4F !important;
		color: #fff;
	}
	.mytable th, td {
		padding: 3px;
		line-height: 15px;
	}
	.mytable tr:nth-child(odd) {
		background-color: #E7E7E7;;
	}
</style>

<label id="lab1"><b>Laporan Surat Jalan</b></label>

<table width="100%;">
	<tr>
		<td width="70%">
			
			<div id="per"><b>PERIODE : <?php echo $periode ?></b></div> <!--ambil berdasarkan input radio dari user -->
		</td>
		<td width="30%" style="text-align:right;">
			<b>Tanggal : <?php echo $tanggal ?></b>		
		</td>
	</tr>
</table>
<div id="LimitTab">
	<table border='1' id="tablesorter" class="mytable draggable" style="width:100%;font-size:11px;border-collapse:collapse;">
		<thead><tr>
		<th>No SJ</th>
		<th>No SO</th>
		<th>Nama Barang</th>
		<th>Kendaraan</th>
		
		<th>Pelanggan</th>
		<th>Jenis</th>
		<th>Qty</th>
		<th>Satuan</th>
		</tr></thead>
		
		<?php
			$no_sj="";$plg="";$no_so="";
			foreach($hasil2 as $row)
			{
			//$originalDate1 = $row->Tgl_Po;
			//$dmy1 = date("d-m-Y", strtotime($originalDate1));
			
			if($no_sj != $row->No_Sj){
				$no_sj=$row->No_Sj;$plg=$row->NP;$no_so="$row->No_Do";
			}else{
				$no_sj="";$plg="";$no_so="";
			}
				echo
				"<tr>
					<td>$no_sj</td>
					<td>$no_so</td>
					<td>$row->Nama</td>
					<td>$row->No_Mobil</td>
					
					<td>$plg</td>
					<td>$row->Ukuran</td>
					<td align='right'>$row->Qty1</td>
					<td>$row->Satuan1</td>
				</tr>";
				$no_sj=$row->No_Sj;
			}
				?>
	</table>
</div>
				
