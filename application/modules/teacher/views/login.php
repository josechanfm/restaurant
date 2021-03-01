<div class="login-box">

	<div class="login-logo"><b><?php echo $site_name; ?></b></div>

	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>
		<?php echo $form->open(); ?>
			<?php echo $form->messages(); ?>
			<?php echo $form->bs3_text('Username', 'username', ENVIRONMENT==='development' ? 'webmaster' : ''); ?>
			<?php echo $form->bs3_password('Password', 'password', ENVIRONMENT==='development' ? 'webmaster' : ''); ?>
				<div class="checkbox mb-3">
						<label><input type="checkbox" name="remember"> Remember Me</label>
				</div>

				<?php echo $form->bs3_submit('Sign In', 'btn btn-primary btn-block btn-flat'); ?>
		<?php echo $form->close(); ?>
	</div>

</div>