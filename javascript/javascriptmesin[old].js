// JavaScript Document

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
	$("#txtkode").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtnama").removeAttr("disabled","disabled").css("background-color","");
	$("#txtnomesin").removeAttr("disabled","disabled").css("background-color","");
	$("#txtket").removeAttr("disabled","disabled").css("background-color","");
	$("#txttglbeli").removeAttr("disabled","disabled").css("background-color","");
}


function disableinput(){
	$("#txtkode").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtnama").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtnomesin").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtket").attr("disabled","disabled").css("background-color","#CCC");
	$("#txttglbeli").attr("disabled","disabled").css("background-color","#CCC");
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
function forinsert(){
	enableinput();
	clearinput();
	showbutton();
	
}
function clearinput(){	
	$("#txtnama").val("");
	$("#txtnomesin").val("");
	$("#txtket").val("");
	$("#txttglbeli").val("");
	
}
function alertdelete(kode){
		jConfirm('Are you sure you want to delete Supplier '+kode+'', 'Confirmation Dialog', 	
			function(r) {
			if(r==true)
			{
				window.location.href="http://localhost/wahana/index.php/listmesin/deletemesin/"+kode;
			}else{
				window.location.href="http://localhost/wahana/index.php/listmesin/index/";
			}
		});
	
}

function getmesin(idx,filter,val,offset,flag,kode){
	//alert(idx+"-"+filter+"-"+val+"-"+offset+"-"+flag+"-"+kode);
	window.location.href="http://localhost/wahana/index.php/listmesin/index/"+idx+"/"+filter+"/"+val+"/"+offset+"/"+flag+"/"+kode;
}

function startin(){
	disableinput();
	hidebutton();
}
	
$(document).ready(function(){

	var temprowid="";
	var rowcount=0;
	var woke=0;
	$("#butsearch").click(function(){
		var filter=$("#filterby").val();
		var valsearch=$("#valsearch").val();
		window.location.href="http://localhost/wahana/index.php/listmesin/index/1/"+filter+"/"+valsearch+"/0";
		
	});
	$("#btncancel").click(function(){
		window.location.href="http://localhost/wahana/index.php/listmesin/index/";
	});
	$("#btnnewmesin").click(function(){	
		window.location.href="http://localhost/wahana/index.php/listmesin/index/0/asd/0/0/2/";
	});
	
	
});

