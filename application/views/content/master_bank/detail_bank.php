<div class=" table  CSSTabel" style="overflow: auto; height: 220px">
<table id="tb3">
    <thead>
        <th>No Rekening</th>
        <th>Atas Nama</th>
        <th>Jenis</th>
        <th>Cabang</th>
        <th>No Perkiraan</th>
        <th>Action</th>
    </thead>

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
        $("#_no_rek").val("");
        $("#_an").val("");
        $("#_tipe").val("");
        $("#_cab").val("");
        $("#_no_perk").val("");
    }

$("tbody#itemlist").on("click","#hapus",function(){
    $(this).parent().parent().remove();
});

$("#_no_rek").keypress(function(e){
var userVal = $("#_no_rek").val();
if(userVal.length == 20){
   bootstrap_alert.info2('Maksimum Kode 20');
} 
});

$("#_an").keypress(function(e){
   var userVal = $("#_an").val();
   if(userVal.length == 50){
       bootstrap_alert.info2('Maksimum 50 Karakter');
   } 
});
$("#_cab").keypress(function(e){
   var userVal = $("#_cab").val();
   if(userVal.length == 25){
       bootstrap_alert.info2('Maksimum 25 Karakter');
   } 
});
$("#_no_perk").keypress(function(e){
   var userVal = $("#_no_perk").val();
   if(userVal.length == 10){
       bootstrap_alert.info2('Maksimum 10 Karakter');
   } 
});
function addRow() {

    var itemcode = $("#_no_rek").val();
    var itemname = $("#_an").val();
    var itemprice = $("#_tipe").val();
    var itemqty = $("#_cab").val();
    var itemper = $("#_no_perk").val();

    var items = "";
    if(itemcode != "" && itemname != "" && itemprice!="" && itemqty !="" && itemper !="")
    {
        $count = $("tbody#itemlist tr").length+1;

        items += "<tr>";
        items += "<td width='100px'><input type='hidden' id='no_rekening"+$count+"' name='item[code][]' value='"+ itemcode +"' style='width:70px'/>"+itemcode+"</td>";
        items += "<td width='100px'><input type='hidden' id='atas_nama"+$count+"' name='item[name][]' value='"+ itemname +"' style='width:70px'/>"+itemname+"</td>";
        items += "<td><input type='hidden' class='span2' id='tipe"+$count+"' name='item[price][]' value='"+ itemprice +"' style='width:90px'/>"+itemprice+"</td>";
        items += "<td><input type='text' class='span2' id='cabang"+$count+"' name='item[qty][]' value='"+ itemqty +"' style='width:90px'/></td>";
        items += "<td><input type='text' class='span2' id='no_perkiraan"+$count+"' name='item[per][]' value='"+ itemper +"' style='width:90px'/></td>";
        items += "<td><a href='javascript:void(0);' id='hapus'><i id='icon$i' class='icon-trash'></i></a></td></tr>";
    
        if ($("tbody#itemlist tr").length == 0)
        {
            $("#itemlist").append(items);
            clear();
            $('#myModal').modal('hide');
        }else{

            var callback = checkList(itemcode);
            if(callback === true){
                $("#itemlist").append(items);
                clear();
                $('#myModal').modal('hide');
            }
        }
    }
    else
    {
        bootstrap_alert.info2('No rekening, Nama, Cabang, & Tipe Harus diisi');
    }
}

function checkList(val){
    var cb = true;
    $("#itemlist tr").each(function(index){
        var input = $(this).find("input[type='hidden']:first");
        if (input.val() == val){
            cb = false;
            bootstrap_alert.info('Rekening Sudah Ada');
        }
    });
    return cb;
}

</script>