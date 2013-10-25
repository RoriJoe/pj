<!--//***MAIN FORM-->
<div class="bar bar2" style="width: 42%;">
    <p>Form Satuan <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border" style="width: 40%;">
<form id="formID" style="margin-left: 30px;">
    <table>
        <tr>
            <td>Kode Satuan</td>
            <td>
                <input type='text' class="span-form75 validate[required,maxSize[10],custom[onlyLetterNumber]]" maxlength="10" 
                id='kd' name='kd'>
            </td>         
        </tr>
        <tr>
            <td>Satuan</td>
            <td>
                <input type='text' class="span-form170 validate[required, maxSize[10]]" maxlength="10" 
                id='nm' name='nm'>
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
<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>
</div>
<div id="hasil"></div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    load_list();
    barAnimation();
    validation();
    key();
});

function load_list(){
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_satuan/index",
        data :{},
        success:
        function(hh){
            $('#hasil').html(hh);
        }
    });
}

$("#kd").keypress(function(e){
   var userVal = $("#kd").val();
   if(userVal.length == 10){
       bootstrap_alert.info('Maksimum Kode 10');
   } 
});
$("#nm").keypress(function(e){
   var userVal = $("#nm").val();
   if(userVal.length == 10){
       bootstrap_alert.info('Maksimum Karakter 10');
   } 
});

$("#cac").click(function(){
   $('#formID').each(function(){
        this.reset();
    });
    $("#kd").attr('disabled',false);
});

$("#save").click(function(){
    var mode = $('#save').attr("mode");
    
    //DECLARE VARIABLE
    var kd = $('#kd').val();
    var nm = $('#nm').val();
    
    if(mode == "add"){
        if($("#formID").validationEngine('validate'))
        {
        $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_satuan/insert", //SEND TO CONTROLLER
        data :{kd:kd,nm:nm},

        success:
            function(msg) //GET MESSEGE FROM INSERT MODEL
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('Data <b>'+kd+' - '+nm+'</b> berhasil ditambahkan');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    load_list();
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
            url: "<?php echo base_url();?>index.php/ms_satuan/update",
            data :{kd:kd,nm:nm},
            success: 
            function(msg){                
                if(msg=="ok")
                {
                    bootstrap_alert.success('Data <b>'+kd+' - '+nm+'</b> Berhasil diperbarui');
                    $('#formID').each(function(){
                        this.reset();
                    });        
                    load_list();
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