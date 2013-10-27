<div class="table table-hover CSSTabel tb-barang">
<table id="tb1" style="width: 100%;">
    <thead>
        <th width="35%">Kode</th>
        <th width="50%">Nama</th>
        <th width="15%">Action</th>
    </thead>

    <tbody id="tb_detail">
    <?php foreach($hasil as $row)
    {
        $hb = number_format($row->Harga_Beli,0,",",".");
        $hj = number_format($row->Harga_Jual,0,",",".");
        echo "<tr>
            <td>$row->Kode</td>
            <td nama='$row->Nama'>$row->Nama</td>
            <td>
                <div class='btn-group'>
                    <a class='btn popup' style='padding: 2px 6px;'
                            nama='$row->Nama'
                            kode='$row->Kode'
                            ukuran='$row->Ukuran'
                            kete='$row->Nama2'
                            prs='$row->Qty1'
                            stn='$row->Satuan1'
                            hb='$hb'
                            hj='$hj'
                            ><i class='icon-pencil'></i></a>
                    <a class='btn delete' kode='$row->Kode' nama='$row->Nama' style='padding: 2px 6px;'><i class='icon-trash'></i></a>
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
    
    $("#_kd").attr('disabled',true);
    
    var id = $(this).attr("kode"); //atribut sebagai identifier data row
    var nama = $(this).attr("nama");
	var ukuran = $(this).attr("ukuran");
	var keterangan = $(this).attr("kete");
	var prs = $(this).attr("prs");
	var stn = $(this).attr("stn");
    var hb = $(this).attr("hb");
    var hj = $(this).attr("hj");
	
	$('#_kd').val(id);
	$('#_nama1').val(nama);
	$('#_uk').val(ukuran);
	$('#_ket').val(keterangan);
	$('#_ps').val(prs);
    $('#hb').val(hb);
    $('#hj').val(hj);
	
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
	setSelectedIndex(document.getElementById("_st"),stn);

    key();
    jQuery(".hide-con").show();
});

$(".delete").click(function(){
    PlaySound('beep');
    var id = $(this).attr("kode");
    var pr = $(this).attr("nama");
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode: <b>"+id+"</b><br/>Nama Gudang : <b>"+pr+"</b>",
        title: "<img src='<?php echo base_url();?>/assets/img/warning-icon.svg' class='warning-icon'/> Yakin ingin menghapus Data Berikut?",
        buttons: {
            main: {
                label: "Batal",
            },
            danger: {
                label: "Hapus",
                className: "btn-danger",
                callback: function() {
                    $.ajax({
                        type:'POST',
                        url: "<?php echo base_url();?>index.php/ms_barang/delete",
                        data :{id:id},
                        success: function(msg){
                            if(msg=="gagal"){
                                bootstrap_alert.warning('<b>Gagal!</b> Telah terjadi kesalahan');
                            }
                            else{
                                bootstrap_alert.success('<b>Sukses!</b> Data '+ pr +' telah dihapus');
                                $('#formID').each(function(){
                                    this.reset();
                                });
                                autogen();
                                loadListBarang();
                            }
                        }
                    });
                }
            }
        }
    });
});

var oTable = $('#tb1').dataTable( {
    "sScrollY": "380px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": true,
    "aaSorting": [[ 4, "desc" ]],
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": "View _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
