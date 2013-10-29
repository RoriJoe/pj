<!--Main Form-->
<div class="bar">
    <p>Form Pemesanan / PO <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border">
<form id="formID">
    <table width="100%">
        <tr>
            <td style="width: 120px;">Nomor PO</td>
            <td>
                <input  type='text' 
                        class="validate[requiredmaxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" 
                        id='po' name='po' 
                        style="width: 100px;text-transform: uppercase;">
            </td>

            <td>Permintaan</td>
            <td>
                <select name="permintaan" class="validate[required]" id="permintaan" style="width: 140px;">
                <option value="">- Pilih -</option>
                <option value="Tidak Ada">Tidak Ada</option>
                </select>
            </td>
       </tr>
       
       <tr>
            <td>Tanggal PO</td>
            <td>
                <input  type='text' 
                        class="validate[required,custom[date]]" id='_tgl1' name='_tgl1' 
                        style="width: 80px; margin-right: 20px;" >
            </td>
            <!--<td>Currency</td>
            <td>
                <select name="cur" class="validate[required]" id="cur">
                    <?php
                    foreach ($list_currency as $isi)
                    {
                        echo "<option ";
                        echo "value = '".$isi->value."'>".$isi->value."</option>";
                    }
                    ?>
                </select>

                <button type="button" id="tes" class="btn btn-mini" 
                        data-toggle="button"
                        data-html="true" data-placement="bottom"
                        rel="popover"
                        style="margin-bottom:3px;"
                        data-content="
                        <div>
                         <input  type='text' 
                            class='span2' id='txtCombo' id='appendedInput' name='txtCombo' 
                            style='width: 90px;margin-left: 10px;'
                            />
                        <button class='btn btn-primary btn-small' onclick='addCombo()'>Tambah</button>
                        </div>
                        
                        "
                        ><i class='icon-plus'></i></button>
            </td>-->
       </tr>
       <tr>
            <td>Tanggal Kirim</td>
            <td>
                <input  type='text' 
                        class="" id='_tgl2' name='_tgl2' 
                        style="width: 80px; margin-right: 20px;">
            </td>
            <td>Urgent</td>
            <td>
                <select name="urg" class="validate[required]" id="urg" style="width: 100px;">
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
                </select>
            </td>
       </tr>
      
        <tr>
        	<td>Kirim Ke</td>
            <td>
                <input  type="hidden" id="kd_gud" />

                <div    class="input-append" 
                        style="margin-bottom: 0;">

                	<input  type='text' placeholder="Gudang" 
                        class="validate[required,maxSize[20], minSize[2]] span2" maxlength="20" 
                        id="gud" id='appendedInputButton' name='gud'
                        style="width: 148px;"
                        onclick="lookup_gudang()">

                	<a  href="#modalGudang" id="filterGud" role="button" class="btn" 
                    	data-toggle="modal" data-toggle="tooltip" title="Filter Gudang" 
                    	style="padding: 2px 3px;" onclick="listGudang()"><i class="icon-filter"></i></a>
                </div>
            </td>
            <td>Supplier</td>
            <td>
                <input type="hidden" id="kd_sup" />
                <div class="input-append" style="margin-bottom: 0;">
                    <input  type='text' class="validate[required,maxSize[30], minSize[2]] span2" maxlength="30" 
                            id="sup" id='appendedInputButton' name='sup' 
                            style="width: 148px;" 
                            onclick="lookup_supplier()">

                <a  href="#modalSupplier" role="button" 
                    class="btn" data-toggle="modal" data-toggle="tooltip" 
                    title="Filter Supplier" 
                    style="padding: 2px 3px;" 
                    onclick="listSupplier()"><i class="icon-filter"></i></a>
                  
                </div>
                <a id="add" mode="new" class="btn btn-small" data-toggle="tooltip" title="Tambah Barang" onclick="addBarang()"><i class="icon-plus"></i> Barang</a>
            </td>
        </tr>
    </table>
    <p style="visibility: hidden;" id="kode_p" name="kode_p"/>
    <hr style="margin: 0;"/>
