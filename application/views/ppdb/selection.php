<script>

  function getData() {
    showLoader()

    let tableBody = $('#table-body')

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
                <td>${getAverageOfScores(row.national_exam_scores)}</td>
                <td>
                  <button 
                    class="btn btn-success btn-xs"
                    id="set-passed-btn"
                    onclick="">
                      Terima
                  </button>
                </td>
              </tr>
            `
            tableBody.append(tableRow)
          })

          $('#datatables-table').DataTable({
            order: [
              [2, 'asc'],
              [3, 'desc'],
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

<table class="table table-bordered table-hover table-striped" id="datatables-table">
  <thead>
    <tr>
      <th>NO. REGISTRASI</th>
      <th>NAMA</th>
      <th>JURUSAN</th>
      <th>RATA-RATA</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="table-body">
  </tbody>
</table>

