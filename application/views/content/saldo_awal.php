<div class=" table  CSSTabel" style="width: 600px">
<table id="tb1" style="width: 100%;">
        <tr>
            <th rowspan="2" align="center">Gudang</th>
            <th colspan="2" align="center">Saldo Awal</th>
            <th colspan="2" align="center">Stock Akhir</th>
        </tr>
	<tr>
		<th>Tanggal</th>
		<th>Qty</th>
		<th>Gudang</th>
		<th>Penjualan</th>
	</tr> 
	<?php $i=1;$d=date("Y/m/d");
	$d1 = date("d-m-Y", strtotime($d));
	foreach($hasil as $row){
	$terima=$row->terima;
	$sj = $row->sj;
	$so= $row->so;
	$gudang = $terima-$sj;
	$jual=$terima+$so;
	echo"
	<tr>
		<td><input disabled='disabled' type='text' id='gudang$i' name='gudang$i' value='$row->Nama' style='width: 120px;'></td>
		<td><input type='text' id='tgl$i' name='tgl$i' value='$d1' style='width: 75px; '></td>
		<td><input type='text' id='qty$i' name='qty$i' style='width: 60px; ' onkeypress='validAct($i)' ></td>
		<td><input disabled='disabled' value='$gudang' type='text' id='_kd' name='kd' style='width: 60px;'></td>
		<td><input disabled='disabled' value='$jual' type='text' id='_kd' name='kd' style='width: 60px;'></td>
	</tr>";
	}$i++;
	?>
        <!--<tbody>
        <?php /* foreach($hasil as $row)
        {
            echo
            "<tr>
                <td>$row->No_Sj</td>
                <td>$row->No_Do</td>
                <td>$row->Perusahaan</td>
            </tr>";
        } */ ?>
        </tbody> -->
    </table>
	</div>
	
	<script>
	function validAct(row){
    
    
    //disable alfabet di qty
    var foo = document.getElementById('qty'+row);
    foo.addEventListener('input', function (prev) {
        return function (evt) {
            if (!/^\d{0,6}(?:\.\d{0,2})?$/.test(this.value)) {
              this.value = prev;
            }
            else {
              prev = this.value;
            }
        };
    }(foo.value), false);
}
	</script>