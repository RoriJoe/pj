<div style="height: 245px;">
<table class="table table-bordered" id="tbos" cellpadding="5px">
    <thead>
        <tr>
            <th>No SO</th>
            <th>Nama Pelanggan</th>
            <th>Pesan</th>
            <th>Nama Barang</th>
            <th>Tanggal</th>
            <th>OS</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $no_so="";$tgl="";$plg="";$gtot=0;
        foreach($hasil2 as $row)
        {$originalDate1 = $row->Tgl;
        $dmy1 = date("d-m-Y", strtotime($originalDate1));
        $duit=number_format($row->Jumlah);
        
        $outs=$row->Qty - $row->QtyTemp;
        if($no_so != $row->No_Do){
            $no_so=$row->No_Do;$tgl=$dmy1;$plg=$row->NP;
            
            $gtot+=$row->grandttl;
        }else{
            $no_so="";$tgl="";$plg="";
            
        }

            if($outs != 0){
                echo
                "<tr class='success'>
                    
                    <td>$no_so</td>
                    <td>$plg</td>
                    <td align='right'>$row->Qty</td>
                    <td>$row->Nama $row->Ukuran</td>
                    <td>$tgl</td>
                    <td align='right'>$outs</td>                
                </tr>";
                
            }else{
                echo
                "<tr>
                    
                    <td>$no_so</td>
                    <td>$plg</td>
                    <td align='right'>$row->Qty</td>
                    <td>$row->Nama $row->Ukuran</td>
                    <td>$tgl</td>
                    <td align='right'>$outs</td>                
                </tr>";
                
            }
            $no_so=$row->No_Do;
            
        }
    ?>
    </tbody>
</table>
</div>