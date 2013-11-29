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
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_roles')); ?>
    </div>

    <div class="span10">

      <h2><?php echo lang('roles_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('roles_page_description'); ?>
      </div>

      <table class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th><?php echo lang('roles_column_role'); ?></th>
            <th><?php echo lang('roles_column_users'); ?></th>
            <th><?php echo lang('roles_permission'); ?></th>
            <th>
              <?php if( $this->authorization->is_permitted('create_roles') ): ?>
                <?php echo anchor('account/manage_roles/save', lang('website_create'), 'class="btn btn-primary btn-small"'); ?>
              <?php endif; ?>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $roles as $role ) : ?>
            <tr>
              <td><?php echo $role['id']; ?></td>
              <td>
                <?php echo $role['name']; ?>
                <?php if( $role['is_disabled'] ): ?>
                  <span class="label label-important"><?php echo lang('roles_banned'); ?></span>
                <?php endif; ?>
              </td>
              <td>
                <?php if( $role['user_count'] > 0 ) : ?>
                  <?php echo anchor('account/manage_users/filter/role/'.$role['id'], $role['user_count'], 'class="badge badge-info"'); ?>
                <?php else : ?>
                  <span class="badge">0</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if( count($role['perm_list']) == 0 ) : ?>
                  <span class="label">No Permissions</span>
                <?php else : ?>
                  <ul class="inline">
                    <?php foreach( $role['perm_list'] as $itm ) : ?>
                      <li><?php echo anchor('account/manage_permissions/save/'.$itm['id'], $itm['key'], 'title="'.$itm['title'].'"'); ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </td>
              <td>
                <?php if( $this->authorization->is_permitted('update_roles') ): ?>
                  <?php echo anchor('account/manage_roles/save/'.$role['id'], lang('website_update'), 'class="btn btn-small"'); ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<?php echo $this->load->view('template/footer'); ?>

</body>
</html>