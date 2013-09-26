<script>
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

//Side Table
$.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_gudang/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
});

//Auto Generate
function autogen(){
    $("#kd").attr('disabled',false);
    
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

autogen();
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
                <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]]" maxlength="20" id='kd' name='kd' style="width: 75px; margin-left: 10px; margin-right: 20px;">
            </td>
            <td>Nama</td>
            <td>
                <input type='text' class="validate[required, maxSize[20], minSize[3]],custom[onlyLetterSp]]" maxlength="20" id='nm' name='nm' style="width: 146px; margin-left: 10px; margin-right: 20px;">
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required]" id='al' name='al' style="resize:none; width:200px; height: 60px; margin-left: 10px; margin-right: 20px"></textarea>
            </td>
            <td>Kota</td>
            <td>
                <input type='text' class="validate[required, maxSize[15], minSize[3]],custom[onlyLetterSp]]" maxlength="15" id='kt' name='kt' style="width: 80px; margin-left: 10px;">
            </td>
        </tr>
        <tr>
            <td>Telp</td>
            <td colspan="3">
                <input type='text' placeholder="Telp 1" class="validate[required, maxSize[13], minSize[5]],custom[phone]]" id='tl1' name='tl1' style="width: 200px;margin-left: 10px">
                <input type='text' placeholder="Telp 2" class="validate[maxSize[13], minSize[5]],custom[phone]]" id='tl2' name='tl2' value="" style="width: 200px; margin-left: 10px">
            </td>
        </tr>
        <tr>
            <td>Fax</td>
            <td colspan="3">
                <input type='text' placeholder="Fax 1" class="validate[required, maxSize[13], minSize[5]],custom[phone]]" id='fx1' name='fx1' style="width: 200px; margin-left: 10px">
                <input type='text' placeholder="Fax 2" class="validate[maxSize[13], minSize[5]],custom[phone]]" id='fx2' name='fx2' value="" style="width: 200px; margin-left: 10px">
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <br/>
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
                    bootstrap_alert.success('<b>Sukses</b> Data sudah ditambahkan');
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
            url: "<?php echo base_url();?>index.php/ms_gudang/update",
            data :{kd:kd,nm:nm,al:al,kt:kt,tl1:tl1,tl2:tl2,fx1:fx1,fx2:fx2},
            success: 
            function(msg){                
                if(msg=="ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Data Berhasil diperbarui');
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
                    bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data sudah ada');
                } 
            }
            });
        }
        return false;
    }
});
</script>
<div id="hasil"></div>
