<!--//***MAIN FORM-->
<div class="bar">
    <p>Form Pendataan Penerimaan Barang <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border">
<form id="formID">
    <table width="100%">
        <tr>
            <td>Nomor BPB</td>
            <td>
                <input type='text' 
                class="span-form75 upper-form validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" 
                maxlength="20" id='_bpb' name='_bpb'/>
            </td>

            <td>Tgl BPB</td>
            <td>
                <input type='text' id='_tgl' name='_tgl' style="width: 80px;margin-left: 10px; margin-right: 20px;" value="<?php echo date('d-m-Y');?>">
            </td>
       </tr>
       <tr>
            <td>Gudang</td>
            <td>
                <input type="hidden" class="validate[required]" id="kd_gd" />
                <div class="input-append" style="margin-bottom: 0px;">
                 <input type='text' class="validate[required] span2" 
                    maxlength="30" id="_gd" id='appendedInputButton' name='_gd' 
                    style="width: 148px; margin-left: 10px;" onclick="lookup_gudang()"/>
                <a href="#modalGudang" role="button" class="btn" data-toggle="modal" data-toggle="tooltip" title="Filter Gudang" style="padding: 2px 3px;" onclick="listGudang()"><i class="icon-search"></i></a>
                  
                </div>
            </td>
            <td>
                Nomor PO
            </td>
            <td>
                <div id="no_po" style="margin-left:10px;">
                </div>
            </td>
       </tr>

       <tr>
            <td>Supplier</td>
            <td>
                <input type="hidden" class="validate[required]" id="kd_sp" />
                 <input type='text' class="span2" 
                maxlength="30" id="_sp" id='appendedInputButton' name='_sp' style="width: 148px; margin-left: 10px;" readonly="true">
            </td>
            <td>No Reff Supplier</td>
            <td>
            	<input type='text' class="span-form170 validate[required,maxSize[25], minSize[5]],custom[onlyNumberSp]" 
                maxlength="25" id='_ref' name='_ref' onclick="disableAlpha('_ref')" />
            </td>
        </tr>
    </table>
</form>

    <div id="hasil2"></div>
    <!--**NOTIFICATION AREA**-->
    <div id="konfirmasi" class="sukses"></div>

    <div style="margin-top: 10px;">	
    	<button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
        <button id="delete" class="btn" type="submit">Delete</button>
        <button id="cancel" class="btn" type="submit">Cancel</button>
        <button id="add" mode="new" class="btn" data-toggle="tooltip" title="Tambah Barang" onclick="addBarang()"><i class="icon-plus"></i> Barang</button>
        <button id="print" class="btn"  data-toggle="tooltip" title="Print Penerimaan Barang"><i class="icon-print"></i></button>   
    </div>
</div>

<!-- Modal -->
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

<div id="modalSupplier" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Supplier</h3>
  </div>
  <div class="modal-body">
    <div id="list_supplier"></div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" onclick="getSupplier()" data-dismiss="modal" aria-hidden="true">Done</button>
  </div>
</div>

<div id="modalBarang" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Barang</h3>
  </div>
  <div class="modal-body">
    <div id="list_barang"></div>
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
</div>


<div id="hasil"></div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script>
$(document).ready(function(){
    listBPB();
    validation();
    barAnimation();
    tampilDetailBPB();
    key_tr(); 
    autogen();
    get_po_list();
});

//Tampilkan Table yg disamping Via AJAX
function listBPB(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
    });
} 

//Auto Generate
function autogen(){
    $('#add').attr('disabled',true);
    $('#cancel').attr('disabled',false);
    $('#delete').attr('disabled',true);

    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/auto_gen",
    data :{},
    success:
        function(hh){
            $('#_bpb').val(hh);
        }
    });
}

//Tampilkan SO sesuai pelanggan
function get_po_list(){
    $.ajax({
        type:'POST',
        async: false,
        url: "<?php echo base_url();?>tr_penerimaan_barang/po_call",
        dataType: "html",

        success: function(data){
            $('#no_po').html(data);
        }
    });
}

//Suggestion Gudang
function lookup_gudang(){
    $("#_gd").autocomplete({
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
                        $("#_gd").validationEngine('showPrompt', 'Data Gudang Tersedia', 'pass');
                    }
                    else
                    {
                        $("#_gd").validationEngine('showPrompt', 'Data Gudang Tidak Tersedia', 'show');
                    }
                },
            });
        },
    select:
        function(event, ui) {
            $('#_gd').val(ui.item.value);
            $('#kd_gd').val(ui.item.id);
            $("#_gd").validationEngine('showPrompt', 'Data Supplier Tersedia', 'pass');
        },
    });
}

