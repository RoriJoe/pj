<div class="CSSTabel">
<table class="table">
    <thead>
        <th width="17%">Kode Barang</th>
        <th width="20%">Nama Barang</th>
        <th width="10%">Satuan</th>
        <th width="7%">Qty</th>
        <th width="17%">Hrg Satuan(Rp)</th>
        <th width="17%">Nilai(Rp)</th>
        <th width="15%">Action</th>
    </thead>
</table>
<div class="table CSSTabel" style="overflow-y:scroll;min-height:160px;max-height:265px;margin-bottom:10px">
	<table id="tb_detail">
	    <tbody id="itemlist">
	    <?php
	    $i=1;
	    foreach($hasil as $row)
	    {
            $ukuran = htmlentities($row->Nama.' '.$row->Ukuran); 
            $harga_satuan = number_format($row->Harga, 0, ',', '.');
            $jumlah_nilai = number_format($row->Nilai, 0, ',', '.');
	        echo "<tr>
	        <td width='17%'>
	            <div class='input-append'>
	                <input type='text' class='span2' id='kode_brg$i' onkeypress='validAct($i)' maxlength='20' id='appendedInputButton' name='kode_brgd' style='width:98px; text-transform: uppercase;' value='$row->Kode_barang' disabled='true'/>
	                <a href='#modalBarang' onclick='getDetail($i)' id='f_brg$i' role='button' class='btn detail-append' data-toggle='modal' style='visibility: hidden;'><i class='icon-filter'></i></a>
	            </div>    
	        </td>
	        <td width='20%'>
	       		<div class='input-append'>
	            	<input type='text' name='nama_brg' class='span2' maxlength='22' id='keterangan_brg$i' style='width:120px' value='$ukuran' disabled='true'/>
	        		<a href='#modalBarang' onclick='getDetail($i)' id='f_brgs$i' role='button' class='btn detail-append' data-toggle='modal' style='visibility: hidden;'><i class='icon-filter'></i></a>
	            </div> 
	        </td>
	        <td width='10%'>
	            <input type='text' name='satuan_brg' class='validate[required]' id='satuan_brg$i' style='width:55px;' value='$row->Satuan1' readonly='true'/>
	        </td>
	        <td width='7%'>
	            <input type='text' name='qty_brg' onkeypress='validAct($i)' maxlength='5' class='validate[required]' id='qty_brg$i' style='width:30px' value='$row->Jumlah' disabled='true'/>
	        </td>
	        <td width='17%'>
	            <input type='text' name='harga_brg' onkeypress='validAct($i)' maxlength='12' class='validate[required]' id='harga_brg$i' style='width:95px;text-align:right;' value='$harga_satuan' disabled='true' />
	        </td>
	        <td width='17%'>
	            <input type='text' name='jumlah' class='validate[required]' id='jumlah_brg$i' style='width:95px;text-align:right;' value='$jumlah_nilai' disabled='true'/>
	        </td>
	        <td width='15%'>
	        <div class='btn-group' style='text-align:center'>
	            <a class='btn' href='#' onclick='editRow($i)'><i id='icon$i' class='icon-pencil' ></i></a>
	            <a class='btn' id='' title='Unabled Delete Detail Data' disabled><i class='icon-trash'></i></a>
	        </div>
	        </td>
	        </tr>
	        ";
	        $i++;
	    } ?>
	    </tbody>
	</table>
</div>

</div>

<script>
function getDetail(row){
    filter = row;
}

