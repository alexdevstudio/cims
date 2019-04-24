<!DOCTYPE html>
<html lang="<?= $lang ?>">
  <head>
  <meta charset="utf-8">
  <link rel="canonical" href="<?= (current_url() == base_url() ? base_url() : get_url($item_type, $item_id)) ?>" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $meta_title ?></title>
  <meta name="description" content="<?= $meta_description ?>">
  <meta name="keywords" content="<?= $meta_keywords ?>">
  <meta property="og:title" content="<?= ($og_title != '') ? $og_title : $meta_title ?>">
  <meta property="og:description" content="<?= ($og_description != '') ? $og_description : $meta_description ?>">
  <?php if($og_image) :  ?>
    <meta property="og:image" content="<?= $og_image ?>">
  <?php endif; ?>
  <meta property="og:url" content="<?= urldecode(current_url()) ?>">
  <meta name="twitter:title" content="<?= ($og_title != '') ? $og_title : $meta_title ?>">
  <meta name="twitter:description" content="<?= ($og_description != '') ? $og_description : $meta_description ?>">
  <?php if($og_image) :  ?>
    <meta name="twitter:image" content="<?= $og_image ?>">
  <?php endif; ?>
  <meta name="twitter:card" content="summary_large_image">
<link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZZXC_C9YhiFQ_kZgKf-m9y5oLH-l-MxNtD9aI8Uln1kKsYnXk" />

  <title>CiMS - New Era CMS Built For Performance and SEO</title>

  <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?= get_assets() ?>css/prism.css">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>">CiMS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= base_url() ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= get_url('post_type', 3) ?>">Pages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= get_url('post_type', 4) ?>">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= get_url('post_type', 5) ?>">Post Types</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= get_url('post_type', 6) ?>">Categories</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

<?php if ($item_type == 'page' && $item_id == 1): ?>
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">CiMS for Web Developers</h1>
        <p class="lead">New Era CMS built for <strong>Performance</strong> and <strong>1st Page SERP</strong></p>

      </div>
    </div>
  </div>
<?php else: ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5"><?= $title ?></h1>
        <p class="lead"><?= $meta_description ?></p>
        <hr>

      </div>
    </div>
  </div>
<?php endif; ?>
