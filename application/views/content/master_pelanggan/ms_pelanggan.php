<script>
$.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_pelanggan/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
});
</script>

<!--//***MAIN FORM-->
<div class="bar bar2">
    <p>Form Pelanggan <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>

<div id="konten" class="hide-con master-border" style="width: 62%;">
<form id="formID">
    <table>
        <tr>
            <td>Kode</td>
            <td>
                <input type='text' class="validate[required,maxSize[20], minSize[3]],custom[onlyLetterNumber]] span-form75 upper-form" maxlength="20" id='kd' name='kd'>
            </td>
            <td>Perusahaan</td>
            <td>
                <input type='text' class="span-form170 validate[required,maxSize[50], minSize[2]]]" maxlength="50" id='pr' name='pr'>
            </td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td>
                <input type='text' class="span-form170 validate[required, maxSize[25], minSize[3]],custom[onlyLetterSp]]" maxlength="25" id='cp' name='cp' onclick="disableNum('cp')">
            </td>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required]" id='al' name='al' style="resize:none; width:218px; height: 60px; margin-left: 10px;"></textarea>
            </td>
        </tr>
        <tr>
            <td>NPWP</td>
            <td>
                <input type='text' class="span-form170 validate[required]" maxlength="25" id='np' name='np' onclick="disableAlpha('np')">
            </td>
            <td>Kota</td>
            <td>
                <input type='text' class="validate[required, maxSize[15], minSize[3]],custom[onlyLetterSp]]" maxlength="15" id='kt' name='kt' style="width: 80px; margin-left: 10px;">
                &nbsp; 
                Kode Pos
                <input type='text' class="validate[required, maxSize[5], minSize[5]],custom[onlyNumberSp]]" maxlength="5" id='kp' name='kp' style="width: 50px;" onclick="disableAlpha('kp')">
            </td>
        </tr>
        <tr>
            <td>Limit Kredit</td>
            <td>
                <div class="input-prepend input-append" style="margin-bottom: 0; margin-left: 10px;">
                  <span class="add-on" style="margin: 0; padding: 2px;">Rp</span>
                  <input class="span2" id='lk' id="appendedPrependedInput" type='text' class="validate[required]" maxlength="15" name='lk' style="width: 145px; text-align:right" onkeyup="formatAngka(this,'.')" >
                </div>
            </td>
            <td>Terms</td>
            <td>
                <input  type='text' 
                        class="validate[required,custom[onlyNumberSp]]" maxlength="4" id='term' name='term' 
                        style="width: 30px;margin-left: 10px;"> Hari
            </td>
        </tr>
       <tr>
            <td>Telp</td>
            <td colspan="3">
                <input type='text' placeholder="Telp 1" class="telp validate[required, minSize[5]],custom[phone]]" maxlength="20" id='tl1' name='tl1' onclick="disableAlpha('tl1')">
                <input type='text' placeholder="Telp 2" class="telp validate[minSize[5]],custom[phone]]" maxlength="20" id='tl2' name='tl2' value="" onclick="disableAlpha('tl2')">
                <input type='text' placeholder="Telp 3" class="telp validate[minSize[5]],custom[phone]]" maxlength="20" id='tl3' name='tl3' value="" onclick="disableAlpha('tl3')">
            </td>
       </tr>
       <tr>
            <td>Fax</td>
            <td colspan="3">
                <input type='text' placeholder="Fax 1" class="telp validate[required, minSize[5]],custom[phone]]" maxlength="20" id='fx1' name='fx1' onclick="disableAlpha('fx1')">
                <input type='text' placeholder="Fax 2" class="telp validate[minSize[5]],custom[phone]]" id='fx2' maxlength="20" name='fx2' value=""  onclick="disableAlpha('fx2')">
            </td>
       </tr>
        <tr >
            <td colspan="4">
                <br/>
                <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <button id="cencel" class="btn" type="reset">Cancel</button>
                <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Daftar Pelanggan"><i class="icon-print"></i></button>
            </td>
        </tr>
    </table>
</form>
<div id="konfirmasi" class="sukses"></div>
</div>
<!--//***END MAIN FROM-->

<div id="hasil"></div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script type="text/javascript">
/*
 * SCRIPT DIBAWAH BIAR LEBIH CEPAT LOAD PAGE
 */
