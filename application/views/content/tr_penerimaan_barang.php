<script>
//Auto Generate
function autogen(){
    $('#add').attr('mode','new');
    $('#add').attr('mode','new');
    $('#save').attr('disabled',true);
    $('#cancel').attr('disabled',true);
    $('#add').attr('disabled',true);

    $('#delete').attr('disabled', true);
    $("#_bpb").attr('disabled',true);
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

//Suggestion Supplier
function lookup_supplier(){
    $("#_sp").autocomplete({
    minLength: 1,
    source:
        function(req, add){
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/autocomplete/looksupplier",
                dataType: 'json',
                type: 'POST',
                data: req,
                success:
                function(data){
                    if(data.response =="true"){
                        add(data.message);
                        $("#_sp").validationEngine('showPrompt', 'Data Supplier Tersedia', 'pass');
                    }
                    else
                    {
                        $("#_sp").validationEngine('showPrompt', 'Data Supplier Tidak Tersedia', 'show');
                    }
                },
            });
        },
    select:
        function(event, ui) {
            $('#_sp').val(ui.item.value);
            $('#kd_sp').val(ui.item.id);
            $("#_sp").validationEngine('showPrompt', 'Data Supplier Tersedia', 'pass');
        },
    });
}
//Validation engine
function validation_engine() {
    jQuery("#formID").validationEngine(
    {
        showOneMessage: true,
        ajaxFormValidation: true,
        ajaxFormValidationMethod: 'post',
        autoHidePrompt: true,
        autoHideDelay: 2500, 
        fadeDuration: 0.3
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

//Icon Animation
function animation(){
  jQuery(".hide-con").hide();
  var i = document.getElementById('konten');
  jQuery(".bar").click(function()
  {
        jQuery(this).next(".hide-con").slideToggle(500, function(){
        // Animation complete.
        if(i.style.display=="none"){
            document.getElementById('icon').className='icon-chevron-down icon-white';
        }else{
            document.getElementById('icon').className='icon-chevron-up icon-white';
            }
        });
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

//Table Barang
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

//Load Function
listBPB();
</script>


<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>

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
                <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" 
                maxlength="20" id='_bpb' name='_bpb' style="width: 170px; margin-left: 10px; margin-right: 20px;text-transform: uppercase;"/>
            </td>

            <td>Tgl BPB</td>
            <td>
                <input type='text' class="validate[required,custom[date]]" id='_tgl' name='_tgl' style="width: 80px;margin-left: 10px; margin-right: 20px;">
            </td>
       </tr>
       <tr>
            <td>Gudang</td>
            <td>
                <input type="hidden" class="validate[required]" id="kd_gd" />
                <div class="input-append">
                 <input type='text' class="validate[required,maxSize[25], minSize[5]] span2" 
                    maxlength="30" id="_gd" id='appendedInputButton' name='_gd' 
                    style="width: 148px; margin-left: 10px;" onclick="lookup_gudang()"/>
                <a href="#myModal" role="button" class="btn" data-toggle="modal" data-toggle="tooltip" title="Filter Gudang" style="padding: 2px 3px;" onclick="listGudang()"><i class="icon-filter"></i></a>
                  
                </div>
            </td>
       </tr>

       <tr>
            <td>Supplier</td>
            <td>
                <input type="hidden" class="validate[required]" id="kd_sp" />
                <div class="input-append">
                 <input type='text' class="validate[required,maxSize[30], minSize[5]] span2" 
                maxlength="30" id="_sp" id='appendedInputButton' name='_sp' style="width: 148px; margin-left: 10px;" onclick="lookup_supplier()">
                <a href="#myModal2" role="button" class="btn" data-toggle="modal" data-toggle="tooltip" title="Filter Supplier" style="padding: 2px 3px;" onclick="listSupplier()"><i class="icon-filter"></i></a>
                </div>
            </td>
            <td>Nomor Reff</td>
            <td>
            	<input type='text' class="validate[required,maxSize[25], minSize[7]],custom[onlyNumberSp]" 
                maxlength="25" id='_ref' name='_ref' style="width: 170px; margin-left: 10px; margin-right: 20px;" onclick="disableAlpha('_ref')" />
            </td>
        </tr>
    </table>
</form>

<div id="hasil2" style="height: 215px;"></div>
	
<div style="margin-top: 10px;">	
	<button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
    <button id="delete" class="btn" type="submit">Delete</button>
    <button id="cancel" class="btn" type="submit">Cancel</button>
    <button id="add" mode="new" class="btn" data-toggle="tooltip" title="Tambah Barang" onclick="addRow('tb3')"><i class="icon-plus"></i></button>
    <button id="print" class="btn"  data-toggle="tooltip" title="Print Penerimaan Barang"><i class="icon-print"></i></button>
    
</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Gudang</h3>
  </div>
  <div class="modal-body">
    <div id="list_gudang"></div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" onclick="getGudang()" data-dismiss="modal" aria-hidden="true">Done</button>
  </div>
</div>

<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


<div id="hasil"></div>

<script>
$(document).ready(function(){
    autogen();
    validation_engine()
    animation();
    tampilDetailBPB();
    key();
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

function disableAlpha($id){
    var foo = document.getElementById($id);
    foo.addEventListener('input', function (prev) {
    return function (evt) {
        if (!/^[0-9]*$/.test(this.value)) {
          this.value = prev;
        }
        else {
          prev = this.value;
        }
    };
    }(foo.value), false);
};



//GET POPUP PELANGGAN
function getGudang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
    $('#_gd').val(x);
    $('#kd_gd').val(k);
    
}

//GET POPUP SUPPLIER
function getSupplier(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
    $('#_sp').val(x);
    $('#kd_sp').val(k);
}

//GET POPUP Barang
function getBarang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('nama');
    var z = $('input:radio[name=optionsRadios]:checked').attr('ukuran');
    
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
        $('#nama_brg'+row).val(z);
        $('#ukuran_brg'+row).val(y);
    }
}
    
    
//ALERT
bootstrap_alert = function() {}
bootstrap_alert.warning = function(message) {
    $('#konfirmasi').html('<div class="alert alert-error" style="position:absolute; width:52%; "><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(5000).addClass("in").fadeOut(3000);
}
bootstrap_alert.success = function(message) {
    $('#konfirmasi').html('<div class="alert alert-success" style="position:absolute; width:52%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}
bootstrap_alert.info = function(message) {
    $('#konfirmasi').html('<div class="alert alert-info" style="position:absolute; width:52%;"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
}

//Cancel
$("#cancel").click(function(){
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    tampilDetailBPB();
    $('#save').attr('mode','add');
    document.getElementById('add').style.visibility = 'visible';
});

	//Tambah Row Barang
    function addRow(tableID) {
        var mode = $('#add').attr("mode");

        if (mode == "new"){
            $('#tb3 tbody').empty();
        }    
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        var last = rowCount;
       
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            
            //KOLOM 1
            var cell1 = row.insertCell(0);
            var iDiv2 = document.createElement("div");
            iDiv2.className = "input-append";
            iDiv2.id="kode_brg[]";
            
            var element0 = document.createElement("input");
            element0.type = "text";
            element0.name="kode_brgd";
            element0.className="validate[required]";
            element0.className="span2"; 
            element0.id="kode_brg"+last;
            element0.disabled = "true";
            element0.setAttribute("onkeypress", "validAct("+last+")");
            element0.style.width = "70px";
            
            var filter = document.createElement("a");
            filter.className="btn btn-tbl";
            filter.id="f_brg"+last;
            filter.href="#myModal3";
            filter.setAttribute("onclick", "getDetail("+last+")");
            filter.setAttribute("role", "button");
            filter.setAttribute("data-toggle", "modal");
            var iIcon3 = document.createElement("i");
            iIcon3.className = "icon-filter";
            
            filter.appendChild(iIcon3);
            iDiv2.appendChild(element0);
            iDiv2.appendChild(filter);
            cell1.appendChild(iDiv2);

            //KOLOM 2
            var cell1 = row.insertCell(1);
            var element1 = document.createElement("input");
            element1.type = "text";
            element1.name = "nama_brg[]";
            element1.disabled = "true";
            element1.id="nama_brg"+last;
            element1.style.width = "95px";
            cell1.appendChild(element1);
            
            //KOLOM 3
            var cell2 = row.insertCell(2);
            var element2 = document.createElement("input");
            element2.type = "text";
            element2.name = "ukuran_brg[]";
            element2.disabled = "true";
            element2.id="ukuran_brg"+last;
            element2.style.width = "75px";
            cell2.appendChild(element2);
            
            //KOLOM 4
            var cell3 = row.insertCell(3);
            var element3 = document.createElement("input");
            element3.type = "text";
            element3.name = "qty_brg";
            element3.id="qty_brg"+last;
            element3.setAttribute("onkeypress", "validAct("+last+")");
            element3.style.width = "45px";
            cell3.appendChild(element3);
           
            //KOLOM 5
            var cell5 = row.insertCell(4);
            var element5 = document.createElement("input");
            element5.type = "text";
            element5.name = "keterangan[]";
            element5.id="keterangan_brg"+last;
            element5.style.width = "80px";
            cell5.appendChild(element5);
            
            //KOLOM 6
            var cell6 = row.insertCell(5);
                        
            var iIcon1 = document.createElement("i");
            iIcon1.className = "icon-ok";
            iIcon1.id="icon"+last;
            var iIcon2 = document.createElement("i");
            iIcon2.className = "icon-trash";
            
            var iAnchor1 = document.createElement("a");
            iAnchor1.className = "btn";
            iAnchor1.href = "#";
            iAnchor1.setAttribute('onclick', 'editRow('+last+')')
            iAnchor1.appendChild(iIcon1);
            var iAnchor2 = document.createElement("a");
            iAnchor2.className = "btn";
            iAnchor2.setAttribute('onclick', 'deleteRow(this)')
            iAnchor2.href = "#";
            iAnchor2.appendChild(iIcon2);
            
            cell6.appendChild(iAnchor1);
            cell6.appendChild(iAnchor2);
        }
        
		
	//BUAT PRINT
 $("#print").click(function(){
		var _bpb = $('#_bpb').val();
        var _tgl = $('#_tgl').val();
        var _gd = $('#kd_gd').val();
        var _sp = $('#kd_sp').val();
        var _ref = $('#_ref').val();
		var table = document.getElementById('tb3');
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
				var win=window.open('about:blank');
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
    	var table = document.getElementById('tb3');
        var totalRow = table.rows.length-1;
        
		if(totalRow != 0 && $('#kode_brg1').val() != ""){
			
		var _mode = $('#save').attr("mode");
    	
        var _bpb = $('#_bpb').val();
        var _tgl = $('#_tgl').val();
        var _gd = $('#kd_gd').val();
        var _sp = $('#kd_sp').val();
        var _ref = $('#_ref').val();

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
	            data :{_bpb:_bpb,_tgl:_tgl,_gd:_gd,_sp:_sp,_ref:_ref,
	                    _arrKd_brg:_arrKd_brg, _arrQty:_arrQty, _arrKet:_arrKet, totalRow:totalRow
	            },
	
	            success:
	            function(msg)
	            {
	                if(msg == "ok")
	                {
	                    bootstrap_alert.success('<b>Sukses</b> Data sudah ditambahkan');
						$('#formID').each(function(){
							this.reset();
						});
	                    listBPB();
						tampilDetailBPB();
						autogen();
						$('#save').attr('mode','add');
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
            else if(_sp == 0){
            bootstrap_alert.warning('<b>Gagal!</b> Data Supplier Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
            }
            else 
        	if($("#formID").validationEngine('validate'))
        	{
        		$.ajax({
	            type:'POST',
	            url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/update",
	            data :{_bpb:_bpb,_tgl:_tgl,_gd:_gd,_sp:_sp,_ref:_ref,
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

         $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_penerimaan_barang/delete",
            data :{_bpb:_bpb
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Data telah dihapus');
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
    });
</script>
