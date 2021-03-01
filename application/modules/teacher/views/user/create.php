<?php echo $form->messages(); ?>

<div class="row">

	<div class="col-md-6">
		<div class="card box-primary">
			<div class="card-header">
				<h3 class="card-title">User Info</h3>
			</div>
			<div class="card-body">
				<?php echo $form->open(); ?>

					<?php echo $form->bs3_text('First Name', 'first_name'); ?>
					<?php echo $form->bs3_text('Last Name', 'last_name'); ?>
					<?php echo $form->bs3_text('Username', 'username'); ?>
					<?php echo $form->bs3_text('Email', 'email'); ?>

					<?php echo $form->bs3_password('Password', 'password'); ?>
					<?php echo $form->bs3_password('Retype Password', 'retype_password'); ?>

					<?php if ( !empty($groups) ): ?>
					<div class="form-group">
						<label for="groups">Groups</label>
						<div>
						<?php foreach ($groups as $group): ?>
							<label class="checkbox-inline">
								<input type="checkbox" name="groups[]" value="<?php echo $group->id; ?>"> <?php echo $group->name; ?>
							</label>
						<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>

					<?php echo $form->bs3_submit(); ?>
					
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
	
</div>