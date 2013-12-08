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
	$("#txtkode").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtnama").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtrole").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtadd").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtemail").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtnpwp").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtbb").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtpassword").attr("disabled","disabled").css("background-color","#CCC");
	$("#txttelrum1").attr("disabled","disabled").css("background-color","#CCC");
	$("#txttelrum2").attr("disabled","disabled").css("background-color","#CCC");
	$("#txthand1").attr("disabled","disabled").css("background-color","#CCC");
	$("#txthand2").attr("disabled","disabled").css("background-color","#CCC");
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
	$("#txtcontact").val("");
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
function alertdelete(kode){
		jConfirm('Are you sure you want to delete Karyawan '+kode+'', 'Confirmation Dialog', 	
			function(r) {
			if(r==true)
			{
				window.location.href="http://localhost/wahana/index.php/listkaryawan/deletekar/"+kode;
			}else{
				window.location.href="http://localhost/wahana/index.php/listkaryawan/index/";
			}
		});
	
}

function getkaryawan(idx,filter,val,offset,flag,kode){
	//alert(idx+"-"+filter+"-"+val+"-"+offset+"-"+flag+"-"+kode);
	window.location.href="http://localhost/wahana/index.php/listkaryawan/index/"+idx+"/"+filter+"/"+val+"/"+offset+"/"+flag+"/"+kode;
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
		window.location.href="http://localhost/wahana/index.php/listkaryawan/index/1/"+filter+"/"+valsearch+"/0";
		
	});
	$("#btncancel").click(function(){
		window.location.href="http://localhost/wahana/index.php/listkaryawan/index/";
	});
	$("#btnnewkar").click(function(){	
		window.location.href="http://localhost/wahana/index.php/listkaryawan/index/0/asd/0/0/2/";
	});
	
	
});

