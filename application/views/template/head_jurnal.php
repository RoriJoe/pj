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
        tt=display_c();
 }
</script>

<script>
    window.onload = display_ct;
</script>
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
<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <ul class="nav">
      <li><a href="<?php echo base_url(); ?>menu/home" title="Halaman Utama"><i class="icon-home icon-white"></i>Home</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Akuntansi & Keuangan <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>akun/settingneraca">Setting Neraca</a></li>
          <li><a href="<?php echo base_url(); ?>akun/settingrugilaba">Setting Laba Rugi</a></li>
          <li><a href="<?php echo base_url(); ?>akun/mappingperkiraan">Mapping Perkiraan</a></li>
          <li><a href="<?php echo base_url(); ?>akun/settingmapping">Setting Mapping</a></li>
          <li><a href="<?php echo base_url(); ?>akun/tutuptahun">Tutup Tahun</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Akuntansi <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>akun/jurnal">Jurnal</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cetak <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>akun/cetakjurnal">Transaksi Jurnal</a></li>
          <li><a href="<?php echo base_url(); ?>akun/cetakbukubesar">Buku Besar</a></li>
          <li><a href="<?php echo base_url(); ?>akun/cetaklabarugi">Laba Rugi</a></li>
          <li><a href="<?php echo base_url(); ?>akun/cetakneraca">Neraca</a></li>
        </ul>
      </li>
    </ul>

    <ul class="nav pull-right">
        <li><a id='ct' style="margin-right: 5px;"></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Pengaturan User"><?php echo $account->firstname; ?> <?php echo $account->lastname; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>menu/user">User Profile</a></li>
                <li><a href="<?php echo base_url(); ?>menu/logout">Logout</a></li>
            </ul>
        </li>
    </ul>
  </div>
</div>