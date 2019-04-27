<script>

  function getData() {
    showLoader()

    let id = '<?= $id; ?>'
    let get_action = '<?= $get_action; ?>' + id

    $.ajax({
      url: get_action,
      method: 'GET',
      success: (res) => {
        $('#title').val(res.row.title)
        CKEDITOR.instances['ckeditor-textarea'].setData(res.row.content)

        hideLoader()
      },
      failed: (error) => {
        hideLoader()
        console.log(error)
      }
    })
  }

  function submitPost() {
    showLoader()

    let id = '<?= $id; ?>'
    let formData = new FormData()
    formData.append('id', id)
    formData.append('title', $('#title').val())
    formData.append('content', CKEDITOR.instances['ckeditor-textarea'].getData())

    $.ajax({
      url: '<?= $action; ?>',
      method: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: (res) => {
        console.log(res)
        hideLoader()
        showToast(res.status, res.message)
      },
      failed: (error) => {
        console.log(error)
        hideLoader()
        showToast('failed', error)
      }
    })
  }

  $(document).ready(() => {
    getData()

    $('#btn-update').on('click', () => {
      submitPost()
    })
  })

</script>

<div class="form-group">
  <input type="text" name="title" id="title" class="form-control" placeholder="Title">
</div>

<div class="form-group">
  <textarea name="content" id="ckeditor-textarea" rows="10" class="form-control"></textarea>
</div>

<div class="form-group">
  <button name="btn-update" id="btn-update" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
</div>