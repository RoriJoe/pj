<div class="table table-hover CSSTabel">
<table id="popListPelanggan">
    <thead>
        <th width="15%">Kode</th>
        <th width="40%">Perusahaan</th>
        <th width="40%">Contact Person</th>
        <th width="5%">Select</th>
    </thead>
    <tbody id="item_plg tb_detail">
    <?php
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>$row->Kode</td>
        <td>$row->Perusahaan</td>
        <td>$row->Nama</td>
        <td><input type='radio' name='optionsRadios' kd='$row->Kode' nama='$row->Perusahaan' term='$row->Lama' alamat='$row->Alamat1' value='$row->Perusahaan'></td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>

<script>
$('#popListPelanggan tbody tr').dblclick(function (e) {
    $(this).find('td input[type=radio]').prop('checked', true);
    getPelanggan();
    $('#modalPelanggan').modal('hide');
});

$('input:radio[name="optionsRadios"]').change(function(){
    getPelanggan();
    $('#modalPelanggan').modal('hide');
});

var lTable = $('#popListPelanggan').dataTable( {
        "aaSorting": [[ 0, "asc" ]],
        "bScrollCollapse": true,
        "bPaginate": true,
        "bAutoWidth": true,
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

$('#SearchPelanggan').keyup(function(){
    lTable.fnFilter( $(this).val() );
})
</script>