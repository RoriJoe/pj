<div class="table table-hover CSSTabel">
<table id="tb5">
    <thead>
        <th>Kode Barang</th>
        <th>Nama</th>
        <th>Satuan</th>
        <th>Qty</th>
        <th>Select</th>
    </thead>
    <tbody id="item_brg">
    <?php
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>$row->Kode</td>
        <td>$row->Nama $row->Ukuran</td>
        <td>$row->Satuan1</td>
        <td>$row->Qty1</td>
        <td><input type='radio' name='optionsRadiosBarang'
                kd='$row->Kode' 
                satuan='$row->Satuan1' 
                nama='$row->Nama' 
                ukuran='$row->Ukuran'
                harga='$row->Harga_Jual'
                value='$row->Kode'></td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>

<script>
$('#item_brg tr').dblclick(function (e) {

    $(this).find('td input[type=radio]').prop('checked', true);
    var checkRadio = $(this).find('td input[type=radio]:checked').val();
    getBarang();
    $('#modalBarang').modal('hide');
});

$('input:radio[name="optionsRadiosBarang"]').change(function(){
    getBarang();
    $('#modalBarang').modal('hide');
});
 
var oTable = $('#tb5').dataTable( {
    "sScrollYInner": "110%",
    "bPaginate": true,
    "bLengthChange": true,
    "aaSorting": [[ 2, "asc" ]],
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": "View _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>