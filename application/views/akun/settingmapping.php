<!DOCTYPE html>
<html>
<head>
	<title>Setting Mapping - Pelita Jaya</title>

	<?php echo $this->load->view('template/head_import'); ?>


	<link href="<?php echo base_url().'assets/css/jquerydatepick.css'; ?>" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url().'assets/css/jquery.validity.css'; ?>" type="text/css" rel="stylesheet" />

    <script src="<?php echo base_url().'javascript/javascriptpelangan.js'; ?>" language="javascript"></script>    
    <!--<script src="<?php echo base_url().'javascript/sorttable.js'; ?>"></script>
    <script src="<?php echo base_url().'javascript/jquery.alerts.js'; ?>" type="text/javascript"></script>    
    <script src="<?php echo base_url().'javascript/jquery.ui.draggable.js'; ?>" type="text/javascript"></script>-->
    <script src="<?php echo base_url().'javascript/jquery.validity.js'; ?>" language="javascript"></script>
	<script src="<?php echo base_url().'javascript/jquerydatepick.js'; ?>" language="javascript"></script>
   
</head>

<body>

	<?php echo $this->load->view('template/head_jurnal'); ?>

	<div class="container" style="margin-bottom:20px;">
	    <div class="row">
	    	<div class="span5">
	    		<h4>List Perkiraan</h4>
	    		<div>
	            	<form method="post" action="#">
	                    Search by &nbsp;
	                    <select id="filterby" name="filterby" style="margin-bottom:4px;">
	                        <option value="id">Kode</option>
	                        <option value="nama">Nama</option>
	                    </select>
	                    <input type="text" name="valsearch" id="valsearch" class="input-medium" />
	                    <input type="button" name="butsearch" id="butsearch" class="btn" value="Search" style="margin-bottom:4px;"/>
	                </form>
	            </div>

	            <div style=height:400px;overflow:auto;>
	            	<input type="hidden" value="" id="txtoff1" />
						<table id="tableemploy" class="table table-bordered" style="width:85%">
		                <thead>
		                	<tr>
		                        <th style=display:none; >kode</th>
		                        <th>Nama</th>
		                        <th width=100px; style=text-align:center>Action</th>
		                    </tr>
		                </thead>  
		                <tbody></tbody>
	                </table>
	                <div id="divpagging"></div>
	          	</div>
	    	</div>

	    	<div class="span7">
	    		<div id="hasil"></div>
	            	<h4>Form Perkiraan</h4>
					
					<div class="well">
		                <form id="SettingMapping">
							<input type=hidden id="UpTabel1" name="UpTabel1" />
							<input type=hidden id="UpTabel2" name="UpTabel2" />
							<input type=hidden id="UpTabel3" name="UpTabel3" />
							<input type=hidden id="UpTabel4" name="UpTabel4" />
							<input type="hidden" id="flagaction" name="flagaction"/>
							<input type="button"  value="Create New" id="btnnewpel" class="btn btn-success"/>
							<table border=0>
								<tr><td>Jenis Transaksi</td>
									<td>:
										<select id="jenis" name="jenis">
											<?php
												echo '<option value="0">-- Pilih --</option>';
												foreach($Combo as $HCombo){
													echo '<option value="'.$HCombo->id.'">'.$HCombo->nama.'</option>';
												}
											?>
										</select>
									</td>
									<td>
										<div id="Tipe" style=margin-left:10px;></div>
									</td>
								</tr>
							</table>
							<table border=0>
								<tr>
									<td>Nama Tabel 1</td>
									<td>:
										<select id="Tabel1" name="Tabel1" onchange="GetField(this.value,1,'');">
											<?php
												echo '<option value="0">-- Pilih --</option>';
												foreach($Table as $HTable){
													echo '<option value="'.$HTable->table_name.'">'.$HTable->table_name.'</option>';
												}
											?>
										</select>
									</td>
									<td><label type="text" id="RAtttabel1"  /></td>
								</tr>
								<tr>
									<td>Nama Tabel 2</td>
									<td>: 
										<select id="Tabel2" name="Tabel2" onchange="GetField(this.value,2,'');">
											<?php
												echo '<option value="0">-- Pilih --</option>';
												foreach($Table as $HTable){
													echo '<option value="'.$HTable->table_name.'">'.$HTable->table_name.'</option>';
												}
											?>
										</select>
									</td>
									<td><label type="text" id="RAtttabel2" /></td>
								</tr>
								<tr>
									<td>Nama Tabel 3</td>
									<td>: 
										<select id="Tabel3" name="Tabel3" onchange="GetField(this.value,3,'');">
											<?php
												echo '<option value="0">-- Pilih --</option>';
												foreach($Table as $HTable){
													echo '<option value="'.$HTable->table_name.'">'.$HTable->table_name.'</option>';
												}
											?>
										</select>
									</td>
									<td><label type="text" id="RAtttabel3" /></td>
								</tr>
								<tr>
									<td>Nama Tabel 4</td>
									<td>: 
										<select id="Tabel4" name="Tabel4" onchange="GetField(this.value,4,'');">
											<?php
												echo '<option value="">-- Pilih --</option>';
												foreach($Table as $HTable){
													echo '<option value="'.$HTable->table_name.'">'.$HTable->table_name.'</option>';
												}
											?>
										</select>
									</td>
									<td><label type="text" id="RAtttabel4" /></td>
								</tr>
								<tr>
		                        	<td colspan="3" align="center">
		                        		<div class="form-actions">
		                        			<input type="button"  value="Save" class="btn btn-primary" id="btnsave" style="width:80px;height:25px;" name="btnsave"/>
		                                	<input type="button"  value="Cancel" class="btn" id="btncancel" style="width:80px;height:25px;" name="btncancel"/>
		                        		</div>
		                            </td>
		                        </tr>
							</table>	
		                </form>
	                </div>
	    	</div>
	    </div>
	    <div id="loadingDiv">
           <img src="<?php echo base_url();?>assets/img/ajax-loader.gif"/>
        </div> 
	</div>

	<?php echo $this->load->view('template/footer'); ?>

