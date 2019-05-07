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