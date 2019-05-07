<h3>Berita Terbaru</h3>
<br/>

<ul class="list-group list-group-flush">
  <?php
  foreach ($articles as $row) {
    $id = $row->id;
    $title = $row->title;
    $created_at =  explode(' ', $row->created_at);
    $date = dateformat($created_at[0]);
    $time = timeformat($created_at[1]);
    $href = site_url('public/page/index/article/'.$id);

    echo '
      <li class="list-group-item">
        <a href="'.$href.'">'.$title.'</a>
        <br/>
        <small>
          <span class="fas fa-calendar-alt"></span> '.$date.'&nbsp; | &nbsp;<span class="fas fa-clock"></span> '.$time.'
        </small>
      </li>
    ';
  }
  ?>
</ul>