<div class="row-fluid">
    <div class="span3">
        <!--//***MAIN FORM-->
        <div class="bar" title="Show/Hide Form">
            <p>Form Satuan <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>

        <div id="konten" class="hide-con">
        <form id="formID">
            <table>
                <tr>
                    <td>Kode</td>
                    <td>
                        <input type='text' class="form100 validate[required,maxSize[10]]" maxlength="10" 
                        id='kd' name='kd'>
                    </td>         
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td>
                        <input type='text' class="form150 validate[required, maxSize[10]]" maxlength="10" 
                        id='nm' name='nm'>
                    </td>
                </tr>
            </table>
            <div class="field-wrap action-group">
                    <?php if ($this->authorization->is_permitted('create_satuan') == true && $this->authorization->is_permitted('update_satuan') == false) : ?>
                        <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                    <?php elseif($this->authorization->is_permitted('update_satuan') == true && $this->authorization->is_permitted('create_satuan') == false): ?>
                        <button id="save" class="btn btn-primary" type="submit" mode="edit">Update</button>
                    <?php elseif($this->authorization->is_permitted('update_satuan') == true && $this->authorization->is_permitted('create_satuan') == true): ?>
                        <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                    <?php endif; ?>
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

function cekauthorization(){
    <?php if ($this->authorization->is_permitted('create_satuan') == true && $this->authorization->is_permitted('update_satuan') == false) : ?>
        $('#save').attr('mode','add');
        $("#save").attr('disabled',false);
    <?php elseif($this->authorization->is_permitted('update_satuan') == true && $this->authorization->is_permitted('create_satuan') == false): ?>
         $('#save').attr('mode','edit');
         $("#save").attr('disabled',false);
    <?php else: ?>
         $('#save').attr('mode','add');
         $("#save").attr('disabled',false);
    <?php endif; ?>
}

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
    cekauthorization();
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
                    cekauthorization();
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
                    cekauthorization(); 
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