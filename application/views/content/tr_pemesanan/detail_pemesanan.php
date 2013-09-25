<<<<<<< HEAD
<?php
    phpinfo();
?>
=======
<div class="table  CSSTabel" style="overflow: auto; height: 228px">
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
                <input type='text' class='span2' id='kode_brg$i' onkeypress='validAct($i)' maxlength='20' id='appendedInputButton' name='kode_brgd' style='width:70px' value='$row->Kode_barang' disabled='true'/>
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
            <input type='text' name='harga_brg' onkeypress='validAct($i)' maxlength='12' class='validate[required]' id='harga_brg$i' style='width:70px' value='$row->Harga' disabled='true'/>
        </td>
        <td>
            <input type='text' name='jumlah' class='validate[required]' id='jumlah_brg$i' style='width:70px' value='$row->Nilai' disabled='true'/>
        </td>
        <td>
            <a class='btn' href='#' onclick='editRow($i)'><i id='icon$i' class='icon-pencil'></i></a>
            <a class='btn' href='#' onclick='deleteRowSO(this)'><i class='icon-trash'></i></a>
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
    if (i.disabled == true){
        document.getElementById('kode_brg'+row).disabled=false;
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
            alert("Detail PO Tidak Boleh Kosong");
        }else{
           table.deleteRow(i);
           rowCount--;
           i--;
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
    filter = row;
}

function getTotal(){
    var arr = document.getElementsByName('jumlah');
    var total = 0;
    for(i=0; i < arr.length; i++){
        if(parseInt(arr[i].value))
            total += parseInt(arr[i].value);
    }
    $('#total').val(total+",00");
}

function validAct(row){
    //max kode 20
    var userVal = $("#kode_brg"+row).val();
    if(userVal.length == 20){
        alert("Maximum Kode Barang 20 Karakter");
    } 
    
    //max qty 5
    var qty = $("#qty_brg"+row).val();
    if(qty.length == 5){
        alert("Maximum Qty 5 Angka");
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
       getTotal();
    });
}
</script>
>>>>>>> 5b157d4c2def79fddaf1aeb020df420b65eaa098
