<script>
//Auto Generate
function autogen(){
    $("#kd").attr('disabled',false);
    
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

//Form Validation
jQuery(document).ready(function() {
    jQuery("#formID").validationEngine(
    {
        showOneMessage: true,
        ajaxFormValidation: true,
        ajaxFormValidationMethod: 'post',
        autoHidePrompt: true,
        autoHideDelay: 2500, 
        fadeDuration: 0.3
    });
});

$.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_supplier/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
});

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

autogen();

</script>
<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>

<!--//***MAIN FORM-->
<div class="bar bar2">
    <p>Form Supplier <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border" style="width: 62%;">
<form id="formID" style="margin-left: 15px;">
    <table>
        <tr>
            <td>Kode</td>
            <td>
                <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" id='kd' name='kd' style="width: 75px; margin-left: 10px; margin-right: 20px;">
            </td>
            <td>Perusahaan</td>
            <td>
                <input type='text' class="validate[required]" id='pr' name='pr' style="width: 170px; margin-left: 10px; margin-right: 20px;">
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>
                <input type='text' class="validate[required, maxSize[20], minSize[3]],custom[onlyLetterSp]]" maxlength="20" id='nm' name='nm' style="width: 170px; margin-left: 10px; margin-right: 20px;">
            </td>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required]" id='al' name='al' style="resize:none; width:218px; height: 60px; margin-left: 10px;"></textarea>
            </td>
        </tr>
        <tr>
            <td>Limit Kredit</td>
            <td>
                <input type='text' class="validate[required]" id='lk' name='lk' style="width: 170px; margin-left: 10px; margin-right: 20px;">
            </td>
            <td>Kota</td>
            <td>
                <input type='text' class="validate[required, maxSize[15], minSize[3]],custom[onlyLetterSp]]" maxlength="15" id='kt' name='kt' style="width: 80px; margin-left: 10px;">
            </td>
        </tr>
        <tr>
            <td>Telp</td>
            <td colspan="3">
                <input type='text' placeholder="Telp 1" class="validate[required, maxSize[13], minSize[5]],custom[phone]]" id='tl1' name='tl1' style="width: 150px;margin-left: 10px">
                <input type='text' placeholder="Telp 2" class="validate[maxSize[13], minSize[5]],custom[phone]]" id='tl2' name='tl2' value="" style="width: 150px; margin-left: 10px">
                <input type='text' placeholder="Telp 3" class="validate[maxSize[13], minSize[5]],custom[phone]]" id='tl3' name='tl3' value="" style="width: 150px; margin-left: 10px">
            </td>
        </tr>
        <tr>
            <td>Fax</td>
            <td colspan="3">
                <input type='text' placeholder="Fax 1" class="validate[required, maxSize[13], minSize[5]],custom[phone]]" id='fx1' name='fx1' style="width: 150px; margin-left: 10px">
                <input type='text' placeholder="Fax 2" class="validate[maxSize[13], minSize[5]],custom[phone]]" id='fx2' name='fx2' value="" style="width: 150px; margin-left: 10px">
            </td>
        </tr>
        <tr >
            <td colspan="4">
                <br />
                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <button id="cac" class="btn" type="reset">Cancel</button>
            </td>
        </tr>
    </table>
</form>
</div>
<!--//***END ADD NEW AREA-->

<script>
$("#cac").click(function(){
    autogen();
    $('#formID').each(function(){
        this.reset();
    });
    $('#save').attr('mode','add');
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

$("#save").click(function(){
    retext();
    
    var mode = $('#save').attr("mode");
    
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
    var lk = $('#lk').val();
    
    if(mode == "add"){
        if($("#formID").validationEngine('validate'))
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
                bootstrap_alert.success('<b>Sukses</b> Data sudah ditambahkan');
                $('#formID').each(function(){
                    this.reset();
                });
                $.ajax({
                type:'POST',
                url: "<?php echo base_url();?>index.php/ms_supplier/index",  //REFRESH TABLE DETAIL WITH CONTROLLER
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
    }else
    {
        if($("#formID").validationEngine('validate'))    
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_supplier/update",
            data :{kd:kd,pr:pr,nm:nm,al:al,kt:kt,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,lk:lk},
            success: 
            function(msg){                
                if(msg=="ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Data Berhasil Diperbarui');
                    $('#formID').each(function(){
                        this.reset();
                    });                  
                    $.ajax({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/ms_supplier/index",
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
                    bootstrap_alert.warning('<b>Gagal Edit</b> Terjadi Kesalahan');
                }  
            }
            });    
        } 
        return false;
    }
});

bootstrap_alert = function() {}
bootstrap_alert.warning = function(message) {
    $('#konfirmasi').html('<div class="alert alert-error" style="position:absolute; width:52%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}
bootstrap_alert.success = function(message) {
    $('#konfirmasi').html('<div class="alert alert-success" style="position:absolute; width:52%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}

$("#kd").keypress(function(e){
   var userVal = $("#kd").val();
   if(userVal.length == 20){
       alert("Maximum Kode 20 Karakter");
   } 
});
</script>
<div id="hasil"></div>
