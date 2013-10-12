<div class="table CSSTabel" style="overflow: auto; height: 195px">
<table id="tb_detail">
    <thead>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>Satuan</th>
        <th>Harga Satuan</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
    <?php
    $i=1;
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>
            <input type='text' class='span2' id='kode_brg$i' id='appendedInputButton' name='kode_brgd' style='width:70px' value='$row->Kode_Brg' disabled='true'/> 
        </td>
        <td>
            <input type='text' name='nama_brg' id='nama_brg$i' style='width:100px' value='$row->Nama' disabled='true'/>
        </td>
        <td>
            <input type='text' name='qty_brg' id='qty_brg$i' style='width:30px' value='$row->Qty' disabled='true'/>
        </td>
        <td>
            <input type='text' name='satuan_brg' id='satuan_brg$i' style='width:70px' value='$row->Satuan1' readonly='true'/>
        </td>
        <td>
            <input type='text' name='harga_brg' id='harga_brg$i' style='width:70px' value='$row->Harga' disabled='true'/>
        </td>
        <td>
            <input type='text' name='jumlah' id='jumlah_brg$i' style='width:70px' value='$row->Jumlah' disabled='true'/>
        </td>
        <td>
            <input type='text' name='keterangan' id='keterangan_brg$i' style='width:80px' value='$row->Keterangan' disabled='true'/>
        </td>
        </tr>
        ";
        $i++;
    } ?>
    </tbody>
</table>
</div>