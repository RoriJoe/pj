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
            <td>$row->Kode</td>
            <td nama='$row->Nama'>$row->Nama</td>
            <td>
                <div class='btn-group'>
                    <a class='btn popup' style='padding: 2px 6px;'
                            nama='$row->Nama'
                            kode='$row->Kode'
                            ukuran='$row->Ukuran'
                            kete='$row->Nama2'
                            prs='$row->Qty1'
                            stn='$row->Satuan1'
                            ><i class='icon-pencil'></i></a>
                    <a class='btn delete' kode='$row->Kode' style='padding: 2px 6px;'><i class='icon-trash'></i></a>
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
        
        $("#_kd").attr('disabled',true);
        
        var id = $(this).attr("kode"); //atribut sebagai identifier data row
        var nama = $(this).attr("nama");
		var ukuran = $(this).attr("ukuran");
		var keterangan = $(this).attr("kete");
		var prs = $(this).attr("prs");
		var stn = $(this).attr("stn");
		
		$('#_kd').val(id);
		$('#_nama1').val(nama);
		$('#_uk').val(ukuran);
		$('#_ket').val(keterangan);
		$('#_ps').val(prs);
		
		$('#save').attr('mode','edit');
		
		function setSelectedIndex(s, valsearch)
		{
		// Loop through all the items in drop down list
		for (i = 0; i< s.options.length; i++)
		{ 
			if (s.options[i].value == valsearch)
			{
				// Item is found. Set its property and exit
				s.options[i].selected = true;
				break;
			}
		}
		return;
		}
		setSelectedIndex(document.getElementById("_st"),stn);
    });

    $(".delete").click(function(){
        var id = $(this).attr("kode");
        bootbox.confirm("Anda yakin ingin menghapus data "+id+" ?", function(result)
        {
            if (result==true)
              {
                $.ajax({
                type:'POST',
                url: "<?php echo base_url();?>index.php/ms_barang/delete",
                data :{id:id},
                success: function(msg){
                    if(msg=="gagal"){
    					bootstrap_alert.warning('<b>Gagal!</b> Telah terjadi kesalahan');
                    }else{
                        bootstrap_alert.success('<b>Sukses!</b> Data '+ id +' telah dihapus');
    					autogen();
                        $.ajax({
                        type:'POST',
                        url: "<?php echo base_url();?>index.php/ms_barang/index",
                        data :{},
                        success:
                        function(hh){
                            $('#hasil').html(hh);
                        }
                        });
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
