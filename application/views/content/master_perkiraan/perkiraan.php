<!--//***MAIN FORM-->
<div class="row-fluid">
      <div class="span5">
        <div class="bar" style="" title="Show/Hide Form">
            <p>Form Perkiraan <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>

        <div id="konten" class="hide-con master-border">

        <form id="formID">
            <table width="100%">
                <tr>
                    <td>No Account</td>
                    <td><input type="text" class="upper-form validate[required]" id="NoAccount" name="NoAccount" onkeyup="SetNoAC(this.value)" style="width:95px;"/>
                        <input type="hidden" id="Kode" />
                    </td>
                </tr>
                <tr>
                    <td>Nama Perkiraan</td>
                    <td><input type="text" id="NamaPer" class="validate[required]" maxlength="50" name="NamaPer" style="width:200px;"/> </td>
                </tr>
                <tr>
                  <td>Level</td>
                  <td><input type="text" id="Level" name="Level" style="width:40px;" readonly /></td>
                </tr>

                <tr>
                    <td>
                        Type
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <label class="radio">
                                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>
                                      Asset
                                    </label>
                                </td>
                                <td>
                                    <label class="radio">
                                      <input type="radio" name="optionsRadios" id="optionsRadios4" value="4">
                                      Expense
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="radio">
                                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="2">
                                      Liability
                                    </label>
                                </td>
                                <td>
                                    <label class="radio">
                                      <input type="radio" name="optionsRadios" id="optionsRadios5" value="5">
                                      Equity
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="radio">
                                      <input type="radio" name="optionsRadios" id="optionsRadios3" value="3">
                                      Revenue
                                    </label>
                                </td>
                                <td>
                                    <label class="radio">
                                      <input type="radio" name="optionsRadios" id="optionsRadios6" value="6">
                                      Contra Account
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <td>Tgl Entry</td>
                    <td ><input type="text" id="TglEnt" style="width:70px;"  readonly value="<?php echo date('d-m-Y');?>"/></td>
               </tr>
                <tr>
                    <td>Tgl Saldo Awal</td>
                    <td><input type="text" id="TglSaldoAwl" name="TglSaldoAwl" class="validate[required]" value="<?php echo date('d-m-Y');?>"  style="cursor:pointer;width:70px;" /></td>
                </tr>
                
                <tr>
                    <td>Saldo Awal</td>
                    <td>
                        <div class="input-prepend" style="margin-bottom: 0; display:inline-block;">
                          <span class="add-on" style="padding: 4px;margin-bottom:5px;">Rp</span>
                          <input class="span2" id='NilaiSaldo' id="appendedPrependedInput" type='text' class="validate[required]" maxlength="15" name='lk' style="width: 125px; text-align:right;height: 24px;" onkeyup="formatAngka(this,'.')" >
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <div class="field-wrap action-group">
                            <input type="hidden" id="flagaction"/>

                            <?php if ($this->authorization->is_permitted('create_perkiraan') == true && $this->authorization->is_permitted('update_perkiraan') == false) : ?>
                                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                            <?php elseif($this->authorization->is_permitted('update_perkiraan') == true && $this->authorization->is_permitted('create_perkiraan') == false): ?>
                                <button id="save" class="btn btn-primary" type="submit" mode="edit">Update</button>
                            <?php elseif($this->authorization->is_permitted('update_perkiraan') == true && $this->authorization->is_permitted('create_perkiraan') == true): ?>
                                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                            <?php endif; ?>
                                <button id="cac" class="btn" type="reset">Cancel</button>
                            <?php if ($this->authorization->is_permitted('print_perkiraan')) : ?>
                                <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Daftar perkiraan"><i class="icon-print"></i> Print</button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            </table>
         </form>
        <!--**NOTIFICATION AREA**-->
        <div id="konfirmasi" class="sukses"></div>
        </div>
    </div>

    <div class="offset3 span4">
        <div id="hasil"></div>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    load_list();
    validation();
    barAnimation();
    $("#flagaction").val(1);
});

function cekauthorization(){
    <?php if ($this->authorization->is_permitted('create_perkiraan') == true && $this->authorization->is_permitted('update_perkiraan') == false) : ?>
        $('#save').attr('mode','add');
        $("#save").attr('disabled',false);
    <?php elseif($this->authorization->is_permitted('update_perkiraan') == true && $this->authorization->is_permitted('create_perkiraan') == false): ?>
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
    url: "<?php echo base_url();?>index.php/ms_perkiraan/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
});
}

