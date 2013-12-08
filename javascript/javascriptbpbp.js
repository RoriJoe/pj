// JavaScript Document

function enableinput(){
	$("#txtkodebpb").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtkodepo").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglsj").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamasup").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtsjsup").removeAttr("readonly","readonly").css("background-color","");

	$(".namabarang").removeAttr("readonly","readonly").css("background-color","");
	$(".qtypcs").removeAttr("readonly","readonly").css("background-color","");
	$(".satuan").removeAttr("readonly","readonly").css("background-color","");			
}


function disableinput(){
	$("#txtkodebpb").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtkodepo").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglsj").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamasup").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtsjsup").attr("readonly","readonly").css("background-color","#FFC");
	
	$(".namabarang").removeAttr("readonly","readonly").css("background-color","");
	$(".qtypcs").removeAttr("readonly","readonly").css("background-color","");
	$(".satuan").removeAttr("readonly","readonly").css("background-color","");
	
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


function clearinput(){
	$("#txtkodebpb").val("");
	$("#txtkodepo").val("");
	$("#txttglsj").val("");
	$("#txtnamasup").val("");
	$("#txtsjsup").val("");
	
	$(".namabarang").val("");
	$(".qtypcs").val("");
	$(".satuan").val("");
	
	$("#tabledetilindoor > tbody tr").remove();
	
}

function FormatNumberBy3(num, decpoint, sep) {
  // check for missing parameters and use defaults if so
  if (arguments.length == 2) {
    sep = ",";
  }
  if (arguments.length == 1) {
    sep = ",";
    decpoint = ".";
  }
  // need a string for operations
  num = num.toString();
  // separate the whole number and the fraction if possible
  a = num.split(decpoint);
  x = a[0]; // decimal
  y = a[1]; // fraction
  z = "";


  if (typeof(x) != "undefined") {
    // reverse the digits. regexp works from left to right.
    for (i=x.length-1;i>=0;i--)
      z += x.charAt(i);
    // add seperators. but undo the trailing one, if there
    z = z.replace(/(\d{3})/g, "$1" + sep);
    if (z.slice(-sep.length) == sep)
      z = z.slice(0, -sep.length);
    x = "";
    // reverse again to get back the number
    for (i=z.length-1;i>=0;i--)
      x += z.charAt(i);
    // add the fraction back in, if it was there
    if (typeof(y) != "undefined" && y.length > 0)
      x += decpoint + y;
  }
  return x;
}


