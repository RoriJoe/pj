<div class="table CSSTabel table-list table-hover" style="height: 395px;">
    <table id="tb1">
        <thead>
            <th>No SJ</th>
            <th>No SO</th>
            <th>Pelanggan</th>
        </thead>

        <tbody>
        <?php foreach($hasil as $row)
        {
            echo
            "<tr>
                <td>$row->No_Sj</td>
                <td>$row->No_Do</td>
                <td>$row->Perusahaan</td>
            </tr>";
        } ?>
        </tbody>
    </table>
</div>
<script>

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
