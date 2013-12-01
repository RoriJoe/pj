<!DOCTYPE html>
<html>
<head>
    <title>User Management - Pelita Jaya</title>
    <?php echo $this->load->view('template/head_import'); ?>    
</head>
<body>

<?php echo $this->load->view('template/head'); ?>

<div class="container">
  <div class="row">

    <div class="span2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_roles')); ?>
    </div>

    <div class="span10">

      <h2><?php echo 'Manage Roles' ?></h2>

      <div class="alert alert-info" style="margin-bottom: 5px;">
        <?php echo 'Gunakan untuk mengelola <b>Role</b> user dan tentukan <b>Hak Akses</b> untuk tiap Role' ?>
      </div>

      <table class="table table-hover CSSTable" id="tbrole" style="margin-bottom:0px;">
        <thead>
          <tr>
            <th>#</th>
            <th><?php echo 'Role' ?></th>
            <th><?php echo 'User' ?></th>
            <th><?php echo 'Jumlah Hak Akses' ?></th>
            <th>
              <?php if( $this->authorization->is_permitted('create_roles') ): ?>
                <?php echo anchor('account/manage_roles/save', 'Create', 'class="btn btn-primary"'); ?>
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
                  <span class="label label-important"><?php echo 'Banned'; ?></span>
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
                  <span class="label label-info"><?php echo count($role['perm_list']); ?> Permissions</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if( $this->authorization->is_permitted('update_roles') ): ?>
                  <?php echo anchor('account/manage_roles/save/'.$role['id'], 'Update', 'class="btn"'); ?>
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

<script type="text/javascript">
  var oTable = $('#tbrole').dataTable( {
    "sScrollY": "200px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": false,
    "bLengthChange": false,
    "aaSorting": [[ 4, "desc" ]],
    "oLanguage": {
         "sSearch": "Search Role",
         "sLengthMenu": "",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>

</script>
</body>
</html>