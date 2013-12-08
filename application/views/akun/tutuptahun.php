<!DOCTYPE html>
<html>
<head>
	<title>Mapping Perkiraan - Pelita Jaya</title>
	<?php echo $this->load->view('template/head_import'); ?>
	<script>
	function begin(){
			//$("#TglAwl").datepick({dateFormat: 'dd MM yyyy'});
			//$("#TglAkhr").datepick({dateFormat: 'dd MM yyyy'});
		}
	$(this).ready(function(){
		begin();
		rowcount=1;
		$("#Proses").live('click', function(){
			 $.ajax({
				type: "POST",
				data:{TglAkhr:$('#TglAkhr').val(),TglAwl:$('#TglAwl').val(),NoVo1:$('#NoVo1').val(),NoVo2:$('#NoVo2').val()},
				url: "<?php echo base_url(); ?>akun/CetakBukuBesar/CariBukuBesar",
				cache: false,
				beforeSend: function() {
						$("div#loading").css("display","block");
					},
					success: function(msg){
						$("#FormBukuBesar").html(msg);
						$("div#loading").css("display","none");	
					}
			});
			
		});


		$("#linkadd").live('click', function(){
			 $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>akun/tutuptahun/getcombo",
				data:{rowcount:rowcount},
				cache: false,
				beforeSend: function() {
						//$("div#loading").css("display","block");
					},
					success: function(msg){
						$("#tableresperkiraan").append(msg);	
						rowcount++;
						//$("div#loading").css("display","none");	
					}
			});
		});
		$(".linkdel").live('click', function(){
			if(rowcount!=0){
				rowcount--;
				var idT =$(this).attr('id');
				$("#tableresperkiraan > tbody #"+idT).remove();
			}
		});
		function validateMyAjaxInputs() {
				/* $.validity.start();
				$(".ket").require("Harus di isi!!!");
				$(".NoAk").require("Harus di isi!!!");
				var result = $.validity.end();
				
				for(i=0;i<=rowcount;i++){
					if($('#Kr'+i+'').val()=="" && $('#Db'+i+'').val()=="" ){
						alert("Debit atau Kredit Tidak Boleh Kosong Semua");
						return false;
					}
				}
				
				if ($("#TKr").text() != $("#TDb").text()){
						alert('Debit dan Kredit Harus Sama');
					return false;
				}
				return result.valid; */
				return true;
			}
		$('#save').live('click', function(){
		
		jConfirm('Tutup Tahun '+$("#tahun").val()+' ?', 'Confirmation Dialog', function(r) {
			if(r==true){
				if (validateMyAjaxInputs()){
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url(); ?>akun/tutuptahun/save",
						data: $("#Formtutup").serialize(),
						beforeSend: function() {
							$("div#loading").css("display","block");
						},
						success: function(msg) { alert(msg);
							$("div#loading").css("display","none");
							window.location.href="<?php echo base_url(); ?>akun/tutuptahun/index/";
						}
					})  
				}
			}
	});			
		});
	$('#Batal').live('click', function(){
		jConfirm('Yakin Batal Tutup Tahun '+$("#tahun").val()+' ?', 'Confirmation Dialog', function(r) {
			if(r==true){
				if (validateMyAjaxInputs()) {
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url(); ?>akun/tutuptahun/BatalTutup",
						data: {tahun:$("#tahun").val()},
						beforeSend: function() {
							$("div#loading").css("display","block");
						},
						success: function(msg) { //alert(msg);
							$("div#loading").css("display","none");
							window.location.href="<?php echo base_url(); ?>akun/tutuptahun/index/";
						}
					})  
				}
			}			
		});
		});
		
		$("#btncancel").click(function(){
				window.location.href="<?php echo base_url(); ?>akun/tutuptahun/index/";
			});

	});
	</script>
</head>

<body>
	<?php echo $this->load->view('template/head_jurnal'); ?>

	<div class="container" style="margin-bottom:20px;">
    	<div class="row">
			<div class="span10">
				<div id="formdata">
					<form id="Formtutup">
						<h4>Tutup Tahun</h4>
						
						<div class="">
							<table>
								<tr>
									<td>Tahun</td><td>:
									<?php
										echo '<select name=tahun id=tahun>';
										$d=date('Y');
										for($i=0;$i<3;$i++ ){
											echo '<option value='.$d.'>'.$d.'</option>';
											$d--;
										}
										echo '</select>';
									?>
									
									</td>
								</tr>
							</table>

							<table border=0>
								<tr>
									<td colspan=3></br>
										<input type="button" style="" id="linkadd"  class="btn btn-info" value="Add Row" />

										<table id="tableresperkiraan" class="table table-bordered" style="margin-top:10px;">
											<tr>
												<th style=text-align:center; colspan=4>Perkiraan yang di NOL kan</th>
											</tr>
											<tr>
												<th style=text-align:center;>Dari</th><th style=text-align:center;>Sampai</th><th>Action</th>
											</tr>
											<?php
												$i=0;
												foreach($pernol as $Hpernol){
											?>
												<?php echo '<tr id="row'.$i.'">'; ?>
													<td>
														<select id="minreset" name="minreset[]">
														<?php
															echo '<option value="">-- Pilih --</option>';
															foreach($Comboper as $HCombo){
																if( $Hpernol->dari==$HCombo->nomoraccount)
																	echo '<option value="'.$HCombo->nomoraccount.'" selected >'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
																else
																	echo '<option value="'.$HCombo->nomoraccount.'" >'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
															}
														?>
														</select>
													</td>
													<td>
														<select id="maxreset" name="maxreset[]">
														<?php
															echo '<option value="">-- Pilih --</option>';
															foreach($Comboper as $HCombo){
																if( $Hpernol->sampai==$HCombo->nomoraccount)
																	echo '<option value="'.$HCombo->nomoraccount.'" selected >'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
																else
																	echo '<option value="'.$HCombo->nomoraccount.'">'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
															}
														?>
														</select>
													</td>
													<?php echo "<td><a id='row".$i."' class='linkdel' href='#'><u>Delete</u></a></td>"; ?>
													
												</tr>
											<?php $i++; }?>
										</table>

									</td>

								</tr>
								
								<tr>
									<td>
										</br>
										<table class="table table-bordered">
											<tr>
												<th style=text-align:Center;>Akumulasi Laba/Rugi</th>
											</tr>
											<tr>
												<td>
													<select id="akumulasi" name="akumulasi">
												<?php
													$i=0;
													foreach($akumulasi as $Hakumulasi){
												?>
													
														<?php
															echo '<option value="">-- Pilih --</option>';
															foreach($Comboper as $HCombo){
																if( $Hakumulasi->nomoraccount==$HCombo->nomoraccount)
																	echo '<option value="'.$HCombo->nomoraccount.'" selected >'.$HCombo->namaaccount.'</option>';
																else
																	echo '<option value="'.$HCombo->nomoraccount.'">'.$HCombo->namaaccount.'</option>';
															}
														?>
													
												<?php }?>
												</select>
												</td>
											</tr>
										</table>
									</td>
								</tr>

								<tr>
									<td colspan=5 align=center>
									<div class="form-actions">
										<input type=button id="save" value="Tutup" class="btn btn-primary"></input>
										<input type=button id="Batal" value="Batal Tutup" class="btn btn-danger"></input>
										<input type="button" value="Cancel" class="btn" id="btncancel" name="btncancel"/>
									</div>
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>
			</div>
    	</div>
    </div>

    <?php echo $this->load->view('template/footer'); ?>
</body>

</html>
