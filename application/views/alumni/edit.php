<script>

  function getData() {
    showLoader()

    let id = '<?= $id; ?>'
    let get_action = '<?= $get_action; ?>' + id

    $.ajax({
      url: get_action,
      method: 'GET',
      success: (res) => {
        $('#name').val(res.row.name)
        $('#address').val(res.row.address)
        $('#telp').val(res.row.telp)
        $('#email').val(res.row.email)
        $('#job').val(res.row.job)
        $('#college').val(res.row.college)

        if (res.row.gender == 'L') {
          $('#gender-male').attr('checked', 'checked');
        } else if (res.row.gender == 'P') {
          $('#gender-female').attr('checked', 'checked');
        }

        $('#angkatan option').each(function (i, elm) {
          if ($(this).val() == res.row.angkatan) {
            $(this).attr('selected', 'selected')
          }
        })

        $.each($('#jurusan_id option'), function (i, elm) {
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

    let id = '<?= $id; ?>'
    let formData = new FormData()
    formData.append('id', id)
    formData.append('name', $('#name').val())
    formData.append('address', $('#address').val())
    formData.append('telp', $('#telp').val())
    formData.append('email', $('#email').val())
    formData.append('job', $('#job').val())
    formData.append('college', $('#college').val())
    formData.append('angkatan', $('#angkatan option:selected').val())
    formData.append('jurusan_id', $('#jurusan_id option:selected').val())
    formData.append('gender', $('input[name="gender"]:checked').val())

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

  $(document).ready(() => {
    getData()

    $('#btn-update').on('click', () => {
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
    <input type="radio" name="gender" id="gender-male" value="L" required />&nbsp; Laki-laki
  </span>
  &nbsp;
  <span>
    <input type="radio" name="gender" id="gender-female" value="P" required />&nbsp; Perempuan
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
  <button name="btn-update" id="btn-update" type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
</div>