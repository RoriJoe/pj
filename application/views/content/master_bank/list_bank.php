<div class="table table-hover CSSTabel table-list">
<table id="tb1" style="width: 100%;">
    <thead>
        <th width="30%">Kode</th>
        <th width="50%">Nama</th>
        <th width="20%">Action</th>
    </thead>

    <tbody id="tb_detail">
    <?php foreach($hasil as $row):?>

    <?php echo "<tr>
            <td>$row->kode_bank</td>
            <td>$row->nama_bank</td>
            <td>
                <div class='btn-group'>
                    <a class='btn edit list-edit'
                            kode='$row->kode_bank'
                            nama='$row->nama_bank'
                            alamat='$row->alamat'
                    ><i class='icon-pencil'></i></a>"?>
                <?php if ($this->authorization->is_permitted('delete_bank')) : ?>
                    <?php echo"<a class='btn delete list-edit' kode='$row->kode_bank' nama='$row->nama_bank'><i class='icon-trash'></i></a>
                    </div>"?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

<script>
$('.edit').click(function(){      
    var id = $(this).attr("kode"); //atribut sebagai identifier data row
    var nama = $(this).attr("nama");
    var alamat = $(this).attr("alamat");
    
    $('#_kd').val(id);
    $('#_nm').val(nama);
    $('#_al').val(alamat);
    
    $("#_kd").attr('disabled',true);
    <?php if ($this->authorization->is_permitted('update_bank')) : ?>
        $('#save').attr('mode','edit');
    <?php else: ?>
        $("#save").attr('disabled',true);
    <?php endif; ?>

    detailBank();
    document.getElementById('rek').style.visibility = 'hidden';
    jQuery(".hide-con").show();
});

$(".delete").click(function(){

    PlaySound('beep');
    var id = $(this).attr("kode");
    var pr = $(this).attr("nama");
    bootbox.dialog({
        message: "Kode: <b>"+id+"</b><br/>Bank : <b>"+pr+"</b>",
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
                        url: "<?php echo base_url();?>index.php/ms_bank/delete",
                        data :{id:id},
                        success: function(msg){
                            if(msg=="gagal"){
                                bootstrap_alert.warning('<b>Gagal!</b> Telah terjadi kesalahan');
                            }else{
                                bootstrap_alert.success('<b>Sukses!</b> Data '+ id +' telah dihapus');
                                loadListBank();
                                detailBank();
                                $("#_kd").attr('disabled',false);
								document.getElementById('rek').style.visibility = 'visible';
                            }
                            document.getElementById('rek').style.visibility = 'visible';
                            $('#formID').each(function(){
                                this.reset();
                            });
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
         "sLengthMenu": " _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
