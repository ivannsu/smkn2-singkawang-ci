<h3><?= $prestasi->title; ?></h3>
<small> <span class="fas fa-calendar-alt"></span> <?= dateformat($created_at[0]); ?>&nbsp; | &nbsp;<span class="fas fa-clock"></span> <?= timeformat($created_at[1]); ?></small>
<hr/>

<?php if ($prestasi->image) { ?>
<div class="text-center">
  <img style="width: 100%" src="<?= base_url('media_library/prestasi/lg_'.$prestasi->image); ?>" alt="Gambar <?= $prestasi->title; ?>">
</div>
<?php } ?>

<p>
  <?= $prestasi->content; ?>
</p>