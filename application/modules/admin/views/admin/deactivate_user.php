<div class="row">

<div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"><?php echo lang('deactivate_heading');?></h3>
                </div>
<div class="box-body">

<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

<?php echo form_open("admin/deactivate/".$user->id);?>

  <p>
  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
    <input type="radio" name="confirm" value="yes" checked="checked" />
    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
    <input type="radio" name="confirm" value="no" />
  </p>

  <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>
</div>
<div class="box-footer">
<button type="submit" class="btn pull-right btn-danger">Deactivate User</button>
</div>
</div>
</div>
</div>

<?php echo form_close();?>
