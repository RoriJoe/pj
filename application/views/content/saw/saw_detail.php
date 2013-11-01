<div class=" table  CSSTabel">
<table id="tb3">
    <thead>
        <th>Kode Brg</th>
        <th>Nama Brg</th>
        <th>Satuan</th>
        <th>Qty</th>
        <th>Selisih</th>
    </thead>
    <tbody id="tb_detail">
    <?php
    $i=1;
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>
                <input type='text' class='span2' style='width:120px;padding: 2px 3px;' id='kode_brg$i' name='kode_brgd' value='$row->Kode' disabled='disabled'/>
        </td>
        
        <td>
            $row->Nama $row->Ukuran
        </td>
        <td>
            $row->Satuan1
        </td>
        <td>
            <input type='text' name='Nama' id='qty_brg$i'  
            onkeypress='validAct($i)' maxlength='5' 
            class='validate[required] span2' 
            style='width:45px;padding: 2px 3px;' />
        </td>
        <td>
			<input type='text' name='selisih' id='selisih$i' 
            class='validate[required] span2' 
            style='width:40px;padding: 2px 3px;' readonly='true'/>
			<input type='hidden' id='qtyop$i' name='qtyop$i' style='visibility: hidden;' value='$row->QtyOp'/>
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
	
	$('#qty_brg'+row).bind('textchange', function (event){
        var q = $(this).val();
        var h = $("#qtyop"+row).text();
        hasil = q-h;
       $('#selisih'+row).val(hasil); 
       
    });
}

var oTable = $('#tb3').dataTable( {
    "sScrollY": "200px",
    "sScrollYInner": "100%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": true,
    "aaSorting": [[ 1, "asc" ]],
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": " _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "sPaginationType": "full_numbers",
    "bInfo": true//Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>