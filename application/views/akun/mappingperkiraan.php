<!DOCTYPE html>
<html>
<head>
	<title>Mapping Perkiraan - Pelita Jaya</title>

	<?php echo $this->load->view('template/head_import'); ?>

	<link href="<?php echo base_url().'assets/css/jquery.validity.css'; ?>" type="text/css" rel="stylesheet" />

    <script src="<?php echo base_url().'javascript/javascriptpelangan.js'; ?>" language="javascript"></script>    
    <!--<script src="<?php echo base_url().'javascript/sorttable.js'; ?>"></script>
    <script src="<?php echo base_url().'javascript/jquery.alerts.js'; ?>" type="text/javascript"></script>    
    <script src="<?php echo base_url().'javascript/jquery.ui.draggable.js'; ?>" type="text/javascript"></script>-->
    <script src="<?php echo base_url().'javascript/jquery.validity.js'; ?>" language="javascript"></script>
	<script src="<?php echo base_url().'javascript/jquerydatepick.js'; ?>" language="javascript"></script>

	<script>
		var rowcount=0;

		function EnableTxt(Flag){
			if(Flag==1){
				$(".NoAk").attr("disabled","disabled");
				$(".DbKr").attr("disabled","disabled");
				$("#TipeTran").attr("disabled","disabled");
				$("#jenis").attr("disabled","disabled");
			}else{
				$(".NoAk").removeAttr("disabled","disabled");
				$(".DbKr").removeAttr("disabled","disabled");
				$("#TipeTran").removeAttr("disabled","disabled");
				$("#jenis").removeAttr("disabled","disabled");
			}
		}

		function begin(){
			$("#Tgl").datepick({dateFormat: 'dd-mm-yyyy'});
		}

		$(document).ready(function(){
			var byser=$("#filterby").val();
			var valser="";
			var limit=6;

			$(".action").css("display","none");
			$('#linkadd').hide();
			$('#btnprint').hide();
			$("div#loading").css("display","none");
			EnableTxt(1);
			hidebutton();
			begin();

			function validateMyAjaxInputs(){
				return true;
			}
			
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/mappingperkiraan/getlistdata",
				data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
				cache: false,
				success: function(msg){
					$("#tableemploy > tbody").html(msg);						
				}
			});

			var a = 0;
			$('#tableemploy tbody tr').live('click', function(){	 
				var kode=$(this).find("td:first").text();
				var id="";
				$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>akun/mappingperkiraan/getselect",
					data: "kode="+kode,
					cache: false,
					success: function(msg){ //alert(msg);
					  var isi=msg.split("#");
					  
					if(isi[1]){
						$("#jenis").val(isi[1]);
						$.ajax({
							type: "POST",	   
							url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetTipe",
							data:{id:isi[1]},
							cache: false,
							success: function(msg){  //alert(msg);
								$("#Tipe").html(msg);
								$("#TipeTran").val(isi[0]);
								
									if(msg!=""){
										id = $('#TipeTran').val();
									}else{
										id = $('#jenis').val();
									}
									$.ajax({
										type: "POST",	   
										url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetTabMapPer",
										data: "kode="+kode+"&id="+id,
										cache: false,
										success: function(msg){
											$("#tabledetilindoor > tbody").html(msg);
											if(a!=1){
												EnableTxt(1);
												hidebutton();
												$('#linkadd').hide();
												$(".action").css("display", "none");
												$('#btnprint').show();
												$("#Tgl").attr("disabled","disabled").css("background-color","#FFC");
											}a=0;
										}
									});
									$.ajax({
										type: "POST",	   
										url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetAttr",
										data: "id="+id,
										cache: false,
										success: function(msg){ //alert(msg);
											$("#ListAtt1").html(msg);
										}
									});
								}
							});
						}else{
							$("#Tipe").html("");
							$("#jenis").val(isi[0]);
							$.ajax({
								type: "POST",	   
								url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetTabMapPer",
								data: "kode="+kode+"&id="+isi[0],
								cache: false,
								success: function(msg){
									$("#tabledetilindoor > tbody").html(msg);
									if(a!=1){
										EnableTxt(1);
										hidebutton();
										$('#linkadd').hide();
										$(".action").css("display", "none");
										$('#btnprint').show();
										$("#Tgl").attr("disabled","disabled").css("background-color","#FFC");
									}a=0;
								}
							});
							$.ajax({
								type: "POST",
								url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetAttr",
								data: "id="+isi[0],
								cache: false,
								success: function(msg){ //alert(msg);
									$("#ListAtt1").html(msg);
								}
							});					
						}
					}
				});
			});
			
			$('#tableemploy tr .imgupdate').live('click', function(){
				EnableTxt(0);
				showbutton();
				$('#linkadd').show();
				$('#btnprint').hide();
				$("#flagaction").val(2);
				$(".action").css("display", "");
				$("#Tgl").removeAttr("disabled","disabled");
				a=1;
			});
			
			$('#jenis').live('change', function(){
				$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetTipe",
					data:{id:$(this).val()},
					cache: false,
					success: function(msg){
						$("#Tipe").html(msg);
						var id="";
						if(msg!=""){
							id = $('#TipeTran').val();
						}else{
							id = $('#jenis').val();
						}
						
						$.ajax({
							type: "POST",	   
							url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetNmTab",
							data: "id="+id+"&idxcmb=0",
							cache: false,
							success: function(msg){
								$("#ListAtt"+rowcount).html(msg);
							}
						});
					}
				});
			});
			
			$('#TipeTran').live('change', function(){
				$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetNmTab",
					data: "id="+$(this).val()+"&idxcmb=0",
					cache: false,
					success: function(msg){ //alert(msg);
						for(i=0; i<=rowcount;i++){
							$("#ListAtt"+i).html(msg);
						}
					}
				});
			});
			
			$("#btnnewpel").live('click', function(){
				showbutton();
				$("#ListAtt > tbody").html("");
				$("#jenis").val(0);
				$("#Tipe").html("");
				$('#btnprint').hide();
				EnableTxt(0);
				rowcount=0;
				$('#linkadd').show();
				$(".action").css("display", "");
				$("#Tgl").removeAttr("disabled","disabled");
				$("#flagaction").val(1);
				$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>akun/mappingperkiraan/NewTablejurnal",
					cache: false,
					success: function(msg){
						$("#Tablejurnal").html(msg);
					}
				});
			});
			
			$("#btncancel").click(function(){
				window.location.href="<?php echo base_url(); ?>akun/mappingperkiraan/index/";
			});

			$('#tableemploy tr .imgdelete').live('click', function(){
				var kode=$(this).attr("id");

	            bootbox.dialog({
			        message: "Kode: <b>"+kode+"</b>",
			        title: "<img src='<?php echo base_url();?>/assets/img/warning-icon.svg' class='warning-icon'/> Yakin ingin menghapus Data Berikut?",
			        buttons: {
			            main: {
			                label: "Batal",
			                className: "pull-left",
			                callback: function() {
			                	window.location.href="<?php echo base_url(); ?>akun/mappingperkiraan/index/";	
			                }
			            },
			            danger: {
			                label: "Hapus",
			                className: "btn-danger",
			                callback: function() {
								$.ajax({
									type: "POST",	   
									url: "<?php echo base_url(); ?>akun/mappingperkiraan/deleteheader",
									data: "kode="+kode,
									cache: false,
									success: function(msg){
										//$("#hasil").html(msg);
										window.location.href="<?php echo base_url(); ?>akun/mappingperkiraan/index/";	
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
						type: 'POST',
						url: "<?php echo base_url(); ?>akun/mappingperkiraan/SaveMap",
						data: $("#FormJurnal").serialize(),
						success: function(msg) { //alert(msg);
							window.location.href="<?php echo base_url(); ?>akun/mappingperkiraan/index/";
							bootstrap_alert.success('<b>Sukses!</b> Data telah ditambahkan');
						}
					})  
				}				
			});
			
			$("#popvalsearch").live('keyup', function(){
				var limit=8;
				var offset=10;
				tempopby=$('#popfilterby').val();
				tempopval=$('#popvalsearch').val();
				$('#poptablepel > tbody tr').remove();
				$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnalpopupper/callsearch",
				data: "byser="+tempopby+"&isiser="+tempopval+"&offset="+0+"&limit="+limit+"&offset="+offset+"&idxpop="+idxpop,
				cache: false,
				success: function(msg){
						$("#poptableNer > tbody").html(msg);
					}
				});
			});
		});

		var idk=0;
		$(".NoAk").live('click', function(){
			idxpop=0;
			poptemprowid="";
			poptemprownama="";
			tempopby="";
			tempopval="";
			var by="";
			idk = $(this).attr('kode');
			if($(this).attr('id')=="NNoAk0"){by="selected";}
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnalpopupper/index",
				data: "limit=6&offset=0&by="+by+"",
				cache: false,
				success: function(msg){
					$("#list_perkiraan").html(msg);
					$('#modalPerkiraan').modal('show');
				}			
			});
		});

		$("#butsearch").live('click', function(){
			var limit=8;
			byser=$('#filterby').val();
			valser=$('#valsearch').val();
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/mappingperkiraan/getlistdata",
				data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
				cache: false,
				success: function(msg){
					$("#tableemploy > tbody").html(msg);
				}
			});
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/mappingperkiraan/pagination",
				data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
				cache: false,
				success: function(msg){
					$("#divpagging").html(msg);
				}
			});
		});

		$(".icoclose").live('click', function(){
			poptemprowid="";
			poptemprownama="";
			idxpop=0;
			tempopby="";
			tempopval="";
		});	
		
		$("#cancelpel").live('click', function(){
			poptemprowid="";
			poptemprownama="";
			idxpop=0;
			tempopby="";
			tempopval="";							   
		}); 
		
		$("#linkadd").live('click', function(){rowcount=parseInt(rowcount);
			$("#tabledetilindoor").append("<tr id='row"+(rowcount+1)+"'><td align='left'><input type='text'  style='width:100px;cursor:pointer;' readonly class='NoAk' id='NoAk"+(rowcount+1)+"' kode='"+(rowcount+1)+"' name='NoAk[]'/></td><td align=center><input type='text' kode='"+(rowcount+1)+"'  style='width:200px;cursor:pointer' id='NNoAk"+(rowcount+1)+"' readonly class=NoAk /></td><td><input  style=width:15px; value='0' name='DK"+(rowcount+1)+"' type='radio' checked class='DbKr' /></td><td><input  style=width:15px; value='1' name='DK"+(rowcount+1)+"' type='radio' class='DbKr' /><td><div id='NamaTbl"+(rowcount+1)+"' >ads</div></td><td><div id=Attr"+(rowcount+1)+" ></div></td><td><a id='row"+(rowcount+1)+"' class='linkdel' style='cursor:pointer'>Delete</a></td></tr>");	
			var idd="";
			if(document.getElementById('TipeTran')){
				idd = $('#TipeTran').val();
			}else{
				idd = $('#jenis').val();
			}

			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetNmTab",
				data: "id="+idd+"&idxcmb="+(rowcount+1),
				cache: false,
				success: function(msg){
					$("#NamaTbl"+(rowcount+1)).html(msg);
					rowcount++;
				}
			});
		});
				
		$(".linkdel").live('click', function(){
			if(rowcount!=0){
				rowcount--;
				var idT =$(this).attr('id');
				$("#tabledetilindoor > tbody #"+idT).remove();
			}
		});

		$('#poptableNer input').live('click', function(){
			var value = $(this).attr('id').split("#");
			var x = value[0];

		    var arrs = document.getElementsByName('NoAk[]');
		    found_flag = false;
		    for (i = 0; i < arrs.length; i++) {
		        if (arrs[i].value === x) {
		            found_flag = true;
		            break;
		        }
		    }

		    if (found_flag === true)
		    {
		    	$('#modalPerkiraan').modal('hide');
		        bootstrap_alert.warning('<b>Gagal Menambahkan</b> Perkiraan sudah dipilih');
		    } else {
				$('#NoAk'+idk+'').val(value[0]);
				$('#NNoAk'+idk+'').val(value[1]);
				$('#modalPerkiraan').modal('hide');
			}
		});
		
		function GetAtt(val,idx){
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/mappingperkiraan/GetAttr",
				data: "id="+val+"&row="+rowcount,
				cache: false,
				success: function(msg){
					$("#Attr"+(idx)).html(msg);
				}
			});
		}
