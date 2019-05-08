<h3>Data Alumni</h3>
<p>
<?php
// if ($alumni_jurusan AND !$alumni_angkatan) { 
//   $jurusan = $jurusanModel->getById($alumni_jurusan)['name'];
//   echo "/ $jurusan";
// } else if ($alumni_jurusan AND $alumni_angkatan) {
//   $jurusan = $jurusanModel->getById($alumni_jurusan)['name'];
//   echo "/ $jurusan / $alumni_angkatan";
// }
?>
</p>
<hr>
<br>

<div class="row">

<?php 
// SHOW ALUMNI BY JURUSAN
if ($alumni_jurusan AND ! $alumni_angkatan) { 
  if (count($alumni) > 0) {
    foreach ($alumni as $row) {
      $angkatan = $row->angkatan;
  
      $vars = [
        '%angkatan%' => $angkatan,
        '%jurusan_name%' => $jurusan,
        '%href%' => site_url("public/page/index/alumni/$alumni_jurusan/$angkatan")
      ];
      $template = '
        <div class="col-lg-6">
          <div class="list-group m-b-list-group">
            <a href="%href%" class="list-group-item list-group-item-action">
              %jurusan_name% - %angkatan%
            </a>
          </div>
        </div>
      ';
  
      echo strtr($template, $vars);
    }
  } else {
    echo '<div class="col-lg-12">Belum ada Data</div>';
  }
  
}

// SHOW ALUMNI BY JURUSAN AND ANGKATAN
else if ($alumni_jurusan AND $alumni_angkatan) {

  foreach ($alumni as $row) {
    $id = $row->id;
    $name = $row->name;
    $jurusan = $row->jurusan;
    $angkatan = $row->angkatan;
    $image = ($row->alumni_image) ? $row->alumni_image : 'placeholder.png';

    $vars = [
      '%name%' => $name,
      '%jurusan%' => $jurusan,
      '%angkatan%' => $angkatan,
      '%href%' => site_url(),
      '%img_src%' => base_url("media_library/alumni/$image"),
      '%img_alt%' => "Foto $name",
    ];
    $template = '
      <div class="col-lg-3">
        <div class="list-group m-b-list-group">
          <div class="list-group-item text-center">
            <img src="%img_src%" alt="%img_alt%" class="img-fluid img-thumbnail" />
            <div style="margin-top: 10px;">
              <h5 style="text-transform: uppercase">%name%</h5>
              <small>%jurusan% - %angkatan%</small>
            </div>
          </div>
        </div>
      </div>
    ';

    echo strtr($template, $vars);
  }
}

// SHOW ALL ALUMNI JURUSAN
else { 
  foreach ($jurusan as $row) {
    $id = $row->id;
    $name = $row->title;

    $vars = [
      '%name%' => $name,
      '%href%' => site_url('public/page/index/alumni/'.$id)
    ];
    $template = '
      <div class="col-lg-6">
        <div class="list-group m-b-list-group">
          <a href="%href%" class="list-group-item list-group-item-action">
            %name%
          </a>
        </div>
      </div>
    ';

    echo strtr($template, $vars);
  }
}
?>
</div>