// JavaScript Document

function showbutton(){
	$("#btsave").show();
	$("#btcancel").show();
	$("#btprint").show();
	$("#sosearch").show();
}

function hidebutton(){
	$("#btsave").hide();
	$("#btcancel").hide();
	$("#btprint").hide();
	$("#sosearch").hide();
	
}

function disableinput(){
	$("#txtnoinvoice").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnoso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglinvoice").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtpel").attr("readonly","readonly").css("background-color","#FFC");;
	$("#txtterm").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtalamat").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttotal").attr("readonly","readonly").css("background-color","#FFC");
}

function enableinput(){
	$("#txtnoinvoice").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtnoso").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttglinvoice").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtpel").attr("readonly","readonly").css("background-color","#FFC");
	$("#txtterm").removeAttr("readonly","readonly").css("background-color","");
	$("#txtalamat").attr("readonly","readonly").css("background-color","#FFC");
	$("#txttotal").attr("readonly","readonly").css("background-color","#FFC");
}

function setclear(){
	$("#txtnoinvoice").val("");
	$("#txtnoso").val("");
	$("#txttglinvoice").val("");
	$("#txtpel").val("");
	$("#txtterm").val("");
	$("#txtalamat").val("");
	$("#txttotal").val("");
	$("#tabledetilinvoice > tbody tr").remove();
}
