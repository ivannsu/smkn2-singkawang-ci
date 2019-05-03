<script>

  function getData() {
    showLoader()
    let detail_url = '<?= $detail_url; ?>'
    let edit_url = '<?= $edit_url; ?>'

    $.ajax({
      url: '<?= $action; ?>',
      type: 'GET',
      // data: {
      //   page: page
      // },
      success: (res) => {
        if (res.status == 'success') {
          // console.log(res)
          let dropdown_nav_id = '0';

          res.data.forEach(row => {
            let href = detail_url + row.post_id
            
            if (row.nav_id == '0') {
              $('#nav-data').append(`
                <li><a href="${href}">${row.post_title}</a></li>
              `);
              // console.log('SINGLE PAGE');
              // console.log(row);
            } else {
              if (row.nav_id !== dropdown_nav_id) {
                dropdown_nav_id = row.nav_id

                $('#nav-data').append(`
                  <li>
                    ${row.nav_title} |
                    <a href="${SITE_URL + '/navigations/create_page/' + dropdown_nav_id}" class="btn btn-xs btn-link">Tambah Halaman</a>
                    <ul id="nav-dropdown-container-${dropdown_nav_id}">
                      <li><a href="${href}">${row.post_title}</a></li>
                    </ul>
                  </li>
                `);
              } else {
                $(`#nav-dropdown-container-${dropdown_nav_id}`).append(`
                  <li><a href="${href}">${row.post_title}</a></li>
                `);
              }
              // console.log('DROP PAGE');
              // console.log(row);
            }
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
    let tableBody = $('#table-body')
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
          console.log(res)
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

<ul id="nav-data"></ul>

