<div class="row">
  <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <i class="fa fa-list"></i>

                <h3 class="box-title">Latest Posts</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?php if ($posts): ?>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Post Type</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($posts as $post): ?>
                      <tr>
                        <td><?= $post->post_id ?></td>
                        <td style="widtd:50px;">
                          <?php if (isset($post->media_id)): ?>
                            <img src="<?= get_src( $post->media_name, 'thumbs' ) ?>" >
                          <?php else: ?>
                            No Image
                          <?php endif; ?>
                        </td>
                        <td><a href="<?= base_url('admin/post/post_type/'.$post->post_type_id.'/edit/'.$post->post_id) ?>"><?= $post->post_title ?></a></td>
                        <td><a href="<?= base_url('admin/post/post_types/'.$post->post_type_id) ?>"><?= $post->post_type_name ?></a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  </table>
                <?php else: ?>
                  <p class="text-center f16">No posts yet.</p>
                <?php endif; ?>
              </div>
              <div class="box-footer">
                <a href="<?= base_url('admin/post') ?>" class="btn btn-primary pull-right">All Posts <i class="fa fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

          <div class="col-md-6">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <i class="fa  fa-files-o"></i>

                        <h3 class="box-title">Latest Pages</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <?php if ($pages): ?>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Template</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pages as $page): ?>
                              <tr>
                                <td><?= $page->page_id ?></td>
                                <td><a href="<?= base_url('admin/page/index/edit/'.$page->page_id) ?>"><?= $page->page_title ?></a></td>
                                <td><?= $page->page_template_file ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                          </table>
                        <?php else: ?>
                          <p class="text-center f16">No pages yet.</p>
                        <?php endif; ?>
                      </div>
                      <div class="box-footer">
                        <a href="<?= base_url('admin/page') ?>" class="btn btn-primary pull-right">All Pages <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
<div class="clearfix"></div>
                  <div class="col-md-6">
                            <div class="box box-primary">
                              <div class="box-header with-border">
                                <i class="fa fa-table"></i>

                                <h3 class="box-title">Latest Post Types</h3>
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body">
                                <?php if ($post_types): ?>
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Template</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($post_types as $post_type): ?>
                                      <tr>
                                        <td><?= $post_type->post_type_id ?></td>
                                        <td><a href="<?= base_url('admin/post/post_types/index/edit/'.$post_type->post_type_id) ?>"><?= $post_type->post_type_name ?></a></td>
                                        <td><?= $post_type->post_type_file_name ?></td>
                                      </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                                  </table>
                                <?php else: ?>
                                  <p class="text-center f16">No Post Types yet.</p>
                                <?php endif; ?>
                              </div>
                              <div class="box-footer">
                                <a href="<?= base_url('admin/post/post_types') ?>" class="btn btn-primary pull-right">All Post Types <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                              <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                          </div>
                          <div class="col-md-6">
                                    <div class="box box-primary">
                                      <div class="box-header with-border">
                                        <i class="fa fa-cubes"></i>

                                        <h3 class="box-title">Latest Categories</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body">
                                        <?php if ($post_categories): ?>
                                          <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Post Type</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($post_categories as $post_category): ?>
                                              <tr>
                                                <td><?= $post_category->post_category_id ?></td>
                                                <td><a href="<?= base_url('admin/post/categories/index/edit/'.$post_category->post_category_id) ?>"><?= $post_category->post_category_name ?></a></td>
                                                <td><?= $post_category->post_type_name ?></td>
                                              </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                          </table>
                                        <?php else: ?>
                                          <p class="text-center f16">No categories yet.</p>
                                        <?php endif; ?>
                                      </div>
                                      <div class="box-footer">
                                        <a href="<?= base_url('admin/post/categories') ?>" class="btn btn-primary pull-right">All Categories <i class="fa fa-arrow-circle-right"></i></a>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                  </div>

</div>