function editRow(row){
    var _mode = $('#save').attr("mode");
    //$(this).parent().next().find('input[type="text"]').attr('disabled');
    var i = document.getElementById('kode_brg'+row);
    var j = document.getElementById('qty_brg'+row);
    var k = document.getElementById('harga_brg'+row);
    if (j.disabled == true){
        document.getElementById('f_brg'+row).style.visibility = 'visible';
        document.getElementById('f_brgs'+row).style.visibility = 'visible';
        document.getElementById('qty_brg'+row).disabled=false;
        document.getElementById('icon'+row).className='icon-ok';
        document.getElementById('harga_brg'+row).disabled=false;
        document.getElementById("qty_brg"+row).focus();

        if(_mode == "add"){
            document.getElementById('icon'+row).title='Tambah Barang Lagi';
            document.getElementById('icon'+row).className='icon-plus';
        }else{
            document.getElementById('icon'+row).title='Selesai Edit';
            document.getElementById('icon'+row).className='icon-ok';
        }

        return false;
    }
    else{
        var arr = document.getElementsByName('kode_brgd');
        /*if($.inArray(i.value, arr) != -1){
            bootstrap_alert.warning('<b>Kesalahan!</b> Barang sudah ada dalam daftar.');
        }*/
        if(i.value == "" || j.value == "" ||k.value == ""){
            bootstrap_alert.warning('<b>Kesalahan!</b> Field Kode, Qty, Harga Harus diisi.');
        }
        else{
            document.getElementById('kode_brg'+row).disabled=true;
            document.getElementById('f_brg'+row).style.visibility = 'hidden';
            document.getElementById('f_brgs'+row).style.visibility = 'hidden';
            document.getElementById('qty_brg'+row).disabled=true;
            document.getElementById('icon'+row).className='icon-pencil';
            document.getElementById('harga_brg'+row).disabled=true;
            if(_mode == "add"){
                addBarang();
            }

            return true;
        }
    }
}

$("tbody#itemlist").on("click","#hapus",function(){
    $(this).parent().parent().parent().remove();
    getTotal();
});

function validAct(row){
    //max kode 20
    var userVal = $("#kode_brg"+row).val();
    if(userVal.length == 20){
        alert("Maximum Kode Barang 20 Karakter");
    } 
	
    //disable alfabet di qty
    var foo = document.getElementById('qty_brg'+row);
    foo.addEventListener('input', function (prev) {
        return function (evt) {
            if (!/^\d{0,6}(?:\.\d{0,2})?$/.test(this.value)) {
              this.value = prev;
            }
            else {
              prev = this.value;
            }
        };
    }(foo.value), false);
    
    $('#qty_brg'+row).bind('textchange', function (event){
        var q = $(this).val();
        var h = document.getElementById('harga_brg'+row).value.replace(/\./g, "");
        hasil = q*h;
        $('#jumlah_brg'+row).val(accounting.formatMoney(hasil, "",0,".")); 
        getTotal();
    });
    
   $('#harga_brg'+row).bind('textchange', function (event){
        var h = $(this).val().replace(/\./g, "");
        var q = document.getElementById('qty_brg'+row).value;
        hasil = q*h;
        $('#jumlah_brg'+row).val(accounting.formatMoney(hasil, "",0,"."));
        getTotal();
        formatAngka(this,'.');
    });   
}

function countJumlah(row){
    var qty = document.getElementById('qty_brg'+row).value;
    var harga = document.getElementById('harga_brg'+row).value;
    var jumlah = document.getElementById('jumlah_brg'+row);
    
    jumlah.value = qty * harga;
    
    var arr = document.getElementsByName('jumlah');
    var total = 0;
    for(i=0; i < arr.length; i++){
        if(parseInt(arr[i].value))
            total += parseInt(arr[i].value);
    }
    $('#total').val(total);
}

temp=0;
temp2=0;
function getTotal(){
    var arr = document.getElementsByName('jumlah');

    var total = 0;
    for(i=0; i < arr.length; i++){
        if(parseInt(arr[i].value))
            total += parseInt(arr[i].value.replace(/\./g, ""));
    }
    temp=total;
    $("#ppnT").val().replace(/\./g, "");

    $('#dpp').val(accounting.formatMoney(total, "",0,"."));
    $("#total").val(accounting.formatMoney(total+temp2, "",0,"."));
    $('#ppn').val("");
    $('#ppnT').val("");
}

function hitung(){
    $('#ppn').bind('textchange', function (event){    
        disableAlpha('ppn');
        var dpp = $("#dpp").val().replace(/\./g, "");

        var h = $(this).val();
        
        ppn = dpp*h/100;
        var grand = dpp*1+1*ppn;

        $("#ppnT").val(accounting.formatMoney(ppn, "",0,"."));
        $("#total").val(accounting.formatMoney(grand, "",0,"."));
    });     

    $('#ppnT').bind('textchange', function (event){    
        //disableAlpha('ppn');
        var total = $("#dpp").val().replace(/\./g, "");

        var h = $(this).val().replace(/\./g, "");
        
        ppn = (h/total)*100;

        var grand = total*1+1*h;
        
        $("#ppn").val(ppn);
        $("#total").val(accounting.formatMoney(grand, "",0,"."));

        formatAngka(this,'.');
    });  
}
</script>
