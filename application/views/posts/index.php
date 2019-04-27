<script>

  function getData() {
    showLoader()

    let tableBody = $('#table-body')
    let detail_url = '<?= $detail_url; ?>'
    let edit_url = '<?= $edit_url; ?>'

    $.ajax({
      url: '<?= $action; ?>',
      type: 'GET',
      // data: {
      //   page: page
      // },
      success: (res) => {
        hideLoader()

        if (res.status == 'success') {
          console.log(res)

          res.data.forEach(row => {
            let tableRow = `
              <tr>
                <td>
                  <a href="${detail_url + row.id}">
                  ${row.title}
                  </a>
                </td>
                <td>${row.author}</td>
                <td>${row.created_at}</td>
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
        }
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

<table class="table table-bordered table-hover" id="datatables-table">
  <thead>
    <tr>
      <th>JUDUL</th>
      <th>PENULIS</th>
      <th>TANGGAL</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="table-body">
  </tbody>
</table>

