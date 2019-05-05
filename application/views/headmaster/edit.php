<script>

  function getData() {
    showLoader()

    let id = '<?= $id; ?>'
    let get_action = '<?= $get_action; ?>' + id
    let img_src_url = BASE_URL + 'media_library/profile/'

    $.ajax({
      url: get_action,
      method: 'GET',
      success: (res) => {
        $('#name').val(res.row.name)
        CKEDITOR.instances['ckeditor-textarea'].setData(res.row.content)

        if (res.row.image) {
          $('#post-img').attr('src', img_src_url + 'md_' + res.row.image)
        } else {
          $('#post-img').attr('src', img_src_url + 'placeholder.png')
          $('#post-img').css('width', 400)
        }

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
    formData.append('name', $('#name').val())
    formData.append('content', CKEDITOR.instances['ckeditor-textarea'].getData())
    formData.append('image', $('input[name="image"]')[0].files[0])

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

<div class="img-container text-center">
  <img src="" id="post-img" />
</div>
<br>

<div class="form-group">
  <input type="text" name="name" id="name" class="form-control" placeholder="Name">
</div>

<div class="form-group">
  <textarea name="content" id="ckeditor-textarea" rows="10" class="form-control"></textarea>
</div>

<div class="form-group">
  <p>Foto: </p>
  <input type="file" name="image" />
</div>

<div class="form-group">
  <button name="btn-update" id="btn-update" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> &nbsp; Simpan</button>
</div>