<?
    $date = date("d F Y, H:i");
?>
<script type="text/javascript">
    function display_c(){
        var refresh=1000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct()',refresh)
    }

    function display_ct() {
        var strcount;
        var x = new Date();
        //x.format("m/dd/yy");
        var x1 = dateFormat(x, "dd / mm /yyyy ( h:MM:ss TT )");
        //var x1=x.toLocaleString();// changing the display to UTC string
        document.getElementById('ct').innerHTML = x1;
        tt=display_c();
    }

    window.onload = display_ct;
</script>

<!-- header image -->
<div id="headerImg" class="visible-desktop">
    <div class="box-logo" style="width: 400px;height: 75px;float: left;margin-left: 12px;margin-top: 2px; font-family: verdana; color: white; ">
        <div class="img-logo" style="float: left;height: 90px;">
            <img src="<?php echo base_url();?>assets/img/ptik.png"/>
        </div>
        <div class="text-logo" style="margin-top: 12px;margin-left: 120px;">
            <div style="text-align: left; font-size: 25px; font-weight: bold;">PD PELITA JAYA <span class="label label-warning" style="width: 30px;">Beta</span></div>
            <div style="text-align: left; font-size: 10px; color: #CACACA;">Pangeran Jaya Karta No.30, Jakarta Pusat</div>
        </div>    
    </div>
</div>

