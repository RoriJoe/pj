<!DOCTYPE html>
<html>
<head>
	<title>Jurnal - Pelita Jaya</title>
	
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
	    <form method="post" action="#" id="FormJurnal">
			<div class="span4">
				<h4>List Jurnal</h4>

				<p id="test"></p>
				<div>
			        Search by
			        <select id="filterby" name="filterby"  style="margin-bottom:4px;">
			            <option value="novoucher">novoucher</option>
			        </select>
			        <input type="text" name="valsearch" id="valsearch" style="width:100px;" />
			        <input type="button" name="butsearch" id="butsearch" class="btn" value="Search"  style="margin-bottom:4px;"/>
			    </div>
			    
				<div style=height:400px;overflow:auto;>
					<input type="hidden" value="" id="txtoff1" />
					<table class="table table-bordered" id="tableemploy" style="width:100%;">
					    <thead>
					    	<tr>
					            <th align="center">No Voucher</th>
					            <th>User ID</th>
					            <th>Tanggal</th>
					            <th width=100px;>Action</th>
					        </tr>
					     </thead>  
					     <tbody></tbody>
				    </table>
				    <div id="divpagging"></div>
				</div>
			</div>

			<div class="span8">
				<div id="formdata">
	            	<h4>Form Jurnal</h4><div id="konfirmasi" class="sukses"></div>
					<div style=height:350px;overflow:auto; class="well">
		            	<table border=0  id="formemploy" cellpadding="0" cellspacing="0">
							<tr>
								<td valign=top>
									<table border=0 width="100%">
										<tr>
											<td>
												<div class="pull-left">
													No Voucher <input type="text" readonly class="input-small"  id="NoVo" name="NoVo" value="<?php echo $id;?>" readonly/>
													Tanggal <input type="text" Readonly value="<?php echo date('d-m-Y');?>" class="input-small" id="Tgl" name="Tgl" style="cursor:pointer;background:#fff;" />
												</div>
												<div class="pull-right">
													<input type="button"  value="Create New" id="btnnewpel" class="btn btn-success"/>
													<input type="button" id="linkadd"  class="btn" value="Add" />
												</div>
											</td>
										</tr>
								   	</table>
								</td>
							</tr>

						   	<tr align=center >
								<td colspan="4">
									<div id="Tablejurnal">
										<table class="table table-bordered" id="tabledetilindoor" style="margin-bottom:0px;">
											<thead>
												<tr>
													<th>No Perkiraan</th><th>Nama Perkiraan</th><th>Keterangan</th><th>Debit</th><th>Kredit</th><th class=action >Action</th>
												</tr>
											</thead>
											<tbody>
												<tr id='row0'>
													<td align=center>
														<input type='text'  style='width:100px;cursor:pointer;' class='NoAk' name='NoAk[]' id="NoAk0" readonly />
			                  						</td>
													<td align=center>
														<input type='text'  style='width:140px;background-color:rgb(240,240,240);' id="NNoAk0" class='NoAk' readonly /></td>
													<td>
														<textarea style='width:120px;height:30px;font-size:11px; resize:none;' class='ket' name='ket[]' id="ket0"></textarea></td>
													<td align=right>
														<input type='text'  style='width:100px;text-align:right;' class='Db' name='Db[]' id="Db0" onclick="DisDK(0,this.id)" /></td>
													<td align=right>
														<input type='text' style='width:100px;text-align:right;'  class='Kr' id='Kr0' name='Kr[]' onclick="DisDK(1,this.id)" /></td>
													<td class=action>
														<a id='row0' class='linkdel'>Delete</a></td>
												</tr>
											</tbody>
										</table>

										<table border=0>
											<tr>
												<td width="410px;"; style=text-align:center;>Balance</td>
												<td width=98px style="text-align:right" >
													<label id="TDb">0</label>
												</td>
												<td width=98px style="text-align:right">
													<label id="TKr">0</label>
												</td>
												<td width=35px class=action></td>
											</tr>
										</table>
									
									</div>
								</td>
						   	</tr>
		                </table>
		            </div>
		            <div>
            			<input type="hidden" id="flagaction" name="flagaction"/>
                		<input type="button"  value="Save" class="btn btn-primary" id="btnsave" name="btnsave" style="width:80px;"/>
                    	<input type="button"  value="Cancel" class="btn" id="btncancel" name="btncancel" style="width:80px;"/>
                    	<input type="button"  value="Print" class="btn" id="btnprint" onclick="Print()" style="width:80px;"/>	
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
			<h3 id="myModalLabel">List Perkiraan</h3>
		</div>
		<div class="modal-body">
			<div id="list_perkiraan"></div>
		</div>
		<div class="modal-footer">
	  		<div id="konfirmasi" class="sukses"></div>
	  	</div>
	</div>