</body>

<script>
	function EnableTxt(Flag){
		if(Flag==1){
			$("#Tabel1").attr("disabled","disabled");
			$("#Tabel2").attr("disabled","disabled");
			$("#Tabel3").attr("disabled","disabled");
			$("#Tabel4").attr("disabled","disabled");
			$("#jenis").attr("disabled","disabled");
			$("#TipeTran").attr("disabled","disabled");
			$("#Atttabel1").attr("disabled","disabled");
			$("#Atttabel2").attr("disabled","disabled");
			$("#Atttabel3").attr("disabled","disabled");
			$("#Atttabel4").attr("disabled","disabled");
			$(".check").attr("disabled","disabled");
		}else{
			$("#Tabel1").removeAttr("disabled","disabled");
			$("#Tabel2").removeAttr("disabled","disabled");
			$("#Tabel3").removeAttr("disabled","disabled");
			$("#Tabel4").removeAttr("disabled","disabled");
			$("#jenis").removeAttr("disabled","disabled");
			$("#TipeTran").removeAttr("disabled","disabled");
			$("#Atttabel1").removeAttr("disabled","disabled");
			$("#Atttabel2").removeAttr("disabled","disabled");
			$("#Atttabel3").removeAttr("disabled","disabled");
			$("#Atttabel4").removeAttr("disabled","disabled");
			$(".check").removeAttr("disabled","disabled");
		}
	}

	var TypePer=1;
	var Flag=0;
	var a = 0;
	var cfield =0;
	var ffield =0;

	function begin(){
		$("#TglSaldoAwl").datepick({dateFormat: 'dd-mm-yyyy'});
	}

	$(document).ready(function(){
		begin();
		$("#r1").attr('checked', 'checked');
		var byser=$("#filterby").val();
		var valser="";
		var limit=8;
		
		hidebutton();
		EnableTxt(1);
		$('#flagaction').val(0);

		function validateMyAjaxInputs() {
			/* $.validity.start();
			$("#NamaPer").require("Harus di isi!!!");
			$("#Alamat").require("Harus di isi!!!");
			//$("#NilaiSaldo").require("Harus di isi!!!");
			var result = $.validity.end();
			return result.valid; */
			return true;
		}
		
		$.ajax({
			type: "POST",	   
			url: "<?php echo base_url(); ?>akun/settingmapping/getlistdata",
			data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
			cache: false,
			success: function(msg){
				$("#tableemploy > tbody").html(msg);
											
			}
		});

		$("#butsearch").live('click', function(){
			byser=$('#filterby').val();
			valser=$('#valsearch').val();
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/settingmapping/getlistdata",
				data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
				cache: false,
				success: function(msg){ alert(msg);
					$("#tableemploy > tbody").html(msg);
				}
			});
		});

		$('#tableemploy tbody tr').live('click', function(){
			for(j=1;j<=4;j++){
				$("#Tabel"+j).val(0);
				$("#RAtttabel"+j).html("");
			}
			
			var kode=$(this).find("td:first").text();
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/settingmapping/getselect",
				data: "kode="+kode,
				cache: false,
				success: function(msg){ //alert(msg);
					var temp=msg.split("*");
				   for(i=0;i<temp.length-1;i++){
						var isi=temp[i].split("#");
						$("#Tabel"+(i+1)).val(isi[2]);
						$("#UpTabel"+(i+1)).val(isi[2]);
						GetField(isi[2],(i+1));
					}
					cfield=temp.length-1
					if(isi[1]!=""){
					  $.ajax({
							type: "POST",	   
							url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetTipe",
							data:{id:isi[1]},
							cache: false,
							success: function(msg){
								$("#jenis").val(isi[1]);
								$("#Tipe").html(msg);
								$("#TipeTran").val(isi[0]);
							}
						});
					}else{
						$("#jenis").val(isi[0]);
						$("#Tipe").html("");
					}
				}
			});
		});
		
		$('#tableemploy tr .imgupdate').live('click', function(){
			EnableTxt(0);
			showbutton();
			Flag=2;
			a=1;
			$('#flagaction').val(1);
		});
		
		$("#btnnewpel").live('click', function(){
			showbutton();
			Flag=1;
			EnableTxt(0);
			$('#flagaction').val(0);
			$("#Tabel1").val("0");	
			$("#Tabel2").val("0");	
			$("#Tabel3").val("0");	
			$("#Tabel4").val("0");
			$("#RAtttabel1").html("");
			$("#RAtttabel2").html("");
			$("#RAtttabel3").html("");
			$("#RAtttabel4").html("");
			$("#Tipe").html("");
			$("#jenis").val("");
		});
		
		$("#btncancel").click(function(){
			window.location.href="<?php echo base_url(); ?>akun/settingmapping/index/";
		});

		$('#tableemploy tr .imgdelete').live('click', function(){
			var kode=$(this).attr("id");
			var Msg="";
			$('#hasil').text("");
			$('#hasil').show();

            bootbox.dialog({
		        message: "Kode: <b>"+kode+"</b>",
		        title: "<img src='<?php echo base_url();?>/assets/img/warning-icon.svg' class='warning-icon'/> Yakin ingin menghapus Data Berikut?",
		        buttons: {
		            main: {
		                label: "Batal",
		                className: "pull-left",
		                callback: function() {
		                	window.location.href="<?php echo base_url(); ?>akun/settingmapping/index/";	
		                }
		            },
		            danger: {
		                label: "Hapus",
		                className: "btn-danger",
		                callback: function() {
		                	$.ajax({
								type: "POST",	   
								url: "<?php echo base_url(); ?>akun/settingmapping/deletesetmap",
								data: "kode="+kode,
								cache: false,
								success: function(msg){
									$("#hasil").html(msg);
									Msg=msg;
									window.location.href="<?php echo base_url(); ?>akun/settingmapping/index/";	
									bootstrap_alert.success('<b>Sukses!</b> Data '+ kode +' telah dihapus');
								}
							});
		                }
		            }
		        }
		    }); 
		});
		
		
		$('#btnsave').live('click', function(){
			if (validateMyAjaxInputs()) {
					$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>akun/settingmapping/insertsetmap",
					data: $("#SettingMapping").serialize(),
					cache: false,
					success: function(msg){ //alert(msg);
						$("#hasil").html(msg);
						//setTimeout(function(){$('#hasil').hide();},3000)
						if(msg==""){
							//window.location.href="<?php echo base_url(); ?>akun/settingmapping/index/";
							bootstrap_alert.success('<b>Sukses!</b> Data telah ditambahkan');
						}
						
					}					
				});  
			}
		});

		$('#jenis').live('change', function(){
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetTipe",
				data:{id:$(this).val()},
				cache: false,
				success: function(msg){
					$("#Tipe").html(msg);
				}
			});
		});
	});

	function GetField(val,idx){	
		$.ajax({
			type: "POST",	   
			url: "<?php echo base_url(); ?>akun/settingmapping/GetField",
			data:{id:val,idx:idx},
			cache: false,
			success: function(msg){ ffield++;
				$("#RAtttabel"+idx).html(msg);
				if($('#flagaction').val()==1){
					/* if(cfield==ffield){
						if(a==0){
							EnableTxt(1);
							hidebutton();
						}
						a=0;
						ffield=0;
					} */
				}
			}
		});
	}
</script>	

</html>