<div class="table table-hover CSSTabel table-list">
<table id="tb1" style="width: 100%;">
    <thead>
        <th >Kode</th>
        <th >Pelanggan</th>
        <th >Action</th>
    </thead>

    <tbody id="tb_detail">
    <?php foreach($hasil as $row)
    {
        $limit = number_format($row->Limit_Kredit,0,",",".");
        echo "<tr>
            <td>$row->Kode</td>
            <td>$row->Perusahaan</td>
            <td>
			<div class='btn-group'>
			 <a class='btn edit list-edit'
			        kode='$row->Kode'
			        nama='$row->Nama'
			        nama1='$row->Nama1'
                    perusahaan='$row->Perusahaan'
                    alamat='$row->Alamat1'
                    kota='$row->Kota'
                    kodep='$row->KodeP'
                    telp='$row->Telp'
                    telp1='$row->Telp1'
                    telp2='$row->Telp2'
                    fax='$row->Fax1'
                    fax1='$row->Fax2'
                    npwp='$row->NPWP'
                    limit='$limit'
                    lama='$row->Lama'
			 ><i class='icon-pencil'></i></a>

			 <a class='btn delete' name='$row->Kode' pr='$row->Perusahaan' style='padding: 0px 3px;'><i class='icon-trash'></i></a></div>
            </td>
        </tr>";
    } ?>
    </tbody>
</table>
</div>

<script>
//Edit TRIGGER
$('.edit').click(function(){
    $("#kd").attr('disabled',true);
    
    var kd = $(this).attr("kode");
    var pr = $(this).attr("perusahaan");
    var cp = $(this).attr("nama");
    var al = $(this).attr("alamat");
    var np = $(this).attr("npwp");
    var kt = $(this).attr("kota");
    var kp = $(this).attr("kodep");
    var tel = $(this).attr("telp");
    var tel1 = $(this).attr("telp1");
    var tel2 = $(this).attr("telp2");
    var fx = $(this).attr("fax");
    var fx1 = $(this).attr("fax1");
    var limit = $(this).attr("limit");
    var lama = $(this).attr("lama");
    
    $('#kd').val(kd);
    $('#pr').val(pr);
    $('#cp').val(cp);
    $('#al').val(al);
    $('#np').val(np);
    $('#kt').val(kt);
    $('#kp').val(kp);
    $('#tl1').val(tel);
    $('#tl2').val(tel1);
    $('#tl3').val(tel2);
    $('#fx1').val(fx);
    $('#fx2').val(fx1);
    $('#lk').val(limit);
    $('#term').val(lama);
    
    $('#save').attr('mode','edit');
    key();
    jQuery(".hide-con").show();
});

$(".delete").click(function(){
    PlaySound('beep');
    var id = $(this).attr("name");
    var pr = $(this).attr("pr");
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "Kode: <b>"+id+"</b><br/>Pelanggan : <b>"+pr+"</b>",
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
                        url: "<?php echo base_url();?>index.php/ms_pelanggan/delete",
                        data :{id:id},
                        success: function(msg){
                            if(msg=="gagal"){
                                bootstrap_alert.warning('<b>Gagal Menghapus</b> terjadi kesalahan');
                            }else{
                                bootstrap_alert.success('Data <b>'+pr+'</b> berhasil dihapus');
                                autogen();
                                $('#formID').each(function(){
                                    this.reset();
                                });
                                $.ajax({
                                type:'POST',
                                url: "<?php echo base_url();?>index.php/ms_pelanggan/index",
                                data :{},
                                success:
                                function(hh){
                                    $('#hasil').html(hh);
                                }
                                });
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
    "sPaginationType": "full_numbers",
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
