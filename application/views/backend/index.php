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
  <?= link_tag('assets/css/datatables/dataTables.bootstrap.min.css'); ?>
  <?= link_tag('assets/css/toastr/toastr.min.css'); ?>
  <?= link_tag('assets/css/adminlte/AdminLTE.min.css'); ?>
  <?= link_tag('assets/css/adminlte/skin-blue.css'); ?>
  <?= link_tag('assets/css/backend.css'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script>
  let BASE_URL = '<?= base_url(); ?>'
  </script>
  <script src="<?= base_url('assets/js/jquery/jquery-3.3.1.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/adminlte/adminlte.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datatables/dataTables.bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/toastr/toastr.min.js'); ?>"></script>
  <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
  <script src="<?= base_url('assets/js/backend.js'); ?>"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<!-- SPINNER -->
<div class="loading-container">
  <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>

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
      <div class="navbar-custom-menu">
        <a href="" class="btn btn-link" style="color: white; padding: 15px"><span class="fa fa-key"></span> UBAH PASSWORD</a>
        &nbsp;
        <a href="" class="btn btn-danger" style="padding: 15px; border-radius: 0px;"><span class="fa fa-sign-out"></span> LOGOUT</a>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <li><a href=""><i class="fa fa-link"></i> <span>HALAMAN NAVIGASI</span></a></li>
        <!-- JURUSAN -->
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>JURUSAN</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('jurusan'); ?>">DATA JURUSAN</a></li>
            <li><a href="<?= site_url('jurusan/create'); ?>">TAMBAH BARU</a></li>
          </ul>
        </li>
        <li><a href=""><i class="fa fa-link"></i> <span>HALAMAN INFORMASI</span></a></li>
        <!-- ARTIKEL -->
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>ARTIKEL</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('posts'); ?>">DATA ARTIKEL</a></li>
            <li><a href="<?= site_url('posts/create'); ?>">TAMBAH BARU</a></li>
          </ul>
        </li>
        <!-- PRESTASI -->
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>PRESTASI</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('prestasi'); ?>">DATA PRESTASI</a></li>
            <li><a href="<?= site_url('prestasi/create'); ?>">TAMBAH BARU</a></li>
          </ul>
        </li>
        <li><a href=""><i class="fa fa-link"></i> <span>GALERI FOTO</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>LINKS</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>DATA ALUMNI</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>KEPALA SEKOLAH</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>MEDIA SOSIAL</span></a></li>
        <li><a href=""><i class="fa fa-link"></i> <span>PROFIL</span></a></li>
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
    <section class="content-header" style="padding: 20px 20px 15px 20px; background-color: #fff; border-bottom: 1px solid #ccc;">
      <h1>
        <?= isset($title) ? $title : ''; ?>
        <small>
          <?= isset($sub_title) ? $sub_title : ''; ?>
        </small>
      </h1>
    </section>

    <section class="content container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-body">
              <?php $this->load->view($content); ?>
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

</body>
</html>