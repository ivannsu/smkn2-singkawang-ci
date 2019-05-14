<?php $this->load->view('frontend/templates-ppdb/open-html'); ?>
  <?php $this->load->view('frontend/templates-ppdb/navigations'); ?>
  <?php $this->load->view('frontend/templates-ppdb/header'); ?>

  <!-- CONTENT -->
  <div class="ppdb-main-content">
    <div class="container" style="max-width: 800px">
      <div class="row">
        <div class="col-lg-12">

          <?php $this->load->view('frontend/templates-ppdb/timeline'); ?>

          <div style="margin-top: 80px;"></div>
          
          <h3 class="text-center">Langkah 2</h3>

          <div style="margin-top: 60px;"></div>

          <div class="ppdb-panel">
            
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
                    <label for="fm-name">Nama Lengkap</label>
                    <input type="text" name="fm-name" id="fm-name" class="form-control" disabled value="<?= $student_name; ?>">
                  </div>
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
                    <input type="date" name="bday" max="3000-12-31" min="1945-01-01" name="fm-birth_date" id="fm-birth_date" class="form-control">
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
                    <button name="fm-btn-save-1" id="fm-btn-save-1" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
              </div>

              <!-- TAB 2 -->
              <div class="tab-pane fade" id="student-data-tabpanel-2" role="tabpanel" aria-labelledby="student-data-tab-2">
                <div class="tab-panel-content">
                  <div class="form-group">
                    <label for="fm-height">Tinggi Badan (cm)</label>
                    <input type="number" name="fm-height" id="fm-height" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-weight">Berat Badan (kg)</label>
                    <input type="number" name="fm-weight" id="fm-weight" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-mileage">Jarak Tempuh ke Sekolah (meter)</label>
                    <input type="number" name="fm-mileage" id="fm-mileage" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-travelling_time">Waktu Tempuh ke Sekolah (menit)</label>
                    <input type="number" name="fm-travelling_time" id="fm-travelling_time" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-siblings_number">Jumlah Saudara Kandung</label>
                    <input type="number" name="fm-siblings_number" id="fm-siblings_number" class="form-control">
                  </div>
                  <div class="form-group">
                    <button name="fm-btn-save-2" id="fm-btn-save-2" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
              </div>

              <!-- TAB 3 -->
              <div class="tab-pane fade" id="student-data-tabpanel-3" role="tabpanel" aria-labelledby="student-data-tab-3">
                <div class="tab-panel-content">
                  <div class="form-group">
                    <label for="fm-father_name">Nama Ayah</label>
                    <input type="text" name="fm-father_name" id="fm-father_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-father_education">Pendidikan terakhir</label>
                    <input type="text" name="fm-father_education" id="fm-father_education" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-father_job">Pekerjaan</label>
                    <input type="text" name="fm-father_job" id="fm-father_job" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-father_monthly_income">Penghasilan perbulan</label>
                    <select name="fm-father_monthly_income" id="fm-father_monthly_income" class="form-control">
                      <option value="">Pilih</option>
                      <option value="1000000">Kurang dari 1 Juta</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="fm-father_phone">No Telp</label>
                    <input type="text" name="fm-father_phone" id="fm-father_phone" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-father_email">E-mail</label>
                    <input type="email" name="fm-father_email" id="fm-father_email" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-father_condition">Kondisi</label>
                    <select name="fm-father_condition" id="fm-father_condition" class="form-control">
                      <option value="">Pilih</option>
                      <option value="alive">Masih hidup</option>
                      <option value="passed away">Sudah meninggal</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button name="fm-btn-save-3" id="fm-btn-save-3" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
              </div>

              <!-- TAB 4 -->
              <div class="tab-pane fade" id="student-data-tabpanel-4" role="tabpanel" aria-labelledby="student-data-tab-4">
                <div class="tab-panel-content">
                  <div class="form-group">
                    <label for="fm-mother_name">Nama Ibu</label>
                    <input type="text" name="fm-mother_name" id="fm-mother_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-mother_education">Pendidikan terakhir</label>
                    <input type="text" name="fm-mother_education" id="fm-mother_education" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-mother_job">Pekerjaan</label>
                    <input type="text" name="fm-mother_job" id="fm-mother_job" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-mother_monthly_income">Penghasilan perbulan</label>
                    <select name="fm-mother_monthly_income" id="fm-mother_monthly_income" class="form-control">
                      <option value="">Pilih</option>
                      <option value="1000000">Kurang dari 1 Juta</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="fm-mother_phone">No Telp</label>
                    <input type="text" name="fm-mother_phone" id="fm-mother_phone" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-mother_email">E-mail</label>
                    <input type="email" name="fm-mother_email" id="fm-mother_email" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-mother_condition">Kondisi</label>
                    <select name="fm-mother_condition" id="fm-mother_condition" class="form-control">
                      <option value="">Pilih</option>
                      <option value="alive">Masih hidup</option>
                      <option value="passed away">Sudah meninggal</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button name="fm-btn-save-4" id="fm-btn-save-4" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
              </div>

              <!-- TAB 5 -->
              <div class="tab-pane fade" id="student-data-tabpanel-5" role="tabpanel" aria-labelledby="student-data-tab-5">
                <div class="tab-panel-content">
                  <div class="form-group">
                    <label for="fm-guardian_name">Nama Wali</label>
                    <input type="text" name="fm-guardian_name" id="fm-guardian_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-guardian_education">Pendidikan terakhir</label>
                    <input type="text" name="fm-guardian_education" id="fm-guardian_education" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-guardian_job">Pekerjaan</label>
                    <input type="text" name="fm-guardian_job" id="fm-guardian_job" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-guardian_monthly_income">Penghasilan perbulan</label>
                    <select name="fm-guardian_monthly_income" id="fm-guardian_monthly_income" class="form-control">
                      <option value="">Pilih</option>
                      <option value="1000000">Kurang dari 1 Juta</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="fm-guardian_phone">No Telp</label>
                    <input type="text" name="fm-guardian_phone" id="fm-guardian_phone" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="fm-guardian_email">E-mail</label>
                    <input type="email" name="fm-guardian_email" id="fm-guardian_email" class="form-control">
                  </div>
                  <div class="form-group">
                    <button name="fm-btn-save-5" id="fm-btn-save-5" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
              </div>

              <br>
              <br>
              <a href="<?= site_url('public/ppdb/step/3'); ?>" class="btn btn-success btn-block">Selanjutnya</a href="<?= site_url('public/ppdb/step/3'); ?>">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $this->load->view('frontend/templates-ppdb/footer'); ?>

