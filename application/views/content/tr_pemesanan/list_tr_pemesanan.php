<div class="table CSSTabel table-list table-hover" style="height: 395px;">
    <table id="tbLsPO">
        <thead>
            <th>Kode PO</th>
            <th>DPP</th>
        </thead>

        <tbody>
        <?php foreach($hasil as $row)
        {
            echo
            "<tr
                        kode = '$row->Kode'
                        tgl1 = '$row->Tgl_po'
                        tgl2 = '$row->Tgl_kirim'
                        cur = '$row->Currency'
                        urg = '$row->Urgent'
                        kd_sup = '$row->Kode_supplier'
                        sup = '$row->Perusahaan'
                        kd_gud = '$row->Kode_gudang'
                        gud = '$row->Nama'
                        proy = '$row->Nama_proyek'
                        DPP = '$row->DPP'
                        PPN = '$row->PPN'
                        total = '$row->Total'>
                <td>$row->Kode</td>
                <td>$row->DPP</td>
            </tr>";
        } ?>
        </tbody>
    </table>
</div>
<script>
$('#tbLsPO tr').click(function (e) {
        $('#delete').attr('disabled', false);
        $("#_so").attr('disabled',true);
        
        var gud = $(this).attr("gud");
        var proy = $(this).attr("proy");
        if(gud == ""){
            $('#gud').attr('disabled', true);
            $('#filterGud').attr('disabled', true);
            $('#proy').attr('disabled', false);
            $('#gud').val("");
            $('#kd_gud').val("");
        }else{
            $('#gud').attr('disabled', false);
            $('#filterGud').attr('disabled', false);
            $('#proy').attr('disabled', true);
            $('#proy').val("");
        }
        
        $('#po').val($(this).attr("kode"));
        $('#_tgl1').val($(this).attr("tgl1"));
        $('#_tgl2').val($(this).attr("tgl2"));
        $('#kd_sup').val($(this).attr("kd_sup"));
        $('#sup').val($(this).attr("sup"));
        $('#kd_gud').val($(this).attr("kd_gud"));
        $('#gud').val($(this).attr("gud"));
        $('#proy').val($(this).attr("proy"));
        $('#dpp').val($(this).attr("DPP"));
        $('#ppn').val($(this).attr("PPN"));
        $('#total').val($(this).attr("total"));

        //$('#add').attr('mode','edit');
        $('#save').attr('mode','edit');
        
        function setSelectedIndex(s, valsearch)
        {
        // Loop through all the items in drop down list
        for (i = 0; i< s.options.length; i++)
        { 
            if (s.options[i].value == valsearch)
            {
                // Item is found. Set its property and exit
                s.options[i].selected = true;
                break;
            }
        }
        return;
        }
        setSelectedIndex(document.getElementById("cur"),$(this).attr("cur"));
        setSelectedIndex(document.getElementById("urg"),$(this).attr("urg"));
        
        
        tampilDetailPO();
    });
    
var oTable = $('#tbLsPO').dataTable( {
    "sScrollY": "315px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": false,
    "aaSorting": [[ 4, "desc" ]],
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );

</script>