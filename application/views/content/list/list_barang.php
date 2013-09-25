<div class="CSSTabel" style="height: 245px;">
<table id="tb5">
    <thead>
        <th>Kode Barang</th><th>Nama</th><th>Ukuran</th><th>Satuan</th><th>Qty</th><th>Select</th>
    </thead>
    <tbody>
    <?php
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>$row->Kode</td>
        <td>$row->Nama</td>
        <td>$row->Ukuran</td>
        <td>$row->Satuan1</td>
        <td>$row->Qty1</td>
        <td><input type='radio' name='optionsRadios' id='optionsPelanggan' 
        		kd='$row->Kode' 
        		satuan='$row->Satuan1' 
        		nama='$row->Nama' 
        		ukuran='$row->Ukuran'
        		value='$row->Kode'></td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>

<script>
    var oTable = $('#tb5').dataTable( {
        //"sScrollY": "300px", //heighnya
        //"sScrollX": "100%", //panjang width
        "sScrollXInner": "100%", //overflow dalem
        "bScrollCollapse": false,
        "bPaginate": false,
        "sPaginationType": "full_numbers",
        "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
    } );
</script>