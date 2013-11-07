<div class="row-fluid">
    <div class="span6">
        <!--//***MAIN FORM-->
        <div class="bar">
            <p>Form Bank <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>

        <div id="konten" class="hide-con master-border">
        <form id="formID">
            <table>
                <tr>
                    <td>Kode</td>
                    <td>
                        <input type='text' class="span-form75 upper-form validate[required,maxSize[5], minSize[2]],custom[onlyLetterNumber]" maxlength="5" id='_kd' name='_kd'>
                    </td>
                    <td>
                        Alamat
                    </td>
                    <td rowspan="2">
                        <textarea rows="3" class="validate[required,maxSize[100]]" maxlength="100" id='_al' name='_al' style="resize:none; width:150px; margin-left: 10px;"></textarea>
                    </td>
                    <td rowspan="2">
                        <a href="#myModal" role="button" class="btn" data-toggle="modal" id="rek" style="margin-left:10px;">Tambah Rekening</a>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td style="vertical-align: bottom;">
                        <input type='text' class="span-form170 validate[required,maxSize[50], minSize[3],custom[onlyLetterNumber]]" maxlength="50" id='_nm' name='_nm'>
                    </td>
               </tr>       
            </table>
        </form>
            <div id="detail"></div>
            <div style="margin-top: 10px; text-align:center;">
                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <button id="cancel" class="btn" type="reset">Cancel</button>
            </div>
            <div id="konfirmasi" class="sukses"></div>
        </div>
    </div>

    <div class="offset3 span3">
        <div id="list"></div>
    </div>
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah Rekening</h3>
  </div>
  <div class="modal-body">
    <table>
        <tr>
            <td>No Rekening</td>
            <td>
                <input type='text' style="width: 155px; margin-right:10px;" class="span-form170 upper-form validate[required,maxSize[20], minSize[2]],custom[onlyLetterNumber]" maxlength="20" id='_no_rek' name='itemcode' onclick="disableAlpha('_no_rek')">
            </td>
            <td>Cabang</td>
            <td style="vertical-align: bottom;">
                <input type='text' class="span-form170 validate[required,maxSize[25], minSize[3],custom[onlyLetterNumber]]" maxlength="25" id='_cab' name='_cab'>
            </td>
        </tr>
        <tr>
            <td>Atas Nama</td>
            <td style="vertical-align: bottom;">
                <input type='text' style="width: 155px;" class="span-form170 validate[required,maxSize[50], minSize[3],custom[onlyLetterSp]]" maxlength="50" id='_an' name='_an' onclick="disableNum('_an')">
            </td>
            <td>Jenis</td>
            <td>
                <select name="_tipe" class="validate[required]" id="_tipe" style="margin-left: 10px; margin-right: 20px;">
                <option value="">- Pilih -</option>
                <?php
                foreach ($list_tipe as $isi)
                {
                    echo "<option ";
                    echo "value = '".$isi->value."'>".$isi->value."</option>";
                }
                ?>
                </select>
                <button type="button" id="tes" class="btn btn-mini" tittle="Tambah Tipe Rekening"
                        data-toggle="button"
                        data-html="true" data-placement="bottom"
                        rel="popover"
                        style="margin-bottom:3px;"
                        data-content="
                        <div>
                         <input  type='text' 
                            class='span2' id='txtCombo' id='appendedInput' name='txtCombo' 
                            style='width: 130px;margin-left: 10px;margin-bottom: 0;'
                            />
                        <button class='btn btn-primary' onclick='addCombo()'>Tambah</button>
                        </div>"><i class='icon-plus'></i>
                </button>
            </td>
            
       </tr> 
       <tr>
            <td>No Perkiraan</td>
            <td>
                <select name="_no_perk" class="validate[required]" id="_no_perk" style="margin-left: 10px; margin-right: 20px;">
                <option value="">- Pilih -</option>
                <?php
                foreach ($list_perkiraan as $isi)
                {
                    echo "<option ";
                    echo "value = '".$isi->value."'>".$isi->value."</option>";
                }
                ?>
                </select>
            </td>
       </tr>      
    </table>
  </div>
  <div class="modal-footer">
    <div id="konfirmasi2" class="sukses"></div>
    <button class="btn btn-small" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-small btn-primary" onclick="addRow()">Done</button>
  </div>
</div>

<script>  
    $("#tes").popover({ title: 'Tambah Tipe Rekening', placement: 'left'});
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script type="text/javascript">
loadListBank();

$(document).ready(function(){
	detailBank();
	barAnimation();
    validation();
    key();
});
//load Side Table
function loadListBank(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>ms_bank/index",
    data :{},
    success:
    function(hh){
        $('#list').html(hh);
    }
    });
}

function detailBank(){
    var id = $('#_kd').val();
    $.ajax({ //utk tabel detail DO
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_bank/detail",
        data :{id:id},
        success:
        function(hh){
           $('#detail').html(hh);
        }
    });
}

$("#_kd").keypress(function(e){
   var userVal = $("#_kd").val();
   if(userVal.length == 5){
       bootstrap_alert.info('Maksimum Kode 5 Karakter');
   } 
});

