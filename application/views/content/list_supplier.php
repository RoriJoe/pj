<div class="CSSTabel" style="height: 245px;">
<table id="tb6">
    <thead>
        <th>Kode</th><th>Nama</th><th>Perusahaan</th><th>Alamat</th><th>Telp</th><th>Select</th>
    </thead>
    <tbody>
    <?php
    foreach($hasil as $row)
    {
        echo "<tr>
        <td>$row->Kode</td>
        <td>$row->Nama</td>
        <td>$row->Perusahaan</td>
        <td>$row->Alamat1</td>
        <td>$row->Telp</td>
        <td><input type='radio' name='optionsRadios' id='optionsPelanggan' kd='$row->Kode' nama='$row->Nama' value='$row->Perusahaan'></td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>

<script>
    
var oTable = $('#tb6').dataTable( {
    //"sScrollY": "300px", //heighnya
    //"sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bScrollCollapse": false,
    "bPaginate": false,
    "sPaginationType": "full_numbers",
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>