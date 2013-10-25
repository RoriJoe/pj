<div class="table table-hover CSSTabel tb-barang">
<table id="tb1" style="width: 100%;">
    <thead>
        <th width="30%">Kode</th>
        <th width="50%">Nama</th>
        <th width="20%">Action</th>
    </thead>

    <tbody>
    <?php foreach($hasil as $row)
    {
        echo "<tr>
            <td>$row->kode_bank</td>
            <td>$row->nama_bank</td>
            <td>
                <div class='btn-group'>
                    <a class='btn edit' style='padding: 2px 6px;'
                            kode='$row->kode_bank'
                            nama='$row->nama_bank'
                            alamat='$row->alamat'
                    ><i class='icon-pencil'></i></a>
                    <a class='btn delete' kode='$row->kode_bank' nama='$row->nama_bank' style='padding: 2px 6px;'><i class='icon-trash'></i></a>
                </div>
            </td>
        </tr>";
    } ?>
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
    $('#save').attr('mode','edit');

    detailBank();
    document.getElementById('rek').style.visibility = 'hidden';
    key();
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
         "sLengthMenu": "View _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
