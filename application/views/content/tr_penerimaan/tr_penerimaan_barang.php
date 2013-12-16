<div class="row-fluid">
    <div class="span9">
        <!--//***MAIN FORM-->
        <div class="bar" title="Show/Hide Form">
            <p>Form Pendataan Penerimaan Barang <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>

        <div id="konten" class="hide-con master-border">
        <form id="formID">
            <div class="field-wrap">
                Nomor BPB
                <input type='text' 
                class="upper-form validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" 
                maxlength="20" style="width:112px;" id='_bpb' name='_bpb'/>
            </div>
            <div class="field-wrap" style="">
                Gudang
                <input type="hidden" class="validate[required]" id="kd_gd" />
                <div class="input-append money" style="margin-bottom: 0px;">
                 <input type='text' class="validate[required] span2" 
                    maxlength="30" id="_gd" id='appendedInputButton' name='_gd' 
                    style="width: 134px; margin-bottom:8px;height: 24px;" onclick="lookup_gudang()"/>
                <a href="#modalGudang" role="button" class="btn padding-filter" data-toggle="modal" data-toggle="tooltip" title="Filter Gudang" onclick="listGudang()"><i class="icon-search"></i></a>
                </div>
            </div>
            <div class="field-wrap" style=" margin-left: 5px; ">
                No Reff Supplier
                <input type='text' class="span-form170 validate[required,maxSize[25], minSize[5]],custom[onlyNumberSp]" 
                        maxlength="25" id='_ref' name='_ref' onclick="disableAlpha('_ref')" style=" width: 150px; " />
            </div>
            <br/>
            <div class="field-wrap">
                Nomor PO
                <div id="no_po" style="margin-left:10px;" class="money"></div>
            </div>
            <div class="field-wrap">
                Supplier
                <input type="hidden" class="validate[required]" id="kd_sp" />
                <input type='text' class="span2" 
                    maxlength="30" id="_sp" id='appendedInputButton' name='_sp' style="width: 158px;" readonly="true">
            </div>
            <div class="field-wrap" style=" margin-left: 5px; ">
                Tgl BPB
                <input type='text' id='_tgl' name='_tgl' style="width: 80px;margin-left: 10px; margin-right: 20px;" >
            </div>
            <button id="add" mode="new" class="btn" data-toggle="tooltip" title="Tambah Barang" onclick="addBarang()"><i class="icon-plus"></i> Add Barang</button>
            <div class="field-wrap"></div>
            <div class="field-wrap"></div>
            <div class="field-wrap"></div>
            <div class="field-wrap"></div>
        </form>

            <div id="hasil2"></div>
            <!--**NOTIFICATION AREA**-->
            <div id="konfirmasi" class="sukses"></div>

            <div style="margin-top: 10px;"> 
                <?php if ($this->authorization->is_permitted('create_penerimaan') == true && $this->authorization->is_permitted('update_penerimaan') == false) : ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php elseif($this->authorization->is_permitted('update_penerimaan') == true && $this->authorization->is_permitted('create_penerimaan') == false): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="edit">Update</button>
                <?php elseif($this->authorization->is_permitted('update_penerimaan') == true && $this->authorization->is_permitted('create_penerimaan') == true): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php endif; ?>

                <?php if ($this->authorization->is_permitted('delete_penerimaan')) : ?>
                    <button id="delete" class="btn">Delete</button>
                <?php endif; ?>
                <button id="cancel" class="btn">Cancel</button>
                <?php if ($this->authorization->is_permitted('print_penerimaan')) : ?>
                    <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Penerimaan Barang"><i class="icon-print"></i> Print</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="span3">
        <div id="hasil"></div>
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
  <?php if ($this->authorization->is_permitted('create_gudang')) : ?>
    <a href="#modalNewGudang" role="button" class="btn btn-info" data-toggle="modal" onclick="addGudang()">Add Gudang</a>
  <?php endif; ?>
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
    <h3 id="myModalLabel">List Barang <input type="text" id="SearchBarang" placeholder="Search"></h3>
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
  <div class="modal-footer">
        <button id="saveGudang" class="btn btn-primary" mode="add">Save</button>
        <button id="cacGudang" class="btn" type="reset">Cancel</button>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script>
