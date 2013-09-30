<div class="table CSSTabel table-list table-hover">
<table id="tb2">
    <thead>
        <th>No BPB</th>
        <th>Gudang</th>
        <th>Tanggal</th>
    </thead>

    <tbody>
    <?php foreach($hasil as $row)
    {
        echo
        "<tr _no_bpb = '$row->No_Bpb'
             _tgl = '$row->Tgl_Bpb'
             _no_reff = '$row->No_Reff'
             _kd_sp = '$row->Kode_Supp'
             _nm_sp = '$row->Perusahaan'
             _kd_gd = '$row->Kode_Gudang'
             _nm_gd = '$row->Nama'>
       
            <td>$row->No_Bpb</a></td>
            <td>$row->Kode_Gudang</td>
            <td>$row->Tgl_Bpb</td>
        </tr>";
    } ?>
    </tbody>
</table>
</div>

<script>
    $('#tb2 tr').click(function (e) {
        $('#delete').attr('disabled', false);
        $("#_bpb").attr('disabled',true);
        
        var id = $(this).attr("_no_bpb"); 
        var tgl = $(this).attr("_tgl");
        var reff = $(this).attr("_no_reff");
        var kd_sp = $(this).attr("_kd_sp");
        var nm_sp = $(this).attr("_nm_sp");
        var kd_gd = $(this).attr("_kd_gd");
        var nm_gd = $(this).attr("_nm_gd");
        
        $('#_bpb').val(id);
        $('#_tgl').val(tgl);
        $('#_ref').val(reff);
        $('#kd_sp').val(kd_sp);
        $('#_sp').val(nm_sp);
        $('#kd_gd').val(kd_gd);
        $('#_gd').val(nm_gd);

        $('#add').attr('mode','edit');
        $('#save').attr('mode','edit');

        tampilDetailBPB();
    });
    
var oTable = $('#tb2').dataTable( {
    "sScrollY": "295px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": false,
    "aaSorting": [[ 4, "desc" ]],
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );

</script>
