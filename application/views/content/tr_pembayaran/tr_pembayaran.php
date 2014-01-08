<div class="row-fluid">
    <div class="span9">
        <!--Main Form-->
        <div class="bar" title="Show/Hide Form">
            <p>Form Pembayaran <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>
        <div id="konten" class="hide-con" style="max-height:440px;height:440px;">
            <form id="formID">
                <table>
                    <tr>
                        <td>No Pembayaran</td>
                        <td>
                            <input  type='text' 
                                    class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" 
                                    id='no_terima' name='no_terima' 
                                    style="width: 120px;text-transform: uppercase;" disabled="disabled">
                        </td>

                        <td>Supplier</td>
                        <td>
                            <input type="hidden" id="kd_plg" />
                            <div class="input-append money" style="margin-bottom:0px;">
                             <input type='text' class="span2" disabled="disabled"
                                maxlength="20" id="_pn" id='appendedInputButton' name='_pn' style="width: 148px;" onclick="lookup_pelanggan()" onkeydown="lookup_pelanggan()"/>
                            <a href="#modalSupplier" style="margin-bottom:5px;" id="f_plg" role="button" class="btn padding-filter" title="Search Supplier" data-toggle="modal" onclick="listSupplier()"><i class="icon-search"></i></a>
                            </div>
                        </td>

                        <td>Tanggal</td>
                        <td>
                            <input  type='text' placeholder='dd-mm-yyyy'
                                    class="validate[required,custom[date]]" id='_tgl1' name='_tgl1' value="<?php echo date('d-m-Y');?>" 
                                    style="width: 80px; margin-right: 20px;">
                        </td> 
                   </tr>   
                </table>
            </form>

            <div class="row-fluid">
                <div class="span6">
                    <div id="invoice"></div>
                </div>

                <div class="offset1 span5">
                    <div id="pembayaran"></div>
                </div>
            </div> 

            <div id="hasil2"></div>

            <div id="konfirmasi" class="sukses"></div>

            <div>
                <?php if ($this->authorization->is_permitted('create_bayar') == true && $this->authorization->is_permitted('update_bayar') == false) : ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php elseif($this->authorization->is_permitted('update_bayar') == true && $this->authorization->is_permitted('create_bayar') == false): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="edit">Update</button>
                <?php elseif($this->authorization->is_permitted('update_bayar') == true && $this->authorization->is_permitted('create_bayar') == true): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php endif; ?>

                <?php if ($this->authorization->is_permitted('delete_bayar')) : ?>
                    <button id="delete" class="btn">Delete</button>
                <?php endif; ?>
                <button id="cancel" class="btn">Cancel</button>
                <?php if ($this->authorization->is_permitted('print_bayar')) : ?>
                    <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Pembayaran"><i class="icon-print"></i> Print</button>
                <?php endif; ?>

                <a href='#'id="addBank" mode="new" class="btn" title="Tambah JenisBank" onclick="addBank()" style="margin-left:30px;"><i class="icon-plus"></i> Bank</a>
                <input type="hidden" id="kdban" />
            </div>
        </div>
    </div>

    <div class="span3">
        <!--@Load table List via AJAX-->
        <div id="list_terima_bayar"></div>
    </div>
</div>

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

<div id="modalSupplier" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Supplier</h3>
  </div>
  <div class="modal-body">
    <div id="list_supplier"></div>
  </div>
</div>

<!--Le Script-->
<script src="<?php echo base_url(); ?>assets/js/accounting.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>

<script type="text/javascript">
    //load function here
$(document).ready(function(){
    list_terima_bayar();
    autogen();
    validation();
    detail_PO();
	detail_pembayaran();
	detail_invoice()
    //barAnimation();
	/* /* document.getElementById('add').style.visibility = 'hidden';
	document.getElementById('add2').style.visibility = 'hidden'; */
	document.getElementById('addBank').style.visibility = 'hidden'; 
});

