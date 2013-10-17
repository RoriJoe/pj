<script type="text/javascript">
function list_invoice(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_invoice/index",
    data :{},
    success:
    function(hh){
        $('#list_invoice').html(hh);
    }
    });
}

list_invoice();
</script>
<!--
*
*Notification Area
*@DONT REMOVE!
*  
-->
<div id="konfirmasi" class="sukses"></div>

<!--Main Form-->
<div class="bar">
    <p>Form Inovice <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border">
<form id="formID">
    <table width="100%">
        <tr>
            <td style="width: 120px;">No Invoice</td>
            <td>
                <input  type='text' 
                        class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" 
                        id='no_invo' name='no_invo' 
                        style="width: 120px;text-transform: uppercase;" disabled="disabled">
            </td>

            <td>No SO</td>
            <td>
                <div    class="input-append" 
                        style="margin-bottom: 0;">
                    <input  type='text'
                            class="validate[required,maxSize[20], minSize[5]] span2" maxlength="20" 
                            id="so" id='appendedInputButton' name='so'
                            style="width: 120px;" disabled="disabled" 
                            onclick="lookup_so()">

                    <a  href="#modalSO" id="filterSO" role="button" class="btn" 
                        data-toggle="modal" data-toggle="tooltip" title="Filter SO" 
                        style="padding: 2px 3px;" onclick="list_SO()"><i class="icon-search"></i></a>
                </div>
            </td>
       </tr>
       
       <tr>
            <td>Tanggal</td>
            <td>
                <input  type='text' placeholder='dd-mm-yyyy'
                        class="validate[required,custom[date]]" id='_tgl1' name='_tgl1' 
                        style="width: 80px; margin-right: 20px;">
            </td>
            <td>Pelanggan</td>
            <td>
                <input type="hidden" id="kd_plg" />
                <input  type='text' 
                        class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" 
                        id='plg' name='plg' 
                        style="width: 170px;text-transform: uppercase;" disabled="disabled">
            </td>
       </tr>
       <tr>
            <td>Term</td>
            <td>
                <input  type='text' 
                        class="validate[required,custom[onlyNumberSp]]" maxlength="4" id='term' name='term' 
                        style="width: 30px;"> Hari
            </td>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required]" id='al' name='al' 
                    style="resize:none; width:170px; height: 60px;" disabled="disabled">
                </textarea>
            </td>
       </tr>
    </table>
</form>
<div id="hasil2"></div>

<div>
    <button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
    <button id="delete" class="btn">Delete</button>
    <button id="cancel" class="btn">Cancel</button>
    <button id="print" class="btn"  data-toggle="tooltip" title="Print Invoice"><i class="icon-print"></i></button>
</div>
</div>
<!--@Load table List via AJAX-->
<div id="list_invoice"></div>

<div id="modalSO" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Sales Order</h3>
  </div>
  <div class="modal-body">
    <div id="list_so"></div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" onclick="getSO()" data-dismiss="modal" aria-hidden="true">Done</button>
  </div>
</div>

<!--Le Script-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/alert.js"></script>
<script src="<?php echo base_url(); ?>assets/js/accounting.min.js" type="text/javascript"></script>
<script type="text/javascript">
    //load function here
$(document).ready(function(){
    autogen();
    validation_engine();
    detail_SO();
});

function autogen(){
    $('#delete').attr('disabled', true);
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_invoice/auto_gen",
    data :{},
    success:
        function(hh){
            $('#no_invo').val(hh);
        }
    });
}

$(function() {
    $( "#_tgl1").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
    });
});

function lookup_so(){
$("#so").autocomplete({
    minLength: 1,
    source:
    function(req, add){
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/autocomplete/lookup",
            dataType: 'json',
            type: 'POST',
            data: req,
            success:
            function(data){
                if(data.response =="true"){
                    add(data.message);
                }
            },
        });
    },

    //tampilkan table detail
    select:
    function(event, ui) {
        $('#so').val(ui.item.value);
        get_so();
        detail_SO();
    },
});
}
/*
function get_so() {
    var _do = $('#_do').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_invoice/get_so",
        data :{_do:_do},
        success:
        function(msg){
            data=msg.split("|");
            $('#plg').val(data[0]);
            $('#so').val(data[3]);
            $('#kd_plg').val(data[1]);
            $('#al').val(data[2]);
        }
    });
}
*/
function detail_SO(){
    var so = $('#so').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_invoice/Detail_SO",
        data :{so:so},
        success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

//Table Gudang
function list_SO(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_do/viewSO",
    data :{},
    success:
    function(hh){
        $('#list_so').html(hh);
    }
    });   
}

//GET POPUP SO
function getSO(){
    var a = $('input:radio[name=optionsRadios]:checked').val();
    var b = $('input:radio[name=optionsRadios]:checked').attr('pelanggan');
    var c = $('input:radio[name=optionsRadios]:checked').attr('kode_plg');
    var d = $('input:radio[name=optionsRadios]:checked').attr('alamat');
    var e = $('input:radio[name=optionsRadios]:checked').attr('total');

    $('#so').val(a);
    $('#kd_plg').val(c);
    $('#plg').val(b);
    $('#al').val(d);  
    $('#total1').val(e);
    $('#total').val(accounting.formatMoney(e, "Rp ",2,".",","));
    detail_SO();
}

function reset_form(){
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    detail_SO();
    $('#total1').val('');
    $('#total').val('');
    $('#save').attr('mode','add');
}
//Cancel
$("#cancel").click(function(){
    reset_form();
});

//Save Click
$("#save").click(function(){
    
    var mode = $('#save').attr("mode");
    
    //deklarasi variable
    var id = $('#no_invo').val();
    var _tgl = $('#_tgl1').val();
    var so = $('#so').val();
    var term = $('#term').val();
    if(mode == "add"){ //add mode
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_invoice/save/add",
            data :{id:id,_tgl:_tgl,so:so,term:term},

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Data berhasil ditambahkan');
                    reset_form();
                    list_invoice();
                }
                else{
                    bootstrap_alert.warning('<b>Gagal!</b> Data sudah ada');
                }
            }
            });
        }
        else
        {
            bootstrap_alert.warning('<b>Gagal!</b> Pilih Nomor SO & Pastikan Semua Field Terisi');
        }             
    }else if(mode == "edit"){ //Edit mode
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_invoice/save/edit",
            data :{id:id,_tgl:_tgl,so:so,term:term},

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Update berhasil dilakukan');
                    reset_form();
                    list_invoice();
                }
                else
                {
                    bootstrap_alert.warning('<b>Gagal!</b> Terjadi Kesalahan');
                }
            }
            });
        }
    }
});

$("#delete").click(function(){
    var id = $('#no_invo').val();

    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_invoice/delete",
        data :{id:id},
        success:
        function(msg)
        {
            if(msg == "ok")
            {
                bootstrap_alert.success('<b>Sukses!</b> Data telah dihapus');
                reset_form();
                list_invoice();
            }
        }
    });
});
</script>