<div class="row">

<div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title">Enter User Information</h3>
                </div>
                <div class="box-body">
                  <div id="infoMessage" class="text-red"><?php echo $message;?></div>

                <div class="form-group">

<?php echo form_open(uri_string());?>

<div class="form-group">
            <label>Email: </label>
            <input type="text" readonly class="form-control"  value="<?= $email['value'] ?>">
            <small>*Can not be changed</small>
          </div>

<div class="form-group">
            <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
          </div>


    <div class="form-group">
            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </div>

    <div class="form-group">
            <?php echo lang('edit_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </div>

    <div class="form-group">
            <?php echo lang('edit_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </div>



    </div>
  </div>
    </div>
    <div class="box box-primary">
      <div class="box-header with-border">

        <h3 class="box-title">Change Password</h3>
      </div>
      <div class="box-body">
        <div class="form-group">
                <?php echo lang('edit_user_password_label', 'password');?> <br />
                <?php echo form_input($password);?>
          </div>

        <div class="form-group">
                <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
                <?php echo form_input($password_confirm);?>
          </div>
      </div>
  </div>
  </div>
  <div class="col-md-6">
    <div class="box box-primary">
  <?php if ( $this->ion_auth->is_admin()): ?>
    <div class="box-header with-border">

      <h3 class="box-title"><?php echo lang('edit_user_groups_heading');?></h3>
    </div>
    <div class="box-body">

      <div class="form-group">
      <?php foreach ($groups as $group):?>

          <?php
              $gID=$group['id'];
              $checked = null;
              $item = null;
              foreach($currentGroups as $grp) {
                  if ($gID == $grp->id) {
                      $checked= ' checked="checked"';
                  break;
                  }
              }
          ?>
          <div class="checkbox">
            <label>
              <input name="groups[]" value="<?= $group['id'];?>" type="checkbox" <?= $checked ?>>
              <?= htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
            </label>
          </div>
      <?php endforeach?>
    </div>


  <?php endif ?>

  <?php echo form_hidden('id', $user->id);?>
  <?php echo form_hidden($csrf); ?>

  <div class="box-footer">
      <button type="submit" class="btn pull-right btn-primary">Update User</button>
    </div>
  </div>
  </div>
  </div>
<?php echo form_close();?>
</div>