function cekauthorization(){
    <?php if ($this->authorization->is_permitted('create_bayar') == true && $this->authorization->is_permitted('update_bayar') == false) : ?>
        $('#save').attr('mode','add');
        $("#save").attr('disabled',false);
    <?php elseif($this->authorization->is_permitted('update_bayar') == true && $this->authorization->is_permitted('create_bayar') == false): ?>
         $('#save').attr('mode','edit');
         $("#save").attr('disabled',false);
    <?php else: ?>
         $('#save').attr('mode','add');
         $("#save").attr('disabled',false);
    <?php endif; ?>
}

function list_terima_bayar(){
    $('#loadingDiv').show()
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_pembayaran/index",
    data :{},
    success:
    function(hh){
        setTimeout(function () {
            $('#list_terima_bayar').html(hh);
            $('#loadingDiv').hide()
        }, 1500); 
    }
    });
}

function autogen(){
    $('#delete').attr('disabled', true);
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_pembayaran/auto_gen",
    data :{},
    success:
        function(hh){
            $('#no_terima').val(hh);
        }
    });

    $("#_tgl1").datepicker({
        changeMonth: true,
        changeYear: true,
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        language: "id",
        autoclose: true
    });
    $( "#_tgl1").datepicker('setValue', new Date());
}



function addSupplier(){
    $('#modalSupplier').modal('hide');
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_supplier/popSupplier",
    data :{},
    success:
    function(hh){
        $('#add_supplier').html(hh);
    }
    });  
} 
function listSupplier(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_pembayaran/view_supplier",
    data :{},
    success:
    function(hh){
        $('#list_supplier').html(hh);
    }
    });   
}
function lookup_pelanggan(){
    $("#_pn").autocomplete({
    minLength: 1,
    source:
        function(req, add){
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/autocomplete/lookpn",
                dataType: 'json',
                type: 'POST',
                data: req,
                success:
                function(data){
                    if(data.response =="true"){
                        add(data.message);
                        $("#_pn").validationEngine('showPrompt', 'Data Pelanggan Tersedia', 'pass');
                    }else{
                        $("#_pn").validationEngine('showPrompt', 'Data Pelanggan Tidak Tersedia', 'show');
                    }
                },
            });
        },
    select:
        function(event, ui) {
            $('#_pn').val(ui.item.value);
            $('#kd_plg').val(ui.item.id);
            $("#_pn").validationEngine('showPrompt', 'Data Pelanggan Tersedia', 'pass');
        },
    });
}
function detail_PO(){
    var no = $('#no_terima').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_pembayaran/Detail_PO",
        data :{no:no},
        success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

function detail_pembayaran(){
    var no = $('#no_terima').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_pembayaran/Detail_bayar",
        data :{no:no},
        success:
        function(hh){
           $('#pembayaran').html(hh);
		   document.getElementById('add2').style.visibility = 'hidden';
        }
    });
}

function detail_invoice(){
    var no = $('#no_terima').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_pembayaran/Detail_invo",
        data :{no:no},
        success:
        function(hh){
           $('#invoice').html(hh);
		   document.getElementById('add').style.visibility = 'hidden';
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


function getSupplier(){
	
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
    $('#_pn').val(x);
    $('#kd_plg').val(k);
    //$('#terms').val(t);
	var baris1 = $("tbody#itemlist tr").length;
	if(baris1>0){
		$("tbody#itemlist tr").remove();
	}
	addInvoice();
    
}

function get_invoice_list($user_id,$row){
    var id = $user_id;
	var ro = $row;
    console.log(id);

    $.ajax({
        type:'POST',
        async: false,
        url: "<?php echo base_url();?>tr_pembayaran/po_call",
        data:{id:id,ro:ro},
        dataType: "html",

        success: function(data){
            $('#no_invoice'+$row).html(data);
        }
    });
}

function displayResult(selTag,row)
{
	//$('#invoi'+row).attr({ disabled: 'disabled' });
    var invoice=selTag.options[selTag.selectedIndex].text;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_pembayaran/ambil_invoice",
        data :{invoice:invoice},
        success:
        function(hh){
            data=hh.split("|");
            //tampilDetailDO();
            $('#ninvo'+row).val(accounting.formatMoney(data[4], "",0,"."));
			
			document.getElementById('add2').style.visibility = 'visible';
        }
    });
}