<div class="navbar navbar-inverse" style="margin-bottom:0px;">
  <div class="navbar-inner">
    <div id="loadingD" class="hidden-phone pull-left">
        <img src="<?php echo base_url();?>assets/img/ajax-loader.gif"/>
    </div> 
    <a class="brand visible-phone" href="#">Pelita Jaya</a>
    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <ul class="nav pull-right">
        <li class="hidden-phone"><a id='ct' style="margin-right: 5px;"></a></li>
        <li class="dropdown hidden-phone">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Pengaturan User"><?php echo $account->firstname; ?> <?php echo $account->lastname; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>menu/user">User Profile</a></li>
                <li><a href="<?php echo base_url(); ?>menu/logout">Logout</a></li>
            </ul>
        </li>
    </ul>

    <div class="nav-collapse visible-phone visible-tablet">
        <ul class="nav">
            <li><a class = "" href="home"><i class="icon-home"></i>Home</a></li>
            
            <?php if ($this->authorization->is_permitted( array('access_gudang', 'access_pelanggan', 'access_supplier', 'access_bank', 'access_barang', 'access_perkiraan', 'access_satuan') )) : ?>
            <li class="dropdown">
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
                    <li class="dropdown">
                        <a tabindex="-1">Persediaan</a>
                        <ul class="dropdown-menu">
                            <?php if ($this->authorization->is_permitted('access_barang')) : ?>
                                <li><a tabindex="-1" class = "ajax" href="ms_barang">Barang</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_satuan')) : ?>
                                <li><a class = "ajax" href="ms_satuan">Satuan</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>                   
                </ul>
            </li>
            <?php endif; ?>
            
            <?php if ($this->authorization->is_permitted( array('access_so', 'access_po','access_surat_jalan', 'access_penerimaan', 'access_invoice', 'access_tagihan', 'access_bayar') )) : ?>
            <li class="dropdown">
                <a tabindex="-1"><i class="icon-shopping-cart"></i>Transaksi</a>
                <ul class="dropdown-menu" style=" top: -23px; ">
                    <?php if ($this->authorization->is_permitted('access_so')) : ?>
                    <li class="dropdown"><a tabindex="-1">Penjualan</a>
                       <ul class="dropdown-menu">
                            <li><a tabindex="-1" class = "ajax" href="tr_do">Sales Order</a></li>
                       </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->authorization->is_permitted('access_po')) : ?>
                    <li class="dropdown"><a tabindex="-1">Pembelian</a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" class = "ajax" href="tr_pemesanan">Pemesanan / PO</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->authorization->is_permitted(array('access_surat_jalan','access_penerimaan'))) : ?>
                    <li class="dropdown"><a tabindex="-1">Persediaan</a>
                        <ul class="dropdown-menu">
                            <?php if ($this->authorization->is_permitted('access_surat_jalan')) : ?>
                            <li><a class = "ajax" href="tr_surat_jalan">Surat Jalan</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_penerimaan')) : ?>
                            <li><a tabindex="-1" class = "ajax" href="tr_penerimaan_barang">Penerimaan Barang</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->authorization->is_permitted(array('access_invoice','access_tagihan','access_bayar'))) : ?>
                    <li class="dropdown"><a tabindex="-1">Keuangan</a>
                        <ul class="dropdown-menu">
                            <?php if ($this->authorization->is_permitted('access_invoice')) : ?>
                            <li><a class = "ajax" href="tr_invoice">Invoice</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_tagihan')) : ?>
                            <li><a tabindex="-1" class = "ajax" href="tr_terima_bayar">Terima Tagihan</a></li>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('access_bayar')) : ?>
                            <li><a tabindex="-1" class = "ajax" href="tr_pembayaran">Pembayaran</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <li class="dropdown"><a tabindex="-1">Akuntansi</a>
                        <ul class="dropdown-menu" style=" top: -200px; ">
                            <li><a class = "ul-divider " href="<?php echo base_url(); ?>akun/jurnal">Jurnal</a></li>
                            <li><a class = "" href="<?php echo base_url(); ?>akun/cetakjurnal">Transaksi Jurnal</a></li>
                            <li><a class = "" href="<?php echo base_url(); ?>akun/cetakbukubesar">Buku Besar</a></li>
                            <li><a class = "" href="<?php echo base_url(); ?>akun/cetaklabarugi">Rugi Laba</a></li>
                            <li><a class = "" href="<?php echo base_url(); ?>akun/cetakneraca">Neraca</a></li>
                            <li><a class = "ul-divider" href="<?php echo base_url(); ?>akun/tutuptahun">Tutup Tahun</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            
            <?php if ($this->authorization->is_permitted( array('access_report_sales', 'access_report_oso','access_report_purchase', 'access_report_ospo', 'access_report_mutasi', 'access_report_ks', 'access_report_terima', 'access_report_sj') )) : ?>
            <li class="dropdown">
                <a tabindex="-1" href="#"><i class="icon-book"></i> Laporan</a>
                <ul class="dropdown-menu" style="">

                    <?php if ($this->authorization->is_permitted(array('access_report_sales','access_report_oso'))) : ?>
                    <li class="dropdown"><a tabindex="-1">Penjualan</a>
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
                    <li class="dropdown"><a tabindex="-1">Pembelian</a>
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
                    <li class="dropdown"><a tabindex="-1">Persediaan</a>
                        <ul class="dropdown-menu" style="">
                            <?php if ($this->authorization->is_permitted('access_report_mutasi')) : ?>
                                <li><a class="ajax" href="report_mutasi">Mutasi</a></li>
                            <?php endif; ?>

                            <?php if ($this->authorization->is_permitted('access_report_ks')) : ?>
                                <li><a class="ajax" href="report_ks">Kartu Stock</a></li>
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
            <li class="dropdown"><a tabindex="-1" href="#"><i class="icon-wrench"></i>Maintenance</a>
                <ul class="dropdown-menu" style=" ">
                    <li class="dropdown"><a tabindex="-1">Setting Akuntansi</a>
                        <ul class="dropdown-menu" style="">
                            <li><a class = "" href="setting_neraca">Setting Neraca</a></li>
                            <li><a class = "" href="setting_laba_rugi">Setting Laba Rugi</a></li>
                            <li><a class = "" href="mappingperkiraan">Mapping Perkiraan</a></li>
                            <li><a class = "" href="settingmapping">Setting Mapping</a></li>
                        </ul>
                    </li>
                    
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
</div> 