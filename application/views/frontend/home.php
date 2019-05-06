<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="<?= base_url('media_library/images/icon.ico'); ?>" type="image/x-icon">
  <title><?= $profile->name; ?></title>
  <?= link_tag('assets/boostrap4/bootstrap.min.css'); ?>
  <?= link_tag('assets/slick/slick.css'); ?>
  <?= link_tag('assets/slick/slick-theme.css'); ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <?= link_tag('assets/css/frontend.css'); ?>
</head>
<body>

  <header class="header">
    <div class="container">
      <h1>
        <a href="<?= site_url('public/home'); ?>">
          <?php if ($profile->img_header) { ?>
            <img src="<?= base_url('media_library/profile/'.$profile->img_header); ?>" alt="Logo <?= $profile->name; ?>" class="img-logo" />
          <?php 
          } else {
            echo '<p class="text-center" style="padding: 5%">'.$profile->name.'</p>';
          }
          ?>
        </a>
      </h1>
    </div>
  </header>

  <nav class="navbar navbar-expand-lg custom-nav">
    <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#"><span class="fas fa-home"></span> Home</a>
        </li>

        <?php

        foreach($navigations['single'] as $nav) {
          echo '
            <li class="nav-item">
              <a class="nav-link" href="'
              . site_url('pages/'.$nav['post_id'])
              . '">'
              . $nav['post_title']
              . '</a>
            </li>
          ';
        }

        foreach($navigations['dropdown'] as $dropdown) {
          echo '
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                '
                .$dropdown['nav_title']
                .'
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          ';

          foreach($dropdown['navs'] as $dropdown_child) {
            echo '
              <a class="dropdown-item" href="'
              . site_url('pages/'.$dropdown_child['post_id'])
              . '">'
              . $dropdown_child['post_title']
              . '</a>
            ';
          }
          echo '</div></li>';
        }
        
        ?>
        <a class="nav-link" href="<?= site_url("/page.php?name=prestasi_list"); ?>">Prestasi</a>
        <a class="nav-link" href="<?= site_url("/page.php?name=gallery"); ?>">Gallery</a>
        <a class="nav-link" href="<?= site_url("/page.php?name=alumni"); ?>">Alumni</a>
      </ul>
    </div>
  </div>
  </nav>

  <section class="section-slide">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          
          <div class="slider">
          <?php
          foreach ($slideshow as $row) {
            $id = $row->id;
            $title = $row->title;
            $created_at = $row->created_at;
            $image = ($row->image) ? 'lg_'.$row->image : 'placeholder.png';

            $vars = [
              '%title%' => $title,
              '%created_at%' => $created_at,
              '%img_src%' => base_url("media_library/posts/$image"),
              '%img_alt%' => "$title image",
              '%href%' => '#'
            ];

            $template = '
            <div class="slide-box">
              <img src="%img_src%" alt="%img_alt%" class="slide-box-image">
              <a href="%href%">
                <div class="slide-box-body">
                  <h6>%title% &rarr;</h6>
                </div>
              </a>
            </div>
            ';
    
            echo strtr($template, $vars);
          }
          ?>
          </div>

        </div>
        <div class="col-lg-4">
          <div class="info-box">
            <h5>Pengumuman</h5>    
            <ul>
            <?php
            foreach ($information as $row) {
              $id = $row->id;
              $title = $row->title;
              $created_at =  explode(' ', $row->created_at);

              $vars = [
                '%href%' => '#',
                '%title%' => $title,
                '%date%' => dateformat($created_at[0]),
                '%time%' => timeformat($created_at[1]),
              ];
              $template = '
                <li style="margin-bottom: 15px">
                  <a href="%href%">%title%</a>
                  <br/>
                  <small>
                    <span class="fas fa-calendar-alt"></span> %date%&nbsp; | &nbsp;<span class="fas fa-clock"></span> %time%
                  </small>
                </li>
              ';
      
              echo strtr($template, $vars);
            }
            ?>
            </ul>
            <hr/>
            <div class="text-center">
              <p>
              <a href="#" class="btn btn btn-outline-primary">Selengkapnya &rarr;</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-links">
    <div class="container">
      <div class="section-heading">
        <h3>LINKS</h3>
      </div>

      <div class="horizontal-slide">
      <?php
      foreach ($links as $row) {
        $name = $row->name;
        $link = $row->href;
        $image = $row->image;

        $vars = [
          '%link%' => $link,
          '%img_src%' => base_url('media_library/links/'.$image),
          '%img_alt%' => "$name Link"
        ];
        $template = '<a href="%link%"><img src="%img_src%" class="link-image" alt="%img_alt%"></a>';

        echo strtr($template, $vars);
      }
      ?>
      </div>

    </div>
  </section>

  <section class="section-articles">
    <div class="container">
      <div class="section-heading">
        <h3>NEWS</h3>
      </div>
      <div class="row">
        
        <?php
        foreach ($articles as $row) {
          $id = $row->id;
          $title = $row->title;
          $created_at =  explode(' ', $row->created_at);
          $image = ($row->image) ? 'md_'.$row->image : 'placeholder.png';

          $vars = [
            '%title%' => $title,
            '%img_src%' => base_url("media_library/posts/$image"),
            '%img_alt%' => "$title image",
            '%href%' => '#',
            '%date%' => dateformat($created_at[0]),
            '%time%' => timeformat($created_at[1]),
          ];
          $template = '
          <div class="col-lg-3">
            <div class="article-box">
              <a href="%href%">
                <div class="article-box-image-container">
                  <img src="%img_src%" alt="%img_alt%" class="article-box-image" />
                </div>
                <div class="article-box-body">
                  <h5 class="article-heading">%title%</h4>
                  <div>
                    <small>
                      <span class="fas fa-calendar-alt"></span> %date%&nbsp; | &nbsp;<span class="fas fa-clock"></span> %time%
                    </small>
                  </div>
                </div>
              </a>
            </div>
          </div>
          ';

          echo strtr($template, $vars);
        }
        ?>

      </div>
      <div class="section-bottom">
        <div class="text-center">
          <a href="#" class="btn btn-primary btn-large btn-section">Selengkapnya &rarr;</a>
        </div>
      </div>
    </div>
  </section>

  <section class="section-jurusan">
    <div class="container">
      <div class="section-heading">
        <h3>Jurusan</h3>
      </div>
      <div class="row">

      <?php
      foreach ($jurusan as $row) {
        $id = $row->id;
        $name = $row->title;
        $image = ($row->image) ? 'md_'.$row->image : 'placeholder.png';

        $vars = [
          '%name%' => $name,
          '%img_src%' => base_url("media_library/jurusan/$image"),
          '%img_alt%' => "Logo Jurusan $name",
          '%href%' => '#'
        ];
        $template = '
          <div class="col-lg-2">
            <a href="%href%">
            <img src="%img_src%" alt="%img_alt%" style="width: 100%" />
            <h5 class="text-center" style="margin-top: 20px">%name%</h5>
            </a>
          </div>
        ';

        echo strtr($template, $vars);
      }
      ?>

      </div>
    </div>
  </section>

  <section class="section-headmaster">
    <div class="container">
      <div class="section-heading">
        <h3>KEPALA SEKOLAH</h3>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <img src="<?= base_url('media_library/profile/md_'.$headmaster->image); ?>" alt="Foto Kepala Sekolah" />
        </div>
        <div class="col-lg-4 m-margin-top">
          <h4><?= $headmaster->name; ?></h4>
          <br>
          <p class="blockquote">
            <?= $headmaster->content; ?>
          </p>
        </div>
      </div>

    </div>
  </section>

  <section class="section-gallery">
    <div class="container">
      <div class="section-heading">
        <h3>Gallery</h3>
      </div>
      <div class="row">
        
      <?php
      foreach ($photos as $row) {
        $img_src = base_url('media_library/gallery/lg_'.$row->image);
        $img_thumb = base_url('media_library/gallery/sm_'.$row->image);

        $vars = [
          '%photo%' => '<a data-fancybox="gallery" href="'.$img_src.'"><img src="'.$img_thumb.'" class="img-thumbnail" alt="Foto"></a>'
        ];
        $template = '
        <div class="col-lg-2" style="margin-bottom: 20px">
          %photo%
        </div>
        ';

        echo strtr($template, $vars);
      }
      ?>

      </div>
    </div>
  </section>

  <!-- ( BUG ): CSS Class Not Affected-->
  <section class="section-profile-video" style="padding: 60px 0;">
    <div class="container">
      <div class="section-heading">
        <h3>Video & Sosial Media</h3>
      </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe 
              class="embed-responsive-item" 
              allowFullScreen="allowFullScreen" 
              src="<?= 'https://www.youtube.com/embed/'.$profile->video.'?ecver=1&amp;iv_load_policy=1&amp;rel=0&amp;yt:stretch=16:9&amp;autohide=1&amp;color=red&amp;width=600&amp;width=600'; ?>" 
              width="600" height="330" 
              allowtransparency="true" frameborder="0">
              <div><a rel=nofollow id=hqtpHPTV href=https://www.comparetyres.com/help/winter-tyres>winter tyres</a></div><div><a rel=nofollow id=hqtpHPTV href=https://www.fasttyres.co.uk>here</a></div><script>function execute_YTvideo(){return youtube.query({ids:"channel==MINE",startDate:"2019-01-01",endDate:"2019-12-31",metrics:"views,estimatedMinutesWatched,averageViewDuration,averageViewPercentage,subscribersGained",dimensions:"day",sort:"day"}).then(function(e){},function(e){console.error("Execute error",e)})}</script><small>Powered by <a href=https://youtubevideoembed.com/>Embed YouTube Video</a></small>
            </iframe>
          </div>
        </div>
        <div class="col-lg-4 m-margin-top">
          <?php

          $sc_mail = $profile->email;
          $sc_facebook = $profile->facebook;
          $sc_twitter = $profile->twitter;
          $sc_youtube = $profile->youtube;
          $sc_instagram = $profile->instagram;

          if ($sc_mail) echo '<h5><span class="fa custom-icon-media fa-envelope"></span> '.$sc_mail.'</h5>';
          if ($sc_facebook) echo '<h5><span class="fab custom-icon-media fa-facebook"></span> '.$sc_facebook.'</h5>';
          if ($sc_twitter) echo '<h5><span class="fab custom-icon-media fa-twitter"></span> '.$sc_twitter.'</h5>';
          if ($sc_youtube) echo '<h5><span class="fab custom-icon-media fa-youtube"></span> '.$sc_youtube.'</h5>';
          if ($sc_instagram) echo '<h5><span class="fab custom-icon-media fa-instagram"></span> '.$sc_instagram.'</h5>';

          ?>
        </div>
      </div>
    </div>
  </section>

  <section class="section-location-profile">
    <div class="container">
      <div class="section-heading">
        <h3>Lokasi</h3>
      </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="embed-responsive embed-responsive-16by9">
            <div class="mapouter"><div class="gmap_canvas embed-responsive-item"><iframe width="700" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=smkn%202%20singkawang&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><style>.mapouter{position:relative;text-align:left;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div>
          </div>
        </div>
        <div class="col-lg-4 m-margin-top">
          <h6>Alamat: </h6>
          <p><?= $profile->address; ?></p>

          <h6>No Telpon: </h6>
          <p><?= $profile->phone; ?></p>

          <h6>Email: </h6>
          <p><?= $profile->email; ?></p>

          <h6>Kode POS: </h6>
          <p><?= $profile->pos; ?></p>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <p>Copyright &copy; 2019 - <?= $profile->name; ?></p>
      <!-- <p>Developed by <a href="https://ivannsu.com" class="footer-link">Ivan</a></p> -->
    </div>
  </footer>

  <script src="<?= base_url('assets/js/jquery/jquery-3.3.1.min.js'); ?>"></script>
  <script src="<?= base_url('assets/boostrap4/popper.min.js'); ?>"></script>
  <script src="<?= base_url('assets/boostrap4/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/slick/slick.min.js'); ?>"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <script>
  
  $(document).ready(function(){
    $('.slider').slick({
      accessibility: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
    });
  });

  </script>

</body>
</html>