// JavaScript Document
function enabletext(){
	//$("#txtnoso").removeAttr("readonly").css("background-color","");
	//$("#txtnamamsn").removeAttr("readonly").css("background-color","");
	$("#txtukuran").removeAttr("readonly").css("background-color","");
	$("#txtnamacetak").removeAttr("disabled").css("background-color","");
	$("#txtpos").removeAttr("disabled").css("background-color","");
	$("#txtbahan").removeAttr("readonly").css("background-color","");
	$("#txtjumwarna1").removeAttr("disabled").css("background-color","");
	$("#txtjumwarna2").removeAttr("disabled").css("background-color","");
	$("#txtprintno").removeAttr("disabled").css("background-color","");
	$("#txtprintyes").removeAttr("disabled").css("background-color","");
	$("#txtfinish").removeAttr("readonly").css("background-color","");
	$("#txttglselesai").removeAttr("disabled").css("background-color","");
	
}

function disabletext(){
	$("#txtnospk").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnoso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamamsn").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglspk").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnampel").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtukuran").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnamacetak").attr("disabled","disabled").css("background-color","#FFC");
	$("#txttelpon").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtpos").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtjumcetak").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtbahan").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtjumwarna1").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtjumwarna2").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtprintno").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtprintyes").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtfinish").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglselesai").attr("disabled","disabled").css("background-color","#FFC");
}

function showbutton(){
	$("#btsave").show();
	$("#btcancel").show();
	$(".icosearch").show();
}

function hidebutton(){
	$("#btsave").hide();
	$("#btcancel").hide();
	$(".icosearch").hide();
}

function cleartext(){
	$("#txtnospk").val("");
	$("#txtnoso").val("");
	$("#txtnamamsn").val("");
	$("#txttglspk").val("");
	$("#txtnampel").val("");
	$("#txtukuran").val("");
	$("#txtnamacetak").html("<option></option>");
	$("#txttelpon").val("");
	$("#txtpos").val("none");
	$("#txtjumcetak").val("");
	$("#txtbahan").val("");
	$("#txtjumwarna1").val("none");
	$("#txtjumwarna2").val("none");
	$("#txtfinish").val("");
	$("#txttglselesai").val("");
}