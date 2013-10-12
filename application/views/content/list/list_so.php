<div class="CSSTabel" style="height: 245px;">
<table id="tb5">
    <thead>
        <th>Nomor SO</th><th>Tanggal</th><th>Pelanggan</th><th>Total</th><th>Select</th>
    </thead>
    <tbody>
    <?php
    foreach($hasil as $row)
    {
        $originalDate1 = $row->Tgl;
        $dmy1 = date("d-m-Y", strtotime($originalDate1));
        echo "<tr>
        <td>$row->No_Do</td>
        <td>$dmy1</td>
        <td>$row->Perusahaan</td>
        <td>$row->Total</td>
        <td><input type='radio' name='optionsRadios' id='optionsSO' 
        		kd='$row->No_Do' 
        		pelanggan='$row->Perusahaan' 
                kode_plg='$row->Kode_Plg' 
        		alamat='$row->Alamat1' 
                total='$row->Total'
        		value='$row->No_Do'></td>
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