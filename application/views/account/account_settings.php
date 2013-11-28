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
	<?php echo $this->load->view('account/account_menu', array('current' => 'account_settings')); ?>
</div>
<div class="span10">

<?php if (isset($settings_info))
{
	?>
<div class="alert alert-success fade in">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo $settings_info; ?>
</div>
	<?php } ?>

<h2><?php echo 'Account Settings'; ?></h2>

<div class="alert alert-info"><?php echo 'Silahkan isi data diri anda dengan sebenar-benarnya.'?></div>

<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

<div class="control-group <?php echo (form_error('settings_email') || isset($settings_email_error)) ? 'error' : ''; ?>">
    <label class="control-label" for="settings_email"><?php echo 'Email'; ?></label>

    <div class="controls">
		<?php echo form_input(array('name' => 'settings_email', 'id' => 'settings_email', 'value' => set_value('settings_email') ? set_value('settings_email') : (isset($account->email) ? $account->email : ''), 'maxlength' => 160)); ?>
		<?php if (form_error('settings_email') || isset($settings_email_error))
	{
		?>
        <span class="help-inline">
					<?php
			echo form_error('settings_email');
			echo isset($settings_email_error) ? $settings_email_error : '';
			?>
					</span>
		<?php } ?>
    </div>
</div>

<div class="control-group <?php echo (form_error('settings_firstname')) ? 'error' : ''; ?>">
    <label class="control-label" for="settings_firstname"><?php echo 'Nama Depan'; ?></label>

    <div class="controls">
		<?php echo form_input(array('name' => 'settings_firstname', 'id' => 'settings_firstname', 'value' => set_value('settings_firstname') ? set_value('settings_firstname') : (isset($account_details->firstname) ? $account_details->firstname : ''), 'maxlength' => 80)); ?>
		<?php if (form_error('settings_firstname'))
	{
		?>
        <span class="help-inline">
					<?php echo form_error('settings_firstname'); ?>
					</span>
		<?php } ?>
    </div>
</div>

<div class="control-group <?php echo (form_error('settings_lastname')) ? 'error' : ''; ?>">
    <label class="control-label" for="settings_lastname"><?php echo 'Nama Belakang'; ?></label>

    <div class="controls">
		<?php echo form_input(array('name' => 'settings_lastname', 'id' => 'settings_lastname', 'value' => set_value('settings_lastname') ? set_value('settings_lastname') : (isset($account_details->lastname) ? $account_details->lastname : ''), 'maxlength' => 80)); ?>
		<?php if (form_error('settings_lastname'))
	{
		?>
        <span class="help-inline">
					<?php echo form_error('settings_lastname'); ?>
					</span>
		<?php } ?>
    </div>
</div>

