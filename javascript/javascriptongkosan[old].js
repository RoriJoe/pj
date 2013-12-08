// JavaScript Document
function enableinput(){
	$("#txtkodepo").removeAttr("readonly","readonly").css("background-color","");
	$("#txttglpo").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtkodeso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamapel").removeAttr("readonly","readonly").css("background-color","");
	$("#txtnamasal").removeAttr("readonly","readonly").css("background-color","");
	$(".namabarang").removeAttr("readonly","readonly").css("background-color","");
	$(".qtypcs").removeAttr("readonly","readonly").css("background-color","");
	$(".harga").removeAttr("readonly","readonly").css("background-color","");
	$(".keterangan").removeAttr("readonly","readonly").css("background-color","");
	
}

function setdefault(){
	$(".jumlah").attr("disabled","disabled").css("background-color","#FFC");
}

function disableinput(){
	$("#txtkodepo").attr("readonly","disabled").css("background-color","#FFC");
	$("#txtkodeso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglpo").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamapel").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamasal").attr("readonly","readonly").css("background-color","#FFC");
	$("#boxdetail :input").attr("readonly","readonly").css("background-color","#FFC");
	$(".namabarang").attr("readonly","readonly").css("background-color","#FFC");
	$(".qtypcs").attr("readonly","readonly").css("background-color","#FFC");
	$(".harga").attr("readonly","readonly").css("background-color","#FFC");
	$(".keterangan").attr("readonly","readonly").css("background-color","#FFC");
}

function showbutton(){
	$("#btnsave").show();
	$("#btncancel").show();
	$("#linkadd").show();
	$("#linkremove").show();
	$(".icosearch").show();
}

function hidebutton(){
	$("#btnsave").hide();
	$("#btncancel").hide();
	$("#linkadd").hide();
	$("#linkremove").hide();
	$(".icosearch").hide();
}

function returnid(){
	//$("#temprowid").val();
	//alert(kode);
	var xx=$("#tabledetilindoor tr").length;
	return xx;
	
}

function clearinput(){	
	$("#txtkodepo").val("");
	$("#txtnamapel").val("");
	$("#txtnamasal").val("");
	$(".namabarang").val("");
	$(".qtypcs").val("");
	$(".harga").val("");
	$(".jumlah").val("");
	$(".keterangan").val("");
}

function getsales(idx,filter,val,offset,flag,kode){
	//alert(idx+"-"+filter+"-"+val+"-"+offset+"-"+flag+"-"+kode);
	window.location.href="http://localhost/wahana/index.php/salesorderongkosan/index/"+idx+"/"+filter+"/"+val+"/"+offset+"/"+flag+"/"+kode;
}

function startin(){
	disableinput();
	hidebutton();
}
function hitunggrand(){
	var cnt=$("#tabledetilindoor tr").length;
	var gt=0;
	for(var i=1; i<cnt; i++){
		gt+=document.getElementById("jumlah"+i).value;
		
	}
	document.getElementById("txttotal").value=gt;
	//alert("asd");
}
function hitungsubtotal(jum){
	alert(jum);
	//alert("asd");
}
function seta(id){
	
	var x =  document.getElementById("harga"+id).value;
	var y =  document.getElementById("qty"+id).value;
	var z=	document.getElementById("jumlah"+id).value=x*y;
	var b=parseInt(document.getElementById("txttotal").value);
	b+=parseInt(z);
	var gt=0;
	var cnt=$("#tabledetilindoor tr").length;
	for(var i=1; i<cnt; i++){
		gt+=parseInt(document.getElementById("jumlah"+i).value);
	}
	document.getElementById("txttotal").value="";
	document.getElementById("txttotal").value=gt;
	//alert("asd");
}

function startout(){
		enableinput();
		showbutton();
		clearinput();
		$("#tabledetilindoor tr").remove();
		$("#tabledetilindoor").append("<tr align='center'><th width='150'>Nama Barang</th><th width='40' >Qty</th><th width='65' >Satuan</th><th width='100' >Harga Satuan</th><th width='100'>Jumlah</th><th width='325'>Keterangan</th></tr>");
		rowcount=$("#tabledetilindoor tr").length;
		$("#tabledetilindoor").append("<tr id='row"+rowcount+"'><td align='left' valign='top'><input type='text'  style='width:150px;' class='namabarang' name='namabar[]'/></td><td align='center' valign='top'><input type='text'  style='width:40px'  class='qtypcs' id='qty"+rowcount+"' name='qtybar[]' /></td><td align='center' valign='top'><input type='text'  style='width:65px;' class='qtypcs' name='satbar[]'/></td> <td align='right' valign='top'><input type='text' style='width:100px;'  class='harga' id='harga"+rowcount+"' name='hargabar[]'/></td><td align='right' valign='top'><input type='text'  style='width:100px;' class='jumlah' readonly='readonly' id='jumlah"+rowcount+"' name='jumlahbar[]' /></td><td><textarea wrap='soft'  style='width:270px;resize:none;' class='keterangan' onclick='seta("+rowcount+")' name='ketbar[]'></textarea></td></tr>");
		$("#txtrow").val(rowcount);
		
		
}

