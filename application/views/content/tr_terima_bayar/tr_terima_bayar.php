<script type="text/javascript">
function list_terima_bayar(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_terima_bayar/index",
    data :{},
    success:
    function(hh){
        $('#list_terima_bayar').html(hh);
    }
    });
}

list_terima_bayar();
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
    <p>Form Terima Pembayaran <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border">
<form id="formID">
    <table width="100%">
        <tr>
            <td style="width: 120px;">No Terima</td>
            <td>
                <input  type='text' 
                        class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" 
                        id='no_terima' name='no_terima' 
                        style="width: 120px;text-transform: uppercase;" disabled="disabled">
            </td>

             <td>Pelanggan</td>
            <td>
                <input type="hidden" id="kd_plg" />
                <div class="input-append" style="margin-bottom:0px;">
                 <input type='text' class="span2" disabled="disabled"
                    maxlength="20" id="_pn" id='appendedInputButton' name='_pn' style="width: 148px; margin-left: 10px;" onclick="lookup_pelanggan()" onkeydown="lookup_pelanggan()"/>
                <a href="#modalPelanggan" id="f_plg" role="button" class="btn" title="Search Pelanggan" data-toggle="modal" style="padding: 2px 3px;" onclick="listPelanggan()"><i class="icon-search"></i></a>
                </div>
            </td>
       </tr>
       
       <tr>
            <td>Tanggal</td>
            <td>
                <input  type='text' placeholder='dd-mm-yyyy'
                        class="validate[required,custom[date]]" id='_tgl1' name='_tgl1' value="<?php echo date('d-m-Y');?>" 
                        style="width: 80px; margin-right: 20px;">
            </td>
            
       </tr>
       
    </table>
</form>

<div id="pembayaran" style="float: right;">

</div>
<div id="invoice">

</div>


<div id="hasil2"></div>

<div>
    <button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
    <button id="delete" class="btn">Delete</button>
    <button id="cancel" class="btn">Cancel</button>
    <button id="print" class="btn"  data-toggle="tooltip" title="Print Invoice"><i class="icon-print"></i></button>
	<a href='#'id="addBank" mode="new" class="btn btn-small" title="Tambah JenisBank" onclick="addBank()" style="margin-left:30px;"><i class="icon-plus"></i></a>
</div>
</div>
<!--@Load table List via AJAX-->
<div id="list_terima_bayar"></div>
<div id="popup-wrapper3" style="width:750px;height:400px;"></div>
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
<div id="modalPelanggan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">List Pelanggan</h3>
	  </div>
	  <div class="modal-body">
		<div id="list_pelanggan"></div>
	  </div>
	  <div class="modal-footer">
		<a href="#modalNewPelanggan" role="button" class="btn btn-info" data-toggle="modal" onclick="addPelanggan()">Create Pelanggan</a>
	  </div>
</div>
<div id="modalNewPelanggan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah Pelanggan</h3>
  </div>
  <div class="modal-body">
    <div id="add_pelanggan"></div>
  </div>
</div>
<!--Le Script-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/alert.js"></script>
<script src="<?php echo base_url(); ?>assets/js/accounting.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    $( "#_tgl1").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
    });
});
    //load function here
$(document).ready(function(){
$( "#_tgl1" ).datepicker( "setDate", new Date());
    autogen();
    validation_engine();
    detail_SO();
	detail_pembayaran();
	detail_invoice()
	/* /* document.getElementById('add').style.visibility = 'hidden';
	document.getElementById('add2').style.visibility = 'hidden'; */
	document.getElementById('addBank').style.visibility = 'hidden'; 
});

function autogen(){
    $('#delete').attr('disabled', true);
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_terima_bayar/auto_gen",
    data :{},
    success:
        function(hh){
            $('#no_terima').val(hh);
        }
    });
}



