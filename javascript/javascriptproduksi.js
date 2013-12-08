// JavaScript Document

function showbutton(){
	$("#btsave").show();
	$("#btcancel").show();
	$("#msnsearch").show();
	$("#opsearch").show();
	$("#btadd").show();
	$("#btremove").show();;
}

function hidebutton(){
	$("#btsave").hide();
	$("#btcancel").hide();
	$("#msnsearch").hide();
	$("#opsearch").hide();
	$("#btadd").hide();
	$("#btremove").hide();
}

function disableinput(){
	$("#txtnopro").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamaop").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglpro").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamames").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtshift1").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtshift2").attr("disabled","disabled").css("background-color","#FFC");
}

function enableinput(){
	$("#txtnopro").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamaop").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglpro").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamames").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtshift1").removeAttr("disabled","disabled").css("background-color","#FFC");
	$("#txtshift2").removeAttr("disabled","disabled").css("background-color","#FFC");
}

function setclear(){
	$("#txtnopro").val("");
	$("#txtnamaop").val("");
	$("#txttglpro").val("");
	$("#txtnamames").val("");
	$("#txtshift1").removeAttr("checked");
	$("#txtshift2").removeAttr("checked");
	$("#tabledetilpro > tbody tr").remove();
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
