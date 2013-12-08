    <div class="side-scroll">
        <div style="width: 100%; margin-bottom: 5px; margin-top: 10px; text-align: center;">
            <?php if($account->picture == null): ?>
                <img src="<?php echo base_url();?>resource/img/default-person.png" id="pp" class="img-rounded"/>
            <?php else: ?>
                <img src="<?php echo base_url();?>resource/user/profile/<?php echo $account->picture; ?>" id="pp" class="img-rounded"/>
            <?php endif; ?>
        </div>
    <div class="sidebar">
        <div style="background-color: #B4B4B4;height: 20px;width: 15px;">
            <a href="#" id="red" title="Slide Up / Down"><i class="icon-resize-vertical"></i></a>
        </div>
        <span id="titleA">APPLICATION LIST</span>

        <div class="dropdown clearfix">
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px;">
            <li><a class = "" href="home"><i class="icon-home"></i>Home</a></li>
            
            <?php if ($this->authorization->is_permitted( array('access_gudang', 'access_pelanggan', 'access_supplier', 'access_bank', 'access_barang', 'access_perkiraan', 'access_satuan') )) : ?>
            <li class="dropdown-submenu">
                <a tabindex="-1"><i class="icon-th-large"></i>Master</a>
                <ul class="dropdown-menu">
                    <?php if ($this->authorization->is_permitted('access_gudang')) : ?>
                        <li><a class = "ajax" href="ms_gudang">Gudang</a></li>
                    <?php endif; ?>
                    <?php if ($this->authorization->is_permitted('access_pelanggan')) : ?>
                        <li><a class = "ajax" href="ms_pelanggan">Pelanggan</a></li>
                    <?php endif; ?>
                    <?php if ($this->authorization->is_permitted('access_supplier')) : ?>
                    <li><a class = "ajax" href="ms_supplier">Supplier</a></li>
                    <?php endif; ?>
                    <?php if ($this->authorization->is_permitted('access_bank')) : ?>
                    <li><a class = "ajax" href="ms_bank">Bank</a></li> 
                    <?php endif; ?>
                    <?php if ($this->authorization->is_permitted('access_perkiraan')) : ?>
                    <li><a class = "ajax" href="ms_perkiraan">Perkiraan</a></li> 
                    <?php endif; ?>
                    <?php if ($this->authorization->is_permitted(array('access_barang','access_satuan'))) : ?>
                    <li class="dropdown-submenu">
                        <a tabindex="-1">Persediaan</a>
                        <ul class="dropdown-menu">
                            <?php if ($this->authorization->is_permitted('access_barang')) : ?>
                                <li><a tabindex="-1" class = "ajax" href="ms_barang">Barang</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_satuan')) : ?>
                                <li class="menu-border-bottom"><a class = "ajax" href="ms_satuan">Satuan</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>                   
                </ul>
            </li>
            <?php endif; ?>
            
            <?php if ($this->authorization->is_permitted( array('access_so', 'access_po','access_surat_jalan', 'access_penerimaan', 'access_invoice', 'access_tagihan', 'access_bayar') )) : ?>
            <li class="dropdown-submenu">
                <a tabindex="-1"><i class="icon-shopping-cart"></i>Transaksi</a>
                <ul class="dropdown-menu" style=" top: -23px; ">
                    <?php if ($this->authorization->is_permitted('access_so')) : ?>
                    <li class="dropdown-submenu"><a tabindex="-1">Penjualan</a>
                       <ul class="dropdown-menu">
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax" href="tr_do">Sales Order</a></li>
                       </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->authorization->is_permitted('access_po')) : ?>
                    <li class="dropdown-submenu"><a tabindex="-1">Pembelian</a>
                        <ul class="dropdown-menu">
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax" href="tr_pemesanan">Pemesanan / PO</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->authorization->is_permitted(array('access_surat_jalan','access_penerimaan'))) : ?>
                    <li class="dropdown-submenu"><a tabindex="-1">Persediaan</a>
                        <ul class="dropdown-menu">
                            <?php if ($this->authorization->is_permitted('access_surat_jalan')) : ?>
                            <li><a class = "ajax" href="tr_surat_jalan">Surat Jalan</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_penerimaan')) : ?>
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax" href="tr_penerimaan_barang">Penerimaan Barang</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->authorization->is_permitted(array('access_invoice','access_tagihan','access_bayar'))) : ?>
                    <li class="dropdown-submenu"><a tabindex="-1">Keuangan</a>
                        <ul class="dropdown-menu">
                            <?php if ($this->authorization->is_permitted('access_invoice')) : ?>
                            <li><a class = "ajax" href="tr_invoice">Invoice</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_tagihan')) : ?>
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax" href="tr_terima_bayar">Terima Tagihan</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_bayar')) : ?>
                            <li class="menu-border-bottom"><a tabindex="-1" class = "ajax" href="tr_pembayaran">Pembayaran</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <li class="dropdown-submenu"><a tabindex="-1">Akuntansi</a>
                        <ul class="dropdown-menu" style=" top: -330px; ">
                            <li><label tabindex="-1" class = "head-ul" style=" font-weight: bold; text-align: center; ">Akuntansi & Keuangan</label></li>
                            <li><a class = "" href="setting_neraca">Setting Neraca</a></li>
                            <li><a class = "" href="setting_laba_rugi">Setting Laba Rugi</a></li>
                            <li><a class = "" href="mappingperkiraan">Mapping Perkiraan</a></li>
                            <li><a class = "" href="settingmapping">Setting Mapping</a></li>
                            <li class="menu-border-bottom"><a class = "ul-divider " href="tutuptahun">Tutup Tahun</a></li>

                            <li><label tabindex="-1" class = "head-ul" style=" font-weight: bold; text-align: center; ">Akuntansi</label></li>
                            <li class="menu-border-bottom"><a class = "ul-divider " href="<?php echo base_url(); ?>akun/jurnal">Jurnal</a></li>

                            <li><label tabindex="-1" class = "head-ul" style=" font-weight: bold; text-align: center; ">Cetak</label></li>
                            <li><a class = "" href="<?php echo base_url(); ?>akun/cetakjurnal">Transaksi Jurnal</a></li>
                            <li><a class = "" href="<?php echo base_url(); ?>akun/cetakbukubesar">Buku Besar</a></li>
                            <li><a class = "" href="<?php echo base_url(); ?>akun/cetaklabarugi">Rugi Laba</a></li>
                            <li class="menu-border-bottom"><a class = "ul-divider " href="<?php echo base_url(); ?>akun/cetakneraca">Neraca</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            
            <?php if ($this->authorization->is_permitted( array('access_report_sales', 'access_report_oso','access_report_purchase', 'access_report_ospo', 'access_report_mutasi', 'access_report_ks', 'access_report_terima', 'access_report_sj') )) : ?>
            <li class="dropdown-submenu">
                <a tabindex="-1" href="#"><i class="icon-book"></i> Laporan</a>
                <ul class="dropdown-menu" style="">

                    <?php if ($this->authorization->is_permitted(array('access_report_sales','access_report_oso'))) : ?>
                    <li class="dropdown-submenu"><a tabindex="-1">Penjualan</a>
                       <ul class="dropdown-menu">
                            <?php if ($this->authorization->is_permitted('access_report_sales')) : ?>
                                <li><a class="ajax" href="report_do">Sales Order</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_report_oso')) : ?>
                                <li><a class="ajax" href="report_os">Outstanding Order</a></li>
                            <?php endif; ?>
                       </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->authorization->is_permitted(array('access_report_purchase','access_report_ospo'))) : ?>
                    <li class="dropdown-submenu"><a tabindex="-1">Pembelian</a>
                        <ul class="dropdown-menu">
                            <?php if ($this->authorization->is_permitted('access_report_purchase')) : ?>
                                <li><a class="ajax" href="report_po">Purchase Order</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_report_ospo')) : ?>
                                <li><a class="ajax" href="report_os_po">Outstanding PO</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->authorization->is_permitted(array('access_report_mutasi','access_report_ks','access_report_terima','access_report_sj'))) : ?>
                    <li class="dropdown-submenu"><a tabindex="-1">Persediaan</a>
                        <ul class="dropdown-menu" style="">
                            <?php if ($this->authorization->is_permitted('access_report_mutasi')) : ?>
                                <li><a class="ajax" href="report_mutasi">Mutasi</a></li>
                            <?php endif; ?>

                            <?php if ($this->authorization->is_permitted('access_report_ks')) : ?>
                                <li class="menu-border-bottom"><a class="ajax" href="report_ks">Kartu Stock</a></li>
                            <?php endif; ?>

                            <?php if ($this->authorization->is_permitted('access_report_terima')) : ?>
                                <li><a class="ajax" href="report_penerimaan">Penerimaan</a></li>
                            <?php endif; ?>

                            <?php if ($this->authorization->is_permitted('access_report_sj')) : ?>
                                <li><a class="ajax" href="report_sj">Surat Jalan</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>  
                    <?php endif; ?> 
                </ul>
            </li>
            <?php endif; ?>

            <?php if ($this->authorization->is_permitted( array('access_stock', 'retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
            <li class="dropdown-submenu"><a tabindex="-1" href="#"><i class="icon-wrench"></i>Maintenance</a>
                <ul class="dropdown-menu" style=" ">
                    <?php if ($this->authorization->is_permitted('access_stock')) : ?>
                        <li><a class="ajax" href="saw">Stock Opname</a></li>
                    <?php endif; ?>

                    <?php if ($this->authorization->is_permitted(array('retrieve_users', 'retrieve_roles', 'retrieve_permissions'))) : ?>
                        <li><a class="" href="user">User Management</a></li>
                    <?php endif; ?>
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