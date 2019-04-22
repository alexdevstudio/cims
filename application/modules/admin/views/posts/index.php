
<div class="row">



  <?php $colors = ['bg-aqua', 'bg-red', 'bg-green', 'bg-yellow', 'bg-primary']; ?>
<?php if ($post_types): ?>
  <?php $i = 0; ?>
  <?php foreach ($post_types as $post_type): ?>
    <?php $i = ($i > 4) ? 0 : $i; ?>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon <?= $colors[$i] ?>"><i class="ion ion-android-menu"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">
            <strong><a class="no-transform f16" href="<?= base_url('admin/post/post_type/'.$post_type->post_type_id) ?>"><?= $post_type->post_type_name ?></a></strong> (<?= $this->db->get_where('languages', ['language_id' => $post_type->post_type_language_id])->row()->language_slug ?>)
          </span>
          <span class="info-box-number"><?= $this->db->get_where('posts', ['post_type' => $post_type->post_type_id])->num_rows() ?> <small>posts</small></span>
        </div>
        <a href="<?= base_url('admin/post/post_type/'.$post_type->post_type_id.'/add') ?>" class="post-type-add-post btn btn-sm pull-right <?= $colors[$i] ?>">Add <i class="fa fa-plus"></i></a>
      </div>
    </div>
  <?php $i++; endforeach; ?>
<?php else: ?>
  <div class="callout callout-warning">
    <h4>You must create at least one Post Type.</h4>
    <p>Go to create your first <a href="<?= base_url('admin/post/post_types/add') ?>">Post Type</a></p>
  </div>
<?php endif; ?>

</div>
