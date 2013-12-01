<div class="table table-hover CSSTabel table-list">
    <table id="tbl_list">
        <thead>
            <th>No Invoice</th>
            <th>Nomor SJ</th>
        </thead>

        <tbody id="tb_detail">
        <?php foreach($hasil as $row)
        {   echo
            "<tr
                kode = $row->Kode
            >
                <td>$row->Kode</td>
                <td>$row->Kode_SJ</td>
            </tr>";
        } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$('#tbl_list tr').click(function (e) {
    $('#delete').attr('disabled', false);
    $('#no_invo').attr('disabled', true);
    document.getElementById('f_plg').style.visibility = 'hidden';
    
    var id = $(this).attr("kode");     
    $('#no_invo').val(id);
    show_sj("view");
    getFormInvoice(id);

    <?php if ($this->authorization->is_permitted('update_invoice')) : ?>
        $('#add').attr('mode','edit');
        $('#save').attr('mode','edit');
    <?php else: ?>
        $("#save").attr('disabled',true);
    <?php endif; ?>
    jQuery(".hide-con").show();
});


var oTable = $('#tbl_list').dataTable( {
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
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>