<div class="table CSSTabel table-list2" style="top:-22px; margin-top: 5px;">
<table id="tbdsj">
    <thead>
        <th>Kode</th>
        <th>Barang & Ukuran</th>
        <th>Nama Barang SJ</th>
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
        <td id='1'>
            <div class='input-append'>
                <input type='text' class='validate[required]' id='kode_brg$i' id='appendedInputButton' name='kode_brg$i' value='$row->Kode_Brg' style='width:100px'; disabled='true'>
                <a href='#myModal' onclick='getDetail($i)' id='f_brg$i' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i></a>
            </div>
        </td>
        <td >
            <div class='input-append'>
                <input type='text' class='validate[required]' id='brg_ukur$i' name='brg_ukur$i' value='$row->Barang' style='width:120px'; disabled='true'>
                <a href='#myModal' onclick='getDetail($i)' id='f_brg$i' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px; visibility: hidden;'><i class='icon-filter'></i></a>
            </div>
        </td>
        <td><label id='nbu$i'>$row->Barang_SJ</label></td>
        <td ><input type='text' class='validate[required]' id='qty$i' name='qty$i' value='$row->Qty1' style='width:20px'; disabled='true'></td>
        <td><input type='text' class='validate[required]' id='ket$i' name='ket$i' value='$row->Keterangan' style='width:120px'; disabled='true'></td>
        <td>
           <div class='btn-group'>
                <a class='btn' name='edit' id='edit$i' href='#' onclick='editRow($i)'><i id='icon$i' class='icon-pencil'></i></a>
                <a class='btn' name='delete' id='delete$i' href='#' onclick='deleteRow(this)'><i class='icon-trash'></i></a>
            </div>
        </td>
        </tr>
        ";
        $i++;
    }
    $tottx=$i-1;
    echo
        "<div style='visibility: hidden;'><label id='jmltx'> $tottx </label></div> ";
    ?>
    </tbody>
</table>
</div>

<script>
jQuery(document).ready(function() {
    var kirim = $('#kirim').val();
    var table = document.getElementById('tbdsj');
    var rowCount = table.rows.length;

    var i;
    for(i=1; i<rowCount; i++){
        if(kirim > 0){
            document.getElementById('edit'+i).style.visibility = 'hidden';
            document.getElementById('delete'+i).style.visibility = 'hidden';
        }
        else
        {
            document.getElementById('edit'+i).style.visibility = 'visible';
            document.getElementById('delete'+i).style.visibility = 'visible';
        }
    }
    
});

function editRow(row){
    //$(this).parent().next().find('input[type="text"]').attr('disabled');
    var i = document.getElementById('kode_brg'+row);
    if (i.disabled == true){
        document.getElementById('kode_brg'+row).disabled=false;
        document.getElementById('f_brg'+row).style.visibility = 'visible';
        document.getElementById('icon'+row).className='icon-ok';
        document.getElementById('brg_ukur'+row).disabled=false;
        document.getElementById('qty'+row).disabled=false;
        document.getElementById('ket'+row).disabled=false;
        return false;
    }
    else{
        document.getElementById('kode_brg'+row).disabled=true;
        document.getElementById('f_brg'+row).style.visibility = 'hidden';
        document.getElementById('icon'+row).className='icon-pencil';
        document.getElementById('brg_ukur'+row).disabled=true;
        document.getElementById('qty'+row).disabled=true;
        document.getElementById('ket'+row).disabled=true;
        return true;
    }
}

function getDetail(row){
    filter = row;
}

function viewRow(row){
     var k = $('#brg_ukr'+row).val();
     $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_surat_jalan/viewBarang",
        data :{k:k},
        success: function(msg){
            $('#popup-wrapper3').html(msg);
        }
    });
}

function deleteRow(row) {
    try {
        var i=row.parentNode.parentNode.rowIndex;
        var table = document.getElementById('tbdsj');
        alert(i);
        var rowCount = table.rows.length;

            if(rowCount <= 1) {
                alert("Detail Surat Jalan Tidak Boleh Kosong");
            }else{
               table.deleteRow(i);
               rowCount--;
               i--;
            }
    }catch(e) {
        alert(e);
    }
}


var oTable = $('#tbdsj').dataTable( {
    "sScrollY": 180,
    "sScrollX": "100%",
//    "sScrollXInner": "110%",
    "bPaginate": false,
    "bFilter": false,
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
