<div style="height: 122px;">
<table class="table">
    <thead>
        <th>Priority</th><th>Title</th><th>Description</th><th>Post By</th>
    </thead>
    <tbody>
    <?php
    foreach($hasil as $row)
    {
        $a = "";
        if($row->priority == 1){
            $a = "<span class='label label-info' style='width: auto;'>Low</span>";
        }else if($row->priority == 2){
            $a = "<span class='label label-warning' style='width: auto;'>Medium</span>";
        }else if($row->priority == 3){
            $a = "<span class='label label-important' style='width: auto;'>Risk</span>";
        }else{
            $a = "<span class='label label-success' style='width: auto;'>Fixed</span>";
        }
        echo "<tr>
        <td width='10%'>$a</td>
        <td width='30%'>$row->title</td>
        <td width='40%'>$row->desc</td>
        <td width='20%'>$row->email</td>
        </tr>
        ";
    }   ?>
    </tbody>
</table>
</div>