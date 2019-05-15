<script>

  function getData() {
    showLoader()

    let tableBody = $('#table-body')

    $.ajax({
      url: '<?= $action; ?>',
      type: 'GET',
      success: (res) => {
        if (res.status == 'success') {
          // console.log(res)

          res.data.forEach(row => {
            let tableRow = `
              <tr>
                <td>${readbleUniqID(row.registration_id)}</td>
                <td>${row.name}</td>
                <td>${row.jurusan}</td>
                <td>${getAverageOfScores(row.national_exam_scores)}</td>
              </tr>
            `
            tableBody.append(tableRow)
          })

          $('#datatables-table').DataTable({
            order: [
              [2, 'asc'],
              [3, 'desc'],
            ],
            columnDefs: [
              { orderable: false, targets: '_all' }
            ]
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

  $(document).ready(() => {
    getData()
  })

</script>

<table class="table table-bordered table-hover table-striped no-sort-datatable" id="datatables-table">
  <thead class="bg-success">
    <tr>
      <th>NO. REGISTRASI</th>
      <th>NAMA</th>
      <th>JURUSAN</th>
      <th>RATA-RATA</th>
    </tr>
  </thead>
  <tbody id="table-body">
  </tbody>
</table>

