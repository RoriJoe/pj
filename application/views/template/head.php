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
<div id="opt" align="right" style="float:right">
    <div style="float: left; margin-left: 20px; margin-top: 8px; color:#fff;">
        <a href="<?php echo base_url(); ?>menu/home" class="btn btn-primary"><i class="icon-home icon-white"></i>Home</a>
    </div>
    <div id="tgl">
        <span id='ct' style="margin-right: 5px;"></span> | <!-- code php -->
        Welcome, <?php echo $account->firstname; ?> |
    </div>
</div>   