<div class="row">

<div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"><?php echo lang('create_group_heading');?></h3>
                </div>
                <div class="box-body">
                  <div id="infoMessage" class="text-red"><?php echo $message;?></div>
<?php echo form_open("admin/create_group");?>

      <div class="form-group">

            <?php echo lang('create_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name);?>
          </div>


      <div class="form-group">

            <?php echo lang('create_group_desc_label', 'description');?> <br />
            <?php echo form_input($description);?>
          </div>

</div>
<div class="box-footer">
  <div class="form-group">
    <button type="submit" class="btn pull-right btn-primary">Create Group</button>
</div>
  <?php echo form_close();?>
</div>
</div>
</div>
</div>
