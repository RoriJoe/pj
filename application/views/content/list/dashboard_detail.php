<div class="CSSTabel" style="height: 245px;">
<table id="tb5">
    <!--<tr style="background-color:#88C7FF;font-weight:bold">
        <td colspan="2">Row Label</td>
        <td class="tab-value">Grand Total</td>
    </tr>
    <tr style="font-weight:bold">
        <td colspan="2"><i class="icon-minus-sign"></i> 2014</td>
        <td class="tab-value">10.000.000</td>
    </tr>
        <tr>
            <td colspan="2" class="tab-month"><i class="icon-minus-sign"></i> Januari</td>
            <td class="tab-value">1.000.000</td>
        </tr>
            <tr>
                <td colspan="2" class="tab-day"><i class="icon-minus-sign"></i> 01/01/2014</td>
                <td class="tab-value">400.000</td>
            </tr>
                <tr>
                    <td class="tab-so">SO001</td>
                    <td>PT. Bersatu Padu</td>
                    <td class="tab-value">200.000</td>
                </tr>
                <tr>
                    <td class="tab-so">SO002</td>
                    <td>PT. Nasional</td>
                    <td class="tab-value">200.000</td>
                </tr>
            <tr>
                <td colspan="2" class="tab-day"><i class="icon-minus-sign"></i> 15/01/2014</td>
                <td class="tab-value">600.000</td>
            </tr>
                <tr>
                    <td class="tab-so">SO003</td>
                    <td>PT. Kura-Kura</td>
                    <td class="tab-value">200.000</td>
                </tr>
                <tr>
                    <td class="tab-so">SO004</td>
                    <td>CV. Teguh Jaya</td>
                    <td class="tab-value">400.000</td>
                </tr>
        <tr>
            <td colspan="2" class="tab-month"><i class="icon-plus-sign"></i> Februari</td>
            <td class="tab-value">6.000.000</td>
        </tr>
        <tr>
            <td colspan="2" class="tab-month"><i class="icon-minus-sign"></i> Maret</td>
            <td class="tab-value">3.000.000</td>
        </tr>
            <tr>
                <td colspan="2" class="tab-day"><i class="icon-minus-sign"></i> 05/03/2014</td>
                <td class="tab-value">400.000</td>
            </tr>
                <tr>
                    <td class="tab-so">SO001</td>
                    <td>PT. Bersatu Padu</td>
                    <td class="tab-value">200.000</td>
                </tr>
                <tr>
                    <td class="tab-so">SO002</td>
                    <td>PT. Nasional</td>
                    <td class="tab-value">200.000</td>
                </tr>
            <tr>
                <td colspan="2" class="tab-day"><i class="icon-minus-sign"></i> 15/01/2014</td>
                <td class="tab-value">600.000</td>
            </tr>
                <tr>
                    <td class="tab-so">SO003</td>
                    <td>PT. Kura-Kura</td>
                    <td class="tab-value">200.000</td>
                </tr>
                <tr>
                    <td class="tab-so">SO004</td>
                    <td>CV. Teguh Jaya</td>
                    <td class="tab-value">400.000</td>
                </tr>-->
    <thead>
        <th>Nomor SO</th><th>Tanggal</th><th>Pelanggan</th><th>Grand Total (Rp)</th>
    </thead>
    <tbody>
    <?php
    foreach($hasil as $row)
    {
        $originalDate1 = $row->Date;
        $dmy1 = date("d-m-Y", strtotime($originalDate1));
        $total = number_format($row->Total,0,",",".");
        echo "<tr>
        <td>$row->No_So</td>
        <td>$dmy1</td>
        <td>$row->Perusahaan</td>
        <td>$total</td>
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