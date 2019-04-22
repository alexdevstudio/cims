<div class="row">

<div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title">Enter User Information</h3>
                </div>
                <div class="box-body">
                  <div id="infoMessage" class="text-red"><?php echo $message;?></div>


<?php echo form_open("admin/create_user");?>

      <div class="form-group">
            <?php echo lang('create_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>

      </div>

      <div class="form-group">
            <?php echo lang('create_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </div>

      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          $identity['class'] = 'form-control';
          echo form_input($identity);
          echo '</p>';
      }
      ?>

      <div class="form-group">
            <?php echo lang('create_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </div>

      <div class="form-group">
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </div>

      <div class="form-group">
            <?php echo lang('create_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </div>

      <div class="form-group">
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </div>

      <div class="form-group">
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
      </div>

      <div class="box-footer">
                <button type="submit" class="btn btn-primary">Create User</button>
              </div>

<?php echo form_close();?>
</div>
</div>
</div>
</div>
