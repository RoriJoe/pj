<?php
    if($this->session->userdata('is_logged_in') == 2){
        redirect('menu/home');
    }
?>

<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
   	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
</head>

<body style="margin: 0;">
<div id="wrapper">
    <div id="wrapper2">
        <!-- header -->
        <div id="opt"><p class="uagent" style="margin: 0; color: #fff;"><?php echo $uagent;?></p></div>
        <div style="clear:both;"></div>
        <!-- content -->

        <div id="content content-login">
        <div id="login_box">
            <div id="contentlogin" ></div>
        </div>
		
        <div class="login-box">
            <div class="login-image">
                <img src="<?php echo base_url();?>assets/img/login.png"/>
                <div class="div-judul">
                    <p>PD PELITA JAYA</p>
                </div>
            </div>
            <div class="login-form-wrap">
            <div class="ua-login-form front-login">
               <div id="formlogin" class="animate form">
                <?php echo form_open('login/validatelogin'); ?>
                <h2>Log In</h2>
                
                <div style="margin-bottom: 75px;margin-top: 22px;">
                    <div class="login-left">
                        <label data-icon="u" > User Name </label>
                    </div>
                    <div class="login-right">
                        <input class="textbox" id="username" name="username" required="required" type="text" placeholder="User Name"/>
                    </div>
                </div>
                <div style="display: block; clear: both;"></div>
                <div>
                    <div class="login-left">
                        <label data-icon="p"> Password </label>
                    </div>
                    <div class="login-right">
                        <input class="textbox" id="password" name="password" required="required" type="password" placeholder="Password" />
                    </div>
                </div>
                <div style="display: block; clear: both;"></div>
                <p class="error"><?php echo $error;?></p>

                <p class="login button" style="text-align: center;">
                    <input class="loginbtn" type="submit" value="Login" />
                </p>
                <?php echo form_close(); ?>
            </div>

            </div>
        </div>
        </div>
        <!-- end of div -->
        <div style="clear:both;"></div>
        <!-- footer -->
    </div>
</div>

<script type="text/javascript">
    <!--var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});-->
</script>
</body>
</html>
