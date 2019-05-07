<h3><?= $page->title; ?></h3>
<small> <span class="fas fa-calendar-alt"></span> <?= dateformat($created_at[0]); ?>&nbsp; | &nbsp;<span class="fas fa-clock"></span> <?= timeformat($created_at[1]); ?></small>
<hr/>

<?php if ($page->image) { ?>
<div class="text-center">
  <img style="width: 100%" src="<?= base_url('media_library/posts/lg_'.$page->image); ?>" alt="Gambar <?= $page->title; ?>">
</div>
<?php } ?>

<p>
  <?= $page->content; ?>
</p>