<div id="timeline-wrap">
  <div id="timeline"></div>

  <?php
  if (1 <= $last_step) {
    echo '
    <div class="marker mfirst timeline-icon active">
      <a href="'.site_url('public/ppdb/step/1').'">1</a>
    </div>
    ';
  } else {
    echo '
    <div class="marker mfirst timeline-icon">1</div>
    ';
  }
  ?>

  <?php
  if (2 <= $last_step) {
    echo '
    <div class="marker m2 timeline-icon active">
      <a href="'.site_url('public/ppdb/step/2').'">2</a>
    </div>
    ';
  } else {
    echo '
    <div class="marker m2 timeline-icon">2</div>
    ';
  }
  ?>

  <?php
  if (3 <= $last_step) {
    echo '
    <div class="marker m3 timeline-icon active">
      <a href="'.site_url('public/ppdb/step/3').'">3</a>
    </div>
    ';
  } else {
    echo '
    <div class="marker m3 timeline-icon">3</div>
    ';
  }
  ?>

  <?php
  if (4 <= $last_step) {

    echo '
    <div class="marker mlast timeline-icon active">
      <a href="'.site_url('public/ppdb/step/4').'">4</a>
    </div>
    ';
  } else {
    echo '
    <div class="marker mlast timeline-icon">4</div>
    ';
  }
  ?>

  <!-- <div class="marker m2 timeline-icon">
    <a href="<?= site_url('public/ppdb/step/2'); ?>">2</a>
  </div>
  <div class="marker m3 timeline-icon">
    <a href="<?= site_url('public/ppdb/step/3'); ?>">3</a>
  </div>
  <div class="marker mlast timeline-icon">
    <a href="<?= site_url('public/ppdb/step/4'); ?>">4</a>
  </div> -->
</div>