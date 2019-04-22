<div class="row">

<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title">Users  </h3><a class="btn btn-sm pull-right btn-primary" href="<?= base_url('admin/create_user') ?>"><i class="fa fa-plus"></i> Add User</a>
                </div>
                <div class="box-body">
                  <div id="infoMessage" class="text-red"><?php echo $message;?></div>

<table id="dataTable" class="table table-bordered ">
	<thead>
		<tr>
      <th style="text-align: center;">User ID</th>
			<th style="text-align: center;"><?php echo lang('index_fname_th');?></th>
			<th style="text-align: center;"><?php echo lang('index_lname_th');?></th>
			<th style="text-align: center;"><?php echo lang('index_email_th');?></th>
			<th style="text-align: center;"><?php echo lang('index_groups_th');?></th>
			<th style="text-align: center;"><?php echo lang('index_status_th');?> | <?php echo lang('index_action_th');?></th>
		</tr>
	</thead>
<tbody>

	<?php foreach ($users as $user):?>
		<tr>
      <td style="vertical-align: middle; text-align: center;"><?= $user->id ?></td>
            <td style="vertical-align: middle; text-align: center;"><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td style="vertical-align: middle; text-align: center;"><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td style="vertical-align: middle; text-align: center;"><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
      			<td style="vertical-align: middle; text-align: center;">
      				<?php foreach ($user->groups as $group):?>
      					<?php echo anchor("admin/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
              <?php endforeach?>
      			</td>
            <td style="vertical-align: middle; text-align: center;"><?php echo ($user->active) ? "<a href='".base_url('admin/deactivate/'.$user->id)."' class='btn btn-sm btn-warning'>Deactivate</a>"  : "<a href='".base_url('admin/activate/'.$user->id)."' class='btn btn-sm btn-info'>Activate</a>";?>
			<a href='<?= base_url('admin/edit_user/'.$user->id) ?>' class='btn btn-sm btn-success'>Edit</a></td>
		</tr>
	<?php endforeach;?>
</tbody>

</table>

<p><?php echo anchor('admin/create_user', lang('index_create_user_link'))?> | <?php echo anchor('admin/create_group', lang('index_create_group_link'))?></p>
</div>
</div>
</div>
</div>
</div>
<script>

$(function () {
	$('#dataTable').DataTable({
		'paging'      : true,
		'lengthChange': true,
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : true
	})
})

</script>
