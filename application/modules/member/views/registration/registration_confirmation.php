<div class="login-box">
	<div class="login-logo"><b>Confirmation page</b></div>
	<?php echo $form->messages(); ?>
	<div class="login-box-body">
		<p class="login-box-msg">Signup IDPAA member</p>
		<p class="login-box-msg">Please refer to your email for the confirmation passcode.</p>
			<?php echo $form->open(); ?>
				<?php echo $form->bs3_password('Passcode', 'passcode'); ?>
				<?php echo $form->bs3_submit(); ?>
			<?php echo $form->close(); ?>
	      <p></p>
	      <p class="mb-1">
	        <a href="./registration/login" class="text-center">Login</a>
	      </p>
	      <p class="mb-1">
	        <a href="./registration/forgot_password">I forgot my password</a>
	      </p>
	      <p class="mb-1">
	        <a href="./registration/signup" class="text-center">Register a new membership</a>
	      </p>
	</div>
</div>
