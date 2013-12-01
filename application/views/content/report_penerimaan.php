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

function table(){

	var sel = $('input[name="optionsRadios"]:checked').val();
	var _tgl = $('#_tgl').val();
	var _tgl2 = $('#_tgl2').val();
	
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>report/table_penerimaan",
    data :{sel:sel,_tgl:_tgl,_tgl2:_tgl2},
    success:
		function(hh){
			$('#tabpreview').html(hh);
		}
    });
}

$("#view").click(function(){
    table();
});

$("#print").click(function(){


	//TANGGAL
	var d = new Date();
	var curr_date = d.getDate();
	var curr_month = d.getMonth() + 1; //Months are zero based
	var curr_year = d.getFullYear();
	var tgl = curr_date + "-" + curr_month + "-" + curr_year;
	
    //var data = $('#tabpreview').html();
	 var data = $('#LimitTab').html();
	 var per = $('#per').html();
	var mywindow = window.open('');
	
	
	mywindow.document.write('<title>Laporan Penerimaan Barang '+tgl+'</title>');
	mywindow.document.write('<style>.draggable , .tableLap{border-width: 0 0 1px 1px;border-spacing: 0;border-collapse: collapse;border-style: solid;}.draggable td, .tableLap td, .draggable th, .tableLap th{margin: 0;padding: 2px;border-width: 1px 1px 0 0;border-style: solid;}</style>');
	
	mywindow.document.write('');
	mywindow.document.write('<table><tr><td width="70%"><h2 style="margin: 0">PD. PELITA JAYA</h2></td><td width="20%">Tanggal : '+tgl+'</td></tr><tr><td ><h3>LAPORAN PENERIMAAN BARANG</h3></td><td width="20%">'+per+'</td></tr></table>');

	mywindow.document.write(data);
	

	mywindow.print();
	mywindow.close();

	return true;
});
</script>

<div class="row-fluid">
    <div class="span3">
		<!--//***MAIN FORM-->
		<form action="<?php echo base_url();?>report/print_report_penerimaan" method="post" target="_blank">
		<div class="bar">
		    <p>Laporan Penerimaan Barang <i id="icon" class='icon-chevron-down icon-white'></i></p>
		</div>
		<div id="konten" class="hide-con master-border">
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
			
			<div id="range" style="border: 1px solid #C6C6C6; padding: 5px;">
				<p><b>Tanggal BPB Mulai</b></p>
				<input type="text" id="_tgl" name="_tgl" style="width: 65px;" value="<?php echo date('01-m-Y');?>"/> s/d <input type="text" id="_tgl2" name="_tgl2" style="width: 65px;" value="<?php echo date('d-m-Y');?>"/>
			</div>
			<div style="margin-top: 10px;">
			<?php if ($this->authorization->is_permitted('print_report_terima')) : ?>
				<input role="button" type="button" class="btn btn-primary"  id="print" value="Print">	
			<?php endif; ?>
				<!--<input role="button" type="submit" class="btn btn-primary"  value="Print">-->
				<input role="button" type="button" class="btn"  id="view" value="Preview">	
				
			</div>
		</div>
		</form>
    </div>

    <div class="span9">
      <div id="tabpreview"></div>
    </div>
</div>