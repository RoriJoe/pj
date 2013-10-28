<!--//***MAIN FORM-->
<div class="bar">
    <p>Form Surat Jalan <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border">
    <form id="formID">
        <table width="100%">
            <tr>
                <td>Nomor SJ</td>
                <td>
                    <input type='text' class="validate[required]" id='sj' name='sj' style="width: 75px;">
                </td>

                <td>Tgl Kirim</td>
                <td>
                    <input type='text' class="validate[required]" id='_tgl' name='_tgl' style="width: 70px;" value="<?php echo date('d-m-Y');?>">
                </td>
           </tr>
           <tr>
                <td>Pelanggan</td>
                <td>
                    <input type="hidden" id="kd_plg" />
                    <div class="input-append" style="margin-bottom:0;">
                     <input type='text' class="span2" 
                        maxlength="20" id="pn" id='appendedInputButton' name='pn' style="width: 148px;">
                    <a href="#myModal2" role="button" class="btn" id="f_plg" title="Filter Pelanggan" data-toggle="modal" style="padding: 2px 3px;" onclick="listPelanggan()"><i class="icon-search"></i></a>
                    </div>
                </td>

                <td>Gudang</td>
                <td>
                    <select name="gg" class="validate[required]" id="gg" style="width: 186px;">
                    <?php
                        echo "<option value = ''> -- Pilih Gudang -- </option>";
                        foreach ($list_gudang as $isi)
                        {
                            echo "<option ";
                            echo "value = '".$isi->Kode."'>".$isi->Nama."</option>";
                        }
                    ?>
                    </select>
                </td>
           </tr>

           <tr>
                <td>Nomor SO</td>
                <td>
                    <div id="no_so">
                    </div>
                </td>
                <td>No. PO</td>
                <td>
                    <input type='text' class="validate[required]" id='po' name='po' style="width: 170px;">
                </td>
            </tr>
            <tr>
                <td>Nomor Mobil</td>
                <td>
                    <div id="mobil">
                        <select style="width: 170px;" id='_mbl' name='_mbl'>
                            <option value = ''> -- Pilih Mobil-- </option>"
                        </select>
                    </div>
                </td>
                <td colspan="2">
                    <label class="checkbox">
                        <input type="checkbox" id="ambil" name="ambil" onclick="change()"> Ambil Sendiri
                    </label>
                </td>
            </tr>
        </table>
        <input type="hidden" id="kirim" />
        <!--<p style="visibility: hidden;" id="kode_p" name="kode_p"/>-->
        <hr style="margin: 0;"/>
    </form>

    <div id="hasil2" style="height: 215px;"></div>
    <!--**NOTIFICATION AREA**-->
    <div id="konfirmasi" class="sukses"></div>

    <div style="margin-top: 10px;">
        <!--<button id="show" class="btn btn-info popup3" type="button">Show Product</button>-->
        <button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
        <button id="delete" class="btn" type="submit">Delete</button>
        <button id="cancel" class="btn" type="submit">Cancel</button>
        <button id="print" class="btn"  data-toggle="tooltip" title="Print Surat Jalan"><i class="icon-print"></i></button>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Barang</h3>
  </div>
  <div class="modal-body">
    <div id="list_barang"></div>
  </div>
</div>

<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Pelanggan</h3>
  </div>
  <div class="modal-body">
    <div id="list_pelanggan"></div>
  </div>
</div>

<div id="list"></div>

<script>  
    $("#tes").popover({ content: 'Tambah Sales Order Baru?', trigger: 'hover'});
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>

