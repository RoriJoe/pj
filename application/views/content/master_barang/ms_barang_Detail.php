<div class="CSSTabel table-list" style="width:98%;">
<table id="tb1" class="table table-hover">
    <thead>
        <th width="20%">Kode</th>
        <th width="70%">Nama</th>
        <th width="10%">Action</th>
    </thead>

    <tbody id="tb_detail">
    <?php foreach($hasil as $row):?>
    <?php
        echo "<tr>
            <td>$row->Kode</td>
            <td nama='$row->Nama'>$row->Nama $row->Ukuran</td>
            <td>
                <div class='btn-group'>
                    <a class='btn popup' style='padding: 0px 3px;' kode='$row->Kode'><i class='icon-pencil'></i></a>"?>
                    <?php if ($this->authorization->is_permitted('delete_barang')) : ?>
                        <?php echo"<a class='btn delete' kode='$row->Kode' nama='$row->Nama $row->Ukuran' style='padding: 0px 3px;'><i class='icon-trash'></i></a></div>"?>
                    <?php endif;?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

<script>
   //Edit TRIGGER
$('#tb1 tbody tr').dblclick(function (e) {
    $(this).find('td .popup').click();
});

$('.popup').click(function(){
    $("#_kd").attr('disabled',true);
    
    var id = $(this).attr("kode"); //atribut sebagai identifier data row
	
	$('#_kd').val(id);

    <?php if ($this->authorization->is_permitted('update_barang')) : ?>
        $('#save').attr('mode','edit');
    <?php else: ?>
        $("#save").attr('disabled',true);
    <?php endif; ?>

    retrieveForm(id);
    jQuery(".hide-con").show();
});

$(".delete").click(function(){
    PlaySound('beep');
    var id = $(this).attr("kode");
    var pr = $(this).attr("nama");
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "<table><tr><td>Kode </td><td>: <b>"+id+"</b></td></tr><tr><td>Nama Barang </td><td>: <b>"+pr+"</b></td></tr></table>",
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
