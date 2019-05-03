<script>

  function getData() {
    showLoader()
    let detail_url = '<?= $detail_url; ?>'
    let edit_page_url = '<?= $edit_page_url; ?>'
    let edit_nav_url = '<?= $edit_nav_url; ?>'

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
                <li>
                  <a href="${href}">${row.post_title}</a>
                  <div style="margin-top: 10px;">
                    <a href="${edit_page_url + row.post_id}" class="btn btn-xs btn-info">
                      <span class="fa fa-edit"></span> Edit
                    </a>
                    <button class="btn btn-xs btn-danger" onclick="deleteData(${row.post_id})">
                      <span class="fa fa-trash"></span> Delete
                    </button>
                  </div>
                </li>
              `);
              // console.log('SINGLE PAGE');
              // console.log(row);
            } else {
              if (row.nav_id !== dropdown_nav_id) {
                dropdown_nav_id = row.nav_id

                $('#nav-data').append(`
                  <li>
                    ${row.nav_title}
                    <div style="margin-top: 10px">
                      <a href="${SITE_URL + '/navigations/create_page/' + dropdown_nav_id}" class="btn btn-xs btn-success">
                        <span class="fa fa-plus"></span> Tambah Halaman
                      </a>
                      <a href="${edit_nav_url + dropdown_nav_id}" class="btn btn-xs btn-info">
                        <span class="fa fa-edit"></span> Edit
                      </a>
                      <button class="btn btn-xs btn-danger" onclick="deleteData(${dropdown_nav_id}, 'nav')">
                        <span class="fa fa-trash"></span> Delete
                      </button>
                    </div>
                    <ul id="nav-dropdown-container-${dropdown_nav_id}">
                      <li>
                        <a href="${href}">${row.post_title}</a>
                        <div style="margin-top: 10px;">
                          <a href="${edit_page_url + row.post_id}" class="btn btn-xs btn-info">
                            <span class="fa fa-edit"></span> Edit
                          </a>
                          <button class="btn btn-xs btn-danger" onclick="deleteData(${row.post_id})">
                            <span class="fa fa-trash"></span> Delete
                          </button>
                        </div>
                      </li>
                    </ul>
                  </li>
                `);
              } else {
                $(`#nav-dropdown-container-${dropdown_nav_id}`).append(`
                  <li>
                    <a href="${href}">${row.post_title}</a>
                    <div style="margin-top: 10px;">
                      <a href="${edit_page_url + row.post_id}" class="btn btn-xs btn-info">
                        <span class="fa fa-edit"></span> Edit
                      </a>
                      <button class="btn btn-xs btn-danger" onclick="deleteData(${row.post_id})">
                        <span class="fa fa-trash"></span> Delete
                      </button>
                    </div>
                  </li>
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

  function deleteData(id, type) {
    let navData = $('#nav-data')
    let userConfirm = confirm('Apa anda yakin untuk menghapus data ini ?')

    if (userConfirm) {
      showLoader()

      $.ajax({
        url: (type == 'nav') ? '<?= $delete_nav_action; ?>' : '<?= $delete_page_action; ?>',
        method: 'POST',
        data: {
          id: id
        },
        success: (res) => {
          console.log(res)
          navData.html('')
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

