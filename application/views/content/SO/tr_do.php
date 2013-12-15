<div class="row-fluid">
    <div class="span9">
        <!--//***MAIN FORM-->
        <div class="bar" title="Show/Hide Form">
            <p>Form Sales Order <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>
        <div id="konten" class="hide-con master-border" style="height: 360px;">
        <form id="formID">
            <table>
                <tr>
                    <td>Nomor SO</td>
                    <td>
                        <input type='text' class="form100 upper-form validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" id='_so' name='_so'/>
                    </td>
                    <td>Tgl SO</td>
                    <td>
                        <input type='text' class="form70 validate[custom[date]]"  id='_tgl' name='_tgl' value="<?php echo date('d-m-Y');?>" />
                    </td>
                    <td>Pelanggan</td>
                    <td>
                        <input type="hidden" id="kd_plg" />
                        <div class="input-append money" style="margin-bottom:0px;">
                            <input type='text' class="span2" disabled="disabled" maxlength="20" id="_pn" id='appendedInputButton' name='_pn' style="width: 135px;margin-bottom:8px;height: 24px;" onclick="lookup_pelanggan()" onkeydown="lookup_pelanggan()"/>
                            <a href="#modalPelanggan" id="f_plg" role="button" class="btn" title="Search Pelanggan" data-toggle="modal" style="padding: 0px 5px;margin-bottom: 8px;" onclick="listPelanggan()"><i class="icon-search"></i></a>
                        </div>
                    </td>
                    <td>Terms</td>
                    <td>
                        <input type='text' class="validate[required,maxSize[3],custom[onlyNumberSp]]" style="width:40px;" maxlength="3" id='terms' name='terms'/> Hari
                    </td>
                </tr>
                <tr>
                    <td>Nomor PO</td>
                    <td>
                        <input type='text' class="form100 validate[custom[onlyLetterNumber]]" maxlength="20" id='_po' name='_po'>
                    </td>
                    <td>Tgl PO</td>
                    <td>
                        <input type='text' class="form70 validate[custom[date]]" placeholder="Tgl PO" id='_tgl2' name='_tgl2'/>
                    </td>
                    <td>Sales</td>
                    <td>
                        <select name="_sl" class="validate[required]" id="_sl" style="width: 160px;">
                            <?php
                            foreach ($list_sales as $isi)
                            {
                                echo "<option ";
                                echo "value = '".$isi->Nama."'>".$isi->Nama."</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td colspan="2"><a href='#'id="add" mode="new" class="btn" title="Tambah Barang" onclick="addBarang()"><i class="icon-plus"></i>Add Barang</a></td>
                </tr>
            </table>
        </form>

        <div id="hasil2" style="height: 170px;"></div>

            <div style="float: right; margin-right: 75px;">
			
                <table>
                <tr>
                    <td><label style="float: left; margin-right: 10px;"><b>Total</b> </label>
                    </td>
                    <td><input type="hidden" id="total2" />
                    <input class="no-margin-b"  style="float: right; width:120px; margin-right: 145px;text-align:right;" id="total" name="total" type="text" readonly="true"></td>
                </tr>
                <tr>
                    <td><label style="float: left; margin-right: 10px;"><b>Discount</b> </label>
                    </td>
                    <td><input type="hidden" id="disc2" />
                    <input class="no-margin-b" style="width:20px; " maxlength="2" id="disc" name="disc" type="text" onkeypress="hitung()">%
                    <input class="no-margin-b" style="width:70px;text-align:right;" onkeypress="hitung()" id="discT" name="discT" type="text"/>
                    </td>
                </tr>
                <tr>
                    <td><label style="float: left; margin-right: 10px;"><b>DPP</b> </label>
                    </td>
                    <td><input type="hidden" id="dpp2" />
                    <input class="no-margin-b" style="width:120px; margin-right: 145px;text-align:right;" id="dpp" name="dpp" type="text" readonly="true"></td>
                </tr>
                 <tr>
                        <td>
                            <label style="float: left; margin-right: 10px;"><b>PPN</b> </label>
                        </td>
                        <td>
                            <input class="no-margin-b" style="width:20px;" class="" maxlength="2" id="ppn" name="ppn" type="text" onkeypress="hitungPPN()">% 
                            <input class="no-margin-b" style="width:70px;text-align:right;" id="ppnT" name="ppnT" type="text" onkeypress="hitungPPN()">
                        </td>
                </tr> 
                <tr>
                    <td><label style="float: left; margin-right: 10px;"><b>Grand Total</b> </label>
                    </td>
                    <td><input type="hidden" id="granT2" />
                    <input class="no-margin-b" style="width:120px; text-align:right;" id="granT" name="granT" type="text" readonly="true"></td>
                </tr>      
                </table>
            </div>
            <div class="field-wrap">
                <?php if ($this->authorization->is_permitted('create_so') == true && $this->authorization->is_permitted('update_so') == false) : ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php elseif($this->authorization->is_permitted('update_so') == true && $this->authorization->is_permitted('create_so') == false): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="edit">Update</button>
                <?php elseif($this->authorization->is_permitted('update_so') == true && $this->authorization->is_permitted('create_so') == true): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php endif; ?>

                <?php if ($this->authorization->is_permitted('delete_so')) : ?>
                    <button id="delete" class="btn">Delete</button>
                <?php endif; ?>
                <button id="cancel" class="btn">Cancel</button>
                <?php if ($this->authorization->is_permitted('print_so')) : ?>
                    <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Sales Order"><i class="icon-print"></i> Print</button>
                <?php endif; ?>
                <button id="batal" class="btn btn-danger" style="visibility:hidden;">Batal SO</button>
            </div>
            <!--**NOTIFICATION AREA**-->
            <div id="konfirmasi" class="sukses"></div>
        </div>
    </div>

    <div class="span3">
        <div id="hasil"></div>
    </div>
</div>

<!-- Modal -->
<div id="modalPelanggan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Pelanggan <input type="text" id="SearchPelanggan" placeholder="Search"></h3>
  </div>
  <div class="modal-body">
    <div id="list_pelanggan"></div>
  </div>
  <div class="modal-footer">
    <?php if ($this->authorization->is_permitted('create_pelanggan')) : ?>
        <a href="#modalNewPelanggan" role="button" class="btn btn-info" data-toggle="modal" onclick="addPelanggan()">Create Pelanggan</a>
    <?php endif; ?>
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

<div id="modalNewPelanggan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah Pelanggan</h3>
  </div>
  <div class="modal-body">
    <div id="add_pelanggan"></div>
  </div>
  <div class="modal-footer">
    <button id="savePelanggan" class="btn btn-primary" mode="add">Save</button>
    <button id="cencelPelanggan" class="btn" type="reset">Cancel</button>
  </div>
</div>


<div id="list_barang"></div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/accounting.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
    listSO();
    tampilDetailSO();
    autogen();
    validation()
    barAnimation();
    listBarang();
});