</form>
<div id="hasil2" style="height: 200px;"></div>
<div style="float: right;margin-right: -65px;">
    <table>
        <tr>
            <td width="50px">
                DPP
            </td>
            <td>
                <input  type="hidden" id="dpp2" />
                <input style="width:127px;text-align:right;" id="dpp" name="dpp" type="text" readonly="true">
            </td>
        </tr>
        <tr>
            <td>
                PPN
            </td>
            <td>
                <input style="width:20px;" class="" maxlength="2" id="ppn" name="ppn" type="text" onkeypress="hitung()"> % 
                <input style="width:68px;text-align:right;" id="ppnT" name="ppnT" type="text" onkeypress="hitung()">
            </td>
        </tr>
        <tr>
            <td>
                Total
            </td>
            <td>
            	<input type="hidden" id="kirim" />
                <input style="width:127px; margin-right: 145px;text-align:right;" id="total" name="total" type="text" readonly="true">
            </td>
        </tr>
    </table>
    
</div>
<div id="konfirmasi" class="sukses"></div>
<div>
    <button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
    <button id="delete" class="btn">Delete</button>
    <button id="cancel" class="btn">Cancel</button>
    <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Sales Order"><i class="icon-print"></i></button>
</div>
</div>


<!-- 
    Modal 
-->
<div id="modalSupplier" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Supplier</h3>
  </div>
  <div class="modal-body">
    <div id="list_supplier"></div>
  </div>
  <div class="modal-footer">
    <a href="#modalNewSupplier" role="button" class="btn btn-info" data-toggle="modal" onclick="addSupplier()">Add Supplier</a>
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

<div id="modalNewSupplier" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah Supplier</h3>
  </div>
  <div class="modal-body">
    <div id="add_supplier"></div>
  </div>
</div>

<!--@Load table List via AJAX-->
<div id="listPO"></div>

<script>  
    $("#tes").popover({ title: 'Tambah Currency'});
</script>  
<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script src="<?php echo base_url(); ?>assets/js/accounting.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	listPO();
    autogen();
    validation()
    barAnimation();
    tampilDetailPO();
});

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

$(function() {
    $( "#_tgl1").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
        setDate: new Date()
        
    });
    $( "#_tgl2").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
        setDate: new Date()
    });
    
});

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

function retrieveForm(idPO){
    var id = idPO;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_po/retrieveForm",
        data :{id:id},
        dataType: 'json',
        success:
        function(msg){
	        $('#_tgl1').val(msg.Tgl_Po);
	        $('#_tgl2').val(msg.Tgl_Kirim);
	        $('#permintaan').val(msg.Permintaan);
	        $('#kd_sup').val(msg.Kode_Supplier);
	        $('#sup').val(msg.Nama_Supplier);
	        $('#kd_gud').val(msg.Kode_Gudang);
	        $('#gud').val(msg.Nama_Gudang);
	        $('#dpp').val(accounting.formatMoney(msg.Dpp, "",0,"."));
	        $('#ppn').val(msg.Ppn);
	        $('#kirim').val(msg.Counter);

	        var total_PPN = msg.Dpp*msg.Ppn/100;
	        $('#ppnT').val(accounting.formatMoney(total_PPN, "",0,"."));
	        $('#total').val(accounting.formatMoney(msg.Total, "",0,"."));

        	setSelectedIndex(document.getElementById("urg"),msg.Urgent);
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

function listPO(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_po/index",
    data :{},
    success:
    function(hh){
        $('#listPO').html(hh);
    }
    });
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

function cek_kirim(){
    var id = $('#po').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_po/cek_kirim",
        data :{id:id},
        dataType: 'json',
        success:
        function(msg){
            $('#kirim').val(msg.Kirim);
        }
    });
}