</body>

<script>
	var rowcount=0;
	function EnableTxt(Flag){
		if(Flag==1){
			$(".NoAk").attr("disabled","disabled");
			$(".ket").attr("disabled","disabled");
			$(".Db").attr("disabled","disabled");
			$(".Kr").attr("disabled","disabled");
		}else{
			$(".NoAk").removeAttr("disabled","disabled");
			$(".ket").removeAttr("disabled","disabled");
			$(".Db").removeAttr("disabled","disabled");
			$(".Kr").removeAttr("disabled","disabled");
		}
	}
	function begin(){
		$("#Tgl").datepick({dateFormat: 'dd-mm-yyyy'
		});
	}
	
	$(document).ready(function(){
		begin();
		$("#btnsave").attr('disabled',true);
		var byser=$("#filterby").val();
		$(".action").css("display","none");
		 EnableTxt(1);
		$('#linkadd').hide();
		$('#btnprint').hide();
		var valser="";
		var limit=6;
		$("div#loading").css("display","none");
		hidebutton();
		function validateMyAjaxInputs() {
			$.validity.start();
			$(".ket").require("Harus di isi!!!");
			$(".NoAk").require("Harus di isi!!!");
			var result = $.validity.end();
			
			for(i=0;i<=rowcount;i++){
				if($('#Kr'+i+'').val()=="" && $('#Db'+i+'').val()=="" ){
					bootstrap_alert.warning('Debit atau Kredit Tidak Boleh Kosong Semua');
					return false;
				}
			}
			
			if ($("#TKr").text() != $("#TDb").text()){
					bootstrap_alert.info('Debit dan Kredit Harus Sama');
				return false;
			}
			return result.valid;
		}
		
		$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnal/getlistdata",
				data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
				cache: false,
				success: function(msg){
					$("#tableemploy > tbody").html(msg);							
				}
		});
		
		$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnal/pagination",
				data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
				cache: false,
				success: function(msg){
						$("#divpagging").html(msg);
					
				}
		});
		
		$("#NoAk").live('click', function(){
		
			byser=$('#filterby').val();
			valser=$('#valsearch').val();
			var by="";
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnal/getlistdata",
				data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
				cache: false,
				success: function(msg){
					$("#tableemploy > tbody").html(msg);
				
				}
			});
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnal/pagination",
				data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
				cache: false,
				success: function(msg){
						$("#divpagging").html(msg);
					
				}
			});
		});
		
		$(".pagination li a").live('click', function(){
			var offset=$(this).attr("id");
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnal/getlistdata",
				data: "byser="+byser+"&valser="+valser+"&offset="+offset+"&limit="+limit,
				cache: false,
				success: function(msg){
						$("#tableemploy > tbody").html(msg);
					
				}
			});
			
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnal/pagination",
				data: "byser="+byser+"&valser="+valser+"&offset="+offset+"&limit="+limit,
				cache: false,
				success: function(msg){
					$("#divpagging").html(msg);
				}
			});
		});
		var a = 0;
		$('#tableemploy tbody tr').live('click', function(){	 
			var kode=$(this).find("td:first").text();
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnal/getselect",
				data: "kode="+kode,
				cache: false,
				success: function(msg){
				  var isi=msg.split("#");
					$("#NoVo").val(isi[0]);
					$("#Uid").val(isi[1]);
					$("#Tgl").val(isi[2]);
				}
			});
			
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnal/GetTablejurnal",
				data: "kode="+kode,
				cache: false,
				success: function(msg){
					$("#Tablejurnal").html(msg);
					if(a!=1){
						EnableTxt(1);
						hidebutton();
						$('#linkadd').hide();
						$(".action").css("display", "none");
						$('#btnprint').show();
						$("#Tgl").attr("disabled","disabled").css("background-color","#FFC");
					}
					a=0;
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
		
		$("#btnnewpel").live('click', function(){
			showbutton();
			$('#btnprint').hide();
			EnableTxt(0);
			rowcount=0;
			$('#linkadd').show();
			$(".action").css("display", "");
			$("#Tgl").removeAttr("disabled","disabled");
			$("#flagaction").val(1);
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/jurnal/NewTablejurnal",
				cache: false,
				success: function(msg){
					$("#Tablejurnal").html(msg);
					$('#NoVo').val($('#NewId').val());
				}
			});
			
		});
		
		$("#btncancel").click(function(){
			window.location.href="<?php echo base_url(); ?>akun/jurnal/index/";
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
		                	window.location.href="<?php echo base_url(); ?>akun/jurnal/index/";	
		                }
		            },
		            danger: {
		                label: "Hapus",
		                className: "btn-danger",
		                callback: function() {
		                	$.ajax({
								type: "POST",	   
								url: "<?php echo base_url(); ?>akun/jurnal/deleteheader",
								data: "kode="+kode,
								cache: false,
								success: function(msg){
									$("#hasil").html(msg);
									window.location.href="<?php echo base_url(); ?>akun/jurnal/index/";		
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
				for(j=0;j<=rowcount;j++){
					if($("#Kr"+j+"").val()){
						$("#Kr"+j+"").val(Back($("#Kr"+j+"").val()));
					}
					if($("#Db"+j+"").val()){
						$("#Db"+j+"").val(Back($("#Db"+j+"").val()));
					}
				}
				$.ajax({
				type: 'POST',
				url: "<?php echo base_url(); ?>akun/jurnal/SaveNer",
				data: $("#FormJurnal").serialize(),
				success: function(msg) {
					window.location.href="<?php echo base_url(); ?>akun/jurnal/index/";
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

	$(".NoAk").live('click', function(){	
		idxpop=0;
		 poptemprowid="";
		 poptemprownama="";
		 tempopby="";
		 tempopval="";
		 var by="";
		 if($(this).attr('id')=="NNoAk0"){by="selected";}
		 $.ajax({
			type: "POST",	   
			url: "<?php echo base_url(); ?>akun/jurnalpopupper/index",
			data: "limit=8&offset=0&by="+by+"",
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
			url: "<?php echo base_url(); ?>akun/jurnal/getlistdata",
			data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
			cache: false,
			
			success: function(msg){
				$("#tableemploy > tbody").html(msg);
			
			}
		});
		$.ajax({
			type: "POST",	   
			url: "<?php echo base_url(); ?>akun/jurnal/pagination",
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
	
	$("#linkadd").live('click', function(){	rowcount=parseInt(rowcount);
		$("#tabledetilindoor").append("<tr id='row"+(rowcount+1)+"'><td align='left' valign='top'><input type='text'  style='width:100px;cursor:pointer;' class='NoAk' id='NoAk"+(rowcount+1)+"' name='NoAk[]'/></td><td align=center><input type='text'  style='width:140px;cursor:pointer' id='NNoAk"+(rowcount+1)+"' readonly class=NoAk /></td><td align='center' valign='top'><textarea wrap='soft'  style='width:120px;height:30px;font-size:11px; resize:none;' class='ket' name='ket[]' id='ket"+(rowcount+1)+"' ></textarea></td><td align='center' valign='top'><input type='text'  style='width:100px;text-align:right;' class='Db' name='Db[]' id='Db"+(rowcount+1)+"' onclick='DisDK(0,this.id)' /></td> <td align='right' valign='top'><input type='text' style='width:100px;text-align:right;'  class='Kr' name='Kr[]' id='Kr"+(rowcount+1)+"' onclick='DisDK(1,this.id)' /></td><td><a id='row"+(rowcount+1)+"' class='linkdel' style='cursor:pointer;'>Delete</a></td></tr>");	
		rowcount++;
		if(rowcount %2==1){
			$('#ket'+(rowcount)+'').val($('#ket'+(rowcount-1)+'').val());
		}
	});
			
	$(".linkdel").live('click', function(){
		if(rowcount!=0){
			rowcount--;
			var idT =$(this).attr('id');
			$("#tabledetilindoor > tbody #"+idT).remove();
			HtgKr();
			HtgDb();
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
	    }else {
			$('#NoAk'+rowcount+'').val(value[0]);
			$('#NNoAk'+rowcount+'').val(value[1]);
			$('#modalPerkiraan').modal('hide');
		}

		/*var value = $(this).attr('id').split("#");
		$('#NoAk'+rowcount+'').val(value[0]);
		$('#NNoAk'+rowcount+'').val(value[1]);
		$('#modalPerkiraan').modal('hide');*/
	});
			
	function Back(nStr) {
		var hasil='';
		a = nStr.length;
		for(i=0;i<a;i++){
			x = nStr.charAt(i);
			if(!isNaN(x)){
				hasil+=x;
			}
		}
		return hasil;
	}

	function ToUang(nStr) {
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + '.' + '$2');
		}
		return x1 + x2;
	}
	
	$('.Db').live('keyup', function(e) {
		if (e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 8 ){ 
			HtgDb();$(this).val(ToUang(Back($(this).val())));
		}
	});
	
	function DisDK(flag,id){
		if(flag==1){
			$('#Db'+Back(id)+'').attr('readonly','readonly').val("");
			$('#'+id+'').removeAttr('readonly','readonly');
			HtgDb();
		}else{
			$('#Kr'+Back(id)+'').attr('readonly','readonly').val("");
			$('#'+id+'').removeAttr('readonly','readonly');
			HtgKr();
		}
		
		
	}
	
	$('.Kr').live('keyup', function(e) {
		if (e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 8 ){ 
			HtgKr();$(this).val(ToUang(Back($(this).val())));
		}
	});
	function HtgDb(){
		var TDb=0;
		for(j=0;j<=rowcount;j++){
			if($("#Db"+j+"").val()){
				TDb+=parseInt(Back($("#Db"+j+"").val()));
			}
		}
		$("#TDb").text(ToUang(TDb));
		
		var d = $("#TDb").text();
		var k = $("#TKr").text();
		if(d==k){
			$("#btnsave").attr('disabled',false);
		}else{ $("#btnsave").attr('disabled',true);}
		
	}
	function HtgKr(){ 
		var TKr=0;
		for(j=0;j<=rowcount;j++){
			if($("#Kr"+j+"").val()){
				TKr+=parseInt(Back($("#Kr"+j+"").val()));
			}
		}
		$("#TKr").text(ToUang(TKr));
		
		var d = $("#TDb").text();
		var k = $("#TKr").text();
		if(d==k){
			$("#btnsave").attr('disabled',false);
		}else{ $("#btnsave").attr('disabled',true);}
	}
	function Print(){
		EnableTxt(0);
		var data = $('#Tablejurnal').html();
		var mywindow = window.open('', 'Tablejurnal', 'height=700,width=950');
        mywindow.document.write('<html><head><style> input, textarea {border:none;} td{padding:2px;font-size:13px;font-weight:bold;}</style></head><body><table><tr><td>No Voucher </td><td> : '+$('#NoVo').val()+'</td></tr><tr><td>Tangal</td><td> : '+$('#Tgl').val()+'</td></tr></table>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
		EnableTxt(1);
	}

	var filter="";
	//Table Pelanggan
	function listPerkiraan(row){
	 filter = row;
		$.ajax({
		type:'POST',
		url: "<?php echo base_url();?>index.php/ms_perkiraan/view_Perkiraan",
		data :{},
		success:
		function(hh){
			$('#list_pelanggan').html(hh);
			
		}
		});   
	}
	
	function addPelanggan(){
		$('#modalPelanggan').modal('hide');
		$.ajax({
		type:'POST',
		url: "<?php echo base_url();?>index.php/ms_pelanggan/popPelanggan",
		data :{},
		success:
		function(hh){
			$('#add_pelanggan').html(hh);
		}
		});  
	} 
	
	function getPerkiraan(){
		var x = $('input:radio[name=optionsRadios]:checked').val();
		var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
		var t = $('input:radio[name=optionsRadios]:checked').attr('term');
		$('#NNoAk'+filter).val(x);
		$('#NoAk'+filter).val(k);
		$('#terms').val(t);
	}
</script>
</html>