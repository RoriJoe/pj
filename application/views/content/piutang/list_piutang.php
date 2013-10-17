<div class="table CSSTabel table-fluid table-hover">
    <table id="tb1">
        <thead>
            <th>Pelanggan</th>
            <th>Kota</th>
        </thead>

        <tbody>
        <?php foreach($hasil as $row)
        {
            echo
            "<tr
                kode = '$row->Kode'
                piutang = '$row->Piutang'
                limit = '$row->Limit'
                pelanggan = '$row->Perusahaan'
            >
                <td>$row->Perusahaan</td>
                <td>$row->Kota</td>
            </tr>";
        } ?>
        </tbody>
    </table>
</div>

<script>
$('#tb1 tr').click(function (e) {
    $('#bayar').attr('disabled', false);
    
    $('#_kode_pelanggan').val($(this).attr("kode"));
    $('#_pelanggan').val($(this).attr("pelanggan"));
    $('#_piutang').val($(this).attr("piutang"));
    $('#_limit').val($(this).attr("limit"));

    get_invoice($(this).attr("kode"));
});
    
var oTable = $('#tb1').dataTable( {
    "sScrollY": "290px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": false,
    "aaSorting": [[ 4, "desc" ]],
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>