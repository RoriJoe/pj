<div class="table table-hover CSSTabel">
    <table id="popBarang">
        <thead>
            <th>Kode Barang</th>
            <th>Nama & Ukuran</th>
            <th>Satuan</th>
            <th>Qty</th>
            <th>Select</th>
        </thead>
        <tbody id="item_brg tb_detail">
            <?php
            foreach($hasil as $row)
            {
                if($row->Qty1 > 0){
                    echo "<tr>
                    <td>$row->Kode</td>
                    <td>$row->Nama $row->Ukuran</td>
                    <td>$row->Satuan1</td>
                    <td>$row->Qty1</td>
                    <td><input type='radio' name='optionsRadiosBarang' value='$row->Kode'></td>
                    </tr>
                    ";
                }else{
                    echo "<tr>
                    <td>$row->Kode</td>
                    <td>$row->Nama $row->Ukuran</td>
                    <td>$row->Satuan1</td>
                    <td>$row->Qty1</td>
                    <td></td>
                    </tr>
                    ";
                }

            }?>
        </tbody>
    </table>
</div>

<script>
$('#popBarang tbody tr').dblclick(function (e) {
    $(this).find('td input[type=radio]').prop('checked', true);
    var checkRadio = $(this).find('td input[type=radio]:checked').val();
    getBarang();
    $('#modalBarang').modal('hide');
});

$('input:radio[name="optionsRadiosBarang"]').change(function(){
    getBarang();
    $('#modalBarang').modal('hide');
});
 
var bTable = $('#popBarang').dataTable( {
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
    //"sScrollY": "200",
    "sPaginationType": "full_numbers",
    "sDom": '<"top"i>rt<"bottom"lp><"clear">'
} );

$('#SearchBarang').keyup(function(){
      bTable.fnFilter( $(this).val() );
})
</script>