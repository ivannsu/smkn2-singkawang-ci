<script>

  function getData() {
    let id = '<?= $id; ?>'
    let action = '<?= $action; ?>' + id
    // let img_src_url = BASE_URL + 'media_library/prestasi/'

    $.ajax({
      url: action,
      method: 'GET',
      success: (res) => {
        if (res.status == 'success') {
          console.log(res)
          $('#p-address').text(res.row.address)
          $('#p-phone').text(res.row.phone)
          $('#p-email').text(res.row.email)
          $('#p-pos').text(res.row.pos)
          $('#p-video').text(res.row.video)
          $('#p-facebook').text(res.row.facebook)
          $('#p-twitter').text(res.row.twitter)
          $('#p-youtube').text(res.row.youtube)
          $('#p-instagram').text(res.row.instagram)
          // $('#post-title').text(res.row.title)
          // $('#post-info').text(res.row.created_at)
          // $('#post-content').html(res.row.content)

          // if (res.row.image) {
          //   $('#post-img').attr('src', img_src_url + 'md_' + res.row.image)
          // } else {
          //   $('#post-img').attr('src', img_src_url + 'placeholder.png')
          //   $('#post-img').css('width', 400)
          // }
        } else {

        }
      },
      failed: (error) => {
        console.log(error)
      }
    })
  }

  $(document).ready(() => {
    $('td:first-child').attr('width', '40%')
    $('td:nth-child(2)').attr('width', '5%')
    getData()
  })

</script>

<!-- <div class="img-container text-center">
  <img src="" id="post-img" />
</div> -->
<table class="table table-bordered table-striped">
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td id="p-address"></td>
  </tr>
    <td>No Telp</td>
    <td>:</td>
    <td id="p-phone"></td>
  </tr>
  <tr>
    <td>E-mail</td>
    <td>:</td>
    <td id="p-email"></td>
  </tr>
  <tr>
    <td>Kode POS</td>
    <td>:</td>
    <td id="p-pos"></td>
  </tr>
  <tr>
    <td>Kode Video Youtube</td>
    <td>:</td>
    <td id="p-video"></td>
  </tr>
</table>

<br>
<p><strong>Media Sosial:</strong></p>

<table class="table table-bordered table-striped">
  <tr>
    <td>Facebook</td>
    <td>:</td>
    <td id="p-facebook"></td>
  </tr>
  <tr>
    <td>Twitter</td>
    <td>:</td>
    <td id="p-twitter"></td>
  </tr>
  <tr>
    <td>Channel Youtube</td>
    <td>:</td>
    <td id="p-youtube"></td>
  </tr>
  <tr>
    <td>Instagram</td>
    <td>:</td>
    <td id="p-instagram"></td>
  </tr>
</table>