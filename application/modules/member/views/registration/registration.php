<div class="login-box">
  <?php echo $form->messages(); ?>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>IDPAA</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
		<p class="login-box-msg">Signup for IDPAA new member</p>
			<?php echo $form->open(); ?>
				<?php echo $form->bs3_text('First Name', 'first_name'); ?>
				<?php echo $form->bs3_text('Last Name', 'last_name'); ?>
				<?php echo $form->bs3_text('Nickname', 'username'); ?>
				<?php echo $form->bs3_text('Email (your login)', 'email'); ?>
				<?php echo $form->bs3_password('Password', 'password'); ?>
				<?php echo $form->bs3_password('Retype Password', 'retype_password'); ?>
				<div class="row">
					<div class="col-6">
					</div>
					<div class="col-6">
						<?php echo $form->bs3_submit('Submit','btn btn-primary btn-block btn-flat'); ?>
					</div>
				</div>
			<?php echo $form->close(); ?>
      <p></p>
      <p class="mb-1">
        <a href="./registration/forgot_password">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="./login" class="text-center">Login</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>


