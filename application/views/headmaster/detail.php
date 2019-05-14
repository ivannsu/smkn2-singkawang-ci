<script>

  function getData() {
    let id = '<?= $id; ?>'
    let action = '<?= $action; ?>' + id
    let img_src_url = BASE_URL + 'media_library/profile/'
    
    console.log(action)

    $.ajax({
      url: action,
      method: 'GET',
      success: (res) => {
        // console.log(res)
        if (res.status == 'success') {
          $('#post-name').text(res.row.name)
          $('#post-content').html(res.row.content)

          if (res.row.image) {
            $('#post-img').attr('src', img_src_url + 'md_' + res.row.image)
          } else {
            $('#post-img').attr('src', img_src_url + 'placeholder.png')
            $('#post-img').css('width', 400)
          }
        } else {

        }
      },
      failed: (error) => {
        console.log(error)
      }
    })
  }

  $(document).ready(() => {
    getData()
  })

</script>

<div class="img-container text-center">
  <img src="" id="post-img" />
</div>
<h3 id="post-name"></h3>
<hr>
<p id="post-content"></p>