function cekauthorization(){
    <?php if ($this->authorization->is_permitted('create_so') == true && $this->authorization->is_permitted('update_so') == false) : ?>
        $('#save').attr('mode','add');
        $("#save").attr('disabled',false);
    <?php elseif($this->authorization->is_permitted('update_so') == true && $this->authorization->is_permitted('create_so') == false): ?>
         $('#save').attr('mode','edit');
         $("#save").attr('disabled',false);
    <?php else: ?>
         $('#save').attr('mode','add');
         $("#save").attr('disabled',false);
    <?php endif; ?>

    <?php if ($this->authorization->is_permitted('print_so') == true) : ?>
        $("#print").attr('disabled',false);
    <?php endif; ?>
}


/*Tampilkan jQuery Tanggal*/
$(function() {
    $( "#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
        defaultDate: new Date()
    });
    $( "#_tgl2").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
    });
});

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

function addBarang(){
    addRow();
    var row = $("tbody#itemlist tr").length;
    editRow(row);
    getDetail(row);
    $('#modalBarang').modal('show');
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

$("#_so").keypress(function(e){
   var userVal = $("#_so").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Kode 20 Karakter');
   } 
});

$("#_po").keypress(function(e){
   var userVal = $("#_po").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Kode 20 Karakter');
   } 
});

