<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title><?php echo $judul; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
    <!--CSS AREA-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/base/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/plusstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/plusstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.0.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.min.js" ></script>
    <script type='text/javascript' src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>  
    <script type='text/javascript' src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>  
    <!--Drop Menu-->
    <!--<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.dcjqaccordion.js'></script>-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/validation/validationEngine.jquery.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/validation/template.css"/>
    <!--REQUIRED FOR DATE TIMER-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/date.format.js"></script>    
    <!--Initialize Java Script-->
    <script type="text/javascript">
    $(document).ready(function($){
        /*$('#accordion').dcAccordion({
            eventType: 'click',
            autoClose: true,
            saveState: false,
            disableLink: true,
            showCount: false,
            speed: 'fast'
        });*/
        //Load ajax Content
        $('.ajax').click(function(e){
            e.preventDefault();
            $.get($(this).attr('href'),function(Res){
            $('#contentFull').html(Res);
            });
        })

        //INITILIZE LOADING GIF ON AJAX CALL
        $('#loadingDiv')
        .hide()  // hide it initially
        .ajaxStart(function() {
            $(this).show();
        })
        .ajaxStop(function() {
            $(this).hide();
        });
    });

    function PlaySound(soundObj) {
        var sound = document.getElementById(soundObj);
        if (sound)
            sound.play();
    }
    </script>
</head>

<body style="background-image:url('../assets/img/bg.png');">
<div id="overlay"></div>
<div id="wrapper">
    <div id="inner-wrap">
        <div id="info"></div>
        <div id="header">
            <?php echo $_header; ?>
        </div>
        <div id="container">
            <div class="row-fluid">
                <div class="span2 hidden-phone">
                    <?php echo $_side_menu; ?>
                </div>
                <!-- Content -->
                <div class="span10" style=" margin-top: 10px; padding-right: 20px;">
                    <div id="contentFull">
                        <?php echo $_content; ?>
                    </div>
                    <div id="loadingDiv">
                       <img src="<?php echo base_url();?>assets/img/ajax-loader.gif"/>
                    </div>       
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>

        <div id="footer">
            <?php echo $_footer; ?>
        </div>
    </div>
</div>
<audio src="<?php echo base_url();?>assets/alert.mp3"  id="beep" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.textchange.min.js"></script>
<!--JS Sorting-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<!--JS VALIDATION-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/validation/jquery.validationEngine-id.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/validation/jquery.validationEngine.js" ></script>
</body>
</html>
