<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>

<!--//***MAIN FORM-->
<div class="row-fluid">
    <div class="span7">
        <div class="bar-fluid">
            <p>Form Status Piutang <i id="icon" class='icon-chevron-down icon-white'></i></p>
        </div>

        <div id="konten" class="hide-con-fluid master-border">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#piutang" data-toggle="tab">Piutang</a></li>
              <li class=""><a href="#profile" data-toggle="tab">Invoice</a></li>
            </ul>

            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="piutang">
                    <form id="formID">
                        <table width="100%">
                            <tr>
                                <td>Pelanggan</td>
                                <td>
                                    <input type="hidden" id="_kode_pelanggan">
                                    <input type='text' readonly="true" 
                                    id='_pelanggan' name='_pelanggan'
                                    style="width: 170px; margin-left: 10px; margin-right: 20px;"/>
                                </td>
                                <td>Limit</td>
                                <td>
                                    <input type='text'
                                    id="_limit" name="_limit" 
                                    style="width: 170px; margin-left: 10px; margin-right: 20px;"/>
                                </td>
                           </tr>
                           <tr>
                                <td>Piutang</td>
                                <td>
                                    <input type='text' readonly="true" 
                                    maxlength="7" id="_piutang" name="_piutang" 
                                    style="width: 170px; margin-left: 10px; margin-right: 20px;"/>
                                </td>
                           </tr>
                        </table>
                        <div style="margin-top: 10px;"> 
                            <!--<button id="bayar" class="btn btn-primary" disabled="disabled">Bayar</button>-->
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="profile">
                <form>
                    <table>
                        <tr>
                            <td width="80px">Invoice</td>
                            <td colspan="3">
                                <div id="invo">
                                    <select style="width: 170px;">
                                        <option value = ''> -- Select -- </option>"
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl Invoice</td>
                            <td>
                                <input type="text" id="_tgl" name="_tgl" 
                                style="width: 80px; margin-right: 20px;"
                                >
                            </td>
                            <td>Nomor PO</td>
                            <td>
                                <input type="text" id="_po" name="_po" 
                                style="width: 120px; margin-left: 10px; margin-right: 20px;"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td>Terms</td>
                            <td>
                                <input type="text" id="_term" name="_term" 
                                style="width: 40px; margin-right: 20px;"
                                > Hari
                            </td>
                            <td>Status</td>
                            <td>
                                <label class="checkbox inline">
                                  <input type="checkbox" id="inlineCheckbox1" value="option1"> Lunas
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>
                                <input type="text" id="_jumlah" 
                                style="width: 120px; margin-right: 20px;"
                                >
                            </td>
                            <td>
                                <!--<input type="button" class="btn btn-medium btn-info" value="Bayar">-->
                            </td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>

    <div class="span4 offset1">
        <div id="list"></div>
    </div>

</div>


<script type="text/javascript">
$(document).ready(function(){
    listPiutang();
});

function listPiutang(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>piutang/index",
    data :{},
    success:
    function(hh){
        $('#list').html(hh);
    }
    });
}

function get_invoice($user_id){
    var id = $user_id;
    console.log(id);

    $.ajax({
        type:'POST',
        async: false,
        url: "<?php echo base_url();?>piutang/invoice_call",
        data:{id:id},
        dataType: "html",

        success: function(data){
            $('#invo').html(data);
        }
    });
}

function displayResult(selTag)
{
    var x=selTag.options[selTag.selectedIndex].text;
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>piutang/detail_invoice",
        data:{x:x},
        dataType: 'json',

        success: function(data){
            $('#_tgl').val(data.Tgl);
            $('#_term').val(data.Term);
            $('#_jumlah').val(data.Total);
            $('#_po').val(data.No_Po);
        }
    });
}


</script>