function retrieveForm(myID){
    var id = myID;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_perkiraan/retrieveForm",
        data :{id:id},
        dataType: 'json',
        success:
        function(msg){
            $('#NamaPer').val(msg.nama);
            $('#Level').val(msg.level);
            $('#TglEnt').val(msg.tgl_entry);
            $('#TglSaldoAwl').val(msg.tgl_saldo);
            $('#NilaiSaldo').val(msg.saldo);
            document.getElementById("optionsRadios"+msg.typeRadio).checked = true;
        }
    }); 
}

$("#cac").click(function(){
    $('#formID').each(function(){
        this.reset();
    });
    cekauthorization();
});

$(function() {
    $( "#TglSaldoAwl").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
        defaultDate: new Date()
    });
});

function Huruf(nStr) {
    var hasil='';
    a = nStr.length;
    for(i=0;i<a;i++){
        x = nStr.charAt(i);
        if(!isNaN(x)){
            hasil+=x;
        }
    }
    return hasil;
}

function SetNoAC(Val){
    var No = document.getElementById('NoAccount');
    var Level = document.getElementById('Level');
    var Value = Huruf(Val);
    Level.value ='';
    No.value=Value;

    if(Value.length ==1){
        Level.value = '1';
        No.value=Value;
    }
    else if(Value.length ==2){
        No.value = Value.substring(0,1)+'.'+Value.substring(1,2);
        Level.value = '2';
    }else if(Value.length==3 || Value.length==4){
        No.value = Value.substring(0,1)+'.'+Value.substring(1,2)+'.'+Value.substring(2,4);
        Level.value = '3';
    }else if(Value.length > 4){
        No.value = Value.substring(0,1)+'.'+Value.substring(1,2)+'.'+Value.substring(2,4)+'.'+Value.substring(4,7);
        Level.value = '4';
    }
    $.ajax({
        type: "POST",    
        url: "<?php echo base_url(); ?>index.php/ms_perkiraan/CekNoAcc",
        data: {Val:No.value,FlagAc:$("#flagaction").val(),Kode:$("#Kode").val()},
        cache: false,
        success: function(msg){
             if(msg==1){
                $("#NoAccount").validationEngine('showPrompt', 'Sudah Terdaftar', 'show');
                Flag=0;
            }else if(msg==0){
                $("#NoAccount").validationEngine('showPrompt', 'Tersedia', 'pass');Flag=1;
            }else if(msg==2){
                $("#NoAccount").validationEngine('showPrompt', 'Belum Terdaftar', 'show');Flag=0;
            }
        }
    });
}

$("#save").click(function(){
    var mode = $('#save').attr("mode");
    
    if(mode == "add"){ //MODE ADD NEW ITEM
        //DECLARE VARIABLE
        var _kd = $('#NoAccount').val();
        var _nama1 = $('#NamaPer').val();
        var _tipe = $('input[name=optionsRadios]:checked', '#formID').val();
        var _level = $('#Level').val();
        var _tgl = $('#TglEnt').val();
        var _tgl2 = $('#TglSaldoAwl').val();
        var _saldo = $('#NilaiSaldo').val().replace(/\./g, "");
        
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_perkiraan/insert", //SEND TO CONTROLLER
            data :{_kd:_kd,_nama1:_nama1,_tipe:_tipe,_level:_level,_tgl:_tgl,_tgl2:_tgl2,_saldo:_saldo},

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Data Perkiraan <b>'+_kd+'-'+_nama1+'</b> berhasil ditambahkan');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    load_list();
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
    else //MODE UPDATE ITEM
    {
        var _kd = $('#NoAccount').val();
        var _nama1 = $('#NamaPer').val();
        var _tipe = $('input[name=optionsRadios]:checked', '#formID').val();
        var _level = $('#Level').val();
        var _tgl = $('#TglEnt').val();
        var _tgl2 = $('#TglSaldoAwl').val();
        var _saldo = $('#NilaiSaldo').val().replace(/\./g, "");
        
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_perkiraan/update", //SEND TO CONTROLLER
            data :{_kd:_kd,_nama1:_nama1,_tipe:_tipe,_level:_level,_tgl:_tgl,_tgl2:_tgl2,_saldo:_saldo},

            success:
            function(msg){
                if(msg=="ok")
                {
                        bootstrap_alert.success('<b>Sukses</b> Update Perkiraan <b>'+_kd+'-'+_nama1+'</b> berhasil dilakukan');
                        $('#formID').each(function(){
                                this.reset();
                        });
                        load_list();
                        $('#save').attr('mode','add');
                }
                else
                {
                        bootstrap_alert.warning('<b>Gagal Update</b> Terjadi Kesalahan');
                }
                }
            });
        }
        return false;
    }
});

</script>