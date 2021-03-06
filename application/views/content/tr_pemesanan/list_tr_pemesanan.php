<div class="table CSSTabel table-hover table-list">
    <table id="tbLsPO">
        <thead>
            <th>Kode PO</th>
            <th>Supplier</th>
        </thead>

        <tbody id="tb_detail">
        <?php foreach($hasil as $row)
        {	
            echo
            "<tr kode = '$row->Kode'>
                <td>$row->Kode</td>
                <td>$row->Perusahaan</td>
            </tr>";
        } ?>
        </tbody>
    </table>
</div>

<script>
$('#tb_detail tr').click(function (e) {
        $('#po').val($(this).attr("kode"));

        retrieveForm($(this).attr("kode"));
        tampilDetailPO();

        //$('#add').attr('mode','edit');
        $("#po").attr('disabled',true);
        $('#delete').attr('disabled', false);
        $('#cancel').attr('disabled',false);
        $('#add').attr('disabled',true);
        document.getElementById('add').style.visibility = 'hidden'; 

        <?php if ($this->authorization->is_permitted('update_po')) : ?>
            $('#add').attr('mode','edit');
            $('#save').attr('mode','edit');
        <?php else: ?>
            $("#save").attr('disabled',true);
        <?php endif; ?>
        jQuery(".hide-con").show();
    });
    
var oTable = $('#tbLsPO').dataTable( {
    "sScrollY": "400px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": true,
    "aaSorting": [[ 4, "desc" ]],
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": " _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "sPaginationType": "full_numbers",
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );

</script>