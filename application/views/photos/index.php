<script>

  function getData() {
    showLoader()

    let albumId = '<?= $album_id; ?>'

    $.ajax({
      url: '<?= $action; ?>',
      type: 'GET',
      data: {
        album_id: albumId
      },
      success: (res) => {
        // console.log(res)

        if (res.status == 'empty') {
          let href = BASE_URL + 'index.php/photos/create'
          $('#gallery').append(`
            <div class="container">
              <p>
                Tidak ada Foto di Album ini,
                <a href="${href}" class="btn-link">Tambah Foto?</a>
              </p>
            </div>
          `)
        }

        if (res.status == 'success') {
          res.data.forEach(row => {
            let largeImgSrc = BASE_URL + 'media_library/gallery/lg_' + row.image
            let thumbImgSrc = BASE_URL + 'media_library/gallery/sm_' + row.image

            let html = `
              <div class="col-lg-2">
                <p>
                  <button 
                    class="btn btn-danger btn-xs"
                    id="delete-btn"
                    onclick="deleteData(${row.id})">
                      <span class="fa fa-close"></span>
                  </button>
                </p>
                <div>
                  <a href="${largeImgSrc}">
                    <img 
                      src="${thumbImgSrc}" 
                      class="img-thumbnail" />
                  </a>
                </div>
              </div>
            `
            $('#gallery').append(html)
          })
        }
        hideLoader()
      },
      failed: (error) => {
        console.log(error)
        hideLoader()
      }
    })
  }

  function deleteData(id) {
    let userConfirm = confirm('Apa anda yakin untuk menghapus data ini ?')

    if (userConfirm) {
      showLoader()

      $.ajax({
        url: '<?= $delete_action; ?>',
        method: 'POST',
        data: {
          id: id
        },
        success: (res) => {
          // console.log(res)
 
          $('#gallery').html('')
          getData()
          hideLoader()
          showToast(res.status, res.message)
        },
        failed: (error) => {
          console.log(error)
          hideLoader()
          showToast('failed', error)
        }
      })
    } else {
      return false
    }
  }

  $(document).ready(() => {
    getData()
  })

</script>

<div class="row" id="gallery"></div>

