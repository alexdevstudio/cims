<div class="col-sm-12">
  <?= $content ?>
  <hr>
  </div>


  <div class="col-sm-9">
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
  <div class="widget">
  <h3 class="widget-title">Categories</h3>
  <hr class="">

<?php $categories = getPostCategories($post_type->post_type_name); ?>
    <?php if($categories) : ?>
          <ul class="list1 no-bullets">
              <?php foreach ($categories as $category) : ?>
              <li>
                   <a href="<?= get_url("post_category", $category->post_category_id) ?>" class="text-center"><img class="img-responsive" src="<?= base_url("assets/uploads/".$category->media_name) ?>" alt="<?= $category->media_alt_text?>" title="<?= $category->media_title?>">
                   <h5 class="mt1"><?= $category->post_category_name ?></h5></a>
              </li>
           <?php endforeach; ?>
         </ul>
    <?php endif; ?>
  </div>
</div>
  