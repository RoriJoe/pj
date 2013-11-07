<form id="formID">
    <div class="field-wrap">
        Kode
        <input type='text' class="validate[required,maxSize[20], minSize[5]],custom[onlyLetterNumber]" maxlength="20" id='_kd' name='kd' style="width: 120px; margin-left: 10px; margin-right: 20px; text-transform: uppercase;">
    </div>
    <div class="field-wrap">
        Nama
        <input type='text' class="validate[required,maxSize[25], minSize[2]]]" maxlength="25" id='_nama1' name='nama1' style="width: 170px; margin-right: 20px;">
    </div>
    <br/>
    <div class="field-wrap">
        Ukuran
        <input type='text' class="validate[required,maxSize[25], minSize[4]]" maxlength="25" id='_uk' name='uk' style="width: 120px;margin-right: 20px;">
    </div>
    <div class="field-wrap">
        Keterangan
        <input type='text' class="validate[required,maxSize[20]]" id='_ket' name='ket' style="width: 138px; margin-right: 20px;">
    </div>
    <br/>
    <div class="field-wrap">
        Harga Beli
        <div class="input-prepend input-append money">
          <span class="add-on custom-add-on">Rp</span>
          <input class="span2" id='hb' id="appendedPrependedInput" type='text' class="validate[required]" maxlength="15" name='hb' style="width: 120px; text-align:right;" onkeyup="formatAngka(this,'.')" >
        </div>
    </div>
    <div class="field-wrap">
        Harga Jual
        <div class="input-prepend input-append money">
          <span class="add-on custom-add-on">Rp</span>
          <input class="span2" id='hj' id="appendedPrependedInput" type='text' class="validate[required]" maxlength="15" name='hj' style="width: 120px;text-align:right;" onkeyup="formatAngka(this,'.')" >
        </div>
    </div>
    <br/>
    <div class="field-wrap">
        Persediaan
        <input class="span2 validate[required,custom[number]]" readonly="true" id='_ps' name='ps' style="width: 70px;" type="text" value="0">
    </div>
    <div class="field-wrap">
        Tgl Persediaan
        <input  type='text' 
            class="" id='_tgl1' name='_tgl1' 
            style="width: 80px;" readonly="true">
    </div>
    <div class="field-wrap">
        <div class="input-append money">
            <select name="st" class="validate[required]" id="_st" id="appendedInput" style="margin-left: 10px;margin-bottom: 8px;">
            <?php
            foreach ($list_satuan as $isi)
            {
                echo "<option ";
                echo "value = '".$isi->Kode_satuan."'>".$isi->Kode_satuan."</option>";
            }
            ?>
            </select>
            <a id="tes" class="add-on btn btn-mini" tittle="Tambah Satuan"
                data-toggle="button" style="margin-bottom:8px;"
                data-html="true" data-placement="bottom"
                rel="popover"
                data-content="
                <div>
                 <input  type='text' 
                    class='span2' id='txtCombo' id='appendedInput' name='txtCombo' 
                    style='width: 130px;margin-left: 10px;margin-bottom: 0;'
                    />
                <button class='btn btn-primary' onclick='addCombo()' style='margin-left:10px;'>Tambah</button>
                </div>"><i class='icon-plus'></i>
            </a>
        </div>
    </div>
    <br/>
    <div class="field-wrap action-group">
        <button id="save" class="btn btn-primary" type="submit" mode="add">Save</button>
        <button id="cac" class="btn" type="reset">Cancel</button>
        <button id="print" class="btn"  data-toggle="tooltip" title="Cetak Daftar Barang"><i class="icon-print"></i> Print</button>
    </div>

</form>
<!--**NOTIFICATION AREA**-->
<div id="konfirmasi2" class="sukses"></div>