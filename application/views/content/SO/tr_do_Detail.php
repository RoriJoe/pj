<div class="table CSSTabel table-hover tb-barang" style="width:24%">
    <table id="tb2">
        <thead>
            <th>No SO</th>
            <th>Pelanggan</th>
        </thead>
    
        <tbody>
            <?php foreach($hasil as $row)
            {
			$originalDate1 = $row->Tgl;
			$dmy1 = date("d-m-Y", strtotime($originalDate1));
			$originalDate2 = $row->Tgl_Po;
			$dmy2 = date("d-m-Y", strtotime($originalDate2));
                echo
                "<tr    _no_do = '$row->No_Do'
                        _tgl = '$dmy1'
                        _no_po = '$row->No_Po'
                        _tgl_po = '$dmy2'
                        _kd_pl = '$row->Kode_Plg'
                        _nm_pl = '$row->Perusahaan'
                        _kd_gd = '$row->Kode_Gudang'
                        _kirim = '$row->Kirim'
                        _otorisasi = '$row->Otorisasi'
                        _total = '$row->Total'
						_disc = '$row->discount'
						_dpp = '$row->dpp'
						_ppn = '$row->ppn'
						_grandttl = '$row->grandttl'>
                    <td>$row->No_Do</td>
                    <td>$row->Perusahaan</td>
                </tr>";
            } ?>
        </tbody>
    </table>
</div>

<script>
$('#tb2 tr').click(function (e) {
    $('#delete').attr('disabled', false);
    $("#_so").attr('disabled',true);
    
    var id = $(this).attr("_no_do"); 
    var tgl = $(this).attr("_tgl");
    var po = $(this).attr("_no_po");
    var tgl2 = $(this).attr("_tgl_po");
    var kd_pl = $(this).attr("_kd_pl");
    var pl = $(this).attr("_nm_pl");
    var sl = $(this).attr("_otorisasi");
    var to = $(this).attr("_total");
	var disc = $(this).attr("_disc");
    var dpp = $(this).attr("_dpp");
    var ppn = $(this).attr("_ppn");
    var grant = $(this).attr("_grandttl");
    
    $('#_so').val(id);
    $('#_po').val(po);
    $('#_tgl').val(tgl);
    $('#_tgl2').val(tgl2);
    $('#kd_plg').val(kd_pl);
    $('#_pn').val(pl);
    $('#_sl').val(sl);

    document.getElementById('add').style.visibility = 'hidden';
    $('#total').val(accounting.formatMoney(to, "Rp ",2,".",","));
	var total_disc = $(this).attr("_total")*$(this).attr("_disc")/100;
	$('#disc').val(disc);
	$('#discT').val(total_disc);
	var total_ppn = $(this).attr("_dpp")*$(this).attr("_ppn")/100;
	$('#ppn').val(ppn);
	$('#ppnT').val(total_ppn);
	$('#dpp').val(accounting.formatMoney(dpp, "Rp ",2,".",","));
	$('#granT').val(accounting.formatMoney(grant, "Rp ",2,".",","));
	
    tampilDetailSO();
    $('#add').attr('mode','edit');
    $('#save').attr('mode','edit');
    $('#cancel').attr('disabled',false);
    jQuery(".hide-con").show();
});
    
var oTable = $('#tb2').dataTable( {
    "sScrollY": "380px",
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
