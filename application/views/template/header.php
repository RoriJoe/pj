<script type="text/javascript">
    $(window).scroll(function(e) {
        // Get the position of the location where the scroller starts.
        var scroller_anchor = $(".scroller_anchor").offset().top;

        // Check if the user has scrolled and the current position is after the scroller start location and if its not already fixed at the top
        if ($(this).scrollTop() >= scroller_anchor && $('#optm').css('position') != 'fixed')
        {    // Change the CSS of the scroller to hilight it and fix it at the top of the screen.
            $('#optm').css({
                'position': 'fixed',
                'top': '0px'
            });
            // Changing the height of the scroller anchor to that of scroller so that there is no change in the overall height of the page.
            $('.scroller_anchor').css('height', '5px');
        }
        else if ($(this).scrollTop() < scroller_anchor && $('#optm').css('position') != 'relative')
        {    // If the user has scrolled back to the location above the scroller anchor place it back into the content.
            // Change the height of the scroller anchor to 0 and now we will be adding the scroller back to the content.
            $('.scroller_anchor').css('height', '0px');
            // Change the CSS and put it back to its original position.
            $('#optm').css({
                'position': 'relative'
            });
        }
    });
</script>

<?
$date = date("d F Y, H:i");
?>
<!--<img width ="100%" height="70px" src="<?php echo base_url();?>system/images/header/2.jpg">-->
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
        document.getElementById('ctm').innerHTML = x1;
        tt=display_c();
 }
</script>

<script>
    window.onload = display_ct;
</script>
<div class="visible-desktop">
    <!-- header image -->
    <div id="headerImg">
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
    <div id="opt" align="right" style="float:right">
            <!--<div class="breadcrumb flat breadcrumb-margin-top">
                <a href="#">Home</a>
                <a href="#" class="active">Master Barang</a>
            </div>-->

        <div style="float: left; margin-left: 20px; margin-top: 10px; color:#fff;">
            <!--<?php echo set_breadcrumb(); ?>-->
        </div>
        <div id="tgl">
            <span id='ct' style="margin-right: 5px;"></span> | <!-- code php -->
            Welcome, <?php echo $this->session->userdata('Nama'); ?> |
        </div>
    </div>   
</div>

<div class="hidden-desktop">
    <div style="text-align:right;color: #A8A8A8;">
        <span id='ctm' style="margin-right: 5px;"></span> | <!-- code php -->
        Welcome, <?php echo $this->session->userdata('Nama'); ?>
    </div>
    <div class="scroller_anchor"></div>
    <div class="navbar navbar-inverse navbar-fixed-top" id="optm">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Pelita Jaya</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
                <li><a class = "" href="home"><i class="icon-home"></i>&nbsp;Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th-large"></i>&nbsp;Master <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class = "" href="ms_barang">Barang</a></li>
                        <li><a class = "" href="ms_pelanggan">Pelanggan</a></li>
                        <li><a class = "" href="ms_supplier">Supplier</a></li>
                        <li><a class = "" href="ms_gudang">Gudang</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i>&nbsp;Transaksi <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class = "">Pembelian</a>
                            <ul>
                                <li><a class = "" href="tr_pemesanan">Pemesanan / PO</a></li>
                                <li><a class = "" href="tr_penerimaan_barang">Penerimaan Barang</a></li>
                            </ul>
                        </li>
                        <li><a class = "">Penjualan</a>
                           <ul>
                                <li><a class = "" href="tr_do">Sales Order</a></li>
                                <li><a class = "" href="tr_surat_jalan">Surat Jalan</a></li>
                                <li><a class = "" href="tr_invoice">Invoice</a></li>
                           </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-book"></i>&nbsp; Laporan <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="" href="report_do">Delivery Order</a></li>
                        <li><a class="" href="report_sj">Surat Jalan</a></li>
                        <li><a class="" href="report_mutasi">Mutasi</a></li>
                        <li><a class="" href="report_os">Outstanding</a></li>
                        <li><a class="" href="report_penerimaan">Penerimaan</a></li>
                        <li><a class="" href="report_ks">Kartu Stock</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-wrench"></i>&nbsp;Maintenance <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="" href="saw">Create Saldo Awal</a></li>
                      <li><a href="#">Create Password</a></li>
                      <li><a href="#">Stock</a></li>
                    </ul>
                </li>
                <li><a href="logout"><i class="icon-off"></i>&nbsp;Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
</div>