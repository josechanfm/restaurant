<nav class="main-header navbar navbar-expand navbar-white navbar-light <?php echo $navbar_fixed_top==TRUE?'navbar-fixed-top':''?>" role="navigation">
<!--<nav class="navbar navbar-default navbar-fixed-top" role="navigation">-->

	<div class="navbar-nav">
		<a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a>
	</div>

<div class="container">
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
	      <li >
	        <a href="." class="nav-link">Home</a>
	      </li>
	    </ul>
	</div>

	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href=""><?php echo $site_name; ?></a>
	</div>

	<div class="navbar-collapse collapse">

		<ul class="nav navbar-nav">
			<?php foreach ($menu as $parent => $parent_params): ?>

				<?php if (empty($parent_params['children'])): ?>

					<?php $active = ($current_uri==$parent_params['url'] || $ctrler==$parent); ?>
					<li <?php if ($active) echo 'class="active"'; ?>>
						<a href='<?php echo $parent_params['url']; ?>'>
							<?php echo $parent_params['name']; ?>
						</a>
					</li>

				<?php else: ?>

					<?php $parent_active = ($ctrler==$parent); ?>
					<li class='dropdown <?php if ($parent_active) echo 'active'; ?>'>
						<a data-toggle='dropdown' class='dropdown-toggle' href='#'>
							<?php echo $parent_params['name']; ?> <span class='caret'></span>
						</a>
						<ul role='menu' class='dropdown-menu'>
							<?php foreach ($parent_params['children'] as $name => $url): ?>
								<li><a href='<?php echo $url; ?>'><?php echo $name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</li>

				<?php endif; ?>

			<?php endforeach; ?>
		</ul>

		<?php $this->load->view('_partials/language_switcher'); ?>
		
	</div>

</div>
</nav>

