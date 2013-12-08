// JavaScript Document

function sorter(){
	$("table").tablesorter({debug: true})
	$("a.append").click(appendData);
}

function setcurDate()
{

	var d = new Date();
	var weekday=new Array(7);
	weekday[0]="Sunday";
	weekday[1]="Monday";
	weekday[2]="Tuesday";
	weekday[3]="Wednesday";
	weekday[4]="Thursday";
	weekday[5]="Friday";
	weekday[6]="Saturday";
	var month="";
	var hour="";
	var minute="";
	var second="";
	
	if(d.getMonth()<10)
	{	
		month="0"+d.getMonth();
	}
	else
	{
		month=d.getMonth();
	}
	
	if(d.getHours()<10)
	{	
		hour="0"+d.getHours();
	}
	else
	{
		hour=d.getHours();
	}
	
	if(d.getMinutes()<10)
	{	
		minute="0"+d.getMinutes();
	}
	else
	{
		minute=d.getMinutes();
	}
	
	if(d.getSeconds()<10)
	{	
		second="0"+d.getSeconds();
	}
	else
	{
		second=d.getSeconds();
	}
	
	var x= document.getElementById("curdate").innerHTML=weekday[d.getDay()]+", "+d.getDate()+"-"+month+"-"+d.getFullYear()+" "+hour+":"+minute+":"+second;
	//setTimeout("setcurDate()", 1000) 
}

function enableinput(){
	$("#txtkode").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtnama").removeAttr("disabled","disabled").css("background-color","");
	$("#txtnofax").removeAttr("disabled","disabled").css("background-color","");
	$("#txtcontact").removeAttr("disabled","disabled").css("background-color","");
	$("#txttelkan").removeAttr("disabled","disabled").css("background-color","");
	$("#txttelcon").removeAttr("disabled","disabled").css("background-color","");
	$("#txtaddkan").removeAttr("disabled","disabled").css("background-color","");
	$("#txtaddcon").removeAttr("disabled","disabled").css("background-color","");
	$("#txtket").removeAttr("disabled","disabled").css("background-color","");
	$("#txtstatus").removeAttr("disabled","disabled").css("background-color","");
}


function disableinput(){
	$("#txtkode").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtnama").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtnofax").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtcontact").attr("disabled","disabled").css("background-color","#FFC");
	$("#txttelkan").attr("disabled","disabled").css("background-color","#FFC");
	$("#txttelcon").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtaddkan").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtaddcon").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtket").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtstatus").attr("disabled","disabled").css("background-color","#FFC");
}

function showbutton(){
	$("#btnsave").show();
	$("#btncancel").show();
}

function hidebutton(){
	$("#btnsave").hide();
	$("#btncancel").hide();
}

function clearinput(){	
	$("#txtkode").val("");
	$("#txtnama").val("");
	$("#txtnofax").val("");
	$("#txtcontact").val("");
	$("#txttelkan").val("");
	$("#txttelcon").val("");
	$("#txtaddkan").val("");
	$("#txtaddcon").val("");
	$("#txtket").val("");
	$("#txtstatus").val("none");
}