$(document).ready(function() 
{
    autogen();
    barAnimation();
    validation();
    key();
});
    
function autogen(){
    $("#kd").attr('disabled',false);
    $('#save').attr('mode','add');
    $('button[type="submit"]').attr('disabled','disabled');
    
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_pelanggan/auto_gen",
    data :{},
    success:
        function(hh){
            $('#kd').val(hh);
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

function conv(input){
    var nStr = input.value + '';
    nStr = nStr.replace( /\,/g, "");
    x = nStr.split( '.' );
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while ( rgx.test(x1) ) {
        x1 = x1.replace( rgx, '$1' + ',' + '$2' );
    }
    input.value = x1 + x2;
}
</script>


<script type="text/javascript">
//buat print
$("#print").click(function(){
$.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/report/print_master_pelanggan",
        data :{   
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
			  win.document.title="Pelanggan "+tgl;
              write(msg);
              close();
            }
            win.print();
        }
     });
});

$("#kd").keypress(function(e){
   var userVal = $("#kd").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Kode 20 Karakter');
   } 
});
$("#pr").keypress(function(e){
   var userVal = $("#pr").val();
   if(userVal.length == 50){
       bootstrap_alert.info('Maksimum 50 Karakter');
   } 
});
$("#cp").keypress(function(e){
   var userVal = $("#cp").val();
   if(userVal.length == 30){
       bootstrap_alert.info('Maksimum 30 Karakter');
   } 
});
$("#np").keypress(function(e){
   var userVal = $("#np").val();
   if(userVal.length == 25){
       bootstrap_alert.info('Maksimum 25 Karakter');
   } 
});
$("#kt").keypress(function(e){
   var userVal = $("#kt").val();
   if(userVal.length == 15){
       bootstrap_alert.info('Maksimum 15 Karakter');
   } 
});

$("#cencel").click(function(){
   autogen();
    $('#formID').each(function(){
        this.reset();
    });
    $("#kd").attr('disabled',false);
});

function retext(){  
    var txtVal = $('#pr').val();
    var strVal = txtVal.substr(0, 2);
    var x = txtVal.length;
    var mainVal = txtVal.substr(3, x);
    var fixVal;
    if(strVal == "PT" || strVal == "CV" || strVal == "PD"){
        fixVal = mainVal+" "+strVal+".";
        $('#pr').val(fixVal);
    }
}

$("#save").click(function(){
    retext();
    var mode = $('#save').attr("mode");  
    //DECLARE VARIABLE
    var kd = $('#kd').val();
    var pr = $('#pr').val();
    var cp = $('#cp').val();
    var al = $('#al').val();
    var kt = $('#kt').val();
    var kp = $('#kp').val();
    var tl1 = $('#tl1').val();
    var tl2 = $('#tl2').val();
    var tl3 = $('#tl3').val();
    var fx1 = $('#fx1').val();
    var fx2 = $('#fx2').val();
    var np = $('#np').val();
    var lk = $('#lk').val().replace(/\./g, "");
    var term = $('#term').val();
    
    if(mode == "add"){  
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_pelanggan/insert", //SEND TO CONTROLLER
            data :{kd:kd,pr:pr,cp:cp,al:al,kt:kt,kp:kp,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,np:np,lk:lk,term:term},
    
            success:
            function(msg) //GET MESSEGE FROM INSERT MODEL
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('Data <b>'+kd+' - '+pr+'</b> sudah ditambahkan');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    $.ajax({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/ms_pelanggan/index",  //REFRESH TABLE DETAIL WITH CONTROLLER
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
    else
    {
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_pelanggan/update", //SEND TO CONTROLLER
            data :{kd:kd,pr:pr,cp:cp,al:al,kt:kt,kp:kp,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,np:np,lk:lk,term:term},
    
            success:
            function(msg) //GET MESSEGE FROM INSERT MODEL
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('Data <b>'+kd+' - '+pr+'</b> berhasil diperbarui');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    $.ajax({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/ms_pelanggan/index",  //REFRESH TABLE DETAIL WITH CONTROLLER
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
                    bootstrap_alert.warning('<b>Gagal Edit</b> Terjadi Kesalahan');
                }
            }
            });
        }
        return false;  
    } 
});
</script>
