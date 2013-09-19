<script>
jQuery(document).ready(function(){
jQuery("#formID2").validationEngine({
ajaxFormValidation: true,
ajaxFormValidationMethod: 'post',
});
});
</script>

<span id="quote">Update Pelanggan</span><br/><br/>
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
            <td>Perusahaan</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Perusahaan;?>" id='pr2' name='pr' style="width: 215px;">
            </td>
       </tr>
       <tr>
            <td>Contact Person</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Nama;?>" id='cp2' name='cp' style="width: 215px;">
            </td>
       </tr>
       <tr>
            <td>Alamat</td>
            <td>
                <textarea rows="2" class="validate[required]" id='al2' name='al' style="resize:none; width:215px; height: 60px;"><?php echo $row->Alamat1;?></textarea>
            </td>
       </tr>
       <tr>     
            <td>Kota</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Kota;?>" id='kt2' name='kt' style="width: 70px;">      

            &nbsp; Kode Pos 
                <input type='text' class="validate[required]" value="<?php echo $row->KodeP;?>" id='kp2' name='kp' style="width: 50px;">      
            </td>
       </tr>
       <tr>
            <td>Telp</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Telp1;?>" id='tl12' name='tl1' style="width: 190px;">      
            </td>
       </tr>
       <tr>
            <td>&nbsp;</td>
            <td>
                <input type='text' id='tl22' name='tl2' value="<?php echo $row->Telp2;?>" style="width: 190px;">      
            </td>
       </tr>
       <tr>
            <td>&nbsp;</td>
            <td>
                <input type='text' id='tl32' name='tl3' value="<?php echo $row->Telp2;?>" style="width: 190px;">      
            </td>
       </tr>
       <tr>
            <td>Fax</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->Fax1;?>" id='fx12' name='fx1' style="width: 190px;">      
            </td>
       </tr>
       <tr>
            <td>&nbsp;</td>
            <td>
                <input type='text' id='fx22' name='fx2' value="<?php echo $row->Fax2;?>" value="" style="width: 190px;">      
            </td>
       </tr>
       <tr>
       <td>NPWP</td>
            <td>
                <input type='text' class="validate[required]" value="<?php echo $row->NPWP;?>" id='np2' name='np' style="width: 215px;">      
            </td>
       </tr>
        
        <tr>
            <td>
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
        var pr2 = $('#pr2').val();
        var cp2 = $('#cp2').val();
        var al2 = $('#al2').val();
        var kt2 = $('#kt2').val();
        var kp2 = $('#kp2').val();
        var tl12 = $('#tl12').val();
        var tl22 = $('#tl22').val();
        var tl32 = $('#tl32').val();
        var fx12 = $('#fx12').val();
        var fx22 = $('#fx22').val();
        var np2 = $('#np2').val();

        if(pr2 !="" && cp2 !="" && al2 != "" && kt2 !="" && kp2 !="" && tl12 !="" && fx12 != "" && np2 !="")    
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/ms_pelanggan/update",
            data :{kd2:kd2,pr2:pr2,cp2:cp2,al2:al2,kt2:kt2,kp2:kp2,tl12:tl12,tl22:tl22,tl32:tl32,fx12:fx12,fx22:fx22,np2:np2},
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
                    url: "<?php echo base_url();?>index.php/ms_pelanggan/index",
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
