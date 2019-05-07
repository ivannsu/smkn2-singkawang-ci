<h3>Album Foto</h3>
<br/>

<ul class="list-group list-group-flush">
  <?php
  foreach ($albums as $row) {
    $id = $row->id;
    $title = $row->title;
    $href = site_url('public/page/index/album/'.$id);

    echo '
      <li class="list-group-item">
        <a href="'.$href.'">'.$title.'</a>
      </li>
    ';
  }
  ?>
</ul>