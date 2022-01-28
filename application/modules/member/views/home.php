<div class="row">

	<div class="col-md-4">
		<?php echo modules::run('adminlte/widget/card_open', 'Shortcuts','success',true); ?>
			<?php echo modules::run('adminlte/widget/app_btn', 'fa fa-user', 'Account', 'panel/account'); ?>
			<?php echo modules::run('adminlte/widget/app_btn', 'fa fa-sign-out', 'Logout', 'panel/logout'); ?>
		<?php echo modules::run('adminlte/widget/card_close'); ?>
	</div>

	<div class="col-md-4">
		<div class="card  card-primary ">
			<div class="card-header with-border">
				<h3 class="card-title">Hello</h3>
			</div>
			<div class="card-body">
				<a href="./product/">Products</a><br>
				<a href="./product/available">Available</a><br>
				<a href="./product/lent">Lent</a><br>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<?php echo modules::run('adminlte/widget/small_box', 'yellow', 1, 'Label','fa fa-users'); ?>
	</div>

	
</div>
