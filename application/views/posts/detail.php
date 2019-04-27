<script>

  function getData() {
    let id = '<?= $id; ?>'
    let action = '<?= $action; ?>' + id
    let img_src_url = BASE_URL + 'media_library/posts/'

    $.ajax({
      url: action,
      method: 'GET',
      success: (res) => {
        if (res.status == 'success') {
          $('#post-title').text(res.row.title)
          $('#post-info').text(res.row.created_at)
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
<h3 id="post-title"></h3>
<small id="post-info">29 Sep 2019</small>
<hr>
<p id="post-content"></p>