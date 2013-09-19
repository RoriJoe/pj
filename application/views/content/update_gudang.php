<script>
jQuery(document).ready(function(){
jQuery("#formID2").validationEngine({
ajaxFormValidation: true,
ajaxFormValidationMethod: 'post',
});
});
</script>

<div id="quote">Update Gudang</div> <br/>
<?php foreach($hasil as $row) { ?>
<form id="formID2">
<table>
        <tr>
            <td width="60%">Kode</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Kode;?>" disabled="true" id='kd2' name='kd' style="width: 170px;">   
            </td>
        </tr>
       <tr>
            <td>Nama</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Nama;?>" id='nm2' name='nm' style="width: 215px;">
            </td>
       </tr>
       <tr>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required]" id='al2' name='al' style="resize:none; width:215px; height: 60px;"><?php echo $row->Alamat;?></textarea>
            </td>
       </tr>
       <tr>     
            <td>Kota</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Kota;?>" id='kt2' name='kt' style="width: 70px;">      
            </td>
       </tr>
       <tr>
            <td>Telp</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Telp;?>" id='tl12' name='tl1' style="width: 190px;">      
            </td>
       </tr>
       <tr>
            <td>
                &nbsp;
            </td>
            <td>
                <input type='text' id='tl22' name='tl2' value="<?php echo $row->Telp1;?>" style="width: 190px;">      
            </td>
       </tr>
       <tr>
            <td>Fax</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Fax;?>" id='fx12' name='fx1' style="width: 190px;">      
            </td>
       </tr>
       <tr>
            <td>
                &nbsp;
            </td>
            <td>
                <input type='text' id='fx22' name='fx2' value="<?php echo $row->Fax1;?>" value="" style="width: 190px;">      
            </td>
       </tr>
       <tr>        
       <tr>
            <td colspan="2">
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
        var kd2 = $('#kd2').val();
        var nm2 = $('#nm2').val();
        var al2 = $('#al2').val();
        var kt2 = $('#kt2').val();
        var tl12 = $('#tl12').val();
        var tl22 = $('#tl22').val();
        var fx12 = $('#fx12').val();
        var fx22 = $('#fx22').val();

        if(nm2 !="" && al2 != "" && kt2 !="" && tl12 !="" && fx12 != "")    
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_gudang/update",
            data :{kd2:kd2,nm2:nm2,al2:al2,kt2:kt2,tl12:tl12,tl22:tl22,fx12:fx12,fx22:fx22},
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
                    url: "<?php echo base_url();?>index.php/ms_gudang/index",
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
                    $('#konfirmasi').addClass("alert alert-error");    
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
