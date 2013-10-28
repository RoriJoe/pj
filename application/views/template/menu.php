<?php 
    $image = $this->session->userdata("image");
 ?>
    <div class="side-scroll">
        <div style="width: 100%; margin-bottom: 5px; margin-top: 10px">
            <img src="<?php echo base_url();?>images/<?php echo $image ?>" id="pp" class="img-polaroid"/>
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
                    <li><a class = "ajax" href="ms_gudang">Gudang</a></li>
                    <li><a class = "ajax" href="ms_pelanggan">Pelanggan</a></li>
                    <li><a class = "ajax" href="ms_supplier">Supplier</a></li>
                    <li><a class = "ajax" href="ms_bank">Bank</a></li> 
                    <li><a class = "">Persediaan <i class="icon-chevron-right"></i></a>
                        <ul>
                            <li><a class = "ajax" href="ms_barang">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Barang</a></li>
                            <li class="menu-border-bottom"><a class = "ajax" href="ms_satuan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Satuan</a></li>
                        </ul>
                    </li>                   
                </ul>
            </li>
            <li><a class=""><i class="icon-shopping-cart"></i>&nbsp;Transaksi</a>
                <ul>
                    <li><a class = ""><i class="icon-chevron-right"></i>&nbsp;Penjualan</a>
                       <ul>
                            <li class="menu-border-bottom"><a class = "ajax" href="tr_do">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sales Order</a></li>
                       </ul>
                    </li>
                    <li><a class = ""><i class="icon-chevron-right"></i>&nbsp;Pembelian</a>
                        <ul>
                            <li class="menu-border-bottom"><a class = "ajax" href="tr_pemesanan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemesanan / PO</a></li>
                        </ul>
                    </li>
                    <li><a class = ""><i class="icon-chevron-right"></i>&nbsp;Persediaan</a>
                        <ul>
                            <li><a class = "ajax" href="tr_surat_jalan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surat Jalan</a></li>
                            <li class="menu-border-bottom"><a class = "ajax" href="tr_penerimaan_barang">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penerimaan Barang</a></li>
                        </ul>
                    </li>
                    <li><a class = ""><i class="icon-chevron-right"></i>&nbsp;Keuangan</a>
                        <ul>
                            <li><a class = "ajax" href="tr_invoice">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invoice</a></li>
                            <li class="menu-border-bottom"><a class = "ajax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terima Pembayaran</a></li>
                        </ul>
                    </li>
                    <li><a class = ""><i class="icon-chevron-right"></i>&nbsp;Akuntansi</a>
                        <ul>
                            <li><a class = "head-ul">Jurnal</a></li>
                            <li><a class = "ajax" href="">&nbsp;&nbsp;&nbsp;&nbsp;Cetak Transaksi Jurnal</a></li>
                            <li><a class = "ajax" href="">&nbsp;&nbsp;&nbsp;&nbsp;Cetak Buku Besar</a></li>
                            <li><a class = "ajax" href="">&nbsp;&nbsp;&nbsp;&nbsp;Cetak Rugi Laba</a></li>
                            <li class="menu-border-bottom"><a class = "ul-divider ajax" href="">&nbsp;&nbsp;&nbsp;&nbsp;Cetak Neraca</a></li>
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
                  <li class="menu-border-bottom"><a class="ajax" href="report_ks">Kartu Stock</a></li>
                </ul>
            </li>
        <?php
            if($this->session->userdata('level') == 1): ?>
            <li><a href="#"><i class="icon-wrench"></i>&nbsp;Maintenance</a>
                <ul>
                  <li><a class="ajax" href="saw">Create Saldo Awal</a></li>
                  <li><a class="ajax" href="user">Create Password</a></li>
                  <li><a class="ajax" href="#">Stock</a></li>
                </ul>
            </li>
        <?php endif; ?>
            
            <li><a href="logout"><i class="icon-off"></i>&nbsp;Logout</a></li>
        </ul>
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

