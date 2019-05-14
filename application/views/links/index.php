<script>

  function getData() {
    showLoader()

    let tableBody = $('#table-body')
    let edit_url = '<?= $edit_url; ?>'

    $.ajax({
      url: '<?= $action; ?>',
      type: 'GET',
      success: (res) => {
        if (res.status == 'success') {
          // console.log(res)

          res.data.forEach(row => {

            let img_src = BASE_URL + 'media_library/links/' + (row.image ? row.image : 'placeholder.png')
            let tableRow = `
              <tr>
                <td>
                  <img src="${img_src}" alt="Gambar ${row.name}" width="200" />
                </td>
                <td>${row.name}</td>
                <td>
                  <a href="${row.href}">
                  ${row.href}
                  </a>
                </td>
                <td>
                  <a href="${edit_url + row.id}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Edit</a>
                  <button 
                    class="btn btn-danger btn-xs"
                    id="delete-btn"
                    onclick="deleteData(${row.id})">
                      <span class="fa fa-trash"></span> Delete
                  </button>
                </td>
              </tr>
            `
            tableBody.append(tableRow)
          })

          $('#datatables-table').DataTable()
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
          // console.log(res)
 
          tableBody.html('')
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

<table class="table table-bordered table-hover table-striped" id="datatables-table">
  <thead>
    <tr>
      <th>GAMBAR</th>
      <th>NAMA</th>
      <th>LINK</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="table-body">
  </tbody>
</table>

