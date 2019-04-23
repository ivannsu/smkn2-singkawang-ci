<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin - SMK Negeri 2 Singkawang</title>
  <?= link_tag('assets/css/boostrap/bootstrap.min.css'); ?>
  <?= link_tag('assets/fonts/font-awesome/css/font-awesome.min.css'); ?>
  <?= link_tag('assets/fonts/Ionicons/css/ionicons.min.css'); ?>
  <?= link_tag('assets/css/adminlte/AdminLTE.min.css'); ?>
  <?= link_tag('assets/css/adminlte/skin-blue.css'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script src="<?= base_url('assets/js/jquery/jquery-3.3.1.min.js'); ?>"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <a href="" class="logo">
      <span class="logo-mini"><b></b></span>
      <span class="logo-lg">Admin</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu" style="padding: 10px">
        <a href="?>" class="btn btn-link" style="color: white">Change Password</a>
        &nbsp;
        <a href="?>" class="btn btn-danger">Logout</a>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Halaman Navigasi</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Halaman Jurusan</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Halaman Informasi</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Artikel</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Prestasi</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Galeri Foto</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Links</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Data Alumni</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Kepala Sekolah</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Media Sosial</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>Profil</span></a></li>
        <!-- <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> -->
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Title
        <small></small>
      </h1>
    </section>

    <section class="content container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-body">
              <h3>Sample</h3>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Developed by <b><a href="https://ivannsu.com">Ivan</a></b>
    </div>
    <strong>Copyright &copy; 2019 <a href="#">SMK Negeri 2 Singkawang</a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script>

// If there is #ckeditor-textarea, Init CK-Editor
if($('#ckeditor-textarea').length !== 0) {
  CKEDITOR.replace('ckeditor-textarea');
}

</script>

</body>
</html>