<div class="col-sm-12">
  <?= $content ?>
  <hr>
</div>


<div class="col-sm-9">
<?php $categories = getPostCategories("Post Types"); ?>
<?php if($categories) : ?>
<h2>Categories</h2>
<?php
//Category Loop
foreach ($categories as $category) : ?>
<article class="">
                              <div class=""> <img src="<?=  base_url("assets/uploads/".$category->media_name) ?>" alt="<?=  $category->media_alt_text ?>" title="<?=  $category->media_title ?>"> </div>
                              <div class="">
                                <header class="">
                                  <div class="">
                                    <div class=""> <a href="<?= get_url("post_category", $category->post_category_id) ?>"></a></div>
                                  </div>
                                  <h3 class=""> <a href="<?= get_url("post_category", $category->post_category_id) ?>" ><?= $category->post_category_name ?></a> </h3>
                                </header>
                                <div class="">
                                  <p><?= $category->post_category_meta_description ?></p>
                                </div>
                              </div>
                              <footer class="">
                                <div class=""> <span>
                                <a href="<?= get_url("post_category", $category->post_category_id) ?>">
                                  View Posts
                                </a>
                              </span> </div>
                              </footer>
                            </article>
<?php endforeach; ?>
<?php endif; ?>

<h2>Posts</h2>

<?php
//Post Loop
          if($posts) :
              foreach ($posts as $post) :
                $post_url = get_url("post",$post->post_id) ;
                ?>
                <article class="">
                  <header class="">
                    <h2><a href="<?= $post_url ?>"><?= $post->post_title ?></a></h2>
                    <time class="" datetime="<?= $post->post_updated_at; ?>" pubdate>Updated: <?= date("d M Y", strtotime( $post->post_updated_at ) );  ?></time>
                    <figure class="">
                      <a href="<?= $post_url ?>">
                        <img src="<?= base_url("assets/uploads/".$post->media_name); ?>"
                          alt="<?= $post->media_alt_text ?>"
                          title="<?= $post->media_title ?>" />
                      </a>
                      <figcaption><?= $post->media_title ?></figcaption>
                    </figure>

                  </header>
                  <p><?=  (strlen(strip_tags($post->post_text)) > 320 ) ? mb_substr(strip_tags($post->post_text), 0, 320)."..." : $post->post_text ; ?></p>
                    <footer class="clearfix">
                        <a href="<?= $post_url ?>" class="btn btn-primary">Read more</a>

                  </footer>
                </article>
                <?php
              endforeach;
          else :   ?>

            <h3 class="text-center">Δεν βρέθηκαν αποτελέσματα.</h3>
            <?php endif;  ?>
</div>
<div class="col-sm-3">
  Widgets go here
</div>
  