<script>

  function getData() {
    showLoader()

    $.ajax({
      url: '<?= $get_action; ?>',
      method: 'GET',
      success: (res) => {
        // console.log(res)
        
        $('#fm-birth_place').val(res.row.birth_place)
        $('#fm-birth_date').val(res.row.birth_date)
        $('#fm-street_address').val(res.row.street_address)
        $('#fm-rt').val(res.row.rt)
        $('#fm-rw').val(res.row.rw)
        $('#fm-village').val(res.row.village)
        $('#fm-sub_district').val(res.row.sub_district)
        $('#fm-district').val(res.row.district)
        $('#fm-postal_code').val(res.row.postal_code)
        $('#fm-phone').val(res.row.phone)
        $('#fm-hobby').val(res.row.hobby)
        $('#fm-ambition').val(res.row.ambition)

        $('#fm-height').val(res.row.height)
        $('#fm-weight').val(res.row.weight)
        $('#fm-mileage').val(res.row.mileage)
        $('#fm-travelling_time').val(res.row.travelling_time)
        $('#fm-siblings_number').val(res.row.siblings_number)
        
        $('#fm-father_name').val(res.row.father_name)
        $('#fm-father_education').val(res.row.father_education)
        $('#fm-father_job').val(res.row.father_job)
        $('#fm-father_phone').val(res.row.father_phone)
        $('#fm-father_email').val(res.row.father_email)
        
        $('#fm-mother_name').val(res.row.mother_name)
        $('#fm-mother_education').val(res.row.mother_education)
        $('#fm-mother_job').val(res.row.mother_job)
        $('#fm-mother_phone').val(res.row.mother_phone)
        $('#fm-mother_email').val(res.row.mother_email)
        
        $('#fm-guardian_name').val(res.row.guardian_name)
        $('#fm-guardian_education').val(res.row.guardian_education)
        $('#fm-guardian_job').val(res.row.guardian_job)
        $('#fm-guardian_phone').val(res.row.guardian_phone)
        $('#fm-guardian_email').val(res.row.guardian_email)

        $.each($('#fm-gender option'), function (i, elm) {
          if ($(this).val() == res.row.gender) {
            $(this).attr('selected', 'selected')
          }
        })

        $.each($('#fm-religion option'), function (i, elm) {
          if ($(this).val() == res.row.religion) {
            $(this).attr('selected', 'selected')
          }
        })

        $.each($('#fm-father_monthly_income option'), function (i, elm) {
          if ($(this).val() == res.row.father_monthly_income) {
            $(this).attr('selected', 'selected')
          }
        })

        $.each($('#fm-mother_monthly_income option'), function (i, elm) {
          if ($(this).val() == res.row.mother_monthly_income) {
            $(this).attr('selected', 'selected')
          }
        })

        $.each($('#fm-father_condition option'), function (i, elm) {
          if ($(this).val() == res.row.father_condition) {
            $(this).attr('selected', 'selected')
          }
        })

        $.each($('#fm-mother_condition option'), function (i, elm) {
          if ($(this).val() == res.row.mother_condition) {
            $(this).attr('selected', 'selected')
          }
        })

        $.each($('#fm-guardian_monthly_income option'), function (i, elm) {
          if ($(this).val() == res.row.guardian_monthly_income) {
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

    formData.append('gender', $('#fm-gender option:selected').val())
    formData.append('birth_place', $('#fm-birth_place').val())
    formData.append('birth_date', $('#fm-birth_date').val())
    formData.append('religion', $('#fm-religion option:selected').val())
    formData.append('street_address', $('#fm-street_address').val())
    formData.append('rt', $('#fm-rt').val())
    formData.append('rw', $('#fm-rw').val())
    formData.append('village', $('#fm-village').val())
    formData.append('sub_district', $('#fm-sub_district').val())
    formData.append('district', $('#fm-district').val())
    formData.append('postal_code', $('#fm-postal_code').val())
    formData.append('phone', $('#fm-phone').val())
    formData.append('hobby', $('#fm-hobby').val())
    formData.append('ambition', $('#fm-ambition').val())

    formData.append('height', $('#fm-height').val())
    formData.append('weight', $('#fm-weight').val())
    formData.append('mileage', $('#fm-mileage').val())
    formData.append('travelling_time', $('#fm-travelling_time').val())
    formData.append('siblings_number', $('#fm-siblings_number').val())

    formData.append('father_name', $('#fm-father_name').val())
    formData.append('father_education', $('#fm-father_education').val())
    formData.append('father_job', $('#fm-father_job').val())
    formData.append('father_monthly_income', $('#fm-father_monthly_income').val())
    formData.append('father_phone', $('#fm-father_phone').val())
    formData.append('father_email', $('#fm-father_email').val())
    formData.append('father_condition', $('#fm-father_condition').val())

    formData.append('mother_name', $('#fm-mother_name').val())
    formData.append('mother_education', $('#fm-mother_education').val())
    formData.append('mother_job', $('#fm-mother_job').val())
    formData.append('mother_monthly_income', $('#fm-mother_monthly_income').val())
    formData.append('mother_phone', $('#fm-mother_phone').val())
    formData.append('mother_email', $('#fm-mother_email').val())
    formData.append('mother_condition', $('#fm-mother_condition').val())

    formData.append('guardian_name', $('#fm-guardian_name').val())
    formData.append('guardian_education', $('#fm-guardian_education').val())
    formData.append('guardian_job', $('#fm-guardian_job').val())
    formData.append('guardian_monthly_income', $('#fm-guardian_monthly_income').val())
    formData.append('guardian_phone', $('#fm-guardian_phone').val())
    formData.append('guardian_email', $('#fm-guardian_email').val())

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
      },
      failed: (error) => {
        console.log(error)
        hideLoader()
        showToast('failed', error)
      }
    })
  }

  window.addEventListener('load', function() {
    getData()

    $('button[id^="fm-btn-save"]').each(function (i, elm) {
      $(this).on('click', () => {
        
        submitPost()
      })
    })
  })

</script>

<?php $this->load->view('frontend/templates-ppdb/close-html'); ?>