<!DOCTYPE html>
<html>
<head>
	<title>Cetak Jurnal - Pelita Jaya</title>
	<?php echo $this->load->view('template/head_import'); ?>
	<script src="<?php echo base_url().'javascript/javascriptpelangan.js'; ?>" language="javascript"></script>    
    <script src="<?php echo base_url().'javascript/sorttable.js'; ?>"></script>
    <script src="<?php echo base_url().'javascript/jquery.alerts.js'; ?>" type="text/javascript"></script>    
    <script src="<?php echo base_url().'javascript/jquery.ui.draggable.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'javascript/jquery.validity.js'; ?>" language="javascript"></script>
	<script src="<?php echo base_url().'javascript/jquerydatepick.js'; ?>" language="javascript"></script>

	<script>
		function begin(){
				$("#TglAwl").datepick({dateFormat: 'dd MM yyyy'});
				$("#TglAkhr").datepick({dateFormat: 'dd MM yyyy'});
			}
		$(this).ready(function(){
			begin();
			$("#Cari").live('click', function(){
				$.ajax({
					type: "POST",
					data:{TglAkhr:$('#TglAkhr').val(),TglAwl:$('#TglAwl').val(),NoVo1:$('#NoVo1').val(),NoVo2:$('#NoVo2').val()},
					url: "<?php echo base_url(); ?>akun/cetakjurnal/CariJurnal",
					cache: false,
					beforeSend: function() {
							$("div#loading").css("display","block");
						},
						success: function(msg){
							$("#TableCJurnal").html(msg);
							$("div#loading").css("display","none");	
						}
				});
				
			});
			
			$("#Print").live('click', function(){
					
			var data = $('#TableCJurnal').html();
			var mywindow = window.open('', 'PrintJurnal', 'height=700,width=950');
			mywindow.document.write('<html><head><style>.sortable{border-width: 0 0 1px 1px;border-spacing:0;border-collapse: collapse;border-style: solid;}.Bold{font-weight:bold;}.FieldDK{min-width:80px; text-align:right;} table{border: 0.5px solid #000000;}</style></head><body>');
			mywindow.document.write('<center>Laporan Tansaksi Jurnal<hr size="3" width=250px/>');
			mywindow.document.write('Periode : '+$('#TglAwl').val()+' s/d '+$('#TglAkhr').val()+'');
			mywindow.document.write('</center></br>');
				$.ajax({
					type: "POST",
					data:{TglAkhr:$('#TglAkhr').val(),TglAwl:$('#TglAwl').val(),NoVo1:$('#NoVo1').val(),NoVo2:$('#NoVo2').val()},
					url: "<?php echo base_url(); ?>akun/cetakjurnal/CariJurnal",
					cache: false,
					beforeSend: function() {
							$("div#loading").css("display","block");
						}, 
						success: function(msg){
							mywindow.document.write(msg);
							$("div#loading").css("display","none");
							mywindow.document.write('</body></html>');
							mywindow.print();
							mywindow.close();						
						}
				});	
			});
		});
	</script>