/*Tampilkan jQuery Tanggal*/
$(function() {
    $( "#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
});

function get_po_data(){
    var po = $('#po').val();
    $.ajax({ //utk tabel detail
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/viewPOdata",
        data :{po:po},
        dataType: 'json',
        success:
        function(msg){
            $('#_gd').val(msg.Gudang);
            $('#kd_gd').val(msg.Kode_Gudang);
            $('#_sp').val(msg.Supplier);
            $('#kd_sp').val(msg.Kode_Supplier);

            $('#add').attr('disabled',false);
        }
    });

    $.ajax({ //utk tabel detail
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/viewPO",
        data :{po:po},
        success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

//fungsi untuk menampilkan Table Detail *table bawah*//
function tampilDetailBPB(){
    var bpb = $('#_bpb').val();
    $.ajax({ //utk tabel detail DO
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/DetailTable",
        data :{bpb:bpb},
        success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

//Table Supplier
function listSupplier(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_supplier/viewSupplier",
    data :{},
    success:
    function(hh){
        $('#list_supplier').html(hh);
    }
    });   
}

//GET POPUP SUPPLIER
function getSupplier(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
    $('#_sp').val(x);
    $('#kd_sp').val(k);
}

//Table Gudang
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

//GET POPUP 
function getGudang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
    $('#_gd').val(x);
    $('#kd_gd').val(k);
    
}

//Table Barang
function listBarang(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_barang/viewBarang2",
    data :{},
    success:
    function(hh){
        $('#list_barang').html(hh);
    }
    });   
}

//GET POPUP Barang
function getBarang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('nama');
    var z = $('input:radio[name=optionsRadios]:checked').attr('ukuran');
    
    var row = filter;

    var arrs = document.getElementsByName('kode_brg[]');

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
        $('#nama_brg'+row).val(z);
        $('#ukuran_brg'+row).val(y);
    }
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

 function addBarang(){
    addRow();
    var row = $("tbody#itemlist tr").length;
    editRow(row);
    getDetail(row);
    $('#modalBarang').modal('show');
 }

function resetForm(){
    $('#formID').each(function(){
        this.reset();
    });
    key_tr(); 
    autogen();
    tampilDetailBPB();
    get_po_list();
    document.getElementById('add').style.visibility = 'visible';
    $('#save').attr('mode','add');
    $('#po').attr('disabled',false);
}
//Cancel
$("#cancel").click(function(){
    resetForm();
});
	//BUAT PRINT
 $("#print").click(function(){
		var _bpb = $('#_bpb').val();
        var _tgl = $('#_tgl').val();
        var _gd = $('#kd_gd').val();
        var _sp = $('#kd_sp').val();
        var _ref = $('#_ref').val();

		var table = document.getElementById('tb_detail');
		var totalRow = table.rows.length-1;
        //detail bpb
        var _arrKd_brg = new Array();
        var _arrQty = new Array();
        var _arrKet = new Array();
		var _arrNm_brg = new Array();
        var _arrUkur = new Array();
        
        for(var i=1;i<=totalRow;i++){
            _arrKd_brg[i-1] = $('#kode_brg'+i).val();
			_arrNm_brg[i-1] = $('#nama_brg'+i).val();
			_arrUkur[i-1] = $('#ukuran_brg'+i).val();
            _arrQty[i-1] = $('#qty_brg'+i).val();
            _arrKet[i-1] = $('#keterangan_brg'+i).val();
        }
	
	$.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/report/print_transaksi_penerimaan",
        data :{ _bpb:_bpb,_tgl:_tgl,_gd:_gd,_sp:_sp,_ref:_ref,
                    _arrKd_brg:_arrKd_brg, _arrQty:_arrQty, _arrKet:_arrKet,_arrNm_brg:_arrNm_brg,_arrUkur:_arrUkur, totalRow:totalRow
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
              win.print();
			}
        }
     });
}); 	
		
