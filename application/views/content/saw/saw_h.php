<div class="row-fluid">
    <div class="span7">
        <!--//***MAIN FORM-->
        <div class="bar">
            <p>Form Pendataan Stock Opname <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>
        <div id="konten" class="hide-con master-border">
            <form id="formID">
                <table>
                    <tr>
                        <td>Nomor Trans</td>
                        <td>
                            <input type='text' class="validate[required,maxSize[7], minSize[7]],custom[onlyNumberSp]" 
                            maxlength="7" id='noSaw' name='noSaw' onclick="disableAlpha('noSaw')" 
                            style="width: 120px; margin-left: 10px; margin-right: 20px;text-transform: uppercase;"/>
                        </td>

                        <td>Tgl Pendataan</td>
                        <td>
                            <input type='text' class="validate[required,custom[date]]" id='_tgl' name='_tgl' 
                            style="width: 80px;margin-left: 10px; margin-right: 20px;" value="<?php echo date('d-m-Y');?>">
                        </td>
                   </tr>
                   <tr>
                       <td>Gudang</td>
                        <td>
                            <input type="hidden" class="validate[required]" id="kd_gd" />
                            <div class="input-append money">
                             <input type='text' class="validate[required,maxSize[25], minSize[5]] span2" 
                                maxlength="30" id="gud" id='appendedInputButton' name='_gd' 
                                style="width: 135px; margin-left: 10px;" onclick="lookup_gudang()"/>
                            <a href="#modalGudang" style="margin-bottom:2px;" role="button" class="btn padding-filter" data-toggle="modal" data-toggle="tooltip" title="Filter Gudang" onclick="listGudang()"><i class="icon-filter"></i></a>
                              
                            </div>
                        </td>
                   </tr>
                </table>
            </form>
            <hr style="margin:0;" />
            <div id="detail"></div>
            <!--**NOTIFICATION AREA**-->
            <div id="konfirmasi" class="sukses"></div>

            <div style="margin-top: 10px;"> 
                <button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
                <button id="delete" class="btn" type="submit">Delete</button>
                <button id="cancel" class="btn" type="submit">Cancel</button>

                <button id="print" class="btn" data-toggle="tooltip" title="Print Penerimaan Barang"><i class="icon-print"></i> Print</button>
                <a id="loadBtn" class="btn btn-warning" data-loading-text="Loading...">Load Barang</a>
            </div>
        </div>
    </div>
    <div class="offset2 span3">     
        <div id="list"></div>
    </div>
</div>

<div id="modalGudang" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Gudang</h3>
  </div>
  <div class="modal-body">
    <div id="list_gudang"></div>
  </div>
  <div class="modal-footer">
    <a href="#modalNewGudang" role="button" class="btn btn-info" data-toggle="modal" onclick="addGudang()">Add Gudang</a>
  </div>
</div>

<div id="modalNewGudang" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah Gudang</h3>
  </div>
  <div class="modal-body">
    <div id="add_gudang"></div>
  </div>
    <div class="modal-footer">
        <button id="saveGudang" class="btn btn-primary" mode="add">Save</button>
        <button id="cacGudang" class="btn" type="reset">Cancel</button>
    </div>
</div>

<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Barang</h3>
  </div>
  <div class="modal-body">
    <div id="list_barang"></div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" onclick="getBarang()" data-dismiss="modal" aria-hidden="true">Done</button>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$( "#_tgl" ).datepicker( "setDate", new Date());
    autogen();
    validation();	
    resetForm();
});

function autogen(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/saw/auto_gen",
    data :{},
    success:
        function(hh){
            $('#noSaw').val(hh);
        }
    });

    detailSaw();
}
function listGudang(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_gudang/viewGudang",
    data :{},
    success:
    function(hh){
        $('#list_gudang').html(hh);
    }
    });   
}

function addGudang(){
    $('#modalGudang').modal('hide');
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_gudang/popGudang",
    data :{},
    success:
    function(hh){
        $('#add_gudang').html(hh);
    }
    });  
} 

function listBarang(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_barang/viewBarang",
    data :{},
    success:
    function(hh){
        $('#list_barang').html(hh);
    }
    });   
}

function lookup_gudang(){
    $("#gud").autocomplete({
    minLength: 1,
    source:
        function(req, add){
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/autocomplete/lookgudang",
                dataType: 'json',
                type: 'POST',
                data: req,
                success:
                function(data){
                    if(data.response =="true"){
                        add(data.message);
                        $("#gud").validationEngine('showPrompt', 'Data Gudang Tersedia', 'pass');
                    }
                    else
                    {
                        $("#gud").validationEngine('showPrompt', 'Data Gudang Tidak Tersedia', 'show');
                    }
                },
            });
        },
    select:
        function(event, ui) {
            $('#gud').val(ui.item.value);
            $('#kd_gd').val(ui.item.id);
            $("#gud").validationEngine('showPrompt', 'Data Supplier Tersedia', 'pass');
        },
    });
}