function reset_form(){
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    detail_PO();
	detail_pembayaran();
	detail_invoice();
    $('#total1').val('');
    $('#total').val('');
    cekauthorization();
}
//Cancel
$("#cancel").click(function(){
    reset_form();
});

//Save Click
$("#save").click(function(){
    
    var mode = $('#save').attr("mode");
    
    //deklarasi variable
    var id = $('#no_terima').val();
	var kode_plg = $('#kd_plg').val();
    var _tgl = $('#_tgl1').val();
    var baris1 = $("tbody#itemlist tr").length;
	var totInv = $('#totInvo').val().replace(/\./g, "");
	var totByr = $('#totByr').val().replace(/\./g, "");
	
	var arrInvoice = new Array();
	var arrNbayar = new Array();
	var arrNinvo = new Array();
	 for(var i=1;i<=baris1;i++){
		arrInvoice[i-1] = $('#invoi'+i).val();
		arrNinvo[i-1] = $('#ninvo'+i).val().replace(/\./g, "");
		arrNbayar[i-1] = $('#nbayar'+i).val().replace(/\./g, "");
	 }
	 
	var baris2 = $("tbody#itemlist2 tr").length;
	var arrJenisB = new Array();
	var arrNilaiB = new Array();
	for(var i=1;i<=baris2;i++){
		arrJenisB[i-1] = $('#_sl'+i).val();
		arrNilaiB[i-1] = $('#nilaiB'+i).val().replace(/\./g, "");
		
	 }
	 
	var baris3 = $("tbody#itemlistdet tr").length;
	var arrJenis = new Array();
	var arrBank1 = new Array();
	var arrReken1 = new Array();
	var arrRef = new Array();
	var arrTgl1 = new Array();
	var arrTgl2 = new Array();
	var arrNil = new Array();
	var arrBank2 = new Array();
	var arrReken2 = new Array();
  
    for(var i=1;i<=baris3;i++){
		arrJenis[i-1] = $('#_sljenis'+i).val();
		arrBank1[i-1] = $('#_slbank'+i).val();
		arrReken1[i-1] = $('#reken'+i).val();
		arrRef[i-1] = $('#noref'+i).val();
		arrTgl1[i-1] = $('#_tglc1'+i).val();
		arrTgl2[i-1] = $('#_tglc2'+i).val();
		arrNil[i-1] = $('#nilaitr'+i).val().replace(/\./g, "");
		arrBank2[i-1] = $('#bank'+i).val();
		arrReken2[i-1] = $('#rek'+i).val();
		
	 }
   
    if(mode == "add"){ //add mode
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_pembayaran/save/add",
            data :{id:id,_tgl:_tgl,kode_plg:kode_plg,totInv:totInv,totByr:totByr,
			baris1:baris1,baris2:baris2,baris3:baris3,arrInvoice:arrInvoice,
			 arrNbayar:arrNbayar,arrNinvo:arrNinvo,arrJenisB:arrJenisB,arrNilaiB:arrNilaiB,arrJenis:arrJenis,arrBank1:arrBank1,arrNil:arrNil,
	 arrReken1:arrReken1,arrRef:arrRef,arrTgl1:arrTgl1,arrTgl2:arrTgl2,arrBank2:arrBank2,arrReken2:arrReken2},

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Data Pembayaran '+id+' berhasil ditambahkan');
                    reset_form();
                    list_terima_bayar();
                }
                else{
                    bootstrap_alert.warning('<b>Gagal!</b> Kode Pembayaran sudah ada');
                }
            }
            });
        }
        else
        {
            bootstrap_alert.warning('<b>Gagal!</b> Pilih Supplier & Pastikan Semua Field Terisi');
        }             
    }else if(mode == "edit"){ //Edit mode
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_pembayaran/save/edit",
            data :{id:id,_tgl:_tgl,so:so,term:term},

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Update Pembayaran '+id+' berhasil dilakukan');
                    reset_form();
                    list_terima_bayar();
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
    var id = $('#no_terima').val();
	var tgl = $('#_tgl1').val();
    
	
	bootbox.dialog({
        message: "No Pembayaran: <b>"+id+"</b><br/>Tanggal Pembayaran : <b>"+tgl+"</b>",
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
						url: "<?php echo base_url();?>index.php/tr_pembayaran/delete",
						data :{id:id},
						success:
						function(msg)
						{
							if(msg == "ok")
							{
								bootstrap_alert.success('<b>Sukses!</b> Data Penerimaan Tagihan '+id+' telah dihapus');
								reset_form();
								list_terima_bayar();
							}
						}
					});
                }
            }
        }
    });
});
function addInvoice(){
	
	
    addRow();
    var row = $("tbody#itemlist tr").length;
	get_invoice_list($('#kd_plg').val(),row);
	var rowCombo=document.getElementById("invoi"+row).length-1;
	
	if(row==rowCombo){
	document.getElementById('add').style.visibility = 'hidden';
	}else{document.getElementById('add').style.visibility = 'visible';
	}
    /* editRow(row);
    getDetail(row);
    $('#modalBarang').modal('show'); */
}

