<div class="table CSSTabel" style="margin-bottom:5px;">
<table id="tb_detail">
    <thead>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Qty</th>
        <th>Hrg Satuan (Rp)</th>
        <th>Jumlah (Rp)</th>
        <th>Keterangan</th>
    </thead>
    <tbody id="itemlist">
    <?php
    $i=1;
    foreach($hasil as $row)
    {
        $Harga = number_format($row->Harga, 0, ',', '.');
        $qty = $row->Qty1;
        $Jumlah = number_format($row->Harga*$qty, 0, ',', '.');
        echo "<tr>
        <td>
            <label id='kd$i'>$row->Kode_Brg</label>
        </td>
        <td>
            <label id='brg$i'>$row->Barang $row->Ukuran </label>
        </td>
        <td>
            <label id='satuan$i'>$row->Satuan1</label>
        </td>
        <td>
            <label id='qty$i'>$row->Qty1</label>
        </td>
        <td>
            <input type='text' name='harga_brg' class='validate[required]' id='harga_brg$i' style='width:88px; text-align:right;' value='$Harga' readonly='true'/>
        </td>
        <td>
            <input type='text' name='jumlah' class='validate[required]' id='jumlah_brg$i' style='width:88px;text-align:right;' value='$Jumlah' disabled='true'/>
        </td>
        <td>
            <label id='ket$i'>$row->Keterangan</label>
        </td>
        </tr>
        ";
        $i++;
    } ?>
    </tbody>
</table>
</div>

<script type="text/javascript">
var oTable = $('#tb_detail').dataTable( {
    "sScrollY": "130px",
    "sScrollYInner": "100%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>