<div class="table CSSTabel table-hover table-list">
    <table id="tb2">
        <thead>
            <th>No SO</th>
            <th>Pelanggan</th>
        </thead>
    
        <tbody id="tb_detail">
            <?php foreach($hasil as $row)
            {   echo
                "<tr _no_do = '$row->No_Do'>
                    <td>$row->No_Do</td>
                    <td>$row->Perusahaan</td>
                </tr>";
            } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$('#tb2 tbody tr').click(function (e) {
    $('#delete').attr('disabled', false);
    $("#_so").attr('disabled',true);
    
    var id = $(this).attr("_no_do"); 
    $('#_so').val(id);
	
    retrieveForm(id);
    tampilDetailSO();
    $('#add').attr('mode','edit');
    $('#save').attr('mode','edit');
    $('#cancel').attr('disabled',false);
    document.getElementById('add').style.visibility = 'hidden';
    document.getElementById('f_plg').style.visibility = 'hidden';
    jQuery(".hide-con").show();
});
    
var oTable = $('#tb2').dataTable( {
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
