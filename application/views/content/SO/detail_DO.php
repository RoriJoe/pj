<div class="table CSSTabel">
<table>
    <thead>
        <th width="15%">Kode Barang</th>
        <th width="22%">Nama</th>
        <th width="8%">Qty</th>
        <th width="15%">Hrg Satuan(RP)</th>
        <th width="15%">Nilai(RP)</th>
        <th width="15%">Keterangan</th>
        <th width="10%">Action</th>
    </thead>
</table>
<div class="" style="overflow-y:scroll;height:215px;">
    <table class="table" id="tb_detail">
        <tbody id="itemlist">
        <?php
        $i=1;
        foreach($hasil as $row)
        {
            $ukuran = htmlentities($row->Nama.' '.$row->Ukuran);  
            $harga_satuan = number_format($row->Harga, 0, ',', '.');
            $jumlah_nilai = number_format($row->Jumlah, 0, ',', '.');
            echo "<tr>
            <td width='15%'>
                <div class='input-append'>
                    <input type='hidden' id='last_kode$i' value='$row->Kode_Brg'/>
                    <input type='text' class='span2' id='kode_brg$i' onkeypress='validAct($i)' maxlength='20' id='appendedInputButton' name='kode_brgd' style='width:92px' value='$row->Kode_Brg' disabled='true'/>
                    <a href='#modalBarang' onclick='getDetail($i)' id='f_brg$i' role='button' class='btn detail-append' data-toggle='modal' style='visibility: hidden;'><i class='icon-filter'></i></a>
                </div>    
            </td>
            <td width='22%'>
                <div class='input-append'>
                <input type='text' name='nama_brg' class='validate[required]' id='nama_brg$i' style='width:132px' value=\"".$ukuran."\" readonly='true'/>
                <a href='#modalBarang' onclick='getDetail($i)' id='f_brgs$i' role='button' class='btn detail-append' data-toggle='modal' style='visibility: hidden;'><i class='icon-filter'></i></a>
                </div>
            </td>
            <td width='8%'>
                <input type='hidden' id='cur_qty$i' value='$row->Qty1'/>
                <input type='hidden' id='last_qty$i' value='$row->Qty'/>
                <input type='text' name='qty_brg' onkeypress='validAct($i)' maxlength='5' class='validate[required]' id='qty_brg$i' style='width:40px;text-align:right;' value='$row->Qty' disabled='true'/>
            </td>
            <td width='15%'>
                <input type='text' name='harga_brg' onkeypress='validAct($i)' maxlength='12' class='validate[required]' id='harga_brg$i' style='width:93px; text-align:right;' value='$harga_satuan' disabled='true'/>
            </td>
            <td width='15%'>
                <input type='text' name='jumlah' class='validate[required]' id='jumlah_brg$i' style='width:93px;text-align:right;' value='$jumlah_nilai' disabled='true'/>
            </td>
            <td width='15%'>
                <input type='text' name='keterangan' class='validate[required]' maxlength='22' id='keterangan_brg$i' style='width:93px' value='$row->Keterangan' disabled='true'/>
            </td>
            <td width='10%' style='text-align:center'>
            <div class='btn-group' style='margin-bottom:0;'>
                <a class='btn' id='edit$i' href='#' onclick='editRow($i)'><i id='icon$i' class='icon-pencil'></i></a>
                <a class='btn' id='' title='Unabled Delete Saved Detail Data' disabled><i class='icon-trash'></i></a>
            </div>
            </td>
            </tr>
            ";
            $i++;
        } ?>
    </tbody>
    </table>
</div>

<script>
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
        document.getElementById('harga_brg'+row).disabled=false;
        document.getElementById('keterangan_brg'+row).disabled=false;
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
            document.getElementById('f_brg'+row).style.visibility = 'hidden';
            document.getElementById('f_brgs'+row).style.visibility = 'hidden';
            document.getElementById('qty_brg'+row).disabled=true;
            document.getElementById('icon'+row).className='icon-pencil';
            document.getElementById('icon'+row).title='Edit Detail';
            document.getElementById('harga_brg'+row).disabled=true;
            document.getElementById('keterangan_brg'+row).disabled=true;
            
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

function deleteRowSO(row) {
    try {
        var i = row.parentNode.parentNode.rowIndex;
        var table = document.getElementById('tb3');
        var rowCount = table.rows.length-1;
        if(rowCount <= 1) {
            bootstrap_alert.warning('<b>Gagal Menghapus</b> Detail Table Tidak Boleh Kosong');
        }else{
           table.deleteRow(i);
           rowCount--;
           i--;
           getTotal();
        }
    }catch(e) {
        alert(e);
    }
}

function getDetail(row){
    filter = row;
}

temp=0;

function validAct(row){
    //max kode 20
    var userVal = $("#kode_brg"+row).val();
    if(userVal.length == 20){
        bootstrap_alert.warning("Maximum Kode Barang 20 Karakter");
    } 
    
    //max qty 5
    var qty = $("#qty_brg"+row).val();
    if(qty.length == 5){
        bootstrap_alert.warning("Maximum Qty 5 Angka");
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

//FUNGSI HITUNG
    $('#qty_brg'+row).bind('textchange', function (event){
        var q = $(this).val();
        var h = document.getElementById('harga_brg'+row).value.replace(/\./g, "");
        var qty_before = parseInt($('#last_qty'+row).val());
        var qty_available = parseInt($('#cur_qty'+row).val());
        qty_now = qty_before + qty_available;

        if(q > parseInt(qty_now)){
            bootstrap_alert.warning("Persediaan Penjualan untuk Barang ini Max. "+qty_now);
            $('#qty_brg'+row).val("");
        } else{
            hasil = q*h;
            $('#jumlah_brg'+row).val(accounting.formatMoney(hasil, "",0,".")); 
            getTotal();
        }
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

//NILAI
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
//TOTAL
function getTotal(){
    var arr = document.getElementsByName('jumlah');
    var total = 0;
    for(i=0; i < arr.length; i++){
        if(parseInt(arr[i].value))
            total += parseInt(arr[i].value.replace(/\./g, ""));
    }
    temp=total;
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
    $("#granT").val(accounting.formatMoney(dpp, "",0,"."));
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
        $("#granT").val(accounting.formatMoney(dpp, "",0,"."));
        formatAngka(this,'.');
    });         
}

function hitungPPN(){
    $('#ppn').bind('textchange', function (event){    
        var dpp = $("#dpp").val().replace(/\./g, "");
        var h = $(this).val();
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

</script>