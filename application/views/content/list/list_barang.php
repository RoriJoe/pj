<div class="table table-hover CSSTabel">
<table id="tb5">
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
            <td><input type='radio' name='optionsRadiosBarang'
                    kd='$row->Kode' 
                    satuan='$row->Satuan1' 
                    nama='$row->Nama' 
                    ukuran='$row->Ukuran'
                    harga='$row->Harga_Jual'
                    value='$row->Kode'></td>
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

    }   ?>
    </tbody>
</table>
</div>

<script>
$('#tb5 tbody tr').dblclick(function (e) {
    $(this).find('td input[type=radio]').prop('checked', true);
    var checkRadio = $(this).find('td input[type=radio]:checked').val();

    if (checkRadio != null){
        getBarang();
        $('#modalBarang').modal('hide');
    }
});

$('input:radio[name="optionsRadiosBarang"]').change(function (e){
    getBarang();
    $('#modalBarang').modal('hide');
});
 
var oTable = $('#tb5').dataTable( {
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