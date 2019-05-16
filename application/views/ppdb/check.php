<script>

  function getData() {
    showLoader()

    $.ajax({
      url: '<?= $action; ?>',
      type: 'GET',
      success: (res) => {
        if (res.status == 'success') {
          // console.log(res)

          $('#fm-name-2').val(res.row.name)
          $('#fm-prev_school_name').val(res.row.prev_school_name)
          $('#fm-prev_school_address').val(res.row.prev_school_address)
          $('#fm-jurusan').val(res.row.jurusan)

          $('#fm-name').val(res.row.name)
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

          $('#fm-father_monthly_income').val(res.row.father_monthly_income)
          $('#fm-mother_monthly_income').val(res.row.mother_monthly_income)
          $('#fm-guardian_monthly_income').val(res.row.guardian_monthly_income)

          if (res.row.national_exam_scores) {
            $('#fm-exam_mtk_score').val(res.row.national_exam_scores.mtk)
            $('#fm-exam_bi_score').val(res.row.national_exam_scores.bi)
            $('#fm-exam_bingg_score').val(res.row.national_exam_scores.bing)
            $('#fm-exam_ipa_score').val(res.row.national_exam_scores.ipa)
          }

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

          let berkas_ijazah = res.row.berkas_ijazah
          let berkas_skhun = res.row.berkas_skhun
          let berkas_akte = res.row.berkas_akte
          let berkas_kk = res.row.berkas_kk
          let berkas_foto = res.row.berkas_foto

          if (berkas_ijazah) {
            $('#fm-berkas_ijazah_status')[0].className = 'fa fa-check text-success'
          } else {
            $('#fm-berkas_ijazah_status')[0].className = 'fa fa-times text-danger'
          }

          if (berkas_skhun) {
            $('#fm-berkas_skhun_status')[0].className = 'fa fa-check text-success'
          } else {
            $('#fm-berkas_skhun_status')[0].className = 'fa fa-times text-danger'
          }

          if (berkas_akte) {
            $('#fm-berkas_akte_status')[0].className = 'fa fa-check text-success'
          } else {
            $('#fm-berkas_akte_status')[0].className = 'fa fa-times text-danger'
          }

          if (berkas_kk) {
            $('#fm-berkas_kk_status')[0].className = 'fa fa-check text-success'
          } else {
            $('#fm-berkas_kk_status')[0].className = 'fa fa-times text-danger'
          }

          if (berkas_foto) {
            $('#fm-berkas_foto_status')[0].className = 'fa fa-check text-success'
          } else {
            $('#fm-berkas_foto_status')[0].className = 'fa fa-times text-danger'
          }

          // berkas_ijazah_status
          // berkas_skhun_status
          // berkas_akte_status
          // berkas_kk_status
          // berkas_foto_status
        }
        hideLoader()
      },
      failed: (error) => {
        console.log(error)
        hideLoader()
      }
    })
  }

  function uploadBerkas(name) {
    showLoader()

    let formData = new FormData()
    formData.append('user_id', '<?= $user_id; ?>')
    formData.append('berkas_name', name)

    $('input[name="fm-berkas[]"]').each(function (i, elm) {
      let file = $(this)[0].files[0]

      if (file) {
        // console.log(file)
        formData.append('berkas', file)
      }
    })

    $.ajax({
      url: '<?= $upload_action; ?>',
      type: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: function (res) {
        // console.log(res)
        hideLoader()
        showToast(res.status, res.message)

        clearForm()
        if (res.status == 'success') {
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

  function saveExamScores() {
    showLoader()

    let formData = new FormData()
    formData.append('user_id', '<?= $user_id; ?>')
    formData.append('exam_mtk_score', $('#fm-exam_mtk_score').val())
    formData.append('exam_bi_score', $('#fm-exam_bi_score').val())
    formData.append('exam_bingg_score', $('#fm-exam_bingg_score').val())
    formData.append('exam_ipa_score', $('#fm-exam_ipa_score').val())

    $.ajax({
      url: '<?= $save_exam_scores_action; ?>',
      type: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: function (res) {
        // console.log(res)
        hideLoader()
        showToast(res.status, res.message)

        if (res.status == 'success') {
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

  function confirmCandidate() {
    let formData = new FormData()
    formData.append('user_id', '<?= $user_id; ?>')

    $.ajax({
      url: '<?= $confirm_candidate_action; ?>',
      type: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: function (res) {
        // console.log(res)
        hideLoader()
        showToast(res.status, res.message)

      },
      failed: function (error) {
        console.log(error)
        hideLoader()
        showToast('failed', error)
      }
    })
  }

  function clearForm() {
    $('input[type="file"]').val('')
  }

  $(document).ready(() => {
    getData()

    $('#btn-upload-berkas-1').on('click', () => {
      uploadBerkas('berkas_ijazah')
    })

    $('#btn-upload-berkas-2').on('click', () => {
      uploadBerkas('berkas_skhun')
    })

    $('#btn-upload-berkas-3').on('click', () => {
      uploadBerkas('berkas_akte')
    })

    $('#btn-upload-berkas-4').on('click', () => {
      uploadBerkas('berkas_kk')
    })

    $('#btn-upload-berkas-5').on('click', () => {
      uploadBerkas('berkas_foto')
    })

    $('#fm-btn-save-exam-score').on('click', () => {
      saveExamScores()
    })

    $('#fm-confirm').on('click', () => {
      confirmCandidate()
    })
  })

</script>

<div class="container">
<div class="row">
  <div class="col-lg-12">
    <div class="ppdb-panel">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
          <a class="nav-link active" id="student-data-tab-6" data-toggle="tab" href="#student-data-tabpanel-6" role="tab" aria-controls="student-data-tabpanel-6" aria-selected="false">Sekilas Info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="student-data-tab-1" data-toggle="tab" href="#student-data-tabpanel-1" role="tab" aria-controls="student-data-tabpanel-1" aria-selected="true">Data Diri</a>
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
        <li class="nav-item">
          <a class="nav-link" id="student-data-tab-7" data-toggle="tab" href="#student-data-tabpanel-7" role="tab" aria-controls="student-data-tabpanel-7" aria-selected="false">Data Berkas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="student-data-tab-8" data-toggle="tab" href="#student-data-tabpanel-8" role="tab" aria-controls="student-data-tabpanel-8" aria-selected="false">Input Nilai UN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="student-data-tab-9" data-toggle="tab" href="#student-data-tabpanel-9" role="tab" aria-controls="student-data-tabpanel-9" aria-selected="false"><i class="fa fa-cog"></i> Konfirmasi?</a>
        </li>
      </ul>

      
      <div class="tab-content" id="myTabContent">
        
        <!-- TAB 1 -->
        <div class="tab-pane fade" id="student-data-tabpanel-1" role="tabpanel" aria-labelledby="student-data-tab-1">
          <div class="tab-panel-content disable-all-form">
            <fieldset disabled>
            <div class="form-group">
              <label for="fm-name">Nama Lengkap</label>
              <input type="text" name="fm-name" id="fm-name" class="form-control">
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
            </fieldset>
          </div>
        </div>

        <!-- TAB 2 -->
        <div class="tab-pane fade" id="student-data-tabpanel-2" role="tabpanel" aria-labelledby="student-data-tab-2">
          <div class="tab-panel-content">
            <fieldset disabled>
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
            </fieldset>
          </div>
        </div>

        <!-- TAB 3 -->
        <div class="tab-pane fade" id="student-data-tabpanel-3" role="tabpanel" aria-labelledby="student-data-tab-3">
          <div class="tab-panel-content">
            <fieldset disabled>
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
              <input type="number" name="fm-father_monthly_income" id="fm-father_monthly_income" class="form-control">
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
            </fieldset>
          </div>
        </div>

        <!-- TAB 4 -->
        <div class="tab-pane fade" id="student-data-tabpanel-4" role="tabpanel" aria-labelledby="student-data-tab-4">
          <div class="tab-panel-content">
            <fieldset disabled>
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
              <input type="number" name="fm-mother_monthly_income" id="fm-mother_monthly_income" class="form-control">
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
            </fieldset>
          </div>
        </div>

        <!-- TAB 5 -->
        <div class="tab-pane fade" id="student-data-tabpanel-5" role="tabpanel" aria-labelledby="student-data-tab-5">
          <div class="tab-panel-content">
          <fieldset disabled>
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
              <input type="number" name="fm-guardian_monthly_income" id="fm-guardian_monthly_income" class="form-control">
            </div>
            <div class="form-group">
              <label for="fm-guardian_phone">No Telp</label>
              <input type="text" name="fm-guardian_phone" id="fm-guardian_phone" class="form-control">
            </div>
            <div class="form-group">
              <label for="fm-guardian_email">E-mail</label>
              <input type="email" name="fm-guardian_email" id="fm-guardian_email" class="form-control">
            </div>
            </fieldset>
          </div>
        </div>

        <!-- TAB 6 -->
        <div class="tab-pane fade active in" id="student-data-tabpanel-6" role="tabpanel" aria-labelledby="student-data-tab-6">
          <div class="tab-panel-content">
          <fieldset disabled>
            <div class="form-group">
              <label for="fm-name-2">Nama Lengkap</label>
              <input type="text" name="fm-name-2" id="fm-name-2" class="form-control">
            </div>
            <div class="form-group">
              <label for="fm-prev_school_name">Asal SMP</label>
              <input type="text" name="fm-prev_school_name" id="fm-prev_school_name" class="form-control">
            </div>
            <div class="form-group">
              <label for="fm-prev_school_address">Alamat SMP</label>
              <textarea name="fm-prev_school_address" id="fm-prev_school_address" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="fm-jurusan">Jurusan yang diminati</label>
              <input type="text" name="fm-jurusan" id="fm-jurusan" class="form-control">
            </div>
          </fieldset>
          </div>
        </div>

        <!-- TAB 7 -->
        <div class="tab-pane fade" id="student-data-tabpanel-7" role="tabpanel" aria-labelledby="student-data-tab-7">
          <div class="tab-panel-content">
          <fieldset>
            <div class="form-group">
              <label for="fm-berkas_ijazah">
                [<i class="fa fa-check text-success" id="fm-berkas_ijazah_status"></i>]&nbsp; Ijazah
              </label>
              <div>
                <button class="btn btn-sm bg-navy" data-toggle="modal" data-target="#myModalBerkasIjazah">Upload</button>
              </div>
            </div>
            <div class="form-group">
              <label for="fm-berkas_skhun">
                [<i class="fa fa-times text-danger" id="fm-berkas_skhun_status"></i>]&nbsp; SKHUN
              </label>
              <div>
                <button class="btn btn-sm bg-navy" data-toggle="modal" data-target="#myModalBerkasSKHUN">Upload</button>
              </div>
            </div>
            <div class="form-group">
              <label for="fm-berkas_akte">
                [<i class="fa fa-times text-danger" id="fm-berkas_akte_status"></i>]&nbsp; Akte Kelahiran
              </label>
              <div>
                <button class="btn btn-sm bg-navy" data-toggle="modal" data-target="#myModalBerkasAkte">Upload</button>
              </div>
            </div>
            <div class="form-group">
              <label for="fm-berkas_kk">
                [<i class="fa fa-times text-danger" id="fm-berkas_kk_status"></i>]&nbsp; Kartu Keluarga
              </label>
              <div>
                <button class="btn btn-sm bg-navy" data-toggle="modal" data-target="#myModalBerkasKk">Upload</button>
              </div>
            </div>
            <div class="form-group">
              <label for="fm-berkas_foto">
                [<i class="fa fa-times text-danger" id="fm-berkas_foto_status"></i>]&nbsp; Pas Foto
              </label>
              <div>
                <button class="btn btn-sm bg-navy" data-toggle="modal" data-target="#myModalBerkasFoto">Upload</button>
              </div>
            </div>
          </fieldset>
          </div>
        </div>

        <!-- TAB 8 -->
        <div class="tab-pane fade" id="student-data-tabpanel-8" role="tabpanel" aria-labelledby="student-data-tab-8">
          <div class="tab-panel-content">
            <div class="form-horizontal">
              <div class="form-group">
                <label for="fm-exam_mtk_score" class="col-sm-2 control-label">MTK</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" name="fm-exam_mtk_score" id="fm-exam_mtk_score">
                </div>
              </div>
              <div class="form-group">
                <label for="fm-exam_bi_score" class="col-sm-2 control-label">B.I</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" name="fm-exam_bi_score" id="fm-exam_bi_score">
                </div>
              </div>
              <div class="form-group">
                <label for="fm-exam_bingg_score" class="col-sm-2 control-label">B.ING</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" name="fm-exam_bingg_score" id="fm-exam_bingg_score">
                </div>
              </div>
              <div class="form-group">
                <label for="fm-exam_ipa_score" class="col-sm-2 control-label">IPA</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" name="fm-exam_ipa_score" id="fm-exam_ipa_score">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="fm-btn-save-exam-score" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- TAB 9 -->
        <div class="tab-pane fade" id="student-data-tabpanel-9" role="tabpanel" aria-labelledby="student-data-tab-9">
          <div class="tab-panel-content">
            <p>Pastikan semua data sudah valid, sebelum menekan tombol dibawah ini.</p>
            <button id="fm-confirm" type="button" class="btn btn-default"><i class="fa fa-check"></i> SEMUA DATA SUDAH TERVERIFIKASI</button>
          </div>
        </div>

        <br>
        <br>
        
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal Berkas Ijazah -->
<div class="modal fade" id="myModalBerkasIjazah" tabindex="-1" role="dialog" aria-labelledby="myModalBerkasLabel1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalBerkasLabel1">Berkas Ijazah</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="fm-berkas[]" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-upload-berkas-1"><i class="fa fa-upload"></i> Upload</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Berkas SKHUN -->
<div class="modal fade" id="myModalBerkasSKHUN" tabindex="-1" role="dialog" aria-labelledby="myModalBerkasLabel2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalBerkasLabel2">Berkas SKHUN</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="fm-berkas[]" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-upload-berkas-2"><i class="fa fa-upload"></i> Upload</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Berkas Akte Kelahiran -->
<div class="modal fade" id="myModalBerkasAkte" tabindex="-1" role="dialog" aria-labelledby="myModalBerkasLabel3">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalBerkasLabel3">Berkas Akte Kelahiran</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="fm-berkas[]" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-upload-berkas-3"><i class="fa fa-upload"></i> Upload</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Berkas Kartu Keluarga -->
<div class="modal fade" id="myModalBerkasKk" tabindex="-1" role="dialog" aria-labelledby="myModalBerkasLabel4">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalBerkasLabel4">Berkas Kartu Keluarga</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="fm-berkas[]" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-upload-berkas-4"><i class="fa fa-upload"></i> Upload</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Berkas Pas Foto -->
<div class="modal fade" id="myModalBerkasFoto" tabindex="-1" role="dialog" aria-labelledby="myModalBerkasLabel5">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalBerkasLabel5">Berkas Pas Foto</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="fm-berkas[]" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-upload-berkas-5"><i class="fa fa-upload"></i> Upload</button>
      </div>
    </div>
  </div>
</div>