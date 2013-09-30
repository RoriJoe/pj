<div class=" table  CSSTabel" style="overflow: auto; height: 220px">
<table id="tb3">
    <thead>
        <th>Kode Brg</th>
        <th>Nama Brg</th>
        <th>Ukuran</th>
        <th>Qty</th>
        <th>Satuan</th>
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
                id='kode_brg$i' id='appendedInputButton' name='kode_brgd' value='$row->Kd_Brg' 
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
            <input type='text' name='Nama' id='qty_brg$i' value='$row->QtySaw1' 
            onkeypress='validAct($i)' maxlength='5' 
            class='validate[required]' 
            style='width:45px' disabled='true'/>
        </td>
        <td>
            <input type='text' name='satuan' id='satuan_brg$i' value='$row->Satuan1'  
            class='validate[required]' maxlength='22' 
            style='width:80px' disabled='true'/>
        </td>
        <td>
            <a class='btn' href='#' onclick='editRow($i)' style='display:none'><i id='icon$i' class='icon-pencil'></i></a>
            <a class='btn' href='#' onclick='deleteRow(this)' style='display:none'><i class='icon-trash'></i></a>
        </td>
        </tr>
        ";
        $i++;
    } ?>
    </tbody>
</table>
</div>

<script type="text/javascript">
function getDetail(row){
    listBarang();
    filter = row;
}

function editRow(row){
    //$(this).parent().next().find('input[type="text"]').attr('disabled');
    var i = document.getElementById('kode_brg'+row);
    var j = document.getElementById('qty_brg'+row);
    
    if (j.disabled == true){
        document.getElementById('f_brg'+row).style.visibility = 'visible';
        document.getElementById('qty_brg'+row).disabled=false;
        document.getElementById('icon'+row).className='icon-ok';
        return false;
    }
    else{

        if(j.value == "" || i.value == ""){
            bootstrap_alert.warning('<b>Kesalahan!</b> Kode & Qty Harus diisi.');
        }
        else{         
            document.getElementById('f_brg'+row).style.visibility = 'hidden';
            document.getElementById('qty_brg'+row).disabled=true;
            document.getElementById('icon'+row).className='icon-pencil';
            return true;
        }
    }
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