//Tampilkan Table yg disamping Via AJAX
function listSO(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_do/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
    });
}
function retrieveForm(idSO){
    var id = idSO;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_do/retrieveForm",
        data :{id:id},
        dataType: 'json',
        success:
        function(msg){
            $('#_po').val(msg.Po);
            $('#_tgl').val(msg.Tgl);
            $('#_tgl2').val(msg.Tgl_Po);
            $('#kd_plg').val(msg.Kode_Plg);
            $('#_pn').val(msg.Nama_Plg);
            $('#_sl').val(msg.Otorisasi);
            $('#terms').val(msg.Term);

            $('#total').val(accounting.formatMoney(msg.Total, "",0,"."));
            var total_disc = msg.Total*msg.Disc/100;
            $('#disc').val(msg.Disc);
            $('#discT').val(accounting.formatMoney(total_disc, "",0,"."));
            var total_ppn = msg.Dpp*msg.Ppn/100;
            $('#ppn').val(msg.Ppn);
            $('#ppnT').val(accounting.formatMoney(total_ppn, "",0,"."));
            $('#dpp').val(accounting.formatMoney(msg.Dpp, "",0,"."));
            $('#granT').val(accounting.formatMoney(msg.Grand, "",0,"."));
			cek_batal();
        }
    }); 
}

//Auto Generate
function autogen(){
    $('#add').attr('mode','new');
    $('#delete').attr('disabled', true);
    $('#_so').attr('disabled',false);
    document.getElementById('add').style.visibility = 'visible';
    document.getElementById('f_plg').style.visibility = 'visible';

    $("#total").val("");
    $('#disc').val("");
    $('#discT').val("");
    $('#ppn').val("");
    $('#ppnT').val("");
    $('#dpp').val("");
    $('#granT').val("");

    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_do/auto_gen",
    data :{},
    success:
        function(hh){
            $('#_so').val(hh);
            //$('#_sl').val('<?php echo $this->session->userdata('Nama'); ?>');
            var a = '<?php echo $user;?>';
            setSelectedIndex(document.getElementById("_sl"),a);
        }
    });    
}

//Suggestion Pelanggan
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

function setSelectedIndex(s, valsearch)
{
// Loop through all the items in drop down list
for (i = 0; i< s.options.length; i++)
{ 
    if (s.options[i].value == valsearch)
    {
        // Item is found. Set its property and exit
        s.options[i].selected = true;
        break;
    }
}
return;
}

