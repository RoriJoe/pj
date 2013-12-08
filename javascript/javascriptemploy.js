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
	$("#txtrole").removeAttr("disabled","disabled").css("background-color","");
	$("#txtadd").removeAttr("disabled","disabled").css("background-color","");
	$("#txtemail").removeAttr("disabled","disabled").css("background-color","");
	$("#txtnpwp").removeAttr("disabled","disabled").css("background-color","");
	$("#txtbb").removeAttr("disabled","disabled").css("background-color","");
	$("#txtpassword").removeAttr("disabled","disabled").css("background-color","");
	$("#txttelrum1").removeAttr("disabled","disabled").css("background-color","");
	$("#txttelrum2").removeAttr("disabled","disabled").css("background-color","");
	$("#txthand1").removeAttr("disabled","disabled").css("background-color","");
	$("#txthand2").removeAttr("disabled","disabled").css("background-color","");
}


function disableinput(){
	$("#txtkode").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtnama").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtrole").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtadd").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtemail").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtnpwp").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtbb").attr("disabled","disabled").css("background-color","#FFC");
	$("#txtpassword").attr("disabled","disabled").css("background-color","#FFC");
	$("#txttelrum1").attr("disabled","disabled").css("background-color","#FFC");
	$("#txttelrum2").attr("disabled","disabled").css("background-color","#FFC");
	$("#txthand1").attr("disabled","disabled").css("background-color","#FFC");
	$("#txthand2").attr("disabled","disabled").css("background-color","#FFC");
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
	$("#txtadd").val("");
	$("#txtemail").val("");
	$("#txtnpwp").val("");
	$("#txtbb").val("");
	$("#txtpassword").val("");
	$("#txttelrum1").val("");
	$("#txttelrum2").val("");
	$("#txthand1").val("");
	$("#txthand2").val("");
	$("#txtrole").val("none");
	
}
	


