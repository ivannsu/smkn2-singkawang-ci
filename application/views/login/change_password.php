<script>
  function submitPost() {
    showLoader()

    if ($('#confirm_password').val() !== $('#new_password').val()) {
      showToast('failed', 'Password tidak sama')
      hideLoader()

    } else {
      let formData = new FormData()
      formData.append('old_password', $('#old_password').val())
      formData.append('new_password', $('#new_password').val())

      $.ajax({
        url: '<?= $action; ?>',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: (res) => {
          // console.log(res)
          hideLoader()
          showToast(res.status, res.message)

          if (res.status == 'success') {
            setTimeout(() => {
              document.location = SITE_URL + '/login'
            }, 500);
          }
        },
        failed: (error) => {
          console.log(error)
          hideLoader()
          showToast('failed', error)
        }
      })
    }
  }

  $(document).ready(() => {
    $('#btn-update').on('click', () => {
      submitPost()
    })
  })

</script>

<div class="form-group">
  <h5>Password Lama</h5>
  <input type="password" class="form-control" name="old_password" id="old_password" />
</div>

<div class="form-group">
  <h5>Password Baru</h5>
  <input type="password" class="form-control" name="new_password" id="new_password" />
</div>

<div class="form-group">
  <h5>Ketik Ulang Password Baru</h5>
  <input type="password" class="form-control" name="confirm_password" id="confirm_password" />
</div>

<div class="form-group">
  <button name="btn-update" id="btn-update" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
</div>