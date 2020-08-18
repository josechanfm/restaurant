<div class='card  <?php echo $style.' '.$outline; ?>'>
	<div class='card-header with-border'>
		<h3 class='card-title'><?php echo $title; ?></h3>
	</div>
	<div class='card-body'>
		<?php echo $body; ?>
	</div>
	<?php if (!empty($footer)): ?>
		<div class='card-footer'><?php echo $footer; ?></div>
	<?php endif; ?>
</div>