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

window.addEventListener('load', function() {
  $('#btn-create').on('click', () => {
    console.log('helo')
  })
})

</script>