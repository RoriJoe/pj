<script type="text/javascript" src="<?php echo base_url().'assets/js/dragtable.js';?>" ></script>

<div class="table CSSTabel table-list2" style="margin-top:8px;width:700px;float: left;">
<label id="lab1"style="
    margin-left: 5px;"><b>Laporan Outstanding</b></label>

<table>
	<tr>
		<td width="80%">
			
			<div><b>PERIODE : <?php echo $periode ?></b></div> <!--ambil berdasarkan input radio dari user -->
		</td>
		<td width="20%">
			<div><b>Tanggal : <?php echo $tanggal ?></b></div>
			
		</td>
	</tr>
</table>

						<div style=overflow:auto;height:375px; id="LimitTab">
							<div id="TableLaporanSPK" style=overflow:auto; class='CssTblLaporan' >
								
									<table border='0px' id="tablesorter" class="draggable" style=width:700px;>
										<thead><tr>
										<th>Tanggal</th>
										<th>No DO</th>
										<th>Nama Pelanggan</th>
										<th>Nama Barang</th>
										
										<th>Qty</th>
										<th>Total</th>
										<th>Satuan</th>
										</tr></thead>
										
										<?php
											$no_so="";$tgl="";$plg="";
											foreach($hasil2 as $row)
											{$originalDate1 = $row->Tgl;
											$dmy1 = date("d-m-Y", strtotime($originalDate1));
											$duit=number_format($row->grandttl);
											if($no_so != $row->No_Do){
												$no_so=$row->No_Do;$tgl=$dmy1;$plg=$row->NP;
											}else{
												$no_so="";$tgl="";$plg="";
											}
												echo
												"<tr>
													
													<td>$no_so</td>
													<td>$tgl</td>
													<td>$row->NP</td>
													<td>$row->Nama $row->Ukuran</td>
													
													<td align='right'>$row->Qty</td>
													<td align='right'>$duit</td>
													<td>$row->Satuan1</td>
												</tr>";
												$no_so=$row->No_Do;
											}
												?>
									</table>
							</div>
						</div>
				<!--</div>-->
				
				</div>
				