<?php $this->load->view('frontend/templates-ppdb/open-html'); ?>
  <?php $this->load->view('frontend/templates-ppdb/navigations'); ?>
  <?php $this->load->view('frontend/templates-ppdb/header'); ?>

  <!-- CONTENT -->
  <div class="ppdb-main-content">
    <div class="container" style="max-width: 720px">
      <div class="row">
        <div class="col-lg-12">

          <?php $this->load->view('frontend/templates-ppdb/timeline'); ?>

          <div style="margin-top: 80px;"></div>
          
          <h3 class="text-center">Langkah 3</h3>

          <div style="margin-top: 60px;"></div>

          <div class="ppdb-panel">
          <!-- style="border: 1px solid #dee2e6" -->
            <table class="table table-bordered">
              <thead>
                <th>Berkas</th>
                <th>Status</th>
              </thead>
              <tbody>
                <tr>
                  <td><a href="<?= site_url('public/ppdb/kartu_registrasi_sementara'); ?>">Kartu Registrasi Sementara</a></td>
                  <!-- <td><span class="fas fa-check text-success"></span></td> -->
                  <td><span class="fas fa-download"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy Ijazah yang telah dilegalisir</td>
                  <!-- <td><span class="fas fa-check text-success"></span></td> -->
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy SKHUN yang telah dilegalisir</td>
                  <!-- <td><span class="fas fa-check text-success"></span></td> -->
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy Akte Kelahiran</td>
                  <!-- <td><span class="fas fa-check text-success"></span></td> -->
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
                <tr>
                  <td>Fotocopy Kartu Keluarga</td>
                  <!-- <td><span class="fas fa-check text-success"></span></td> -->
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
                <tr>
                  <td>Pasfoto 3x4 berwarna 2 Lembar</td>
                  <!-- <td><span class="fas fa-check text-success"></span></td> -->
                  <td><span class="fas fa-times text-danger"></span></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- ./ppdb-panel -->

        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('frontend/templates-ppdb/footer'); ?>

<?php $this->load->view('frontend/templates-ppdb/close-html'); ?>

<script>

  function getData() {
    showLoader()

    $.ajax({
      url: '<?= $get_action; ?>',
      method: 'GET',
      success: (res) => {
        console.log(res)
        // $('#fm-prev_school_name').val(res.row.prev_school_name)
        // $('#fm-prev_school_address').val(res.row.prev_school_address)

        $.each($('#fm-jurusan_id option'), function (i, elm) {
          if ($(this).val() == res.row.jurusan_id) {
            $(this).attr('selected', 'selected')
          }
        })

        hideLoader()
      },
      failed: (error) => {
        hideLoader()
        console.log(error)
      }
    })
  }

  function submitPost() {
    showLoader()

    let formData = new FormData()
    formData.append('prev_school_name', $('#fm-prev_school_name').val())
    formData.append('prev_school_address', $('#fm-prev_school_address').val())
    formData.append('jurusan_id', $('#fm-jurusan_id option:selected').val())

    $.ajax({
      url: '<?= $action; ?>',
      method: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: (res) => {
        console.log(res)
        hideLoader()
        showToast(res.status, res.message)

        if (res.status == 'success') {
          setTimeout(() => {
            document.location = res.redirect_link
          }, 1500);
        }
      },
      failed: (error) => {
        console.log(error)
        hideLoader()
        showToast('failed', error)
      }
    })
  }

  $(document).ready(() => {
    getData()

    $('#fm-btn-save').on('click', () => {
      submitPost()
    })
  })

</script>