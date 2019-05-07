<div class="col-lg-4 sidebar-detail">
  <?php if ($page !== 'information' AND $page !== 'informations') { ?>
  <div class="card">
    <div class="card-header">Pengumuman</div>
    <div class="card-body">
      <ul>

      <?php
      foreach ($information as $row) {
        $id = $row->id;
        $title = $row->title;
        $created_at =  explode(' ', $row->created_at);
        $href = site_url('public/page/index/information/'.$id);

        echo "<li><a href='$href'>$title<a/></li>";
      }
      ?>

      </ul>
    </div>
  </div>
  <?php } else { ?>
  <div class="card">
    <div class="card-header">Berita Terbaru</div>
    <div class="card-body">
      <ul>

      <?php
      foreach ($articles as $row) {
        $id = $row->id;
        $title = $row->title;
        $href = site_url('public/page/index/article/'.$id);

        echo "<li><a href='$href'>$title<a/></li>";
      }
      ?>

      </ul>
    </div>
  </div>
  <?php } ?>

  <div class="card">
    <div class="card-header">Video Profil</div>
    <div class="card-body">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" allowFullScreen="allowFullScreen" src="<?= 'https://www.youtube.com/embed/'.$profile->video.'?ecver=1&amp;iv_load_policy=1&amp;rel=0&amp;yt:stretch=16:9&amp;autohide=1&amp;color=red&amp;width=600&amp;width=600'; ?>" width="600" height="330" allowtransparency="true" frameborder="0"><div><a rel=nofollow id=hqtpHPTV href=https://www.comparetyres.com/help/winter-tyres>winter tyres</a></div><div><a rel=nofollow id=hqtpHPTV href=https://www.fasttyres.co.uk>here</a></div><script>function execute_YTvideo(){return youtube.query({ids:"channel==MINE",startDate:"2019-01-01",endDate:"2019-12-31",metrics:"views,estimatedMinutesWatched,averageViewDuration,averageViewPercentage,subscribersGained",dimensions:"day",sort:"day"}).then(function(e){},function(e){console.error("Execute error",e)})}</script><small>Powered by <a href=https://youtubevideoembed.com/>Embed YouTube Video</a></small></iframe>
      </div>
    </div>
  </div>

  <div class="card card-map">
    <div class="card-header">Lokasi</div>
    <div class="card-body">
      <div class="embed-responsive embed-responsive-16by9">
        <div class="mapouter"><div class="gmap_canvas embed-responsive-item"><iframe width="700" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=smkn%202%20singkawang&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><style>.mapouter{position:relative;text-align:left;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div>
      </div>
    </div>
  </div>
</div>