//BUAT PRINT
 $("#print").click(function(){
	var po = $('#po').val();
    var _tgl1 = $('#_tgl1').val();
    var _tgl2 = $('#_tgl2').val();
    var kd_gud = $('#kd_gud').val();
    var proy = $('#proy').val();
    var permintaan = $('#permintaan').val();
    var cur = $('#cur').val();
    var urg = $('#urg').val();
    var kd_sup = $('#kd_sup').val();
    //COUNTER
    var kirim = $('#kirim').val();
    var count = parseInt(kirim)+1;
	
	var dpp = $('#dpp').val();
    var ppn = $('#ppnT').val();
    var to = $('#total').val();
    
    var arrKode = new Array();
    var arrHarga = new Array();
    var arrJumlah = new Array();
    var arrNilai = new Array();
	var arrNamabrg = new Array();
    var arrSatuan = new Array();
    
    var table = document.getElementById('tb_detail');
    var totalRow = table.rows.length;
    for(var i=1;i<=totalRow;i++){
        arrKode[i-1] = $('#kode_brg'+i).val();
        arrHarga[i-1] = $('#harga_brg'+i).val();
        arrJumlah[i-1] = $('#qty_brg'+i).val();
        arrNilai[i-1] = $('#jumlah_brg'+i).val(); 
		arrNamabrg[i-1] = $('#keterangan_brg'+i).val(); 
		arrSatuan[i-1] = $('#satuan_brg'+i).val(); 
    }
	
	$.ajax({
	        type:'POST',
	        url: "<?php echo base_url();?>index.php/report/print_transaksi_po",
	        data :{ po:po,_tgl1:_tgl1,_tgl2:_tgl2,kd_gud:kd_gud,proy:proy,permintaan:permintaan,cur:cur,urg:urg,kd_sup:kd_sup,count:count,
	                dpp:dpp,ppn:ppn,to:to,
                    arrKode:arrKode,arrHarga:arrHarga,arrJumlah:arrJumlah,arrNilai:arrNilai,totalRow:totalRow,arrNamabrg:arrNamabrg,
					arrSatuan:arrSatuan
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
				cek_kirim();
	        }
	     });
}); 

function autogen(){
    $('#add').attr('mode','new');
    $('#add').attr('disabled', false);

    $('#delete').attr('disabled', true);
    $("#po").attr('disabled',false);
    $("#total").val("");
    $("#dpp").val("");
    $("#ppn").val("");
    $("#ppnT").val("");
    
    
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_po/auto_gen",
    data :{},
    success:
        function(hh){
            $('#po').val(hh);
        }
    });
}


//Suggestion Supplier
function lookup_supplier(){
    $("#sup").autocomplete({
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
                        $("#sup").validationEngine('showPrompt', 'Data Supplier Tersedia', 'pass');
                    }else{
                        $("#sup").validationEngine('showPrompt', 'Data Supplier Tidak Tersedia', 'show');
                    }
                },
            });
        },
    select:
        function(event, ui) {
            $('#sup').val(ui.item.value);
            $('#kd_sup').val(ui.item.id);
            $("#sup").validationEngine('showPrompt', 'Data Supplier Tersedia', 'pass');
        },
    });
}

//Suggestion Gudang
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
                    }else{
                        $("#gud").validationEngine('showPrompt', 'Data Gudang Tidak Tersedia', 'show');
                    }
                },
            });
        },
    select:
        function(event, ui) {
            $('#gud').val(ui.item.value);
            $('#kd_gud').val(ui.item.id);
            $("#gud").validationEngine('showPrompt', 'Data Gudang Tersedia', 'pass');
        },
    });
}

//Table Supplier
function listSupplier(){
	$('#add').attr('disabled',false);
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
        url: "<?php echo base_url();?>index.php/ms_barang/viewBarang2",
        data :{},
        success:
        function(hh){
            $('#list_barang').html(hh);
        }
    });   
}

function tampilDetailPO(){
    var po = $('#po').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_po/tableDetail",
        data :{po:po},
        success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

//GET POPUP Supplier
function getSupplier(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
    $('#sup').val(x);
    $('#kd_sup').val(k);
    
}
//GET POPUP Gudang
function getGudang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('kd');

    $('#gud').val(x);
    $('#kd_gud').val(y);    
}
//GET POPUP Barang
function getBarang(){
    var x = $('input:radio[name=optionsRadiosBarang]:checked').val();
    var y = $('input:radio[name=optionsRadiosBarang]:checked').attr('satuan');
    var z = $('input:radio[name=optionsRadiosBarang]:checked').attr('nama');
    var o = $('input:radio[name=optionsRadiosBarang]:checked').attr('harga');
    var p = $('input:radio[name=optionsRadiosBarang]:checked').attr('ukuran');
    var row = filter;
    var array = [];

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
        bootstrap_alert.warning('<b>Gagal Menambahkan Barang</b> Barang sudah ada');
    } else {
        $('#kode_brg'+row).val(x);
        $('#keterangan_brg'+row).val(z +" "+p);
        $('#satuan_brg'+row).val(y);
        $('#harga_brg'+row).val(o); 
    }
}
    