function addRow() {
    var items = "";
    $count = $("tbody#itemlist tr").length+1;
	

    items += "<tr>";
    items += "<td><div id='no_invoice"+$count+"'></div></td>";
    items += "<td> <input style='width:100px;text-align: right;' id='ninvo"+$count+"' name='ninvo"+$count+"' type='text' readonly='true'></td>";
    items += "<td> <input style='width:100px;text-align: right;' id='nbayar"+$count+"' name='nbayar"+$count+"' type='text' readonly='true'></td></tr>";
	
    $("#itemlist").append(items);
}


function addBayar(){
    addRow2();
    var row = $("tbody#itemlist2 tr").length;
	
	
    /* editRow(row);
    getDetail(row);
    $('#modalBarang').modal('show'); */
}

function addRow2() {
    var items = "";
    $count = $("tbody#itemlist2 tr").length+1;
	

    items += "<tr>";
    items += "<td><select name='_sl"+$count+"' class='jenisbayar' onchange='getJenisByr(this,"+$count+")'  id='_sl"+$count+"' style='width: 130px; margin-left: 5px;'><option value=''>-Pilih-</option><option value='Tunai'>Tunai</option><option value='Bank'>Bank</option><option value='Biaya'>Biaya Bank</option><option value='Discount'>Discount</option></select></td>";
   
    items += "<td> <input style='width:130px;text-align: right;'  disabled='disabled' id='nilaiB"+$count+"' name='nilaiB' type='text' onkeypress='validAct("+$count+")'></td></tr>";
	
    $("#itemlist2").append(items);
}
//jenis bayar dari select jenis pembayaran  onchange='getJenisByr(this,"+$count+")'

function getJenisByr(sel,row) {
	var flag=0;
	var value = sel.options[sel.selectedIndex].value;
	$(".jenisbayar").each(function(){
		
		if($(this).val()=="Bank"){
					
			flag=1;
		}
	});  
    
	if(value=="Bank"){
	
		$('#kdban').val("nilaiB"+row);
		document.getElementById("nilaiB"+row).value="";
		document.getElementById("nilaiB"+row).disabled = true;
		document.getElementById('addBank').style.visibility = 'visible';
		addBank();
		
	}else{
		document.getElementById('addBank').style.visibility = 'hidden';
		document.getElementById("nilaiB"+row).disabled = false;
		if(flag==0){
				$("tbody#itemlistdet tr").remove();
		}
	}
	
}
/* $(".jenisbayar").live("change",function(){
	var id = $(this).attr('id');	
	$(".jenisbayar").each(function(){
		
		if($(this).val()=="Bank"){
					
			document.getElementById('addBank').style.visibility = 'visible';
			addBank();
		}else{
		
		document.getElementById('addBank').style.visibility = 'hidden';
			if($("tbody#itemlistdet tr").length>0){
				$("tbody#itemlistdet tr").remove();
			}
		}
	});  
});  */

