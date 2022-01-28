<div class="login-box">
  <?php echo $form->messages(); ?>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>IDPAA</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
		<?php echo $form->open(); ?>
			<?php echo $form->bs3_text('email', 'email', ENVIRONMENT==='development' ? 'member@member.com' : ''); ?>
			<?php echo $form->bs3_password('Password', 'password', ENVIRONMENT==='development' ? 'member' : ''); ?>

			<div class="row">
              <div class="col-6">
                <div class="icheck-primary">
                  <input type="checkbox" name="remember" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
				<div class="col-6">
					<?php echo $form->bs3_submit('Sign In', 'btn btn-primary btn-block btn-flat'); ?>
				</div>
			</div>
		<?php echo $form->close(); ?>

<!--
      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
-->
      <!-- /.social-auth-links -->
      <p></p>
      <p class="mb-1">
        <a href="./registration/forgot_password">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="./registration/signup" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>


