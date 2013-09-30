<script>
//Auto Generate
function autogen(){
    $('#add').attr('mode','new');
    $('#delete').attr('disabled', true);
    $("#_so").attr('disabled',false);
    $("#total").val("");
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_do/auto_gen",
    data :{},
    success:
        function(hh){
            $('#_so').val(hh);
        }
    });
}

//Suggestion Pelanggan
function lookup_pelanggan(){
    $("#_pn").autocomplete({
    minLength: 1,
    source:
        function(req, add){
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/autocomplete/lookpn",
                dataType: 'json',
                type: 'POST',
                data: req,
                success:
                function(data){
                    if(data.response =="true"){
                        add(data.message);
                    }
                },
            });
        },
    select:
        function(event, ui) {
            $('#_pn').val(ui.item.value);
        },
    });
}

//Validation engine
function validation_engine() {
    jQuery("#formID").validationEngine(
    {
        showOneMessage: true,
        ajaxFormValidation: true,
        ajaxFormValidationMethod: 'post',
        autoHidePrompt: true,
        autoHideDelay: 2500, 
        fadeDuration: 0.3
    });
}

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

//Icon Animation
function animation(){
  jQuery(".hide-con").hide();
  var i = document.getElementById('konten');
  jQuery(".bar").click(function()
  {
        jQuery(this).next(".hide-con").slideToggle(500, function(){
        // Animation complete.
        if(i.style.display=="none"){
            document.getElementById('icon').className='icon-chevron-down icon-white';
        }else{
            document.getElementById('icon').className='icon-chevron-up icon-white';
            }
        });
  });
}

//Table Pelanggan
function listPelanggan(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/ms_pelanggan/viewPelanggan",
    data :{},
    success:
    function(hh){
        $('#list_pelanggan').html(hh);
    }
    });   
}

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

//fungsi untuk menampilkan Table Detail SO *table bawah*
function tampilDetailSO(){
    var so = $('#_so').val();
    $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/tr_do/tableDetail",
        data :{so:so},
        success:
        function(hh){
           $('#hasil2').html(hh);
        }
    });
}

//Tampilkan Table yg disamping Via AJAX
function listSO(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/tr_do/index",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
    });
}

//Load Function
jQuery(document).ready(function(){
    listSO();
    autogen();
    validation_engine()
    animation();
    lookup_pelanggan();
    tampilDetailSO();
});
</script>

<!--**NOTIFICATION AREA**-->
<div id="konfirmasi" class="sukses"></div>

<!--//***MAIN FORM-->
<div class="bar bar2" style="width: 70%">
    <p>Form Sales Order <i id="icon" class='icon-chevron-down icon-white'></i></p>
</div>
<div id="konten" class="hide-con master-border" style="width: 68%;">
<form id="formID">
    <table width="100%">
        <tr>
            <td>Nomor SO</td>
            <td>
                <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" 
                maxlength="20" id='_so' name='_so' style="width: 170px; margin-left: 10px; margin-right: 20px;">
            </td>
            
            <td>Nomor PO</td>
            <td>
                <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" 
                maxlength="20" id='_po' name='_po' style="width: 170px; margin-left: 10px; margin-right: 20px;">
            </td>
       </tr>
       <tr>
            <td>Tanggal SO</td>
            <td>
                <input type='text' class="validate[required]" id='_tgl' name='_tgl' 
                style="width: 80px;margin-left: 10px; margin-right: 20px;">
            </td>
            <td>Tanggal PO</td>
            <td>
                <input type='text' class="validate[required]" id='_tgl2' name='_tgl2' 
                style="width: 80px;margin-left: 10px; margin-right: 20px;">
            </td>
       </tr>

       <tr>
            <td>Pelanggan</td>
            <td>
                <input type="hidden" id="kd_plg" />
                <div class="input-append">
                 <input type='text' class="validate[required,maxSize[20], minSize[2]] span2" 
                maxlength="20" id="_pn" id='appendedInputButton' name='_pn' style="width: 148px; margin-left: 10px;">
                <a href="#myModal" role="button" class="btn" data-toggle="modal" style="padding: 2px 3px;"><i class="icon-filter"></i></a>
                  
                </div>
            </td>
            <td>Sales</td>
            <td>
                <input type='text' class="validate[required,maxSize[20], minSize[2]],custom[onlyLetterSp]" 
                maxlength="20" id="_sl" name='_sl' style="width: 170px; margin-left: 10px;">
            </td>
        </tr>
    </table>
</form>
<div>
    
</div>
<div id="hasil2" style="height: 238px;"></div>
<div style="float: right;">
    <label style="float: left; margin-right: 10px;"><b>Total</b> </label>
    <input style="float: right; width:120px; margin-right: 145px;" id="total" name="total" type="text" readonly="true">
