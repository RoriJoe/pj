<div class=" table  CSSTabel" style="overflow: auto; height: 220px">
<table id="tb3">
    <thead>
        <th>No Rekening</th>
        <th>Atas Nama</th>
        <th>Tipe</th>
        <th>Cabang</th>
        <th>No Perkiraan</th>
        <th>Action</th>
    </thead>
    
    <tr id="new">
        <td><input type="text" name="itemcode" id="itemcode" style='width:70px' maxlength="20" onkeydown="disableAlpha('itemcode')" /></td>
        <td><input type="text" name="itemname" id="itemname" style='width:120px' maxlength="50" onkeydown="disableNum('itemname')"/></td>
        <td><input type="text" name="itemprice" id="itemprice" style='width:70px' maxlength="25"/></td>
        <td><input type="text" name="itemqty" id="itemqty" style='width:70px' maxlength="25"/></td>
        <td><input type="text" name="itemper" id="itemper" style='width:70px' maxlength="10" onkeydown="disableAlpha('itemper')"/></td>
        <td><a class='btn btn-small' id="add_item" onclick='addRow()'><i id='icon$i' class='icon-plus'></i></a></td>
    </tr>

    <tbody id="itemlist">
    <?php
    $i=1;
    foreach($hasil as $row)
    {
        echo "
            <tr>
                <td><input type='hidden' name='item[code][]' value='$row->no_rekening' style='width:70px'/>$row->no_rekening</td>
                <td>$row->atas_nama</td>
                <td><input type='text' name='item[price][]' value='$row->tipe' style='width:70px' readonly='true'/></td>
                <td><input type='text' name='item[qty][]' value='$row->cabang' style='width:70px' readonly='true'/></td>
                <td><input type='text' name='item[per][]' value='$row->no_perkiraan' style='width:70px' readonly='true'/></td>
                <td><a href='javascript:void(0);' id='hapus'></a></td>
            </tr>
        ";
        $i++;
    } ?>
    </tbody>
</table>
</div>

<script type="text/javascript">
    function clear (){
        $("#itemcode").val("");
        $("#itemname").val("");
        $("#itemprice").val("");
        $("#itemqty").val("");
        $("#itemper").val("");
    }

$("tbody#itemlist").on("click","#hapus",function(){
    $(this).parent().parent().remove();
});

$("#itemcode").keypress(function(e){
var userVal = $("#itemcode").val();
if(userVal.length == 20){
   bootstrap_alert.info('Maksimum Kode 20');
} 
});

$("#itemper").keypress(function(e){
var userVal = $("#itemper").val();
if(userVal.length == 25){
   bootstrap_alert.info('Maksimum Karakter 30');
} 
});



function addRow() {
    var itemcode = $("#itemcode").val();
    var itemname = $("#itemname").val();
    var itemprice = $("#itemprice").val();
    var itemqty = $("#itemqty").val();
    var itemper = $("#itemper").val();

    var items = "";
    if(itemcode != "" && itemname != "" && itemprice!="" && itemqty !="" && itemper !="")
    {
        $count = $("tbody#itemlist tr").length+1;

        items += "<tr>";
        items += "<td width='50px'><input type='hidden' id='no_rekening"+$count+"' name='item[code][]' value='"+ itemcode +"' style='width:70px'/>"+itemcode+"</td>";
        items += "<td width='50px'><input type='hidden' id='atas_nama"+$count+"' name='item[name][]' value='"+ itemname +"' style='width:70px'/>"+itemname+"</td>";
        items += "<td><input type='text' class='span2' id='tipe"+$count+"' name='item[price][]' value='"+ itemprice +"' style='width:90px'/></td>";
        items += "<td><input type='text' class='span2' id='cabang"+$count+"' name='item[qty][]' value='"+ itemqty +"' style='width:90px'/></td>";
        items += "<td><input type='text' class='span2' id='no_perkiraan"+$count+"' name='item[per][]' value='"+ itemper +"' style='width:90px'/></td>";
        items += "<td><a href='javascript:void(0);' id='hapus'><i id='icon$i' class='icon-trash'></i></a></td></tr>";
    
        if ($("tbody#itemlist tr").length == 0)
        {
            $("#itemlist").append(items);
            clear();
        }else{
            var callback = checkList(itemcode);
            if(callback === true){
                $("#itemlist").append(items);
                clear();
                 bootstrap_alert.warning('Field Harus diisi Semua!');
            }
        }
    }
    else
    {
        bootstrap_alert.warning('Field Harus diisi Semua!');
    }
}

function checkList(val){
    var cb = true;
    $("#itemlist tr").each(function(index){
        var input = $(this).find("input[type='hidden']:first");
        if (input.val() == $(itemcode).val()){
            cb = false;
            bootstrap_alert.info('Rekening Sudah Ada');
        }
    });
    return cb;
}

</script>