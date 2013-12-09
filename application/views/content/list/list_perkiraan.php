<div class="table table-hover CSSTabel">
<table id="popListPelanggan">
    <thead>
        <th width="40%">No Akun</th>
        <th width="40%">Nama</th>
        <th width="15%">Level</th>
        <th width="5%">Select</th>
    </thead>
    <tbody id="item_plg tb_detail">
    <?php
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>$row->nomoraccount</td>
        <td>$row->namaaccount</td>
        <td>$row->level</td>
        <td><input type='radio' name='optionsRadios' kd='$row->nomoraccount' nama='$row->namaaccount' level='$row->level'  value='$row->namaaccount'></td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>

<script>
$('#popListPelanggan tbody tr').dblclick(function (e) {
    $(this).find('td input[type=radio]').prop('checked', true);
    getPerkiraan();
    $('#modalPelanggan').modal('hide');
});

$('input:radio[name="optionsRadios"]').change(function(){
    getPerkiraan();
    $('#modalPelanggan').modal('hide');
});

var lTable = $('#popListPelanggan').dataTable( {
        "aaSorting": [[ 1, "asc" ]],
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