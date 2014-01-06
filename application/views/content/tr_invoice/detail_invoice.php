<div class="CSSTabel" style="margin-bottom:5px;">
<table id="tb_detail" class="table">
    <thead>
        <th width="10%">Kode</th>
        <th width="30%">Nama Barang</th>
        <th width="10%">Satuan</th>
        <th width="10%">Qty</th>
        <th width="15%">Hrg Satuan (Rp)</th>
        <th width="15%">Jumlah (Rp)</th>
        <th width="10%">Keterangan</th>
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
        <td width='10%'>
            <label id='kd$i'>$row->Kode_Brg</label>
        </td>
        <td width='30%'>
            <label id='brg$i'>$row->Barang $row->Ukuran </label>
        </td>
        <td width='10%'>
            <label id='satuan$i'>$row->Satuan1</label>
        </td>
        <td width='10%'>
            <label id='qty$i'>$row->Qty1</label>
        </td>
        <td width='15%'>
            <input type='text' name='harga_brg' class='validate[required]' id='harga_brg$i' style='width:88px; text-align:right;' value='$Harga' readonly='true'/>
        </td>
        <td width='15%'>
            <input type='text' name='jumlah' class='validate[required]' id='jumlah_brg$i' style='width:88px;text-align:right;' value='$Jumlah' disabled='true'/>
        </td>
        <td width='10%'>
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
    "sScrollY": "200px",
    "sScrollYInner": "100%",
    "bPaginate": false,
    "bLengthChange": false,
    "bAutoWidth":false,
    "bFilter": false,
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>