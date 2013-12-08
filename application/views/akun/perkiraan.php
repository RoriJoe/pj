<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Wahana Printing</title>
    <link href="<?php echo base_url().'css/style.css'; ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url().'css/jquerydatepick.css'; ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url().'css/stylepage.css'; ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url().'css/jquery.validity.css'; ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url().'css/jquery.alerts.css'; ?>" type="text/css" rel="stylesheet" />
    
    <script src="<?php echo base_url().'javascript/jquery.js'; ?>" language="javascript"></script>
    <script src="<?php echo base_url().'javascript/javascriptpelangan.js'; ?>" language="javascript"></script>    
    <script src="<?php echo base_url().'javascript/sorttable.js'; ?>"></script>
    <script src="<?php echo base_url().'javascript/jquery.alerts.js'; ?>" type="text/javascript"></script>    
    <script src="<?php echo base_url().'javascript/jquery.ui.draggable.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'javascript/jquery.validity.js'; ?>" language="javascript"></script>
	 <script src="<?php echo base_url().'javascript/jquerydatepick.js'; ?>" language="javascript"></script>
    <style>
		div#loading {
				top: 0px;
				left:0px;
				background-color:rgba(0,0,0,0.5);
				margin: auto;				
				position: absolute;
				z-index: 100000000;
				width: 100%;
				height: 100%;				
				cursor: wait;
		}			
		.imgload{
				top: 50%;
				left:50%;
				position: absolute;
		}
    </style>
	<script>
		function EnableTxt(Flag){
			if(Flag==1){
				$("#NoAccount").attr("disabled","disabled").css("background-color","#FFC");
				$("#TglEnt").attr("disabled","disabled").css("background-color","#FFC");
				$("#Uid").attr("disabled","disabled").css("background-color","#FFC");
				$("#TglSaldoAwl").attr("disabled","disabled").css("background-color","#FFC");
				$("#NamaPer").attr("disabled","disabled").css("background-color","#FFC");
				$("#Level").attr("disabled","disabled").css("background-color","#FFC");
				$("#NilaiSaldo").attr("disabled","disabled").css("background-color","#FFC");
				$(".radioBtnClass").attr("disabled","disabled").css("background-color","#FFC");
			}else{
				$("#NoAccount").removeAttr("disabled","disabled").css("background-color","");
				$("#NamaPer").removeAttr("disabled","disabled").css("background-color","");
				$("#Level").removeAttr("disabled","disabled").css("background-color","");
				$("#NilaiSaldo").removeAttr("disabled","disabled").css("background-color","");
				$(".radioBtnClass").removeAttr("disabled","disabled").css("background-color","");
				$("#TglSaldoAwl").removeAttr("disabled","disabled").css("background-color","");
			}
		}
		var TypePer=1;
		var Flag=0;
		function begin(){
			$("#TglSaldoAwl").datepick({dateFormat: 'dd-mm-yyyy'});
		}
		$(document).ready(function(){
			begin();
			$("#r1").attr('checked', 'checked');
			var byser=$("#filterby").val();
			var valser="";
			var limit=8;
			$("div#loading").css("display","none");
			hidebutton();
			EnableTxt(1);
			function validateMyAjaxInputs() {
				$.validity.start();
				$("#NamaPer").require("Harus di isi!!!");
				$("#Alamat").require("Harus di isi!!!");
				//$("#NilaiSaldo").require("Harus di isi!!!");
				var result = $.validity.end();
				return result.valid;
			}
			
			$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>index.php/perkiraan/getlistdata",
					data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
					cache: false,
					beforeSend: function() {
							$("div#loading").css("display","block");
					},
					success: function(msg){
							$("#tableemploy > tbody").html(msg);
							$("div#loading").css("display","none");
														
					}
			});
			
			$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>index.php/perkiraan/pagination",
					data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
					cache: false,
					beforeSend: function() {
							$("div#loading").css("display","block");
					},
					success: function(msg){
							$("#divpagging").html(msg);
							$("div#loading").css("display","none");	
					}
			});
			
			$("#butsearch").live('click', function(){
				byser=$('#filterby').val();
				valser=$('#valsearch').val();
				$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>index.php/perkiraan/getlistdata",
					data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
					cache: false,
					beforeSend: function() {
						$("div#loading").css("display","block");
					},
					success: function(msg){
						$("#tableemploy > tbody").html(msg);
						$("div#loading").css("display","none");	
					}
				});
				$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>index.php/perkiraan/pagination",
					data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
					cache: false,
					beforeSend: function() {
							$("div#loading").css("display","block");
					},
					success: function(msg){
							$("#divpagging").html(msg);
							$("div#loading").css("display","none");	
					}
				});
			});
			
			$(".pagination li a").live('click', function(){
				var offset=$(this).attr("id");
				$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>index.php/perkiraan/getlistdata",
					data: "byser="+byser+"&valser="+valser+"&offset="+offset+"&limit="+limit,
					cache: false,
					beforeSend: function() {
							$("div#loading").css("display","block");
					},
					success: function(msg){
							$("#tableemploy > tbody").html(msg);
							$("div#loading").css("display","none");	
					}
				});
	
				$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>index.php/perkiraan/pagination",
					data: "byser="+byser+"&valser="+valser+"&offset="+offset+"&limit="+limit,
					cache: false,
					success: function(msg){
						$("#divpagging").html(msg);
					}
				});
			});
			var a = 0;
			$('#tableemploy tr').live('click', function(){	 
				var kode=$(this).find("td:first").text();
				$.ajax({
					type: "POST",	   
					url: "<?php echo base_url(); ?>index.php/perkiraan/getselect",
					data: "kode="+kode,
					cache: false,
					success: function(msg){
					  var isi=msg.split("#");
						$("#NoAccount").val(isi[0]);
						$("#Kode").val(isi[0]);
						$("#NamaPer").val(isi[1]);
						$("#Level").val(isi[2]);
						$("#r"+isi[3]+"").attr('checked', 'checked');
						$("#TglSaldoAwl").val(isi[5]);
						$("#NilaiSaldo").val(ToUang(isi[6]));
						if(a!=1){
							EnableTxt(1);
							hidebutton();
							$('#linkadd').hide();
						}
						a=0;
					}
				});
			});
			
			$("#btnnewpel").live('click', function(){
				showbutton();
				EnableTxt(0);
				$("#flagaction").val(1);
				$("#NoAccount").val("");
				$("#NamaPer").val("");
				$("#TglSaldoAwl").val("<?php echo date('d-m-Y');?>");
				$("#Level").val("");
				$("#NilaiSaldo").val("0");
				$(".radioBtnClass").val("");
				$("#r1").attr('checked', 'checked');				
			});
			
			$("#btncancel").click(function(){
				window.location.href="<?php echo base_url(); ?>index.php/Perkiraan/index/";
			});
			$('#tableemploy tr .imgdelete').live('click', function(){
				var kode=$(this).attr("id");
				var Msg="";
				$('#hasil').text("");
				$('#hasil').show();
				jConfirm('Are you sure you want to delete Pelanggan '+kode+' ?', 'Confirmation Dialog', function(r) {																												
					if(r==true){
						$.ajax({
							type: "POST",	   
							url: "<?php echo base_url(); ?>index.php/Perkiraan/deleteper",
							data: "kode="+kode,
							cache: false,
							success: function(msg){
								$("#hasil").html(msg);
								Msg=msg;
							}
						});
					} 
					jAlert('success', 'Confirmed', 'Confirmation Results',function(r){
						if(Msg){
							setTimeout(function(){$('#hasil').hide();},3000)
							return false;
						}else 
							window.location.href="<?php echo base_url(); ?>index.php/Perkiraan/index/";														   
					});
                });		
			});
			
			$('#tableemploy tr .imgupdate').live('click', function(){
				EnableTxt(0);
				showbutton();
				$("#flagaction").val(2);
				$('#LblErr').text("");
				Flag=1;
				a=1;
			});
			$('#btnsave').live('click', function(){
				if (validateMyAjaxInputs()) {
					var NoAc= $("#NoAccount").val();
					var NamaPer=  $("#NamaPer").val();
					var Level = $("#Level").val();
					var NilaiSaldo = Huruf($("#NilaiSaldo").val());
					var flag =  $("#flagaction").val();
					var TglSaldoAwl =  $("#TglSaldoAwl").val();
					var Kode =  $("#Kode").val();
					if(Level==4 && ($.trim($("#NilaiSaldo").val())=="")){
						alert("Saldo Belum Diisi"); return false;
					}
					if(Flag==0){return false};
					if(flag==1){
						//insert
						   $.ajax({
						  type: "POST",	   
						  url: "<?php echo base_url(); ?>index.php/Perkiraan/insertper",
						  data: "NoAc="+NoAc+"&NamaPer="+NamaPer+"&Level="+Level+"&Type="+TypePer+"&NilaiSaldo="+NilaiSaldo+"&TglSaldoAwl="+TglSaldoAwl,
						  cache: false,
						  beforeSend: function() {
								$("div#loading").css("display","block");
							},
							success: function(msg){
								window.location.href="<?php echo base_url(); ?>index.php/Perkiraan/index/";
								$("div#loading").css("display","none");
							}					
						});  
					}else if(flag==2){
						//update
						$.ajax({
						  type: "POST",	   
						  url: "<?php echo base_url(); ?>index.php/Perkiraan/updateper",
						  data: "NoAc="+NoAc+"&NamaPer="+NamaPer+"&Level="+Level+"&Type="+TypePer+"&NilaiSaldo="+NilaiSaldo+"&Kode="+Kode+"&TglSaldoAwl="+TglSaldoAwl,
						  cache: false,
						  beforeSend: function() {
							$("div#loading").css("display","block");
						},
						success: function(msg){
							window.location.href="<?php echo base_url(); ?>index.php/Perkiraan/index/";
							$("div#loading").css("display","none");
						}
						});
					}
				}
				
			});
			
		$('#NilaiSaldo').keyup(function(e){
			if (e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 8 ) 
			{ 
				var Value = Huruf($(this).val());
				$(this).val(ToUang(Value));
			}
		});  
		});
	function SetVal(id){
			TypePer=id;
		}
	function Huruf(nStr) {
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
	
	function SetNoAC(Val){
		if(Val==""){
			$('#LblErr').hide();
			return false;
		}else $('#LblErr').show();
		var No = document.getElementById('NoAccount');
		var Level = document.getElementById('Level');
		var Value = Huruf(Val);
		Level.value ='';
		No.value=Value;
		if(Value.length ==1){
			Level.value = '1';
			No.value=Value;
		}
		else if(Value.length ==2){
			No.value = Value.substring(0,1)+'.'+Value.substring(1,2);
			Level.value = '2';
		}else if(Value.length==3 || Value.length==4){
			No.value = Value.substring(0,1)+'.'+Value.substring(1,2)+'.'+Value.substring(2,4);
			Level.value = '3';
		}else if(Value.length > 4){
			No.value = Value.substring(0,1)+'.'+Value.substring(1,2)+'.'+Value.substring(2,4)+'.'+Value.substring(4,7);
			Level.value = '4';
		}
		$.ajax({
		  type: "POST",	   
		  url: "<?php echo base_url(); ?>index.php/Perkiraan/CekNoAcc",
		  data: {Val:No.value,FlagAc:$("#flagaction").val(),Kode:$("#Kode").val()},
		  cache: false,
		  beforeSend: function() {
			$("#ImgCek").css("display","");
			},
			success: function(msg){
				 if(msg==1){
					$('#LblErr').text("Sudah Terdaftar");
					$('#LblErr').css("color","red");Flag=0;
				}else if(msg==0){
					$('#LblErr').text("Ok");
					$('#LblErr').css("color","green");Flag=1;
				}else if(msg==2){
					$('#LblErr').text("level "+(Level.value-1)+" Belum Terdaftar");
					$('#LblErr').css("color","red");Flag=0;
				}
				$("#ImgCek").css("display","none");
			}
		});
	}
	
	
	
	</script>	
</head>

<body>
	<div class="wrap">
    	<div id="header">
        	<?php 
				$data['sitemap']="Master &nbsp;&nbsp;>>&nbsp;&nbsp; <a class='sitemap' href='".base_url()."index.php/perkiraan'>Perkiraan</a>";
				$this->load->view("header",$data); 
			?>
        </div>
		
        <div id="content" >
            <div id="boxcontent" style=height:513px;>
                <div>
                	<div id="boxviewemploy" style=height:490px;>
                    	<div><strong>List Perkiraan</strong></div>
                        <hr  size="3"/>
                        <div>
                        	<div style="float:left">
                        	<form method="post" action="#">
                                <font size="+1">Search by</font> &nbsp;
                                <select id="filterby" name="filterby">
                                    <option value="nomoraccount">Kode</option>
                                    <option value="namaaccount">Nama</option>
                                </select>
                                <input type="text" name="valsearch" id="valsearch" />
                                <input type="button" name="butsearch" id="butsearch" class="but" value="Search" />
                            </form>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class=boxlist style=height:430px;>
                        	<input type="hidden" value="" id="txtoff1" />
                        	<table id="tableemploy" border="1"  class="sortable" cellpadding="0" cellspacing="0" style=min-width:350px>
                            <thead>
                            	<tr>
                                    <th style=text-align:center>No Account</th>
                                    <th>Nama</th>
                                    <th>Type</th>
                                    <th>Level</th>
                                    <th width=100px; style=text-align:center>Action</th>
                                </tr>
                             </thead>  
                             <tbody></tbody>
                            </table>
                            <div id="divpagging"></div>
                      </div>
                    </div>
                    <div id="formdata" style=height:490px;>
					<div id="hasil" class="error"></div>
                    	<div><strong>Form Perkiraan</strong>&nbsp; &nbsp;<input type="button"  value="Create New" id="btnnewpel" class="but"/></div>
                        <hr size="3"/>
                        <form id="FormPerkiraan">
                        	<table border="0" width="450"  id="formemploy" cellpadding="0" cellspacing="0">
                            	<tr>
                                	<td width="145">No Account</td>
                                    <td colspan="2"><input type="text"  id="NoAccount" name="NoAccount" onkeyup="SetNoAC(this.value)"/><input type="hidden" id="Kode" /><label id="LblErr" style=font-size:12px;font-family:Arial;margin-left:5px;></label><img src='<?php echo base_url()."asset/img/loader.gif"; ?>' width='15' height='10' style=display:none; id="ImgCek" /></td>
                                </tr>
                                <tr>
                                	<td valign="middle">Nama Perkiraan</td>
                                    <td colspan="2" valign="middle"><input type="text" id="NamaPer"  name="NamaPer" style="width:200px;"/> </td>
                               </tr>
                                <tr>
                                  <td>Level</td>
                                  <td colspan="2"><input type="text" id="Level" name="Level" style="width:30px;" readonly /></td>
                                </tr>
								</table>
								<table width="450" border=0 style=font-size:14px;font-weight:bold;>
                                <tr>
                                  <td width="147">Type</td>
									<td>
										<input type="radio"  name="Type" id="r1" class="radioBtnClass" onclick="SetVal(1)">Asset</input></br>
										<input type="radio"  name="Type" id="r2" class="radioBtnClass" onclick="SetVal(2)">Liability</input></br>
										<input type="radio"  name="Type" id="r3" class="radioBtnClass" onclick="SetVal(3)">Revenue</input>
									</td>
									<td>
										
										<input type="radio" name="Type" id="r4" class="radioBtnClass" onclick="SetVal(4)">Expense</input></br>
										<input type="radio" name="Type" id="r5" class="radioBtnClass" onclick="SetVal(5)">Equity</input></br>
										<input type="radio" name="Type" id="r6" class="radioBtnClass" onclick="SetVal(6)">Contra Account</input>
								  </td>
                                </tr>
								</table>
								<table border="0" width="450"  id="formemploy" cellpadding="0" cellspacing="0">
                                <tr>
                                	<td width="147">Tanggal Entry</td>
                                    <td ><input type="text" id="TglEnt"  readonly value="<?php echo date('d-m-Y');?>"/></td>
                               </tr>
                                <tr>
                                	<td>Tanggal Saldo Awal</td>
                                    <td><input type="text" Readonly id="TglSaldoAwl" name="TglSaldoAwl"  style=cursor:pointer; /></td>
                                </tr>
                                
                                <tr>
                                  <td>Nilai Saldo Awal</td>
                                  <td colspan="2"><input type="text" name="NilaiSaldo" value=0 id="NilaiSaldo" style="Text-Align:right" /></td>
                                </tr>
                                <tr>
                                	<td colspan="3" align="center">
                                    	<input type="hidden" id="flagaction"/>
                                    	<input type="button"  value="Save" class="butformemploy" id="btnsave" style="width:80px;height:25px;" name="btnsave"/>
                                        <input type="button"  value="Cancel" class="butformemploy" id="btncancel" style="width:80px;height:25px;" name="btncancel"/>
                                    </td>
                                </tr>
                            </table>
                         </form>

                    </div>
                    <div class="clear" id="test"></div>
                </div>
        	</div>
          </div>
        <div id="footer">Copyright © 2013 - Wahana Printing</div>
    </div>
	<div id="loading"><img  class='imgload' src='<?php echo base_url()."asset/img/loading.gif"; ?>' width="100" height="100"/></div>
</body>
</html>