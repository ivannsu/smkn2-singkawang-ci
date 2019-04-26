<script>

  function submitPost() {
    let data = {
      title: $('#title').val(),
      content: $('#ckeditor-textarea').val()
    }

    $.ajax({
      url: '<?= $action; ?>',
      type: 'POST',
      data: data,
      success: function (response) {
        console.log(response)
      },
      failed: function (error) {
        console.log(error)
      }
    })
  }

  $(document).ready(() => {
    
    $('#btn-create').on('click', () => {
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
  <button name="btn-create" id="btn-create" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Publish</button>
</div>