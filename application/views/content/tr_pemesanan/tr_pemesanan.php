<script src="<?php echo base_url(); ?>assets/js/accounting.min.js" type="text/javascript"></script>

<script type="text/javascript">
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

listPO();
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
                        style="width: 170px;text-transform: uppercase;">
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
                        style="width: 80px; margin-right: 20px;">
            </td>
            <td>Currency</td>
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
            </td>
       </tr>
       <tr>
            <td>Tanggal Kirim</td>
            <td>
                <input  type='text' 
                        class="validate[required,custom[date]]" id='_tgl2' name='_tgl2' 
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
            <td colspan="2">
                <table>
                    <tr>
                        <td rowspan="2" width="90px;">Kirim Ke</td>
                        <td>
                            <input  type="radio" 
                                    name="kirim" id="optionsRadios1" value="option1" 
                                    onclick="radioRespons()" checked>

                            <input  type="hidden" id="kd_gud" />

                            <div    class="input-append" 
                                    style="margin-left: 10px;margin-bottom: 0;">

                            <input  type='text' placeholder="Gudang" 
                                    class="validate[required,maxSize[20], minSize[2]] span2" maxlength="20" 
                                    id="gud" id='appendedInputButton' name='gud'
                                    style="width: 148px;"
                                    onclick="lookup_gudang()">

                            <a  href="#modalGud" id="filterGud" role="button" class="btn" 
                                data-toggle="modal" data-toggle="tooltip" title="Filter Gudang" 
                                style="padding: 2px 3px;" onclick="listGudang()"><i class="icon-filter"></i></a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input  type="radio" name="kirim" id="optionsRadios2" value="option2" onclick="radioRespons()">
                            <input  type='text' disabled="disabled" placeholder="Proyek" 
                                    class="validate[required,maxSize[20], minSize[2]] span2" maxlength="20" 
                                    id="proy" id='appendedInputButton' name='proy' 
                                    style="width: 148px; margin-left: 10px;">              
                        </td>
                    </tr>
                </table>
            </td>
            <td>Supplier</td>
            <td>
                <input type="hidden" id="kd_sup" />
                <div class="input-append" style="margin-bottom: 0;">
                    <input  type='text' class="validate[required,maxSize[30], minSize[2]] span2" maxlength="30" 
                            id="sup" id='appendedInputButton' name='sup' 
                            style="width: 148px;" 
                            onclick="lookup_supplier()">

                <a  href="#modalSup" role="button" 
                    class="btn" data-toggle="modal" data-toggle="tooltip" 
                    title="Filter Supplier" 
                    style="padding: 2px 3px;" 
                    onclick="listSupplier()"><i class="icon-filter"></i></a>
                  
                </div>
            </td>
        </tr>
    </table>
    <p style="visibility: hidden;" id="kode_p" name="kode_p"/>
    <hr style="margin: 0;"/>
</form>
<div id="hasil2" style="height: 200px;"></div>
<div style="float: right;">
    <table>
        <tr>
            <td width="50px">
                DPP
            </td>
            <td>
                <input  type="hidden" id="dpp2" />
                <input style="width:200px;" id="dpp" name="dpp" type="text" readonly="true">
            </td>
        </tr>
        <tr>
            <td>
                PPN
            </td>
            <td>
                <input style="width:30px;" class="" maxlength="2" id="ppn" name="ppn" type="text" onclick="hitung()"> % <input style="width:135px;" id="ppnT" name="ppnT" type="text" readonly="true">
            </td>
        </tr>
        <tr>
            <td>
                Total
            </td>
            <td>
                <input  type="hidden" id="total2" />
                <input style="width:200px; margin-right: 145px;" id="total" name="total" type="text" readonly="true">
            </td>
        </tr>
    </table>
    
</div>
<div>
    <button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
    <button id="delete" class="btn">Delete</button>
    <button id="cancel" class="btn">Cancel</button>
    <button id="add" mode="new" class="btn" data-toggle="tooltip" title="Tambah Barang" onclick="addRow('tb3')"><i class="icon-plus"></i></button>
    <button id="print" class="btn"  data-toggle="tooltip" title="Print SO"><i class="icon-print"></i></button>
</div>
</div>


<!-- 
    Modal 
-->
<div id="modalSup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<div id="modalGud" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


<!--@Load table List via AJAX-->
<div id="listPO"></div>

<script>  
    $("#tes").popover({ title: 'Tambah Currency'});
</script>  

<script type="text/javascript">
$(document).ready(function() {
    autogen();
    animation();
    validation_engine();
    tampilDetailPO();
    key();
    //listBarang();
});
/*
template:
-Alert
-Animation
-Validation Engin
-Auto Generate Code
-Date Picker
*/
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
	
	var dpp = $('#dpp2').val();
    var ppn = $('#ppn').val().replace(/\./g, "");
    var to = $('#total2').val();
    
    var arrKode = new Array();
    var arrHarga = new Array();
    var arrJumlah = new Array();
    var arrNilai = new Array();
	var arrNamabrg = new Array();
    var arrSatuan = new Array();
    
    var table = document.getElementById('tb3');
    var totalRow = table.rows.length-1;
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
	        data :{ po:po,_tgl1:_tgl1,_tgl2:_tgl2,kd_gud:kd_gud,proy:proy,permintaan:permintaan,cur:cur,urg:urg,kd_sup:kd_sup, 
	                dpp:dpp,ppn:ppn,to:to,
                    arrKode:arrKode,arrHarga:arrHarga,arrJumlah:arrJumlah,arrNilai:arrNilai,totalRow:totalRow,arrNamabrg:arrNamabrg,
					arrSatuan:arrSatuan
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
				}
	        }
	     });
}); 

