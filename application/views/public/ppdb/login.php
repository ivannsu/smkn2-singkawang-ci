<?php $this->load->view('frontend/templates-ppdb/open-html'); ?>
  <?php $this->load->view('frontend/templates-ppdb/navigations'); ?>
  <?php $this->load->view('frontend/templates-ppdb/header'); ?>

  <!-- CONTENT -->
  <div class="ppdb-main-content">
    <div class="container" style="max-width: 450px">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="text-center">Login</h3>
          <div style="margin-top: 60px;"></div>

          <div class="ppdb-panel">
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
          <!-- ./ppdb-panel -->

        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('frontend/templates-ppdb/footer'); ?>

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

  window.addEventListener('load', function() {
    $('#btn-login').on('click', () => {
      submitPost()
    })
  })
</script>

<?php $this->load->view('frontend/templates-ppdb/close-html'); ?>