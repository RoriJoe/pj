<div class="row-fluid">
    <div class="span7">
        <!--//***MAIN FORM-->
        <div class="bar">
            <p>Form Pendataan Stock Opname <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>
        <div id="konten" class="hide-con" style="max-height:430px;height:430px;">
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
                            style="width: 80px;margin-left: 10px; margin-right: 20px;" value="">
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
                            <a href="#modalGudang" style="margin-bottom:5px;" role="button" class="btn padding-filter" data-toggle="modal" data-toggle="tooltip" title="Filter Gudang" onclick="listGudang()"><i class="icon-filter"></i></a>
                              
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
                <?php if ($this->authorization->is_permitted('create_stock') == true && $this->authorization->is_permitted('update_stock') == false) : ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php elseif($this->authorization->is_permitted('update_stock') == true && $this->authorization->is_permitted('create_stock') == false): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="edit">Update</button>
                <?php elseif($this->authorization->is_permitted('update_stock') == true && $this->authorization->is_permitted('create_stock') == true): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php endif; ?>

                <?php if ($this->authorization->is_permitted('delete_stock')) : ?>
                    <button id="delete" class="btn">Delete</button>
                <?php endif; ?>
                <button id="cancel" class="btn">Cancel</button>
                <?php if ($this->authorization->is_permitted('print_stock')) : ?>
                    <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Stock Opname"><i class="icon-print"></i> Print</button>
                <?php endif; ?>

                <a id="loadBtn" class="btn btn-success" title="Load List Barang">Load Barang</a>

                <div class="btn-group dropup pull-right" id="selList">
                    <button class="btn primary">Filter By Qty</button>
                    <button class="btn primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="#" onclick="qtyBarang()">Barang Dengan Qty</a></li>
                      <li><a href="#" onclick="noqtyBarang()">Barang Tanpa Qty</a></li>
                    </ul>
              </div>
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
    <?php if ($this->authorization->is_permitted('create_gudang')) : ?>
        <a href="#modalNewGudang" role="button" class="btn btn-info" data-toggle="modal" readonly>Add Gudang</a>
    <?php endif;?>
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
    document.getElementById('selList').style.visibility = 'hidden';
    listSaw();
    autogen();
    validation();	
    resetForm();
});

function cekauthorization(){
    <?php if ($this->authorization->is_permitted('create_stock') == true && $this->authorization->is_permitted('update_stock') == false) : ?>
        $('#save').attr('mode','add');
        $("#save").attr('disabled',false);
    <?php elseif($this->authorization->is_permitted('update_stock') == true && $this->authorization->is_permitted('create_stock') == false): ?>
         $('#save').attr('mode','edit');
         $("#save").attr('disabled',false);
    <?php else: ?>
         $('#save').attr('mode','add');
         $("#save").attr('disabled',false);
    <?php endif; ?>
}

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
    document.getElementById('loadBtn').style.visibility = 'visible';
    detailSaw();

    $("#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        language: "id",
        autoclose: true
    }); 

    $( "#_tgl").datepicker('setValue', new Date()); 
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
/*
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
*/
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
    $('#loadingDiv').show()
    $.ajax({ 
        type:'GET',
        async:true,
        url: "<?php echo base_url();?>index.php/saw/addBarang",
        data :{},
        success:
        function(hh){
            setTimeout(function () {
                $('#detail').html(hh);
                $('#loadingDiv').hide()
            }, 1500); 
        }
    });
}

function qtyBarang(){ 
    var id = $('#noSaw').val();
    $('#save').attr('mode','edit');
    $('#loadingDiv').show()
    $.ajax({ 
        type:'POST',
        url: "<?php echo base_url();?>index.php/saw/qtyBarang",
        data :{id:id},
        success:
        function(hh){
            setTimeout(function () {
                $('#detail').html(hh);
                $('#loadingDiv').hide()
            }, 1500); 
        }
    });
}

function noqtyBarang(){ 
    var id = $('#noSaw').val();
    $('#save').attr('mode','edit2');
    $('#loadingDiv').show()
    $.ajax({ 
        type:'POST',
        url: "<?php echo base_url();?>index.php/saw/noqtyBarang",
        data :{id:id},
        success:
        function(hh){
            setTimeout(function () {
                $('#detail').html(hh);
                $('#loadingDiv').hide()
            }, 1500); 
        }
    });
}

