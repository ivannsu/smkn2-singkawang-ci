<h3><?= $information->title; ?></h3>
<small> <span class="fas fa-calendar-alt"></span> <?= dateformat($created_at[0]); ?>&nbsp; | &nbsp;<span class="fas fa-clock"></span> <?= timeformat($created_at[1]); ?></small>
<hr/>

<p>
  <?= $information->content; ?>
</p>