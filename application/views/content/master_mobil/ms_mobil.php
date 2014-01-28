<div class="row-fluid">
    <div class="span3">
        <!--//***MAIN FORM-->
        <div class="bar" title="Show/Hide Form">
            <p>Form Mobil <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>

        <div id="konten" class="hide-con">
        <form id="formID">
            <table>
                <tr>
                    <td>No Mobil</td>
                    <td>
                        <input type="hidden" id="kdTemp">
                        <input type='text' class="form100 validate[required,maxSize[10]]" maxlength="10" 
                        id='kd' name='kd'>
                    </td>         
                </tr>
            </table>
            <div class="field-wrap action-group">
                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <button id="cac" class="btn" type="reset">Cancel</button>
            </div>
        </form>
        <!--**NOTIFICATION AREA**-->
        <div id="konfirmasi" class="sukses"></div>
        </div>
    </div>
    <div class="offset6 span3">
        <div id="hasil"></div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    load_list();
    barAnimation();
    validation();
});

function load_list(){
    $('#save').attr('mode','add');
    $('#loadingDiv').show()
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_mobil/index",
        data :{},
        success:
        function(hh){
            setTimeout(function () {
                $('#hasil').html(hh);
                $('#loadingDiv').hide()
            }, 1500);
        }
    });
    $('#save').attr('mode','add');
}

$("#kd").keypress(function(e){
   var userVal = $("#kd").val();
   if(userVal.length == 10){
       bootstrap_alert.info('Maksimum Nomor Mobil 10');
   } 
});

$("#cac").click(function(){
   $('#formID').each(function(){
        this.reset();
    });
    $("#kd").attr('disabled',false);
    $('#save').attr('mode','add');
});

$("#save").click(function(){
    var mode = $('#save').attr("mode");
    
    //DECLARE VARIABLE
    var kd = $('#kd').val();
    var kdTemp = $('#kdTemp').val();
    
    if(mode == "add"){
        if($("#formID").validationEngine('validate'))
        {
        $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_mobil/insert", //SEND TO CONTROLLER
        data :{kd:kd},

        success:
            function(msg) //GET MESSEGE FROM INSERT MODEL
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('Nomor Mobil <b>'+kd+'</b> berhasil ditambahkan');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    load_list();
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
            url: "<?php echo base_url();?>index.php/ms_mobil/update",
            data :{kd:kd, kdTemp:kdTemp},
            success: 
            function(msg){                
                if(msg=="ok")
                {
                    bootstrap_alert.success('Nomor Mobil <b>'+kd+'</b> Berhasil diperbarui');
                    $('#formID').each(function(){
                        this.reset();
                    });        
                    load_list();
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