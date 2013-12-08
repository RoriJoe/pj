// JavaScript Document

/*function setcurDate()
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
	var day="";
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
	
	if(d.getDate()<10)
	{	
		day="0"+d.getDate();
	}
	else
	{
		day=d.getDate();
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
	
	var x= document.getElementById("curdate").innerHTML=weekday[d.getDay()]+", "+day+"-"+month+"-"+d.getFullYear()+" "+hour+":"+minute+":"+second;
	setTimeout("setcurDate()", 1000) 
}*/
function sentid(kode,offset){
	window.location.href="http://localhost/wahana/index.php/listemploy/index/"+offset+"/kode/asc/"+kode;
}

function sentid1(kode,offset){
	window.location.href="http://localhost/wahana/index.php/listemploy/getupdate/"+offset+"/kode/asc/"+kode;
}

function deleteconf(kode,offset){
	var ans=confirm("Are You sure to Delete "+kode+" ?");
	if(ans==true){
		window.location.href="http://localhost/wahana/index.php/listemploy/deleteemploy/0/kode/asc/"+kode;
	}
}

function getprofile(s,d){
	//document.getElementById('underlay').style.display='block';
	//document.getElementById('lightbox').style.display='block';
	//var x=document.getElementById('ecode').innerHTML="asds";
	var code=s;
	window.location.href="http://localhost/wahana/index.php/listemploy/getprofile/"+s+"/"+d;
	
	
}

function test(){
	alert("as");
	//document.getElementById('underlay').style.display='none';
	//document.getElementById('lightbox').style.display='none';
}

/*function updateemploy(kode,offset){
	window.location.href="http://localhost/wahana/index.php/listemploy/index/"+offset+"/kode/asc/"+kode;
}*/

function disabletxt(){
	$("#txtkode").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtnama").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtpass").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtadd").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtemail").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtnpwp").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtdepart").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtbb").attr("disabled","disabled").css("background-color","#CCC");
	$("#txttelkan1").attr("disabled","disabled").css("background-color","#CCC");
	$("#txttelkan2").attr("disabled","disabled").css("background-color","#CCC");
	$("#txttelrum1").attr("disabled","disabled").css("background-color","#CCC");
	$("#txttelrum2").attr("disabled","disabled").css("background-color","#CCC");
	$("#txthand1").attr("disabled","disabled").css("background-color","#CCC");
	$("#txthand2").attr("disabled","disabled").css("background-color","#CCC");
	$("#txttelkan2").attr("disabled","disabled").css("background-color","#CCC");
	$("#flagaction").val("0");
	$("#btnsave").hide();
	$("#btncancel").hide();
}

function enabletext(){
	$("#txtkode").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtnama").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txtpass").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txtadd").removeAttr("disabled","disabled").css("background-color","").text("");
	$("#txtemail").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txtnpwp").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txtdepart").removeAttr("disabled","disabled").css("background-color","").val("none");
	$("#txtbb").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txttelkan1").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txttelkan2").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txttelrum1").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txttelrum2").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txthand1").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txthand2").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#txttelkan2").removeAttr("disabled","disabled").css("background-color","").val("");
	$("#flagaction").val("1");
}

function enabletext1(){
	$("#txtkode").attr("disabled","disabled").css("background-color","#CCC");
	$("#txtnama").removeAttr("disabled","disabled").css("background-color","");
	$("#txtpass").removeAttr("disabled","disabled").css("background-color","");
	$("#txtadd").removeAttr("disabled","disabled").css("background-color","");
	$("#txtemail").removeAttr("disabled","disabled").css("background-color","");
	$("#txtnpwp").removeAttr("disabled","disabled").css("background-color","");
	$("#txtdepart").removeAttr("disabled","disabled").css("background-color","");
	$("#txtbb").removeAttr("disabled","disabled").css("background-color","");
	$("#txttelkan1").removeAttr("disabled","disabled").css("background-color","");
	$("#txttelkan2").removeAttr("disabled","disabled").css("background-color","");
	$("#txttelrum1").removeAttr("disabled","disabled").css("background-color","");
	$("#txttelrum2").removeAttr("disabled","disabled").css("background-color","");
	$("#txthand1").removeAttr("disabled","disabled").css("background-color","");
	$("#txthand2").removeAttr("disabled","disabled").css("background-color","");
	$("#txttelkan2").removeAttr("disabled","disabled").css("background-color","");
	$("#flagaction").val("2");
}

function ambilid(kode){
	//alert(kode);
}

