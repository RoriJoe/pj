<script>
//Side Table
$.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_pelanggan/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
});
</script>

<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>

<!--//***MAIN FORM-->
<div class="bar bar2">
    <p>Form Pelanggan <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border" style="width: 62%;">
<form id="formID">
    <table>
        <tr>
            <td>Kode</td>
            <td>
                <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]]" maxlength="20" id='kd' name='kd' style="width: 75px; margin-left: 10px; margin-right: 20px; text-transform: uppercase;">
            </td>
            <td>Perusahaan</td>
            <td>
                <input type='text' class="validate[required,maxSize[30], minSize[2]]]" maxlength="30" id='pr' name='pr' style="width: 170px; margin-left: 10px; margin-right: 20px; ">
            </td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td>
                <input type='text' class="validate[required, maxSize[20], minSize[3]],custom[onlyLetterSp]]" maxlength="20" id='cp' name='cp' style="width: 170px; margin-left: 10px; margin-right: 20px;" onclick="disableNum('cp')">
            </td>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required]" id='al' name='al' style="resize:none; width:218px; height: 60px; margin-left: 10px;"></textarea>
            </td>
        </tr>
        <tr>
            <td>NPWP</td>
            <td>
                <input type='text' class="validate[required]" id='np' name='np' style="width: 170px; margin-left: 10px; margin-right: 20px;" onclick="disableAlpha('np')">
            </td>
            <td>Kota</td>
            <td>
                <input type='text' class="validate[required, maxSize[15], minSize[3]],custom[onlyLetterSp]]" maxlength="15" id='kt' name='kt' style="width: 80px; margin-left: 10px;">
                &nbsp; 
                Kode Pos
                <input type='text' class="validate[required, maxSize[5], minSize[5]],custom[onlyNumberSp]]" maxlength="5" id='kp' name='kp' style="width: 50px;" onclick="disableAlpha('kp')">
            </td>
        </tr>
       <tr>
            <td>Telp</td>
            <td colspan="3">
                <input type='text' placeholder="Telp 1" class="validate[required, maxSize[13],minSize[5]],custom[phone]]" maxlength="13" id='tl1' name='tl1' style="width: 150px;margin-left: 10px" onclick="disableAlpha('tl1')">
                <input type='text' placeholder="Telp 2" class="validate[maxSize[13],minSize[5]],custom[phone]]" id='tl2' maxlength="13" name='tl2' value="" style="width: 150px; margin-left: 10px" onclick="disableAlpha('tl2')">
                <input type='text' placeholder="Telp 3" class="validate[maxSize[13],minSize[5]],custom[phone]]" id='tl3' maxlength="13" name='tl3' value="" style="width: 150px; margin-left: 10px" onclick="disableAlpha('tl3')">
            </td>
       </tr>
       <tr>
            <td>Fax</td>
            <td colspan="3">
                <input type='text' placeholder="Fax 1" class="validate[required, maxSize[13], minSize[5]],custom[phone]]" maxlength="13" id='fx1' name='fx1' style="width: 150px; margin-left: 10px" onclick="disableAlpha('fx1')">
                <input type='text' placeholder="Fax 2" class="validate[maxSize[13], minSize[5]],custom[phone]]" id='fx2' maxlength="13" name='fx2' value="" style="width: 150px; margin-left: 10px" onclick="disableAlpha('fx2')">
            </td>
       </tr>
        <tr >
            <td colspan="4">
                <br/>
                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <button id="cac" class="btn" type="reset">Cancel</button>
                <button id="print" class="btn" onclick="alert('Fungsi Print masih dalam pengembangan :D')" data-toggle="tooltip" title="Print Penerimaan Barang"><i class="icon-print"></i></button>
            </td>
        </tr>
    </table>
</form>
</div>
<!--//***END MAIN FROM-->

<div id="hasil" style="z-index:10"></div>

<script type="text/javascript">
/*
 * SCRIPT DIBAWAH BIAR LEBIH CEPAT LOAD PAGE
 */
$(document).ready(function() {
    autogen();
    barAnimation();
    validation();
    key();
});

function barAnimation(){
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

function validation(){
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
    
function autogen(){
    $("#kd").attr('disabled',true);
    $('#save').attr('mode','add');
    $('button[type="submit"]').attr('disabled','disabled');
    
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_pelanggan/auto_gen",
    data :{},
    success:
        function(hh){
            $('#kd').val(hh);
        }
    });
}

function key(){
 $('button[type="submit"]').attr('disabled','disabled');
 $('input[type="text"]').keyup(function() {
    if($(this).val() != '') {
       $('button[type="submit"]').removeAttr('disabled');
    }
 });
 $("#al").keyup(function() {
    if($(this).val() != '') {
       $('button[type="submit"]').removeAttr('disabled');
    }
 });
}
</script>


<script type="text/javascript">
$("#kd").keypress(function(e){
   var userVal = $("#kd").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Kode 20');
   } 
});
$("#pr").keypress(function(e){
   var userVal = $("#pr").val();
   if(userVal.length == 30){
       bootstrap_alert.info('Maksimum Karakter 30');
   } 
});
$("#cp").keypress(function(e){
   var userVal = $("#cp").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Karakter 20');
   } 
});

function disableAlpha($id){
    var foo = document.getElementById($id);
    foo.addEventListener('input', function (prev) {
    return function (evt) {
        if (!/^[0-9\.\+\ ]*$/.test(this.value)) {
          this.value = prev;
        }
        else {
          prev = this.value;
        }
    };
    }(foo.value), false);
};
function disableNum($id){
    var foo = document.getElementById($id);
    foo.addEventListener('input', function (prev) {
    return function (evt) {
        if (!/^[A-Za-z ]*$/.test(this.value)) {
          this.value = prev;
        }
        else {
          prev = this.value;
        }
    };
    }(foo.value), false);
};

$("#cac").click(function(){
   autogen();
   $('#formID').each(function(){
        this.reset();
    });
    autogen();
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
    var cp = $('#cp').val();
    var al = $('#al').val();
    var kt = $('#kt').val();
    var kp = $('#kp').val();
    var tl1 = $('#tl1').val();
    var tl2 = $('#tl2').val();
    var tl3 = $('#tl3').val();
    var fx1 = $('#fx1').val();
    var fx2 = $('#fx2').val();
    var np = $('#np').val();
    
    if(mode == "add"){  
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_pelanggan/insert", //SEND TO CONTROLLER
            data :{kd:kd,pr:pr,cp:cp,al:al,kt:kt,kp:kp,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,np:np},
    
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
                    url: "<?php echo base_url();?>index.php/ms_pelanggan/index",  //REFRESH TABLE DETAIL WITH CONTROLLER
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
    else
    {
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_pelanggan/update", //SEND TO CONTROLLER
            data :{kd:kd,pr:pr,cp:cp,al:al,kt:kt,kp:kp,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,np:np},
    
            success:
            function(msg) //GET MESSEGE FROM INSERT MODEL
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Data berhasil diperbarui');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    $.ajax({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/ms_pelanggan/index",  //REFRESH TABLE DETAIL WITH CONTROLLER
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
</script>
