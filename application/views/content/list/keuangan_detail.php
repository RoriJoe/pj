<div style="height: 400px; overflow-x:scroll">
<table class="table table-bordered" id="tbos" cellpadding="5px" style="width:600px">
    <thead>
        <tr>
            <th>Kode Invoice</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Term</th>
            <th>Grand</th>
            <th>Terima</th>
            <th>Sisa</th>
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
            $sisa=number_format($row->Grand - $terima);
            if($terima != 0){
                echo
                "<tr class='success'>
                    <td>$row->Kode</td>
                    <td>$row->Perusahaan</td>
                    <td>$dmy1</td>
                    <td>$row->Term</td>
                    <td>$duit</td>    
                    <td>$terima</td>
                    <td>$sisa</td>                
                </tr>";
                
            }else{
                echo
                "<tr>
                    <td>$row->Kode</td>
                    <td>$row->Perusahaan</td>
                    <td>$dmy1</td>
                    <td>$row->Term</td>
                    <td>$duit</td>    
                    <td>$terima</td> 
                    <td>$sisa</td>                
                </tr>";
            }
        }
    ?>
    </tbody>
</table>
</div>