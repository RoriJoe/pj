<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
    <title>Pelita Jaya - Login</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/todc-bootstrap.css" />
   	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
</head>
<body style="padding-top: 40px;padding-bottom: 40px;">    
  <div class="visible-desktop">
    <div class="login-box">
      <div class="login-image">
        <img src="<?php echo base_url('assets/img/login.png'); ?>">
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
  </div>

  <!--
  /*
  *Mobile View
  *Do Not Remove if not Necessary!!!
  */
  -->
  <div class="visible-phone visible-tablet">
    <div class="row-fluid">
      <div class="10">
        <div class="signin-box">
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
    </div>
  </div>
<!--
  /*
  *End Mobile View
  *Do Not Remove if not Necessary!!!
  */
-->
    
  <div id="footer" style="height:0;">
          <div id="footerContent">
          <p style="text-align: center; font-family:verdana;font-size: 14px;color: #999999;">Copyright © Pelita Jaya 2013</p>
      </div>
  </div>
</body>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.0.min.js" ></script>
<script type='text/javascript' src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</html>