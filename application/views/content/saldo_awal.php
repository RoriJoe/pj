<script>
	
	/* function ToUang(nStr) { 
	nStr += ''; x = nStr.split('.'); x1 = x[0]; x2 = x.length > 1 ? '.' + x[1] : ''; 
	var rgx = /(\d+)(\d{3})/; while (rgx.test(x1)) { x1 = x1.replace(rgx, '$1' + '.' + '$2'); } 
	return x1 + x2; }  */
	
	function AddDot(Num){
		Num += '';
		Num = Num.replace(/\./g, '');
		
		x=Num.split('.');
		x1=x[0];
		x2=x.length >1 ?',' + x[1] : '';
		var rgx =/(\d+)(\d{3})/;
		while (rgx.test(x1))
		{
		x1=x1.replace(rgx,'$1'+'.'+'$2');
		}
		return x1+x2;
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
	
	function ubah(a){
	
		var harga = a;
		harga = AddDot(harga);
		return harga;
	}
	
	function validAct(row){
    
    
    //disable alfabet di qty
    var foo = document.getElementById('qty'+row);
	
    foo.addEventListener('input', function (prev) {
        return function (evt) {
		
            if (!/^\d{0,9}(?:\.\d{0,2})?$/.test(this.value)) {
              this.value = prev;
			  
            }
            else {
             prev = this.value;
			  
            }
        };
    }(foo.value), false);
	
	
	
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
		<td><input type='text' id='qty$i' name='qty$i' style='width: 60px; text-align: right;'   onkeyup='this.value=ubah(this.value);' onkeydown='validAct($i)'></td>
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
	
	