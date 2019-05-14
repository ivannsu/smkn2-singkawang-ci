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
                  <td><span class="fas fa-times text-danger" id="fm-berkas_ijazah_status"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy SKHUN yang telah dilegalisir</td>
                  <td><span class="fas fa-times text-danger" id="fm-berkas_skhun_status"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy Akte Kelahiran</td>
                  <td><span class="fas fa-times text-danger" id="fm-berkas_akte_status"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy Kartu Keluarga</td>
                  <td><span class="fas fa-times text-danger" id="fm-berkas_kk_status"></span></td>
                </tr>
                <tr>
                  <td>Pasfoto 3x4 berwarna 2 Lembar</td>
                  <td><span class="fas fa-times text-danger" id="fm-berkas_foto_status"></span></td>
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
  function getData() {
    showLoader()

    $.ajax({
      url: '<?= $get_action; ?>',
      method: 'GET',
      success: (res) => {
        
        let berkas_ijazah = res.row.berkas_ijazah
        let berkas_skhun = res.row.berkas_skhun
        let berkas_akte = res.row.berkas_akte
        let berkas_kk = res.row.berkas_kk
        let berkas_foto = res.row.berkas_foto

        if (berkas_ijazah) {
          $('#fm-berkas_ijazah_status')[0].className = 'fas fa-check text-success'
        } else {
          $('#fm-berkas_ijazah_status')[0].className = 'fas fa-times text-danger'
        }

        if (berkas_skhun) {
          $('#fm-berkas_skhun_status')[0].className = 'fas fa-check text-success'
        } else {
          $('#fm-berkas_skhun_status')[0].className = 'fas fa-times text-danger'
        }

        if (berkas_akte) {
          $('#fm-berkas_akte_status')[0].className = 'fas fa-check text-success'
        } else {
          $('#fm-berkas_akte_status')[0].className = 'fas fa-times text-danger'
        }

        if (berkas_kk) {
          $('#fm-berkas_kk_status')[0].className = 'fas fa-check text-success'
        } else {
          $('#fm-berkas_kk_status')[0].className = 'fas fa-times text-danger'
        }

        if (berkas_foto) {
          $('#fm-berkas_foto_status')[0].className = 'fas fa-check text-success'
        } else {
          $('#fm-berkas_foto_status')[0].className = 'fas fa-times text-danger'
        }

        hideLoader()
      },
      failed: (error) => {
        hideLoader()
        showToast('failed', 'Oops something wrong... Please try again later.')
      }
    })
  }

  window.addEventListener('load', function() {
    getData()
  })
  
</script>

<?php $this->load->view('frontend/templates-ppdb/close-html'); ?>