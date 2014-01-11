<script>
$(document).ready(function() {
    listBarang();

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
    $("#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        language: "id",
        autoclose: true
    }); 
    $("#_tgl2").datepicker({
        changeMonth: true,
        changeYear: true,
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        language: "id",
        autoclose: true
    });  

    $( "#_tgl").datepicker('setValue', new Date()); 
    $( "#_tgl2").datepicker('setValue', new Date());
});

//Table Barang
function listBarang(){
    $('#loadingDiv').show()
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/ms_barang/viewBarang2",
        data :{},
        success:
        function(hh){
            setTimeout(function () {
                $('#list_barang').html(hh);
                $('#loadingDiv').hide()
            }, 1500);
        }
    });   
}
</script>

<div class="row-fluid">
    <div class="span3">
        <!--//***MAIN FORM-->
        <form action="<?php echo base_url();?>report/print_report_ks" method="post" target="_blank">
        <div class="bar">
            <p>Laporan Kartu Stock<i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>
        <div id="konten" class="hide-con master-border">
            <div>
                <table>
                    <tr>
                        <td>
                            <b>Tanggal Dari</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="_tgl" id="_tgl" style="width: 65px;" value="<?php echo date('01-m-Y');?>"/> s/d  
                            <input type="text" name="_tgl2" id="_tgl2" style="width: 65px;" value="<?php echo date('d-m-Y');?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="150px;" style="vertical-align: top"><b>Kode Barang Dari</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <div class='input-append' style="margin-bottom: 0; margin-top: 10px;">
                                <input type='text' name="barang1" id="barang1" id='appendedInputButton'  style='width:170px' />
                                <a href='#myModal' onclick='getDetail(1)' role='button' class='btn' data-toggle='modal' style='margin-bottom:4px;'><i class='icon-filter'></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">Sampai</td>
                    </tr>
                    <tr>
                        <td>
                            <div class='input-append'>
                                <input type='text' name="barang2" id="barang2" id='appendedInputButton'  style='width:170px' />
                                <a href='#myModal' onclick='getDetail(2)' role='button' class='btn' data-toggle='modal' style='margin-bottom:4px;'><i class='icon-filter'></i></a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="pull-left" id="range" style="margin-top: 20px; margin-left: 10px">
                <input type="text" id="_tgl" style="width: 150px;"/> s/d <input type="text" id="_tgl2" style="width: 150px;"/>
            </div>

            <div style="margin-top: 10px">
            <?php if ($this->authorization->is_permitted('print_report_ks')) : ?>
                <input role="button" type="submit" class="btn btn-primary"  value="Print">
            <?php endif; ?>
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
var filter ="";
//GET POPUP Barang
function getBarang(){
    var id = $('input:radio[name=optionsRadiosBarang]:checked').val();
    var a = filter;

            $('#barang'+a).val(id);   

    $('#myModal').modal('hide');
}

function getDetail(filterID){
    filter = filterID;
}
</script>