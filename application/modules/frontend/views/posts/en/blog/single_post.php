
<div class="col-sm-9">
    <article class="">
      <header class="">
        <h1><?= $title ?></h1>
        <time class="" datetime="<?= $post->post_updated_at; ?>" pubdate>Updated: <?= date("d M Y", strtotime( $post->post_updated_at ) );  ?></time>
        <figure class="">
            <img src="<?= base_url("assets/uploads/".$post->media_name); ?>"
              alt="<?= $post->media_alt_text ?>"
              title="<?= $post->media_title ?>" />
          <figcaption><?= $post->media_title ?></figcaption>
        </figure>

      </header>
    <?= $content ?>
        <footer class="clearfix">

      </footer>
    </article>
    </div>
    <div class="col-sm-3">
    Widgets go here
    </div>
     