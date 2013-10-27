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
                <input type='text' class="span-form75 upper-form validate[required,maxSize[22], minSize[5]],custom[onlyLetterNumber]]" maxlength="22" 
                id='kd' name='kd'>
            </td>
            <td>Nama</td>
            <td>
                <input type='text' class="span-form170 validate[required, maxSize[30], minSize[3]]" maxlength="30" 
                id='nm' name='nm'>
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required]" maxlength="30" id='al' name='al' style="resize:none; width:200px; height: 60px; margin-left: 10px; margin-right: 20px"></textarea>
            </td>
            <td>Kota</td>
            <td>
                <input type='text' class="validate[required, maxSize[15], minSize[3]]]" maxlength="15" id='kt' name='kt' style="width: 80px; margin-left: 10px;" onclick="disableNum('kt')">
            </td>
        </tr>
        <tr>
            <td>Telp</td>
            <td colspan="3">
                <input type='text' placeholder="Telp 1" class="telp validate[required, maxSize[15], minSize[5]],custom[phone]]" maxlength="15" id='tl1' name='tl1' onclick="disableAlpha('tl1')">
                <input type='text' placeholder="Telp 2" class="telp validate[maxSize[15], minSize[5]],custom[phone]]" maxlength="15" id='tl2' name='tl2' value="" onclick="disableAlpha('tl2')">
            </td>
        </tr>
        <tr>
            <td>Fax</td>
            <td colspan="3">
                <input type='text' placeholder="Fax 1" class="telp validate[required, maxSize[15], minSize[5]],custom[phone]]" maxlength="15" id='fx1' name='fx1' onclick="disableAlpha('fx1')">
                <input type='text' placeholder="Fax 2" class="telp validate[maxSize[15], minSize[5]],custom[phone]]" maxlength="15" id='fx2' name='fx2' value="" onclick="disableAlpha('fx2')">
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <br/>
                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <button id="cac" class="btn" type="reset">Cancel</button>
				<button id="print" class="btn"  data-toggle="tooltip" title="Cetak Daftar Gudang"><i class="icon-print"></i></button>
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
    autogen();
    barAnimation();
    validation();
    key();
});

function autogen(){
    $("#kd").attr('disabled',false);
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

$("#kd").keypress(function(e){
   var userVal = $("#kd").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Kode 20');
   } 
});
$("#nm").keypress(function(e){
   var userVal = $("#nm").val();
   if(userVal.length == 22){
       bootstrap_alert.info('Maksimum Karakter 22');
   } 
});

$("#kt").keypress(function(e){
   var userVal = $("#kt").val();
   if(userVal.length == 15){
       bootstrap_alert.info('Nama Kota Melebihi Batas Karakter');
   } 
});

$("#cac").click(function(){
   $('#formID').each(function(){
        this.reset();
    });
    autogen();
    $("#kd").attr('disabled',false);
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
                    bootstrap_alert.success('Data <b>'+kd+' - '+nm+'</b> berhasil ditambahkan');
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
                    bootstrap_alert.success('Data <b>'+kd+' - '+nm+'</b> Berhasil diperbarui');
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
