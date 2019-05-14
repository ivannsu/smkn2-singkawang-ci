<script>

  function getData() {
    $.ajax({
      url: '<?= $get_action; ?>',
      method: 'GET',
      success: (res) => {
        res.data.forEach(row => {
          let html = `
            <option value="${row.id}">${row.title}</option>
          `
          $('#album').append(html)
        })
      },
      failed: (error) => {
        console.log(error)
      }
    })
  }

  function submitPost() {
    showLoader()

    let formData = new FormData()
    formData.append('album_id', $('#album option:selected').val())
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
    $('#album').prop('selectedIndex', 0)
  }

  $(document).ready(() => {
    getData()
    
    $('#btn-create').on('click', () => {
      submitPost()
    })
  })

</script>

<div class="form-group">
  <p>Album: </p>
  <select name="album" id="album" class="form-control">
    <option value="">Pilih</option>
  </select>
</div>

<div class="form-group">
  <p>Foto: </p>
  <input type="file" name="image" />
</div>

<br>
<div class="form-group">
  <button name="btn-create" id="btn-create" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
</div>