<div class="table table-hover CSSTabel">
<table id="tb5">
    <thead>
        <th width="20%">Kode Barang</th>
        <th width="30%">Nama</th>
        <th width="15%">Ukuran</th>
        <th width="15%">Satuan</th>
        <th width="15%">Qty</th>
        <th width="10%">Select</th>
    </thead>
    <tbody id="item_brg">
    <?php
    foreach($hasil as $row)
    {
        if($row->Qty1 > 0){
            echo "<tr>
            <td>$row->Kode</td>
            <td>$row->Nama</td>
            <td>$row->Ukuran</td>
            <td>$row->Satuan1</td>
            <td>$row->Qty1</td>
            <td><input type='radio' name='optionsRadios'
                    kd='$row->Kode' 
                    satuan='$row->Satuan1' 
                    nama='$row->Nama' 
                    ukuran='$row->Ukuran'
                    value='$row->Kode'></td>
            </tr>
            ";
        }else{
            echo "<tr>
            <td>$row->Kode</td>
            <td>$row->Nama</td>
            <td>$row->Ukuran</td>
            <td>$row->Satuan1</td>
            <td>$row->Qty1</td>
            <td></td>
            </tr>
            ";
        }

    }   ?>
    </tbody>
</table>
</div>

<script>
$('#item_brg tr').dblclick(function (e) {

    $(this).find('td input[type=radio]').prop('checked', true);
    var checkRadio = $(this).find('td input[type=radio]:checked').val();

    if (checkRadio != null){
        getBarang();
        $('#myModal').modal('hide');
    }
    
});

$('input:radio[name="optionsRadios"]').change(function(){
    getBarang();
    $('#myModal').modal('hide');
});
 
var oTable = $('#tb5').dataTable( {
    "sScrollY": "240px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": true,
    "aaSorting": [[ 4, "desc" ]],
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": "View _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>