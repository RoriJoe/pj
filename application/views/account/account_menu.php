<ul class="nav nav-list" >
  <li class="nav-header">Account Info</li>
  <li class="<?php echo ($current == 'account_profile') ? 'active' : ''; ?>"><?php echo anchor('account/account_profile', 'Manage Profile'); ?></li>
  
  <li class="<?php echo ($current == 'account_settings') ? 'active' : ''; ?>"><?php echo anchor('account/account_settings', 'Account Setting'); ?></li>
  
  <?php if ($account->password) : ?>
    <li class="<?php echo ($current == 'account_password') ? 'active' : ''; ?>"><?php echo anchor('account/account_password', 'Password'); ?></li>
  <?php endif; ?>
  

  <?php if ($this->authorization->is_permitted( array('retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
    <li class="nav-header">Admin Panel</li>
    <?php if ($this->authorization->is_permitted('retrieve_users')) : ?>
      <li class="<?php echo ($current == 'manage_users') ? 'active' : ''; ?>"><?php echo anchor('account/manage_users', 'Manage User'); ?></li>
    <?php endif; ?>

    <?php if ($this->authorization->is_permitted('retrieve_roles')) : ?>
      <li class="<?php echo ($current == 'manage_roles') ? 'active' : ''; ?>"><?php echo anchor('account/manage_roles', 'Manage Roles'); ?></li>
    <?php endif; ?>

    <?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
      <li class="<?php echo ($current == 'manage_permissions') ? 'active' : ''; ?>"><?php echo anchor('account/manage_permissions', 'Manage Permissions'); ?></li>
    <?php endif; ?>
  <?php endif; ?>

</ul>