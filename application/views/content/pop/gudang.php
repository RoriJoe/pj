<form id="formGudang" style="margin-left: 30px;">
    <table>
        <tr>
            <td>Kode</td>
            <td>
                <input type='text' class="span-form75 upper-form validate[required,maxSize[22], minSize[5]],custom[onlyLetterNumber]]" maxlength="22" 
                id='kd' name='kd'>
            </td>
        </tr>
        <tr>
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
                <button id="saveGudang" class="btn btn-primary" mode="add">Save</button>
                <button id="cacGudang" class="btn" type="reset">Cancel</button>
            </td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        autogenGudang();
        validationGudang();
    });

function autogenGudang(){
    $('#save').attr('mode','add');

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

function validationGudang(){
jQuery("#formGudang").validationEngine(
{
    showOneMessage: true,
    ajaxFormValidation: true,
    ajaxFormValidationMethod: 'post',
    autoHidePrompt: true,
    autoHideDelay: 2500, 
    fadeDuration: 0.3
    });
}

$("#cacGudang").click(function(){
   $('#formGudang').each(function(){
        this.reset();
    });
    $('#modalNewGudang').modal('hide');
});

$("#saveGudang").click(function(){    
    //DECLARE VARIABLE
    var kd = $('#kd').val();
    var nm = $('#nm').val();
    var al = $('#al').val();
    var kt = $('#kt').val();
    var tl1 = $('#tl1').val();
    var tl2 = $('#tl2').val();
    var fx1 = $('#fx1').val();
    var fx2 = $('#fx2').val();
    
    if($("#formGudang").validationEngine('validate'))
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
                    $('#_gd').val(nm);
                    $('#kd_gd').val(kd);
                    bootstrap_alert.success('Data <b>'+kd+' - '+nm+'</b> berhasil ditambahkan');
                    $('#formGudang').each(function(){
                        this.reset();
                    });
                    $('#save').attr('mode','add');
                    $('#modalNewGudang').modal('hide');
                }
                else
                {
                    bootstrap_alert.success('Data Gudang gagal ditambahkan');
                }
            }
        });
    }   
    return false;
});
</script>