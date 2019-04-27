<script>

  function getData() {
    let id = '<?= $id; ?>'
    let action = '<?= $action; ?>' + id

    $.ajax({
      url: action,
      method: 'GET',
      success: (res) => {
        if (res.status == 'success') {
          $('#post-title').text(res.row.title)
          $('#post-info').text(res.row.created_at)
          $('#post-content').html(res.row.content)
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

<h3 id="post-title"></h3>
<small id="post-info">29 Sep 2019</small>
<hr>
<p id="post-content"></p>