//Radion Button response
/*
function radioRespons(){
    if(document.getElementById('optionsRadios1').checked){
        $('#gud').attr('disabled', false);
        $('#filterGud').attr('disabled', false);
        $('#proy').attr('disabled', true);
        $('#proy').val("");
    }else{
        $('#gud').attr('disabled', true);
        $('#filterGud').attr('disabled', true);
        $('#proy').attr('disabled', false);
        $('#gud').val("");
        $('#kd_gud').val("");
    }
}

/*
 * Add Currency
 */
function addCombo() {
    var cur = $('#txtCombo').val();
    if(cur !="")
    {
        $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_po/add_currency", //SEND TO CONTROLLER
        data :{cur:cur},

        success:
        function(msg) //GET MESSEGE FROM INSERT MODEL
        {
            if(msg == "ok")
            {
                bootstrap_alert.success('<b>Sukses</b> Currency sudah ditambahkan');
                
                var textb = document.getElementById("txtCombo");
                var combo = document.getElementById("cur");
                var option = document.createElement("option");
                option.text = textb.value;
                option.value = textb.value;
                
                try {
                    combo.add(option, null); //Standard
                }catch(error) {
                    combo.add(option); // IE only
                }
                
                textb.value = "";
            }
            else{
                bootstrap_alert.warning('<b>Gagal Menambahkan</b> Currency sudah ada');
            }
        }
        });
    }else{
        bootstrap_alert.warning('<b>Gagal Menambahkan</b> Field harus diisi!');
    }
}

function addRow() {
    var items = "";
    $count = $("tbody#itemlist tr").length+1;

    items += "<tr>";
    items += "<td width='17%'><div class='input-append'><input type='text' class='span2' id='kode_brg"+$count+"' onkeypress='validAct("+$count+")' maxlength='20' id='appendedInputButton' name='kode_brgd' style='width:98px; text-transform: uppercase;' disabled='true'/><a href='#modalBarang' onclick='getDetail("+$count+")' id='f_brg"+$count+"' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i></a></div></td>";
    items += "<td width='20%'><div class='input-append'><input type='text' name='nama_brg' class='span2' maxlength='22' id='keterangan_brg"+$count+"' style='width:120px' disabled='true'/><a href='#modalBarang' onclick='getDetail("+$count+")' id='f_brgs"+$count+"' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i></a></div></td>";
    items += "<td width='10%'><input type='text' name='satuan_brg' class='validate[required]' id='satuan_brg"+$count+"' style='width:65px;' readonly='true'/></td>";
    items += "<td width='7%'><input type='text' name='qty_brg' onkeypress='validAct("+$count+")' maxlength='5' class='validate[required]' id='qty_brg"+$count+"' style='width:30px' disabled='true'/></td>";
    items += "<td width='17%'><input type='text' name='harga_brg' onkeypress='validAct("+$count+")' maxlength='12' class='validate[required]' id='harga_brg"+$count+"' style='width:95px;text-align:right;' disabled='true' /></td>";
    items += "<td width='17%'><input type='text' name='jumlah' class='validate[required]' id='jumlah_brg"+$count+"' style='width:95px;text-align:right;' disabled='true'/></td>";
    items += "<td width='15%'><div class='btn-group' style='margin-bottom:0;'><a class='btn btn-small' href='#' onclick='editRow("+$count+")'><i id='icon"+$count+"' class='icon-pencil' ></i></a><a class='btn btn-small' id='hapus' href='javascript:void(0);'><i class='icon-trash'></i></a></div></td></tr>";

    $("#itemlist").append(items);
}


//Cancel
$("#cancel").click(function(){
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    tampilDetailPO();
    $('#save').attr('mode','add');
    document.getElementById('add').style.visibility = 'visible';
});

