<div class="row-fluid">
    <div class="span7">
        <!--//***MAIN FORM-->
        <div class="bar" title="Show/Hide Form">
            <p>Form Supplier <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>

        <div id="konten" class="hide-con">
        <form id="formID" style="margin-left: 15px;">
            <table>
                <tr>
                    <td>Kode</td>
                    <td>
                        <input type='text' class="form125 upper-form validate[required,maxSize[20], minSize[3]],custom[onlyLetterNumber]" maxlength="20" id='kd' name='kd'>
                    </td>
                    <td>Perusahaan</td>
                    <td>
                        <input type='text' class="form150 validate[required,maxSize[50], minSize[2]]]" maxlength="50" id='pr' name='pr'>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td style="padding-right:10px;">
                        <input type='text' style="width: 135px;" class="validate[required, maxSize[30], minSize[3]],custom[onlyLetterSp]]" maxlength="30" id='nm' name='nm'>
                    </td>
                    <td>Limit</td>
                    <td>
                        <div class="input-prepend input-append money">
                          <span class="add-on custom-add-on">Rp</span>
                          <input class="span2" id='lk' id="appendedPrependedInput" type='text' class="validate[required]" maxlength="15" name='lk' style="width: 138px;text-align:right;height: 24px;" onkeyup="formatAngka(this,'.')" >
                        </div>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Alamat</td>
                    <td rowspan="2">
                        <textarea rows="3" class="validate[required, maxSize[30], minSize[3]]]" maxlength="30" id='al' name='al' style="resize:none; width:135px;"></textarea>
                    </td>
                    <td>Kota</td>
                    <td>
                        <input type='text' class="form100 validate[required, maxSize[15], minSize[3]],custom[onlyLetterSp]]" maxlength="15" id='kt' name='kt' onclick="disableNum('kt')">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>Telp</td>
                    <td colspan="3">
                        <input type='text' placeholder="Telp 1" class="form120 validate[required, maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='tl1' name='tl1' onclick="disableAlpha('tl1')">
                        <input type='text' placeholder="Telp 2" class="form120 validate[maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='tl2' name='tl2' value="" onclick="disableAlpha('tl2')">
                        <input type='text' placeholder="Telp 3" class="form120 validate[maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='tl3' name='tl3' value="" onclick="disableAlpha('tl3')">
                    </td>
                </tr>
                <tr>
                    <td>Fax</td>
                    <td colspan="3">
                        <input type='text' placeholder="Fax 1" class="form120 validate[required, maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='fx1' name='fx1' onclick="disableAlpha('fx1')">
                        <input type='text' placeholder="Fax 2" class="form120 validate[maxSize[20], minSize[5]],custom[phone]]" maxlength="20" id='fx2' name='fx2' value="" onclick="disableAlpha('fx2')"> 
                    </td>
                </tr>
            </table>
            <div class="field-wrap action-group">
                <?php if ($this->authorization->is_permitted('create_supplier') == true && $this->authorization->is_permitted('update_supplier') == false) : ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php elseif($this->authorization->is_permitted('update_supplier') == true && $this->authorization->is_permitted('create_supplier') == false): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="edit">Update</button>
                <?php elseif($this->authorization->is_permitted('update_supplier') == true && $this->authorization->is_permitted('create_supplier') == true): ?>
                    <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
                <?php endif; ?>
                    <button id="cac" class="btn" type="reset">Cancel</button>
                <?php if ($this->authorization->is_permitted('print_supplier')) : ?>
                    <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Daftar supplier"><i class="icon-print"></i> Print</button>
                <?php endif; ?>
            </div>
        </form>
        <div id="konfirmasi" class="sukses"></div>
        </div>
    </div>

    <div class="offset1 span4">
        <div id="hasil"></div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/myscript.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    loadList();
    autogen();
    barAnimation();
    validation();
});

function cekauthorization(){
    <?php if ($this->authorization->is_permitted('create_supplier') == true && $this->authorization->is_permitted('update_supplier') == false) : ?>
        $('#save').attr('mode','add');
        $("#save").attr('disabled',false);
    <?php elseif($this->authorization->is_permitted('update_supplier') == true && $this->authorization->is_permitted('create_supplier') == false): ?>
         $('#save').attr('mode','edit');
         $("#save").attr('disabled',false);
    <?php else: ?>
         $('#save').attr('mode','add');
         $("#save").attr('disabled',false);
    <?php endif; ?>
}

function loadList(){
    $('#loadingDiv').show()
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_supplier/index",
        data :{},
        success:
        function(hh){
            setTimeout(function () {
                $('#hasil').html(hh);
                $('#loadingDiv').hide()
            }, 1500);
        }
    });
    $('#save').attr('mode','add');
}

//Auto Generate
function autogen(){
    $("#kd").attr('disabled',false);
    
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_supplier/auto_gen",
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
        url: "<?php echo base_url();?>index.php/report/print_master_supplier",
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
			  win.document.title="Supplier "+tgl;
              write(msg);
              close();
            }
            win.print();
        }
     });
});

$("#cac").click(function(){
    autogen();
    $('#formID').each(function(){
        this.reset();
    });
    cekauthorization();
    $("#kd").attr('disabled',false);
});

$("#kd").keypress(function(e){
   var userVal = $("#kd").val();
   if(userVal.length == 20){
       bootstrap_alert.info('Maksimum Kode 20');
   } 
});

$("#pr").keypress(function(e){
   var userVal = $("#pr").val();
   if(userVal.length == 50){
       bootstrap_alert.info('Maksimum Karakter 50');
   } 
});

$("#nm").keypress(function(e){
   var userVal = $("#nm").val();
   if(userVal.length == 30){
       bootstrap_alert.info('Maksimum Karakter 30');
   } 
});
$("#kt").keypress(function(e){
   var userVal = $("#kt").val();
   if(userVal.length == 15){
       bootstrap_alert.info('Maksimum Karakter 15');
   } 
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
    var nm = $('#nm').val();
    var al = $('#al').val();
    var kt = $('#kt').val();
    var tl1 = $('#tl1').val();
    var tl2 = $('#tl2').val();
    var tl3 = $('#tl3').val();
    var fx1 = $('#fx1').val();
    var fx2 = $('#fx2').val();
    var lk =  $('#lk').val().replace(/\./g, "");
    
    if(mode == "add"){
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_supplier/insert", //SEND TO CONTROLLER
            data :{kd:kd,pr:pr,nm:nm,al:al,kt:kt,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,lk:lk},

            success:
            function(msg) //GET MESSEGE FROM INSERT MODEL
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('Data <b>'+kd+' - '+pr+'</b> berhasil ditambahkan');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    loadList();
                    autogen();
                    cekauthorization();
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
            url: "<?php echo base_url();?>index.php/ms_supplier/update",
            data :{kd:kd,pr:pr,nm:nm,al:al,kt:kt,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,lk:lk},
            success: 
            function(msg){                
                if(msg=="ok")
                {
                    bootstrap_alert.success('Data <b>'+kd+' - '+pr+'</b> Berhasil Diperbarui');
                    $('#formID').each(function(){
                        this.reset();
                    });                  
                    loadList();   
                    autogen();
                    cekauthorization();
                }                
                else{
                    bootstrap_alert.warning('<b>Gagal Update</b> Terjadi Kesalahan');
                }  
            }
            });    
        } 
        return false;
    }
});
</script>
