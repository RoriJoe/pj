<div class="table table-hover CSSTabel table-list">
<table id="tb1" style="width: 100%;">
    <thead>
        <th width="35%">No Mobil</th>
        <th width="15%">Action</th>
    </thead>
    
    <tbody id="tb_detail">
    <?php foreach($hasil as $row):?>
    <?php
        echo "<tr>
            <td>$row->No_mobil</td>
            <td>
            <div class='btn-group'>
                <a class='btn popup list-edit'
                    kode='$row->No_mobil'
                ><i class='icon-pencil'></i></a>
                <a class='btn delete list-edit' name='$row->No_mobil'><i class='icon-trash'></i></a></div>"
                ?>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>    
</table>
</div>

<script>
$('.popup').click(function(){        
    var kd = $(this).attr("kode"); //atribut sebagai identifier data row
    $('#kd').val(kd);
    $('#kdTemp').val(kd);

    $('#save').attr('mode','edit');
    jQuery(".hide-con").show(); 
});

$(".delete").click(function(){
    PlaySound('beep');
    var id = $(this).attr("name");
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "<table><tr><td>No Mobil </td><td>: <b>"+id+"</b></td></tr></table>",
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
                        url: "<?php echo base_url();?>index.php/ms_mobil/delete",
                        data :{id:id},
                        success: function(msg){
                            if(msg=="gagal"){
                                bootstrap_alert.warning('<b>Gagal Menghapus</b> terjadi kesalahan');
                            }else{
                                bootstrap_alert.success('Data <b>'+id+'</b> berhasil dihapus');
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