function lookup_so(){
$("#invoice").autocomplete({
    minLength: 1,
    source:
    function(req, add){
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/autocomplete/lookup_invoice",
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
        $('#invoice').val(ui.item.value);
        
        detail_SO();
    },
});
}
function addPelanggan(){
    $('#modalPelanggan').modal('hide');
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_pelanggan/popPelanggan",
    data :{},
    success:
    function(hh){
        $('#add_pelanggan').html(hh);
    }
    });  
} 
function listPelanggan(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_terima_bayar/view_inv_pelanggan",
    data :{},
    success:
    function(hh){
        $('#list_pelanggan').html(hh);
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
function detail_SO(){
    var no = $('#no_terima').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_terima_bayar/Detail_SO",
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
        url: "<?php echo base_url();?>index.php/tr_terima_bayar/Detail_bayar",
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
        url: "<?php echo base_url();?>index.php/tr_terima_bayar/Detail_invo",
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
//GET POPUP pelanggan
function getPelanggan(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
    var t = $('input:radio[name=optionsRadios]:checked').attr('term');
    $('#_pn').val(x);
    $('#kd_plg').val(k);
    //$('#terms').val(t);
	var baris1 = $("tbody#itemlist tr").length;
	
	addInvoice();
}

function get_invoice_list($user_id,$row){
    var id = $user_id;
	var ro = $row;
    console.log(id);

    $.ajax({
        type:'POST',
        async: false,
        url: "<?php echo base_url();?>tr_terima_bayar/invoice_call",
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
        url: "<?php echo base_url();?>index.php/tr_terima_bayar/ambil_invoice",
        data :{invoice:invoice},
        success:
        function(hh){
            data=hh.split("|");
            //tampilDetailDO();
            $('#ninvo'+row).val(data[3]);
			document.getElementById('add2').style.visibility = 'visible';
        }
    });
}



function reset_form(){
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    detail_SO();
	detail_pembayaran();
	detail_invoice();
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
    var id = $('#no_terima').val();
	var kode_plg = $('#kd_plg').val();
    var _tgl = $('#_tgl1').val();
    var baris1 = $("tbody#itemlist tr").length;
	var totInv = $('#totInvo').val();
	var totByr = $('#totByr').val();
	
	var arrInvoice = new Array();
	var arrNbayar = new Array();
	var arrNinvo = new Array();
	 for(var i=1;i<=baris1;i++){
		arrInvoice[i-1] = $('#invoi'+i).val();
		arrNinvo[i-1] = $('#ninvo'+i).val().replace(/\./g, "");;
		arrNbayar[i-1] = $('#nbayar'+i).val().replace(/\./g, "");;
	 }
	 
	var baris2 = $("tbody#itemlist2 tr").length;
	var arrJenisB = new Array();
	var arrNilaiB = new Array();
	for(var i=1;i<=baris2;i++){
		arrJenisB[i-1] = $('#_sl'+i).val();
		arrNilaiB[i-1] = $('#nilaiB'+i).val();
		
	 }
	 
	var baris3 = $("tbody#itemlistdet tr").length;
	var arrJenis = new Array();
	var arrBank1 = new Array();
	var arrReken1 = new Array();
	var arrRef = new Array();
	var arrTgl1 = new Array();
	var arrTgl2 = new Array();
	var arrBank2 = new Array();
	var arrReken2 = new Array();
  
    for(var i=1;i<=baris3;i++){
		arrJenis[i-1] = $('#_sljenis'+i).val();
		arrBank1[i-1] = $('#_slbank'+i).val();
		arrReken1[i-1] = $('#reken'+i).val();
		arrRef[i-1] = $('#noref'+i).val();
		arrTgl1[i-1] = $('#_tglc1'+i).val();
		arrTgl2[i-1] = $('#_tglc2'+i).val();
		arrBank2[i-1] = $('#bank'+i).val();
		arrReken2[i-1] = $('#rek'+i).val();
		
	 }
   
    if(mode == "add"){ //add mode
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_terima_bayar/save/add",
            data :{id:id,_tgl:_tgl,kode_plg:kode_plg,totInv:totInv,totByr:totByr,
			baris1:baris1,baris2:baris2,baris3:baris3,arrInvoice:arrInvoice,
			 arrNbayar:arrNbayar,arrNinvo:arrNinvo,arrJenisB:arrJenisB,arrNilaiB:arrNilaiB,arrJenis:arrJenis,arrBank1:arrBank1,
	 arrReken1:arrReken1,arrRef:arrRef,arrTgl1:arrTgl1,arrTgl2:arrTgl2,arrBank2:arrBank2,arrReken2:arrReken2},

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Data berhasil ditambahkan');
                    reset_form();
                    list_terima_bayar();
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
            url: "<?php echo base_url();?>index.php/tr_terima_bayar/save/edit",
            data :{id:id,_tgl:_tgl,so:so,term:term},

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Update berhasil dilakukan');
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

    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_terima_bayar/delete",
        data :{id:id},
        success:
        function(msg)
        {
            if(msg == "ok")
            {
                bootstrap_alert.success('<b>Sukses!</b> Data telah dihapus');
                reset_form();
                list_terima_bayar();
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
    items += "<td> <input style='width:85px;margin-right: 5px;' id='ninvo"+$count+"' name='ninvo"+$count+"' type='text' readonly='true'></td>";
    items += "<td> <input style='width:85px;' id='nbayar"+$count+"' name='nbayar"+$count+"' type='text' readonly='true'></td></tr>";
	
    $("#itemlist").append(items);
}


function addBayar(){
    addRow2();
    var row = $("tbody#itemlist2 tr").length;
	
	/* var rowCombo=document.getElementById("invoi"+row).length-1;
	
	if(row==rowCombo){
	document.getElementById('add').style.visibility = 'hidden';
	}else{document.getElementById('add').style.visibility = 'visible';
	} */
    /* editRow(row);
    getDetail(row);
    $('#modalBarang').modal('show'); */
}

function addRow2() {
    var items = "";
    $count = $("tbody#itemlist2 tr").length+1;
	

    items += "<tr>";
    items += "<td><select name='_sl"+$count+"' class='jenisbayar' onchange='getJenisByr(this,"+$count+")' id='_sl"+$count+"' style='width: 110px; margin-left: 5px;'><option value=''>-Pilih-</option><option value='Tunai'>Tunai</option><option value='Bank'>Bank</option></select></td>";
   
    items += "<td> <input style='width:110px;' disabled='disabled' id='nilaiB"+$count+"' name='nilaiB"+$count+"' type='text' onkeypress='validAct("+$count+")'></td></tr>";
	
    $("#itemlist2").append(items);
}
//jenis bayar dari select jenis pembayaran
function getJenisByr(sel,row) {
    var value = sel.options[sel.selectedIndex].value;
	if(value==""){
		document.getElementById("nilaiB"+row).disabled = true;
	}else if(value=="Bank"){
		document.getElementById('addBank').style.visibility = 'visible';
		document.getElementById("nilaiB"+row).disabled = false;
	}else{
		document.getElementById('addBank').style.visibility = 'hidden';
		document.getElementById("nilaiB"+row).disabled = false;
	}	
}
/* $(".jenisbayar").live("change",function(){	
	$(".jenisbayar").each(function(){
		if($(this).val()==""){
			
		}else if($(this).val()=="Bank"){		
			document.getElementById('addBank').style.visibility = 'visible';
		}else{
		document.getElementById('addBank').style.visibility = 'hidden';
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

//FUNGSI HITUNG
    /* $('#nilaiB'+row).bind('textchange', function (event){
        var q = $(this).val();
        //var h = document.getElementById('harga_brg'+row).value.replace(/\./g, "");
       // hasil = q*h;
		totalbyr+=q
        $('#totByr').val(accounting.formatMoney(totalbyr, "",0,"."));
    });  */
    $('#nilaiB'+row).blur(function () {
    //$('#nilaiB'+row).bind('textchange', function (event){
        
		var h = $(this).val().replace(/\./g, "");
        
		var rowInvoice = $("tbody#itemlist tr").length;
        //getTotal();
        //formatAngka(this,'.');
		var nilaiInvo=$('#ninvo'+row).val();
		  if(h>nilaiInvo-0){
		
			$('#nbayar'+row).val(accounting.formatMoney(nilaiInvo, "",0,"."));
			if(rowInvoice>1){
			var x=h-nilaiInvo;
			var y=$('#ninvo'+(row+1)).val();
				if(x>y-0){
					$('#nbayar'+(row+1)).val(accounting.formatMoney(y, "",0,"."));
				}else{
					$('#nbayar'+(row+1)).val(accounting.formatMoney(x, "",0,"."));
				}
			
			}
		}/* else if(row>1){
			var nilaiA=$('#nbayar'+(row-1)).val().replace(/\./g, "");;
			var nilaiInvo2=$('#ninvo'+(row-1)).val();
			//$('#nbayar'+row).val(accounting.formatMoney(nilaiA+" "+nilaiInvo2, "",0,".")); 
			
			if(nilaiA<nilaiInvo2-0){
				var tambah = nilaiA*1+h*1;
				$('#nbayar'+(row-1)).val(accounting.formatMoney(tambah, "",0,".")); 
			}else{
				$('#nbayar'+(row-1)).val(accounting.formatMoney(nilaiInvo2, "",0,"."));
			}
		} */
		else {
			$('#nbayar'+row).val(accounting.formatMoney(h, "",0,"."));
			$('#totInvo'+row).val(accounting.formatMoney(h, "",0,"."));
		} 
		
	
		 
    });
}

function getTotal(row){
    var arr = document.getElementsById('nilaiB'+row);
    var total = 0;
    for(i=0; i < arr.length; i++){
        if(parseInt(arr[i].value))
            total += parseInt(arr[i].value.replace(/\./g, ""));
    }
    temp=total;
    $('#totByr').val(accounting.formatMoney(total, "",0,"."));
   /*  $("#dpp").val(accounting.formatMoney(total, "",0,"."));
    $("#granT").val(accounting.formatMoney(total, "",0,".")); */
   
}

</script>