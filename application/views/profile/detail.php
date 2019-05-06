<script>

  function getData() {
    let id = '<?= $id; ?>'
    let action = '<?= $action; ?>' + id
    let img_src_url = BASE_URL + 'media_library/profile/'

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


          if (res.row.img_header) {
            $('#p-banner-img-href').attr('href', img_src_url + res.row.img_header)
            $('#p-banner-img').attr('src', img_src_url + res.row.img_header)
          } else {
            $('#p-banner-img').attr('src', img_src_url + 'placeholder.png')
            $('#p-banner-img').css('width', 200)
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
    $('td:first-child').attr('width', '40%')
    $('td:nth-child(2)').attr('width', '5%')
    getData()
  })

</script>

<table class="table table-bordered table-striped">
  <tr>
    <td>Banner</td>
    <td>:</td>
    <td>
      <a href="" id="p-banner-img-href">
        <img src="" id="p-banner-img" width="200" />
      </a>
    </td>
  </tr>
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