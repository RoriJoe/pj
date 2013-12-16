<!DOCTYPE html>
<html>
<head>
	<title>Cetak Buku Besar - Pelita Jaya</title>
	<?php echo $this->load->view('template/head_import'); ?>
	
	<link href="<?php echo base_url().'assets/css/jquerydatepick.css'; ?>" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url().'assets/css/jquery.validity.css'; ?>" type="text/css" rel="stylesheet" />

    <script src="<?php echo base_url().'javascript/javascriptpelangan.js'; ?>" language="javascript"></script>    
    <!--<script src="<?php echo base_url().'javascript/sorttable.js'; ?>"></script>
    <script src="<?php echo base_url().'javascript/jquery.alerts.js'; ?>" type="text/javascript"></script>    
    <script src="<?php echo base_url().'javascript/jquery.ui.draggable.js'; ?>" type="text/javascript"></script>-->
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
					url: "<?php echo base_url(); ?>akun/CetakBukuBesar/CariBukuBesar",
					cache: false,
						success: function(msg){
							$("#FormBukuBesar").html(msg);
							
						}
				});
				
			});
			
			$("#Print").live('click', function(){
					
			var data = $('#TableCJurnal').html();
			var mywindow = window.open('', 'PrintJurnal', 'height=700,width=950');
			mywindow.document.write('<html><head><style>.sortable{border-width: 0 0 1px 1px;border-spacing:0;border-collapse: collapse;border-style: solid;}.Bold{font-weight:bold;}.FieldDK{min-width:80px; text-align:right;} table{border: 0.5px solid #000000;}</style></head><body>');
			mywindow.document.write('<center>Laporan Buku Besar<hr size="3" width=250px/>');
			mywindow.document.write('Periode : '+$('#TglAwl').val()+' s/d '+$('#TglAkhr').val()+'');
			mywindow.document.write('</center></br>');
				$.ajax({
					type: "POST",
					data:{TglAkhr:$('#TglAkhr').val(),TglAwl:$('#TglAwl').val()},
					url: "<?php echo base_url(); ?>akun/cetakbukubesar/CariBukuBesar",
					cache: false,
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
    			<table>
					<tr>
						<td>Tanggal</td><td>: <input type="text" id="TglAwl" style=width:95px;cursor:pointer; readonly value="<?php echo $TglAwl?>" /> s/d <input type="text" style=width:95px;cursor:pointer; id="TglAkhr" value="<?php echo $TglAkhr?>" readonly /></td><td></td><td></td>
					</tr>
					<tr><td>Dari</td>
						<td>: 
							<select id="NoVo1" class="input-large">
								<?php
									foreach($Combo as $HCombo){
										if($HCombo->nomoraccount==$ComboMin)
											echo '<option vlaue="'.$HCombo->nomoraccount.'" selected>'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
										else
											echo '<option vlaue="'.$HCombo->nomoraccount.'">'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
									}
								?>
							</select>
							
						</td>
					</tr>
						<tr>
						<td>Sampai</td>
						<td>:
							<select id="NoVo2" class="input-large">
								<?php
									foreach($Combo as $HCombo){
										if($HCombo->nomoraccount==$ComboMax)
											echo '<option vlaue="'.$HCombo->nomoraccount.'" selected>'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
										else
											echo '<option vlaue="'.$HCombo->nomoraccount.'">'.$HCombo->nomoraccount.' - '.$HCombo->namaaccount.'</option>';
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
    			<h4>List Buku Besar</h4>
    			<div id="FormBukuBesar"></div>
    		</div>
    	</div>
    	<div id="loadingDiv">
           <img src="<?php echo base_url();?>assets/img/ajax-loader.gif"/>
        </div> 
    </div>
    
    <?php echo $this->load->view('template/footer'); ?>
</body>

<script>
$.ajax({
	type: "POST",
	data:{TglAkhr:$('#TglAkhr').val(),TglAwl:$('#TglAwl').val(),NoVo1:$('#NoVo1').val(),NoVo2:$('#NoVo2').val()},
	url: "<?php echo base_url(); ?>akun/CetakBukuBesar/CariBukuBesar",
	cache: false,
		success: function(msg){
			$("#FormBukuBesar").html(msg);
		}
});
</script>

</html>