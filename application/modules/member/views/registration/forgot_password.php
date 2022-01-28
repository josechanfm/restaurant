<div class="login-box">
  <?php echo $form->messages(); ?>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Forgot</b></a>
    </div>
    <div class="card-body">
		<p class="login-box-msg">Reset member password</p>
			<?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Email', 'email'); ?>
				<div class="row">
					<div class="col-6">
					</div>
					<div class="col-6 text-center">
						<?php echo $form->bs3_submit('Submit','btn btn-primary btn-block btn-flat'); ?>
					</div>
				</div>
			<?php echo $form->close(); ?>
      <p></p>
      <p class="mb-1">
        <a href="./registration/login" class="text-center">Login</a>
      </p>
      <p class="mb-1">
        <a href="./registration/signup" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

