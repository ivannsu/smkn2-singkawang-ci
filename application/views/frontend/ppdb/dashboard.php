<?php $this->load->view('frontend/templates/open-html'); ?>

  <?php $this->load->view('frontend/templates/header'); ?>
  <?php $this->load->view('frontend/templates/navigations'); ?>

  <!-- CONTENT -->
  <section class="section-ppdb">
    <div class="container" style="max-width: 720px">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="text-center">Dashboard</h3>

          <div id="timeline-wrap">
            <div id="timeline"></div>
            <div class="marker mfirst timeline-icon active">
                <!-- <i class="fa fa-pencil"></i> -->
                1
            </div>
            <div class="marker m2 timeline-icon">
                <!-- <i class="fa fa-usd"></i> -->
                2
            </div>
            <div class="marker m3 timeline-icon">
              <!-- <i class="fa fa-list"></i> -->
              3
            </div>
            <div class="marker mlast timeline-icon">
              <!-- <i class="fa fa-check"></i> -->
              4
            </div>
          </div>

          <div style="margin-top: 80px;"></div>
          
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
  </section>
  <?php $this->load->view('frontend/templates/footer'); ?>

<?php $this->load->view('frontend/templates/close-html'); ?>
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