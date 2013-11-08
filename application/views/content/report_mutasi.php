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
    url: "<?php echo base_url();?>index.php/ms_barang/viewBarang2",
    data :{},
    success:
    function(hh){
        $('#list_barang').html(hh);
    }
    });   
}
</script>

<div class="row-fluid">
    <div class="span3">
        <!--//***MAIN FORM-->
        <form action="<?php echo base_url();?>report/print_report_mutasi" method="post" target="_blank">
        <div class="bar">
            <p>Laporan Mutasi<i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>
        <div id="konten" class="hide-con master-border">
            <div>
                <table>
                    <tr><td><b>Kode Barang Dari</b></td></tr>
                    <tr>
                        <td style="text-align: center">
                            <div class='input-append' style="margin-bottom: 0">
                                <input type='text' id="barang1" name="barang1" id='appendedInputButton'  style='width:170px' />
                                <a href='#myModal' onclick='getDetail(1)' style="margin-bottom:4px;" role='button' class='btn' data-toggle='modal'><i class='icon-filter'></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            sampai
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class='input-append'>
                                <input type='text' id="barang2" name="barang2" id='appendedInputButton'  style='width:170px' />
                                <a href='#myModal' onclick='getDetail(2)' style="margin-bottom:4px;" role='button' class='btn' data-toggle='modal' style='padding: 2px 3px;'><i class='icon-filter'></i></a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Tanggal Dari</b></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="_tgl" name="_tgl" style="width: 65px;" value="<?php echo date('01-m-Y');?>"/>  
                            s/d
                            <input type="text" id="_tgl2" name="_tgl2" style="width: 65px;" value="<?php echo date('d-m-Y');?>"/>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="pull-left" id="range" style="margin-top: 20px; margin-left: 10px">
                <input type="text" id="tgl1" name="tgl1" style="width: 150px;"/> s/d <input type="text" id="tgl2" name="tgl2" style="width: 150px;"/>
            </div>

            <div style="margin-top: 10px">
                <input role="button" type="submit" class="btn btn-primary"  value="Print">
            </div>
        </div>
        </form>
    </div>
</div>

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