<?php $this->load->view('frontend/templates/open-html'); ?>

  <?php $this->load->view('frontend/templates/header'); ?>
  <?php $this->load->view('frontend/templates/navigations'); ?>

  <!-- CONTENT -->
  <section class="section-ppdb">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2 class="text-center">Daftar Online</h2>
          <div class="text-center">
            <a href="#"><span class="fas fa-book"></span> Panduan</a>
          </div>
          <div class="form-container">
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
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php $this->load->view('frontend/templates/footer'); ?>

<?php $this->load->view('frontend/templates/close-html'); ?>
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
          console.log(res)
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
          console.log(error)
          hideLoader()
          showToast('failed', error)
        }
      })
    }
  }

  function clearForm() {
    $('input[type="text"], input[type="file"]').val('')
  }

  $(document).ready(() => {
    
    $('#fm-btn-registrasi').on('click', () => {
      submitPost()
    })
  })

  </script>