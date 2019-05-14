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
                    onclick="setPassed(${row.user_id})">
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

  function setPassed(user_id) {
    showLoader()

    let tableBody = $('#table-body')
    let formData = new FormData()

    formData.append('user_id', user_id)
    formData.append('passed_selection', 'passed')

    $.ajax({
      url: '<?= $set_selection_status_action; ?>',
      type: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: function (res) {
        console.log(res)
        hideLoader()
        showToast(res.status, res.message)

        if (res.status == 'success') {
          // Destory Initialized Table
          $('#datatables-table').DataTable().destroy()

          // Empty all Table before append any data
          $('#table-body').empty()

          // Request Data, Append it, and Init Again DataTables
          getData()
        }
      },
      failed: function (error) {
        console.log(error)
        hideLoader()
        showToast('failed', error)
      }
    })
  }

  $(document).ready(() => {
    getData()
  })

</script>

<table class="table table-bordered table-hover table-striped no-sort-datatable" id="datatables-table">
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

