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

      <h2><?php echo $action.' Role' ?></h2>

      <div class="alert alert-info" style="margin-bottom: 5px;">
        <?php echo $action.' detail untuk role'; ?>
      </div>

      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

      <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#role" data-toggle="tab">Role Info</a></li>
        <li class=""><a href="#permission" data-toggle="tab">Permission</a></li>
      </ul>

      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="role">
          <div class="control-group <?php echo (form_error('role_name') || isset($role_name_error)) ? 'error' : ''; ?>">
          <label class="control-label" for="role_name"><?php echo 'Nama'; ?></label>

          <div class="controls">
            <?php if( $is_system ) : ?>
              <?php echo form_hidden('role_name', set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : '')); ?>

              <span class="input uneditable-input"><?php echo $role->name; ?></span><span class="help-block" style="color:red;"><?php echo 'Tidak dapat memodifikasi nama Role Sistem'; ?></span>
                <?php else : ?>
                  <?php echo form_input(array('name' => 'role_name', 'id' => 'role_name', 'value' => set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : ''), 'maxlength' => 80)); ?>

                  <?php if (form_error('role_name') || isset($role_name_error)) : ?>
                    <span class="help-inline">
                    <?php
                      echo form_error('role_name');
                      echo isset($role_name_error) ? $role_name_error : '';
                    ?>
                    </span>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
          </div>

          <div class="control-group <?php echo form_error('role_description') ? 'error' : ''; ?>">
              <label class="control-label" for="role_description"><?php echo 'Deskripsi'; ?></label>

              <div class="controls">
                <?php echo form_textarea(array('name' => 'role_description', 'id' => 'role_description', 'value' => set_value('role_description') ? set_value('role_description') : (isset($role->description) ? $role->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

                <?php if (form_error('role_description') || isset($role_name_error)) : ?>
                  <span class="help-inline">
                  <?php
                    echo form_error('role_description');
                  ?>
                  </span>
                <?php endif; ?>
              </div>
          </div>
        </div>
        <div class="tab-pane fade" id="permission">
        <table class="table table-bordered um" style="width:40%;display: inline-block;vertical-align: top;margin-left:20px;">
          <thead>
            <tr>
              <th style="width:125px;">Master</th><th>Access</th><th>Create</th><th>Update</th><th>Delete</th><th>Print</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                Gudang
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_gudang') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Supplier</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_supplier') !== false): ?>
                  <td class="center-um">
                      <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                  </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Pelanggan</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_pelanggan') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Bank</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_bank') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Perkiraan</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_perkiraan') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Barang</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_barang') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Satuan</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_satuan') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
          </tbody>
        </table>
        
        <table class="table table-bordered um" style="width:30%;display: inline-block;vertical-align: top;margin-left:20px;">
          <thead>
            <tr>
              <th style="width:125px;">Laporan</th><th>Access</th><th>Print</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                Sales Order
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_report_sales') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Outstanding Order</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_report_oso') !== false): ?>
                  <td class="center-um">
                      <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                  </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Purchase Order</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_report_purchase') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Outstanding PO</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_report_ospo') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Mutasi</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_report_mutasi') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Kartu Stock</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_report_ks') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Penerimaan</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_report_terima') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Surat Jalan</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_report_sj') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
          </tbody>
        </table>

        <table class="table table-bordered um" style="width:40%;display: inline-block;vertical-align: top;margin-left:20px;">
          <thead>
            <tr>
              <th style="width:125px;">Transaksi</th><th>Access</th><th>Create</th><th>Update</th><th>Delete</th><th>Print</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                Sales Order
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_so') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Pemesanan</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_po') !== false): ?>
                  <td class="center-um">
                      <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                  </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Surat Jalan</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_surat_jalan') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Penerimaan</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_penerimaan') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Invoice</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_invoice') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Terima Tagihan</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_tagihan') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Pembayaran</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_bayar') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Transaksi Jurnal</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_tr_jurnal') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Buku Besar</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_buku_besar') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Rugi Laba</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_rugi_laba') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Neraca</td>
              <?php foreach( $permissions as $perm ) : ?>
                <?php
                  $check_it = FALSE;

                  if( isset($role_permissions) )
                  {
                    foreach( $role_permissions as $rperm )
                    {
                      if( $rperm->id == $perm->id )
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                ?>
                <?php if(strpos($perm->key, '_neraca') !== false): ?>
                      <td class="center-um">
                          <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                      </td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
          </tbody>
        </table>
        
        <div style="width:50%;display: inline-block;vertical-align: top;margin-left:20px;">
          <table class="table table-bordered um" style="display: inline-block;vertical-align: top;">
            <thead>
              <tr>
                <th style="width:125px;">Maintenance</th><th>Access</th><th>Create</th><th>Update</th><th>Delete</th><th>Print</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Stock Opname
                <?php foreach( $permissions as $perm ) : ?>
                  <?php
                    $check_it = FALSE;

                    if( isset($role_permissions) )
                    {
                      foreach( $role_permissions as $rperm )
                      {
                        if( $rperm->id == $perm->id )
                        {
                          $check_it = TRUE; break;
                        }
                      }
                    }
                  ?>
                  <?php if(strpos($perm->key, '_stock') !== false): ?>
                        <td class="center-um">
                            <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                        </td>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tr>
            </tbody>
          </table>

          <table class="table table-bordered um" style="display: inline-block;vertical-align: top;">
            <thead>
              <tr>
                <th colspan="6" style="text-align:center">User Management</th>
              </tr>
              <tr>
                <th style="width:125px;">Panel</th><th>Create</th><th>Access</th><th>Update</th><th>Delete</th><th>Banned User</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Account Setting
                </td><td>&nbsp;</td><td>&nbsp;</td>
                <?php foreach( $permissions as $perm ) : ?>
                  <?php
                    $check_it = FALSE;

                    if( isset($role_permissions) )
                    {
                      foreach( $role_permissions as $rperm )
                      {
                        if( $rperm->id == $perm->id )
                        {
                          $check_it = TRUE; break;
                        }
                      }
                    }
                  ?>
                  <?php if(strpos($perm->key, '_setting') !== false): ?>
                        <td class="center-um">
                            <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                        </td>
                  <?php endif; ?>
                <?php endforeach; ?>
                <td>&nbsp;</td><td>&nbsp;</td>
              </tr>
              <tr>
                <td>Manage Roles</td>
                <?php foreach( $permissions as $perm ) : ?>
                  <?php
                    $check_it = FALSE;

                    if( isset($role_permissions) )
                    {
                      foreach( $role_permissions as $rperm )
                      {
                        if( $rperm->id == $perm->id )
                        {
                          $check_it = TRUE; break;
                        }
                      }
                    }
                  ?>
                  <?php if(strpos($perm->key, '_role') !== false): ?>
                        <td class="center-um">
                            <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                        </td>
                  <?php endif; ?>
                <?php endforeach; ?>
                <td></td>
              </tr>
              <tr>
                <td>Manage Users</td>
                <?php foreach( $permissions as $perm ) : ?>
                  <?php
                    $check_it = FALSE;

                    if( isset($role_permissions) )
                    {
                      foreach( $role_permissions as $rperm )
                      {
                        if( $rperm->id == $perm->id )
                        {
                          $check_it = TRUE; break;
                        }
                      }
                    }
                  ?>
                  <?php if(strpos($perm->key, '_user') !== false): ?>
                        <td class="center-um">
                            <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                        </td>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tr>
              <tr>
                <td>Manage Permissions</td>
                <?php foreach( $permissions as $perm ) : ?>
                  <?php
                    $check_it = FALSE;

                    if( isset($role_permissions) )
                    {
                      foreach( $role_permissions as $rperm )
                      {
                        if( $rperm->id == $perm->id )
                        {
                          $check_it = TRUE; break;
                        }
                      }
                    }
                  ?>
                  <?php if(strpos($perm->key, '_permission') !== false): ?>
                        <td class="center-um">
                            <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, 'title="'.$perm->description.'"'); ?>
                        </td>
                  <?php endif; ?>
                <?php endforeach; ?>
                <td>&nbsp;</td>
              </tr>
            </tbody>
          </table>  
        </div>
        </div>
      </div>

      <div class="form-actions">
        <?php echo form_submit('manage_role_submit', 'Save', 'class="btn btn-primary"'); ?>
        <?php echo anchor('account/manage_roles', 'Cancel', 'class="btn"'); ?>
        <?php if( $this->authorization->is_permitted('delete_roles') && $action == 'update' && ! $is_system ): ?>
          <span><?php echo lang('admin_or');?></span>
          <?php if( isset($role->suspendedon) ): ?>
            <?php echo form_submit('manage_role_unban', 'Unbanned', 'class="btn btn-danger"'); ?>
          <?php else: ?>
            <?php echo form_submit('manage_role_ban', 'Banned', 'class="btn btn-danger"'); ?>
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