<h3><?= $album_title; ?></h3>
<hr/>
<br/>

<div class="row">
  <?php
  foreach ($photos as $row) {
    $id = $row->id;
    $image = $row->image;
    $img_src = base_url('media_library/gallery/lg_'.$image);
    $img_thumb = base_url('media_library/gallery/sm_'.$image);

    $vars = [
      '%photo%' => '<a data-fancybox="gallery" href="'.$img_src.'"><img src="'.$img_thumb.'" class="img-thumbnail" alt="Foto '.$album_title.'"></a>'
    ];
    
    $template = '
    <div class="col-lg-3" style="margin-bottom: 20px">
      %photo%
    </div>
    ';
  
    echo strtr($template, $vars);
  }
  ?>
</div>