<div class="control-group <?php echo isset($settings_dob_error) ? 'error' : ''; ?>">
    <label class="control-label" for="settings_dateofbirth"><?php echo 'Tanggal Lahir'; ?></label>

    <div class="controls">
		<?php $m = $this->input->post('settings_dob_month') ? $this->input->post('settings_dob_month') : (isset($account_details->dob_month) ? $account_details->dob_month : ''); ?>
        <select name="settings_dob_month" class="input-small">
            <option value=""><?php echo 'Bulan' ?></option>
            <option value="1"<?php if ($m == 1) echo ' selected="selected"'; ?>><?php echo 'Januari'; ?></option>
            <option value="2"<?php if ($m == 2) echo ' selected="selected"'; ?>><?php echo 'Februari'; ?></option>
            <option value="3"<?php if ($m == 3) echo ' selected="selected"'; ?>><?php echo 'Maret'; ?></option>
            <option value="4"<?php if ($m == 4) echo ' selected="selected"'; ?>><?php echo 'April'; ?></option>
            <option value="5"<?php if ($m == 5) echo ' selected="selected"'; ?>><?php echo 'May' ?></option>
            <option value="6"<?php if ($m == 6) echo ' selected="selected"'; ?>><?php echo 'Juni' ?></option>
            <option value="7"<?php if ($m == 7) echo ' selected="selected"'; ?>><?php echo 'Juli' ?></option>
            <option value="8"<?php if ($m == 8) echo ' selected="selected"'; ?>><?php echo 'Agustus' ?></option>
            <option value="9"<?php if ($m == 9) echo ' selected="selected"'; ?>><?php echo 'September' ?></option>
            <option value="10"<?php if ($m == 10) echo ' selected="selected"'; ?>><?php echo 'Oktober' ?></option>
            <option value="11"<?php if ($m == 11) echo ' selected="selected"'; ?>><?php echo 'November' ?></option>
            <option value="12"<?php if ($m == 12) echo ' selected="selected"'; ?>><?php echo 'Desember' ?></option>
        </select>
		<?php $d = $this->input->post('settings_dob_day') ? $this->input->post('settings_dob_day') : (isset($account_details->dob_day) ? $account_details->dob_day : ''); ?>
        <select name="settings_dob_day" class="input-small">
            <option value="" selected="selected"><?php echo 'Hari' ?></option>
			<?php for ($i = 1; $i < 32; $i ++) : ?>
            <option value="<?php echo $i; ?>"<?php if ($d == $i) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
			<?php endfor; ?>
        </select>
		<?php $y = $this->input->post('settings_dob_year') ? $this->input->post('settings_dob_year') : (isset($account_details->dob_year) ? $account_details->dob_year : ''); ?>
        <select name="settings_dob_year" class="input-small">
            <option value=""><?php echo 'Tahun' ?></option>
			<?php $year = mdate('%Y', now()); for ($i = $year; $i > 1930; $i --) : ?>
            <option value="<?php echo $i; ?>"<?php if ($y == $i) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
			<?php endfor; ?>
        </select>
		<?php if (isset($settings_dob_error))
	{
		?>
        <span class="help-inline">
					<?php echo $settings_dob_error; ?>
					</span>
		<?php } ?>
    </div>
</div>

<div class="control-group <?php echo (form_error('settings_gender')) ? 'error' : ''; ?>">
    <label class="control-label" for="settings_gender"><?php echo 'Jenis Kelamin' ?></label>

    <div class="controls">
		<?php $s = ($this->input->post('settings_gender') ? $this->input->post('settings_gender') : (isset($account_details->gender) ? $account_details->gender : '')); ?>
        <select name="settings_gender">
            <option value=""><?php echo '- Select - '; ?></option>
            <option value="m"<?php if ($s == 'm') echo ' selected="selected"'; ?>><?php echo 'Laki-Laki' ?></option>
            <option value="f"<?php if ($s == 'f') echo ' selected="selected"'; ?>><?php echo 'Perempuan' ?></option>
        </select>
    </div>
</div>

<div class="control-group <?php echo (form_error('settings_address')) ? 'error' : ''; ?>">
    <label class="control-label" for="settings_address"><?php echo 'Alamat'; ?></label>

    <div class="controls">
        <?php echo form_textarea(array('name' => 'settings_address','row'=>'3', 'style'=>'height:50px', 'id' => 'settings_address', 'value' => set_value('settings_address') ? set_value('settings_address') : (isset($account_details->address) ? $account_details->address : ''), 'maxlength' => 200)); ?>
        <?php if (form_error('settings_address'))
    {
        ?>
        <span class="help-inline">
                    <?php echo form_error('settings_address'); ?>
                    </span>
        <?php } ?>
    </div>
</div>

<div class="control-group <?php echo (form_error('settings_postalcode')) ? 'error' : ''; ?>">
    <label class="control-label" for="settings_postalcode"><?php echo 'Kode Pos' ?></label>

    <div class="controls">
		<?php echo form_input(array('name' => 'settings_postalcode', 'id' => 'settings_postalcode', 'value' => set_value('settings_postalcode') ? set_value('settings_postalcode') : (isset($account_details->postalcode) ? $account_details->postalcode : ''), 'maxlength' => 40, 'class' => 'input-small')); ?>
		<?php if (form_error('settings_postalcode'))
	{
		?>
        <span class="help-inline">
					<?php echo form_error('settings_postalcode'); ?>
					</span>
		<?php } ?>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-small btn-primary"><?php echo 'Save' ?></button>
    <button type="reset" class="btn btn-small">Cancel</button>
</div>


<?php echo form_close(); ?>


</div>
</div>
</div>

<?php echo $this->load->view('template/footer'); ?>
</body>
</html>