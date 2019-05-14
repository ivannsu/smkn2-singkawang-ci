<?php $this->load->view('frontend/templates-ppdb/open-html'); ?>
  <?php $this->load->view('frontend/templates-ppdb/navigations'); ?>
  <?php $this->load->view('frontend/templates-ppdb/header'); ?>

  <!-- CONTENT -->
  <div class="ppdb-main-content">
    <div class="container" style="max-width: 720px">
      <div class="row">
        <div class="col-lg-12">

          <?php $this->load->view('frontend/templates-ppdb/timeline'); ?>

          <div style="margin-top: 80px;"></div>
          
          <h3 class="text-center">Langkah 4</h3>

          <div style="margin-top: 60px;"></div>

          <div class="ppdb-panel">
            <h1 class="text-center">✅</h1>
            <h3 class="text-center">Data telah diverifikasi</h3>
            <p class="text-center">Dimohon untuk menunggu Hasil Penerimaan.</p>
          </div>
          <!-- ./ppdb-panel -->

        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('frontend/templates-ppdb/footer'); ?>

<?php $this->load->view('frontend/templates-ppdb/close-html'); ?>