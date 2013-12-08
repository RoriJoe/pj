// JavaScript Document

function enableinput(){
	$("#txtkodepo").removeAttr("readonly","readonly").css("background-color","");
	$("#txttglpo").removeAttr("readonly","readonly").css("background-color","");
	$("#txttglso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtkodeso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamapel").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamasal").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtdp").removeAttr("readonly","readonly").css("background-color","");
	$("#txtkomisi").removeAttr("readonly","readonly").css("background-color","");
	$(".namabarang").removeAttr("readonly","readonly").css("background-color","");
	$(".qtypcs").removeAttr("readonly","readonly").css("background-color","");
	$(".harga").removeAttr("readonly","readonly").css("background-color","");
	$(".keterangan").removeAttr("readonly","readonly").css("background-color","");
	
}

function setdefault(){
	$(".jumlah").attr("readonly","readonly").css("background-color","#FFC");
}

function disableinput(){
	$("#txtkodepo").attr("readonly","disabled").css("background-color","#FFC");
	$("#txtkodeso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglpo").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamapel").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamasal").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtdp").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtkomisi").attr("readonly","readonly").css("background-color","#FFC");
	$("#boxdetail :input").attr("readonly","readonly").css("background-color","#FFC");
	
}

function disableiputdetil(){
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
	var xx=$("#tabledetilindoor tr").length;
	return xx;
	
}

function clearinput(){
	$("#txtkodeso").val("");
	$("#txttglso").val("");
	$("#txtkodepo").val("");
	$("#txttglpo").val("");
	$("#txtnamapel").val("");
	$("#txtnamasal").val("");
	$("#txtdp").val("");
	$("#txtkomisi").val("");
	$(".namabarang").val("");
	$(".qtypcs").val("");
	$(".harga").val("");
	$(".jumlah").val("");
	$(".keterangan").val("");
	$("#txttotal").val("");
	$("#tabledetilindoor > tbody tr").remove();
	
}

function getsales(idx,filter,val,offset,flag,kode){
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