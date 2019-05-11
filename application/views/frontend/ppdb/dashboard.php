<?php $this->load->view('frontend/templates-ppdb/open-html'); ?>
  <?php $this->load->view('frontend/templates-ppdb/navigations'); ?>
  <?php $this->load->view('frontend/templates-ppdb/header'); ?>

  <!-- CONTENT -->
  <div class="ppdb-main-content">
    <div class="container" style="max-width: 720px">
      <div class="row">
        <div class="col-lg-12">

          <div id="timeline-wrap">
            <div id="timeline"></div>
            <div class="marker mfirst timeline-icon active">1</div>
            <div class="marker m2 timeline-icon">2</div>
            <div class="marker m3 timeline-icon">3</div>
            <div class="marker mlast timeline-icon">4</div>
          </div>

          <div style="margin-top: 80px;"></div>
          
          <h3 class="text-center">Langkah 1</h3>

          <div style="margin-top: 60px;"></div>

          <div class="ppdb-panel">
            <div class="form-group">
              <label for="fm-name">Nama Lengkap</label>
              <input type="text" name="fm-name" id="fm-name" class="form-control" disabled value="<?= $student_name; ?>">
            </div>
            <div class="form-group">
              <label for="fm-prev_school_name">Asal SMP</label>
              <input type="text" name="fm-prev_school_name" id="fm-prev_school_name" class="form-control">
            </div>
            <div class="form-group">
              <label for="fm-prev_school_name">Alamat SMP</label>
              <textarea name="fm-prev_school_address" id="fm-prev_school_address" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="fm-jurusan_id">Kejuruan yang diminati</label>
              <select name="fm-jurusan_id" class="form-control" id="fm-jurusan_id" required>
                <option value="">Pilih</option>
                <?php
                foreach ($jurusan as $row) {
                  echo '<option value="'.$row->id.'">'.$row->title.'</option>'; 
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <button name="fm-btn-save" id="fm-btn-save" class="btn btn-primary">Selanjutnya &rarr;</button>
            </div>
          </div>
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
        $('#fm-prev_school_name').val(res.row.prev_school_name)
        $('#fm-prev_school_address').val(res.row.prev_school_address)

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