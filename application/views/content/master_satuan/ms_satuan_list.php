<div class="table table-hover CSSTabel table-list">
<table id="tb1" style="width: 100%;">
    <thead>
        <th width="35%">Kode</th>
        <th width="50%">Satuan</th>
        <th width="15%">Action</th>
    </thead>
    
    <tbody id="tb_detail">
    <?php foreach($hasil as $row):?>
    <?php
        echo "<tr>
            <td>$row->Kode_satuan</td>
            <td>$row->Value</td>
            <td>
            <div class='btn-group'>
                <a class='btn popup list-edit'
                    kode='$row->Kode_satuan'
                    satuan='$row->Value'
                ><i class='icon-pencil'></i></a>"?>
            <?php if ($this->authorization->is_permitted('delete_satuan')) : ?>
                <?php echo"<a class='btn delete list-edit' name='$row->Kode_satuan' nama='$row->Value'><i class='icon-trash'></i></a></div>"?>
            <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>    
</table>
</div>

<script>
$('.popup').click(function(){
    $("#kd").attr('disabled',true);
        
    var kd = $(this).attr("kode"); //atribut sebagai identifier data row
    var nm = $(this).attr("satuan");
    
    $('#kd').val(kd);
    $('#nm').val(nm);
    
    <?php if ($this->authorization->is_permitted('update_satuan')) : ?>
        $('#save').attr('mode','edit');
    <?php else: ?>
        $("#save").attr('disabled',true);
    <?php endif; ?>
    jQuery(".hide-con").show(); 
});

$(".delete").click(function(){
    PlaySound('beep');
    var id = $(this).attr("name");
    var pr = $(this).attr("nama");
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode Satuan: <b>"+id+"</b><br/>Nama Satuan : <b>"+pr+"</b>",
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
                        url: "<?php echo base_url();?>index.php/ms_satuan/delete",
                        data :{id:id},
                        success: function(msg){
                            if(msg=="gagal"){
                                bootstrap_alert.warning('<b>Gagal Menghapus</b> terjadi kesalahan');
                            }else{
                                bootstrap_alert.success('Data <b>'+pr+'</b> berhasil dihapus');
                                $('#formID').each(function(){
                                    this.reset();
                                });
                                load_list();
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
         "sLengthMenu": " _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
