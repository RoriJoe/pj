<div class="row-fluid">
    <div class="span9">
        <!--Main Form-->
        <div class="bar">
            <p>Form Inovice <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>

        <div id="konten" class="hide-con master-border" style=" height: 370px; ">
        <form id="formID">
            <table>
                <tr>
                    <td> No Invoice</td>
                    <td>
                        <input  type='text' 
                                class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" 
                                id='no_invo' name='no_invo' 
                                style="width: 80px;text-transform: uppercase;">
                    </td>

                    <td>Tanggal</td>
                    <td>
                        <input  type='text' placeholder='dd-mm-yyyy'
                                class="validate[required,custom[date]]" id='_tgl1' name='_tgl1' value="<?php echo date('d-m-Y');?>" 
                                style="width: 80px; margin-right: 12px;">
                    </td>
                    <td>Pelanggan</td>
                    <td>
                        <input type="hidden" id="kd_plg" />
                        <div class="input-append money" style="margin-bottom:0;">
                         <input type='text' class="span2" 
                            maxlength="20" id="pn" id='appendedInputButton' name='pn' style="width: 124px;" readonly="true">
                        <a href="#modalPelanggan" style="margin-bottom:3px;" role="button" class="btn padding-filter" id="f_plg" title="Filter Pelanggan" data-toggle="modal" onclick="listPelanggan()"><i class="icon-search"></i></a>
                        </div>
                    </td>
               </tr>
               
               <tr>
                    <td>Nomor SJ</td>
                    <td>
                        <div id="no_sj">
                        </div>
                    </td>

                    <td colspan="2">Term
                        <input  type='text' 
                                class="validate[required,custom[onlyNumberSp]]" maxlength="4" id='term' name='term' 
                                style="width: 30px;"> Hari
                    </td>

                    <td>Alamat</td>
                    <td>
                        <textarea rows="3" class="validate[required]" id='al' name='al' 
                            style="resize:none; width:135px;" disabled="disabled">
                        </textarea>
                    </td>
               </tr>
            </table>
        </form>
        <div id="hasil2"></div>
        <div id="totalBox" style="float: right; margin-right: -47px; visibility:hidden;">
                <table>
                <tr>
                    <td><label style="float: left; margin-right: 10px;"><b>Total</b> </label>
                    </td>
                    <td><input type="hidden" id="total2" />
                    <input style="float: right; width:120px; margin-right: 145px;text-align:right;" class="no-margin-b" id="total" name="total" type="text" readonly="true"></td>
                </tr>
                <tr>
                    <td><label style="float: left; margin-right: 10px;"><b>Discount</b> </label>
                    </td>
                    <td><input type="hidden" id="disc2" />
                    <input style="width:20px; " class="no-margin-b" maxlength="2" id="disc" name="disc" type="text" onkeypress="hitung()">%
                    <input style="width:70px;text-align:right;" class="no-margin-b" onkeypress="hitung()" id="discT" name="discT" type="text"/>
                    </td>
                </tr>
                <tr>
                    <td><label style="float: left; margin-right: 10px;"><b>DPP</b> </label>
                    </td>
                    <td><input type="hidden" id="dpp2" />
                    <input style="width:120px; margin-right: 145px;text-align:right;" class="no-margin-b" id="dpp" name="dpp" type="text" readonly="true"></td>
                </tr>
                 <tr>
                        <td>
                            <label style="float: left; margin-right: 10px;"><b>PPN</b> </label>
                        </td>
                        <td>
                            <input style="width:20px;" class="no-margin-b" maxlength="2" id="ppn" name="ppn" type="text" onkeypress="hitungPPN()">% 
                            <input style="width:70px;text-align:right;" class="no-margin-b" id="ppnT" name="ppnT" type="text" onkeypress="hitungPPN()">
                        </td>
                </tr> 
                <tr>
                    <td><label style="float: left; margin-right: 10px;"><b>Grand Total</b> </label>
                    </td>
                    <td><input type="hidden" id="granT2" />
                    <input style="width:120px; text-align:right;" class="no-margin-b" id="granT" name="granT" type="text" readonly="true"></td>
                </tr>      
                </table>
            </div>
        <div>
            <button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
            <button id="delete" class="btn">Delete</button>
            <button id="cancel" class="btn">Cancel</button>
            <button id="print" class="btn"  data-toggle="tooltip" title="Print Invoice"><i class="icon-print"></i> Print</button>
        </div>
        <div id="konfirmasi" class="sukses"></div>
        </div>
    </div>

    <div class="span3">
        <!--@Load table List via AJAX-->
        <div id="list_invoice"></div>
    </div>
