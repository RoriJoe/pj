<script>
//load Side Table
function loadListBarang(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_barang/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
    });
}

loadListBarang();
</script>

<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>

<!--//***MAIN FORM-->
<div class="bar bar2">
    <p>Form Barang <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border" style="width: 62%;">
<form id="formID">
    <table>
        <tr>
            <td>Kode</td>
            <td>
                <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" id='_kd' name='kd' style="width: 75px; margin-left: 10px; margin-right: 20px; text-transform: uppercase;">
            </td>
            <td>Nama</td>
            <td>
                <input type='text' class="validate[required,maxSize[25], minSize[2]]]" maxlength="25" id='_nama1' name='nama1' style="width: 170px;margin-left: 10px; margin-right: 20px;">
            </td>
        </tr>
        <tr>
            <td>Ukuran</td>
            <td>
                <input type='text' class="validate[required,maxSize[25], minSize[4]]" maxlength="25" id='_uk' name='uk' style="width: 170px;margin-left: 10px; margin-right: 20px;">
            </td>
            <td>Keterangan</td>
            <td>
                <input type='text' class="validate[required,maxSize[20]]" id='_ket' name='ket' style="width: 170px;margin-left: 10px; margin-right: 20px;">
            </td>
       </tr>
       <tr>
            <td>Persediaan</td>
            <td>
            	<div class="input-append">
                    <input class="span2 validate[required,custom[number]]" readonly="true" id='_ps' name='ps' style="width: 80px;margin-left: 10px; margin-right: 20px;" type="text" value="0">
                </div>
            </td>

            <td>Satuan</td>
            <td>
                <select name="st" class="validate[required]" id="_st" style="margin-left: 10px; margin-right: 20px;">
                    <?php
                    foreach ($list_satuan as $isi)
                    {
                        echo "<option ";
                        echo "value = '".$isi->Value."'>".$isi->Value."</option>";
                    }
                    ?>
                </select>
                <button type="button" id="tes" class="btn btn-mini" 
                        data-toggle="button"
                        data-html="true" data-placement="bottom"
                        rel="popover"
                        style="margin-bottom:3px;"
                        data-content="
                        <div>
                         <input  type='text' 
                            class='span2' id='txtCombo' id='appendedInput' name='txtCombo' 
                            style='width: 90px;margin-left: 10px;'
                            />
                        <button class='btn btn-primary btn-small' onclick='addCombo()'>Tambah</button>
                        </div>"><i class='icon-plus'></i></button>
            </td>
       </tr>

        <tr >
            <td colspan="4">
            <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
            <button id="cac" class="btn" type="reset">Cancel</button>
            <button id="print" class="btn"  data-toggle="tooltip" title="Print Penerimaan Barang"><i class="icon-print"></i></button>
            </td>
        </tr>
    </table>
</form>
</div>
<div id="hasil" style="z-index:10"></div>
<script>  
    $("#tes").popover({ title: 'Tambah Satuan'});
</script>  
<script>
$(document).ready(function() {
 /*
 * Load Common Function
 */
    autogen();
    validationEngine();
    animation();
    key();
});
/*----------------------*/
//Auto Generate
function autogen(){
    $("#_kd").attr('disabled',false);
    $('#save').attr('mode','add');
    $('button[type="submit"]').attr('disabled','disabled');
    
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_barang/auto_gen",
    data :{},
    success:
        function(hh){
            $('#_kd').val(hh);
        }
    });
}
function animation(){
    //Icon Animation
    jQuery(document).ready(function() {
    jQuery(".hide-con").hide();
    var i = document.getElementById('konten');
    jQuery(".bar").click(function()
    {
        jQuery(this).next(".hide-con").slideToggle(500, function(){
            // Animation complete.
            if(i.style.display=="none"){
                document.getElementById('icon').className='icon-chevron-down icon-white';
            }else{
                document.getElementById('icon').className='icon-chevron-up icon-white';
            }
        });
    });
    });
}
//Form Validation
function validationEngine(){
    jQuery("#formID").validationEngine(
    {
        showOneMessage: true,
        ajaxFormValidation: true,
        ajaxFormValidationMethod: 'post',
        autoHidePrompt: true,
        autoHideDelay: 2500, 
        fadeDuration: 0.3
    });
}

/*
 * Click Respon
 */
$("#cac").click(function(){
   autogen();
   $('#formID').each(function(){
		this.reset();
	});
    autogen();
});

function key(){
    $('button[type="submit"]').attr('disabled','disabled');
     $('input[type="text"]').keyup(function() {
        if($(this).val() != '') {
           $('button[type="submit"]').removeAttr('disabled');
        }else{
            $('button[type="submit"]').attr('disabled','disabled');
        }
     });
}

