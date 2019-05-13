<script>

  function getData() {
    showLoader()

    let tableBody = $('#table-body')
    let check_url = '<?= $check_url; ?>'

    $.ajax({
      url: '<?= $action; ?>',
      type: 'GET',
      success: (res) => {
        if (res.status == 'success') {
          console.log(res)

          res.data.forEach(row => {
            let tableRow = `
              <tr>
                <td>${readbleUniqID(row.registration_id)}</td>
                <td>${row.name}</td>
                <td>${row.jurusan}</td>
                <td>
                  <a href="${check_url + row.user_id}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Check</a>
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

  $(document).ready(() => {
    getData()
  })

</script>

<table class="table table-bordered table-hover table-striped" id="datatables-table">
  <thead>
    <tr>
      <th>NO. REGISTRASI</th>
      <th>NAMA</th>
      <th>JURUSAN</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="table-body">
  </tbody>
</table>