</div>

<div id="modalPelanggan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Pelanggan <input type="text" id="SearchPelanggan" placeholder="Search"></h3>
  </div>
  <div class="modal-body">
    <div id="list_pelanggan"></div>
  </div>
</div>

<!--Le Script-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script src="<?php echo base_url(); ?>assets/js/accounting.min.js" type="text/javascript"></script>

<script type="text/javascript">
    //load function here
$(document).ready(function(){
    $( "#_tgl1" ).datepicker( "setDate", new Date());
    list_invoice();
    autogen();
    validation();
    //barAnimation();
    displayResult();
    get_sj_list();
});

function list_invoice(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_invoice/index",
    data :{},
    success:
    function(hh){
        $('#list_invoice').html(hh);
    }
    });
}

function autogen(){
    $('#delete').attr('disabled', true);
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_invoice/auto_gen",
    data :{},
    success:
        function(hh){
            $('#no_invo').val(hh);
        }
    });
}

$(function() {
    $( "#_tgl1").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind",
    });
});


function displayResult(selTag)
{
    tampilDetailInvoice();
    tampilTotalDo();
    document.getElementById('totalBox').style.visibility = 'visible';
}

function show_sj(mode){
    var modes = mode;
    var _div = document.getElementById('no_sj');
    var _text = document.getElementById('_sj');

    if(mode=="view"){
        _div.removeChild(_text);
        var s= "<input type='text' name='_sj' id='_sj' style='width:120px' readonly='true'>";
        _div.innerHTML=s;
    }
    else
    {
        _div.removeChild(_text);
        get_sj_list();
    }
}

