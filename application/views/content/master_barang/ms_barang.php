<div class="row-fluid">
    <div class="span6">
        <!--//***MAIN FORM-->
        <div class="bar" title="Show/Hide Form">
        <p>Form Barang <i id="icon" class='icon-chevron-down icon-white' ></i></p>
        </div>

        <div id="konten" class="hide-con master-border">
            <form id="formID">

            <div class="field-wrap">
                Kode
                <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" id='_kd' name='kd' style="width: 120px; margin-left: 10px; margin-right: 20px; text-transform: uppercase;">
            </div>
            <div class="field-wrap">
                Nama
                <input type='text' class="validate[required,maxSize[25], minSize[2]]]" maxlength="25" id='_nama1' name='nama1' style="width: 170px; margin-right: 20px;">
            </div>
            <br/>
            <div class="field-wrap">
                Ukuran
                <input type='text' class="validate[required,maxSize[25], minSize[4]]" maxlength="25" id='_uk' name='uk' style="width: 120px;margin-right: 20px;">
            </div>
            <div class="field-wrap">
                Keterangan
                <input type='text' class="validate[required,maxSize[20]]" id='_ket' name='ket' style="width: 138px; margin-right: 20px;">
            </div>
            <br/>
            <div class="field-wrap">
                Harga Beli
                <div class="input-prepend input-append money">
                  <span class="add-on custom-add-on">Rp</span>
                  <input class="span2" id='hb' id="appendedPrependedInput" type='text' class="validate[required]" maxlength="15" name='hb' style="width: 120px; text-align:right;" onkeyup="formatAngka(this,'.')" >
                </div>
            </div>
            <div class="field-wrap">
                Harga Jual
                <div class="input-prepend input-append money">
                  <span class="add-on custom-add-on">Rp</span>
                  <input class="span2" id='hj' id="appendedPrependedInput" type='text' class="validate[required]" maxlength="15" name='hj' style="width: 120px;text-align:right;" onkeyup="formatAngka(this,'.')" >
                </div>
            </div>
            <br/>
            <div class="field-wrap">
                Persediaan
                <input class="span2 validate[required,custom[number]]" readonly="true" id='_ps' name='ps' style="width: 70px;" type="text" value="0">
            </div>
            <div class="field-wrap">
                Tgl Persediaan
                <input  type='text' 
                    class="" id='_tgl1' name='_tgl1' 
                    style="width: 80px;" readonly="true">
            </div>
            <div class="field-wrap">
                <div class="input-append money">
                    <select name="st" class="validate[required]" id="_st" id="appendedInput" style="margin-left: 10px;margin-bottom: 8px;">
                    <?php
                    foreach ($list_satuan as $isi)
                    {
                        echo "<option ";
                        echo "value = '".$isi->Kode_satuan."'>".$isi->Kode_satuan."</option>";
                    }
                    ?>
                    </select>
                    <a id="tes" class="add-on btn btn-mini" tittle="Tambah Satuan"
                        data-toggle="button" style="margin-bottom:8px;"
                        data-html="true" data-placement="bottom"
                        rel="popover"
                        data-content="
                        <div>
                         <input  type='text' 
                            class='span2' id='txtCombo' id='appendedInput' name='txtCombo' 
                            style='width: 130px;margin-left: 10px;margin-bottom: 0;'
                            />
                        <button class='btn btn-primary' onclick='addCombo()' style='margin-left:10px;'>Tambah</button>
                        </div>"><i class='icon-plus'></i>
                    </a>
                </div>
            </div>
            <br/>
            <div class="field-wrap action-group">
                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <button id="cac" class="btn" type="reset">Cancel</button>
                <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Daftar Barang"><i class="icon-print"></i> Print</button>
            </div>

            </form>
            <!--**NOTIFICATION AREA**-->
            <div id="konfirmasi" class="sukses"></div>
        </div>
    </div>

    <div class="offset2 span4">
        <div id="hasil"></div>
    </div>
