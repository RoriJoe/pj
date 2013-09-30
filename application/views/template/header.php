    <!--JS Sorting-->
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatable/complete.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatable/jquery.dataTables.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatable/FixedColumns.js"></script>-->
<!--JS VALIDATION-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/validation/jquery.validationEngine-id.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/validation/jquery.validationEngine.js" ></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquerypopupwindow.js"></script>-->

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/validation/validationEngine.jquery.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/validation/template.css"/>
<!--REQUIRED-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/date.format.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.textchange.min.js"></script>

<script type="text/javascript">
    $(window).scroll(function(e) {
        // Get the position of the location where the scroller starts.
        var scroller_anchor = $(".scroller_anchor").offset().top;

        // Check if the user has scrolled and the current position is after the scroller start location and if its not already fixed at the top
        if ($(this).scrollTop() >= scroller_anchor && $('#opt').css('position') != 'fixed')
        {    // Change the CSS of the scroller to hilight it and fix it at the top of the screen.
            $('#opt').css({
                'position': 'fixed',
                'top': '0px'
            });
            // Changing the height of the scroller anchor to that of scroller so that there is no change in the overall height of the page.
            $('.scroller_anchor').css('height', '5px');
        }
        else if ($(this).scrollTop() < scroller_anchor && $('#opt').css('position') != 'relative')
        {    // If the user has scrolled back to the location above the scroller anchor place it back into the content.
            // Change the height of the scroller anchor to 0 and now we will be adding the scroller back to the content.
            $('.scroller_anchor').css('height', '0px');
            // Change the CSS and put it back to its original position.
            $('#opt').css({
                'position': 'relative'
            });
        }
    });
</script>
    
<?
$date = date("d F Y, H:i");
?>
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
    
    <div style="float: right;">
            <img src="<?php echo base_url();?>assets/img/header.png" style=" width: 669px; height: 85px;"/>
    </div>
</div>

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


<div class="scroller_anchor"></div>
    <div id="opt" align="right" style="float:right">
  <!--      <div class="breadcrumb flat breadcrumb-margin-top">
            <a href="#">Home</a>
            <a href="#" class="active">Master Barang</a>
        </div>-->

        <div id="breadcrumb" style="float: left; margin-left: 20px; margin-top: 10px;">

        </div>

        <!--<div id="opt2">
        	<a href="logout" role="button" button class="btn btn-danger" type="button"><i class="icon-off icon-white"></i> Logout</a>
            <span id="logout"><?php echo anchor('login/logout','Logout')?></span>
        </div>-->
        <div id="tgl">
            <span id='ct' style="margin-right: 5px;"></span> | <!-- code php -->
            Welcome, <?php echo $user ?> |
    </div>
</div>
