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


function showbutton(){
	$("#btnsave").show();
	$("#btncancel").show();
	$(".imgplus").show();
	document.getElementById('btnnewpel').style.visibility = 'hidden';
}

function hidebutton(){
	$("#btnsave").hide();
	$("#btncancel").hide();
	$(".imgplus").hide();
	document.getElementById('btnnewpel').style.visibility = 'visible';
}
