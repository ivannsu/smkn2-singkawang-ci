<script>
  function submitPost() {
    showLoader()

    if ($('#password').val() !== $('#confirm_password').val()) {
      showToast('failed', 'Password tidak sama')
      return;
    }

    let formData = new FormData()
    // formData.append('name', $('#name').val())
    formData.append('name', $('#name').val())
    formData.append('email', $('#email').val())
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
        clearForm()
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
    
    $('#btn-register').on('click', () => {
      submitPost()
    })
  })
</script>

<div class="img-container">
  <img src="<?= base_url('/media_library/images/logo.png'); ?>" alt="Logo SMK Negeri 2 Singkawang">
</div>
<div class="login-container">
  <div class="login-heading">
    <h3>Daftar Member</h3>
  </div>
  <p>
    <input type="text" name="name" id="name" placeholder="Full Name" />
  </p>
  <p>
    <input type="email" name="email" id="email" placeholder="Email" />
  </p>
  <p>
    <input type="text" name="username" id="username" placeholder="Username" />
  </p>
  <p>
    <input type="password" name="password" id="password" placeholder="Password" />
  </p>
  <p>
    <input type="password" name="confirm_password" id="confirm_password" placeholder="Ketik Ulang Password" />
  </p>
  <p>
    <button type="submit" class="login-button" name="register" id="btn-register">Daftar</button>
  </p>
  <br>
  <p style="text-align:center;">
    <a href="<?= site_url('login'); ?>">Login</a>
  </p>
</div>