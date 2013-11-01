<div class="table table-hover CSSTabel">
<table id="popBarangFull">
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
        <td><input type='radio' name='optionsRadiosBarang' value='$row->Kode'></td>
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
 
var lfTable = $('#popBarangFull').dataTable( {
   "aaSorting": [[ 1, "asc" ]],
    "bScrollCollapse": true,
    "bPaginate": true,
    "bAutoWidth": false,
    "bLengthChange": false,
    "bInfo": false,
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": "View _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bDeferRender": true,
    "sPaginationType": "full_numbers",
    "sDom": '<"top"i>rt<"bottom"lp><"clear">'
} );

$('#SearchBarang').keyup(function(){
      lfTable.fnFilter( $(this).val() );
})
</script>