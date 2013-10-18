<div class="table table-hover CSSTabel tb-barang">
<table id="tb1" style="width: 100%;">
    <thead>
        <th >Kode</th>
        <th >Nama</th>
        <th >Action</th>
    </thead>

    <tbody>
    <?php foreach($hasil as $row)
    {
        echo "<tr>
            <td>$row->kode_bank</td>
            <td>$row->nama_bank</td>
            <td>
                <div class='btn-group'>
                    <a class='btn popup' style='padding: 2px 6px;'
                            kode='$row->kode_bank'
                            nama='$row->nama_bank'
                            alamat='$row->alamat'
                    ><i class='icon-pencil'></i></a>
                    <a class='btn delete' kode='$row->kode_bank' style='padding: 2px 6px;'><i class='icon-trash'></i></a>
                </div>
            </td>
        </tr>";
    } ?>
    </tbody>
</table>
</div>

<script>
$('.popup').click(function(){      
    $("#_kd").attr('disabled',true);


    var id = $(this).attr("kode"); //atribut sebagai identifier data row
    var nama = $(this).attr("nama");
    var alamat = $(this).attr("alamat");
    
    $('#_kd').val(id);
    $('#_nm').val(nama);
    $('#_al').val(alamat);
    
    $('#save').attr('mode','edit');
    detailBank();
    document.getElementById('add_item').style.visibility = 'hidden';
});

$(".delete").click(function(){
var id = $(this).attr("kode");
//var r=confirm("Anda yakin ingin menghapus barang "+$(this).attr("kode")+" ?");
    bootbox.confirm("Anda yakin ingin menghapus data "+id+" ?", function(result){
        if (result==true)
        {
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
                }
                $('#formID').each(function(){
                    this.reset();
                });
            }
        });
        }
    });
});

var oTable = $('#tb1').dataTable( {
    "sScrollY": "300px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": false,
    "aaSorting": [[ 4, "desc" ]],
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
