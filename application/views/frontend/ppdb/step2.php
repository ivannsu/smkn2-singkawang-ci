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
            <div class="marker m2 timeline-icon active">
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

          <!-- TAB NAVIGATIONS -->
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="student-data-tab-1" data-toggle="tab" href="#student-data-tabpanel-1" role="tab" aria-controls="student-data-tabpanel-1" aria-selected="true">Data Diri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="student-data-tab-2" data-toggle="tab" href="#student-data-tabpanel-2" role="tab" aria-controls="student-data-tabpanel-2" aria-selected="false">Data Periodik</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="student-data-tab-3" data-toggle="tab" href="#student-data-tabpanel-3" role="tab" aria-controls="student-data-tabpanel-3" aria-selected="false">Data Ayah Kandung</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="student-data-tab-4" data-toggle="tab" href="#student-data-tabpanel-4" role="tab" aria-controls="student-data-tabpanel-4" aria-selected="false">Data Ibu Kandung</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="student-data-tab-5" data-toggle="tab" href="#student-data-tabpanel-5" role="tab" aria-controls="student-data-tabpanel-5" aria-selected="false">Data Wali</a>
            </li>
          </ul>

          <!-- TAB 1 -->
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="student-data-tabpanel-1" role="tabpanel" aria-labelledby="student-data-tab-1">
              <div class="tab-panel-content">
                <div class="form-group">
                  <label for="fm-gender">Jenis Kelamin</label>
                  <select name="fm-gender" id="fm-gender" class="form-control">
                    <option value="">Pilih</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="fm-birth_place">Tempat Lahir</label>
                  <input type="text" name="fm-birth_place" id="fm-birth_place" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-birth_date">Tanggal Lahir</label>
                  <input type="text" name="fm-birth_date" id="fm-birth_date" class="form-control">
                </div>
                <!-- <div class="form-group">
                    <label >Begin voorverkoop periode</label>
                    <input type="date" name="bday" max="3000-12-31" 
                            min="1000-01-01" class="form-control">
                  </div> -->
                <div class="input-group date" data-provide="datepicker">
                  <input type="text" class="form-control">
                  <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="fm-religion">Agama</label>
                  <select name="fm-religion" id="fm-religion" class="form-control">
                    <option value="">Pilih</option>
                    <option value="islam">Islam</option>
                    <option value="kristen">Kristen</option>
                    <option value="katolik">Katolik</option>
                    <option value="hindu">Hindu</option>
                    <option value="buddha">Buddha</option>
                    <option value="konghucu">Kong Hu Cu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="fm-street_address">Alamat Jalan</label>
                  <input type="text" name="fm-street_address" id="fm-street_address" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-rt">RT</label>
                  <input type="text" name="fm-rt" id="fm-rt" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-rw">RW</label>
                  <input type="text" name="fm-rw" id="fm-rw" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-village">Kelurahan</label>
                  <input type="text" name="fm-village" id="fm-village" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-sub_district">Kecamatan</label>
                  <input type="text" name="fm-sub_district" id="fm-sub_district" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-district">Kabupaten / Kota</label>
                  <input type="text" name="fm-district" id="fm-district" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-postal_code">Kode POS</label>
                  <input type="text" name="fm-postal_code" id="fm-postal_code" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-phone">No Handphone</label>
                  <input type="text" name="fm-phone" id="fm-phone" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-hobby">Hobi</label>
                  <input type="text" name="fm-hobby" id="fm-hobby" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fm-ambition">Cita-cita</label>
                  <input type="text" name="fm-ambition" id="fm-ambition" class="form-control">
                </div>
                <div class="form-group">
                  <button name="fm-btn-save-tab-1" id="fm-btn-save-tab-1" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
              </div>
            </div>

            <!-- TAB 2 -->
            <div class="tab-pane fade" id="student-data-tabpanel-2" role="tabpanel" aria-labelledby="student-data-tab-2">
              <div class="tab-panel-content">
                <h3>Tab 2</h3>
              </div>
            </div>

            <!-- TAB 3 -->
            <div class="tab-pane fade" id="student-data-tabpanel-3" role="tabpanel" aria-labelledby="student-data-tab-3">
              <div class="tab-panel-content">
                <h3>Tab 3</h3>
              </div>
            </div>

            <!-- TAB 4 -->
            <div class="tab-pane fade" id="student-data-tabpanel-4" role="tabpanel" aria-labelledby="student-data-tab-4">
              <div class="tab-panel-content">
                <h3>Tab 4</h3>
              </div>
            </div>

            <!-- TAB 5 -->
            <div class="tab-pane fade" id="student-data-tabpanel-5" role="tabpanel" aria-labelledby="student-data-tab-5">
              <div class="tab-panel-content">
                <h3>Tab 5</h3>
              </div>
            </div>
          </div>

          <!-- <div class="form-group">
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
          </div> -->
          <!-- <div class="form-group">
            <button name="fm-btn-save" id="fm-btn-save" class="btn btn-primary">Selanjutnya &rarr;</button>
          </div> -->
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
            document.location = '<?= $redirect_link; ?>'
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