/*Tampilkan jQuery Tanggal*/
$(function() {
    $( "#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
});
$(document).ready(function(){
    $( "#_tgl" ).datepicker( "setDate", new Date());
    listBarang();
    listBPB();
    validation();
    barAnimation();
    tampilDetailBPB(); 
    autogen();
    get_po_list();
});

function cekauthorization(){
    <?php if ($this->authorization->is_permitted('create_penerimaan') == true && $this->authorization->is_permitted('update_penerimaan') == false) : ?>
        $('#save').attr('mode','add');
        $("#save").attr('disabled',false);
    <?php elseif($this->authorization->is_permitted('update_penerimaan') == true && $this->authorization->is_permitted('create_penerimaan') == false): ?>
         $('#save').attr('mode','edit');
         $("#save").attr('disabled',false);
    <?php else: ?>
         $('#save').attr('mode','add');
         $("#save").attr('disabled',false);
    <?php endif; ?>
}

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
    $('#cancel').attr('disabled',false);
    $('#delete').attr('disabled',true);
    $('#po').attr('disabled',false);

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
    var id = $('input:radio[name=optionsRadiosBarang]:checked').val();
    
    var row = filter;
    
    var arrs = document.getElementsByName('kode_brg[]');

    found_flag = false;
    for (i = 0; i < arrs.length; i++) {
        if (arrs[i].value === id) {
            found_flag = true;
            break;
        }
    }

    if (found_flag === true)
    {
        bootstrap_alert.warning('<b>Gagal Menambahkan Barang</b> Barang sudah ada');
    } else {
        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_barang/getSelectedRadio",
            data :{id:id},
            dataType: 'json',
            success:
            function(msg){
                $('#kode_brg'+row).val(id);
                $('#satuan_brg'+row).val(msg.Satuan);
                $('#nama_brg'+row).val(msg.Nama +" "+msg.Ukuran); 
                $('#harga_brg'+row).val(msg.Harga); 
            }
        }); 
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
    cekauthorization();
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
        {	var d = new Date();
			var curr_date = d.getDate();
			var curr_month = d.getMonth() + 1; //Months are zero based
			var curr_year = d.getFullYear();
			var tgl = curr_date + "-" + curr_month + "-" + curr_year;
			var win=window.open('');
			with(win.document)
			{
			  open();
			  win.document.title="Penerimaan Barang "+tgl;
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
                    bootstrap_alert.success('<b>Sukses</b> Data Penerimaan Barang '+_bpb+' berhasil ditambahkan');
					$('#formID').each(function(){
						this.reset();
					});
                    listBPB();
					tampilDetailBPB();
					autogen();
                    get_po_list();
					cekauthorization();
                }
                else{
                    bootstrap_alert.warning('<b>Gagal Menambahkan</b> Kode Penerimaan '+_bpb+' sudah ada');
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
                    bootstrap_alert.success('<b>Sukses</b> Update Penerimaan Barang '+_bpb+' berhasil dilakukan');
                    $('#formID').each(function(){
                            this.reset();
                    });
                    listBPB();
					tampilDetailBPB();
					autogen();
					cekauthorization();
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
                className: "pull-left"
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
                                bootstrap_alert.success('<b>Sukses</b> Penerimaan Barang '+_bpb+' telah dihapus');
                                $('#formID').each(function(){
                                    this.reset();
                                });
                               listBPB();
                               tampilDetailBPB();
                               autogen();
                               cekauthorization();
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
    items += "<td width='20%'><div class='input-append' style='margin-bottom:0;'><input type='text' class='span2' id='kode_brg"+$count+"' id='appendedInputButton' name='kode_brg[]' onkeypress='validAct($)' maxlength='20' style='width:83%' disabled='true'/><a href='#modalBarang' onclick='getDetail("+$count+")' id='f_brg"+$count+"' role='button' class='btn detail-append' data-toggle='modal' style='visibility: hidden;'><i class='icon-filter'></i></a></div></td>";
    items += "<td width='30%'><div class='input-append' style='margin-bottom:0;'><input type='text' class='span2' id='nama_brg"+$count+"' id='appendedInputButton' style='width:200px' disabled='true'/><a href='#modalBarang' onclick='getDetail("+$count+")' id='f_brgs"+$count+"' role='button' class='btn detail-append' data-toggle='modal' style='visibility: hidden;'><i class='icon-filter'></i></a></div></td>";
    items += "<td width='10%'><input type='text' name='satuan_brg' class='validate[required]' id='satuan_brg"+$count+"' style='width:55px;' readonly='true'/></td>";
    items += "<td width='10%'><input type='text' name='Nama' id='qty_brg"+$count+"' onkeypress='validAct("+$count+")' maxlength='5' class='validate[required]' style='width:45px' disabled='true'/></td>";
    items += "<td width='20%'><input type='text' name='keterangan' id='keterangan_brg"+$count+"' class='validate[required]' maxlength='22' style='width:80%' disabled='true'/></td>";
    items += "<td width='10%'><div class='btn-group' style='margin-bottom:0;'><a class='btn' href='#' onclick='editRow("+$count+")'><i id='icon"+$count+"' class='icon-pencil'></i></a><a class='btn' id='hapus' href='javascript:void(0);'><i class='icon-trash'></i></a></div></td></tr>";

    $("#itemlist").append(items);
}
</script>
