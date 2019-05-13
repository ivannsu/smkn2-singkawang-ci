<script>

  function getData() {
    showLoader()

    let tableBody = $('#table-body')

    $.ajax({
      url: '<?= $get_all_action; ?>',
      type: 'GET',
      success: (res) => {
        if (res.status == 'success') {
          console.log(res)

          res.data.forEach(row => {
            let tableRow = `
              <tr>
                <td>${row.academic_year}</td>
                <td>${row.phase_start_date}</td>
                <td>${row.phase_end_date}</td>
                <td>
                  ${ row.active == 'true' ? `<span class="fa fa-check"></span>` : '<span class="fa fa-times"></span>' }
                </td>
                <td>
                  <button 
                    class="btn btn-success btn-xs"
                    id="set-active-btn"
                    onclick="setActive(${row.id})">
                      Aktifkan
                  </button>
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

  function setActive(id) {
    showLoader()

    let tableBody = $('#table-body')

    $.ajax({
      url: '<?= $set_active_action; ?>',
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

  function submitPost() {
    showLoader()

    let formData = new FormData()
    formData.append('academic_year', $('#fm-academic_year').val())
    formData.append('phase_start_date', $('#fm-phase_start_date').val())
    formData.append('phase_end_date', $('#fm-phase_end_date').val())

    $.ajax({
      url: '<?= $create_action; ?>',
      type: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: function (res) {
        console.log(res)
        hideLoader()
        showToast(res.status, res.message)

        if (res.status == 'success') {
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

    $('#btn-save').on('click', () => {
      submitPost()
    })
  })

</script>

<div class="pull-right">
  <div class="btn-group" role="group" aria-label="...">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
  </div>
</div>

<div class="clearfix"></div>
<hr>

<table class="table table-bordered table-hover table-striped" id="datatables-table">
  <thead>
    <tr>
      <th>TAHUN AKADEMIK</th>
      <th>TANGGAL PPDB DIMULAI</th>
      <th>TANGGAL PPDB SELESAI</th>
      <th>Status</th>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="fm-academic_year">Tahun Akademik</label>
          <input type="text" name="fm-academic_year" id="fm-academic_year" class="form-control" value="<?= date('Y'); ?>">
        </div>
        <div class="form-group">
          <label for="fm-phase_start_date">Tanggal PPDB Dimulai</label>
          <input type="date" max="3000-12-31" min="1945-01-01" name="fm-phase_start_date" id="fm-phase_start_date" class="form-control">
        </div>
        <div class="form-group">
          <label for="fm-phase_end_date">Tanggal PPDB Selesai</label>
          <input type="date" max="3000-12-31" min="1945-01-01" name="fm-phase_end_date" id="fm-phase_end_date" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>

