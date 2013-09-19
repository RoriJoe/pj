<div class=" table  CSSTabel table-hover" style="overflow: auto; height: 220px">
<table id="tb3">
    <thead>
        <th>Kode_Brg</th>
        <th>Nama_Brg</th>
        <th>Ukuran</th>
        <th>Qty</th>
        <th>Keterangan</th>
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
                <input type='text' class='span2' 
                id='kode_brg$i' id='appendedInputButton' name='kode_brgd' value='$row->Kode_brg' 
                onkeypress='validAct($i)' 
                maxlength='20' 
                style='width:70px' disabled='true'/>
                
                <a href='#myModal3' onclick='getDetail($i)' id='f_brg$i'
                 role='button' class='btn' data-toggle='modal' 
                 style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i>
                </a>
            </div>    
        </td>
        
        <td>
            <input type='text' name='nama_brg' id='nama_brg$i' value='$row->Nama'  
            class='validate[required]' 
            onkeypress='validAct($i)' 
            maxlength='25'
            style='width:95px' disabled='true'/>
        </td>
        
        <td>
            <input type='text' name='ukuran_brg' id='ukuran_brg$i' value='$row->Ukuran'
            class='validate[required]' 
            style='width:70px' readonly='true'/>
        </td>
        <td>
            <input type='text' name='Nama' id='qty_brg$i' value='$row->Qty1' 
            onkeypress='validAct($i)' maxlength='5' 
            class='validate[required]' 
            style='width:45px' disabled='true'/>
        </td>
        <td>
            <input type='text' name='keterangan' id='keterangan_brg$i' value='$row->Keterangan'  
            class='validate[required]' maxlength='22' 
            style='width:80px' disabled='true'/>
        </td>
        <td>
            <a class='btn' href='#' onclick='editRow($i)'><i id='icon$i' class='icon-pencil'></i></a>
            <a class='btn' href='#' onclick='deleteRow(this)'><i class='icon-trash'></i></a>
        </td>
        </tr>
        ";
        $i++;
    } ?>
    </tbody>
</table>
</div>
</div>
<br/>

<script>
function editRow(row){
    //$(this).parent().next().find('input[type="text"]').attr('disabled');
    var i = document.getElementById('kode_brg'+row);
    var j = document.getElementById('qty_brg'+row);
    
    if (i.disabled == true){
        document.getElementById('kode_brg'+row).disabled=false;
        document.getElementById('f_brg'+row).style.visibility = 'visible';
        document.getElementById('qty_brg'+row).disabled=false;
        document.getElementById('icon'+row).className='icon-ok';
        document.getElementById('keterangan_brg'+row).disabled=false;
        return false;
    }
    else{
        var arr = document.getElementsByName('kode_brgd');

        if(i.value == "" || j.value == ""){
            bootstrap_alert.warning('<b>Kesalahan!</b> Field Kode, Qty, Harga Harus diisi.');
        }
        else if($.inArray(i.value, arr) != -1){
            bootstrap_alert.warning('<b>Kesalahan!</b> Barang sudah ada dalam daftar.');
        }
        else{
            document.getElementById('kode_brg'+row).disabled=true;            
            document.getElementById('f_brg'+row).style.visibility = 'hidden';
            document.getElementById('qty_brg'+row).disabled=true;
            document.getElementById('icon'+row).className='icon-pencil';
            document.getElementById('keterangan_brg'+row).disabled=true;
            return true;
        }
    }
}

function deleteRow(row) {
    try {
        var i = row.parentNode.parentNode.rowIndex;
        var table = document.getElementById('tb3');
        var rowCount = table.rows.length-1;
        if(rowCount <= 1) {
            alert("Detail SO Tidak Boleh Kosong");
        }else{
           table.deleteRow(i);
           rowCount--;
           i--;
        }
    }catch(e) {
        alert(e);
    }
}

function getDetail(row){
    filter = row;
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
}

</script>