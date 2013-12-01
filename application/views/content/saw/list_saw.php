<div class="table table-hover CSSTabel table-list">
    <table id="tb1">
        <thead>
            <th>Kode Trans</th>
            <th>Gudang</th>
        </thead>

        <tbody>
        <?php foreach($hasil as $row)
        {
            $originalDate1 = $row->Tgl;
            $dmy1 = date("d-m-Y", strtotime($originalDate1));
            echo
            "<tr no_Saw = '$row->No_Saw' 
                 tgl = '$dmy1'
                 kd_gud = '$row->Kd_Gudang'
                 nm_gud = '$row->Nama'>
                <td>$row->No_Saw</td>
                <td>$row->Nama</td>
            </tr>";
        } ?>
        </tbody>
    </table>
</div>

<script>
$('#tb1 tr').click(function (e) {
    $('#delete').attr('disabled', false);
    $("#noSaw").attr('disabled',true);

    <?php if ($this->authorization->is_permitted('update_stock')) : ?>
        $('#add').attr('mode','edit');
        $('#save').attr('mode','edit');
    <?php else: ?>
        $("#save").attr('disabled',true);
    <?php endif; ?>

    $('#cancel').attr('disabled',false);
    
    $('#noSaw').val($(this).attr("no_Saw"));
    $('#kd_gd').val($(this).attr("kd_gud"));
    $('#gud').val($(this).attr("nm_gud"));
    $('#_tgl').val($(this).attr("tgl"));
    document.getElementById('selList').style.visibility = 'visible';
    document.getElementById('loadBtn').style.visibility = 'hidden';
    qtyBarang();
});
    
var oTable = $('#tb1').dataTable( {
    "sScrollY": "380px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": true,
    "aaSorting": [[ 4, "desc" ]],
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": " _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>