function allBarang(){ 
    var id = $('#noSaw').val();
    $('#loadingDiv').show()
    $.ajax({ 
        type:'POST',
        url: "<?php echo base_url();?>index.php/saw/all",
        data :{id:id},
        success:
        function(hh){
            setTimeout(function () {
                $('#detail').html(hh);
                $('#loadingDiv').hide()
            }, 1500); 
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
    cekauthorization();
    $('#cancel').attr('disabled',false);
    $('#save').attr('disabled',false);
}

$('#loadBtn').click(function () {
    addBarang();
});

function listSaw(){
    $('#loadingDiv').show()
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/saw/index",
    data :{},
    success:
    function(hh){
        setTimeout(function () {
            $('#list').html(hh);
            $('#loadingDiv').hide()
        }, 1500); 
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
    $('#kd_gd').val(y);    
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



//Save Click
$("#save").click(function(){
    //var oTable = $('#tb3').dataTable();
    var totalRow = oTable.fnGetData().length;
    //alert(totalRow);
    var _mode = $('#save').attr("mode");
    
    var noSaw = $('#noSaw').val();
    var _tgl = $('#_tgl').val();
    var _gd = $('#kd_gd').val();
    
    var _arrKd_brg = new Array();
    var _arrQty = new Array();

    /*for(var i=1;i<=totalRow;i++){
        var b = $('#qty_brg'+i).val();
        if(b !== '')
        {
            _arrKd_brg[i-1] = $('#kode_brg'+i).val();
            _arrQty[i-1] = b;
        }
    }*/
    //alert(_arrQty.length);
    var aTrs = oTable.fnGetNodes();

    $(aTrs, this).each(function() {
        var qtys = $('.qtyb',this).val();
        var kode_brg = $('.kd_brg',this).val();
        
        if(qtys != ""){
            _arrKd_brg.push( kode_brg );
            _arrQty.push( qtys );
        }
    });                  
    var arrData = _arrQty.length;
    //console.log(_arrKd_brg);
    //console.log(_arrQty);

    if(_arrKd_brg.length != 0){
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
                        _arrKd_brg:_arrKd_brg, _arrQty:_arrQty, arrData:arrData
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
                        _arrKd_brg:_arrKd_brg, _arrQty:_arrQty,arrData:arrData
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

        else if(_mode == "edit2")
        { 
            if(_gd == 0){
                bootstrap_alert.warning('<b>Gagal!</b> Data Gudang Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
            }
            else 
            if($("#formID").validationEngine('validate'))
            {
                $.ajax({
                type:'POST',
                url: "<?php echo base_url();?>index.php/saw/insert/edit2",
                data :{noSaw:noSaw,_tgl:_tgl,_gd:_gd,
                        _arrKd_brg:_arrKd_brg, _arrQty:_arrQty,arrData:arrData
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
    }
    else
    {
        bootstrap_alert.warning('<b>Gagal</b> Detail Qty Barang belum di isi');
        return false;
    }
});

$("#delete").click(function(){
    var noSaw = $('#noSaw').val();

    PlaySound('beep');
    var id = $('#noSaw').val();
    var pr = $('#_tgl').val();
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode Transaksi Stok Opname: <b>"+id+"</b>",
        title: "<img src='<?php echo base_url();?>/assets/img/warning-icon.svg' class='warning-icon'/> Yakin ingin menghapus Data Berikut?",
        buttons: {
            main: {
                label: "Batal",
                className: "pull-left"
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

//buat print
$("#print").click(function(){
$.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/report/print_stokop",
        data :{   
        },

        success:
        function(msg)
        {   
			var d = new Date();
			var curr_date = d.getDate();
			var curr_month = d.getMonth() + 1; //Months are zero based
			var curr_year = d.getFullYear();
			
			var tgl = curr_date + "-" + curr_month + "-" + curr_year;
			
            var win=window.open('');
             with(win.document)
            {
			
              open();
			  win.document.title="Stok Opname "+tgl;
              write(msg);
              close();
            }
			 
            win.print();
        }
     });
});

</script>