<div class="table table-hover CSSTabel">
<table id="tb4">
    <thead>
        <th width="15%">Kode</th>
        <th width="20%">Perusahaan</th>
        <th width="30%">CP</th>
        <th width="20%">Alamat</th>
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
        <td>$row->Alamat1</td>
        <td><input type='radio' name='optionsRadios' kd='$row->Kode' nama='$row->Perusahaan' term='$row->Lama' value='$row->Perusahaan'></td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>

<script>
    
$('#tb4 tbody tr').dblclick(function (e) {
    $(this).find('td input[type=radio]').prop('checked', true);
    getPelanggan();
    $('#modalPelanggan').modal('hide');
});

$('input:radio[name="optionsRadios"]').change(function(){
    getPelanggan();
    $('#modalPelanggan').modal('hide');
});

var oTable = $('#tb4').dataTable( {
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
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>