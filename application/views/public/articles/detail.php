<h3><?= $article->title; ?></h3>
<small> <span class="fas fa-calendar-alt"></span> <?= dateformat($created_at[0]); ?>&nbsp; | &nbsp;<span class="fas fa-clock"></span> <?= timeformat($created_at[1]); ?></small>
<hr/>

<?php if ($article->image) { ?>
<div class="text-center">
  <img style="width: 100%" src="<?= base_url('media_library/posts/lg_'.$article->image); ?>" alt="Gambar <?= $article->title; ?>">
</div>
<?php } ?>

<p>
  <?= $article->content; ?>
</p>