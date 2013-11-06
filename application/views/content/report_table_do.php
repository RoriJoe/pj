<script type="text/javascript" src="<?php echo base_url().'assets/js/dragtable.js';?>" ></script>

<div class="table CSSTabel table-list2" style="margin-top:8px;width:700px;float: left;">
<label style="
    width: 50%;
    float: left;"><b>Laporan SALES ORDER</b></label>
<label>Periode</label>
<!--<div style="border: 1px solid #ACABAB;margin-top:8px;width:800px;float: left;">-->
						<!--<img src="images/down-arrow.png" style=float:right; onclick="Max()" id="MaxB" value=""/>
						<table border=0>
							<tr>
								<td colspan=0 align=center><font size="5"><b>Laporan SO</b></font>
								</td>
							</tr>
							<tr>
								<td align=center><hr style=margin-top:-4px;><b>Periode :&nbsp;<label id="TggalAwal"></label>&nbsp; s/d &nbsp;<label id="TggalAkhir"></label></b></hr></td>
							</tr>
						</table>-->
						<div style=overflow:auto;height:375px; id="LimitTab">
							<div id="TableLaporanSPK" style=overflow:auto; class='CssTblLaporan' >
								
									<table border='0px' id="tablesorter" class="draggable" style=width:700px;>
										<thead><tr><th>No SO</th><th>No PO</th><th>Pelanggan</th><th>Nama Barang</th><th>Jenis</th><th>Qty</th><th>Satuan</th></tr></thead>
										
										<?php
											foreach($hasil2 as $row)
											{
												echo
												"<tr>
													<td>$row->No_Do</td>
													<td>$row->No_Po</td>
													<td>$row->NP</td>
													<td>$row->Nama</td>
													<td>$row->Ukuran</td>
													<td align='right'>$row->Qty</td>
													<td>$row->Satuan1</td>
												</tr>";
											}
											/* function GantiDate($date){
												return date('d-F-Y', strtotime($date));
											}
											$ii=1;
											if($DataSPK!=false){
												$no=1; $No=1; 	$Nm_Perusahaan="";	$Tgl_SPK="";	 $Nm_Merk="";	$Nm_Tipe=""; $Selesai=0; $Proses=0; $Tunggu=0; 
												foreach($DataSPK as $HDataSPK){
													if($Nm_Perusahaan!=$HDataSPK->Nm_Perusahaan && $no!=1){
														echo '</table><b class=TopTabLab style=margin-left:40px;>Selesai='.$Selesai.'&nbsp;&nbsp;&nbsp;Proses='.$Proses.'&nbsp;&nbsp;&nbsp;Tunggu='.$Tunggu.'</b></br></br>';
														echo'<div style=page-break-after:always;></div><b class=TopTabLab style=margin-left:40px;><label id="SortBy">Rekanan</label>&nbsp;:&nbsp;<label>'.$HDataSPK->Nm_Perusahaan.'</label></b>';
														echo '<table border=1 id="tablesorter'.$ii.'" class="tableLap" style=width:700px;>';
														echo '<thead><tr><th>No</th><th>Merk</th><th>Tipe</th><th>No Polisi</th><th>Tanggal</th><th>No SPK</th><th>Status</th></tr></thead>';
														$Nm_Perusahaan="";	$Tgl_SPK="";	 $Nm_Merk="";	$Nm_Tipe=""; $ii++; $No=1; $Selesai=0; $Proses=0; $Tunggu=0; 
													}
													if($no==1){
														?>
															<script> document.getElementById('NmSort').innerHTML="<?php echo $HDataSPK->Nm_Perusahaan; ?>";</script>
														<?php
													}
													echo '<tr><td>'.$No.'</td>';
													echo '<td>';
														if($Nm_Merk!=$HDataSPK->Nm_Merk)echo $HDataSPK->Nm_Merk;
													echo'</td>';
													echo '<td>';
														if($Nm_Tipe!=$HDataSPK->Nm_Tipe)echo $HDataSPK->Nm_Tipe;
													echo'</td>';
													echo '<td>'.$HDataSPK->No_PolisiKendaraan.'</td>';
													echo '<td>';
														if($Tgl_SPK!=$HDataSPK->Tgl_SPK)echo GantiDate($HDataSPK->Tgl_SPK);
													echo '</td>';
													echo '<td>'.$HDataSPK->No_Spk.'</td>';
													if($status[$no]==2){echo '<td bgcolor="#8DFF8D">Selesai</td>'; $Selesai++;}else if($status[$no]==1){echo '<td bgcolor="#FFDF5F">Proses</td>';$Proses++; }else{ echo '<td>Tunggu</td>'; $Tunggu++;}
													echo "</tr>";					

													$Nm_Perusahaan=$HDataSPK->Nm_Perusahaan;
													$Tgl_SPK=$HDataSPK->Tgl_SPK;
													$Nm_Merk=$HDataSPK->Nm_Merk;
													$Nm_Tipe=$HDataSPK->Nm_Tipe;
													
													$no++;
													$No++;
												}
												echo'</table><b class=TopTabLab style=margin-left:40px;>Selesai='.$Selesai.'&nbsp;&nbsp;&nbsp;Proses='.$Proses.'&nbsp;&nbsp;&nbsp;Tunggu='.$Tunggu.'</b>';
												echo '<input type=hidden value="'.$ii.'" id="Jmlahtab" />';
											}else{echo '<tr><td colspan="12" style=text-align:center;><script>$("#SortBy").text("");</script><font color="red">Tidak Ada Data</font></td></tr>';}
									 */	?>
									</table>
							</div>
						</div>
				<!--</div>-->
				
				</div>
				