//Table Pelanggan
function listPelanggan(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_pelanggan/viewPelanggan",
    data :{},
    success:
    function(hh){
        $('#list_pelanggan').html(hh);
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

//fungsi untuk menampilkan Table Detail SO *table bawah*
function tampilDetailSO(){
    var so = $('#_so').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_do/tableDetail",
        data :{so:so},
        success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

var filter="";

//GET POPUP PELANGGAN
function getPelanggan(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
    var t = $('input:radio[name=optionsRadios]:checked').attr('term');
    $('#_pn').val(x);
    $('#kd_plg').val(k);
    $('#terms').val(t);
}
//GET POPUP Barang
function getBarang(){
    var id = $('input:radio[name=optionsRadiosBarang]:checked').val();
    /*var y = $('input:radio[name=optionsRadiosBarang]:checked').attr('satuan');
    var z = $('input:radio[name=optionsRadiosBarang]:checked').attr('nama');
    var o = $('input:radio[name=optionsRadiosBarang]:checked').attr('harga');
    var p = $('input:radio[name=optionsRadiosBarang]:checked').attr('ukuran');*/
    
    var row = filter;
    var arrs = document.getElementsByName('kode_brgd');
    found_flag = false;
    for (i = 0; i < arrs.length; i++) {
        if (arrs[i].value === id) {
            found_flag = true;
            break;
        }
    }

    if (found_flag === true)
    {
        bootstrap_alert.warning('<b>Gagal Menambahkan Barang</b> Barang sudah ada dalam detail');
    } else {
        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_barang/getSelectedRadio",
            data :{id:id},
            dataType: 'json',
            success:
            function(msg){
                $('#kode_brg'+row).val(id);
                $('#last_qty'+row).val(msg.Qty_Jual);
                $('#satuan_brg'+row).val(msg.Satuan); 
                $('#nama_brg'+row).val(msg.Nama +" "+msg.Ukuran); 
                $('#harga_brg'+row).val(msg.Harga); 
            }
        }); 
    }  
}

//Cancel
$("#cancel").click(function(){
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    tampilDetailSO();
    $('#_so').attr('disabled', false);
    cekauthorization();
    document.getElementById('add').style.visibility = 'visible';
	document.getElementById('batal').style.visibility = 'hidden';
});

function addRow() {
    var items = "";
    $count = $("tbody#itemlist tr").length+1;

    items += "<tr>";
    items += "<td width='15%'><div class='input-append'><input type='text' class='span2' id='kode_brg"+$count+"' onkeypress='validAct("+$count+")' maxlength='20' id='appendedInputButton' name='kode_brgd' style='width:87px' disabled='true'/><a href='#modalBarang' onclick='getDetail("+$count+")' id='f_brg"+$count+"' role='button' class='btn detail-append' data-toggle='modal' style='visibility: hidden;'><i class='icon-filter'></i></a></div></td>";
    items += "<td width='22%'><div class='input-append'><input type='text' name='nama_brg' class='validate[required]' id='nama_brg"+$count+"' style='width:130px' readonly='true'/><a href='#modalBarang' onclick='getDetail("+$count+")' id='f_brgs"+$count+"' role='button' class='btn detail-append' data-toggle='modal' style='visibility: hidden;'><i class='icon-filter'></i></a></div></td>";
    items += "<td width='8%'><input type='hidden' id='last_qty"+$count+"'/><input type='text' name='qty_brg' onkeypress='validAct("+$count+")' maxlength='5' class='validate[required]' id='qty_brg"+$count+"' style='width:40px;text-align:right;' disabled='true' autofocus/></td>";
    items += "<td width='15%'><input type='text' name='harga_brg' onkeypress='validAct("+$count+")' maxlength='15' class='validate[required]' id='harga_brg"+$count+"' style='width:88px;text-align:right;' disabled='true'/></td>";
    items += "<td width='15%'><input type='text' name='jumlah' class='validate[required]' id='jumlah_brg"+$count+"' style='width:88px;text-align:right;' disabled='true'/></td>";
    items += "<td width='15%'><input type='text' name='keterangan' class='validate[required]' maxlength='22' id='keterangan_brg"+$count+"' style='width:88px' disabled='true'/></td>";
    items += "<td width='10%'><div class='btn-group' style='margin-bottom:0;'><a class='btn' href='#' onclick='editRow("+$count+")'><i id='icon"+$count+"' class='icon-pencil'></i></a><a class='btn' id='hapus' href='javascript:void(0);'><i class='icon-trash'></i></a></div></td></tr>";

    $("#itemlist").append(items);
}

//BUAT PRINT
$("#print").click(function(){
//deklarasi variable
    var so = $('#_so').val();
    var tglSo = $('#_tgl').val();
    var po = $('#_po').val();
    var tglPo = $('#_tgl2').val();
    var pl = $('#kd_plg').val();
    var sl = $('#_sl').val();
    var to = $('#total').val();
    var term = $('#terms').val();
	
	var disc = $('#disc').val();
	var dpp = $('#dpp').val();
	var ppn = $('#ppn').val();
	var grant = $('#granT').val();
    var ppnT = $('#ppnT').val();
	var discT = $('#discT').val();
	
    var arrKode = new Array();
    var arrQty = new Array();
    var arrSatuan = new Array();
    var arrHarga = new Array();
    var arrJumlah = new Array();
    var arrKet = new Array();
    var arrNama = new Array();
	
    var table = document.getElementById('tb_detail');
    var totalRow = table.rows.length;
    for(var i=1;i<=totalRow;i++){
	
	 arrNama[i-1] = $('#nama_brg'+i).val();
        arrKode[i-1] = $('#kode_brg'+i).val();
        arrQty[i-1] = $('#qty_brg'+i).val();
        arrSatuan[i-1] = $('#satuan_brg'+i).val();
        arrHarga[i-1] = $('#harga_brg'+i).val();
        arrJumlah[i-1] = $('#jumlah_brg'+i).val();
        arrKet[i-1] = $('#keterangan_brg'+i).val(); 
    }   
    
    
$.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/report/print_transaksi_so",
        data :{ so:so,tglSo:tglSo,po:po,tglPo:tglPo,pl:pl,sl:sl,to:to,disc:disc,dpp:dpp,ppn:ppn,grant:grant,ppnT:ppnT,discT:discT, term:term,
                    arrNama:arrNama,arrKode:arrKode, arrQty:arrQty, arrSatuan:arrSatuan, arrHarga:arrHarga, arrJumlah:arrJumlah, arrKet:arrKet,totalRow:totalRow
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
			   win.document.title="Sales Order "+tgl;
              write(msg);
              close();
            }
            win.print();
        }
     });
});