$("#_kd").keypress(function(e){
   var userVal = $("#_kd").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Kode 20');
   } 
});
$("#_nama1").keypress(function(e){
   var userVal = $("#_nama1").val();
   if(userVal.length == 25){
       bootstrap_alert.info('Maksimum Nama 25 Karakter');
   } 
});
$("#_uk").keypress(function(e){
   var userVal = $("#_uk").val();
   if(userVal.length == 25){
       bootstrap_alert.info('Maksimum Ukuran 25 Karakter');
   } 
});

//buat print
$("#print").click(function(){
$.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/report/print_master_barang",
        data :{   
        },

        success:
        function(msg)
        {   
            var win=window.open('');
            with(win.document)
            {
              open();
              write(msg);
              close();
            }
            win.print();
        }
     });
});

$("#save").click(function(){
	var mode = $('#save').attr("mode");
	
	if(mode == "add"){ //MODE ADD NEW ITEM
		//DECLARE VARIABLE
		var _kd = $('#_kd').val();
		var _nama1 = $('#_nama1').val();
		var _ket = $('#_ket').val();
		var _uk = $('#_uk').val();
		var _ps = $('#_ps').val();
		var _st = $('#_st').val();
		
		if($("#formID").validationEngine('validate'))
		{
			$.ajax({
			type:'POST',
			url: "<?php echo base_url();?>index.php/ms_barang/insert", //SEND TO CONTROLLER
			data :{_kd:_kd,_nama1:_nama1,_ket:_ket,_uk:_uk,_ps:_ps,_st:_st},

			success:
			function(msg)
			{
				if(msg == "ok")
				{
					bootstrap_alert.success('<b>Sukses</b> Data sudah ditambahkan');
					$('#formID').each(function(){
						this.reset();
					});
    					$.ajax({
        					type:'POST',
        					url: "<?php echo base_url();?>index.php/ms_barang/index",  //REFRESH TABLE DETAIL WITH CONTROLLER
        					data :{},
        					success:
        					function(hh){
                                $('#hasil').html(hh);
        					}
    					});
					autogen();
					$('#save').attr('mode','add');
				}
				else{
					bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data sudah ada');
				}
			}
			});
		}
		return false;
	}
	else //MODE UPDATE ITEM
	{
        var _kd = $('#_kd').val();
        var _nama1 = $('#_nama1').val();
        var _ket = $('#_ket').val();
        var _uk = $('#_uk').val();
        var _ps = $('#_ps').val();
        var _st = $('#_st').val();
	    
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_barang/update",
            data :{_kd:_kd,_nama1:_nama1,_ket:_ket,_uk:_uk,_ps:_ps,_st:_st},
            success:
            function(msg){
                if(msg=="ok")
                {
                        bootstrap_alert.success('<b>Sukses</b> Update berhasil dilakukan');
                        $('#formID').each(function(){
                                this.reset();
                        });
                        $.ajax({
                        type:'POST',
                        url: "<?php echo base_url();?>index.php/ms_barang/index",
                        data :{},
                        success:
                        function(hh){
                                $('#hasil').html(hh);
                        }
                        });
                        autogen();
                        $('#save').attr('mode','add');
                }
                else
                {
                        bootstrap_alert.warning('<b>Gagal Menambahkan</b> Terjadi Kesalahan');
                }
                }
            });
        }
        return false;
	}
});
	
function addCombo() {
    var textb = document.getElementById("txtCombo");
    var combo = document.getElementById("_st");

    var option = document.createElement("option");
    option.text = textb.value;
    option.value = textb.value;
    try {
        combo.add(option, null); //Standard
    }catch(error) {
        combo.add(option); // IE only
    }

	var _sat = $('#txtCombo').val();
	if(_sat !="")
	{
		$.ajax({
		type:'POST',
		url: "<?php echo base_url();?>index.php/ms_barang/add_satuan", //SEND TO CONTROLLER
		data :{_sat:_sat},

		success:
		function(msg) //GET MESSEGE FROM INSERT MODEL
		{
			if(msg == "ok")
			{
				textb.value = "";
				bootstrap_alert.success('<b>Sukses!</b> Satuan sudah ditambahkan');
			}
			else{
				bootstrap_alert.warning('<b>Gagal!</b> Satuan sudah ada');
			}
		}
		});
	}else{
        bootstrap_alert.warning('<b>Kesalahan!</b> Field Tidak Boleh Kosong');
    }
}

bootstrap_alert = function() {}
bootstrap_alert.warning = function(message) {
	$('#konfirmasi').html('<div class="alert alert-error" style="position:absolute; width:52%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
	$(".alert").delay(1500).addClass("in").fadeOut(5000);
}
bootstrap_alert.success = function(message) {
	$('#konfirmasi').html('<div class="alert alert-success" style="position:absolute; width:52%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
	$(".alert").delay(1500).addClass("in").fadeOut(5000);
}
bootstrap_alert.info = function(message) {
    $('#konfirmasi').html('<div class="alert alert-info" style="position:absolute; width:52%;"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}

</script>
