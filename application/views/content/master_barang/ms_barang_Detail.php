<div class="table table-hover CSSTabel tb-barang" style="width:33%;">
<table id="tb1" style="width: 100%;">
    <thead>
        <th width="15%">Kode</th>
        <th width="75%">Nama</th>
        <th width="10%">Action</th>
    </thead>

    <tbody id="tb_detail">
    <?php foreach($hasil as $row)
    {
        echo "<tr>
            <td>$row->Kode</td>
            <td nama='$row->Nama'>$row->Nama $row->Ukuran</td>
            <td>
                <div class='btn-group'>
                    <a class='btn popup btn-small' style='padding: 2px 6px;' kode='$row->Kode'><i class='icon-pencil'></i></a>
                    <a class='btn delete btn-small' kode='$row->Kode' nama='$row->Nama' style='padding: 2px 6px;'><i class='icon-trash'></i></a>
                </div>
            </td>
        </tr>";
    } ?>
    </tbody>
</table>
</div>

<script>
   //Edit TRIGGER
$('.popup').click(function(){
    key();
    $("#_kd").attr('disabled',true);
    $('#save').attr('mode','edit');
    $("#save").attr('disabled',false);
    
    var id = $(this).attr("kode"); //atribut sebagai identifier data row
	
	$('#_kd').val(id);

    retrieveForm(id);
    jQuery(".hide-con").show();
});

var oTable = $('#tb1').dataTable( {
    "sScrollY": "380px",
    "bPaginate": true,
    "bLengthChange": true,
    "aaSorting": [[ 4, "desc" ]],
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": "View _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "sPaginationType": "full_numbers",
    "bInfo": true//Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
