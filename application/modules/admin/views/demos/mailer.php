<?php echo $form->messages(); ?>

<div class="row">

	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">User Info</h3>
			</div>
			<div class="box-body">
				<?php echo $form->open(); ?>

					<?php echo $form->bs3_text('Sender email', 'sender_email'); ?>
					<?php echo $form->bs3_text('Sender name', 'sender_name'); ?>
					<?php echo $form->bs3_text('Reciever email', 'reciever_email'); ?>
					<?php echo $form->bs3_text('Reciever name', 'reciever_name'); ?>
					<?php echo $form->bs3_text('Subject', 'subject'); ?>
					<?php echo $form->bs3_textarea('Message', 'message'); ?>
					<?php echo $form->bs3_recaptcha('Captcha', 'captcha'); ?>
					<?php echo $form->bs3_submit(); ?>
					
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
	
</div>