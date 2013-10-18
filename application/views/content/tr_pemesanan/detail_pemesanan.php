<div class="table  CSSTabel" style="overflow: auto; height: 195px">
<table id="tb3">
    <thead>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Satuan</th>
        <th>Harga</th>
        <th>Nilai</th>
        <th>Action</th>
    </thead>
    <tbody>
    <?php
    $i=1;
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>
            <div class='input-append'>
                <input type='text' class='span2' id='kode_brg$i' onkeypress='validAct($i)' maxlength='20' id='appendedInputButton' name='kode_brgd' style='width:70px; text-transform: uppercase;' value='$row->Kode_barang' disabled='true'/>
                <a href='#myModal2' onclick='getDetail($i)' id='f_brg$i' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i></a>
            </div>    
        </td>
        <td>
            <input type='text' name='nama_brg' class='validate[required]' maxlength='22' id='keterangan_brg$i' style='width:80px' value='$row->Nama' disabled='true'/>
        </td>
        <td>
            <input type='text' name='qty_brg' onkeypress='validAct($i)' maxlength='5' class='validate[required]' id='qty_brg$i' style='width:30px' value='$row->Jumlah' disabled='true'/>
        </td>
        <td>
            <input type='text' name='satuan_brg' class='validate[required]' id='satuan_brg$i' style='width:70px' value='$row->Satuan1' readonly='true'/>
        </td>
        <td>
            <input type='text' name='harga_brg' onkeypress='validAct($i)' maxlength='12' class='validate[required]' id='harga_brg$i' style='width:70px' value='$row->Harga' disabled='true' />
        </td>
        <td>
            <input type='text' name='jumlah' class='validate[required]' id='jumlah_brg$i' style='width:70px' value='$row->Nilai' disabled='true'/>
        </td>
        <td>
            <a class='btn' href='#' onclick='editRow($i)' style='display:none'><i id='icon$i' class='icon-pencil' ></i></a>
            <a class='btn' href='#' onclick='deleteRowSO(this)' style='display:none'><i class='icon-trash'></i></a>
        </td>
        </tr>
        ";
        $i++;
    } ?>
    </tbody>
</table>
</div>

<script>


    function editRow(row){
    //$(this).parent().next().find('input[type="text"]').attr('disabled');
    var i = document.getElementById('kode_brg'+row);
    var j = document.getElementById('qty_brg'+row);
    var k = document.getElementById('harga_brg'+row);
    if (j.disabled == true){
        document.getElementById('f_brg'+row).style.visibility = 'visible';
        document.getElementById('qty_brg'+row).disabled=false;
        document.getElementById('icon'+row).className='icon-ok';
        document.getElementById('harga_brg'+row).disabled=false;
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
            document.getElementById('qty_brg'+row).disabled=true;
            document.getElementById('icon'+row).className='icon-pencil';
            document.getElementById('harga_brg'+row).disabled=true;
            return true;
        }
    }
}

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
    $('#total').val(total+",00");
}

function getDetail(row){
    listBarang();
    filter = row;
}

temp=0;
temp2=0;
function getTotal(){
    var arr = document.getElementsByName('jumlah');

    var total = 0;
    for(i=0; i < arr.length; i++){
        if(parseInt(arr[i].value.replace(/\./g, "")))
            total += parseInt(arr[i].value);
    }
    temp=total;
    $("#ppnT").val().replace(/\./g, "");

    $('#dpp').val(accounting.formatMoney(total, "Rp ",2,".",","));
    $("#total").val(accounting.formatMoney(total+temp2, "Rp ",2,".",","));
    $("#dpp2").val(total);
    $("#total2").val(total+temp2);
}

function hitung(){
    $('#ppn').bind('textchange', function (event){    
        disableAlpha('ppn');
        var dpp_2 = $("#dpp2").val();

        var h = $(this).val();
        if(temp != 0){
            var q = temp;
        } else if(dpp_2 != 0){
            var q = dpp_2;
        }
        
        hasil = q*h/100;

        var dpp = q;
        var ppnT = hasil;
        temp2=hasil;
        $("#ppnT").val(accounting.formatMoney(hasil, "Rp ",2,".",","));
        $("#total").val(accounting.formatMoney(q+hasil, "Rp ",2,".",","));
        $("#dpp2").val(q);
        $("#total2").val(q+hasil);

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

function validAct(row){
    //max kode 20
    var userVal = $("#kode_brg"+row).val();
    if(userVal.length == 20){
        alert("Maximum Kode Barang 20 Karakter");
    } 
	
	//disable alfabet di hrg
    var est = document.getElementById('harga_brg'+row);
    est.addEventListener('input', function (prev) {
    return function (evt) {
        if (!/^\d{0,9}(?:\.\d{0,2})?$/.test(this.value)) {
          this.value = prev;
        }
        else {
          prev = this.value;
        }
    };
    }(est.value), false);
	
	
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
        var h = document.getElementById('harga_brg'+row).value;
        hasil = q*h;
       $('#jumlah_brg'+row).val(hasil); 
       getTotal();
    });
    
    $('#harga_brg'+row).bind('textchange', function (event){
        var h = $(this).val();
        var q = document.getElementById('qty_brg'+row).value;
        hasil = q*h;
        
       $('#jumlah_brg'+row).val(hasil);
       //var lk =  $('#lk').val().replace(/\./g, "");
       getTotal();      
    });     
}
</script>