function unserialze(nama){
	var abc= nama.replace(/,/gi,"");
	abc=parseInt(abc);
	return abc;
}
/*
function getsales(idx,filter,val,offset,flag,kode){
	window.location.href="http://localhost/wahana/index.php/salesorderindoor/index/"+idx+"/"+filter+"/"+val+"/"+offset+"/"+flag+"/"+kode;
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


function FormatNumberBy3(num, decpoint, sep) {
  // check for missing parameters and use defaults if so
  if (arguments.length == 2) {
    sep = ",";
  }
  if (arguments.length == 1) {
    sep = ",";
    decpoint = ".";
  }
  // need a string for operations
  num = num.toString();
  // separate the whole number and the fraction if possible
  a = num.split(decpoint);
  x = a[0]; // decimal
  y = a[1]; // fraction
  z = "";


  if (typeof(x) != "undefined") {
    // reverse the digits. regexp works from left to right.
    for (i=x.length-1;i>=0;i--)
      z += x.charAt(i);
    // add seperators. but undo the trailing one, if there
    z = z.replace(/(\d{3})/g, "$1" + sep);
    if (z.slice(-sep.length) == sep)
      z = z.slice(0, -sep.length);
    x = "";
    // reverse again to get back the number
    for (i=z.length-1;i>=0;i--)
      x += z.charAt(i);
    // add the fraction back in, if it was there
    if (typeof(y) != "undefined" && y.length > 0)
      x += decpoint + y;
  }
  return x;
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

function showtotal(){
	$("#divtotal").show();
}

function hidetotal(){
	$("#divtotal").hide();
}

function startout(){
		enableinput();
		showbutton();
		clearinput();
		$("#tabledetilindoor tr").remove();
		$("#tabledetilindoor").append("<tr align='center'><th width='150'>Nama Barang</th><th width='40' >Qty</th><th width='65' >Satuan</th><th width='100' >Harga Satuan</th><th width='100'>Jumlah</th><th width='325'>Keterangan</th></tr>");
		rowcount=$("#tabledetilindoor tr").length;
		$("#tabledetilindoor").append("<tr id='row"+rowcount+"'><td align='left' valign='top'><input type='text'  style='width:150px;' class='namabarang' name='namabar[]'/></td><td align='center' valign='top'><input type='text'  style='width:40px'  class='qtypcs' id='qty"+rowcount+"' name='qtybar[]' /></td><td align='center' valign='top'><input type='text'  style='width:65px;' class='qtypcs' name='satbar[]'/></td> <td align='right' valign='top'><input type='text' style='width:100px;'  class='harga' id='harga"+rowcount+"' name='hargabar[]'/></td><td align='right' valign='top'><input type='text'  style='width:100px;' class='jumlah' readonly='readonly' id='jumlah"+rowcount+"' name='jumlahbar[]' /></td><td><textarea wrap='soft'  style='width:270px; resize:none;' class='keterangan' onclick='seta("+rowcount+")' name='ketbar[]'></textarea></td></tr>");
		$("#txtrow").val(rowcount);
}

function reconvertdecimal(value){
	var b=value.replace(/,/g,"");
	return b;
}

function gettotal(rowcount){
	var total=0;
	for(var i=1; i<=rowcount; i++){
		
	}
}

$(document).ready(function(){
	
	disableinput();
	hidebutton();
	clearinput();
	hidetotal();
	var byser=$("#filterby").val();
	var valser="";
	var limit=10;
	//buat tampung id pas table detil klik
	var temprw="";
	
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
	
	var rowcount=0;
	
	var flagklik=0;
	
	
	$.ajax({
		type: "POST",	   
		url: "http://localhost/wahana/index.php/salesorderindoor/getlistdata",
		data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
		cache: false,
		success: function(msg){
			$("#tablelistsales > tbody").html(msg);
			sorter();
		}
		
	});
	
	$.ajax({
		type: "POST",	   
		url: "http://localhost/wahana/index.php/salesorderindoor/pagination",
		data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
		cache: false,
		success: function(msg){
			$("#divpagging").html(msg);
		}
	});
	
	$("#butsearch").live('click', function(){
		byser=$('#filterby').val();
		valser=$('#valsearch').val();
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getlistdata",
			data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
			cache: false,
			success: function(msg){
				$("#tablelistsales > tbody").html(msg);
				sorter();
			}
		
		});
	
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/pagination",
			data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
			cache: false,
			success: function(msg){
				$("#divpagging").html(msg);
			}
		});
	});
	
	$("#cancelpel").live('click', function(){
		poptemprowid="";
		poptemprownama="";
		idxpop=0;
		tempopby="";
		tempopval="";
		$(".lightdiv").css("display","none");								   
	});
	
	$("#cancelsal").live('click', function(){
		poptemprowid1="";
		poptemprownama1="";
		idxpop1=0;
		tempopby1="";
		tempopval1="";
		$(".lightdiv").css("display","none");								   
	});
	
	
	$(".pagination li a").live('click', function(){
		 
		var offset=$(this).attr("id");
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getlistdata",
			data: "byser="+byser+"&valser="+valser+"&offset="+offset+"&limit="+limit,
			cache: false,
			success: function(msg){
				$("#tablelistsales > tbody").html(msg);
			}
		});
		
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/pagination",
			data: "byser="+byser+"&valser="+valser+"&offset="+offset+"&limit="+limit,
			cache: false,
			success: function(msg){
				$("#divpagging").html(msg);
			}
		});
		
	});
	
	$("#btncreateindoor").click(function(){	
		enableinput();
		showbutton();
		clearinput();
		rowcount=0;
		flagklik=1;
		$("#flagaction").val(1);
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getlastid",
			data: "byser="+byser,
			cache: false,
			success: function(msg){
				$("#txtkodeso").val(msg);
				var d = new Date();
				var year= d.getFullYear();
				var month = d.getMonth()+1;
				var day=d.getDate();
				if(month<10){
					month="0"+month;
				}if(day<10){
					day="0"+day;
				}
				$("#txttglso").val(day+"-"+month+"-"+year);
				$("#txttglpo").datepick({dateFormat: 'dd-mm-yyyy',maxDate: +0});
				$("#txttotal").val(0);
				showtotal();
			}
		});
	});
	
	$('#tablelistsales > tbody tr .bb').live('click', function(){					 
		var kode=$(this).parent().text().substr(0,9);
		flagklik=0;
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getheadersales",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			  var isi=msg.split("#");
			  $("#txtkodeso").val(isi[0]);
			  $("#txtkodepo").val(isi[3]);
			  $("#txttglso").val(isi[1]);
			  $("#txttglpo").val(isi[4]);
			  $("#txtnamapel").val(isi[2]);
			  $("#txtnamasal").val(isi[5]);
			  $("#txtkodepel").val(isi[6]);
			  $("#txtkodesal").val(isi[7]);
			  
			}
		});
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getdetilsales",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			  $("#tabledetilindoor > tbody").html(msg);
			  disableiputdetil();
			}
		});
		
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/gettotal",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			  $("#txttotal").val(msg);
			}
		});
		showtotal();
    });
	
	$('#btncancel').live('click', function(){
		window.location.href="http://localhost/wahana/index.php/salesorderindoor/";	
		rowcount=0;
		flagklik=0;
    });
	
	// buat new sal
	$('#newsal').live('click', function(){
		$(".lightnewsal").css("display","block");
		$(".lightdiv").css("display","none");
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/listemploy/getlastid",
			data: "byser="+byser,
			cache: false,
			success: function(msg){
				$("#txtnew1kode").val(msg);
			}
		});
    });
	
	$('.iconew1close').live('click', function(){
		$(".lightdiv").css("display","block");	
		$(".lightnewsal").css("display","none");
    });
	
	$('#btnnew1cancel').live('click', function(){
		$(".lightdiv").css("display","block");	
		$(".lightnewsal").css("display","none");				   
    });
		 
	$('#btnnew1save').live('click', function(){
		var kode=$("#txtnew1kode").val();
		var nama=$("#txtnew1nama").val();
		var role="Salesman";
		var alamat=$("#txtnew1add").val();
		var email=$("#txtnew1email").val();
		var npwp=$("#txtnew1npwp").val();
		var tel1=$("#txtnew1telrum1").val();
		var tel2=$("#txtnew1telrum2").val();
		var han1=$("#txtnew1hand1").val();
		var han2=$("#txtnew1hand2").val();
		var pass=$("#txtnew1password").val();
		var pinbb=$("#txtnew1bb").val();
		$.ajax({
			  type: "POST",	   
			  url: "http://localhost/wahana/index.php/listemploy/insertkar",
			  data: "kode="+kode+"&nama="+nama+"&role="+role+"&alamat="+alamat+"&email="+email+"&npwp="+npwp+"&tel1="+tel1+"&tel2="+tel2+"&han1="+han1+"&han2="+han2+"&pass="+pass+"&pinbb="+pinbb,
			  cache: false,
			  success: function(msg){
				 idxpop1=0;
				 poptemprowid1="";
				 poptemprownama1="";
				 tempopby1="";
		 		 tempopval1="";
				 $.ajax({
					  type: "POST",	   
					  url: "http://localhost/wahana/index.php/salpopup/index",
					  data: "limit=8&offset=0",
					  cache: false,
					  success: function(msg){
						  $(".lightdiv").html(msg);
						  $(".lightdiv").css("display","block");
						  $(".lightnewsal").css("display","none");
					  }
				  });
			  }
		});
    });
	
	//buat new pel
	$('#newpel').live('click', function(){
		$(".lightnew").css("display","block");
		$(".lightdiv").css("display","none");
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/listpelanggan/getlastid",
			data: "byser="+byser,
			cache: false,
			success: function(msg){
				$("#txtnewkode").val(msg);
			}
		});
    });
	
	$('.iconewclose').live('click', function(){
		$(".lightdiv").css("display","block");	
		$(".lightnew").css("display","none");
    });
	
	$('#btnnewcancel').live('click', function(){
		$(".lightdiv").css("display","block");	
		$(".lightnew").css("display","none");	
		
    });
	
	$('#btnnewsave').live('click', function(){
		var kode= $("#txtnewkode").val();
		var nama=  $("#txtnewnama").val();
		var contact = $("#txtnewcontact").val();
		var alamat =  $("#txtnewadd").val();
		var email =  $("#txtnewemail").val();
		var npwp =  $("#txtnewnpwp").val();
		var telkan1 =  $("#txtnewtelkan1").val();
		var telkan2 =  $("#txtnewtelkan2").val();
		var telrum1 =  $("#txtnewtelrum1").val();
		var telrum2 =  $("#txtnewtelrum2").val();
		var han1 =  $("#txtnewhand1").val();
		var han2 =  $("#txtnewhand2").val();
		var bb =  $("#txtnewbb").val();
		$.ajax({
			  type: "POST",	   
			  url: "http://localhost/wahana/index.php/listpelanggan/insertpel",
			  data: "kode="+kode+"&nama="+nama+"&contact="+contact+"&alamat="+alamat+"&email="+email+"&npwp="+npwp+"&telkan1="+telkan1+"&telkan2="+telkan2+"&telrum1="+telrum1+"&telrum2="+telrum2+"&han1="+han1+"&han2="+han2+"&bb="+bb,
			  cache: false,
			  success: function(msg){
				 idxpop=0;
				 poptemprowid="";
				 poptemprownama="";
				 tempopby="";
		 		 tempopval="";
				$.ajax({
					type: "POST",	   
					url: "http://localhost/wahana/index.php/pelpopup/index",
					data: "limit=8&offset=0",
					cache: false,
					success: function(msg){
						$(".lightdiv").html(msg);
						$(".lightdiv").css("display","block");
						$(".lightnew").css("display","none");
					}
				});
			  }
		});
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
			data: "limit=8&offset=0",
			cache: false,
			success: function(msg){
				$(".lightdiv").html(msg);
			}
		});
	});
	
	$("#popbutsearch").live('click', function(){
		idxpop=1;
		tempopby=$('#popfilterby').val();
		tempopval=$('#popvalsearch').val();
		$('#poptablepel > tbody tr').remove();
		var limit=8;
		$.ajax({
		type: "POST",	   
		url: "http://localhost/wahana/index.php/pelpopup/callsearch",
		data: "byser="+tempopby+"&isiser="+tempopval+"&offset="+0+"&limit="+limit+"&idxpop="+idxpop,
		cache: false,
		success: function(msg){
				$(".lightdiv").html(msg);
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
	
	$(".pagination1 li a").live('click', function(){
		poptemprowid="";
		poptemprownama="";
		var limit=8;
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/pelpopup/callsearch",
			data: "byser="+tempopby+"&isiser="+tempopval+"&offset="+$(this).attr("id")+"&limit="+limit+"&idxpop="+idxpop,
			cache: false,
			success: function(msg){
					$(".lightdiv").html(msg);
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
	
	$('#poptablepel input').live('click', function(){	
		var isi = $(this).attr("id").split('#');
		$('#txtkodepel').val(isi[0]);
		$('#txtnamapel').val(isi[1]);
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
			data: "limit=8&offset=0",
			cache: false,
			success: function(msg){
				//alert(msg);
				$(".lightdiv").html(msg);
			}
		});
	});
	
	$("#popbutsearch1").live('click', function(){
		idxpop1=1;
		var limit=8;
		tempopby1=$('#popfilterby1').val();
		tempopval1=$('#popvalsearch1').val();
		$('#poptablesal > tbody tr').remove();
		$.ajax({
		type: "POST",	   
		url: "http://localhost/wahana/index.php/salpopup/callsearch",
		data: "byser="+tempopby1+"&isiser="+tempopval1+"&offset="+0+"&limit="+limit+"&idxpop1="+idxpop1,
		cache: false,
		success: function(msg){
			
				$(".lightdiv").html(msg);
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
	
	$(".pagination2 li a").live('click', function(){
		poptemprowid1="";
		poptemprownama1="";
		var limit=8;
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salpopup/callsearch",
			data: "byser="+tempopby1+"&isiser="+tempopval1+"&offset="+$(this).attr("id")+"&limit="+limit+"&idxpop1="+idxpop1,
			cache: false,
			success: function(msg){
					$(".lightdiv").html(msg);
			}
		});
	});
	
	$('#poptablesal tr').live('click', function(){
		$('#poptablesal tr').css("background-color","");											 
		$(this).css("background-color","#666");
		poptemprowid1=$(this).text().substring(0,8);
		poptemprownama1=$(this).find("td:odd").text();
    });
	
	$('#poppelbutok1').live('click', function(){					 
		$('#txtkodesal').val(poptemprowid1);
		$('#txtnamasal').val(poptemprownama1);
		$(".lightdiv").css("display","none");
    });
		
	$('#poptablesal input').live('click', function(){	
		var isi = $(this).attr("id").split('#');
		$('#txtkodesal').val(isi[0]);
		$('#txtnamasal').val(isi[1]);
		$(".lightdiv").css("display","none");
    });
	
	
	
	
	
	$("#linkadd").live('click', function(){	
		rowcount++;
		$("#tabledetilindoor").append("<tr id='row"+rowcount+"'><td align='left' valign='top'><input type='text'  style='width:140px;' class='namabarang' name='namabar[]'/></td><td align='center' valign='top'><input type='text'  style='width:60px'  class='qtypcs' id='qty"+rowcount+"' name='qtybar[]' /></td><td align='center' valign='top'><input type='text'  style='width:65px;' class='qtypcs' name='satbar[]'/></td> <td align='right' valign='top'><input type='text' style='width:100px;'  class='harga' id='harga"+rowcount+"' name='hargabar[]'/></td><td align='right' valign='top'><input type='text'  style='width:100px;' class='jumlah'  id='jumlah"+rowcount+"' name='jumlahbar[]' readonly='readonly' tabindex='-1' /></td><td><textarea wrap='soft'  style='width:270px; resize:none;' class='keterangan' name='ketbar[]'></textarea></td><td><a id='row"+rowcount+"' class='linkdel'>Delete</a></td></tr>");	
	});
	
	$("#tabledetilindoor > tbody tr").live('click', function(){	
		temprw=$(this).attr("id");
		$("#tabledetilindoor > tbody tr").css("background-color","");	
		$(this).css("background-color","grey");	
		
	});
	
	$(".linkdel").live('click', function(){	
		var abc =$(this).attr('id');
		$("#tabledetilindoor > tbody #"+abc).remove();
	});
	
	
	
	$("#tabledetilindoor > tbody tr .qtypcs").live('blur', function(){
		if(flagklik==1){											
			var a=reconvertdecimal($(this).val());
			$(this).val(FormatNumberBy3(a));
			var b=reconvertdecimal($(this).parent().parent().find(".harga").val());
			if(b==""){
				b=0;
			}
			var c=parseInt(a)*parseInt(b);
			$(this).parent().parent().find(".jumlah").val(FormatNumberBy3(c));
		}
	});
	
	$("#tabledetilindoor > tbody tr .harga").live('blur', function(){
		if(flagklik==1){	
			var a=reconvertdecimal($(this).val());
			$(this).val(FormatNumberBy3(a));
			var b=reconvertdecimal($(this).parent().parent().find(".qtypcs").val());
			if(b==""){
				b=0;
			}
			var c=parseInt(a)*parseInt(b);
			$(this).parent().parent().find(".jumlah").val(FormatNumberBy3(c));
		}
	});
	
	$("#tabledetilindoor > tbody tr .keterangan").live('blur', function(){
		
		if(flagklik==1){																	
			var total=0;
			var temp=0;
			for(var i=1; i<=rowcount; i++){
				temp=$("#jumlah"+i).val();
				if(temp!=null){
					total+=parseInt(reconvertdecimal(temp));
				}
			}
			$("#txttotal").val(FormatNumberBy3(total));
		}
	});
	
	$('#tablelistsales tr .imgdelete').live('click', function(){
		
		var kode=$(this).attr("id");
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getheadersales",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			  var isi=msg.split("#");
			  $("#txtkodeso").val(isi[0]);
			  $("#txtkodepo").val(isi[3]);
			  $("#txttglso").val(isi[1]);
			  $("#txttglpo").val(isi[4]);
			  $("#txtnamapel").val(isi[2]);
			  $("#txtnamasal").val(isi[5]);
			  $("#txtkodepel").val(isi[6]);
			  $("#txtkodesal").val(isi[7]);
			}
		});
		
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getdetilupdate",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			  $("#tabledetilindoor > tbody").html(msg);
			 	 disableiputdetil();
			}
		});
		
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getcountdetil",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			 rowcount=msg;
			}
		});
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/gettotal",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			  $("#txttotal").val(msg);
			}
		});
		showtotal();
		
		jConfirm('Are you sure you want to delete Sales Order Indoor '+kode+'', 'Confirmation Dialog', 	
			function(r) {
			if(r==true)
			{
				$.ajax({
					type: "POST",	   
					url: "http://localhost/wahana/index.php/salesorderindoor/deletesales",
					data: "kode="+kode,
					cache: false,
					success: function(msg){
						window.location.href="http://localhost/wahana/index.php/salesorderindoor/index/";
					}
				});
			}
		});
	});
	
	$('#tablelistsales tr .imgupdate').live('click', function(){
													  
		$("#flagaction").val(2);
		var kode=$(this).attr("id");
		enableinput();
		showbutton();
		flagklik=1;
		
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getheadersales",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			  var isi=msg.split("#");
			  $("#txtkodeso").val(isi[0]);
			  $("#txtkodepo").val(isi[3]);
			  $("#txttglso").val(isi[1]);
			  $("#txttglpo").val(isi[4]);
			  $("#txtnamapel").val(isi[2]);
			  $("#txtnamasal").val(isi[5]);
			  $("#txtkodepel").val(isi[6]);
			  $("#txtkodesal").val(isi[7]);
			  
			}
		});
		
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getdetilupdate",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			  $("#tabledetilindoor > tbody").html(msg);
			 
			}
		});
		
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/getcountdetil",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			 rowcount=msg;
			}
		});
		$.ajax({
			type: "POST",	   
			url: "http://localhost/wahana/index.php/salesorderindoor/gettotal",
			data: "kode="+kode,
			cache: false,
			success: function(msg){
			  $("#txttotal").val(msg);
			}
		});
		showtotal();
	});

	
	$('#tabledetilindoor tr:last textarea').live('keydown', function(e) { 
	  var keyCode = e.keyCode || e.which; 
	  if (keyCode == 9) { 
		rowcount++;
		$("#tabledetilindoor").append("<tr id='row"+rowcount+"'><td align='left' valign='top'><input type='text'  style='width:140px;' class='namabarang' name='namabar[]'/></td><td align='center' valign='top'><input type='text'  style='width:60px'  class='qtypcs' id='qty"+rowcount+"' name='qtybar[]' /></td><td align='center' valign='top'><input type='text'  style='width:65px;' class='qtypcs' name='satbar[]'/></td> <td align='right' valign='top'><input type='text' style='width:100px;'  class='harga' id='harga"+rowcount+"' name='hargabar[]'/></td><td align='right' valign='top'><input type='text'  style='width:100px;' class='jumlah'  id='jumlah"+rowcount+"' name='jumlahbar[]' readonly='readonly' tabindex='-1' /></td><td><textarea wrap='soft'  style='width:270px; resize:none;' class='keterangan' name='ketbar[]'></textarea></td><td><a id='row"+rowcount+"' class='linkdel'>Delete</a></td></tr>");	
	 	 } 
	});
	
	
	
});

*/