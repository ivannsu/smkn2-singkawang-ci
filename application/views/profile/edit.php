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
        $('#address').val(res.row.address)
        $('#phone').val(res.row.phone)
        $('#email').val(res.row.email)
        $('#pos').val(res.row.pos)
        $('#video').val(res.row.video)
        $('#facebook').val(res.row.facebook)
        $('#twitter').val(res.row.twitter)
        $('#youtube').val(res.row.youtube)
        $('#instagram').val(res.row.instagram)

        if (res.row.img_header) {
          $('#img_header_href').attr('href', img_src_url + res.row.img_header)
          $('#img_header').attr('src', img_src_url + res.row.img_header)
        } else {
          $('#img_header').attr('src', img_src_url + 'placeholder.png')
          $('#img_header').css('width', 200)
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
    formData.append('address', $('#address').val())
    formData.append('phone', $('#phone').val())
    formData.append('email', $('#email').val())
    formData.append('pos', $('#pos').val())
    formData.append('video', $('#video').val())
    formData.append('facebook', $('#facebook').val())
    formData.append('twitter', $('#twitter').val())
    formData.append('youtube', $('#youtube').val())
    formData.append('instagram', $('#instagram').val())
    formData.append('img_header', $('input[name="img_header"]')[0].files[0])

    console.log(formData)

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
  <label for="address"><h4>Alamat</h4></label>
  <textarea name="address" id="address" rows="7" class="form-control" placeholder="Alamat"></textarea>
</div>

<div class="form-group">
  <label for="phone"><h4>No Telp</h4></label>
  <input type="text" name="phone" id="phone" class="form-control" placeholder="No Telp">
</div>
<div class="form-group">
  <label for="email"><h4>Email</h4></label>
  <input type="text" name="email" id="email" class="form-control" placeholder="Email">
</div>
<div class="form-group">
  <label for="pos"><h4>Kode Pos</h4></label>
  <input type="text" name="pos" id="pos" class="form-control" placeholder="Kode Pos">
</div>
<div class="form-group">
  <label for="video"><h4>Kode Video Youtube</h4></label>
  <input type="text" name="video" id="video" class="form-control" placeholder="Kode Video Youtube">
</div>

<hr>
<h4><b>Media Sosial: </b></h4>

<div class="form-group">
  <label for="facebook"><h4>Facebook</h4></label>
  <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Facebook">
</div>
<div class="form-group">
  <label for="twitter"><h4>Twitter</h4></label>
  <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Twitter">
</div>
<div class="form-group">
  <label for="youtube"><h4>Channel Youtube</h4></label>
  <input type="text" name="youtube" id="youtube" class="form-control" placeholder="Channel Youtube">
</div>
<div class="form-group">
  <label for="instagram"><h4>Instagram</h4></label>
  <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Instagram">
</div>

<div class="form-group">
  <label><h4>Gambar Banner</h4></label>
  <div>
    <a href="" id="img_header_href">
      <img src="" id="img_header" width="200" />
    </a>
  </div>
  <input type="file" name="img_header" class="form-control" />
</div>

<div class="form-group">
  <button name="btn-update" id="btn-update" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
</div>