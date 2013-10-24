<script>
	
	function formatAngka(objek, separator) {
  a = objek.value;
  b = a.replace(/[^\d]/g,"");
  c = "";
  panjang = b.length;
  j = 0;
  for (i = panjang; i > 0; i--) {
    j = j + 1;
    if (((j % 3) == 1) && (j != 1)) {
      c = b.substr(i-1,1) + separator + c;
    } else {
      c = b.substr(i-1,1) + c;
    }
  }
  objek.value = c;
}
	
	
	//BUAT hapus titik
	function BackUang(nStr){
		var hasil='';
		a = nStr.length;
		for(i=0;i<a;i++){
			x = nStr.charAt(i);
			if(!isNaN(x)){
				hasil+=x;
			}
		}
		return hasil;
	}
	
	
	
	</script>
<div class="saw-box table  CSSTabel" style="width: 62%;height: 270px;overflow-y: overlay;">
<table id="tb5" class="saw-barang" style="width: 100%;">
<thead>
	<tr>
        <th rowspan="2" align="center" style="vertical-align: middle; border-right: 1px solid;">Gudang</th>
        <th colspan="2" align="center" style="border-right: 1px solid;">Saldo Awal</th>
        <th colspan="2" align="center" >Stock Akhir</th>
    </tr>
	<tr>
		<th style="border-right: 1px solid;">Tanggal</th>
		<th style="border-right: 1px solid;">Qty</th>
		<th style="border-right: 1px solid;">Gudang</th>
		<th>Penjualan</th>
	</tr> 
</thead>

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
		<td><input type='text' id='qty$i' name='qty$i' style='width: 60px; text-align: right;'   onkeyup=\"formatAngka(this,'.')\" ></td>
		<td><input disabled='disabled' value='$gudang' type='text' id='_kd' name='kd' style='width: 60px;'></td>
		<td><input disabled='disabled' value='$jual' type='text' id='_kd' name='kd' style='width: 60px;'></td>
	</tr>";
	$i++;}
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
	
	