<div class="scroller_anchor"></div>
<div class="side-scroll">
    <div style="width: 100%; margin-bottom: 5px; margin-top: 10px">
        <img src="<?php echo base_url();?>assets/img/user.png" id="pp" class="img-polaroid"/>
    </div>
<div class="sidebar">
    <div style="background-color: #B4B4B4;height: 20px;width: 15px;">
        <a href="#" id="red"><i class="icon-resize-vertical"></i></a>
    </div>
    <span id="titleA">APPLICATION LIST</span>
    <ul id="accordion">
        <li><a class = "ajax" href="home"><i class="icon-home"></i>&nbsp;Home</a>
        </li>
        <li><a class=""><i class="icon-th-large"></i>&nbsp;Master</a>
            <ul>
                <li><a class = "ajax" href="ms_barang">Barang</a></li>
                <li><a class = "ajax" href="ms_pelanggan">Pelanggan</a></li>
                <li><a class = "ajax" href="ms_supplier">Supplier</a></li>
                <li><a class = "ajax" href="ms_gudang">Gudang</a></li>
            </ul>
        </li>
        <li><a class=""><i class="icon-shopping-cart"></i>&nbsp;Transaksi</a>
            <ul>
                <li><a class = ""><i class="icon-chevron-right"></i>&nbsp;Pembelian</a>
                    <ul>
                        <li><a class = "ajax" href="tr_pemesanan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemesanan / PO</a></li>
                        <li><a class = "ajax" href="tr_penerimaan_barang">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penerimaan Barang</a></li>
                    </ul>
                </li>
                <li><a class = ""><i class="icon-chevron-right"></i>&nbsp;Penjualan</a>
                   <ul>
                        <li><a class = "ajax" href="tr_do">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sales Order</a></li>
                        <li><a class = "ajax" href="tr_surat_jalan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surat Jalan</a></li>
                        <li><a class = "ajax" href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invoice</a></li>
                   </ul>
                </li>
            </ul>
        </li>
        <li><a href="#"><i class="icon-book"></i>&nbsp; Laporan</a>
            <ul>
              <li><a class="ajax" href="report_do">Delivery Order</a></li>
              <li><a class="ajax" href="report_sj">Surat Jalan</a></li>
              <li><a class="ajax" href="report_mutasi">Mutasi</a></li>
              <li><a class="ajax" href="report_os">Outstanding</a></li>
              <li><a class="ajax" href="report_penerimaan">Penerimaan</a></li>
              <li><a class="ajax" href="report_ks">Kartu Stock</a></li>
            </ul>
        </li>
        <li><a href="#"><i class="icon-wrench"></i>&nbsp;Maintenance</a>
            <ul>
              <li><a href="#">Create Saldo Awal</a></li>
              <li><a href="#">Create Password</a></li>
              <li><a href="#">Stock</a></li>
            </ul>
        </li>
        <li><a href="logout"><i class="icon-off"></i>&nbsp;Logout</a></li>
    </ul>
</div>
</div>


<script>

function loadPhp(){
    //set a variable for the php function
    //var func = '<?php set_breadcrumb();?>'
    //append the php function results to a div using jquery
    //$('#breadcrumb').html("testing");
    //var div = document.getElementById('breadcrumb');
    //div.innerHTML = div.innerHTML + func;
}

var toggle = true;
$("div.sidebar").css("top", "0px");
$('#red').click(function() {
    if (toggle === true) {
        $("div.sidebar").css("z-index", "3");
        $("div.sidebar").animate({
            "top": "-=162px"
        }, "slow");
        toggle = false;
    }
    else {
        $("div.sidebar").animate({
            "top": "+=162px"
        }, "slow");
        toggle = true;
    }
});
</script>
<!--End Of Side Menu-->