</div>
    <button id="save" mode="add" class="btn btn-primary" type="submit">Save</button>
    <button id="delete" class="btn">Delete</button>
    <button id="cancel" class="btn">Cancel</button>
    <button id="add" mode="new" class="btn" data-toggle="tooltip" title="Tambah Barang" onclick="addRow('tb3')"><i class="icon-plus"></i></button>
    <button id="print" class="btn" onclick="alert('Fungsi Print masih dalam pengembangan :D')" data-toggle="tooltip" title="Print SO"><i class="icon-print"></i></button>
</div>

<div id="popup-wrapper3" style="width:750px;height:400px;"></div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Pelanggan</h3>
  </div>
  <div class="modal-body">
    <div id="list_pelanggan"></div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" onclick="getPelanggan()" data-dismiss="modal" aria-hidden="true">Done</button>
  </div>
</div>

<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<br/>
<div id="hasil"></div>


<script>
    listPelanggan();
    listBarang();
    
    var filter="";
    
    //GET POPUP PELANGGAN
    function getPelanggan(){
        var x = $('input:radio[name=optionsRadios]:checked').val();
        var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
        $('#_pn').val(x);
        $('#kd_plg').val(k);
        
    }
    //GET POPUP Barang
    function getBarang(){
        var x = $('input:radio[name=optionsRadios]:checked').val();
        var y = $('input:radio[name=optionsRadios]:checked').attr('satuan');
        
        var row = filter;
        
        $('#kode_brg'+row).val(x);
        $('#satuan_brg'+row).val(y);    
    }
    
    //ALERT
    bootstrap_alert = function() {}
    bootstrap_alert.warning = function(message) {
        $('#konfirmasi').html('<div class="alert alert-error" style="position:absolute; width:52%; "><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        $(".alert").delay(5000).addClass("in").fadeOut(3000);
    }
    bootstrap_alert.success = function(message) {
        $('#konfirmasi').html('<div class="alert alert-success" style="position:absolute; width:52%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        $(".alert").delay(1500).addClass("in").fadeOut(5000);
    }
    bootstrap_alert.info = function(message) {
        $('#konfirmasi').html('<div class="alert alert-info" style="position:absolute; width:52%;"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    }

    
    //Cancel
    $("#cancel").click(function(){
        $('#formID').each(function(){
            this.reset();
        });
        autogen();
        tampilDetailSO();
        $('#save').attr('mode','add');
    });
    
    //Tambah Row Barang
    function addRow(tableID) {
        var mode = $('#add').attr("mode");

        if (mode == "new"){
            $('#tb3 tbody').empty();
        }    
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        var last = rowCount;
       
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            
            //KOLOM 1
            var cell1 = row.insertCell(0);
            var iDiv2 = document.createElement("div");
            iDiv2.className = "input-append";
            iDiv2.id="kode_brg[]";
            
            var element0 = document.createElement("input");
            element0.type = "text";
            element0.name="kode_brgd"+last;
            element0.className="validate[required]";
            element0.className="span2"; 
            element0.id="kode_brg"+last;
            element0.setAttribute("onkeypress", "validAct("+last+")");
            element0.setAttribute("disable", false);
            element0.style.width = "70px";
            
            var filter = document.createElement("a");
            filter.className="btn btn-tbl";
            filter.id="f_brg"+last;
            filter.href="#myModal2";
            filter.setAttribute("onclick", "getDetail("+last+")");
            filter.setAttribute("role", "button");
            filter.setAttribute("data-toggle", "modal");
            var iIcon3 = document.createElement("i");
            iIcon3.className = "icon-filter";
            
            filter.appendChild(iIcon3);
            iDiv2.appendChild(element0);
            iDiv2.appendChild(filter);
            cell1.appendChild(iDiv2);

            //KOLOM 2
            var cell1 = row.insertCell(1);
            var element1 = document.createElement("input");
            element1.type = "text";
            element1.name = "qty_brg";
            element1.id="qty_brg"+last;
            element1.setAttribute("onkeypress", "validAct("+last+")");
            element1.style.width = "30px";
            cell1.appendChild(element1);
            
            //KOLOM 3
            var cell2 = row.insertCell(2);
            var element2 = document.createElement("input");
            element2.type = "text";
            element2.name = "satuan_brg[]";
            element2.disabled = "true";
            element2.id="satuan_brg"+last;
            element2.style.width = "70px";
            cell2.appendChild(element2);
            
            //KOLOM 4
            var cell3 = row.insertCell(3);
            var element3 = document.createElement("input");
            element3.type = "text";
            element3.name = "harga[]";
            element3.id="harga_brg"+last;
            element0.setAttribute("onkeypress", "validAct("+last+")");
            element3.style.width = "70px";
            cell3.appendChild(element3);
            //KOLOM 5
            var cell4 = row.insertCell(4);
            var element4 = document.createElement("input");
            element4.type = "text";
            element4.name = "jumlah";
            element4.id="jumlah_brg"+last;
            element4.style.width = "70px";
            element4.disabled = "true";
            cell4.appendChild(element4);
            //KOLOM 6
            var cell5 = row.insertCell(5);
            var element5 = document.createElement("input");
            element5.type = "text";
            element5.name = "keterangan[]";
            element5.id="keterangan_brg"+last;
            element5.style.width = "80px";
            cell5.appendChild(element5);
            //KOLOM 7
            var cell6 = row.insertCell(6);
                        
            var iIcon1 = document.createElement("i");
            iIcon1.className = "icon-ok";
            iIcon1.id="icon"+last;
            var iIcon2 = document.createElement("i");
            iIcon2.className = "icon-trash";
            
            var iAnchor1 = document.createElement("a");
            iAnchor1.className = "btn";
            iAnchor1.href = "#";
            iAnchor1.setAttribute('onclick', 'editRow('+last+')')
            iAnchor1.appendChild(iIcon1);
            var iAnchor2 = document.createElement("a");
            iAnchor2.className = "btn";
            iAnchor2.setAttribute('onclick', 'deleteRowSO(this)')
            iAnchor2.href = "#";
            iAnchor2.appendChild(iIcon2);
            
            cell6.appendChild(iAnchor1);
            cell6.appendChild(iAnchor2);
        }
        
    //Save Click
    $("#save").click(function(){
    	
        var mode = $('#save').attr("mode");
        
        //deklarasi variable
        var so = $('#_so').val();
        var tglSo = $('#_tgl').val();
        var po = $('#_po').val();
        var tglPo = $('#_tgl2').val();
        var pl = $('#kd_plg').val();
        var sl = $('#_sl').val();
        var to = $('#total').val();
        
        var arrKode = new Array();
        var arrQty = new Array();
		var arrSatuan = new Array();
        var arrHarga = new Array();
        var arrJumlah = new Array();
        var arrKet = new Array();
        
        var table = document.getElementById('tb3');
        var totalRow = table.rows.length-1;
        for(var i=1;i<=totalRow;i++){
			arrKode[i-1] = $('#kode_brg'+i).val();
			arrQty[i-1] = $('#qty_brg'+i).val();
			arrSatuan[i-1] = $('#satuan_brg'+i).val();
			arrHarga[i-1] = $('#harga_brg'+i).val();
			arrJumlah[i-1] = $('#jumlah_brg'+i).val();
			arrKet[i-1] = $('#keterangan_brg'+i).val();	
		}

        if(mode == "add"){ //add mode
         	if($("#formID").validationEngine('validate'))
	        {
	            $.ajax({
	            type:'POST',
	            url: "<?php echo base_url();?>index.php/tr_do/insert",
	            data :{so:so,tglSo:tglSo,po:po,tglPo:tglPo,pl:pl,sl:sl,to:to,
	                    arrKode:arrKode, arrQty:arrQty, arrSatuan:arrSatuan, arrHarga:arrHarga, arrJumlah:arrJumlah, arrKet:arrKet,totalRow:totalRow
	            },
	
	            success:
	            function(msg)
	            {
	                if(msg == "ok")
	                {
	                    bootstrap_alert.success('<b>Sukses</b> Data sudah ditambahkan');
						$('#formID').each(function(){
							this.reset();
						});
	                    listSO();
						tampilDetailSO();
						autogen();
						$('#save').attr('mode','add');
	                }
	                else{
	                    bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data sudah ada');
	                }
	            }
	            });
	        }     
	           
        }else if(mode == "edit"){ //Edit mode
        	if($("#formID").validationEngine('validate'))
        	{
        		$.ajax({
	            type:'POST',
	            url: "<?php echo base_url();?>index.php/tr_do/update",
	            data :{so:so,tglSo:tglSo,po:po,tglPo:tglPo,pl:pl,sl:sl,to:to,
	                    arrKode:arrKode, arrQty:arrQty, arrSatuan:arrSatuan, arrHarga:arrHarga, arrJumlah:arrJumlah, arrKet:arrKet,totalRow:totalRow
	            },
	
	            success:
	            function(msg)
	            {
	                if(msg == "ok")
	                {
	                    bootstrap_alert.success('<b>Sukses</b> Update berhasil dilakukan');
                        $('#formID').each(function(){
                                this.reset();
                        });
	                    listSO();
						tampilDetailSO();
						autogen();
						$('#save').attr('mode','add');
	                }
	                else{
	                    bootstrap_alert.warning('<b>Gagal</b> Terjadi Kesalahan');
	                }
	            }
	            });
        	}
        }
    });

    $("#delete").click(function(){
        var so = $('#_so').val();

         $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/tr_do/delete",
            data :{so:so
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> Data telah dihapus');
                    $('#formID').each(function(){
                        this.reset();
                    });
                   listSO();
                   tampilDetailSO();
				   autogen();
				   $('#save').attr('mode','add');
                }
            }
            });
    });

</script>
