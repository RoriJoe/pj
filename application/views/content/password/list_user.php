<div class="table CSSTabel table-fluid table-hover">
    <table id="tb1">
        <thead>
            <th>Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Last Login</th>
        </thead>

        <tbody>
        <?php foreach($hasil as $row)
        {
            echo
            "<tr
                id=$row->username
                names=$row->Nama
                password=$row->password
                level=$row->Level
                image=$row->image
            >
                <td>$row->username</td>
                <td>$row->Nama</td>
                <td>$row->Level</td>
                <td>$row->Last_Login</td>
            </tr>";
        } ?>
        </tbody>
    </table>
</div>

<script>
$('#tb1 tr').click(function (e) {
    $('#delete').attr('disabled', false);
    $("#users").attr('disabled',true);
    
    $('#users').val($(this).attr("id"));
    $('#users2').val($(this).attr("id"));
    $('#namas').val($(this).attr("names"));
    $('#password').val($(this).attr("password"));
    document.getElementById("profile").src="../images/"+$(this).attr("image");
    
    function setSelectedIndex(s, valsearch)
    {
    // Loop through all the items in drop down list
    for (i = 0; i< s.options.length; i++)
    { 
        if (s.options[i].value == valsearch)
        {
            // Item is found. Set its property and exit
            s.options[i].selected = true;
            break;
        }
    }
    return;
    }
    setSelectedIndex(document.getElementById("lev"),$(this).attr("level"));
    document.getElementById('up').style.visibility = 'visible';


    $('#save').attr('mode','edit');
    $('#cancel').attr('disabled',false);
});

var oTable = $('#tb1').dataTable( {
    "sScrollY": "290px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": false,
    "aaSorting": [[ 4, "desc" ]],
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>