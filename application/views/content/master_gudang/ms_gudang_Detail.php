<div class="table table-hover CSSTabel tb-barang" style="height: 400px;">
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
            <td>$row->Kode</td>
            <td>$row->Nama</td>
            <td>
            <div class='btn-group'>
                <a class='btn popup' style='padding: 2px 6px;'
                    kode='$row->Kode'
                    nama='$row->Nama'
                    alamat='$row->Alamat'
                    kota='$row->Kota'
                    telp='$row->Telp'
                    telp1='$row->Telp1'
                    fax='$row->Fax'
                    fax1='$row->Fax1'
             ><i class='icon-pencil'></i></a>
             <a class='btn delete' name='$row->Kode' style='padding: 2px 6px;'><i class='icon-trash'></i></a></div>
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
        var nm = $(this).attr("nama");
        var al = $(this).attr("alamat");
        var kt = $(this).attr("kota");
        var tel = $(this).attr("telp");
        var tel1 = $(this).attr("telp1");
        var fx = $(this).attr("fax");
        var fx1 = $(this).attr("fax1");
        
        $('#kd').val(kd);
        $('#nm').val(nm);
        $('#al').val(al);
        $('#kt').val(kt);
        $('#tl1').val(tel);
        $('#tl2').val(tel1);
        $('#fx1').val(fx);
        $('#fx2').val(fx1);
        
        
        $('#save').attr('mode','edit');    
    });

    $(".delete").click(function(){
        var id = $(this).attr("name");            
        var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
        if (r==true)
          {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_gudang/delete",
            data :{id:id},
            success: function(msg){
                if(msg=="gagal"){
                    bootstrap_alert.warning('<b>Gagal Menghapus</b> terjadi kesalahan');
                }else{
                    bootstrap_alert.success('<b>Sukses</b> Data '+id+' berhasil dihapus');
                    autogen();
                    $('#formID').each(function(){
                        this.reset();
                    });    
                    $.ajax({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/ms_gudang/index",
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
        else
          {
           return false;
          }    
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
