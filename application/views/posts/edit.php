<script>

  function getData() {
    let id = '<?= $id; ?>'
    let get_action = '<?= $get_action; ?>' + id

    $.ajax({
      url: get_action,
      method: 'GET',
      success: (res) => {
        $('#title').val(res.row.title)
        $('#ckeditor-textarea').val(res.row.content)
      },
      failed: (error) => {

      }
    })
  }

  function submitPost() {
    let id = '<?= $id; ?>'
    let data = {
      id: id,
      title: $('#title').val(),
      content: $('#ckeditor-textarea').val(),
    }

    $.ajax({
      url: '<?= $action; ?>',
      method: 'POST',
      data: data,
      success: (res) => {
        console.log(res)
      },
      failed: (error) => {

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