</div>

<script>  
    $("#tes").popover({ title: 'Tambah Satuan'});
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script> 

<script type="text/javascript">
$(document).ready(function() {
    loadListBarang();
    autogen();
    barAnimation();
    validation();
    key();
});

//load Side Table
function loadListBarang(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_barang/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
    });
}

function autogen(){
    $("#_kd").attr('disabled',false);
    $('#save').attr('mode','add');
    $('button[type="submit"]').attr('disabled','disabled');
    
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_barang/auto_gen",
    data :{},
    success:
        function(hh){
            $('#_kd').val("");
        }
    });
}

 $("#saw").click(function(){
	$.ajax({
		type:'POST',
		url: "<?php echo base_url();?>index.php/ms_barang/viewSaldoAwal",
		data :{},
		success:
		function(hh){
			$('#hasilsaw').html(hh);
		}
	});
});
 
$("#cac").click(function(){
	$('#hasilsaw').html("");
   autogen();
   $('#formID').each(function(){
		this.reset();
	});
    autogen();
});

$("#_kd").keypress(function(e){
   var userVal = $("#_kd").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Kode 20');
   } 
});
$("#_nama1").keypress(function(e){
   var userVal = $("#_nama1").val();
   if(userVal.length == 25){
       bootstrap_alert.info('Maksimum Nama 25 Karakter');
   } 
});
$("#_uk").keypress(function(e){
   var userVal = $("#_uk").val();
   if(userVal.length == 25){
       bootstrap_alert.info('Maksimum Ukuran 25 Karakter');
   } 
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

function retrieveForm(myID){
    var id = myID;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_barang/retrieveForm",
        data :{id:id},
        dataType: 'json',
        success:
        function(msg){
            $('#_nama1').val(msg.Nama);
            $('#_uk').val(msg.Ukuran);
            $('#_ket').val(msg.Keterangan);
            $('#_ps').val(msg.Persediaan);
            $('#hb').val(msg.Beli);
            $('#hj').val(msg.Jual);

            setSelectedIndex(document.getElementById("_st"),msg.Satuan);
        }
    }); 
}

//buat print
$("#print").click(function(){
$.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/report/print_master_barang",
        data :{   
        },

        success:
        function(msg)
        {   
            var win=window.open('');
             with(win.document)
            {
			
              open();
			  document.title="BARANG";
              write(msg);
              close();
            }
			 
            win.print();
        }
     });
});

$("#save").click(function(){
	var mode = $('#save').attr("mode");
	
	if(mode == "add"){ //MODE ADD NEW ITEM
		//DECLARE VARIABLE
		var _kd = $('#_kd').val();
		var _nama1 = $('#_nama1').val();
		var _ket = $('#_ket').val();
		var _uk = $('#_uk').val();
		var _ps = $('#_ps').val();
		var _st = $('#_st').val();
        var _hb = $('#hb').val().replace(/\./g, "");
        var _hj = $('#hj').val().replace(/\./g, "");
		
		if($("#formID").validationEngine('validate'))
		{
			$.ajax({
			type:'POST',
			url: "<?php echo base_url();?>index.php/ms_barang/insert", //SEND TO CONTROLLER
			data :{_kd:_kd,_nama1:_nama1,_ket:_ket,_uk:_uk,_ps:_ps,_st:_st,_hb:_hb,_hj:_hj},

			success:
			function(msg)
			{
				if(msg == "ok")
				{
					bootstrap_alert.success('<b>Sukses</b> Data Barang <b>'+_kd+'-'+_nama1+'</b> sudah ditambahkan');
					$('#formID').each(function(){
						this.reset();
					});
    					$.ajax({
        					type:'POST',
        					url: "<?php echo base_url();?>index.php/ms_barang/index",  //REFRESH TABLE DETAIL WITH CONTROLLER
        					data :{},
        					success:
        					function(hh){
                                $('#hasil').html(hh);
        					}
    					});
					autogen();
					$('#save').attr('mode','add');
				}
				else{
					bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data sudah ada');
				}
			}
			});
		}
		return false;
	}
	else //MODE UPDATE ITEM
	{
        var _kd = $('#_kd').val();
        var _nama1 = $('#_nama1').val();
        var _ket = $('#_ket').val();
        var _uk = $('#_uk').val();
        var _ps = $('#_ps').val();
        var _st = $('#_st').val();
        var _hb = $('#hb').val().replace(/\./g, "");
        var _hj = $('#hj').val().replace(/\./g, "");
	    
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_barang/update",
            data :{_kd:_kd,_nama1:_nama1,_ket:_ket,_uk:_uk,_ps:_ps,_st:_st,_hb:_hb,_hj:_hj},
            success:
            function(msg){
                if(msg=="ok")
                {
                        bootstrap_alert.success('<b>Sukses</b> Update Barang <b>'+_kd+'-'+_nama1+'</b> berhasil dilakukan');
                        $('#formID').each(function(){
                                this.reset();
                        });
                        $.ajax({
                        type:'POST',
                        url: "<?php echo base_url();?>index.php/ms_barang/index",
                        data :{},
                        success:
                        function(hh){
                                $('#hasil').html(hh);
                        }
                        });
                        autogen();
                        $('#save').attr('mode','add');
                }
                else
                {
                        bootstrap_alert.warning('<b>Gagal Menambahkan</b> Terjadi Kesalahan');
                }
                }
            });
        }
        return false;
	}
});