//Save Click
$("#save").click(function(){
    
    var mode = $('#save').attr("mode");
    
    //deklarasi variable
    var po = $('#po').val();
    var _tgl1 = $('#_tgl1').val();
    var _tgl2 = $('#_tgl2').val();
    var kd_gud = $('#kd_gud').val();
    var proy = $('#proy').val();
    var permintaan = $('#permintaan').val();
    var cur = $('#cur').val();
    var urg = $('#urg').val();
    var kd_sup = $('#kd_sup').val();

    var dpp = $('#dpp').val().replace(/\./g, "");
    var ppn = $('#ppn').val();
    var to = $('#total').val().replace(/\./g, "");
    
    var arrKode = new Array();
    var arrHarga = new Array();
    var arrJumlah = new Array();
    var arrNilai = new Array();
    
    var table = document.getElementById('tb_detail');
    var totalRow = table.rows.length;
    for(var i=1;i<=totalRow;i++){
        arrKode[i-1] = $('#kode_brg'+i).val();
        arrHarga[i-1] = $('#harga_brg'+i).val().replace(/\./g, "");
        arrJumlah[i-1] = $('#qty_brg'+i).val();
        arrNilai[i-1] = $('#jumlah_brg'+i).val().replace(/\./g, ""); 
    }

    var StartDate= document.getElementById('_tgl1').value;
      var EndDate= document.getElementById('_tgl2').value;
      var eDate = new Date(EndDate);
      var sDate = new Date(StartDate);

    if(mode == "add"){ //add mode
        /*if($('#gud').val() != ""){
            if(kd_sup == 0){
                bootstrap_alert.warning('<b>Gagal!</b> Data Gudang Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
            }
        }
        else */if(kd_sup == 0){
            bootstrap_alert.warning('<b>Gagal!</b> Data Supplier Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
        }
        else if(StartDate!= '' && StartDate!= '' && sDate> eDate)
        {
            bootstrap_alert.warning('<b>Gagal!</b> Pastikan Tanggal Kirim Setelah Tanggal PO');
        }
        else if($("#formID").validationEngine('validate') && totalRow != 0)
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_po/save/add",
            data :{po:po,_tgl1:_tgl1,_tgl2:_tgl2,kd_gud:kd_gud,proy:proy,permintaan:permintaan,cur:cur,urg:urg,kd_sup:kd_sup,dpp:dpp,ppn:ppn,to:to,
                    arrKode:arrKode,arrHarga:arrHarga,arrJumlah:arrJumlah,arrNilai:arrNilai,totalRow:totalRow
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Data '+po+' berhasil ditambahkan');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    listPO();
                    tampilDetailPO();
                    autogen();
                    $('#save').attr('mode','add');
                }
                else{
                    bootstrap_alert.warning('<b>Gagal!</b> Data sudah ada');
                }
            }
            });
        }else{
            bootstrap_alert.warning('<b>Gagal!</b> Masukkan Detail Barang & Pastikan Semua Field Terisi');
        }             
    }else if(mode == "edit"){ //Edit mode
        if(kd_sup == 0){
            bootstrap_alert.warning('<b>Gagal!</b> Data Supplier Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
        }
        else if(StartDate!= '' && StartDate!= '' && sDate> eDate)
        {
            bootstrap_alert.warning('<b>Gagal!</b> Pastikan Tanggal Kirim Setelah Tanggal PO');
        }
        else 
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_po/save/edit",
            data :{po:po,_tgl1:_tgl1,_tgl2:_tgl2,kd_gud:kd_gud,proy:proy,permintaan:permintaan,cur:cur,urg:urg,kd_sup:kd_sup,dpp:dpp,ppn:ppn,to:to,
                    arrKode:arrKode,arrHarga:arrHarga,arrJumlah:arrJumlah,arrNilai:arrNilai,totalRow:totalRow
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> data '+po+'  berhasil di Update');
                    $('#formID').each(function(){
                            this.reset();
                    });
                    listPO();
                    tampilDetailPO();
                    autogen();
                    $('#save').attr('mode','add');
                }
                else{
                    bootstrap_alert.warning('<b>Gagal!</b> Terjadi Kesalahan');
                }
            }
            });
        }
    }
});

$("#delete").click(function(){
    var po = $('#po').val();

    PlaySound('beep');
    var id = $('#po').val();
    var pr = $('#_tgl1').val();
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode PO: <b>"+id+"</b><br/>Tanggal PO: <b>"+pr+"</b>",
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
		            url: "<?php echo base_url();?>index.php/tr_po/delete",
		            data :{po:po
		            },
		            success:
		            function(msg)
		            {
		                if(msg == "ok")
		                {
		                    bootstrap_alert.success('<b>Sukses!</b> Data '+po+' telah dihapus');
		                    $('#formID').each(function(){
		                        this.reset();
		                    });
		                   listPO();
		                   tampilDetailPO();
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

</script>