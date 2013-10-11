<script type="text/javascript">

function load_list(){
$.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_gudang/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
});
}

load_list();
</script>

<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>

<!--//***MAIN FORM-->
<div class="bar bar2">
    <p>Form Gudang <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border" style="width: 62%;">
<form id="formID" style="margin-left: 30px;">
    <table>
        <tr>
            <td>Kode</td>
            <td>
                <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]]" maxlength="20" 
                id='kd' name='kd' 
                style="width: 75px; margin-left: 10px; margin-right: 20px;text-transform: uppercase;">
            </td>
            <td>Nama</td>
            <td>
                <input type='text' class="validate[required, maxSize[30], minSize[3]]" maxlength="20" 
                id='nm' name='nm' 
                style="width: 146px; margin-left: 10px; margin-right: 20px;">
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required]" id='al' name='al' style="resize:none; width:200px; height: 60px; margin-left: 10px; margin-right: 20px"></textarea>
            </td>
            <td>Kota</td>
            <td>
                <input type='text' class="validate[required, maxSize[15], minSize[3]]]" maxlength="15" id='kt' name='kt' style="width: 80px; margin-left: 10px;" onclick="disableNum('kt')">
            </td>
        </tr>
        <tr>
            <td>Telp</td>
            <td colspan="3">
                <input type='text' placeholder="Telp 1" class="validate[required, maxSize[15], minSize[5]],custom[phone]]" maxlength="15" id='tl1' name='tl1' style="width: 200px;margin-left: 10px" onclick="disableAlpha('tl1')">
                <input type='text' placeholder="Telp 2" class="validate[maxSize[15], minSize[5]],custom[phone]]" maxlength="15" id='tl2' name='tl2' value="" style="width: 200px; margin-left: 10px" onclick="disableAlpha('tl2')">
            </td>
        </tr>
        <tr>
            <td>Fax</td>
            <td colspan="3">
                <input type='text' placeholder="Fax 1" class="validate[required, maxSize[13], minSize[5]],custom[phone]]" maxlength="13" id='fx1' name='fx1' style="width: 200px; margin-left: 10px" onclick="disableAlpha('fx1')">
                <input type='text' placeholder="Fax 2" class="validate[maxSize[13], minSize[5]],custom[phone]]" maxlength="13" id='fx2' name='fx2' value="" style="width: 200px; margin-left: 10px" onclick="disableAlpha('fx2')">
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <br/>
                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <button id="cac" class="btn" type="reset">Cancel</button>
				<button id="print" class="btn"  data-toggle="tooltip" title="Print Penerimaan Barang"><i class="icon-print"></i></button>
            </td>
        </tr>
    </table>
</form>
</div>
<div id="hasil"></div>

<script type="text/javascript">

$(document).ready(function(){
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

//Auto Generate
function autogen(){
    $("#kd").attr('disabled',true);
    $('#save').attr('mode','add');
    $('button[type="submit"]').attr('disabled','disabled');
    
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_gudang/auto_gen",
    data :{},
    success:
        function(hh){
            $('#kd').val(hh);
        }
    });
}

/*
*Notification Function
*/
bootstrap_alert = function() {}
bootstrap_alert.warning = function(message) {
    $('#konfirmasi').html('<div class="alert alert-error" style="position:absolute; width:52%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}
bootstrap_alert.success = function(message) {
    $('#konfirmasi').html('<div class="alert alert-success" style="position:absolute; width:52%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
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

function disableAlpha($id){
    var foo = document.getElementById($id);
    foo.addEventListener('input', function (prev) {
    return function (evt) {
        if (!/^[+\-\0-9 ]*?$/.test(this.value)) {
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
        if (!/^[A-Za-z\ \']*$/.test(this.value)) {
          this.value = prev;
        }
        else {
          prev = this.value;
        }
    };
    }(foo.value), false);
};
</script>

<script type="text/javascript">
//buat print
$("#print").click(function(){
$.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/report/print_master_gudang",
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

$("#cac").click(function(){
   $('#formID').each(function(){
        this.reset();
    });
    autogen();
});

$("#save").click(function(){
    var mode = $('#save').attr("mode");
    
    //DECLARE VARIABLE
    var kd = $('#kd').val();
    var nm = $('#nm').val();
    var al = $('#al').val();
    var kt = $('#kt').val();
    var tl1 = $('#tl1').val();
    var tl2 = $('#tl2').val();
    var fx1 = $('#fx1').val();
    var fx2 = $('#fx2').val();
    
    if(mode == "add"){
        if($("#formID").validationEngine('validate'))
        {
        $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_gudang/insert", //SEND TO CONTROLLER
        data :{kd:kd,nm:nm,al:al,kt:kt,tl1:tl1,tl2:tl2,fx1:fx1,fx2:fx2},

        success:
            function(msg) //GET MESSEGE FROM INSERT MODEL
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Data berhasil ditambahkan');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    $.ajax({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/ms_gudang/index",  //REFRESH TABLE DETAIL WITH CONTROLLER
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
                    bootstrap_alert.warning('<b>Gagal!</b> Data sudah ada');
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
            url: "<?php echo base_url();?>index.php/ms_gudang/update",
            data :{kd:kd,nm:nm,al:al,kt:kt,tl1:tl1,tl2:tl2,fx1:fx1,fx2:fx2},
            success: 
            function(msg){                
                if(msg=="ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Data Berhasil diperbarui');
                    $('#formID').each(function(){
                        this.reset();
                    });        
                    $.ajax({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/ms_gudang/index",
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
                    bootstrap_alert.warning('<b>Gagal!</b> Terjadi Kesalahan');
                } 
            }
            });
        }
        return false;
    }
});
</script>
