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
<form action="<?php echo base_url();?>report/print_report_os" method="post" target="_blank">
<div class="bar bar2" style="width: 50%">
    <p>Laporan Outstanding Order<i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>
<div id="konten" class="hide-con master-border" style="width: 48%;">
	<div class="pull-left">
		<label class="radio">
  		<input type="radio" name="optionsRadios" id="cetakAll" value="option1" checked>
  			Cetak Semua
		</label>
	</div>
	<div style="clear: both;"></div>
	<div style="margin-top: 20px" class="pull-right">
		<input role="button" type="submit" class="btn btn-primary"  value="Print">
	</div>
</div>
</form>

<script>

</script>