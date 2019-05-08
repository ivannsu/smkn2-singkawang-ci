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
        console.log(res)
        hideLoader()
        showToast(res.status, res.message)

        if (res.status == 'success') {
          // clearForm()
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
    
    $('#btn-create').on('click', () => {
      submitPost()
    })
  })

</script>

<div class="form-group">
  <h5>Nama <span class="text-danger">*</span></h5>
  <input type="text" class="form-control" name="name" id="name" required />
</div>

<div class="form-group">
  <h5>Jenis Kelamin <span class="text-danger">*</span></h5>
  <span>
    <input type="radio" name="gender" value="L" required />&nbsp; Laki-laki
  </span>
  &nbsp;
  <span>
    <input type="radio" name="gender" value="P" required />&nbsp; Perempuan
  </span>
</div>

<div class="form-group">
  <h5>Alamat <span class="text-danger">*</span></h5>
  <textarea name="address" id="address" rows="3" class="form-control" required></textarea>
</div>

<div class="form-group">
  <h5>No Telp <span class="text-danger">*</span></h5>
  <input type="text" class="form-control" name="telp" id="telp" required />
</div>

<div class="form-group">
  <h5>E-mail</h5>
  <input type="email" class="form-control" name="email" id="email" />
</div>

<div class="form-group">
  <h5>Angkatan <span class="text-danger">*</span></h5>
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
  <h5>Jurusan <span class="text-danger">*</span></h5>
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
  <h5>Pekerjaan</h5>
  <input type="text" class="form-control" name="job" id="job" />
</div>

<div class="form-group">
  <h5>Perguruan Tinggi</h5>
  <input type="text" class="form-control" name="college" id="college" />
</div>

<div class="form-group">
  <h5>Foto Profil <span class="text-danger">*</span></h5>
  <input type="file" name="image" required />
</div>

<br>
<div class="form-group">
  <button name="btn-create" id="btn-create" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
</div>