function autogen(){
    $('#add').attr('mode','new');
    $('#save').attr('disabled',true);
    $('#cancel').attr('disabled',true);
    $('#add').attr('disabled',true);

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

$(function() {
    $( "#_tgl1").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
    $( "#_tgl2").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
});

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
    /*var arrKode = new Array();
    
    var table = document.getElementById('tb3');
    var totalRow = table.rows.length-1;
    if(totalRow == 1){
        $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_barang/viewBarang",
        data :{},
        success:
        function(hh){
            $('#list_barang').html(hh);
        }
        });   
    }else{
        for(var i=1;i<=totalRow;i++){
            arrKode[i-1] = $('#kode_brg'+i).val();
        }

        $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_barang/checkBarang",
        data :{arrKode:arrKode,totalRow:totalRow},
        success:
        function(hh){
            $('#list_barang').html(hh);
        }
        });   
    }*/
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
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('satuan');
    var z = $('input:radio[name=optionsRadios]:checked').attr('nama');

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
        $('#keterangan_brg'+row).val(z);
        $('#satuan_brg'+row).val(y);
    }
/*
    var i = array.length;
    window.alert(array.length);
    if(array.length == 0){
        array.push(x);
        window.alert(array.length);
        $('#kode_brg'+row).val(x);
        $('#keterangan_brg'+row).val(z);
        $('#satuan_brg'+row).val(y);  
    }else{
        found_flag = false;
        for (i = 0; i < array.length; i++) {
            if (array[i][1] === x) {
                found_flag = false;
                break;
            }
        }

        if (found_flag === true)
        {
            alert(i);
        } else {
            alert('not found');
        }
    }*/
}
    
//Radion Button response
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

var filter="";

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
        element0.setAttribute("onkeypress", "validAct("+last+")");
        element0.disabled="true";
        element0.style.width = "70px";
        
        var filter = document.createElement("a");
        filter.className="btn btn-tbl";
        filter.id="f_brg"+last;
        filter.href="#myModal2";
        filter.setAttribute("onclick", "getDetail("+last+")");
        filter.setAttribute("role", "button");
        filter.setAttribute("data-toggle", "modal");
        var iIcon3 = document.createElement("i");
        iIcon3.className = "icon-filter";
        
        filter.appendChild(iIcon3);
        iDiv2.appendChild(element0);
        iDiv2.appendChild(filter);
        cell1.appendChild(iDiv2);
        //KOLOM 
        var cell1 = row.insertCell(1);
        var element1 = document.createElement("input");
        element1.type = "text";
        element1.name = "keterangan[]";
        element1.id="keterangan_brg"+last;
        element1.style.width = "80px";
        element1.disabled = "true";
        cell1.appendChild(element1);
        //KOLOM 2
        var cell1 = row.insertCell(2);
        var element1 = document.createElement("input");
        element1.type = "text";
        element1.name = "qty_brg";
        element1.id="qty_brg"+last;
        element1.setAttribute("onkeypress", "validAct("+last+")");
        element1.style.width = "30px";
        cell1.appendChild(element1);
        
        //KOLOM 3
        var cell2 = row.insertCell(3);
        var element2 = document.createElement("input");
        element2.type = "text";
        element2.name = "satuan_brg[]";
        element2.disabled = "true";
        element2.id="satuan_brg"+last;
        element2.style.width = "70px";
        cell2.appendChild(element2);
        
        //KOLOM 4
        var cell3 = row.insertCell(4);
        var element3 = document.createElement("input");
        element3.type = "text";
        element3.name = "harga[]";
        element3.id="harga_brg"+last;
        element0.setAttribute("onkeypress", "validAct("+last+")");
        element3.style.width = "70px";
        cell3.appendChild(element3);
        //KOLOM 5
        var cell4 = row.insertCell(5);
        var element4 = document.createElement("input");
        element4.type = "text";
        element4.name = "jumlah";
        element4.id="jumlah_brg"+last;
        element4.style.width = "70px";
        element4.disabled = "true";
        cell4.appendChild(element4);

        //KOLOM 7
        var cell6 = row.insertCell(6);
                    
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
        iAnchor2.setAttribute('onclick', 'deleteRowSO(this)')
        iAnchor2.href = "#";
        iAnchor2.appendChild(iIcon2);
        
        cell6.appendChild(iAnchor1);
        cell6.appendChild(iAnchor2);
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
    var dpp = $('#dpp2').val();
    var ppn = $('#ppn').val().replace(/\./g, "");
    var to = $('#total2').val();
    
    var arrKode = new Array();
    var arrHarga = new Array();
    var arrJumlah = new Array();
    var arrNilai = new Array();
    
    var table = document.getElementById('tb3');
    var totalRow = table.rows.length-1;
    for(var i=1;i<=totalRow;i++){
        arrKode[i-1] = $('#kode_brg'+i).val();
        arrHarga[i-1] = $('#harga_brg'+i).val();
        arrJumlah[i-1] = $('#qty_brg'+i).val();
        arrNilai[i-1] = $('#jumlah_brg'+i).val(); 
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
        else if($("#formID").validationEngine('validate') && $("#total").val() != 0)
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
                    bootstrap_alert.success('<b>Sukses!</b> Data berhasil ditambahkan');
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
                    bootstrap_alert.success('<b>Sukses!</b> Update berhasil dilakukan');
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
                bootstrap_alert.success('<b>Sukses!</b> Data telah dihapus');
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
});

</script>