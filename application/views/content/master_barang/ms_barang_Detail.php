<div class="table table-hover CSSTabel table-list" style="width:98%;">
<table id="tb1" style="width: 100%;">
    <thead>
        <th width="20%">Kode</th>
        <th width="70%">Nama</th>
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
                    <a class='btn popup' style='padding: 0px 3px;' kode='$row->Kode'><i class='icon-pencil'></i></a>
                    <a class='btn delete' kode='$row->Kode' nama='$row->Nama' style='padding: 0px 3px;'><i class='icon-trash'></i></a>
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

$(".delete").click(function(){
    PlaySound('beep');
    var id = $(this).attr("kode");
    var pr = $(this).attr("nama");
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode: <b>"+id+"</b><br/>Nama Barang : <b>"+pr+"</b>",
        title: "<img src='<?php echo base_url();?>/assets/img/warning-icon.svg' class='warning-icon'/> Yakin ingin menghapus Data Berikut?",
        buttons: {
            main: {
                label: "Batal",
                className: "pull-left"
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
    "bPaginate": true,
    "bAutoWidth": false,
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
