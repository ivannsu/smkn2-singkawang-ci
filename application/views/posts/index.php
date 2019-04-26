<script>

  function getData() {
    let tableBody = $('#table-body')
    let detail_url = '<?= $detail_url; ?>'
    let edit_url = '<?= $edit_url; ?>'
    let page = '<?= $page; ?>'

    $.ajax({
      url: '<?= $action; ?>',
      type: 'GET',
      data: {
        page: page
      },
      success: (res) => {
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
        console.log(error);
      }
    })
  }

  function deleteData(id) {
    let tableBody = $('#table-body')
    let userConfirm = confirm('Apa anda yakin untuk menghapus data ini ?')

    if (userConfirm) {
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
        },
        failed: (error) => {

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

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="50%">JUDUL</th>
      <th>PENULIS</th>
      <th>TANGGAL</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="table-body">
  </tbody>
</table>