//Save Click
$("#save").click(function(){

	var table = document.getElementById('tb_detail');
    var totalRow = table.rows.length;
    
	if(totalRow != 0 && $('#kode_brg1').val() != ""){
		
	var _mode = $('#save').attr("mode");
	
    var _bpb = $('#_bpb').val();
    var _tgl = $('#_tgl').val();
    var _gd = $('#kd_gd').val();
    var _sp = $('#kd_sp').val();
    var _ref = $('#_ref').val();
    var po = $('#po').val();

    //detail bpb
    var _arrKd_brg = new Array();
    var _arrQty = new Array();
    var _arrKet = new Array();
    
    for(var i=1;i<=totalRow;i++){
        _arrKd_brg[i-1] = $('#kode_brg'+i).val();
        _arrQty[i-1] = $('#qty_brg'+i).val();
        _arrKet[i-1] = $('#keterangan_brg'+i).val();
    }

	
    if(_mode == "add") //add mode
    {
        if(_gd == 0){
        bootstrap_alert.warning('<b>Gagal!</b> Data Gudang Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
        }
        else if(_sp == 0){
        bootstrap_alert.warning('<b>Gagal!</b> Data Supplier Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
        }
    	else if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/insert",
            data :{_bpb:_bpb,_tgl:_tgl,_gd:_gd,_sp:_sp,_ref:_ref,po:po,
                    _arrKd_brg:_arrKd_brg, _arrQty:_arrQty, _arrKet:_arrKet, totalRow:totalRow
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Data '+_bpb+' sudah ditambahkan');
					$('#formID').each(function(){
						this.reset();
					});
                    listBPB();
					tampilDetailBPB();
					autogen();
                    get_po_list();
					$('#save').attr('mode','add');
                }
                else{
                    bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data '+_bpb+' sudah ada');
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
        else if(_sp == 0){
        bootstrap_alert.warning('<b>Gagal!</b> Data Supplier Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
        }
        else 
    	if($("#formID").validationEngine('validate'))
    	{
    		$.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/update",
            data :{_bpb:_bpb,_tgl:_tgl,_gd:_gd,_sp:_sp,_ref:_ref,po:po,
                    _arrKd_brg:_arrKd_brg, _arrQty:_arrQty, _arrKet:_arrKet, totalRow:totalRow
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Update berhasil dilakukan');
                    $('#formID').each(function(){
                            this.reset();
                    });
                    listBPB();
					tampilDetailBPB();
					autogen();
					$('#save').attr('mode','add');
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
    var _bpb = $('#_bpb').val();

    PlaySound('beep');
    var id = $('#_bpb').val();
    var pr = $('#_tgl').val();
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode BPB: <b>"+id+"</b><br/>Tanggal BPB : <b>"+pr+"</b>",
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
                    url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/delete",
                    data :{_bpb:_bpb},
                    success:
                        function(msg)
                        {
                            if(msg == "ok")
                            {
                                bootstrap_alert.success('<b>Sukses</b> Data '+_bpb+' telah dihapus');
                                $('#formID').each(function(){
                                    this.reset();
                                });
                               listBPB();
                               tampilDetailBPB();
                               autogen();
                               $('#save').attr('mode','add');
                            }
                        }
                    });
                }
            }
        }
    });
});

function addRow() {
    var items = "";
    $count = $("tbody#itemlist tr").length+1;

    items += "<tr>";
    items += "<td width='20%'><div class='input-append' style='margin-bottom:0;'><input type='text' class='span2' id='kode_brg"+$count+"' id='appendedInputButton' name='kode_brg[]' onkeypress='validAct($)' maxlength='20' style='width:100%' disabled='true'/><a href='#modalBarang' onclick='getDetail("+$count+")' id='f_brg"+$count+"' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i></a></div></td>";
    items += "<td width='30%'><div class='input-append' style='margin-bottom:0;'><input type='text' class='span2' id='nama_brg"+$count+"' id='appendedInputButton' style='width:98%' disabled='true'/><a href='#modalBarang' onclick='getDetail("+$count+")' id='f_brgs"+$count+"' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i></a></div></td>";
    items += "<td width='10%'><input type='text' name='Nama' id='qty_brg"+$count+"' onkeypress='validAct("+$count+")' maxlength='5' class='validate[required]' style='width:45px' disabled='true'/></td>";
    items += "<td width='20%'><input type='text' name='keterangan' id='keterangan_brg"+$count+"' class='validate[required]' maxlength='22' style='width:80%' disabled='true'/></td>";
    items += "<td width='10%'><div class='btn-group' style='margin-bottom:0;'><a class='btn btn-small' href='#' onclick='editRow("+$count+")'><i id='icon"+$count+"' class='icon-pencil'></i></a><a class='btn btn-small' id='hapus' href='javascript:void(0);'><i class='icon-trash'></i></a></div></td></tr>";

    $("#itemlist").append(items);
}
</script>