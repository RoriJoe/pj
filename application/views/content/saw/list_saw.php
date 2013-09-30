<div class="table CSSTabel table-list table-hover" style="height: 395px;">
    <table id="tb1">
        <thead>
            <th>Kode Saw</th>
            <th>Gudang</th>
        </thead>

        <tbody>
        <?php foreach($hasil as $row)
        {
            echo
            "<tr no_Saw = '$row->No_Saw' 
                 tgl = '$row->Tgl'
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
        
        $('#noSaw').val($(this).attr("no_Saw"));
        $('#kd_gd').val($(this).attr("kd_gud"));
        $('#gud').val($(this).attr("nm_gud"));
        $('#_tgl').val($(this).attr("tgl"));
    

        $('#save').attr('mode','edit');
        $('#cancel').attr('disabled',false);

        document.getElementById('add').style.visibility = 'hidden';

        detailSaw();
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