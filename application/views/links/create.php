<script>

  function submitPost() {
    showLoader()

    let formData = new FormData()
    formData.append('name', $('#name').val())
    formData.append('href', $('#href').val())
    formData.append('image', $('input[name="image"]')[0].files[0])

    $.ajax({
      url: '<?= $action; ?>',
      type: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: function (res) {
        // console.log(res)
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
    
    $('#btn-create').on('click', () => {
      submitPost()
    })
  })

</script>

<div class="form-group">
  <input type="text" name="name" id="name" class="form-control" placeholder="Name">
</div>

<div class="form-group">
  <input type="text" name="href" id="href" class="form-control" placeholder="Link">
</div>

<div class="form-group">
  <p>Gambar: </p>
  <input type="file" name="image" />
</div>

<br>
<div class="form-group">
  <button name="btn-create" id="btn-create" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Publish</button>
</div>