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

      <h2><?php echo 'Manage User' ?></h2>

      <div class="alert alert-info">
        <?php echo 'Update detail akun untuk user atau buat akun baru' ?>
      </div>

      <?php if( count($all_accounts) > 0 ) : ?>
        <table class="table table-condensed table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo 'Username' ?></th>
              <th><?php echo 'Email' ?></th>
              <th><?php echo 'Nama Depan' ?></th>
              <th><?php echo 'Nama Belakang' ?></th>
              <th>
                <?php if( $this->authorization->is_permitted('create_users') ): ?>
                  <a href="<?php echo base_url(); ?>account/manage_users/save" class="btn btn-primary btn-small"><?php echo lang('website_create'); ?><a>
                <?php endif; ?>
              </th>
            </tr>
          </thead>
          <tbody>

            <?php foreach( $all_accounts as $acc ) : ?>
              <tr>
                <td><?php echo $acc['id']; ?></td>
                <td>
                  <?php echo $acc['username']; ?>
                  <?php if( $acc['is_banned'] ): ?>
                    <span class="label label-important"><?php echo 'Banned' ?></span>
                  <?php elseif( $acc['is_admin'] ): ?>
                    <span class="label label-info"><?php echo 'Admin' ?></span>
                  <?php endif; ?>
                </td>
                <td><?php echo $acc['email']; ?></td>
                <td><?php echo $acc['firstname']; ?></td>
                <td><?php echo $acc['lastname']; ?></td>
                <td>
                  <?php if( $this->authorization->is_permitted('update_users') ): ?>
                    <a href="<?php echo base_url(); ?>account/manage_users/save/<?php echo $acc['id']; ?>" class="btn btn-small"><?php echo 'Update' ?><a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php echo $this->load->view('template/footer'); ?>

</body>
</html>