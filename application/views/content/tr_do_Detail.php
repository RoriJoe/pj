<div class="table CSSTabel table-list table-hover" style="top: -45px; width: 25%">
    <table id="tb2">
        <thead>
            <th>No SO</th>
            <th>No Po</th>
            <th>Pelanggan</th>
        </thead>
    
        <tbody>
            <?php foreach($hasil as $row)
            {
                echo
                "<tr    _no_do = '$row->No_Do'
                        _tgl = '$row->Tgl'
                        _no_po = '$row->No_Po'
                        _tgl_po = '$row->Tgl_Po'
                        _kd_pl = '$row->Kode_Plg'
                        _nm_pl = '$row->Perusahaan'
                        _kd_gd = '$row->Kode_Gudang'
                        _kirim = '$row->Kirim'
                        _otorisasi = '$row->Otorisasi'
                        _total = '$row->Total'>
                    <td>$row->No_Do</td>
                    <td>$row->No_Po</td>
                    <td>$row->Perusahaan</td>
                </tr>";
            } ?>
        </tbody>
    </table>
</div>

<script>
    $('#tb2 tr').click(function (e) {
        $('#delete').attr('disabled', false);
        $("#_so").attr('disabled',true);
        
        var id = $(this).attr("_no_do"); 
        var tgl = $(this).attr("_tgl");
        var po = $(this).attr("_no_po");
        var tgl2 = $(this).attr("_tgl_po");
        var kd_pl = $(this).attr("_kd_pl");
        var pl = $(this).attr("_nm_pl");
        var sl = $(this).attr("_otorisasi");
        var to = $(this).attr("_total");
        
        $('#_so').val(id);
        $('#_po').val(po);
        $('#_tgl').val(tgl);
        $('#_tgl2').val(tgl2);
        $('#kd_plg').val(kd_pl);
        $('#_pn').val(pl);
        $('#_sl').val(sl);

        $('#add').attr('mode','edit');
        $('#save').attr('mode','edit');
         $('#total').val(to);
        tampilDetailSO();
       
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
