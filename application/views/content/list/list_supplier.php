<div class="table table-hover CSSTabel">
<table id="tb6">
    <thead>
        <th>Kode</th><th>Nama</th><th>Perusahaan</th><th>Alamat</th><th>Select</th>
    </thead>
    <tbody id="item_plg tb_detail">
    <?php
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>$row->Kode</td>
        <td>$row->Nama</td>
        <td>$row->Perusahaan</td>
        <td>$row->Alamat1</td>
        <td><input type='radio' name='optionsRadios' id='optionsPelanggan' kd='$row->Kode' nama='$row->Nama' value='$row->Perusahaan'></td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>

<script>
$('#tb6 tbody tr').dblclick(function (e) {
    $(this).find('td input[type=radio]').prop('checked', true);
    getSupplier();
    $('#modalSupplier').modal('hide');
});

$('input:radio[name="optionsRadios"]').change(function(){
    getSupplier();
    $('#modalSupplier').modal('hide');
});

var oTable = $('#tb6').dataTable( {
    //"sScrollY": "250px",
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