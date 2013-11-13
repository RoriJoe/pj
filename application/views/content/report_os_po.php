<script>
$(document).ready(function() {
	$("#range").hide();

    $("#cetakBatas").click(function() {
        $("#range").hide().eq($(this).index()).show();
    });
    
    $("#cetakAll").click(function() {
        $("#range").hide().eq($(this).index()).hide();
    });
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

$("#view").click(function(){
    table();
});

/* $("#print").click(function(){
	var d = new Date();
	var curr_date = d.getDate();
	var curr_month = d.getMonth() + 1; //Months are zero based
	var curr_year = d.getFullYear();
	var tgl = curr_date + "-" + curr_month + "-" + curr_year;
$('#lab1').text("");
    var data = $('#tabpreview').html();
	
	var mywindow = window.open('', '', '');
	mywindow.document.write('<title>Laporan Sales Order '+tgl+'</title>');
	mywindow.document.write('<style>.draggable , .tableLap{border-width: 0 0 1px 1px;border-spacing: 0;border-collapse: collapse;border-style: solid;}.draggable td, .tableLap td, .draggable th, .tableLap th{margin: 0;padding: 2px;border-width: 1px 1px 0 0;border-style: solid;}</style>');
	
	mywindow.document.write('');
	mywindow.document.write('<center><h2>Laporan Sales Order</h2></center>');
	mywindow.document.write(data); 
	

	mywindow.print();
	mywindow.close();

	return true;
}); */
function table(){

	var sel = $('input[name="optionsRadios"]:checked').val();
	
	
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>report/table_os_po",
    data :{sel:sel},
    success:
		function(hh){
			$('#tabpreview').html(hh);
		}
    });
}
</script>

<div class="row-fluid">
    <div class="span3">
    	<!--//***MAIN FORM-->
		<form action="<?php echo base_url();?>report/print_report_os_po" method="post" target="_blank">
		<div class="bar">
		    <p>Laporan Outstanding Purchase Order<i id="icon" class='icon-chevron-down icon-white'></i></p>
		</div>
		<div id="konten" class="hide-con master-border">
			<div class="pull-left">
				<label class="radio">
		  		<input type="radio" name="optionsRadios" id="cetakAll" value="Semua" checked>
		  			Cetak Semua
				</label>
			</div>
			<div style="clear: both;"></div>
			<div style="margin-top: 10px">
				<!--<input role="button" type="button" class="btn btn-primary"  id="print" value="Print">	-->	
				<input role="button" type="submit" class="btn btn-primary"  id="submit" value="Print">
				<input role="button" type="button" class="btn"  id="view" value="Preview">	
			</div>
		</div>
		</form>
    </div>

    <div class="span9">
      <div id="tabpreview"></div>
    </div>
</div>