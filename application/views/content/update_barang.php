<script>
jQuery(document).ready(function(){
jQuery("#formID2").validationEngine({
ajaxFormValidation: true,
ajaxFormValidationMethod: 'post',
});
});
</script>

<div id="quote">Update Barang</div><br/>
<?php foreach($hasil as $row) { ?>
<form id="formID2">
<table>
    <tr>
        <td width="60%">Kode</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Kode;?>" disabled="true" id='_kd2' name='kd'  style="width: 170px;">
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>
                <input type='text' class="validate[required]" id='_nama12' name='nama1' value="<?php echo $row->Nama;?>" style="width: 215px;">
            </td>
       </tr>
       <tr>
            <td>&nbsp;</td>
            <td>
                <input type='text' class="validate[required]" id='_nama22' name='nama2' value="<?php echo $row->Nama2;?>" style="width: 215px;">
            </td>
       </tr>
       <tr>
            <td>Ukuran</td>
            <td>
                <input type='text' class="validate[required]" id='_uk2' name='uk' value="<?php echo $row->Ukuran;?>" style="width: 215px;">
            </td>
       </tr>
       <tr>
            <td>Persediaan</td>
            <td>
                <div class="input-append">
  					<input class="span2 validate[required]" id='_ps2' name='ps' style="width: 80px;" type="text"  value="<?php echo $row->Qty1;?>">
  					<span class="add-on">,00</span>
				</div>
            </td>
       </tr>

       <tr>
            <td>Satuan</td>
            <td>
                <select name="st" class="validate[required]" id="_st2">
                    <option>Batang</option>
                    <option>In</option>
                    <option>Kg</option>
                    <option>Lembar</option>
                    <option>Meter</option>
                    <option>Pcs</option>
                    <option>Roll</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br/>
                <button id="saveup" class="btn" type="submit">Save</button>
    			<button id="cac" class="btn" type="reset">Cancel</button>
            </td>
    </tr>
</table>
</form>
<?php } ?>
<script>
    $('#cac').click(function(){
        $('#popup-wrapper').fadeOut();
        $('#overlay').fadeOut('fast', function(){
          var html = jQuery('html');
          var scrollPosition = html.data('scroll-position');
          html.css('overflow', html.data('previous-overflow'));
          window.scrollTo(scrollPosition[0], scrollPosition[1])
        });
    });

    $("#saveup").click(function(){
        //DECLARE VARIABLE
        var _kd2 = $('#_kd2').val();
        var _nama12 = $('#_nama12').val();
        var _nama22 = $('#_nama22').val();
        var _uk2 = $('#_uk2').val();
        var _ps2 = $('#_ps2').val();
        var _st2 = $('#_st2').val();

        if(_nama12 !="" && _nama22 !="" && _uk2 != "" && _ps2 !="" && _st2 !="")
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_barang/update",
            data :{_kd2:_kd2,_nama12:_nama12,_nama22:_nama22,_uk2:_uk2,_ps2:_ps2,_st2:_st2},
            success:
            function(msg){
                if(msg=="ok")
                {
                    $('#konfirmasi').hide();
                    $('#konfirmasi2').hide();
                    $('#konfirmasi').show();
					$('#konfirmasi').addClass("alert alert-success");
                    $('#konfirmasi').html("Update Success");

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
                else{
                    $('#konfirmasi').hide();
                    $('#konfirmasi2').hide();
                    $('#konfirmasi2').show();
					$('#konfirmasi2').addClass("alert alert-error");
                    $('#konfirmasi2').html("Update Fail data already exist");
                }
                $('#popup-wrapper').fadeOut();
                $('#overlay').fadeOut('fast', function(){
                  var html = jQuery('html');
                  var scrollPosition = html.data('scroll-position');
                  html.css('overflow', html.data('previous-overflow'));
                  window.scrollTo(scrollPosition[0], scrollPosition[1])
                });
            }
            });
        }
    });
</script>
