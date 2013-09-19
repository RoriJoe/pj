<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/ptik.png"/>-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title; ?></title>
	    <?php $this->load->view("load/head"); ?>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />

    <script src="<?php echo base_url();?>assets/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/js-menu.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js" type="text/javascript"></script>
	
	<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.cookie.js'></script>
	<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.dcjqaccordion.js'></script>
	<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.hoverIntent.minified.js'></script>

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
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/popup.js"></script>
	
</head>

<body>
<div id="overlay"></div>
<div id="wrapper">
	<div id="wrapper2">
        	<!-- header -->
        	<div id="header">
            	<?php include 'load/header.php'; ?>
            </div>
			
            <div style="clear:both;"></div>
			
            <!-- content -->
          <div id="content">
				<div id="leftBar">
					<?php include 'load/side.php'; ?>
				</div>
				
				<!-- RightBar -->
				<div id="rightBar">					
				<div id="contentFull" >
					<?php $this->load->view($dynamiccontent); ?>
				</div>
				</div>
                <!-- end of div -->
                
		  </div>

            <div style="clear:both;"></div>
            
            <!-- footer -->
            <div id="footer">
            	<?php include 'load/footer.php'; ?>
            </div>
		</div>
</div>
</body>
</html>