//Table Detail yang dibawah
function tampilDetailInvoice(){
    var sj = $('#_sj').val();
    $.ajax({ //utk tabel detail
        type:'POST',
        async:false,
        url: "<?php echo base_url();?>index.php/tr_invoice/Detail_SJ",
        data :{sj:sj},
        success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

function tampilTotalDo(){
    var arr = document.getElementsByName('jumlah');
    var total = 0;
    for(i=0; i < arr.length; i++){
        if(parseInt(arr[i].value))
            total += parseInt(arr[i].value.replace(/\./g, ""));
    }

    $('#total').val(accounting.formatMoney(total, "",0,"."));
    $("#dpp").val(accounting.formatMoney(total, "",0,"."));
    $("#granT").val(accounting.formatMoney(total, "",0,"."));
    $('#disc').val("");
    $('#discT').val("");
    $('#ppn').val("");
    $('#ppnT').val("");
}

function hitung(){
$('#disc').bind('textchange', function (event){    
    //disableAlpha('ppn');
    var total = $("#total").val().replace(/\./g, "");
    var h = $(this).val();

    /*if(temp != 0){
        var q = temp;
    } else if(total2 != 0){
        var q = total2;
    }*/
    
    disc = total*h/100;

    var dpp = total-disc;
    $("#discT").val(accounting.formatMoney(disc, "",0,"."));
    $("#dpp").val(accounting.formatMoney(dpp, "",0,"."));
    $('#ppn').val("");
    $('#ppnT').val("");
}); 

$('#discT').bind('textchange', function (event){    
        //disableAlpha('ppn');
        var total = $("#total").val().replace(/\./g, "");

        var h = $(this).val().replace(/\./g, "");
        
        disc = (h/total)*100;

        var dpp = total-h;
        
        $("#disc").val(disc);
        $("#dpp").val(accounting.formatMoney(dpp, "",0,"."));
        //$("#total2").val(q+hasil);  */
        $('#ppn').val("");
        $('#ppnT').val("");
        formatAngka(this,'.');
    });         
}

function hitungPPN(){
    $('#ppn').bind('textchange', function (event){    
        //disableAlpha('ppn');
        var dpp = $("#dpp").val().replace(/\./g, "");

        var h = $(this).val();
        /* if(temp != 0){
            var q = temp;
        } else if(total2 != 0){
            var q = total2;
        }
         */
        ppn = dpp*h/100;

        var grant = dpp-0+ppn;
        $("#ppnT").val(accounting.formatMoney(ppn, "",0,"."));
        $("#granT").val(accounting.formatMoney(grant, "",0,"."));
    });  

    $('#ppnT').bind('textchange', function (event){    
        //disableAlpha('ppn');
        var total = $("#dpp").val().replace(/\./g, "");

        var h = $(this).val().replace(/\./g, "");
        
        ppn = (h/total)*100;
        var dpp = total*1+1*h;
        
        $("#ppn").val(ppn);
        $("#granT").val(accounting.formatMoney(dpp, "",0,"."));

        formatAngka(this,'.');
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

//PopUp Pelanggan
function listPelanggan(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_surat_jalan/view_sj_pelanggan",
    data :{},
    success:
    function(hh){
        $('#list_pelanggan').html(hh);
    }
    });   
}

//GET PopUp Pelanggan
function getPelanggan(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('kd');
    var z = $('input:radio[name=optionsRadios]:checked').attr('term');
    var w = $('input:radio[name=optionsRadios]:checked').attr('alamat');
    $('#pn').val(x);
    $('#kd_plg').val(y);
    $('#al').val(w);
    $('#term').val(z);
    get_sj_list(y);
}

//Tampilkan SO sesuai pelanggan
function get_sj_list($user_id){
    var id = $user_id;
    console.log(id);

    $.ajax({
        type:'POST',
        async: false,
        url: "<?php echo base_url();?>tr_surat_jalan/sj_call",
        data:{id:id},
        dataType: "html",

        success: function(data){
            $('#no_sj').html(data);
        }
    });
}


function getFormInvoice(IDsj){
    var id = IDsj;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_invoice/getSJ",
        data :{id:id},
        dataType: 'json',
        success:
        function(msg){
            $('#_tgl1').val(msg.Tanggal);
            $('#pn').val(msg.Perusahaan);
            $('#term').val(msg.Term);
            $('#al').val(msg.Alamat);
            $('#_sj').val(msg.Kode_Sj);
            displayResult();

            $('#total').val(accounting.formatMoney(msg.Total, "",0,"."));
            var total_disc = msg.Total*msg.Disc/100;
            $('#disc').val(msg.Disc);
            $('#discT').val(accounting.formatMoney(total_disc, "",0,"."));
            var total_ppn = msg.Dpp*msg.Ppn/100;
            $('#ppn').val(msg.Ppn);
            $('#ppnT').val(accounting.formatMoney(total_ppn, "",0,"."));
            $('#dpp').val(accounting.formatMoney(msg.Dpp, "",0,"."));
            $('#granT').val(accounting.formatMoney(msg.Grand, "",0,"."));
        }
    });
}

function reset_form(){
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    tampilDetailInvoice();
    show_sj('reset');
    $('#total1').val('');
    $('#total').val('');
    $('#save').attr('mode','add');
    document.getElementById('totalBox').style.visibility = 'hidden';
    document.getElementById('f_plg').style.visibility = 'visible';
}

//Cancel
$("#cancel").click(function(){
    reset_form();
});

//BUAT PRINT
$("#print").click(function(){
//deklarasi variable
    var id = $('#no_invo').val();
    var _tgl = $('#_tgl1').val();
    var so = $('#_sj').val();
	var plg = $('#pn').val();
    var term = $('#term').val();

    var to = $('#total').val(); 
    var disc = $('#disc').val();
    var dpp = $('#dpp').val();
    var ppn = $('#ppn').val();
    var grant = $('#granT').val();
	var discT = $('#discT').val();
	var ppnT = $('#ppnT').val();

	var arrKode = new Array();
    var arrBrg = new Array();
	var arrSat = new Array();
    var arrQty = new Array();
	var arrHrg = new Array();
    var arrJml = new Array();
	var arrKet = new Array();
  

    var table = document.getElementById('tb_detail');
    var totalRow = table.rows.length-1;
    for(var i=1;i<=totalRow;i++){
        arrKode[i-1] = $('#kd'+i).text();
        arrBrg[i-1] = $('#brg'+i).text();
        arrSat[i-1] = $('#satuan'+i).text();
        arrQty[i-1] = $('#qty'+i).text();
        arrHrg[i-1] = $('#harga_brg'+i).val();
		arrJml[i-1] = $('#jumlah_brg'+i).val();
        arrKet[i-1] = $('#ket'+i).text(); 
    }
    
    
$.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/report/print_transaksi_invoice",
        data :{ id:id,_tgl:_tgl,so:so,term:term,to:to,disc:disc,dpp:dpp,ppn:ppn,grant:grant,plg:plg,discT:discT,ppnT:ppnT,
		arrKode:arrKode,arrBrg:arrBrg,arrSat:arrSat,arrQty:arrQty,arrHrg:arrHrg,arrJml:arrJml,arrKet:arrKet,totalRow:totalRow
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
			   win.document.title="Invoice "+tgl;
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
    var id = $('#no_invo').val();
    var _tgl = $('#_tgl1').val();
    var so = $('#_sj').val();
	var plg = $('#kd_plg').val();
    var term = $('#term').val();

    var to = $('#total').val().replace(/\./g, ""); 
    var disc = $('#disc').val();
    var dpp = $('#dpp').val().replace(/\./g, "");
    var ppn = $('#ppn').val();
    var grant = $('#granT').val().replace(/\./g, "");


    if(mode == "add"){ //add mode
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_invoice/save/add",
            data :{id:id,_tgl:_tgl,so:so,term:term,to:to,disc:disc,dpp:dpp,ppn:ppn,grant:grant,plg:plg},

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Data Invoice '+id+' berhasil ditambahkan');
                    reset_form();
                    list_invoice();
                }
                else{
                    bootstrap_alert.warning('<b>Gagal!</b> Kode Invoice sudah ada');
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
            url: "<?php echo base_url();?>index.php/tr_invoice/save/edit",
            data :{id:id,_tgl:_tgl,so:so,term:term,to:to,disc:disc,dpp:dpp,ppn:ppn,grant:grant},

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses!</b> Update Invoice '+id+' berhasil dilakukan');
                    reset_form();
                    list_invoice();
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
    var id = $('#no_invo').val();

    PlaySound('beep');
    var pr = $('#_tgl1').val();
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode Invoice: <b>"+id+"</b><br/>Tanggal Invoice : <b>"+pr+"</b>",
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
                    url: "<?php echo base_url();?>index.php/tr_invoice/delete",
                    data :{id:id},
                    success:
                    function(msg)
                    {
                        if(msg == "ok")
                        {
                            bootstrap_alert.success('Data Invoice <b>'+id+'</b> berhasil dihapus');
                            reset_form();
                            list_invoice();
                        }
                    }
                    });
                }
            }
        }
    });
});
</script>