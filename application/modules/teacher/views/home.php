<div class="row">

	<div class="col-md-4">
		<?php echo modules::run('adminlte/widget/card_open', 'Shortcuts','success',true); ?>
			<?php echo modules::run('adminlte/widget/app_btn', 'fa fa-user', 'Account', 'panel/account'); ?>
			<?php echo modules::run('adminlte/widget/app_btn', 'fa fa-sign-out', 'Logout', 'panel/logout'); ?>
		<?php echo modules::run('adminlte/widget/card_close'); ?>
	</div>

	<div class="col-md-4">
		<?php echo modules::run('adminlte/widget/info_box', 'yellow', $count['users'], 'Users', 'fa fa-users', 'user'); ?>
	</div>

	<div class="col-md-4">
		<?php echo modules::run('adminlte/widget/user_box'); ?>
	</div>
	
</div>
<div class="row">
	<div class="col-md-4">
	<?php echo modules::run('adminlte/widget/small_box', 'yellow', 1, 'Label','fa fa-users'); ?>
	</div>
	<div class="col-md-4">
	<?php echo modules::run('adminlte/widget/card', 'Hello','ABC','primary'); ?>
	</div>	
</div>
