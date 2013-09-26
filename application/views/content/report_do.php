<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.10.custom.min.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#range").hide();

    $("#cetakBatas").click(function() {
        $("#range").hide().eq($(this).index()).show();
    });
    
    $("#cetakAll").click(function() {
        $("#range").hide().eq($(this).index()).hide();
    });
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
</script>

<!--//***MAIN FORM-->
<form action="../report/print_report_do" method="post">
<div class="bar bar2" style="width: 50%">
    <p>Report Delivery Order <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>
<div id="konten" class="hide-con master-border" style="width: 48%;">
	<div>
		<label class="radio">
  		<input type="radio" name="optionsRadios" id="cetakAll" value="option1" checked>
  			Cetak Semua
		</label>
		<label class="radio">
  		<input type="radio" name="optionsRadios" id="cetakBatas" value="option2">
  			Cetak Batas
		</label>
	</div>
	
	<div class="pull-left" id="range" style="margin-left: 10px; border: 1px solid #C6C6C6; padding: 5px;">
		<p><b>Tanggal Delivery Order Mulai</b></p>
		<input type="text" id="_tgl" style="width: 150px;"/> s/d <input type="text" id="_tgl2" style="width: 150px;"/>
	</div>
	<div class="pull-right" style="margin-top: 45px;">
		<input role="button" type="submit" class="btn btn-primary"  value="Print">
	</div>
</div>
</form>

<script>

</script>