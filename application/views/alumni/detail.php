<script>

  function getData() {
    let id = '<?= $id; ?>'
    let action = '<?= $action; ?>' + id
    let img_src_url = BASE_URL + 'media_library/posts/'

    $.ajax({
      url: action,
      method: 'GET',
      success: (res) => {
        // console.log(res);

        if (res.status == 'success') {
          $('#name').text(res.row.name)
          $('#gender').text(res.row.gender)
          $('#address').text(res.row.address)
          $('#telp').text(res.row.telp)
          $('#email').text(res.row.email)
          $('#angkatan').text(res.row.angkatan)
          $('#jurusan').text(res.row.jurusan)
          $('#job').text(res.row.job)
          $('#college').text(res.row.college)
        } else {

        }
      },
      failed: (error) => {
        console.log(error)
      }
    })
  }

  $(document).ready(() => {
    getData()
  })

</script>

<table class="table">
  <tbody>
    <tr>
      <td>NAMA</td>
      <td>:</td>
      <td id="name"></td>
    </tr>
    <tr>
      <td>JENIS KELAMIN</td>
      <td>:</td>
      <td id="gender"></td>
    </tr>
    <tr>
      <td>ALAMAT</td>
      <td>:</td>
      <td id="address"></td>
    </tr>
    <tr>
      <td>NO TELP</td>
      <td>:</td>
      <td id="telp"></td>
    </tr>
    <tr>
      <td>EMAIL</td>
      <td>:</td>
      <td id="email"></td>
    </tr>
    <tr>
      <td>ANGKATAN</td>
      <td>:</td>
      <td id="angkatan"></td>
    </tr>
    <tr>
      <td>JURUSAN</td>
      <td>:</td>
      <td id="jurusan"></td>
    </tr>
    <tr>
      <td>PEKERJAAN</td>
      <td>:</td>
      <td id="job"></td>
    </tr>
    <tr>
      <td>PERKULIAHAN</td>
      <td>:</td>
      <td id="college"></td>
    </tr>
  </tbody>
</table>