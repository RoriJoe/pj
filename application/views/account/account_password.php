<!DOCTYPE html>
<html>
<head>
    <title>User Management - Pelita Jaya</title>
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
			<?php echo $this->load->view('account/account_menu', array('current' => 'account_password')); ?>
        </div>
        <div class="span10">

			<?php if ($this->session->flashdata('password_info')) : ?>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('password_info'); ?>
            </div>
			<?php endif; ?>

            <h2>Change Password</h2>

            <div class="well">
				<p>Untuk menjaga keamanan akun anda, kami <b>sangat</b> menyarankan untuk menggunakan kata kunci yang kompleks dimana...</p>
                1. Terdiri paling sedikit 8 karakter
                <br/>2. Menggunakan kombinasi huruf besar dan kecil
                <br/>3. Terdiri dari angka dan karakter khusus
                <br/>4. Tidak berdasarkan informasi personal
                <br/>5. Tidak berdasarkan kamus kata
            </div>

			<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>

            <br>

            <div class="control-group <?php echo (form_error('password_new_password')) ? 'error' : ''; ?>">
                <label class="control-label" for="password_new_password">New Password</label>

                <div class="controls">
					<?php echo form_password(array('name' => 'password_new_password', 'id' => 'password_new_password', 'value' => set_value('password_new_password'), 'autocomplete' => 'off')); ?>
					<?php if (form_error('password_new_password'))
				{
					?>
                    <span class="help-inline">
					<?php echo form_error('password_new_password'); ?>
					</span>
					<?php } ?>
                </div>
            </div>

            <div class="control-group <?php echo (form_error('password_retype_new_password')) ? 'error' : ''; ?>">
                <label class="control-label" for="password_retype_new_password">Re-type New Password</label>

                <div class="controls">
					<?php echo form_password(array('name' => 'password_retype_new_password', 'id' => 'password_retype_new_password', 'value' => set_value('password_retype_new_password'), 'autocomplete' => 'off')); ?>
					<?php if (form_error('password_retype_new_password'))
				{
					?>
                    <span class="help-inline">
					<?php echo form_error('password_retype_new_password'); ?>
					</span>
					<?php } ?>
                </div>
            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo lang('password_change_my_password'); ?></button>
            </div>

			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>

        </div>
    </div>
</div>

<?php echo $this->load->view('template/footer'); ?>

</body>
</html>