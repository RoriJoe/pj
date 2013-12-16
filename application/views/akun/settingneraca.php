<!DOCTYPE html>
<html>

<head>
	<title>Setting Neraca - Pelita Jaya</title>

	<?php echo $this->load->view('template/head_import'); ?>
</head>

<body>

	<?php echo $this->load->view('template/head_jurnal'); ?>

	<div class="container" style="margin-bottom:20px;">
	    <div class="row">
	    	<div class="span5">
	    		<h4>List Neraca</h4>

	    		<div>
	    			<form id="FormSettingNer" >
						Cetak Sampai Level <?php echo form_dropdown('BatasCtk',array('2'=>'2','3'=>'3','4'=>'4'),$lvlctk,'id="BatasCtk"');?>

						<div  style=height:400px;overflow:auto;>
							<table id="tableemploy" class="table table-bordered">
							<thead>
								<tr>
									<th style=text-align:center><input type=checkbox id="checkall" /></th>
									<th style=text-align:center;min-width:230px >Perkiraan</th>
									<th>Type</th>
									<th style=text-align:center>From</th>
									<th style=text-align:center>To</th>
								</tr>
							 </thead>  
							 <tbody></tbody>
							</table>
						</div>
						
						<!--<div id="divpagging"></div>-->
						<div class="form-actions" style="text-align:right; padding-right: 20px;">
							<input type="button"  value="Reset" class="btn" id="reset" name="btncancel"/>
							<input type="button"  value="Cancel" class="btn" id="btncancel" name="btncancel"/>
							<input type="button"  value="Save" class="btn btn-primary" id="btnsave" name="btnsave"/>
						</div>
		            </form>
	    		</div>
	    	</div>

	    	<div class="span7">
	    		<h4>View Setting Neraca</h4>

	    		<div style=height:400px;overflow:auto; class="well">
	    			<table id="ViewJurnal" style="width:95%;">
						<thead>
							<tr>
								<th></th>
								<th width=80px style=text-align:right><b><u>This Year</u></b></th><th width=20px;></th>
								<th width=80px style=text-align:right><b><u>Last Year</u></b></th><th width=20px;></th>
								<th width=80px style=text-align:right><b><u>Variance</u></b></th>
							</tr>
						 </thead>  
						 <tbody></tbody>
					</table>
	    		</div>
	    	</div>
	    </div>

	    <div id="loadingDiv">
           <img src="<?php echo base_url();?>assets/img/ajax-loader.gif"/>
        </div>  
	</div>

	<?php echo $this->load->view('template/footer'); ?>

</body>

<script>
	$(document).ready(function(){
		var byser=$("#filterby").val();
		var valser="";
		var limit=8;

		$.ajax({
			type: "POST",	   
			url: "<?php echo base_url(); ?>akun/settingneraca/ViewJurnal",
			data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
			cache: false,
			success: function(msg){
				$("#ViewJurnal > tbody").html(msg);					
			}
		});
		
		$.ajax({
			type: "POST",	   
			url: "<?php echo base_url(); ?>akun/settingneraca/getlistdata",
			data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
			cache: false,
			success: function(msg){
				$("#tableemploy > tbody").html(msg);					
			}
		});

		$("#checkall:checkbox").click(function(){
			if($(this).attr("checked")){
				$('input:checkbox').attr('checked','checked');
				$('input:checkbox').removeAttr('disabled','disabled');
			}
			else{
				$('input:checkbox').removeAttr('checked');
				$('input:checkbox').attr('disabled','disabled');
				$('#checkall').removeAttr('disabled','disabled');
		   }
		});
		
		$("#BatasCtk").change(function(){
			$.ajax({
				type: "POST",	   
				url: "<?php echo base_url(); ?>akun/settingneraca/getlistdata",
				data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit+"&BatasCtk="+$(this).val(),
				cache: false,
				success: function(msg){
					$("#tableemploy > tbody").html(msg);							
				}
			});
		});	
	});

	$("#btncancel").click(function(){
		window.location.href="<?php echo base_url(); ?>akun/settingneraca/index/";
	});
	
	$("#reset").click(function(){
		$.ajax({
			type: "POST",	   
			url: "<?php echo base_url(); ?>akun/settingneraca/Reset",
			data: "byser="+byser+"&valser="+valser+"&offset="+0+"&limit="+limit,
			cache: false,
			success: function(msg){
					$("#tableemploy > tbody").html(msg);
					$("#ViewJurnal > tbody").html("");						
			}
		});	
	});
	
	$('#btnsave').live('click', function(){
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>akun/settingneraca/SaveSettingNer",
			data: $("#FormSettingNer").serialize(),
			success: function(msg) { //alert(msg);
				window.location.href="<?php echo base_url(); ?>akun/settingneraca/index/";
			}
		}) 		
	});

	//**Level dropdown change**//
	var Lvl2 = <?php echo json_encode($Lvl2); ?>;
	var Lvl3 = <?php echo json_encode($Lvl3); ?>;

	function Centang(val,lvl){ //alert(lvl);
		var Lvl1 = document.getElementById(val);
		var Ttl = document.getElementById("T"+val);
		if(Ttl){
		if(Lvl1.checked==false)
			Ttl.checked ="";
		else
			Ttl.checked ="checked";
		}
			
		if(lvl==1){
			for(var i=0; i < Lvl2.length; i++){ 
				if(Lvl2[i].charAt(0)==val){
					var check = document.getElementById(Lvl2[i]);
					var clvl2 = document.getElementById("T"+Lvl2[i]);
					if(clvl2){
						if(check.checked==true)
							clvl2.checked="";
						else
							clvl2.checked="checked";
					}
					if(check){
						if(Lvl1.checked==false){
							check.checked ="";
							check.disabled ="disabled";
						}
						else{
							check.checked ="checked";
							check.disabled ="";
						}
					}
				}
			}
			for(var i=0; i < Lvl3.length; i++){ 
				if(Lvl3[i].charAt(0)==val){
					var check = document.getElementById(Lvl3[i]);
					if(check){
						if(Lvl1.checked==false){
							check.checked ="";
							check.disabled ="disabled";
						}else{
							check.checked ="checked";
							check.disabled ="";
						}
					}
				}
				
			}
		}else if(lvl==2){
			for(var i=0; i < Lvl3.length; i++){
				 if(Lvl3[i].substr(0,3)==val){
					var check = document.getElementById(Lvl3[i]);
					if(check){
						if(check.checked==true){
							check.checked ="";
							check.disabled ="disabled";
						}else{
							check.checked ="checked";
							check.disabled ="";
						}
					}
				} 
			}
		}
	}
</script>


</html>













