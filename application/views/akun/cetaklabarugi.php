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

		var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juli','Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		var currentYear = (new Date).getFullYear();
		$(this).ready(function(){
			var byser=$("#filterby").val();
				var valser="";
				var limit=8;
				$("div#loading").css("display","none");
				
				$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/cetaklabarugi/searchlabarugi",
				data: {bln:$('#bln').val(),thn:$('#thn').val(),Smpbln:$('#Smpbln').val(),Smpthn:$('#Smpthn').val()},
				cache: false,
				success: function(msg){
						$("#ViewJurnal > tbody").html(msg);
						$("div#loading").css("display","none");
													
				}
			});
		});
		
		
		
		$('#Cari').live('click', function(){
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/cetaklabarugi/searchlabarugi",
				data: {bln:$('#bln').val(),thn:$('#thn').val(),Smpbln:$('#Smpbln').val(),Smpthn:$('#Smpthn').val()},
				cache: false,
				success: function(msg){
						$("#ViewJurnal > tbody").html(msg);
						$("div#loading").css("display","none");
													
				}
			});
		});
		
		$("#Print").live('click', function(){
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1;
			var jam = today.getHours();
			var mnt = today.getMinutes();
			var dtk = today.getSeconds();
			
			var mywindow = window.open('', 'PrintJurnal', 'height=700,width=950');
			mywindow.document.write('<html><head><style>#ViewNeraca {display: table;}#pageFooter {display: table-footer-group;}#pageFooter:after {counter-increment: page;content:counter(page);}</style></head><body>');
			mywindow.document.write('<center>Laporan Laba Rugi<hr size="3" width=150px/>');
			mywindow.document.write('Sampai : '+bulan[$('#bln').val()]+' '+$('#thn').val()+'');
			mywindow.document.write('</center></br>');
			mywindow.document.write($('#ViewNeraca').html());
			mywindow.document.write('<div style=bottom:0;right:0;position:fixed;><div style=font-size:10pt;display:inline;>Tanggal : '+dd+' '+bulan[mm]+' '+currentYear+' Jam '+jam+':'+mnt+':'+dtk+'&nbsp;&nbsp;&nbsp;Halaman </div> <div id="pageFooter" style=display:inline;></div></div>');
			mywindow.document.write('</body></html>');
			mywindow.print();
			mywindow.close();
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
						<td>Dari Bulan</td>
						<td>: 
							<select id="bln">
								<script>
									for(var i=1; i <= 12 ; i++){
										document.write('<option value='+i+' >'+bulan[i-1]+'</option>');
									}
								</script>
							</select>
						</td>
						<td>
							<select id=thn>
								<script>
									for(var i=currentYear; i >= currentYear-3 ; i--){
										document.write('<option value='+i+' >'+i+'</option>');
									}
								</script>
							</select>
						</td>
					</tr>
					<tr>
						<td> Sampai </td>
						<td>:
							<select id="Smpbln">
								<script>
									for(var i=12; i >= 1 ; i--){
										document.write('<option value='+i+' >'+bulan[i-1]+'</option>');
									}
								</script>
							</select>
						</td>
						<td>
							<select id='Smpthn'>
								<script>
									for(var i=currentYear; i >= currentYear-1 ; i--){
										document.write('<option value='+i+' >'+i+'</option>');
									}
								</script>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="5" align="center">
							<div class="form-actions">
								<input type="button"  value="Cari" id="Cari" class="btn"/>
								<input type="button"  value="Print" id="Print" class="btn"/>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="span8">
				<h4>View Laba Rugi</h4>
				<div id="ViewNeraca" class="well">
					<table id="ViewJurnal" border="0" style=margin-left:40px;>
					<thead>
						<tr>
							<th></th>
							<th width=80px style=text-align:right><b><u>This Year</u></b></th><th width=20px;></th>
							<th width=80px style=text-align:right><b><u>Last Year</u></b></th><th width=20px;></th>
							<th width=80px style=text-align:right><b><u>Variance</u></b></th>
						</tr>
					 </thead>  
					 <tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->load->view('template/footer'); ?>
</body>
</html>