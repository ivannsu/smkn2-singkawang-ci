<style>
@import url('<?= base_url('assets/css/spinner.css') ?>');
@import url('<?= base_url('assets/css/toastr/toastr.min.css') ?>');
</style>

<!-- SPINNER -->
<div class="loading-container">
  <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>

<h3>Registrasi Alumni</h3>
<hr>
<br>

<div class="form-group">
  <label>Nama <span class="text-danger">*</span></label>
  <input type="text" class="form-control" name="name" id="name" required />
</div>

<div class="form-group">
  <div><label>Jenis Kelamin <span class="text-danger">*</span></label></div>
  <span>
    <input type="radio" name="gender" value="L" required />&nbsp; Laki-laki
  </span>
  &nbsp;
  <span>
    <input type="radio" name="gender" value="P" required />&nbsp; Perempuan
  </span>
</div>

<div class="form-group">
  <label>Alamat <span class="text-danger">*</span></label>
  <textarea name="address" id="address" rows="3" class="form-control" required></textarea>
</div>

<div class="form-group">
  <label>No Telp <span class="text-danger">*</span></label>
  <input type="text" class="form-control" name="telp" id="telp" required />
</div>

<div class="form-group">
  <label>E-mail</label>
  <input type="email" class="form-control" name="email" id="email" />
</div>

<div class="form-group">
  <label>Angkatan <span class="text-danger">*</span></label>
  <select name="angkatan" id="angkatan" class="form-control" required>
    <option value="">Pilih</option>
    <?php
    for ($i = 1973; $i <= intval(Date('Y')); $i++) {
      echo '<option value="'.$i.'">'.$i.'</option>';
    }
    ?>
  </select>
</div>

<div class="form-group">
  <label>Jurusan <span class="text-danger">*</span></label>
  <select name="jurusan_id" class="form-control" id="jurusan_id" required>
    <option value="">Pilih</option>
    <?php
    foreach ($jurusan as $row) {
      echo '<option value="'.$row->id.'">'.$row->title.'</option>'; 
    }
    ?>
  </select>
  <!-- <input type="text" class="form-control" name="jurusan_id" /> -->
</div>

<div class="form-group">
  <label>Pekerjaan</label>
  <input type="text" class="form-control" name="job" id="job" />
</div>

<div class="form-group">
  <label>Perguruan Tinggi</label>
  <input type="text" class="form-control" name="college" id="college" />
</div>

<!-- <div class="form-group">
  <label>Foto Profil <span class="text-danger">*</span></label>
  <input type="file" name="image" required />
</div> -->

<br>
<div class="form-group">
  <button name="btn-create" id="btn-create" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
</div>

<script>

  function submitPost() {
    showLoader()

    let formData = new FormData()
    formData.append('name', $('#name').val())
    formData.append('gender', $('input[name="gender"]:checked').val())
    formData.append('address', $('#address').val())
    formData.append('telp', $('#telp').val())
    formData.append('email', $('#email').val())
    formData.append('angkatan', $('#angkatan option:selected').val())
    formData.append('jurusan_id', $('#jurusan_id option:selected').val())
    formData.append('job', $('#job').val())
    formData.append('college', $('#college').val())

    $.ajax({
      url: '<?= $action; ?>',
      type: 'POST',
      data: formData,
      contentType: false,
			processData: false,
      success: function (res) {
        hideLoader()
        showToast(res.status, res.message)

        if (res.status == 'success') {
          clearForm()
        }
      },
      failed: function (error) {
        hideLoader()
        showToast('failed', 'Oops something wrong... Please try again later.')
      }
    })
  }

  function clearForm() {
    $('input[type="text"], input[type="file"]').val('')
  }

  window.addEventListener('load', function() {
    $('#btn-create').on('click', () => {
      submitPost()
    })
  })

</script>