<script>
/*jQuery Tanggal*/
$(function() {
    $( "#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
});

var flag=0;

jQuery(document).ready(function() {
$( "#_tgl" ).datepicker( "setDate", new Date());
    get_mobil_list();
    get_so_list();
    listSJ();
    autogen();
    validation()
    barAnimation();
    $("#po").attr('disabled',true);
    $("#pn").attr('disabled',true);
    listBarang();
});

function resetForm(){
    $('#save').attr('mode','add');
    $('#save').attr('disabled',false);
    $('#delete').attr('disabled',true);
    $('#_do').attr('disabled',false);
    $('#pn').attr('disabled',true);
    $('#kirim').val(0);
    document.getElementById('f_plg').style.visibility = 'visible';
    show_so("reset");
    change();
}

//Auto Generate
function autogen(){
    $('#sj').attr('disabled',false);
    $('#save').attr('mode','add');
    $('#delete').attr('disabled',true);

    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_surat_jalan/ang",
    data :{},
    success:
        function(hh){
            $('#sj').val(hh);
        }
    });
}

function listSJ(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>tr_surat_jalan/index",
    data :{},
    success:
    function(hh){
        $('#list').html(hh);
    }
    });
}

//PopUp Pelanggan
function listPelanggan(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_surat_jalan/view_po_pelanggan",
    data :{},
    success:
    function(hh){
        $('#list_pelanggan').html(hh);
    }
    });   
}


//PopUp Barang
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

//GET POPUP Barang
function getBarang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('ukuran');
    var z = $('input:radio[name=optionsRadios]:checked').attr('nama');
    
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
        bootstrap_alert.warning('<b>Gagal Menambahkan Barang</b> Barang sudah ada dalam list');
    } else {
        $('#kode_brg'+row).val(x);
        $('#brg_ukur'+row).val(z+" "+y);  
    }
}
//GET PopUp Pelanggan
function getPelanggan(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
    $('#pn').val(x);
    $('#kd_plg').val(k);
    get_so_list(k);
}
//Tampilkan SO sesuai pelanggan
function get_so_list($user_id){
    var id = $user_id;
    console.log(id);

    $.ajax({
        type:'POST',
        async: false,
        url: "<?php echo base_url();?>tr_surat_jalan/so_call",
        data:{id:id},
        dataType: "html",

        success: function(data){
            $('#no_so').html(data);
        }
    });
}
//Tampilkan Data SO yang dipilih
function displayResult(selTag)
{
    var _do=selTag.options[selTag.selectedIndex].text;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_surat_jalan/ambil_do",
        data :{_do:_do},
        success:
        function(hh){
            data=hh.split("|");
            tampilDetailDO();
            $('#po').val(data[3]);
        }
    });
}

