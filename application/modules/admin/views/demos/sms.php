<div class="row">
<form action="<?=site_url()?>api/sms/send" method="post">
	<?php 
	$key=date('Y-m-d');
	?>
	<input type="hidden" name="secret_key" value="<?=hash('crc32','123456'.$key,false)?>">
	<input type="phone" name="recipient"><br>
	<input type="content" name="content"><br>
	<input type="submit">
</form>

</form>	
</div>
