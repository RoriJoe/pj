<div class="table table-hover CSSTabel">
<table id="tb4">
    <thead>
        <th>Kode</th><th>Perusahaan</th><th>Contact Person</th><th>Alamat</th><th>Select</th>
    </thead>
    <tbody id="item_plg">
    <?php
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>$row->Kode</td>
        <td>$row->Perusahaan</td>
        <td>$row->Nama</td>
        <td>$row->Alamat1</td>
        <td><input type='radio' name='optionsRadios' kd='$row->Kode' nama='$row->Perusahaan' value='$row->Perusahaan'></td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>

<script>
    
$('#item_plg tr').dblclick(function (e) {

    $(this).find('td input[type=radio]').prop('checked', true);
    var checkRadio = $(this).find('td input[type=radio]:checked').val();

    if (checkRadio != null){
        getPelanggan();
        $('#modalPelanggan').modal('hide');
    }
    
});

$('input:radio[name="optionsRadios"]').change(function(){
    getPelanggan();
    $('#modalPelanggan').modal('hide');
});

$(document).ready(function() {
    var oTable = $('#tb4').dataTable( {
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
});
</script>