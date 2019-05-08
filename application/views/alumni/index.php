<script>

  function getData() {
    showLoader()

    let tableBody = $('#table-body')
    let detail_url = '<?= $detail_url; ?>'
    let edit_url = '<?= $edit_url; ?>'

    $.ajax({
      url: '<?= $action; ?>',
      type: 'GET',
      success: (res) => {
        if (res.status == 'success') {
          // console.log(res)

          res.data.forEach(row => {
            let tableRow = `
              <tr>
                <td>
                  <a href="${detail_url + row.alumni_id}">
                  ${row.name}
                  </a>
                </td>
                <td>${row.jurusan}</td>
                <td>${row.angkatan}</td>
                <td>
                  <a href="${edit_url + row.alumni_id}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Edit</a>
                  <button 
                    class="btn btn-danger btn-xs"
                    id="delete-btn"
                    onclick="deleteData(${row.alumni_id})">
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
          console.log(res, '<==== DELETE RES')
 
          if (res.status !== 'failed') {
            tableBody.html('')
            getData()
          }
          
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

  function importExcel() {
    showLoader()

    let tableBody = $('#table-body')
    let formData = new FormData()
    formData.append('media_excel', $('input[name="media_excel"]')[0].files[0])

    $.ajax({
      url: '<?= $import_action; ?>',
      type: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: function (res) {
        console.log(res)
        hideLoader()
        showToast(res.status, res.message)

        if (res.status == 'success') {
          tableBody.html('');
          getData()
          clearForm()
        }
      },
      failed: function (error) {
        console.log(error)
        hideLoader()
        showToast('failed', error)
      }
    })
  }

  function clearForm() {
    $('input[type="text"], input[type="file"]').val('')
  }

  $(document).ready(() => {
    getData()

    $('#btn-import').on('click', () => {
      importExcel()
    })
  })

</script>

<div class="pull-right">
  <div class="btn-group" role="group" aria-label="...">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i> Import Excel</button>
    <a href="<?= base_url('media_library/excel/contoh_excel_alumni.xlsx'); ?>" class="btn btn-link"><i class="fa fa-file"></i> Format File Excel</a>
  </div>
</div>

<div class="clearfix"></div>
<hr>

<table class="table table-bordered table-hover table-striped" id="datatables-table">
  <thead>
    <tr>
      <th>NAMA</th>
      <th>JURUSAN</th>
      <th>ANGKATAN</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="table-body">
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Import Excel</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="media_excel" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-import"><i class="fa fa-upload"></i> Import</button>
      </div>
    </div>
  </div>
</div>


