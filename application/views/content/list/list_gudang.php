<div class="table table-hover CSSTabel">
<table id="tb4">
    <thead>
        <th>Kode</th><th>Nama</th><th>Alamat</th><th>Kota</th><th>Select</th>
    </thead>
    <tbody id="item_gudang">
    <?php
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>$row->Kode</td>
        <td>$row->Nama</td>
        <td>$row->Alamat</td>
        <td>$row->Kota</td>
        <td><input type='radio' name='optionsRadios' id='optionsPelanggan' kd='$row->Kode' nama='$row->Nama' value='$row->Nama'></td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>

<script>
$('#item_gudang tr').dblclick(function (e) {
    $(this).find('td input[type=radio]').prop('checked', true);
    getGudang();
    $('#modalGudang').modal('hide');
});

$('input:radio[name="optionsRadios"]').change(function(){
    getGudang();
    $('#modalGudang').modal('hide');
});

var oTable = $('#tb4').dataTable( {
    "sScrollYInner": "110%",
    "bPaginate": true,
    "bLengthChange": true,
    "aaSorting": [[ 4, "desc" ]],
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": "View _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
       "sPaginationType": "full_numbers",
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>