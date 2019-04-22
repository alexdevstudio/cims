<div class="row">
  <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <i class="fa fa-list"></i>

                <h3 class="box-title">Sitemaps</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-6 text-center">
                     <a href="<?= base_url('sitemap.xml') ?>" target="_blank">Sitemap.xml</a>
                  </div>
                  <div class="col-sm-6 text-center">
                    <?php if (file_exists('sitemap.xml'))
                          echo "<p>Last modified<br><strong> " . date ("F d Y H:i:s.", filemtime('sitemap.xml'))."</strong></p>";
                        else
                          echo "<p class='text-red'>sitemap file does not exist</p>";
                    ?>
                  </div>
                  <div class="col-sm-6 text-center">
                     <a href="<?= base_url('sitemap.xml.gz') ?>" target="_blank">Sitemap.xml.gz</a>
                  </div>
                  <div class="col-sm-6 text-center">
                    <?php if (file_exists('sitemap.xml.gz'))
                          echo "<p>Last modified<br><strong> " . date ("F d Y H:i:s.", filemtime('sitemap.xml.gz'))."</strong></p>";
                        else
                          echo "<p class='text-red'>Sitemap GZ file does not exist</p>";
                    ?>
                  </div>
                  <div class="col-sm-6 text-center">
                     <a href="<?= base_url('ror.xml') ?>" target="_blank">Ror.xml</a>
                  </div>
                  <div class="col-sm-6 text-center">
                    <?php if (file_exists('ror.xml'))
                          echo "<p>Last modified<br><strong> " . date ("F d Y H:i:s.", filemtime('ror.xml'))."</strong></p>";
                        else
                          echo "<p class='text-red'>Ror file does not exist</p>";
                    ?>
                  </div>

                </div>
              </div>
              <div class="box-footer">
                <a
                onclick="return confirm('Are you sure you want to generate new sitemap files?')"
                href="<?= base_url('admin/sitemap/generate') ?>"
                class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Generate</a>
            </div>
            </div>
            <!-- /.box -->
          </div>
          <?php if(file_exists('duplicates.txt')): ?>

          <div class="col-md-6">
                    <div class="box box-danger">
                      <div class="box-header with-border">
                        <i class="fa fa-list"></i>

                        <h3 class="box-title">Duplicate url's</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-12 ">
                             <?php $cont = file_get_contents('duplicates.txt') ?>
                             <?= $cont ?>
                          </div>

                        </div>
                      </div>
                      <div class="box-footer">

                    </div>
                    </div>
                    <!-- /.box -->
                  </div>
                <?php endif; ?>
        </div>
