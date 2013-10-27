<div class=" table CSSTabel">
<table>
    <thead>
        <th width="30%">Kode Brg</th>
        <th width="30%">Nama Brg</th>
        <th width="10%">Qty</th>
        <th width="20%">Keterangan</th>
        <th width="10%">Action</th>
    </thead>
</table>
<div class="table CSSTabel" style="overflow-y:scroll;height:275px;">
    <table id="tb_detail">
        <tbody id="itemlist">
        <?php
        $i=1;
        foreach($hasil as $row)
        {
            echo "<tr>
            <td width='30%'>
                <div class='input-append' style='margin-bottom:0;'>
                    <input type='text' class='span2' 
                    id='kode_brg$i' id='appendedInputButton' name='kode_brg[]' value='$row->Kode_brg' 
                    onkeypress='validAct($i)' 
                    maxlength='20' 
                    style='width:100%' disabled='true'/>
                    
                    <a href='#modalBarang' onclick='getDetail($i)' id='f_brg$i'
                     role='button' class='btn' data-toggle='modal' 
                     style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i>
                    </a>
                </div>    
            </td>
            
            <td width='30%'>
                <div class='input-append' style='margin-bottom:0;'>
                    <input type='text' class='span2' 
                    id='nama_brg$i' id='appendedInputButton' value='$row->Nama' 
                    style='width:98%' disabled='true'/>
                    
                    <a href='#modalBarang' onclick='getDetail($i)' id='f_brgs$i'
                     role='button' class='btn' data-toggle='modal' 
                     style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i>
                    </a>
                </div>    
            </td>
            <td width='10%'>
                <input type='text' name='Nama' id='qty_brg$i' value='$row->Qty1' 
                onkeypress='validAct($i)' maxlength='5' 
                class='validate[required]' 
                style='width:45px' disabled='true'/>
            </td>
            <td width='20%'>
                <input type='text' name='keterangan' id='keterangan_brg$i' value='$row->Keterangan'  
                class='validate[required]' maxlength='22' 
                style='width:80%' disabled='true'/>
            </td>
            <td width='10%'>
                <div class='btn-group' style='margin-bottom:0;'>
                    <a class='btn btn-small' href='#' onclick='editRow($i)'><i id='icon$i' class='icon-pencil'></i></a>
                    <a class='btn btn-small' href='#' id='hapus' href='javascript:void(0);'><i class='icon-trash'></i></a>
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
function editRow(row){
    //$(this).parent().next().find('input[type="text"]').attr('disabled');
    var i = document.getElementById('kode_brg'+row);
    var j = document.getElementById('qty_brg'+row);
    
    if (j.disabled == true){
        document.getElementById('f_brg'+row).style.visibility = 'visible';
        document.getElementById('f_brgs'+row).style.visibility = 'visible';
        document.getElementById('qty_brg'+row).disabled=false;
        document.getElementById('icon'+row).className='icon-ok';
        document.getElementById('keterangan_brg'+row).disabled=false;
        getDetail(row);
        $('#modalBarang').modal('show');
        return false;
    }
    else{
        var arr = document.getElementsByName('kode_brg[]');

        if(i.value == "" || j.value == ""){
            bootstrap_alert.warning('<b>Kesalahan!</b> Field Kode, Qty, Harus diisi.');
        }
        else if($.inArray(i.value, arr) != -1){
            bootstrap_alert.warning('<b>Kesalahan!</b> Barang sudah ada dalam daftar.');
        }
        else{          
            document.getElementById('f_brg'+row).style.visibility = 'hidden';
            document.getElementById('f_brgs'+row).style.visibility = 'hidden';
            document.getElementById('qty_brg'+row).disabled=true;
            document.getElementById('icon'+row).className='icon-pencil';
            document.getElementById('keterangan_brg'+row).disabled=true;

            var _mode = $('#save').attr("mode");
            if(_mode == "add"){
                addBarang();
                return true;
            }
        }
    }
}
/*
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
}*/

$("tbody#itemlist").on("click","#hapus",function(){
    $(this).parent().parent().parent().remove();
});

function getDetail(row){
    listBarang();
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