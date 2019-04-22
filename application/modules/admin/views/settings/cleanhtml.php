
<?php if ( isset ($string)): ?>
  <div class="well">
    <?php echo $string ?>
  </div>
  <a class="btn btn-success" href="<?= base_url('admin/settings/cleanhtml') ?>">Try Again</a>
<?php else : ?>
  <form class="" action="" method="post">
    <div class="form-group">
    <textarea class="form-control" id="field-post_text" rows="8" cols="80" class="textarea" name="string"></textarea>
    <br>
    <br>
    <button type="submit" name="button" class="btn btn-success">Clean It!</button>
  </div>
  </form>
<?php endif; ?>
