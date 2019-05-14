<?php $this->load->view('frontend/templates-ppdb/open-html'); ?>
  <?php $this->load->view('frontend/templates-ppdb/navigations'); ?>
  <?php $this->load->view('frontend/templates-ppdb/header'); ?>

  <!-- CONTENT -->
  <div class="ppdb-main-content">
    <div class="container" style="max-width: 450px">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="text-center">Pendaftaran</h3>
          <div style="margin-top: 60px;"></div>

          <div class="ppdb-panel">

            <div class="form-group">
              <input type="text" name="fm-name" id="fm-name" class="form-control" placeholder="Full Name">
            </div>
            <div class="form-group">
              <input type="text" name="fm-username" id="fm-username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="email" name="fm-email" id="fm-email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="password" name="fm-password" id="fm-password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
              <input type="password" name="fm-confirm_password" id="fm-confirm_password" class="form-control" placeholder="Ketik Ulang Password" required>
            </div>
            <div class="form-group">
              <button name="fm-btn-registrasi" id="fm-btn-registrasi" class="btn btn-block btn-primary">Registrasi</button>
            </div>
            <p class="text-center">Atau</p>
            <div class="text-center">
              <a href="<?= site_url('public/ppdb/login'); ?>" class="btn btn-link">Login</a>
            </div>

          </div> <!-- ./ppdb-panel -->

        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('frontend/templates-ppdb/footer'); ?>

<script>
  
  function submitPost() {
    showLoader()

    if ($('#fm-password').val() !== $('#fm-confirm_password').val()) {
      showToast('failed', 'Password tidak cocok')
    } else {
      let formData = new FormData()
      formData.append('name', $('#fm-name').val())
      formData.append('username', $('#fm-username').val())
      formData.append('email', $('#fm-email').val())
      formData.append('password', $('#fm-password').val())

      $.ajax({
        url: '<?= $action; ?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {
          
          hideLoader()
          showToast(res.status, res.message)

          if (res.status == 'success') {
            clearForm()

            setTimeout(() => {
              document.location = SITE_URL + '/public/ppdb/login'
            }, 1500)
          }
        },
        failed: function (error) {
          
          hideLoader()
          showToast('failed', 'Oops something wrong... Please try again later.')
        }
      })
    }
  }

  function clearForm() {
    $('input[type="text"], input[type="file"]').val('')
  }

  window.addEventListener('load', function() {
    $('#fm-btn-registrasi').on('click', () => {
      submitPost()
    })
  })

</script>

<?php $this->load->view('frontend/templates-ppdb/close-html'); ?>