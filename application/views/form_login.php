<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login Pelita Jaya</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/todc-bootstrap.css" />
   	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
   	

</head>

<body>
<!--Just testing for git-->    
    <div id="konfirmasi" class="sukses"></div>
    <div class="login-box">
       <div class="login-image">
        <img src="http://sisfoprima.com/pj/assets/img/login.png">
        <div class="div-judul">
            <p>PD.PELITA JAYA</p>
        </div>
       </div>
            
        <div class="login-form-wrap signin-box">
          <h2 class="form-signin-heading">Sign in</h2>

          <?php echo form_open('login/validatelogin'); ?>
            <fieldset>
              <label for="username">Username</label>
              <input type="text" class="input-block-level" name="username" id="username" required="required">
              <label for="passwd">Password</label>
              <input type="password" class="input-block-level" name="password" id="password" required="required">

              <button class="btn btn-large btn-primary" type="submit" data-loading-text="Signing in...">Sign in</button>
              <p class="error"><?php echo $error;?></p>
            </fieldset>
          <?php echo form_close(); ?>
        </div>              
    </div>
    <div id="footer">
            <div id="footerContent">
            <p style="text-align: center; font-family:verdana;font-size: 14px;color: #999999;">Copyright © Pelita Jaya 2013</p>
        </div>
    </div>
</body>
</html>
<script type='text/javascript' src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js" ></script>
<script type="text/javascript">
    <!--var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});-->
//ALERT
    bootstrap_alert = function() {}

    bootstrap_alert.info = function(message) {
        $('#konfirmasi').html('<div class="alert" ><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    }
    
        var agent = <?php echo $uagent;?> ;
        if(agent != 1){
            bootstrap_alert.info('<strong>Peringatan!</strong> Browser yang sedang anda gunakan <strong>TIDAK</strong> mendukung secara penuh web ini, direkomendasikan untuk menggunakan <a href="https://www.google.com/intl/en/chrome/browser/">Google Chrome</a>');
        }
</script>