//Save Click
$("#save").click(function(){
	
    var mode = $('#save').attr("mode");
    
    //deklarasi variable
    var so = $('#_so').val();
    var tglSo = $('#_tgl').val();
    var po = $('#_po').val();
    var tglPo = $('#_tgl2').val();
    var pl = $('#kd_plg').val();
    var sl = $('#_sl').val();
    var to = $('#total').val().replace(/\./g, "");
    var term = $('#terms').val();
    
	var disc = $('#disc').val();
	var dpp = $('#dpp').val().replace(/\./g, "");
	var ppn = $('#ppn').val();
	var grant = $('#granT').val().replace(/\./g, "");

    var arrKode = new Array();
    var arrQty = new Array();
	var arrSatuan = new Array();
    var arrHarga = new Array();
    var arrJumlah = new Array();
    var arrKet = new Array();
    
    var table = document.getElementById('tb_detail');
    var totalRow = table.rows.length;
    for(var i=1;i<=totalRow;i++){
		arrKode[i-1] = $('#kode_brg'+i).val();
		arrQty[i-1] = $('#qty_brg'+i).val();
		arrSatuan[i-1] = $('#satuan_brg'+i).val();
		arrHarga[i-1] = $('#harga_brg'+i).val().replace(/\./g, "");
		arrJumlah[i-1] = $('#jumlah_brg'+i).val().replace(/\./g, "");
		arrKet[i-1] = $('#keterangan_brg'+i).val();	
	}

    if(mode == "add"){ //add mode
        if(pl == 0){
            bootstrap_alert.warning('<b>Gagal!</b> Data Pelanggan Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
        }
        else
     	if($("#formID").validationEngine('validate') && totalRow != 0 && grant != '')
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_do/insert",
            data :{so:so,tglSo:tglSo,po:po,tglPo:tglPo,pl:pl,sl:sl,to:to,disc:disc,dpp:dpp,ppn:ppn,grant:grant,term:term,
                    arrKode:arrKode, arrQty:arrQty, arrSatuan:arrSatuan, arrHarga:arrHarga, arrJumlah:arrJumlah, arrKet:arrKet,totalRow:totalRow
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Data Sales Order '+so+' berhasil ditambahkan');
					$('#formID').each(function(){
						this.reset();
					});
                    listSO();
					tampilDetailSO();
					autogen();
					cekauthorization();
                }
                else{
                    bootstrap_alert.warning('<b>Gagal Menambahkan</b> Kode Sales Order sudah ada');
                }
            }
            });
        }else{
            bootstrap_alert.warning('<b>Gagal!</b> Masukkan Detail Barang & Pastikan Semua Field Terisi');
        }        
           
    }else if(mode == "edit"){ //Edit mode
    	if(pl == 0){
            bootstrap_alert.warning('<b>Gagal!</b> Data Pelanggan Tidak Ditemukan Silahkan Cek Kembali Inputan Anda');
        }
        else
        if($("#formID").validationEngine('validate'))
    	{
    		$.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_do/update",
            data :{so:so,tglSo:tglSo,po:po,tglPo:tglPo,pl:pl,sl:sl,to:to,term:term, disc:disc,dpp:dpp,ppn:ppn,grant:grant,
                    arrKode:arrKode, arrQty:arrQty, arrSatuan:arrSatuan, arrHarga:arrHarga, arrJumlah:arrJumlah, arrKet:arrKet,totalRow:totalRow
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> data Sales Order '+so+' berhasil di update');
                    $('#formID').each(function(){
                            this.reset();
                    });
                    listSO();
					tampilDetailSO();
					autogen();
					cekauthorization();
                }
                else{
                    bootstrap_alert.warning('<b>Gagal</b> Terjadi Kesalahan Kode SO Sudah Ada');
                }
            }
            });
    	}else{
            bootstrap_alert.warning('<b>Gagal!</b> Masukkan Detail Barang & Pastikan Semua Field Terisi');
        }  
    }
});

