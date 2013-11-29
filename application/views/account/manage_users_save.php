<!DOCTYPE html>
<html>
<head>
  <title>User Management - Pelita Jaya</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/base/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/plusstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/plusstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
  
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.0.min.js" ></script>
  <script type='text/javascript' src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/date.format.js"></script>    
</head>
<body>

<?php echo $this->load->view('template/head'); ?>

<div class="container">
  <div class="row">

    <div class="span2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_users')); ?>
    </div>

    <div class="span10">

      <h2><?php echo lang("users_{$action}_page_name"); ?></h2>

      <div class="well">
        <?php echo lang("users_{$action}_description"); ?>
      </div>

      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

      <div class="control-group <?php echo (form_error('users_username') || isset($users_username_error)) ? 'error' : ''; ?>">
          <label class="control-label" for="users_username"><?php echo lang('profile_username'); ?></label>

          <div class="controls">
            <?php echo form_input(array('name' => 'users_username', 'id' => 'users_username', 'value' => set_value('users_username') ? set_value('users_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160)); ?>

            <?php if (form_error('users_username') || isset($users_username_error)) : ?>
              <span class="help-inline">
              <?php
                echo form_error('users_username');
                echo isset($users_username_error) ? $users_username_error : '';
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div>

      <div class="control-group <?php echo (form_error('users_email') || isset($users_email_error)) ? 'error' : ''; ?>">
          <label class="control-label" for="users_email"><?php echo lang('settings_email'); ?></label>

          <div class="controls">
            <?php echo form_input(array('name' => 'users_email', 'id' => 'users_email', 'value' => set_value('users_email') ? set_value('users_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>

            <?php if (form_error('users_email') || isset($users_email_error)) : ?>
              <span class="help-inline">
              <?php
                echo form_error('users_email');
                echo isset($users_email_error) ? $users_email_error : '';
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div>

      <div class="control-group <?php echo (form_error('users_firstname')) ? 'error' : ''; ?>">
          <label class="control-label" for="users_firstname"><?php echo 'Nama Depan' ?></label>

          <div class="controls">
          <?php echo form_input(array('name' => 'users_firstname', 'id' => 'users_firstname', 'value' => set_value('users_firstname') ? set_value('users_firstname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>
          <?php if (form_error('users_firstname')) : ?>
              <span class="help-inline">
                <?php echo form_error('users_firstname'); ?>
                </span>
          <?php endif; ?>
          </div>
      </div>

      <div class="control-group <?php echo (form_error('users_lastname')) ? 'error' : ''; ?>">
          <label class="control-label" for="users_lastname"><?php echo 'Nama Belakang' ?></label>

          <div class="controls">
          <?php echo form_input(array('name' => 'users_lastname', 'id' => 'users_lastname', 'value' => set_value('users_lastname') ? set_value('users_lastname') : (isset($update_account_details->lastname) ? $update_account_details->lastname : ''), 'maxlength' => 80)); ?>
          <?php if (form_error('users_lastname')) : ?>
              <span class="help-inline">
                <?php echo form_error('users_lastname'); ?>
              </span>
          <?php endif; ?>
          </div>
      </div>

      <div class="control-group <?php echo (form_error('users_new_password')) ? 'error' : ''; ?>">
        <label class="control-label" for="users_new_password"><?php echo 'Password' ?></label>

        <div class="controls">
          <?php echo form_password(array('name' => 'users_new_password', 'id' => 'users_new_password', 'value' => set_value('users_new_password'), 'autocomplete' => 'off')); ?>

          <?php if (form_error('users_new_password')) : ?>
            <span class="help-inline">
              <?php echo form_error('users_new_password'); ?>
            </span>
          <?php endif; ?>
        </div>
      </div>

      <div class="control-group <?php echo (form_error('users_retype_new_password')) ? 'error' : ''; ?>">
        <label class="control-label" for="users_retype_new_password"><?php echo 'Re-type Password' ?></label>

        <div class="controls">
          <?php echo form_password(array('name' => 'users_retype_new_password', 'id' => 'users_retype_new_password', 'value' => set_value('users_retype_new_password'), 'autocomplete' => 'off')); ?>
          
          <?php if (form_error('users_retype_new_password')) : ?>
            <span class="help-inline">
              <?php echo form_error('users_retype_new_password'); ?>
            </span>
          <?php endif; ?>
        </div>
      </div>

      <div class="control-group">
          <label class="control-label" for="users_roles"><?php echo 'Roles' ?></label>

          <div class="controls">
              <?php foreach($roles as $role) : ?>
                <?php 
                $check_it = FALSE;
                
                if( isset($update_account_roles) ) 
                {
                  foreach($update_account_roles as $acrole) 
                  {
                    if($role->id == $acrole->id)
                    {
                      $check_it = TRUE; break;
                    }
                  }
                }
                ?>
                <label class="checkbox">
                  <?php echo form_checkbox("account_role_{$role->id}", 'apply', $check_it); ?>
                  <?php echo $role->name; ?>
                </label>
              <?php endforeach; ?>
          </div>
      </div>

      <div class="form-actions">
        <?php echo form_submit('manage_user_submit', 'Save', 'class="btn btn-primary"'); ?>
        <?php echo anchor('account/manage_users', 'Cancel', 'class="btn"'); ?>
        <?php if( $this->authorization->is_permitted('ban_users') && $action == 'update' ): ?>
          <span><?php echo '&nbsp;or&nbsp;';?></span>
          <?php if( isset($update_account->suspendedon) ): ?>
            <?php echo form_submit('manage_user_unban', 'Unban User', 'class="btn btn-danger"'); ?>
          <?php else: ?>
            <?php echo form_submit('manage_user_ban', 'Ban User', 'class="btn btn-danger"'); ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <?php echo form_close(); ?>

    </div>
  </div>
</div>

<?php echo $this->load->view('template/footer'); ?>

</body>
</html>