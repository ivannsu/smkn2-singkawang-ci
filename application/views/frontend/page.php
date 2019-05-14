<?php $this->load->view('frontend/templates/open-html'); ?>

  <?php $this->load->view('frontend/templates/header'); ?>
  <?php $this->load->view('frontend/templates/navigations'); ?>

  <section class="page-detail">
    <div class="container">
      <div class="row">

        <div class="col-lg-8 content-detail">
          <?php $this->load->view($content); ?>
        </div>

        <?php $this->load->view('frontend/templates/sidebar'); ?>

      </div>
    </div>
  </section>

  <?php $this->load->view('frontend/templates/footer'); ?>
<?php $this->load->view('frontend/templates/close-html'); ?>
