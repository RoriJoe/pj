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

	var sel = $('input[name="optionsRadios1"]:checked').val();
	var _tgl = $('#_tgl').val();
	var _tgl2 = $('#_tgl2').val();
	var plg1 = $('#kd_plg1').val();
	var plg2 = $('#kd_plg2').val();
	
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>report/table_po",
    data :{sel:sel,_tgl:_tgl,_tgl2:_tgl2,plg1:plg1,plg2:plg2},
    success:
		function(hh){
			$('#tabpreview').html(hh);
		}
    });
}

function listPelanggan(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/report/view_po_supplier",
    data :{},
    success:
    function(hh){
        $('#list_supplier').html(hh);
    }
    });   
} 
var filter ="";
function getDetail(filterID){
listPelanggan();
    filter = filterID;
}
function getPelanggan(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
     var row = filter;
    
     
	
    $('#_pn'+row).val(x);
    $('#kd_plg'+row).val(k);
    
}

function getSupplier(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
	var row = filter;
   $('#_pn'+row).val(x);
    $('#kd_plg'+row).val(k);
    
}
</script>
<div class="row-fluid">
    <div class="span3">
      <!--//***MAIN FORM-->
      <form action="<?php echo base_url();?>report/print_report_po" method="post" target="_blank">
      <div class="bar" >
          <p>Report Purchase Order <i id="icon" class='icon-chevron-down icon-white'></i></p>
      </div>

      <div id="konten" class="hide-con master-border">
        <table>
          <tr>
            <td>
              <label class="radio">
                <input type="radio" name="optionsRadios1" id="cetakAll" value="Semua" checked>
                  Cetak Semua
              </label>
            </td>
            <td>
              <label class="radio" style="margin-left:5px;">
                <input type="radio" name="optionsRadios1" id="cetakBatas" value="Batas">
                  Cetak Batas
              </label>
            </td>
          </tr>
        </table>
        
        <div id="range">
          <table>
            <tr>
              <td colspan="3"><b>Tanggal PO Mulai</b></td>
            </tr>
            <tr>
              <td>
                <input type="text" id="_tgl" name="_tgl" style="width: 65px;" value="<?php echo date('01-m-Y');?>"/>
                s/d
                <input type="text" id="_tgl2" name="_tgl2" style="width: 65px;" value="<?php echo date('d-m-Y');?>"/>
              </td>
            </tr>
            <tr>
              <td>
                <b>Supplier Mulai</b>
              </td>
            </tr>
            <tr>
              <td>
                <input type="hidden" id="kd_plg1" />
                <div class="input-append">
                  <input type='text' class="span2" disabled="disabled" maxlength="20" id="_pn1" placeholder='Batas Awal' id='appendedInputButton' name='_pn1' style="width: 148px;" onclick="lookup_pelanggan()" onkeydown="lookup_pelanggan()"/>
                  <a href="#modalSupplier" id="f_plg" style="margin-bottom:4px;" role="button" class="btn" title="Search Pelanggan" data-toggle="modal" onclick="getDetail(1)"><i class="icon-search"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="input-append">
                  <input type="hidden" id="kd_plg2" />
                  <input type='text' class="span2" disabled="disabled"
                            maxlength="20" id="_pn2" id='appendedInputButton' name='_pn2' placeholder='Batas Akhir' style="width: 148px;" onclick="lookup_pelanggan()" onkeydown="lookup_pelanggan()"/>
                  <a href="#modalSupplier" id="f_plg2" role="button" class="btn" title="Search Pelanggan" data-toggle="modal" style="margin-bottom:4px;" onclick="getDetail(2)"><i class="icon-search"></i></a>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <div>
          <!--<input role="button" type="button" class="btn btn-primary"  id="print" value="Print"> -->
          <?php if ($this->authorization->is_permitted('print_report_purchase')) : ?>
		        <input role="button" type="submit" class="btn btn-primary"  value="Print">
          <?php endif;?>
          <input role="button" type="button" class="btn"  id="view" value="Preview">  
        </div>
      </div>
      </form>
    </div>

    <div class="span9">
      <div id="tabpreview"></div>
    </div>
</div>



<div id="modalSupplier" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Supplier</h3>
  </div>
  <div class="modal-body">
    <div id="list_supplier"></div>
  </div>
</div>