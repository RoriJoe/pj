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
	$("#txtsatuan").removeAttr("disabled","disabled").css("background-color","");
	$("#txtket").removeAttr("disabled","disabled").css("background-color","");
	$("#txtharga").removeAttr("disabled","disabled").css("background-color","");
	$("#txtstock").removeAttr("disabled","disabled").css("background-color","");
}


function disableinput(){
	$("#txtkode").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtnama").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtsatuan").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtket").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtharga").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtstock").attr("disabled","disabled").css("background-color","#FFC");
}

function showbutton(){
	$("#btnsave").show();
	$("#btncancel").show();
}

function hidebutton(){
	$("#btnsave").hide();
	$("#btncancel").hide();
}

function forupdate(){
	enableinput();
	showbutton();
}

function clearinput(){	
	$("#txtkode").val("");
	$("#txtnama").val("");
	$("#txtsatuan").val("");
	$("#txtket").val("");
	$("#txtharga").val("");
	$("#txtstock").val("");
}