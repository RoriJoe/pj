<div class="table table-hover CSSTabel tb-barang">
<table id="tb1" style="width: 100%;">
    <thead>
        <th width="35%">Kode Satuan</th>
        <th width="50%">Satuan</th>
        <th width="15%">Action</th>
    </thead>
    
    <tbody id="tb_detail">
    <?php foreach($hasil as $row)
    {
        echo "<tr>
            <td>$row->Kode_satuan</td>
            <td>$row->Value</td>
            <td>
            <div class='btn-group'>
                <a class='btn popup' style='padding: 2px 6px;'
                    kode='$row->Kode_satuan'
                    satuan='$row->Value'
                ><i class='icon-pencil'></i></a>
             <a class='btn delete' name='$row->Kode_satuan' nama='$row->Value' style='padding: 2px 6px;'><i class='icon-trash'></i></a></div>
            </td>
        </tr>";
    } ?>

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
    
    $('#save').attr('mode','edit');  
    key();
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
         "sLengthMenu": "View _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
