<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= (isset($title)) ? $title. ' | ' : '' ?>CiMS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/dist/css/style.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
  <?php
      //Add extra css files
      if(isset($css_files)) :
        foreach($css_files as $file): ?>
          <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach;
      endif;
   ?>
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?= base_url(); ?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('admin') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?= base_url('') ?>assets/admin/img/logo_light_180_75.png"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?= base_url('') ?>assets/admin/img/logo_light_180_75.png"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li  class="<?= ($this->uri->segment(2)=='page' && !$this->uri->segment(3)) ? 'active' : '' ?>">
            <a href="<?= base_url('admin/page') ?>" >PAGES</a>
          </li>
          <li  class="<?= ($this->uri->segment(2)=='post' && !$this->uri->segment(3)) ? 'active' : '' ?>">
            <a href="<?= base_url('admin/post') ?>" >POSTS</a>
          </li>
          <li  class="<?= ($this->uri->segment(2)=='media' && !$this->uri->segment(3)) ? 'active' : '' ?>">
            <a href="<?= base_url('admin/media') ?>"   >MEDIA</a>
          </li>
          <li  class="<?= ($this->uri->segment(2)=='post' && $this->uri->segment(3) == 'categories') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/post/categories') ?>"  >CATEGORIES</a>
          </li>
          <li  class="<?= ($this->uri->segment(2)=='post' && $this->uri->segment(3) == 'post_types') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/post/post_types') ?>"   >POST TYPES</a>
          </li>
          <li class="active"><a href="<?= base_url() ?>" target="_blank" ><?= base_url() ?></a> </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url(); ?>assets/admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alex Dev</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url(); ?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                  Alex Dev - Web Developer
                  <small>Since Nov. 2018</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url(); ?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alex Dev</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?= ($this->uri->segment(2)=='') ? 'active' : '' ?>"><a href="<?= base_url('admin'); ?>"><i class="fa fa-dashboard "></i> <span>Dashboard</span></a></li>

        <li class="treeview <?= ($this->uri->segment(2)=='page') ? 'menu-open' : '' ?>">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display:<?= ($this->uri->segment(2)=='page') ? 'block' : 'none' ?>">
            <li class="<?= ($this->uri->segment(2)=='page' && $this->uri->segment(5)=='') ? 'active' : '' ?>"><a href="<?= base_url('admin/page'); ?>"><i class="fa fa-list"></i> All Pages</a></li>
            <li class="<?= ($this->uri->segment(2)=='page' && $this->uri->segment(5)=='add') ? 'active' : '' ?>"><a href="<?= base_url('admin/page/index/new/add'); ?>"><i class="fa fa-pencil-square-o"></i> New Page</a></li>
          </ul>
        </li>
        <li class="treeview <?= ($this->uri->segment(2)=='post') ? 'menu-open' : '' ?>">
          <a href="#">
            <i class="fa fa-align-right"></i> <span>Posts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display:<?= ($this->uri->segment(2)=='post') ? 'block' : 'none' ?>">
            <li class="<?= ($this->uri->segment(2)=='post' && $this->uri->segment(5)=='' && $this->uri->segment(3)=='') ? 'active' : '' ?>"><a href="<?= base_url('admin/post'); ?>"><i class="fa fa-list"></i> All Posts</a></li>
            <!-- <li class="<?= ($this->uri->segment(2)=='post' && ($this->uri->segment(4)=='add' || $this->uri->segment(5) =='add') && $this->uri->segment(3)!='categories' && $this->uri->segment(3)!='post_types' && $this->uri->segment(3) != 'custom_fields' ) ? 'active' : '' ?>"><a href="<?= base_url('admin/post/index/new/add'); ?>"><i class="fa fa-pencil-square-o"></i> New Post</a></li> -->
            <li class="<?= ($this->uri->segment(2)=='post' && $this->uri->segment(3)=='categories') ? 'active' : '' ?>"><a href="<?= base_url('admin/post/categories'); ?>"><i class="fa fa-cubes"></i> Categories</a></li>
            <li class="<?= ($this->uri->segment(2)=='post' && $this->uri->segment(3)=='post_types') ? 'active' : '' ?>"><a href="<?= base_url('admin/post/post_types'); ?>"><i class="fa fa-table"></i> Post Types</a></li>
            <li class="<?= ($this->uri->segment(2)=='post' && $this->uri->segment(3)=='custom_fields') ? 'active' : '' ?>"><a href="<?= base_url('admin/post/custom_fields'); ?>"><i class="fa fa-object-ungroup"></i> Custom Fields</a></li>
          </ul>
        </li>
        <li class="<?= ($this->uri->segment(2)=='media') ? 'active' : '' ?>"><a href="<?= base_url('admin/media'); ?>"><i class="fa fa-image"></i> Media</a></li>
        <li class="treeview <?= ($this->uri->segment(2)=='users' || $this->uri->segment(2)=='user' || $this->uri->segment(2)=='edit_user' || $this->uri->segment(2)=='groups' || $this->uri->segment(2)=='edit_group' || $this->uri->segment(2)=='create_group' ) ? 'menu-open' : '' ?>">
          <a href="#">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display:<?= ($this->uri->segment(2)=='users'  || $this->uri->segment(2)=='edit_user' || $this->uri->segment(2)=='user' || $this->uri->segment(2)=='groups' || $this->uri->segment(2)=='edit_group' || $this->uri->segment(2)=='create_group' ) ? 'block' : 'none' ?>">
            <li class="<?= ($this->uri->segment(2)=='users' && $this->uri->segment(3)=='') ? 'active' : '' ?>"><a href="<?= base_url('admin/users'); ?>"><i class="fa fa-users"></i> All Users</a></li>
            <li class="<?= ($this->uri->segment(2)=='user' && $this->uri->segment(3)=='create') ? 'active' : '' ?>"><a href="<?= base_url('admin/user/create'); ?>"><i class="fa fa-plus"></i> New User</a></li>
            <li class="<?= ($this->uri->segment(2)=='groups' ) ? 'active' : '' ?>"><a href="<?= base_url('admin/groups'); ?>"><i class="fa fa-cubes"></i> Groups</a></li>
            <li class="<?= ($this->uri->segment(2)=='create_group') ? 'active' : '' ?>"><a href="<?= base_url('admin/create_group'); ?>"><i class="fa fa-plus"></i> New Group</a></li>
          </ul>
        </li>
        <li class="treeview <?= ($this->uri->segment(2)=='settings') ? 'menu-open' : '' ?>">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display:<?= ($this->uri->segment(2)=='settings') ? 'block' : 'none' ?>">
            <li class="<?= ($this->uri->segment(2)=='settings' && $this->uri->segment(3)=='general') ? 'active' : '' ?>"><a href="<?= base_url('admin/settings/general'); ?>"><i class="text-red fa fa-circle-o"></i> General</a></li>
            <li class="<?= ($this->uri->segment(2)=='settings' && $this->uri->segment(3)=='languages') ? 'active' : '' ?>"><a href="<?= base_url('admin/settings/languages'); ?>"><i class="text-green fa fa-circle-o"></i> Languages</a></li>
            <!-- <li class="<?= ($this->uri->segment(2)=='settings' && $this->uri->segment(3)=='post_types') ? 'active' : '' ?>"><a href="<?= base_url('admin/settings/post_types'); ?>"><i class="text-orange fa fa-circle-o"></i> Post Types</a></li> -->
          </ul>
        </li>
        <?php
        $current_url = current_url();
        $current_url = str_replace("/", "^%^", $current_url);
        $current_url = urlencode($current_url);
       ?>
        <li><a href="<?= base_url('admin/clear_cache/'.$current_url) ?> " onclick="return confirm('Are you sure you want to clean all Cache files ?')"><i class="fa fa-ban"></i> <span>Clear Cache</span></a></li>
        <li><a href="<?= base_url('admin/sitemap/') ?> " ><i class="fa fa-sitemap"></i> <span>Sitemaps</span></a></li>

        <li><a href="<?= base_url('admin/logout') ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        <hr>
        <li><a href="<?= base_url('') ?>" target="_blank"><i class="fa fa-globe"></i> <span>View Frontend</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <?php if( $this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p><i class="icon fa fa-check"></i> <?= $this->session->flashdata('success'); ?>!</p>
            </div>
    <?php endif; ?>
      <h1>
        <?= (isset($title) ? $title : '') ?>
        <!-- <small>Control panel</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
