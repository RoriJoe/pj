<script type="text/javascript" src="<?php echo base_url().'assets/js/dragtable.js';?>" ></script>

<div class="table CSSTabel table-list2">
<label id="lab1"><b>Laporan Surat Jalan</b></label>

<table width="100%;">
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
		<table border='0px' id="tablesorter" class="draggable" style="width:100%;font-size:11px;">
			<thead><tr>
			<th>No SJ</th>
			<th>No SO</th>
			<th>Pelanggan</th>
			<th>Kendaraan</th>
			<th>Nama Barang</th>
			<th>Jenis</th>
			<th>Qty</th>
			<th>Satuan</th>
			</tr></thead>
			
			<?php
				$no_sj="";$plg="";
				foreach($hasil2 as $row)
				{
				//$originalDate1 = $row->Tgl_Po;
				//$dmy1 = date("d-m-Y", strtotime($originalDate1));
				
				if($no_sj != $row->No_Sj){
					$no_sj=$row->No_Sj;$plg=$row->NP;
				}else{
					$no_sj="";$plg="";
				}
					echo
					"<tr>
						<td>$no_sj</td>
						<td>$row->No_Do</td>
						<td>$plg</td>
						<td>$row->No_Mobil</td>
						<td>$row->Nama</td>
						<td>$row->Ukuran</td>
						<td align='right'>$row->Qty1</td>
						<td>$row->Satuan1</td>
					</tr>";
					$no_sj=$row->No_Sj;
				}
					?>
		</table>
	</div>
<!--</div>-->
</div>
				
