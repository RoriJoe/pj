<div class="table table-hover CSSTabel table-list">
<table id="tb2">
    <thead>
        <th>No BPB</th>
        <th>Supplier</th>
    </thead>

    <tbody id="tb_detail">
    <?php foreach($hasil as $row)
    {
		$originalDate1 = $row->Tgl_Bpb;
			$dmy1 = date("d-m-Y", strtotime($originalDate1));
        echo
        "<tr _no_bpb = '$row->No_Bpb'
             _tgl = '$dmy1'
             _no_reff = '$row->No_Reff'
             _kd_sp = '$row->Kode_Supp'
             _nm_sp = '$row->Perusahaan'
             _kd_gd = '$row->Kode_Gudang'
             _nm_gd = '$row->Nama'
             _kd_po = '$row->No_Po'>
       
            <td>$row->No_Bpb</a></td>
            <td>$row->Perusahaan</td>
        </tr>";
    } ?>
    </tbody>
</table>
</div>

<script>
    $('#tb2 tbody tr').click(function (e) {
        $('#delete').attr('disabled', false);
        $("#_bpb").attr('disabled',true);
        
        var id = $(this).attr("_no_bpb"); 
        var tgl = $(this).attr("_tgl");
        var reff = $(this).attr("_no_reff");
        var kd_sp = $(this).attr("_kd_sp");
        var nm_sp = $(this).attr("_nm_sp");
        var kd_gd = $(this).attr("_kd_gd");
        var nm_gd = $(this).attr("_nm_gd");
        var kd_po = $(this).attr("_kd_po");
        
        $('#_bpb').val(id);
        $('#_tgl').val(tgl);
        $('#_ref').val(reff);
        $('#kd_sp').val(kd_sp);
        $('#_sp').val(nm_sp);
        $('#kd_gd').val(kd_gd);
        $('#_gd').val(nm_gd);
        $('#po').val(kd_po);

        get_po_list();

        var textb = $(this).attr("_kd_po");
        var combo = document.getElementById("po");
        var option = document.createElement("option");
        option.text = textb;
        option.value = textb;

        try {
            combo.add(option, null); //Standard
        }catch(error) {
            combo.add(option); // IE only
        }

        setSelectedIndex(document.getElementById("po"),kd_po);
        
        <?php if ($this->authorization->is_permitted('update_penerimaan')) : ?>
            $('#add').attr('mode','edit');
            $('#save').attr('mode','edit');
        <?php else: ?>
            $("#save").attr('disabled',true);
        <?php endif; ?>

        $('#po').attr('disabled',true);
        $('#cancel').attr('disabled',false);
        $('#add').attr('disabled',true);
        document.getElementById('add').style.visibility = 'hidden';

        tampilDetailBPB();
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
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