$(function() {
    $( "#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
});

function key(){
$('input[type="text"]').keyup(function() {
    if($(this).val() != '') {
        $('#save').removeAttr('disabled');
        $('#cancel').removeAttr('disabled');
        $('#add').removeAttr('disabled');
    }
 });
 $("#al").keyup(function() {
    if($(this).val() != '') {
       $('button[type="submit"]').removeAttr('disabled');
    }
 });
}

function addBarang(){
    
    $.ajax({ 
        type:'POST',
        url: "<?php echo base_url();?>index.php/saw/addBarang",
        data :{},
        success:
        function(hh){
           $('#detail').html(hh);
        }
    });
}

function detailSaw(){
    var id = $('#noSaw').val();
    $.ajax({ //utk tabel detail DO
        type:'POST',
        url: "<?php echo base_url();?>index.php/saw/detail",
        data :{id:id},
        success:
        function(hh){
           $('#detail').html(hh);
        }
    });
}

function resetForm(){
    $( "#_tgl" ).datepicker( "setDate", new Date());
    $('#delete').attr('disabled', true);
    $("#noSaw").attr('disabled',false);
    $('#save').attr('mode','add');
    $('#cancel').attr('disabled',false);
    $('#save').attr('disabled',false);
}

$('#loadBtn')
.click(function () {
    loadBarang();
});

function listSaw(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/saw/index",
    data :{},
    success:
    function(hh){
        $('#list').html(hh);
    }
    });
}

function loadBarang(){
    addBarang();
}

function getGudang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('kd');

    $('#gud').val(x);
    $('#kd_gud').val(y);    
}
function getBarang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('nama');
    var z = $('input:radio[name=optionsRadios]:checked').attr('ukuran');
    var o = $('input:radio[name=optionsRadios]:checked').attr('satuan');
    
    var row = filter;

    var arrs = document.getElementsByName('kode_brgd');

    found_flag = false;
    for (i = 0; i < arrs.length; i++) {
        if (arrs[i].value === x) {
            found_flag = true;
            break;
        }
    }

    if (found_flag === true)
    {
        bootstrap_alert.warning('<b>Gagal Menambahkan Barang!</b> Barang sudah ada dalam List');
    } else {
        $('#kode_brg'+row).val(x);
        $('#nama_brg'+row).val(y);
        $('#ukuran_brg'+row).val(z);
        $('#satuan_brg'+row).val(o);
    }
}

$("#cancel").click(function(){
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    resetForm();
    //document.getElementById('add').style.visibility = 'visible';
});

$('#print').click(function () {
    bootstrap_alert.info('fungsi print dalam pengerjaan');
});

//Save Click
$("#save").click(function(){
    var table = document.getElementById('tb3');
    var totalRow = table.rows.length-1;
    
    if(totalRow != 0 && $('#kode_brg1').val() != ""){
        
    var _mode = $('#save').attr("mode");
    
    var noSaw = $('#noSaw').val();
    var _tgl = $('#_tgl').val();
    var _gd = $('#kd_gd').val();

    //detail bpb
    var _arrKd_brg = new Array();
    var _arrQty = new Array();
    
    for(var i=1;i<=totalRow;i++){
        _arrKd_brg[i-1] = $('#kode_brg'+i).val();
        _arrQty[i-1] = $('#qty_brg'+i).val();
    }
    
    if(_mode == "add") //add mode
    {
        if(_gd == 0){
        bootstrap_alert.warning('<b>Gagal!</b> Data Gudang Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
        }
        else if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/saw/insert/add",
            data :{noSaw:noSaw,_tgl:_tgl,_gd:_gd,
                    _arrKd_brg:_arrKd_brg, _arrQty:_arrQty, totalRow:totalRow
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Pendataan Stok Opname '+noSaw+' berhasil ditambahkan');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    autogen();
                    listSaw();
                    detailSaw();
                    resetForm();
                }
                else{
                    bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data sudah ada');
                }
            }
            });
        }     
    }
    
    //Edit mode
    else if(_mode == "edit")
    { 
        if(_gd == 0){
            bootstrap_alert.warning('<b>Gagal!</b> Data Gudang Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
        }
        else 
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/saw/insert/edit",
            data :{noSaw:noSaw,_tgl:_tgl,_gd:_gd,
                    _arrKd_brg:_arrKd_brg, _arrQty:_arrQty,totalRow:totalRow
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Update Pendataan Stok Opname '+noSaw+' berhasil dilakukan');
                    $('#formID').each(function(){
                            this.reset();
                    });
                    autogen();
                    listSaw();
                    detailSaw();
                    resetForm();
                }
                else{
                    bootstrap_alert.warning('<b>Gagal</b> Terjadi Kesalahan');
                }
            }
            });
        }
    }
    }else{
        bootstrap_alert.warning('<b>Gagal</b> Terjadi Kesalahan, Table Detail Barang Harus diisi!');
    }  
});

$("#delete").click(function(){
    var noSaw = $('#noSaw').val();

    PlaySound('beep');
    var id = $('#noSaw').val();
    var pr = $('#_tgl').val();
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode SO: <b>"+id+"</b>",
        title: "<img src='<?php echo base_url();?>/assets/img/warning-icon.svg' class='warning-icon'/> Yakin ingin menghapus Data Berikut?",
        buttons: {
            main: {
                label: "Batal",
            },
            danger: {
                label: "Hapus",
                className: "btn-danger",
                callback: function() {
                    $.ajax({
                        type:'POST',
                        url: "<?php echo base_url();?>index.php/saw/delete",
                        data :{noSaw:noSaw
                        },

                        success:
                        function(msg)
                        {
                            if(msg == "ok")
                            {
                                bootstrap_alert.success('Pendataan Stok Opname <b>'+id+'</b> berhasil dihapus');
                                $('#formID').each(function(){
                                    this.reset();
                                });
                                listSaw();
                                detailSaw();
                                autogen();
                                resetForm();
                            }
                        }
                    });
                }
            }
        }
    });
});

</script>