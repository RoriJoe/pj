<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title><?php echo $judul; ?></title>

    <!--Popup-->
<!--    <script type="text/javascript" src="<?php echo base_url();?>assets/js/popup.js"></script>   -->
<!--    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js" ></script>   -->
<!--    <script type="text/javascript" src="<?php echo base_url();?>assets/js/js-menu.js"></script> -->
    
    <!--CSS AREA-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/base/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/todc-bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
</head>

<body style="overflow-y: scroll; background-image:url('../assets/img/bg.png');">
<div id="overlay"></div>
<div id="wrapper">
    <div id="inner-wrap">
        <!-- header -->
        <div id="info"></div>
        <div id="header">
            <?php echo $_header; ?>
        </div>

        <!-- content -->
        <div id="content">
            <div id="leftBar">
                <?php echo $_side_menu; ?>
            </div>

            <!-- RightBar -->
            <div id="rightBar">
                <div id="contentFull" >
                    <?php echo $_content; ?>
                </div>
            </div>
            <!-- end of div -->
        </div>
        <div style="clear:both;"></div>

        <!-- footer -->
        <div id="footer">
            <?php echo $_footer; ?>
        </div>
    </div>
</div>
<div class="container">
    <!--JS AREA-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js" ></script>
    <script type='text/javascript' src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    
        <!--Drop Menu-->
    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.dcjqaccordion.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.cookie.js'></script>
    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.hoverIntent.minified.js'></script>

    
    <!--Initialize Drop Menu-->
    <script type="text/javascript">
    $(document).ready(function($){
        $('#accordion').dcAccordion({
            eventType: 'click',
            autoClose: true,
            saveState: false,
            disableLink: true,
            showCount: false,
            speed: 'fast'
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $('.ajax').click(function(e){
            e.preventDefault();
            $.get($(this).attr('href'),function(Res){
            $('#contentFull').html(Res);
            });
        })
    })
    </script>
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
         bootstrap_alert = function() {}

        bootstrap_alert.info = function(message) {
            $('#info').html('<div class="alert" ><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        }
    
        var agent = <?php echo $uagent;?> ;
        if(agent != 1){
            bootstrap_alert.info('<strong>Peringatan!</strong> Browser yang sedang anda gunakan <strong>TIDAK</strong> mendukung secara penuh web ini, direkomendasikan untuk menggunakan <a href="https://www.google.com/intl/en/chrome/browser/">Google Chrome</a>');
        }
    </script>
    <!--breadcrumb--><!--<script type='text/javascript' src='<?php echo base_url();?>assets/js/prefixfree-1.0.7.js'></script>-->
</div>
</body>
</html>
