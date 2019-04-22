<?php
  ($this->uri->segment(3) == 'index' && $this->uri->segment(4) == '' ? redirect(base_url('admin/media')) : '') 
 ?>
<?php if($this->uri->segment(3) == '') : ?>
<form action="media/upload"  class="dropzone" method="post" enctype="multipart/form-data">
</form>
<?php endif; ?>
<?php echo $output; ?>