<body>
<?php echo $this->load->view('template/head_jurnal'); ?>
	
	<div class="container" style="margin-bottom:20px;">
    	<div class="row">
    		<div class="span4">
    			<h4>Batas Percetakan</h4>
				<table border=0>
					<tr>
						<td>Tanggal</td><td>: <input type="text" id="TglAwl" style=width:95px;cursor:pointer; readonly value="<?php echo $TglAwl?>" /></td><td>s/d</td><td><input type="text" style=width:95px;cursor:pointer; id="TglAkhr" value="<?php echo $TglAkhr?>" readonly /></td>
					</tr>
					<tr><td>No Voucher</td>
						<td>: 
							<select id="NoVo1">
								<?php
									foreach($Combo as $HCombo){
										if($HCombo->novoucher==$ComboMin)
											echo '<option vlaue="'.$HCombo->novoucher.'" selected>'.$HCombo->novoucher.'</option>';
										else
											echo '<option vlaue="'.$HCombo->novoucher.'">'.$HCombo->novoucher.'</option>';
									}
								?>
							</select>
							
						</td><td>s/d</td>
						<td>
							<select id="NoVo2">
								<?php
									foreach($Combo as $HCombo){
										if($HCombo->novoucher==$ComboMax)
											echo '<option vlaue="'.$HCombo->novoucher.'" selected>'.$HCombo->novoucher.'</option>';
										else
											echo '<option vlaue="'.$HCombo->novoucher.'">'.$HCombo->novoucher.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="5" align="center">
							<div class="form-actions">
								<input type="button"  value="Cari" id="Cari" class="btn"/> 
								<input type="button" value="Print" id="Print" class="btn" />
							</div>
						</td>
					</tr>
				</table>
    		</div>

    		<div class="span8">
    			<h4>List Transaksi Jurnal</h4>
				<div id="TableCJurnal">
				<?php
					function Uang($uang){
						return $in_rp =number_format($uang, 0, '.', '.');
					 }
					function GantiDate($date){
						return date('d F Y', strtotime($date));
					}
					$TV=""; $i=0; $TtDb=0; $TtKr=0; $GTtKr=0; $GTtDb=0; $j=1; $NV="";
					echo '<b>Tanggal: </b><input type="text" id="Tgl" value="" class="input-medium" style="border: 0px solid #000000;background-color:rgb(240,240,240);height:18px;" readonly />';
					echo '<table class="table table-bordered" id="tableemploy" style="margin-bottom:0">
							<thead>
								<tr>
									<th>No</th><th>No Voucher</th><th>No Perkiraan</th><th>Nama Perkiraan</th><th style=min-width:200px;>Keterangan</th><th  width=70px;>Debit</th><th width=70px;>Kredit</th>
								</tr>
							</thead>';
							foreach($Jurnal as $Hdata){ 
							if($i==0){
								echo '<script>$("#Tgl").val("'.GantiDate($Hdata->tanggal).'");</script>';
							}
							if($TV!=$Hdata->tanggal && $i!=0){$j=1;
							echo '<tr style="font-weight:bold" ><td colspan=5 style="text-align:center;" >Total</td><td class=FieldDK>'.Uang($TtDb).'</td><td class=FieldDK>'.Uang($TtKr).'</td></tr>
								</table></br>
								<b>Tanggal: </b> <input type="text" class="input-medium" value="'.GantiDate($Hdata->tanggal).'" style="border: 0px solid #000000;background-color:rgb(240,240,240)" readonly />
								<table class="table table-bordered" id="tableemploy" style="margin-bottom:0">
									<thead>
										<tr>
											<th>No</th><th>No Voucher</th><th>No Perkiraan</th><th>Nama Perkiraan</th><th style=min-width:200px;>Keterangan</th><th width=70px;>Debit</th><th width=70px;>Kredit</th>
										</tr>
									</thead>';
								$TtDb=0; $TtKr=0;
								}
								if($NV!=$Hdata->novoucher){
									if($j!=1)echo '<tr style="font-weight:bold"><td colspan=5 align=center >Total</td><td class=FieldDK>'.Uang($TtDb).'</td><td class=FieldDK>'.Uang($TtKr).'</td></tr>';
									echo '<tr><td style=border-bottom:none;>'.$j.'</td><td style=border-bottom:none;>'.$Hdata->novoucher;
									$j++;$TtDb=0; $TtKr=0;
									}
								else echo '<tr><td style=border-top:none;border-bottom:none;></td><td style=border-top:none;border-bottom:none;>';
							echo '</td>
								<td>'.$Hdata->nomoraccount.'</td>
								<td>'.$Hdata->namaaccount.'</td>
								<td>'.$Hdata->keterangan.'</td>
								<td class=FieldDK>'.Uang($Hdata->debit).'</td>
								<td class=FieldDK>'.Uang($Hdata->kredit).'</td>
							</tr>';
								$TV=$Hdata->tanggal; $NV=$Hdata->novoucher; $TtDb+=$Hdata->debit; $TtKr+=$Hdata->kredit; $GTtKr+=$Hdata->kredit; $GTtDb+=$Hdata->kredit; 
							$i++;
							}
					echo '<tr style="font-weight:bold"><td colspan=5 style="text-align:center;">Total</td><td class=FieldDK>'.Uang($TtDb).'</td><td class=FieldDK>'.Uang($TtKr).'</td></tr></table>';
					echo '<table><tr style="font-weight:bold"><td align=right width=600>Balance :</td><td class=FieldDK width=70px;>'.Uang($GTtDb).'</td><td class=FieldDK width=70px;>'.Uang($GTtKr).'</td></tr></table>';
				?>
				</div>
    		</div>
    	</div>
    </div>

    <?php echo $this->load->view('template/footer'); ?>
</body>
</html>