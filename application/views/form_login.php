<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
    <title>Pelita Jaya - Login</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
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
            
      <div class="login-form-wrap signin-box" style="width: 270px;">
        <h2 class="form-signin-heading">Sign in</h2>

        <?php echo form_open(uri_string().($this->input->get('continue') ? '/?continue='.urlencode($this->input->get('continue')) : ''), 'class=""'); ?>
          <?php echo form_fieldset(); ?>

            <?php if (isset($sign_in_error)) : ?>
              <div class="form_error" style="color:red;"><?php echo $sign_in_error; ?></div>
            <?php endif; ?>

              <div class="control-group <?php echo (form_error('username') || isset($username_error)) ? 'error' : ''; ?>">
                <label class="control-label" for="username"><?php echo 'Username'; ?></label>
                <div class="controls">
                  <?php echo form_input(array('name' => 'username', 'id' => 'username','style'=>'margin-bottom:0px;', 'value' => set_value('username'), 'maxlength' => '24')); ?>
                  
                  <?php if (form_error('username') || isset($username_error)) :?>
                    <span class="help-inline">
                          <?php echo form_error('username'); ?>
                      <?php if (isset($username_error)) : ?>
                        <span class="field_error"><?php echo $username_error; ?></span>
                      <?php endif; ?>
                    </span>
                  <?php endif; ?>

                </div>
              </div>

              <div class="control-group <?php echo form_error('password') ? 'error' : ''; ?>">
                <label class="control-label" for="password"><?php echo 'Password'; ?></label>
                  <div class="controls">
                    <?php echo form_password(array('name' => 'password', 'id' => 'password','style'=>'margin-bottom:0px;', 'value' => set_value('password'))); ?>
                      <?php if (form_error('password')) : ?>
                        <span class="help-inline">
                          <?php echo form_error('password'); ?>
                        </span>
                      <?php endif; ?>
                  </div>
              </div>

              <!--<div class="control-group">
                <div class="controls">
                  <label class="checkbox">
                    <?php echo form_checkbox(array('name' => 'sign_in_remember', 'id' => 'sign_in_remember', 'value' => 'checked', 'checked' => $this->input->post('sign_in_remember'),)); ?>
                    <?php echo 'Remember Me'; ?>
                  </label>
                </div>
              </div>-->

              <div>
                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-large pull-right', 'content' => '<i class="icon-lock"></i> '.'Sign In')); ?>
              </div>

              <p><a href="#myModal" role="button" class="" data-toggle="modal">Forgot passowrd</a><br/>
          <?php echo form_fieldset_close(); ?>
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
  <!--
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
  </div>-->
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

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Forgot Password</h3>
  </div>
  <div class="modal-body">
    <p>Untuk melakukan reset ulang password silahkan menghubungi <b>admin</b> dari website PD Pelita Jaya</p>
  </div>
</div>

</body>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.0.min.js" ></script>
<script type='text/javascript' src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</html>