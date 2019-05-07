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
            . site_url('public/page/index/page/'.$nav['post_id'])
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
            . site_url('public/page/index/page/'.$dropdown_child['post_id'])
            . '">'
            . $dropdown_child['post_title']
            . '</a>
          ';
        }
        echo '</div></li>';
      }
      
      ?>
      <a class="nav-link" href="<?= site_url('public/page/index/all_prestasi'); ?>">Prestasi</a>
      <a class="nav-link" href="<?= site_url('public/page/index/albums'); ?>">Gallery</a>
      <a class="nav-link" href="<?= site_url("/page.php?name=alumni"); ?>">Alumni</a>
    </ul>
  </div>
</div>
</nav>