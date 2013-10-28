<form id="formSupplier" style="margin-left: 15px;">
    <table>
        <tr>
            <td>Kode</td>
            <td>
                <input type='text' class="span-form75 upper-form validate[required,maxSize[20], minSize[3]],custom[onlyLetterNumber]" maxlength="20" id='kd' name='kd'>
            </td>
            <td>Perusahaan</td>
            <td>
                <input type='text' class="span-form170 validate[required,maxSize[50], minSize[2]]]" maxlength="50" id='pr' name='pr'>
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>
                <input type='text' class="span-form170 validate[required, maxSize[30], minSize[3]],custom[onlyLetterSp]]" maxlength="30" id='nm' name='nm'>
            </td>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required, maxSize[30], minSize[3]]]" maxlength="30" id='al' name='al' style="resize:none; width:170px; height: 60px; margin-left: 10px;"></textarea>
            </td>
        </tr>
        <tr>
            <td>Limit Kredit</td>
            <td>
                <div class="input-prepend input-append" style="margin-bottom: 0; margin-left: 10px;">
                  <span class="add-on" style="margin: 0; padding: 2px;">Rp</span>
                  <input class="span2" id='lk' id="appendedPrependedInput" type='text' class="validate[required]" maxlength="15" name='lk' style="width: 145px;text-align:right;" onkeyup="formatAngka(this,'.')" >
                </div>
            </td>
            <td>Kota</td>
            <td>
                <input type='text' class="validate[required, maxSize[15], minSize[3]],custom[onlyLetterSp]]" maxlength="15" id='kt' name='kt' style="width: 80px; margin-left: 10px;" onclick="disableNum('kt')">
            </td>
        </tr>
        <tr>
            <td>Telp</td>
            <td colspan="3">
                <input type='text' placeholder="Telp 1" class="telp validate[required, maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='tl1' name='tl1' onclick="disableAlpha('tl1')">
                <input type='text' placeholder="Telp 2" class="telp validate[maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='tl2' name='tl2' value="" onclick="disableAlpha('tl2')">
                <input type='text' placeholder="Telp 3" class="telp validate[maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='tl3' name='tl3' value="" onclick="disableAlpha('tl3')">
            </td>
        </tr>
        <tr>
            <td>Fax</td>
            <td colspan="3">
                <input type='text' placeholder="Fax 1" class="telp validate[required, maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='fx1' name='fx1' onclick="disableAlpha('fx1')">
                <input type='text' placeholder="Fax 2" class="telp validate[maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='fx2' name='fx2' value="" onclick="disableAlpha('fx2')">
            </td>
        </tr>
        <tr >
            <td colspan="4">
            	<div id="konfirmasi2" class="sukses"></div>
                <br />
                <button id="saveSupplier" class="btn btn-primary" mode="add">Save</button>
                <button id="cacSupplier" class="btn" type="reset">Cancel</button>
            </td>
        </tr>
    </table>
</form>

<script type="text/javascript">
$(document).ready(function() {
    autogenSupplier();
    validationSupplier();
});

//Auto Generate
function autogenSupplier(){
    $("#kd").attr('disabled',false);
    $('#save').attr('mode','add');
    $('button[type="submit"]').attr('disabled','disabled');
    
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_supplier/auto_gen",
    data :{},
    success:
        function(hh){
            $('#kd').val(hh);
        }
    });
}

function validationSupplier(){
jQuery("#formPelanggan").validationEngine(
{
    showOneMessage: true,
    ajaxFormValidation: true,
    ajaxFormValidationMethod: 'post',
    autoHidePrompt: true,
    autoHideDelay: 2500, 
    fadeDuration: 0.3,
    promptPosition : "bottomLeft", scroll: false
    });
}


$("#cacSupplier").click(function(){
    $('#modalNewSupplier').modal('hide');
});

$("#kd").keypress(function(e){
   var userVal = $("#kd").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Kode 20');
   } 
});

$("#pr").keypress(function(e){
   var userVal = $("#pr").val();
   if(userVal.length == 50){
       bootstrap_alert.info('Maksimum Karakter 50');
   } 
});

$("#nm").keypress(function(e){
   var userVal = $("#nm").val();
   if(userVal.length == 30){
       bootstrap_alert.info('Maksimum Karakter 30');
   } 
});
$("#kt").keypress(function(e){
   var userVal = $("#kt").val();
   if(userVal.length == 15){
       bootstrap_alert.info('Maksimum Karakter 15');
   } 
});

function retext(){  
    var txtVal = $('#pr').val();
    var strVal = txtVal.substr(0, 2);
    var x = txtVal.length;
    var mainVal = txtVal.substr(3, x);
    var fixVal;
    if(strVal == "PT" || strVal == "CV" || strVal == "PD"){
        fixVal = mainVal+" "+strVal+".";
        $('#pr').val(fixVal);
    }
}

$("#saveSupplier").click(function(){
    retext();

    var mode = $('#saveSupplier').attr("mode");
   
    //DECLARE VARIABLE
    var kd = $('#kd').val();
    var pr = $('#pr').val();
    var nm = $('#nm').val();
    var al = $('#al').val();
    var kt = $('#kt').val();
    var tl1 = $('#tl1').val();
    var tl2 = $('#tl2').val();
    var tl3 = $('#tl3').val();
    var fx1 = $('#fx1').val();
    var fx2 = $('#fx2').val();
    var lk =  $('#lk').val().replace(/\./g, "");
    
    if(mode == "add"){
        if($("#formSupplier").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_supplier/insert", //SEND TO CONTROLLER
            data :{kd:kd,pr:pr,nm:nm,al:al,kt:kt,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,lk:lk},

            success:
            function(msg) //GET MESSEGE FROM INSERT MODEL
            {
                if(msg == "ok")
                {
                	$('#sup').val(pr);
    				$('#kd_sup').val(kd);
                    bootstrap_alert.success('Data <b>'+kd+' - '+pr+'</b> berhasil ditambahkan');
                    $('#formSupplier').each(function(){
                        this.reset();
                    });
                    $('#modalNewSupplier').modal('hide');
                }
                else{
                    bootstrap_alert.warning2('<b>Gagal Menambahkan</b> Data sudah ada');
                }
            }
            });
        }
        return false;
    }
});

</script>