</script>

</head>

<body>

	<?php echo $this->load->view('template/head_jurnal'); ?>

	<div class="container" style="margin-bottom:20px;">
	    <div class="row">
			<form method="post" action="#" id="FormJurnal">
				<input type="hidden" value="" name="nomormap" id="nomormap" />

        		<div class="span5">
        			<div id="boxviewemploy">
	                	<h4>List Mapping</h4>

	                    <p id="test"></p>
	                    <div>
	                    	<div>
	                            Search by &nbsp;
	                            <select id="filterby" name="filterby" style="margin-bottom:4px;">
	                                <option value="MJ.nama">Jenis</option>
	                            </select>
	                            <input type="text" name="valsearch" id="valsearch" class="input-medium" />
	                            <input type="button" name="butsearch" id="butsearch" class="btn" value="Search" style="margin-bottom:4px;"/>
	                        </div>
	                    </div>

	                    <div class="table table-hover CSSTabel">
	                    	<input type="hidden" value="" id="txtoff1" />
	                    	<table id="tableemploy" style="width:85%">
								<thead>
									<tr >
										<th style=display:none;text-align:center;>No Mapping</th>
										<th style=text-align:center width=200px;>jenis</th>
										<th width=100px; style=text-align:center>Action</th>
									</tr>
								</thead>  
								<tbody></tbody>
	                        </table>
	                  </div>
	                </div>
        		</div>
            	
				<div class="span7">
					<div id="formdata">
	                	<h4>Form Mapping Jurnal</h4><div id="konfirmasi" class="sukses"></div>
						
						<div class="well" style="height: 370px;overflow-y: auto; margin-bottom:5px;">
							<table border=0>
								<tr>
									<td>Jenis Transaksi</td>
									<td>:
										<select id="jenis" name="jenis">
											<?php
												echo '<option value="">-- Piih --</option>';
												foreach($Combo as $HCombo){
													echo '<option value="'.$HCombo->id.'">'.$HCombo->nama.'</option>';
												}
											?>
										</select>
									</td>
									<td>
										<div id="Tipe" style=margin-left:10px;></div>
									</td>
									<td><input type="button"  value="Create New" id="btnnewpel" class="btn btn-success"/></td>
								</tr>
							</table>

							<table>
								<tr>
									<td>
										<table id="formemploy">
										   <tr align=center >
												<td colspan="4">
													<div id="Tablejurnal">
														<table class="table table-bordered" id="tabledetilindoor">
															<thead>
																<tr>
																	<th>No Perkiraan</th><th>Nama Perkiraan</th><th width=10px;>D</th><th>K</th><th>Table</th><th>Attribute</th><th class=action >Action</th>
																</tr>
															</thead>
															
															<tbody>
																<tr id='row0'>
																	<td align=center><input type='text'  style='width:100px;cursor:pointer;' class='NoAk' name='NoAk[]' id="NoAk0" readonly /></td>
																	<td align=center><input type='text'  style='width:200px;background-color:rgb(240,240,240);' id="NNoAk0" class='NoAk' readonly /></td>
																	<td><input disabled style=width:15px; value='0' name='DK0' type="radio" checked ></input></td>
																	<td><input disabled style=width:15px; value='1' name='DK0' type="radio" ></td>
																	<td><select disabled><option value="">-- pilih --</option></select></td>
																	<td></td>
																	<td class=action><a id='row0' class='linkdel'>Delete</a></td>
																</tr>
															</tbody>
														</table>
													</div>
													<table>
														<tr>
															<td>
																<div style="float:right">
																	<input type="button" style="margin-top:5px;width:432px;border-radius:3px 3px 3px 3px;" id="linkadd"  class="btn" value="Add Row" />
																</div>
															</td>
														</tr>
													</table>
												</td>
										   </tr>
										</table>
									</td>
								</tr>
							</table>
						</div>

						<div>
							<input type="hidden" id="flagaction" name="flagaction"/>
							<input type="button"  value="Save" class="btn btn-primary" id="btnsave" style="width:80px;height:25px;" name="btnsave"/>
							<input type="button"  value="Cancel" class="btn" id="btncancel" style="width:80px;height:25px;" name="btncancel"/>
						</div>
	                </div>
				</div>	
			</form>	
	    </div>
	    <div id="loadingDiv">
           <img src="<?php echo base_url();?>assets/img/ajax-loader.gif"/>
        </div> 
	</div>

	<?php echo $this->load->view('template/footer'); ?>

	<div id="modalPerkiraan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	    <h3 id="myModalLabel">List Pelanggan</h3>
	  </div>
	  <div class="modal-body">
	    <div id="list_perkiraan"></div>
	  </div>
	</div>
</body>

</html>