$(document).ready(function(){
						   
	var woke=0;
	var temprowid="";
	var rowcount=0;
	
	//buat popoup Pelanggan
	var poptemprowid="";
	var poptemprownama="";
	var idxpop=0;
	var tempopby="";
	var tempopval="";
	
	//buat popup Salesman
	var poptemprowid1="";
	var poptemprownama1="";
	var idxpop1=0;
	var tempopby1="";
	var tempopval1="";
	
	//buat popup PO
	var poptemprowid2="";
	var poptemprowtgl2="";
	var idxpop2=0;
	var tempopby2="";
	var tempopval2="";
	
	
	
	$("#butsearch").click(function(){
		var filter=$("#filterby").val();
		var valsearch=$("#valsearch").val();
		window.location.href="http://localhost/wahana/index.php/salesorderongkosan/index/1/"+filter+"/"+valsearch+"/0";
		
	});
	
	$('#tabledetilindoor tr td input').find(".namabarang").live('click', function(){
		alert("ad");
    });
	//$('#btncreateindoor').live('click', function(){
	$("#btncreateindoor").click(function(){	
		window.location.href="http://localhost/wahana/index.php/salesorderongkosan/index/0/asd/0/0/2/";
		//window.location.href="http://localhost/wahana/index.php/salesorderindoor/indexad/1/"+filter+"/"+valsearch+"/0";
	});
	
	$("#linkadd").click(function(){
		rowcount=$("#tabledetilindoor tr").length;
		
	$("#tabledetilindoor").append("<tr id='row"+rowcount+"'><td align='left' valign='top'><input type='text'  style='width:150px;' class='namabarang' name='namabar[]'/></td><td align='center' valign='top'><input type='text'  style='width:40px'  class='qtypcs' id='qty"+rowcount+"' name='qtybar[]' /></td><td align='center' valign='top'><input type='text'  style='width:65px;' class='qtypcs' name='satbar[]'/></td> <td align='right' valign='top'><input type='text' style='width:100px;'  class='harga' id='harga"+rowcount+"' name='hargabar[]'/></td><td align='right' valign='top'><input type='text'  style='width:100px;' class='jumlah' readonly='readonly' id='jumlah"+rowcount+"' name='jumlahbar[]' /></td><td><textarea wrap='soft'  style='width:270px;resize:none;' class='keterangan' onclick='seta("+rowcount+")' name='ketbar[]'></textarea></td></tr>");
	
	$("#txtrow").val(rowcount);
										 	
	});
	
	$("#btncancel").click(function(){
		window.location.href="http://localhost/wahana/index.php/salesorderongkosan/index/";
	});
	
	$("#linkremove").click(function(){
		 $("#"+temprowid+"").remove();
		 hitunggrand();
		//window.location.href="http://localhost/wahana/index.php/salesorderindoor/index/";
	});
	
	$('#tabledetilindoor tr').live('click', function(){
		$('#tabledetilindoor tr').css("background-color","");											 
		$(this).css("background-color","#666");
   		 temprowid=$(this).attr("id");
    });
	
	//buat popup pelanggan
	$("#pelsearch").live('click', function(){
		 idxpop=0;
		 poptemprowid="";
		 poptemprownama="";
		 $(".lightdiv").css("display","block");
		 tempopby="";
		 tempopval="";
		 $.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/pelpopup/index",
			data: "asal=woke",
			cache: false,
			success: function(msg){
				$(".lightdiv").html(msg);
			}
		});
	});
	
	$("#popbutsearch").live('click', function(){
		idxpop=1;
		var limit=2;
		tempopby=$('#popfilterby').val();
		tempopval=$('#popvalsearch').val();
		$('#poptablepel > tbody tr').remove();
		$.ajax({
		type: "POST",	   
		url: "http://localhost/wahana/index.php/pelpopup/callsearch",
		data: "byser="+tempopby+"&isiser="+tempopval+"&offset="+0+"&limit="+limit+"&idxpop="+idxpop,
		cache: false,
		success: function(msg){
				$("#boxisi").html(msg);
			}
		});
	});	
	
	$(".icoclose").live('click', function(){
		poptemprowid="";
		poptemprownama="";
		idxpop=0;
		tempopby="";
		tempopval="";
		 $(".lightdiv").css("display","none");
		
	});	
	
	$(".linkpaging").live('click', function(){
		var limit=2;
		poptemprowid="";
		poptemprownama="";
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/pelpopup/callsearch",
			data: "byser="+tempopby+"&isiser="+tempopval+"&offset="+$(this).attr("id")+"&limit="+limit+"&idxpop="+idxpop,
			cache: false,
			success: function(msg){
					$("#boxisi").html(msg);
			}
		});
	});
	
	$('#poptablepel tr').live('click', function(){
		$('#poptablepel tr').css("background-color","");											 
		$(this).css("background-color","#666");
		poptemprowid=$(this).text().substring(0,8);
		poptemprownama=$(this).find("td:odd").text();
    });
	
	$('#poppelbutok').live('click', function(){					 
		$('#txtkodepel').val(poptemprowid);
		$('#txtnamapel').val(poptemprownama);
		$(".lightdiv").css("display","none");
    });
	
	//buat pop sales
	$("#salsearch").live('click', function(){
		 idxpop1=0;
		 poptemprowid1="";
		 poptemprownama1="";
		 $(".lightdiv").css("display","block");
		 tempopby1="";
		 tempopval1="";
		 $.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salpopup/index",
			data: "asal=woke",
			cache: false,
			success: function(msg){
				$(".lightdiv").html(msg);
			}
		});
	});
	
	$("#popbutsearch1").live('click', function(){
		idxpop1=1;
		var limit=2;
		tempopby1=$('#popfilterby1').val();
		tempopval1=$('#popvalsearch1').val();
		$('#poptablesal > tbody tr').remove();
		$.ajax({
		type: "POST",	   
		url: "http://localhost/wahana/index.php/salpopup/callsearch",
		data: "byser="+tempopby1+"&isiser="+tempopval1+"&offset="+0+"&limit="+limit+"&idxpop1="+idxpop1,
		cache: false,
		success: function(msg){
				$("#boxisi1").html(msg);
			}
		});
	});	
	
	$(".icoclose").live('click', function(){
		poptemprowid1="";
		poptemprownama1="";
		idxpop1=0;
		tempopby1="";
		tempopval1="";
		 $(".lightdiv").css("display","none");
		
	});	
	
	$(".linkpaging1").live('click', function(){
		var limit=2;
		poptemprowid1="";
		poptemprownama1="";
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salpopup/callsearch",
			data: "byser="+tempopby1+"&isiser="+tempopval1+"&offset="+$(this).attr("id")+"&limit="+limit+"&idxpop1="+idxpop1,
			cache: false,
			success: function(msg){
					$("#boxisi1").html(msg);
			}
		});
	});
	
	$('#poptablesal tr').live('click', function(){
		$('#poptablesal tr').css("background-color","");											 
		$(this).css("background-color","#666");
		poptemprowid1=$(this).text().substring(0,8);
		poptemprownama1=$(this).find("td:odd").text();
		//poptemprowid1=$(this).text().substring(0,8);
		//poptemprownama1=$(this).text().substring(8);
    });
	
	$('#poppelbutok1').live('click', function(){					 
		$('#txtkodesal').val(poptemprowid1);
		$('#txtnamasal').val(poptemprownama1);
		$(".lightdiv").css("display","none");
    });
	
	//buat pop up PO
	$("#posearch").live('click', function(){
		 idxpop2=0;
		 poptemprowid2="";
		 $(".lightdiv").css("display","block");
		 tempopby2="";
		 tempopval2="";
		 $.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/popopup/index",
			data: "asal=woke",
			cache: false,
			success: function(msg){
				$(".lightdiv").html(msg);
			}
		});
	});
	
	$("#popbutsearch2").live('click', function(){
		idxpop2=1;
		var limit=2;
		tempopby2=$('#popfilterby2').val();
		tempopval2=$('#popvalsearch2').val();
		$('#poptablepo > tbody tr').remove();
		$.ajax({
		type: "POST",	   
		url: "http://localhost/wahana/index.php/popopup/callsearch",
		data: "byser="+tempopby2+"&isiser="+tempopval2+"&offset="+0+"&limit="+limit+"&idxpop2="+idxpop2,
		cache: false,
		success: function(msg){
				$("#boxisi2").html(msg);
			}
		});
	});	
	
	$(".icoclose").live('click', function(){
		poptemprowid2="";
		idxpop2=0;
		tempopby2="";
		tempopval2="";
		 $(".lightdiv").css("display","none");
		
	});	
	
	$(".linkpaging2").live('click', function(){
		var limit=2;
		poptemprowid2="";
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/popopup/callsearch",
			data: "byser="+tempopby2+"&isiser="+tempopval2+"&offset="+$(this).attr("id")+"&limit="+limit+"&idxpop2="+idxpop2,
			cache: false,
			success: function(msg){
					$("#boxisi2").html(msg);
			}
		});
	});
	
	$('#poptablepo tr').live('click', function(){
		$('#poptablepo tr').css("background-color","");											 
		$(this).css("background-color","#666");
		poptemprowid2=$(this).text().substring(0,9);
		poptemprowtgl2=$(this).text().substring(9);
    });
	
	$('#poppelbutok2').live('click', function(){					 
		$('#txtkodepo').val(poptemprowid2);
		$('#txttglpo').val(poptemprowtgl2);
		$(".lightdiv").css("display","none");
    });
	
});

