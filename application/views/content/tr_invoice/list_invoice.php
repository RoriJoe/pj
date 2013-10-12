<div class="table CSSTabel table-list table-hover" style="height: 395px;">
    <table id="tbl_list">
        <thead>
            <th>No Invoice</th>
            <th>Nomor SO</th>
        </thead>

        <tbody>
        <?php foreach($hasil as $row)
        {   $originalDate1 = $row->Tgl;
            $dmy1 = date("d-m-Y", strtotime($originalDate1));
            echo
            "<tr
                kode = $row->Kode
                so = $row->Kode_SO
                term = $row->Term
                tgl = $dmy1
                plg = $row->Perusahaan
                alamat = $row->Alamat1
            >

                <td>$row->Kode</td>
                <td>$row->Kode_SO</td>
            </tr>";
        } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$('#tbl_list tr').click(function (e) {
    $('#delete').attr('disabled', false);
    
    var id = $(this).attr("kode"); 
    var tgl = $(this).attr("tgl");
    var so = $(this).attr("so");
    var term = $(this).attr("term");
    var plg = $(this).attr("plg");
    var alamat = $(this).attr("alamat");
    
    $('#no_invo').val(id);
    $('#_tgl1').val(tgl);
    $('#so').val(so);
    $('#term').val(term);
    $('#plg').val(plg);
    $('#al').val(alamat);

    
    $('#save').attr('mode','edit');
    detail_SO();
});


var oTable = $('#tbl_list').dataTable( {
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