$(document).ready(function(){
						   
	var txtkode=$("#txtkode").val();
	var txtnama=$("#txtnama").val();
	var txtemail=$("#txtemail").val();
	var txtpass=$("#txtpass").val();
	var txtadd=$("#txtadd").text();
	var txtnpwp=$("#txtnpwp").val();
	var txtdepart=$("#txtdepart").val();
	var txtbb=$("#txtbb").val();
	var txttelkan1=$("#txttelkan1").val();
	var txttelkan2=$("#txttelkan2").val();
	var txttelrum1=$("#txttelrum1").val();
	var txttelrum2=$("#txttelrum2").val();
	var txthand1=$("#txthand1").val();
	var txthand2=$("#txthand2").val();
	
	
	
	
	var cont=0;
	$("#thkode").click(function(){
			
		 cont+=1;
		 var x = $("#txtoff1").val();
	
		 if(cont%2==0){
			 
			  window.location.href="http://localhost/wahana/index.php/listemploy/index/"+x+"/kode/asc";
		 }else{
			  cont+=1;
			 window.location.href="http://localhost/wahana/index.php/listemploy/index/"+x+"/kode/desc";
		 }
		
	});
	$(".linkupdate").click(function(){
								
		$("#txtnama").removeAttr("disabled","disabled").css("background-color","");
		$("#txtpass").removeAttr("disabled","disabled").css("background-color","");
		$("#txtadd").removeAttr("disabled","disabled").css("background-color","");
		$("#txtemail").removeAttr("disabled","disabled").css("background-color","");
		$("#txtnpwp").removeAttr("disabled","disabled").css("background-color","");
		$("#txtdepart").removeAttr("disabled","disabled").css("background-color","");
		$("#txtbb").removeAttr("disabled","disabled").css("background-color","");
		$("#txttelkan1").removeAttr("disabled","disabled").css("background-color","");
		$("#txttelkan2").removeAttr("disabled","disabled").css("background-color","");
		$("#txttelrum1").removeAttr("disabled","disabled").css("background-color","");
		$("#txttelrum2").removeAttr("disabled","disabled").css("background-color","");
		$("#txthand1").removeAttr("disabled","disabled").css("background-color","");
		$("#txthand2").removeAttr("disabled","disabled").css("background-color","");
		$("#txttelkan2").removeAttr("disabled","disabled").css("background-color","");
		$("#flagaction").val("2");
		$("#btnsave").show();
		$("#btncancel").show();
	});
	$("#btncancel").click(function(){
		 if($("#flagaction").val()==1){
			 window.location.href="http://localhost/wahana/index.php/listemploy/index/0/kode/asc";

		 }else{
			$("#txtkode").attr("disabled","disabled").css("background-color","#CCC").val(txtkode);
			$("#txtnama").attr("disabled","disabled").css("background-color","#CCC").val(txtnama);
			$("#txtpass").attr("disabled","disabled").css("background-color","#CCC").val(txtpass);
			$("#txtadd").attr("disabled","disabled").css("background-color","#CCC").text(txtadd);
			$("#txtemail").attr("disabled","disabled").css("background-color","#CCC").val(txtemail);
			$("#txtnpwp").attr("disabled","disabled").css("background-color","#CCC").val(txtnpwp);
			$("#txtdepart").attr("disabled","disabled").css("background-color","#CCC").val(txtdepart);
			$("#txtbb").attr("disabled","disabled").css("background-color","#CCC").val(txtbb);
			$("#txttelkan1").attr("disabled","disabled").css("background-color","#CCC").val(txttelkan1);
			$("#txttelkan2").attr("disabled","disabled").css("background-color","#CCC").val(txttelkan2);
			$("#txttelrum1").attr("disabled","disabled").css("background-color","#CCC").val(txttelrum1);
			$("#txttelrum2").attr("disabled","disabled").css("background-color","#CCC").val(txttelrum2);
			$("#txthand1").attr("disabled","disabled").css("background-color","#CCC").val(txthand1);
			$("#txthand2").attr("disabled","disabled").css("background-color","#CCC").val(txthand2);
			$("#txttelkan2").attr("disabled","disabled").css("background-color","#CCC").val(txttelkan2);
			$("#flagaction").val("0");
			$("#btnsave").hide();
			$("#btncancel").hide();
		 }
	});
	
	$("#btnaddnew").click(function(){		
		enabletext();
		$("#flagaction").val("2");
		$("#btnsave").show();
		$("#btncancel").show();
	});
	$("#btnsave").click(function(){		
		if($("#txtkode").val()==""){
			$("#txterror").text("Kode Harus diisi");
		}else if($("#txtnama").val()==""){
			$("#txterror").text("Nama Harus diisi");
		}else if($("#txtpass").val()==""){
			$("#txterror").text("Password Harus diisi");
		}else if($("#txtadd").val()==""){
			$("#txterror").text("Address Harus diisi");
		}else if($("#txtemail").val()==""){
			$("#txterror").text("Email Harus diisi");
		}else if($("#txtnpwp").val()==""){
			$("#txterror").text("NPWP Harus diisi");
		}else if($("#txtdepart").val()==""){
			$("#txterror").text("Department harus dipilih");
		}else if($("#txtbb").val()==""){
			$("#txterror").text("Pin BB Harus diisi");
		}else{
			if($("#flagaction").val()==1){
				window.location.href="http://localhost/wahana/index.php/listemploy/saveinsert/"+$("#txtkode").val()+"/"+$("#txtnama").val()+"/"+$("#txtadd").val()+"/"+$("#txttelkan1").val()+"/"+$("#txttelkan1").val()+"/"+$("#txttelrum1").val()+"/"+$("#txttelrum2").val()+"/"+$("#txthand1").val()+"/"+$("#txthand2").val()+"/"+$("#txtbb").val()+"/"+$("#txtemail").val()+"/"+$("#txtdepart").val()+"/"+$("#txtnpwp").val()+"/"+$("#txtpass").val()+"/Active";
			}else{
				window.location.href="http://localhost/wahana/index.php/listemploy/saveupdate/"+$("#txtkode").val()+"/"+$("#txtnama").val()+"/"+$("#txtadd").val()+"/"+$("#txttelkan1").val()+"/"+$("#txttelkan1").val()+"/"+$("#txttelrum1").val()+"/"+$("#txttelrum2").val()+"/"+$("#txthand1").val()+"/"+$("#txthand2").val()+"/"+$("#txtbb").val()+"/"+$("#txtemail").val()+"/"+$("#txtdepart").val()+"/"+$("#txtnpwp").val()+"/"+$("#txtpass").val()+"/Active";
			}	
		}
		
		
		
	});


	
	
	//$("#txtkode").css("background-color","#CCC");				   

	/*$("#btsave").hide();
	$("#btreset").hide();
	$("#employcode").attr("readonly","readonly");
	$("#fullname").attr("readonly","readonly");
	$("#password").attr("readonly","readonly");
	$("#address").attr("readonly","readonly");
	$("#phone").attr("readonly","readonly");
	$("#email").attr("readonly","readonly");
	$("#gendermale").attr({"background-color":"#CCC","disabled":"disabled"});
	$("#genderfemale").attr({"background-color":"#CCC","disabled":"disabled"});
	$("#departement").attr("readonly","readonly");
	$("#statusact").attr({"background-color":"#CCC","disabled":"disabled"});
	$("#statucinac").attr({"background-color":"#CCC","disabled":"disabled"});
	
	$("#employcode").css("background-color","#CCC");
	$("#fullname").css("background-color","#CCC");
	$("#password").css("background-color","#CCC");
	$("#address").css("background-color","#CCC");
	$("#phone").css("background-color","#CCC");
	$("#email").css("background-color","#CCC");
	$("#gendermale").css("background-color","#CCC");
	$("#genderfemale").css("background-color","#CCC");
	$("#departement").css("background-color","#CCC");
	$("#statusact").css("background-color","#CCC");
	$("#statucinac").css("background-color","#CCC");
	
	$("#btupdate").click(function(){
		$("#btsave").show();
		$("#btreset").show();
		$("#btupdate").hide();
		$("#btback").hide();
		$("#fullname").removeAttr("readonly");
		$("#password").removeAttr("readonly");
		$("#address").removeAttr("readonly");
		$("#phone").removeAttr("readonly");
		$("#email").removeAttr("readonly");
		$("#gendermale").removeAttr("readonly").removeAttr("disabled");
		$("#genderfemale").removeAttr("readonly").removeAttr("disabled");
		$("#departement").removeAttr("readonly");
		$("#statusact").removeAttr("readonly").removeAttr("disabled");
		$("#statucinac").removeAttr("readonly").removeAttr("disabled");
	
		$("#fullname").css("background-color","");
		$("#password").css("background-color","");
		$("#address").css("background-color","");
		$("#phone").css("background-color","");
		$("#email").css("background-color","");
		$("#gendermale").css("background-color","");
		$("#genderfemale").css("background-color","");
		$("#departement").css("background-color","");
		$("#statusact").css("background-color","");
		$("#statucinac").css("background-color","");*/
		
	//});
});