function addBank(){
    addRow3();
    var row = $("tbody#itemlistdet tr").length;
	get_bank_list(row);
	
}

function addRow3() {
    var items = "";
    $count = $("tbody#itemlistdet tr").length+1;
	

    items += "<tr>";
    items += "<td><select name='_sljenis"+$count+"' class='validate[required]' id='_sljenis"+$count+"' onchange='getJenis(this,"+$count+")' style='width: 90px; margin-left: 5px;'><option value=''>-Pilih-</option><option value='Transfer'>Transfer</option><option value='Cek'>Cek</option><option value='Giro'>Giro</option><option value='Tabungan'>Tabungan</option></select></td>";
    items += "<td><select name='_slbank"+$count+"'  class='validate[required]' id='_slbank"+$count+"'  style='width: 80px; margin-left: 5px;'><option value=''>-Pilih-</option><option value='CIMB'>CIMB</option><option value='BCA'>BCA</option></select></td>";
    items += "<td><input style='width:60px;margin-right: 5px;' id='reken"+$count+"' name='reken"+$count+"' type='text' ></td>";
	items += "<td><input style='width:60px;margin-right: 5px;' id='noref"+$count+"' name='noref"+$count+"' type='text' ></td>";
	items += "<td><input style='width:65px;margin-right: 5px;' id='_tglc1"+$count+"' name='_tglc1"+$count+"' type='text' autocomplete='off' ></td>";
	items += "<td><input style='width:60px;margin-right: 5px;' id='_tglc2"+$count+"' name='_tglc2"+$count+"' type='text' autocomplete='off' ></td>";
	items += "<td><input style='width:60px;margin-right: 5px;text-align: right;' id='nilaitr"+$count+"' name='nilaitr' onkeyup='valid("+$count+")' type='text' autocomplete='off' ></td>";
	
	items += "<td><div id='trmbank"+$count+"'></div></td>";
	items += "<td><div id='trmrek"+$count+"'><select style='width:105px;'><option>-Rek-</option></select></div></td></tr>";
	
    $("#itemlistdet").append(items);
	
	$( "#_tglc1"+$count).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
        defaultDate: new Date()
    });
    $( "#_tglc2"+$count).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
    });
}


//bank list
function get_bank_list($row){
   
	var ro = $row;
    //console.log(id);

    $.ajax({
        type:'POST',
        async: false,
        url: "<?php echo base_url();?>tr_terima_bayar/bank_call",
        data:{ro:ro},
        dataType: "html",

        success: function(data){
            $('#trmbank'+$row).html(data);
        }
    });
}

function displayResult2(selTag,row)
{
	//$('#invoi'+row).attr({ disabled: 'disabled' });
    var bank=selTag.options[selTag.selectedIndex].text;
	var ro = row;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_terima_bayar/rek_call",
        data :{bank:bank,ro:ro},
        success:
        function(hh){
			$('#trmrek'+row).html(hh);

        }
    });
}

function getJenis(sel,row) {
    var value = sel.options[sel.selectedIndex].value;
	if(value=="Transfer"){
		document.getElementById("_tglc1"+row).disabled = true;
		document.getElementById("_tglc2"+row).disabled = true;
	}else{
		document.getElementById("_tglc1"+row).disabled = false;
		document.getElementById("_tglc2"+row).disabled = false;
	}	
}
totalbyr=0;
temp=0;
function validAct(row){
       
    	
    //disable alfabet di qty
    var foo = document.getElementById('nilaiB'+row);
    foo.addEventListener('input', function (prev) {
        return function (evt) {
            if (!/^\d{0,9}(?:\.\d{0,2})?$/.test(this.value)) {
              this.value = prev;
            }
            else {
              prev = this.value;
            }
        };
    }(foo.value), false);


    $('#nilaiB'+row).blur(function () {
    //$('#nilaiB'+row).bind('textchange', function (event){
        
		var h = $(this).val().replace(/\./g, "");
        
		var rowInvoice = $("tbody#itemlist tr").length;
        //getTotal();
        //formatAngka(this,'.');
		var nilaiInvo=$('#ninvo'+row).val();
		   
		
	
		 getTotal();
		 formatAngka(this,'.');
    });
}

