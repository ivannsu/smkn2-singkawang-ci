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
          
          <h3 class="text-center">Langkah 3</h3>

          <div style="margin-top: 60px;"></div>

          <div class="ppdb-panel">
          <!-- style="border: 1px solid #dee2e6" -->
            <table class="table table-bordered">
              <thead>
                <th>Berkas</th>
                <th>Status</th>
              </thead>
              <tbody>
                <tr>
                  <td><a href="<?= site_url('public/ppdb/kartu_registrasi_sementara'); ?>">Kartu Registrasi Sementara</a></td>
                  <td><span class="fas fa-download"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy Ijazah yang telah dilegalisir</td>
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy SKHUN yang telah dilegalisir</td>
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy Akte Kelahiran</td>
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy Kartu Keluarga</td>
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
                <tr>
                  <td>Pasfoto 3x4 berwarna 2 Lembar</td>
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- ./ppdb-panel -->

        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('frontend/templates-ppdb/footer'); ?>

<script>

  window.addEventListener('load', function() {
    
  })
  
</script>

<?php $this->load->view('frontend/templates-ppdb/close-html'); ?>