//Table Detail yang dibawah
function tampilDetailDO(){
    var so = $('#_do').val();
    $.ajax({ //utk tabel detail
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_surat_jalan/viewDo",
        data :{so:so},
        success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

function loadDetailSJ(){
    var sj = $('#sj').val();
    $.ajax({ //utk tabel detail
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_surat_jalan/viewSJ",
    data :{sj:sj},
    success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

function getFormSj(IDsj){
    var id = IDsj;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_surat_jalan/getSJ",
        data :{id:id},
        dataType: 'json',
        success:
        function(msg){
            $('#_tgl').val(msg.Tgl);
            $('#gg').val(msg.Gudang);
            $('#pn').val(msg.Perusahaan);
            $('#po').val(msg.Po);
            $('#kode_p').val(msg.Kode_Plg);
            $('#_do').val(msg.Do);
            $('#kirim').val(msg.Kirim);

            var tes = msg.Keterangan
            if(tes == "Pelita"){
                $("#ambil").prop("checked", false);
            }
            else
            {
               $("#ambil").prop("checked", true);
            }

            change();
            $('#_mbl').val(msg.Mobil);
        }
    });
}

function get_mobil_list(){
    $.ajax({
        async: false,
        url: "<?php echo base_url();?>tr_surat_jalan/mobil_call",
        dataType: "html",

        success: function(data){
            $('#mobil').html(data);
        }
    });
}

function change() {
    var _ambil = document.getElementById('ambil');
    var _div = document.getElementById('mobil');
    var _text = document.getElementById('_mbl');

    if(_ambil.checked){
        _div.removeChild(_text);
        var s= "<input type='text' name='_mbl' id='_mbl' style='width:120px'>";
        _div.innerHTML=s;
    }
    else
    {
        _div.removeChild(_text);
        get_mobil_list();
    }
}

function show_so(mode){
    var modes = mode;
    var _div = document.getElementById('no_so');
    var _text = document.getElementById('_do');

    if(mode=="view"){
        _div.removeChild(_text);
        var s= "<input type='text' name='_do' id='_do' style='width:120px' readonly='true'>";
        _div.innerHTML=s;
    }
    else
    {
        _div.removeChild(_text);
        get_so_list();
    }
}

function cek_kirim(){
    var id = $('#sj').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_surat_jalan/cek_kirim",
        data :{id:id},
        dataType: 'json',
        success:
        function(msg){
            $('#kirim').val(msg.Kirim);
        }
    });
}
</script>

<script>

$("#cancel").click(function(){
    $('#delete').attr('disabled',true);
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    $('#hasil2').html('');
    resetForm();
});

//BUAT PRINT
 $("#print").click(function(){
	var sj = $('#sj').val();
    var _tgl = $('#_tgl').val();
    var _do = $('#_do').val();
    var gg = $('#gg').val();
    var pn = $('#pn').val();
    var po = $('#po').val();
    var ot = $('#ot').val();
    var mbl = $('#_mbl').val();
    var kirim = $('#kirim').val();
    var count = parseInt(kirim)+1;
	
	var kd_brg = new Array();
    var nama = new Array();
    var nbu = new Array();
    var qty = new Array();
    var ktr = new Array();

    var table = document.getElementById('tb_detail');
    var totaltx = table.rows.length-1;
    for(var i=1;i<=totaltx;i++){
        kd_brg[i-1] = $('#kode_brg'+i).val();
        nama[i-1] = $('#brg_ukur'+i).val();
        nbu[i-1] = $('#nbu'+i).text();
        qty[i-1] = $('#qty'+i).val();
        ktr[i-1] = $('#ket'+i).val();
    }

	$.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/report/print_transaksi_sj",
        data :{sj:sj,_tgl:_tgl,_do:_do,gg:gg,pn:pn,po:po,ot:ot,mbl:mbl,
                kd_brg:kd_brg, nama:nama, nbu:nbu, qty:qty, ktr:ktr, totaltx:totaltx, count:count,
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
            cek_kirim();
            loadDetailSJ();
        }
    });
}); 

$("#save").click(function(){
	var mode = $('#save').attr("mode");
	
    var sj = $('#sj').val();
    var _tgl = $('#_tgl').val();
    var _do = $('#_do').val();
    var gg = $('#gg').val();
    var pn = $('#kd_plg').val();
    var po = $('#po').val();
    var ot = $('#ot').val();
    var mbl = $('#_mbl').val();
    var ket = "";//utk checkbox #Ambilsendiri
    var flag1 = $('#ambil').is(':checked');
    if (flag1 == true){
        ket = "Ambil Sendiri";
    }else
        ket ="Pelita";

    //detail SJ
    var kd_brg = new Array();
    var nama = new Array();
    var nbu = new Array();
    var qty = new Array();
    var ktr = new Array();

    var table = document.getElementById('tb_detail');
    var totaltx = table.rows.length-1;
    for(var i=1;i<=totaltx;i++){
        kd_brg[i-1] = $('#kode_brg'+i).val();
        nama[i-1] = $('#brg_ukur'+i).val();
        nbu[i-1] = $('#nbu'+i).val();
        qty[i-1] = $('#qty'+i).val();
        ktr[i-1] = $('#ket'+i).val();
    }

    if (mbl != "" && _do !=""){
        if (mode == "add"){
            if($("#formID").validationEngine('validate'))
            {
                $.ajax({
                type:'POST',
                url: "<?php echo base_url();?>index.php/tr_surat_jalan/insertheader",
                data :{sj:sj,_tgl:_tgl,_do:_do,gg:gg,pn:pn,po:po,ot:ot,mbl:mbl,ket:ket,
                        kd_brg:kd_brg, nama:nama, nbu:nbu, qty:qty, ktr:ktr, totaltx:totaltx
                },
        
                success:
                function(msg)
                {
                    $('#hasil2').html('');
                    if(msg == "ok")
                    {
                        bootstrap_alert.success('<b>Sukses</b> Surat Jalan '+sj+' sudah ditambahkan');
                        $('#formID').each(function(){
                            this.reset();
                        });
                        resetForm();
                        autogen();
                        listSJ();
                        loadDetailSJ();
                    }
                    else{
                        bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data '+sj+' sudah ada');
                    }
                }
                });
            }
        }
        else if (mode=="edit"){
            if($("#formID").validationEngine('validate'))
            {
                $.ajax({
                type:'POST',
                url: "<?php echo base_url();?>index.php/tr_surat_jalan/update2",
                data :{sj:sj,_tgl:_tgl,_do:_do,gg:gg,pn:pn,po:po,ot:ot,mbl:mbl,ket:ket,
                        kd_brg:kd_brg, nama:nama, nbu:nbu, qty:qty, ktr:ktr, totaltx:totaltx
                },
        
                success:
                function(msg)
                {
                    $('#hasil2').html('');
                    if(msg == "ok")
                    {
                        
                        bootstrap_alert.success('<b>Sukses</b> Update Surat Jalan '+sj+' berhasil dilakukan');
                        $('#formID').each(function(){
                            this.reset();
                        });
                        resetForm();
                        autogen();
                        listSJ();
                        loadDetailSJ();
                    }
                    else{
                        bootstrap_alert.warning('<b>Gagal</b> Terjadi Kesalahan');
                    }
                }
                });
            }
        }
    }
    else{
        bootstrap_alert.warning('<b>Gagal</b> Nomor SO dan Mobil Harus Di Pilih');
    }
});