$("#_nm").keypress(function(e){
   var userVal = $("#_nm").val();
   if(userVal.length == 50){
       bootstrap_alert.info('Maksimum Kode 50 Karakter');
   } 
});

$("#_no_rek").keypress(function(e){
   var userVal = $("#_no_rek").val();
   if(userVal.length == 20){
       bootstrap_alert.info2('Maksimum Kode 20 Karakter');
   } 
});
$("#_an").keypress(function(e){
   var userVal = $("#_an").val();
   if(userVal.length == 50){
       bootstrap_alert.info2('Maksimum Kode 50 Karakter');
   } 
});
$("#_cab").keypress(function(e){
   var userVal = $("#_cab").val();
   if(userVal.length == 25){
       bootstrap_alert.info2('Maksimum Kode 25 Karakter');
   } 
});

bootstrap_alert.info2 = function(message) {
    $('#konfirmasi2').html('<div class="alert alert-info" style="position:absolute; "><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}


$("#cancel").click(function(){
    $('#formID').each(function(){
        this.reset();
    });
    detailBank();
    $("#_kd").attr('disabled',false);
     $('button[type="submit"]').attr('disabled','disabled');
    document.getElementById('rek').style.visibility = 'visible';
});

$("#save").click(function(){
    var table = document.getElementById('tb3');
    var totalRow = $("tbody#itemlist tr").length;
    var detail = document.getElementsByName('item');

    if(totalRow != 0){
        
	    var _mode = $('#save').attr("mode");
	    
	    var _kd = $('#_kd').val();
	    var _al = $('#_al').val();
	    var _nm = $('#_nm').val();

	    //detail bpb
	    var _no_rekening = new Array();
	    var _atas_nama = new Array();
	    var _tipe = new Array();
	    var _cabang = new Array();
	    var _no_perkiraan = new Array();
	    
	    for(var i=1;i<=totalRow;i++){
	        _no_rekening[i-1] = $('#no_rekening'+i).val();
	        _atas_nama[i-1] = $('#atas_nama'+i).val();
	        _tipe[i-1] = $('#tipe'+i).val();
	        _cabang[i-1] = $('#cabang'+i).val();
	        _no_perkiraan[i-1] = $('#no_perkiraan'+i).val();
	    }
	    
	    if(_mode == "add") //add mode
	    {
	        if($("#formID").validationEngine('validate'))
	        {
	            $.ajax({
	            type:'POST',
	            url: "<?php echo base_url();?>ms_bank/insert/add",
	            data :{_kd:_kd,_al:_al,_nm:_nm,
	                    _no_rekening:_no_rekening, _atas_nama:_atas_nama, _tipe:_tipe, _cabang:_cabang, _no_perkiraan:_no_perkiraan, totalRow:totalRow
	            },

	            success:
	            function(msg)
	            {
	                if(msg == "ok")
	                {
	                    bootstrap_alert.success('Data <b>'+_kd+' - '+_nm+'</b> sudah ditambahkan');
	                    $('#formID').each(function(){
	                        this.reset();
	                    });

	                    loadListBank();
						detailBank();
	                    $('#save').attr('mode','add');
	                }
	                else{
	                    bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data sudah ada');
	                }
	            }
	            });
	        }     
	    }
	    else if(_mode == "edit") //add mode
	    {
	        if($("#formID").validationEngine('validate'))
	        {
	            $.ajax({
	            type:'POST',
	            url: "<?php echo base_url();?>ms_bank/insert/edit",
	            data :{_kd:_kd,_al:_al,_nm:_nm,
	                    _no_rekening:_no_rekening, _atas_nama:_atas_nama, _tipe:_tipe, _cabang:_cabang, _no_perkiraan:_no_perkiraan, totalRow:totalRow
	            },

	            success:
	            function(msg)
	            {
	                if(msg == "ok")
	                {
	                    bootstrap_alert.success('Data <b>'+_kd+' - '+_nm+'</b> berhasil diupdate');
	                    $('#formID').each(function(){
	                        this.reset();
	                    });

	                    loadListBank();
						detailBank();
	                    $('#save').attr('mode','add');
	                }
	                else{
	                    bootstrap_alert.warning('<b>Gagal Update</b> Terjadi Kesalahan');
	                }
	            }
	            });
	        }     
	    }
    }
    else{
        bootstrap_alert.warning('<b>Gagal</b> Terjadi Kesalahan, Table Detail Rekening Harus diisi!');
    }  
});

function addCombo() {
    var textb = document.getElementById("txtCombo");
    var combo = document.getElementById("_tipe");

    var option = document.createElement("option");
    option.text = textb.value;
    option.value = textb.value;

    var _val = $('#txtCombo').val();
    if(_val !="")
    {
        $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>ms_bank/add_tipe", //SEND TO CONTROLLER
        data :{_val:_val},

        success:
        function(msg) //GET MESSEGE FROM INSERT MODEL
        {
            if(msg == "ok")
            {
                try {
                    combo.add(option, null); //Standard
                }catch(error) {
                    combo.add(option); // IE only
                }

                setSelectedIndex(document.getElementById("_tipe"),_val);
                textb.value = "";
                $('#tes').popover('hide');
            }
        }
        });
    }
}
</script>