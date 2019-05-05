<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-list-ul"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><a href="<?= site_url('jurusan'); ?>">JURUSAN</a></span>
        <span class="info-box-number"><?= $counts['jurusan']; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-edit"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><a href="<?= site_url('posts'); ?>">ARTIKEL</a></span>
        <span class="info-box-number"><?= $counts['posts']; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-edit"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><a href="<?= site_url('information'); ?>">INFORMASI</a></span>
        <span class="info-box-number"><?= $counts['information']; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-trophy"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><a href="<?= site_url('prestasi'); ?>">PRESTASI</a></span>
        <span class="info-box-number"><?= $counts['prestasi']; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-file"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><a href="<?= site_url('navigations'); ?>">HALAMAN</a></span>
        <span class="info-box-number"><?= $counts['navigations']; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><a href="<?= site_url('gallery/index_album'); ?>">ALBUM FOTO</a></span>
        <span class="info-box-number"><?= $counts['albums']; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-link"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><a href="<?= site_url('links'); ?>">LINKS</a></span>
        <span class="info-box-number"><?= $counts['links']; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  
  
</div>
<!-- /.row -->