<div class="table CSSTabel table-list2">
<table id="tb_detail">
    <thead>
        <th width="10%">Kode</th>
        <th width="30%">Barang & Ukuran</th>
        <th width="30%">Nama Barang SJ</th>
        <th width="10%">Qty</th>
        <th width="15">Keterangan</th>
        <th width="5%">Action</th>
    </thead>

    <tbody id="itemList">
    <?php
    $i=1;
    foreach($hasil as $row)
    {
        $namaSJ = htmlentities($row->Barang_SJ);	
        $ukuran = htmlentities($row->Nama.' '.$row->Ukuran);    
       echo "<tr>
        <td>
            <div class='input-append' style='margin-bottom:0;'>
                <input type='text' class='validate[required] span2' id='kode_brg$i' id='appendedInputButton' name='kode_brg[]' style='width:100px' value='$row->Kode_Brg' disabled='true'/>
                <a href='#modalBarang' onclick='getDetail($i)' id='f_brg$i' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i></a>
            </div>
        </td>
        <td>
            <div class='input-append' style='margin-bottom:0;'>
                <input type='text' class='validate[required]' id='brg_ukur$i' name='brg_ukur[]' style='width:140px' value=\"".$ukuran."\" disabled='true'/>
                <a href='#modalBarang' onclick='getDetail($i)' id='f_brgs$i' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i></a>
            </div>
        </td>
        <td>
            <input type='text' class='validate[required]' id='nbu$i' name='nbu[]' style='width:140px' value=\"".$namaSJ."\" disabled='true'/>
        </td>
        <td>
            <input type='hidden' id='last_qty$i' value='$row->Qty'/>
            <input type='text' class='validate[required]' onkeypress='validAct($i)' maxlength='5' id='qty$i' name='qty[]' style='width:45px' placeholder='$row->Qty' value='$row->Qty' maxlength='5' disabled='true'/></td>
        <td><input type='text' class='validate[required]' id='ket$i' name='ket[]' style='width:120px' value='$row->Keterangan' disabled='true'/></td>
        <td>
            <div class='btn-group' style='margin-bottom:0;'>
		        <a class='btn btn-small' id='edit$i' href='#' name='pencil' onclick='editRow($i)'><i id='icon$i' class='icon-pencil'></i></a>
            </div>
        </td>
        </tr>
        ";
        $i++;
    }?>
    </tbody>
</table>
</div>

<script>
visibleEdit();
function visibleEdit() {
    var kirim = $('#kirim').val();
    var table = document.getElementById('tb_detail');
    var rowCount = table.rows.length;

    var i;
    for(i=1; i<rowCount; i++){
        if(kirim > 0){
            $('#edit'+i).hide();
            document.getElementById('save').disabled = true;
        }
        else
        {
            $('#edit'+i).show();
            document.getElementById('save').disabled = false;
        }
    }
    
}

function editRow(row){
    //$(this).parent().next().find('input[type="text"]').attr('disabled');
    var i = document.getElementById('kode_brg'+row);
    var j = document.getElementById('qty'+row);
    if (j.disabled == true){
        document.getElementById('f_brg'+row).style.visibility = 'visible';
        document.getElementById('f_brgs'+row).style.visibility = 'visible';
        document.getElementById('icon'+row).className='icon-ok';
        document.getElementById('qty'+row).disabled=false;
        document.getElementById('ket'+row).disabled=false;
        document.getElementById("qty"+row).focus();
        return false;
    }
    else{
        document.getElementById('f_brg'+row).style.visibility = 'hidden';
        document.getElementById('f_brgs'+row).style.visibility = 'hidden';
        document.getElementById('icon'+row).className='icon-pencil';
        document.getElementById('qty'+row).disabled=true;
        document.getElementById('ket'+row).disabled=true;
        return true;
    }
}

function getDetail(row){
    filter = row;
}

function deleteRow(row) {
    try {
        var i = row.parentNode.parentNode.rowIndex;
        var table = document.getElementById('tb_detail');
        var rowCount = table.rows.length;
        if(rowCount <= 1) {
            bootstrap_alert.warning('<b>Gagal Menghapus</b> Detail Table Tidak Boleh Kosong');
        }else{
           table.deleteRow(i);
           rowCount--;
           i--;
        }
    }catch(e) {
        alert(e);
    }
}

function validAct(row){
    //max qty 5
    var qty = $("#qty"+row).val();
    if(qty.length == 5){
        bootstrap_alert.warning("Maximum Qty 5 Angka");
    }   
        
    //disable alfabet di qty
    var foo = document.getElementById('qty'+row);
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

    $('#qty'+row).bind('textchange', function (event){
        var q = $(this).val();
        var qty_before = $("#last_qty"+row).val();
        if(q > qty_before){
            bootstrap_alert.warning("Qty tidak boleh lebih besar dari Qty di SO");
            $('#save').attr('disabled',true);
        } else{
            $('#save').attr('disabled',false);
        }
        });
}


var oTable = $('#tb_detail').dataTable( {
    "sScrollY": "180px",
    "sScrollYInner": "100%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
