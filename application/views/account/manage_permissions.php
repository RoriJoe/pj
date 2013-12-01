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
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_permissions')); ?>
    </div>

    <div class="span10">

      <h2><?php echo 'Manage Permission' ?></h2>

      <div class="alert alert-info" style="margin-bottom: 5px;">
        <?php echo 'Gunakan untuk mengelola Hak akses user' ?>
      </div>

      <table class="table table-hover CSSTable" id="tbpermission" style="margin-bottom:0px;">
        <thead>
          <tr>
            <th>#</th>
            <th><?php echo 'Key Permission'; ?></th>
            <th><?php echo 'Deskripsi'; ?></th>
            <th><?php echo 'In Roles'; ?></th>
            <th>
              <?php if( $this->authorization->is_permitted('create_users') ): ?>
                <a href="<?php echo base_url();?>account/manage_permissions/save" class="btn btn-primary">Create<a>
              <?php endif; ?>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $permissions as $perm ) : ?>
            <tr>
              <td><?php echo $perm['id']; ?></td>
              <td>
                <?php echo $perm['key']; ?>
                <?php if( $perm['is_disabled'] ): ?>
                  <span class="label label-important"><?php echo lang('permissions_banned'); ?></span>
                <?php endif; ?>
              </td>
              <td><?php echo $perm['description']; ?></td>
              <td>
                <?php if( count($perm['role_list']) == 0 ) : ?>
                  <span class="label">None</span>
                <?php else : ?>
                  <ul class="inline">
                    <?php foreach( $perm['role_list'] as $itm ) : ?>
                      <li><?php echo anchor('account/manage_roles/save/'.$itm['id'], $itm['name'], 'title="'.$itm['title'].'"'); ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </td>
              <td>
                <?php if( $this->authorization->is_permitted('update_permissions') ): ?>
                  <?php echo anchor('account/manage_permissions/save/'.$perm['id'], lang('website_update'), 'class="btn"'); ?>
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
  var oTable = $('#tbpermission').dataTable( {
    "sScrollY": "400px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": false,
    "bLengthChange": false,
    "aaSorting": [[ 4, "desc" ]],
    "oLanguage": {
         "sSearch": "Search",
         "sLengthMenu": "",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
</body>
</html>