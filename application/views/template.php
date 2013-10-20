<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title><?php echo $judul; ?></title>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.0.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.min.js" ></script>
    <script type='text/javascript' src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>  
    <script type='text/javascript' src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>  
        <!--Drop Menu-->
    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.dcjqaccordion.js'></script>
        <!--JS Sorting-->
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

    function PlaySound(soundObj) {
        var sound = document.getElementById(soundObj);
        if (sound)
            sound.play();
    }
    </script>


    <script>
    $(document).ready(function(){
        $('.ajax').click(function(e){
            e.preventDefault();
            $.get($(this).attr('href'),function(Res){
            $('#contentFull').html(Res);
            });
        })

        $('#loadingDiv')
        .hide()  // hide it initially
        .ajaxStart(function() {
            $(this).show();
        })
        .ajaxStop(function() {
            $(this).hide();
        });
    });
    </script>

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
        <div id="container" style="margin-top:45px;margin-right: 10px;">
            <div class="row-fluid">
                <div class="span2">
                    <?php echo $_side_menu; ?>
                </div>

                <!-- RightBar -->
                <div class="span10">

                    <div id="contentFull">
                        <?php echo $_content; ?>
                    </div>
                    <div id="loadingDiv">
                        <div id="facebookG">
                        <div id="blockG_1" class="facebook_blockG">
                        </div>
                        <div id="blockG_2" class="facebook_blockG">
                        </div>
                        <div id="blockG_3" class="facebook_blockG">
                        </div>
                        </div>
                    </div>       
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
<audio src="<?php echo base_url();?>assets/alert.mp3"  id="beep" />
</body>
</html>
