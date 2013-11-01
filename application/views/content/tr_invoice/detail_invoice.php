<div class="table CSSTabel" style="overflow: auto; height: 195px">
<table id="tb_detail">
    <thead>
        <th width:"15%">Nama Barang</th>
        <th width:"30%">Kode Barang</th>
        <th width:"10%">Satuan</th>
        <th width:"5%">Qty</th>
        <th width:"10%">Harga Satuan</th>
        <th width:"10%">Jumlah</th>
        <th width:"20%">Keterangan</th>
    </thead>
    <tbody id="itemlist">
    <?php
    $i=1;
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>
            $row->Kode_Brg
        </td>
        <td>
            $row->Nama
        </td>
        <td>
            $row->Satuan1
        </td>
        <td>
            $row->Qty
        </td>
        <td>
            $row->Harga
        </td>
        <td>
            $row->Jumlah
        </td>
        <td>
            $row->Keterangan
        </td>
        </tr>
        ";
        $i++;
    } ?>
    </tbody>
</table>
</div>