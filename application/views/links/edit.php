<script>

  function getData() {
    showLoader()

    let id = '<?= $id; ?>'
    let get_action = '<?= $get_action; ?>' + id

    $.ajax({
      url: get_action,
      method: 'GET',
      success: (res) => {
        $('#name').val(res.row.name)
        $('#href').val(res.row.href)

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
    formData.append('href', $('#href').val())

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
  <input type="text" name="name" id="name" class="form-control" placeholder="Name">
</div>

<div class="form-group">
  <input type="text" name="href" id="href" class="form-control" placeholder="Link">
</div>

<div class="form-group">
  <button name="btn-update" id="btn-update" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
</div>