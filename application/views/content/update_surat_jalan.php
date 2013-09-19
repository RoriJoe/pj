<script type="text/javascript" src="<?php echo base_url();?>assets/js/popup.js"></script>  
<script>
jQuery(document).ready(function(){
jQuery("#formID2").validationEngine({
ajaxFormValidation: true,
ajaxFormValidationMethod: 'post',
});
});
</script>

<span id="quote">Update Surat Jalan</span><br/><br/>
<?php foreach($hasil as $row) { ?>
<form id="formID2">
<table width="100%">
    <tr>
        <td>Nomor SJ</td>
        <td>
            <input type='text' id='sj2' name='sj' disabled="true" value="<?php echo $row->No_Sj;?>">      
        </td>
        <td>Tgl Kirim</td>
        <td>
            <input type='date' class="validate[required]" id='_tgl2' name='_tgl' value="<?php echo $row->Tgl; ?>">
        </td>
   </tr>
   <tr>     
        <td>Nomor DO</td>
        <td>
            <input type='text' class="validate[required]" id='_do2' name='_do' value="<?php echo $row->No_Do; ?>">
        </td>
        
        <td>Gudang</td>
        <td> <select name="gg" class="validate[required]" id="gg2">
            <?php
                    // echo "<option value = ''> -- Select -- </option>";
                    foreach ($list_gudang as $isi)
                    {
                        echo "<option ";        
                        if ($isi->Kode == $row->Kode_Gudang) {
                            echo "selected='selected'";
                        }
                        echo "value = '".$isi->Kode."'>".$isi->Nama."</option>";
                    }
                ?>
                </select>
        </td>
   </tr>
   
   <tr>
        <td>Pelanggan</td>
        <td>
            <input type='text' class="validate[required]" id='pn2' name='pn' value="<?php echo $row->Kode_Plg; ?>">      
        </td>
        <td>No. PO</td>
        <td>
            <input type='text' class="validate[required]" id='po2' name='po' value="<?php echo $row->No_Po; ?>">        
        </td>
    </tr>
    <tr>
        <td>Otorisasi</td>
        <td>
            <input type='text' class="validate[required]" id='ot2' name='ot' value="<?php echo $row->Otorisasi; ?>">             
        </td>
        <td>Nomor Mobil</td>
        <td>
            <input type='text' class="validate[required]" id='mbl2' name='mbl' value="<?php echo $row->No_Mobil; ?>">    
        </td>
    </tr>
    
    <tr>
        <td>
            <br/>
            <input id="saveup" type="submit" value="Save">
            <input type="reset" value="Cancel" id="cac">
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
        var _tgl2 = $('#_tgl2').val();
        var _do2 = $('#_do2').val();
        var gg2 = $('#gg2').val();
        var pn2 = $('#pn2').val();
        var po2 = $('#po2').val();
        var ot2 = $('#ot2').val();
        var mbl2 = $('#mbl2').val();
        
        var sj2 = $('#sj2').val();

        if(_tgl2 !="" && _do2 !="" && gg2 != "" && pn2 !="" && po2 !="" && ot2 !=""&& mbl2 !=""&&sj2 != "")    
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_surat_jalan/update2",
            data :{_tgl2:_tgl2, _do2:_do2, gg2:gg2, pn2:pn2, po2:po2, ot2:ot2, mbl2:mbl2, sj2:sj2},
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
                    url: "<?php echo base_url();?>index.php/tr_surat_jalan/index",
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