$("#delete").click(function(){
    var sj = $('#sj').val();

    PlaySound('beep');
    var id = $('#sj').val();
    var pr = $('#_tgl').val();
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode SJ: <b>"+id+"</b><br/>Tanggal SJ : <b>"+pr+"</b>",
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
                        url: "<?php echo base_url();?>index.php/tr_surat_jalan/delete",
                        data :{sj:sj},

                        success:
                        function(msg)
                        {
                            if(msg == "ok")
                            {    
                                bootstrap_alert.success('<b>Sukses</b> Data '+sj+' telah dihapus');
                                $('#formID').each(function(){
                                    this.reset();
                                });
                                resetForm();
                                autogen();
                                listSJ();
                                loadDetailSJ();
                            }
                        }
                    });
                }
            }
        }
    });
     
});

function getDetail(row){
    filter = row;
}

function deleteRow(row) {
    try {
        var i = row.parentNode.parentNode.rowIndex;
        var table = document.getElementById('tb_detail');
        var rowCount = table.rows.length;
        if(rowCount <= 1) {
            bootstrap_alert.warning('<b>Gagal Menghapus</b> Detail Table Tidak Boleh Kosong');
        }else{
           table.deleteRow(i);
           rowCount--;
           i--;
        }
    }catch(e) {
        alert(e);
    }
}

function editRow(row){
    //$(this).parent().next().find('input[type="text"]').attr('disabled');
    var i = document.getElementById('kode_brg'+row);
    if (i.disabled == true){
        document.getElementById('kode_brg'+row).disabled=false;
        document.getElementById('f_brg'+row).style.visibility = 'visible';
        document.getElementById('f_brgs'+row).style.visibility = 'visible';
        document.getElementById('icon'+row).className='icon-ok';
        document.getElementById('brg_ukur'+row).disabled=false;
        document.getElementById('qty'+row).disabled=false;
        document.getElementById('ket'+row).disabled=false;
        return false;
    }
    else{
        document.getElementById('kode_brg'+row).disabled=true;
        document.getElementById('f_brg'+row).style.visibility = 'hidden';
        document.getElementById('f_brgs'+row).style.visibility = 'hidden';
        document.getElementById('icon'+row).className='icon-pencil';
        document.getElementById('brg_ukur'+row).disabled=true;
        document.getElementById('qty'+row).disabled=true;
        document.getElementById('ket'+row).disabled=true;
        return true;
    }
}
</script>
