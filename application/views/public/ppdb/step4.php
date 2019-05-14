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

            <div id="selection-is-on-going">
              <h1 class="text-center">✅</h1>
              <h3 class="text-center">Data telah diverifikasi</h3>
              <p class="text-center">Dimohon untuk menunggu Hasil Penerimaan.</p>
            </div>

            <div id="selection-is-passed">
              <h1 class="text-center">🎉</h1>
              <h3 class="text-center">Selamat Anda di Terima</h3>
              <p class="text-center">Silahkan menunggu informasi selanjutnya.</p>
            </div>

            <div id="selection-is-not-passed">
              <h1 class="text-center">❌</h1>
              <h3 class="text-center">Anda gagal dalam seleksi</h3>
              <p class="text-center">Jangan menyerah, tetap semangat dan berusaha lebih keras.</p>
            </div>

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

        let passed_selection = res.row.passed_selection

        if (passed_selection == 'on_going') {
          $('#selection-is-on-going').css('display', 'block')
        } else if (passed_selection == 'passed') {
          $('#selection-is-passed').css('display', 'block')
        } else if (passed_selection == 'not_passed') {
          $('#selection-is-not-passed').css('display', 'block')
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
    $('#selection-is-on-going').css('display', 'none')
    $('#selection-is-passed').css('display', 'none')
    $('#selection-is-not-passed').css('display', 'none')
    
    getData()
  })
  
</script>

<?php $this->load->view('frontend/templates-ppdb/close-html'); ?>