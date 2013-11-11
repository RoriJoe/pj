<?php 
    $image = $this->session->userdata("image");
 ?>
    <div class="side-scroll">
        <div style="width: 100%; margin-bottom: 5px; margin-top: 10px; text-align: center;">
            <img src="<?php echo base_url();?>images/<?php echo $image ?>" id="pp" class="img-rounded"/>
        </div>
    <div class="sidebar">
        <div style="background-color: #B4B4B4;height: 20px;width: 15px;">
            <a href="#" id="red" title="Slide Up / Down"><i class="icon-resize-vertical"></i></a>
        </div>
        <span id="titleA">APPLICATION LIST</span>

        <div class="dropdown clearfix">
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px;">
            <li><a class = "ajax" href="home"><i class="icon-home"></i>Home</a></li>

            <li class="dropdown-submenu">
                <a tabindex="-1"><i class="icon-th-large"></i>Master</a>
                <ul class="dropdown-menu">
                    <li><a class = "ajax" href="ms_gudang">Gudang</a></li>
                    <li><a class = "ajax" href="ms_pelanggan">Pelanggan</a></li>
                    <li><a class = "ajax" href="ms_supplier">Supplier</a></li>
                    <li><a class = "ajax" href="ms_bank">Bank</a></li> 
                    <li><a class = "ajax" href="ms_perkiraan">Perkiraan</a></li> 
                    <li class="dropdown-submenu">
                        <a tabindex="-1">Persediaan</a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" class = "ajax" href="ms_barang">Barang</a></li>
                            <li class="menu-border-bottom"><a class = "ajax" href="ms_satuan">Satuan</a></li>
                        </ul>
                    </li>                   
                </ul>
            </li>

            <li class="dropdown-submenu">
                <a tabindex="-1"><i class="icon-shopping-cart"></i>Transaksi</a>
                <ul class="dropdown-menu" style=" top: -23px; ">
                    <li class="dropdown-submenu"><a tabindex="-1">Penjualan</a>
                       <ul class="dropdown-menu">
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax" href="tr_do">Sales Order</a></li>
                       </ul>
                    </li>
                    <li class="dropdown-submenu"><a tabindex="-1">Pembelian</a>
                        <ul class="dropdown-menu">
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax" href="tr_pemesanan">Pemesanan / PO</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu"><a tabindex="-1">Persediaan</a>
                        <ul class="dropdown-menu">
                            <li><a class = "ajax" href="tr_surat_jalan">Surat Jalan</a></li>
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax" href="tr_penerimaan_barang">Penerimaan Barang</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu"><a tabindex="-1">Keuangan</a>
                        <ul class="dropdown-menu">
                            <li><a class = "ajax" href="tr_invoice">Invoice</a></li>
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax" href="tr_terima_bayar">Terima Tagihan</a></li>
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax">Pembayaran</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu"><a tabindex="-1">Akuntansi</a>
                        <ul class="dropdown-menu" style=" top: -110px; ">
                            <li><label tabindex="-1" class = "head-ul" style=" font-weight: bold; text-align: center; ">Jurnal</label></li>
                            <li><a class = "ajax" href="">Cetak Transaksi Jurnal</a></li>
                            <li><a class = "ajax" href="">Cetak Buku Besar</a></li>
                            <li><a class = "ajax" href="">Cetak Rugi Laba</a></li>
                            <li class="menu-border-bottom"><a class = "ul-divider ajax" href="">Cetak Neraca</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="dropdown-submenu">
                <a tabindex="-1" href="#"><i class="icon-book"></i> Laporan</a>
                <ul class="dropdown-menu" style=" top: -80px; ">
                  <li><a class="ajax" href="report_do">Delivery Order</a></li>
                  <li><a class="ajax" href="report_sj">Surat Jalan</a></li>
                  <li><a class="ajax" href="report_mutasi">Mutasi</a></li>
                  <li><a class="ajax" href="report_os">Outstanding</a></li>
                  <li><a class="ajax" href="report_penerimaan">Penerimaan</a></li>
                  <li class="menu-border-bottom"><a class="ajax" href="report_ks">Kartu Stock</a></li>
                </ul>
            </li>
        <?php
            if($this->session->userdata('level') == 1): ?>
            <li class="dropdown-submenu"><a tabindex="-1" href="#"><i class="icon-wrench"></i>Maintenance</a>
                <ul class="dropdown-menu" style=" top: -22px; ">
                  <li><a class="ajax" href="saw">Stock Opname</a></li>
                  <li><a class="ajax" href="user">Create Password</a></li>
                </ul>
            </li>
        <?php endif; ?>
            <li><a href="logout"><i class="icon-off"></i>Logout</a></li>
          </ul>
        </div>
    </div>

    <script>
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
</div>