$("#delete").click(function(){
    var so = $('#_so').val();

    PlaySound('beep');
    var id = $('#_so').val();
    var pr = $('#_tgl').val();
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode SO: <b>"+id+"</b><br/>Tanggal SO : <b>"+pr+"</b>",
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
                        url: "<?php echo base_url();?>index.php/tr_do/delete",
                        data :{so:so
                        },

                        success:
                        function(msg)
                        {
                            if(msg == "ok")
                            {
                                bootstrap_alert.success('Data Sales Order <b>'+id+'</b> berhasil dihapus');
                                $('#formID').each(function(){
                                    this.reset();
                                });
                               listSO();
                               tampilDetailSO();
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
function cek_batal(){
    var id = $('#_po').val();
    if(id == "(BATAL)"){
        document.getElementById('batal').style.visibility = 'hidden';
        $("#save").attr('disabled',true);
        $("#print").attr('disabled',true);
        $("#_po").attr('disabled',true);
    }else{
        document.getElementById('batal').style.visibility = 'visible';
        $("#save").attr('disabled',false);
        $("#print").attr('disabled',false);
        $("#_po").attr('disabled',false);
    }
}

$("#batal").click(function(){
    var sj = $('#_so').val();
    var so = "(BATAL)";

    PlaySound('beep');
    var id = $('#_so').val();
    var pr = $('#_tgl').val();
	
	//buat balikin qty
	var arrKode = new Array();
    var arrQty = new Array();
	
    var table = document.getElementById('tb_detail');
    var totalRow = table.rows.length;
    for(var i=1;i<=totalRow;i++){
		arrKode[i-1] = $('#kode_brg'+i).val();
		arrQty[i-1] = $('#qty_brg'+i).val();
	}
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode SO: <b>"+id+"</b><br/>Tanggal SO : <b>"+pr+"</b>",
        title: "<img src='<?php echo base_url();?>/assets/img/warning-icon.svg' class='warning-icon'/> Yakin ingin membatalkan Sales Order Berikut?",
        buttons: {
            main: {
                label: "Kembali",
            },
            danger: {
                label: "Batalkan SO",
                className: "btn-danger",
                callback: function() {
                    $.ajax({
                        type:'POST',
                        url: "<?php echo base_url();?>index.php/tr_do/update3",
                        data :{sj:sj,so:so,arrKode:arrKode,arrQty:arrQty,totalRow:totalRow},

                        success:
                        function(msg)
                        {
                            if(msg == "ok")
                            {    
							
                                bootstrap_alert.success('<b>Sukses</b> Sales Order '+sj+' telah dibatalkan');
								$('#formID').each(function(){
									this.reset();
								});
								listSO();
								tampilDetailSO();
								autogen();

                            }
							
                        }
                    });
                }
            }
        }
    });
 });    
</script>