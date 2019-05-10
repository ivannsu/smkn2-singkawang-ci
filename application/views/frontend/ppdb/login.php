<?php $this->load->view('frontend/templates/open-html'); ?>

  <?php $this->load->view('frontend/templates/header'); ?>
  <?php $this->load->view('frontend/templates/navigations'); ?>

  <!-- CONTENT -->
  <section class="section-ppdb">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2 class="text-center">Login PPDB</h2>
          <div class="text-center">
            <a href="#"><span class="fas fa-book"></span> Panduan</a>
          </div>
          <div class="form-container">
            <div class="form-group">
              <input type="email" name="username" id="username" class="form-control" placeholder="Username / Email">
            </div>
            <div class="form-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
              <button name="btn-login" id="btn-login" class="btn btn-block btn-primary">Login</button>
            </div>
            <p class="text-center">Atau</p>
            <div class="text-center">
              <a href="<?= site_url('public/ppdb/registrasi'); ?>" class="btn btn-link">Registrasi</a>
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

    let formData = new FormData()
    formData.append('username', $('#username').val())
    formData.append('password', $('#password').val())

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
          document.location = res.redirect_link

          clearForm()
        }
      },
      failed: function (error) {
        console.log(error)
        hideLoader()
        showToast('failed', error)
      }
    })
  }

  function clearForm() {
    $('input[type="text"], input[type="file"]').val('')
  }

  $(document).ready(() => {
    
    $('#btn-login').on('click', () => {
      submitPost()
    })
  })
</script>