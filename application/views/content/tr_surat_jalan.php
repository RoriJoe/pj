<script>
var flag=0;
//Auto Generate
function autogen(){
	$('#save').attr('mode','add');
    $('#save').attr('disabled',true);
    $('#cancel').attr('disabled',true);

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

jQuery(document).ready(function() {
	//Validasi JQuery
	jQuery("#formID").validationEngine(
	    {
	        ajaxFormValidation: true,
	        ajaxFormValidationMethod: 'post',
	    });
	});

	autogen();
	tampilSJ();
	animation();
	$("#pn").attr('disabled',true);
	$("#po").attr('disabled',true);
	disable("no");
    key();

//Auto Complete & Suggestion Search
$("#_do").autocomplete({
    minLength: 1,
    source:
    function(req, add){
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/autocomplete/lookup",
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
        $('#_do').val(ui.item.value);
        get_do();
        tampilDetailDO();
    },
});

//Tampilkan Table yg disamping Via AJAX
function tampilSJ(){
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_surat_jalan/index",
        data :{},
        success:
        function(hh){
            $('#hasil').html(hh);
            $('#tb1 tr').click(function (e) {
            var s=$(this).text();
            var sj=parseInt(s);
                $.ajax({
                type:'POST',
                url: "<?php echo base_url();?>index.php/tr_surat_jalan/passSJ",
                data :{sj:sj},
                success:
                    function(hh)
                    {
                        disable("yes");
                        data=hh.split("|");
                        $('#sj').val(data[0]);
                        $('#_tgl').val(data[6]);
                        $('#_do').val(data[2]);
                        $('#gg').val(data[4]);
                        $('#pn').val(data[1]);
                        $('#po').val(data[3]);
                        $('#mbl').val(data[5]);
						$('#kode_p').val(data[8]);
                        var tes = data[7];
                        if(tes == "Pelita"){
                            $("#ambil").prop("checked", false);
                        }  else
                        {
                           $("#ambil").prop("checked", true);
                        }

                        var sj=$('#sj').val();
                        $('#save').attr('mode','edit');
                        $('#cancel').attr('disabled',false);
                        
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
                });
            });
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

//Disable/Enable Button
function disable(x) {
    if(x=="yes"){
        $("#delete").attr('disabled',false);
    }else if(x=="no"){
        $("#delete").attr('disabled',true);
    }
}

function get_do() {
    var _do = $('#_do').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_surat_jalan/ambil_do",
        data :{_do:_do},
        success:
        function(hh){
            data=hh.split("|");
            $('#pn').val(data[0]);
            $('#gg').val(data[2]);
            $('#po').val(data[3]);
            $('#kode_p').val(data[4]);
        }
    });
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

//Custom Validasi Plat Mobil
function checkMbl(field, rules, i, options){
    var mbl = field.val();

    var temp=mbl.split(/[a-zA-Z]+/g);
    var t = ""+parseInt(temp[1]);

    // this allows to use i18 for the error msgs
    if (!isNaN(mbl.charAt(0)) || !isNaN(mbl.charAt(mbl.length-2)) || !isNaN(mbl.charAt(mbl.length-1)) || t.length!=4)
    {
        flag = 1;
        return options.allrules.validatemblfields.alertText;
    }else flag=0;
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
</script>


<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>

<!--//***MAIN FORM-->
<div class="bar">
    <p>Form Surat Jalan <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border">
<form id="formID">
    <table width="100%">
        <tr>
            <td style="width: 120px;">Nomor SJ</td>
            <td>
                <input type='text' class="validate[required]" id='sj' name='sj' style="width: 170px;">
            </td>

            <td>Tgl Kirim</td>
            <td>
                <input type='text' class="validate[required]" id='_tgl' name='_tgl' style="width: 70px;">
            </td>
       </tr>
       <tr>
            <td>Nomor SO</td>
            <td>
                <div class="input-append" style="margin-bottom: 0;">
				  <input type='text' class="validate[required] span2" id='_do' id="appendedInput" name='_do' style="width: 150px;">
				  <a href="tr_do" role="button" id="tes" class="btn" type="button" data-toggle="button" data-placement="right" rel="popover" style="padding: 2px 3px;"><i class="icon-plus"></i></a>
				</div>
            </td>

            <td>Gudang</td>
            <td>
                <select name="gg" class="validate[required]" id="gg" style="width: 186px;">
                <?php
                    echo "<option value = ''> -- Select -- </option>";
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
            <td>Pelanggan</td>
            <td>
                <input type='text' class="validate[required]" id='pn' name='pn' style="width: 170px;">
            </td>
            <td>No. PO</td>
            <td><input type='text' class="validate[required]" id='po' name='po' style="width: 170px;">
            </td>
        </tr>
        <tr>
            <td>Nomor Mobil</td>
            <td>
                <input type='text' class="validate[required,minSize[7],maxSize[9]] text-input" id='mbl' name='mbl' style="width: 170px;">
            </td>
            <td colspan="2">
                <label class="checkbox">
                    <input type="checkbox" id="ambil" name="ambil"> Ambil Sendiri
                </label>
            </td>
        </tr>
    </table>
    <p style="visibility: hidden;" id="kode_p" name="kode_p"/>
    <hr style="margin: 0;"/>
</form>
<div id="hasil2" style="height: 215px;"></div>
<div style="margin-top: 10px;">
    <!--<button id="show" class="btn btn-info popup3" type="button">Show Product</button>-->
    <button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
    <button id="delete" class="btn" type="submit">Delete</button>
    <button id="cancel" class="btn" type="submit">Cancel</button>
    <button id="print" class="btn"  data-toggle="tooltip" title="Print SJ"><i class="icon-print"></i></button>
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
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" onclick="getBarang()" data-dismiss="modal" aria-hidden="true">Done</button>
  </div>
</div>

<div id="hasil"></div>

<script>  
    $("#tes").popover({ content: 'Tambah Sales Order Baru?', trigger: 'hover'});
</script>

<script>
listBarang();

//GET POPUP Barang
function getBarang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('ukuran');
    var z = $('input:radio[name=optionsRadios]:checked').attr('nama');
    
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
        bootstrap_alert.warning('<b>Gagal Menambahkan Barang</b> Barang sudah ada');
    } else {
        $('#kode_brg'+row).val(x);
        $('#brg_ukur'+row).val(z+" "+y);  
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

$("#cancel").click(function(){
    disable("no");
    $('#formID').each(function(){
        this.reset();
    });
    autogen();
    $('#hasil2').html('');
});

//BUAT PRINT
 $("#print").click(function(){
	var sj = $('#sj').val();
    var _tgl = $('#_tgl').val();
    var _do = $('#_do').val();
    var gg = $('#gg').val();
    var pn = $('#kode_p').val();
    var po = $('#po').val();
    var ot = $('#ot').val();
    var mbl = $('#mbl').val();
	
	var kd_brg = new Array();
    var nama = new Array();
    var nbu = new Array();
    var qty = new Array();
    var ktr = new Array();

    var totaltx = $('#jmltx').text()
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
	                kd_brg:kd_brg, nama:nama, nbu:nbu, qty:qty, ktr:ktr, totaltx:totaltx
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

$("#save").click(function(){
	var mode = $('#save').attr("mode");
	
    var sj = $('#sj').val();
    var _tgl = $('#_tgl').val();
    var _do = $('#_do').val();
    var gg = $('#gg').val();
    var pn = $('#kode_p').val();
    var po = $('#po').val();
    var ot = $('#ot').val();
    var mbl = $('#mbl').val();
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

    var totaltx = $('#jmltx').text()
    for(var i=1;i<=totaltx;i++){
        kd_brg[i-1] = $('#kode_brg'+i).val();
        nama[i-1] = $('#brg_ukur'+i).val();
        nbu[i-1] = $('#nbu'+i).text();
        qty[i-1] = $('#qty'+i).val();
        ktr[i-1] = $('#ket'+i).val();
    }
    
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
	                autogen();
	                bootstrap_alert.success('<b>Sukses</b> Data sudah ditambahkan');
					$('#formID').each(function(){
						this.reset();
					});
	                tampilSJ();
	            }
	            else{
	                bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data sudah ada');
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
	                autogen();
	                bootstrap_alert.success('<b>Sukses</b> Update berhasil dilakukan');
		            $('#formID').each(function(){
	                    this.reset();
		            });
	                tampilSJ();
	            }
	            else{
	             	bootstrap_alert.warning('<b>Gagal</b> Terjadi Kesalahan');
	            }
	        }
	        });
	    }
	   }
});


$("#delete").click(function(){
    var sj = $('#sj').val();

     $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_surat_jalan/delete",
        data :{sj:sj
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
                
                autogen();
                $('#hasil').html('');
                disable("no");
                tampilSJ();
                tampilDetailDO();
            }
        }
     });
});
</script>
