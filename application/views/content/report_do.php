<script>
 $(document).ready(function() {
	//table();
	$("#range").hide();

    $("#cetakBatas").click(function() {
        $("#range").hide().eq($(this).index()).show();
    });
    
    $("#cetakAll").click(function() {
        $("#range").hide().eq($(this).index()).hide();
    });
}); 
$("#view").click(function(){
    table();
});

/*Tampilkan jQuery Tanggal*/
$(function() {
    $( "#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
    $( "#_tgl2").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
});

function table(){

	var sel = $('input[name="optionsRadios"]:checked').val();
	var _tgl = $('#_tgl').val();
	var _tgl2 = $('#_tgl2').val();
	
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>report/table_do",
    data :{sel:sel,_tgl:_tgl,_tgl2:_tgl2},
    success:
    function(hh){
        $('#tabpreview').html(hh);
    }
    });
}
//action="../report/print_report_do" method="post" action="../report/print_report_do" method="post" target="_blank"
</script>

<!--//***MAIN FORM-->
<form action="<?php echo base_url();?>report/print_report_do" method="post" target="_blank">
<div class="bar bar2" style="width: 50%">
    <p>Report Delivery Order <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>
<div id="konten" class="hide-con master-border" style="width: 48%;">
	<div>
		<label class="radio">
  		<input type="radio" name="optionsRadios" id="cetakAll" value="Semua" checked>
  			Cetak Semua
		</label>
		<label class="radio">
  		<input type="radio" name="optionsRadios" id="cetakBatas" value="Batas">
  			Cetak Batas
		</label>
	</div>
	
	<div class="pull-left" id="range" style="margin-left: 10px; border: 1px solid #C6C6C6; padding: 5px;">
		<p><b>Tanggal Delivery Order Mulai</b></p>
		<input type="text" id="_tgl" name="_tgl" style="width: 150px;"/> s/d <input type="text" id="_tgl2" name="_tgl2" style="width: 150px;"/>
		
	</div>
	<div class="pull-right" style="margin-top: 45px;">
		<input role="button" type="submit" class="btn btn-primary"  id="submit" value="Print">	
		<input role="button" type="button" class="btn btn-primary"  id="view" value="Preview">	
	</div>
</div>
</form>
<div id="tabpreview"></div>
<script>

</script>