function getTotal(){
    var arr = document.getElementsByName('nilaiB');
    var total = 0;
    for(i=0; i < arr.length; i++){
        if(parseInt(arr[i].value))
            total += parseInt(arr[i].value.replace(/\./g, ""));
    }
    temp=total;
    $('#totByr').val(accounting.formatMoney(total, "",0,"."));
	
	var rowIn = $("tbody#itemlist tr").length;
        
	var totIn=0;
	var arrIno = new Array();
	 for(i=0; i < rowIn; i++){
	 
		arrIno[i] = $('#ninvo'+(i+1)).val().replace(/\./g, "");
		totIn+=parseInt(arrIno[i]);
			
	} 
	
	if(total>totIn){
		
		$('#totInvo').val(accounting.formatMoney(totIn, "",0,"."));
		for(i=0; i < rowIn; i++){
			$('#nbayar'+(i+1)).val(accounting.formatMoney(arrIno[i], "",0,"."));
		}
	}else if(total<=totIn){
	
		for(i=0; i < rowIn; i++){
			if(total>arrIno[i]){
				$('#totInvo').val(accounting.formatMoney(total, "",0,"."));
				$('#nbayar'+(i+1)).val(accounting.formatMoney(arrIno[i], "",0,"."));
				$('#nbayar'+(i+2)).val(accounting.formatMoney(total-arrIno[i], "",0,"."));
				break;
			}else{
				$('#totInvo').val(accounting.formatMoney(total, "",0,"."));
				$('#nbayar'+(i+1)).val(accounting.formatMoney(total, "",0,"."));
				$('#nbayar'+(i+2)).val(accounting.formatMoney('', "",0,"."));
				break;
			}
		}
	}
   
}
function formatAngka(objek, separator) {
  a = objek.value;
  b = a.replace(/[^\d]/g,"");
  c = "";
  panjang = b.length;
  j = 0;
  for (i = panjang; i > 0; i--) {
    j = j + 1;
    if (((j % 3) == 1) && (j != 1)) {
      c = b.substr(i-1,1) + separator + c;
    } else {
      c = b.substr(i-1,1) + c;
    }
  }
  objek.value = c;
}

function valid(row){
       
    	
    //disable alfabet di qty
    var foo = document.getElementById('nilaiB'+row);
    foo.addEventListener('input', function (prev) {
        return function (evt) {
            if (!/^\d{0,9}(?:\.\d{0,2})?$/.test(this.value)) {
              this.value = prev;
            }
            else {
              prev = this.value;
            }
        };
    }(foo.value), false);


    $('#nilaitr'+row).blur(function () {
    //$('#nilaiB'+row).bind('textchange', function (event){
        
		var h = $(this).val().replace(/\./g, "");
        
		
        //getTotal();
        //formatAngka(this,'.');
		var nilaiInvo=$('#ninvo'+row).val();
		 
		
		getTotal2();
		formatAngka(this,'.');
    });
}

function getTotal2(){
getTotal();
    var arr = document.getElementsByName('nilaitr');
	var b = $('#kdban').val();
	
    var total = 0;
    for(i=0; i < arr.length; i++){
        if(parseInt(arr[i].value))
            total += parseInt(arr[i].value.replace(/\./g, ""));
    }
    temp=total;
   // $('#totByr').val(accounting.formatMoney(total, "",0,"."));
   $('#'+b).val(accounting.formatMoney(total, "",0,"."));
}

</script>