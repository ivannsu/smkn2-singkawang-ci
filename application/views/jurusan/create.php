<script>

  function submitPost() {
    showLoader()

    let formData = new FormData()
    formData.append('title', $('#title').val())
    formData.append('content', CKEDITOR.instances['ckeditor-textarea'].getData())
    formData.append('image', $('input[name="image"]')[0].files[0])

    // CKEDITOR.instances['ckeditor-textarea'].setData('')

    // $('input[name="image"]')[0]
    // Output: <input name="image" />

    // $('input[name="image"]')[0].files
    // Output: Property of <input /> like name, size, type and others

    // console.log($('input[name="image"]')[0].files)

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
    CKEDITOR.instances['ckeditor-textarea'].setData('')
  }

  $(document).ready(() => {
    
    $('#btn-create').on('click', () => {
      submitPost()
    })
  })

</script>

<div class="form-group">
  <input type="text" name="title" id="title" class="form-control" placeholder="Name">
</div>

<div class="form-group">
  <textarea name="content" id="ckeditor-textarea" rows="10" class="form-control"></textarea>
</div>

<div class="form-group">
  <p>Logo: </p>
  <input type="file" name="image" />
</div>

<br>
<div class="form-group">
  <button name="btn-create" id="btn-create" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Publish</button>
</div>