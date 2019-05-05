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
          if (res.level == 'ADMIN') {
            document.location = SITE_URL + '/dashboard'
          } else if (res.level == 'STUDENTS') {
            document.location = SITE_URL + '/welcome'
          }

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

<div class="img-container">
  <img src="<?= base_url('/media_library/images/logo.png'); ?>" alt="Logo SMK Negeri 2 Singkawang">
</div>
<div class="login-container">
  <!-- <div class="login-heading">
    <h3>Login</h3>
  </div> -->
  <p>
    <input type="text" name="username" id="username" placeholder="Username" />
  </p>
  <p>
    <input type="password" name="password" id="password" placeholder="Password" />
  </p>
  <p>
    <button type="submit" class="login-button" name="login" id="btn-login">Login</button>
  </p>
  <br>
  <p style="text-align:center;">
    <a href="<?= site_url('login/register'); ?>">Daftar</a>
  </p>
</div>