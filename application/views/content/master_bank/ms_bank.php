<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>

<!--//***MAIN FORM-->
<div class="bar bar2">
    <p>Form Bank <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border" style="width: 62%;">
<form id="formID">
    <table>
        <tr>
            <td>Kode</td>
            <td>
                <input type='text' class="validate[required,maxSize[5], minSize[2]],custom[onlyLetterNumber]" maxlength="5" id='_kd' name='_kd' style="width: 75px; margin-left: 10px; margin-right: 20px; text-transform: uppercase;">
            </td>
			<td>
				Alamat
			</td>
			<td rowspan="2">
				<textarea rows="2" class="validate[required,maxSize[100]]" maxlength="100" id='_al' name='_al' style="resize:none; width:170px; height: 60px; margin-left: 10px;"></textarea>
			</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>
                <input type='text' class="validate[required,maxSize[50], minSize[3],custom[onlyLetterNumber]]" maxlength="50" id='_nm' name='_nm' style="width: 170px;margin-left: 10px; margin-right: 20px;">
            </td>
       </tr>       
    </table>
</form>
	<div id="detail"></div>
	<div style="margin-top: 10px;">
		<button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
		<button id="cancel" class="btn" type="reset">Cancel</button>

	</div>
</div>

<div id="list" style="z-index:10"></div>

<script type="text/javascript">
loadListBank();

$(document).ready(function(){
	detailBank();
	barAnimation();
    validation_engine();
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
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}

function disableAlpha($id){
    var foo = document.getElementById($id);
    foo.addEventListener('input', function (prev) {
    return function (evt) {
        if (!/^[0-9\.\+\ ]*$/.test(this.value)) {
          this.value = prev;
        }
        else {
          prev = this.value;
        }
    };
    }(foo.value), false);
};
function disableNum($id){
    var foo = document.getElementById($id);
    foo.addEventListener('input', function (prev) {
    return function (evt) {
        if (!/^[A-Za-z ]*$/.test(this.value)) {
          this.value = prev;
        }
        else {
          prev = this.value;
        }
    };
    }(foo.value), false);
};

function barAnimation(){
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

function key(){
 $('button[type="submit"]').attr('disabled','disabled');
 $('input[type="text"]').keyup(function() {
    if($(this).val() != '') {
       $('button[type="submit"]').removeAttr('disabled');
    }
    else{
    	 $('button[type="submit"]').attr('disabled','disabled');
    }
 });
}

$("#cancel").click(function(){
    $('#formID').each(function(){
        this.reset();
    });
    detailBank();
    $("#_kd").attr('disabled',false);
     $('button[type="submit"]').attr('disabled','disabled');
    document.getElementById('add_item').style.visibility = 'visible';

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
	                    bootstrap_alert.success('<b>Sukses</b> Data sudah ditambahkan');
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
	                    bootstrap_alert.success('<b>Sukses</b> Data berhasil diupdate');
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
        bootstrap_alert.warning('<b>Gagal</b> Terjadi Kesalahan, Table Detail Barang Harus diisi!');
    }  
});
</script>