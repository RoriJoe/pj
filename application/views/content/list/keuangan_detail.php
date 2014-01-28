<div style="height: 245px;">
<table class="table table-bordered" id="tbos" cellpadding="5px">
    <thead>
        <tr>
            <th>Kode Invoice</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Kode SJ</th>
            <th>Term</th>
            <th>Grand</th>
            <th>Terima</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $no_so="";$tgl="";$plg="";$gtot=0;
        foreach($hasil2 as $row)
        {
            $originalDate1 = $row->Tgl;
            $dmy1 = date("d-m-Y", strtotime($originalDate1));
            $duit=number_format($row->Grand);
            
            $terima=number_format($row->Grand - $row->Temp);
            if($terima != 0){
                echo
                "<tr class='success'>
                    <td>$row->Kode</td>
                    <td>$row->Perusahaan</td>
                    <td>$dmy1</td>
                    <td>$row->Kode_SJ</td>
                    <td>$row->Term</td>
                    <td>$duit</td>    
                    <td>$terima</td>                
                </tr>";
                
            }else{
                echo
                "<tr>
                    <td>$row->Kode</td>
                    <td>$row->Perusahaan</td>
                    <td>$dmy1</td>
                    <td>$row->Kode_SJ</td>
                    <td>$row->Term</td>
                    <td>$duit</td>    
                    <td>$terima</td>                
                </tr>";
            }
        }
    ?>
    </tbody>
</table>
</div>