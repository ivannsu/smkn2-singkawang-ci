<h3 class="text-center"><?= $jurusan->title; ?></h3>
<hr/>

<?php if ($jurusan->image) { ?>
<div class="text-center">
  <img src="<?= base_url('media_library/jurusan/md_'.$jurusan->image); ?>" alt="Gambar <?= $jurusan->title; ?>">
</div>
<?php } ?>

<p style="margin-top: 40px;">
  <?= $jurusan->content; ?>
</p>