$(".delete").click(function(){
    PlaySound('beep');
    var id = $(this).attr("kode");
    var pr = $(this).attr("nama");
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode: <b>"+id+"</b><br/>Nama Barang : <b>"+pr+"</b>",
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
                        url: "<?php echo base_url();?>index.php/ms_barang/delete",
                        data :{id:id},
                        success: function(msg){
                            if(msg=="gagal"){
                                bootstrap_alert.warning('<b>Gagal!</b> Telah terjadi kesalahan');
                            }
                            else{
                                bootstrap_alert.success('<b>Sukses!</b> Data '+ pr +' telah dihapus');
                                $('#formID').each(function(){
                                    this.reset();
                                });
                                autogen();
                                loadListBarang();
                            }
                        }
                    });
                }
            }
        }
    });
});

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
	
function addCombo() {
    var textb = document.getElementById("txtCombo");
    var combo = document.getElementById("_st");

    var option = document.createElement("option");
    option.text = textb.value;
    option.value = textb.value;

    try {
        combo.add(option, null); //Standard
    }catch(error) {
        combo.add(option); // IE only
    }

	var _sat = $('#txtCombo').val();
    var nm = $('#txtCombo').val();
    var kd = $('#txtCombo').val();
	if(_sat !="")
	{
		$.ajax({
		type:'POST',
		url: "<?php echo base_url();?>index.php/ms_satuan/insert", //SEND TO CONTROLLER
		data :{kd:kd,nm:nm},

		success:
		function(msg) //GET MESSEGE FROM INSERT MODEL
		{
			if(msg == "ok")
			{
                setSelectedIndex(document.getElementById("_st"),_sat);
				textb.value = "";
                $('#tes').popover('hide');
			}
			else{
				bootstrap_alert.warning('<b>Gagal!</b> Satuan sudah ada');
			}
		}
		});
	}else{
        
    }
}

//NOT USE
function AddDot(Num){
    Num += '';
    Num = Num.replace(/\./g, '');
    
    x=Num.split('.');
    x1=x[0];
    x2=x.length >1 ?',' + x[1] : '';
    var rgx =/(\d+)(\d{3})/;
    while (rgx.test(x1))
    {
    x1=x1.replace(rgx,'$1'+'.'+'$2');
    }
    return x1+x2;
}
    
function ubah(a){
    var harga = a;
    harga = AddDot(harga);
    return harga;
    //document.getElementById("qty").value=harga;
}
</script>
