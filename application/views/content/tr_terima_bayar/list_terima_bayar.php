<div class="table CSSTabel table-list table-hover">
    <table id="tbl_list">
        <thead>
            <th>No Terima</th>
            <th>Tanggal</th>
        </thead>

        <tbody>
        <?php foreach($hasil as $row)
        {   $originalDate1 = $row->Tgl;
            $dmy1 = date("d-m-Y", strtotime($originalDate1));
            echo
            "<tr
                kode = $row->Kode
                tgl = $dmy1
                plg = $row->Kode_plg
				
				nama = $row->Perusahaan
            >

                <td>$row->Kode</td>
                <td>$dmy1</td>
            </tr>";
        } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$('#tbl_list tbody tr').click(function (e) {
    $('#delete').attr('disabled', false);
   
    var id = $(this).attr("kode"); 
    var tgl = $(this).attr("tgl");
  
    var plg = $(this).attr("plg");
    
	var nama = $(this).attr("Nama");
   
    $('#no_terima').val(id);
    $('#_tgl1').val(tgl);
   
    $('#kd_plg').val(plg);
    $('#_pn').val(nama);

    
    <?php if ($this->authorization->is_permitted('update_tagihan')) : ?>
        $('#add').attr('mode','edit');
        $('#save').attr('mode','edit');
    <?php else: ?>
        $("#save").attr('disabled',true);
    <?php endif; ?>

	detail_pembayaran();
	detail_invoice();
    detail_SO();
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
    "sPaginationType": "full_numbers",
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>