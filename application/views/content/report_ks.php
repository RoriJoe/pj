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

//Table Barang
function listBarang(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_barang/viewBarang",
    data :{},
    success:
    function(hh){
        $('#list_barang').html(hh);
    }
    });   
}
</script>

<!--//***MAIN FORM-->
<form action="../report/print_report_ks" method="post">
<div class="bar bar2" style="width: 50%">
    <p>Laporan Kartu Stock<i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>
<div id="konten" class="hide-con master-border" style="width: 48%;">
	<div>
		<table>
			<tr>
				<td>
					Tanggal Dari
				</td>
				<td>
					<input type="text" id="_tgl" style="width: 150px; margin-top: 10px"/> s/d  
					<input type="text" id="_tgl2" style="width: 150px; margin-top: 10px; margin-left: 5px"/>
				</td>
			</tr>
			<tr>
				<td width="150px;" style="vertical-align: top">
					<p style="margin-top: 10px">Kode Barang Dari</p>
				</td>
				<td style="text-align: center">
					<div class='input-append' style="margin-bottom: 0; margin-top: 10px;">
                		<input type='text' id="barang1" id='appendedInputButton'  style='width:170px' />
                		<a href='#myModal' onclick='getDetail(1)' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px;'><i class='icon-filter'></i></a>
            		</div>
					<br/>
					sampai
					<br/>
					<div class='input-append'>
                		<input type='text' id="barang2" id='appendedInputButton'  style='width:170px' />
                		<a href='#myModal' onclick='getDetail(2)' role='button' class='btn' data-toggle='modal' style='padding: 2px 3px;'><i class='icon-filter'></i></a>
            		</div>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="pull-left" id="range" style="margin-top: 20px; margin-left: 10px">
		<input type="text" id="_tgl" style="width: 150px;"/> s/d <input type="text" id="_tgl2" style="width: 150px;"/>
	</div>
	
	<div style="clear: both;"></div>
	<div class="pull-right" style="margin-top: 20px">
		<input role="button" type="submit" class="btn btn-primary"  value="Print">
	</div>
</div>
</form>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Barang</h3>
  </div>
  <div class="modal-body">
    <div id="list_barang"></div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" onclick="getBarang()" data-dismiss="modal" aria-hidden="true">Done</button>
  </div>
</div>

<script>
listBarang();
var filter ="";
//GET POPUP Barang
function getBarang(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var y = $('input:radio[name=optionsRadios]:checked').attr('ukuran');
    var z = $('input:radio[name=optionsRadios]:checked').attr('nama');
    
    var row = filter;
    
    $('#barang'+row).val(x);  
}

function getDetail(filterID){
    filter = filterID;
}
</script>