<!-- Main Sidebar Container -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

	<?php foreach ($menu as $parent => $parent_params): ?>

		<?php if ( empty($page_auth[$parent_params['url']]) || $this->ion_auth->in_group($page_auth[$parent_params['url']]) ): ?>
		<?php if ( empty($parent_params['children']) ): ?>

			<?php $active = ($current_uri==$parent_params['url'] || $ctrler==$parent); ?>
		      <li class='nav-item <?php if ($active) echo 'menu-open'; ?>'>
		        <a class="nav-link <?php if ($active) echo 'active'; ?>" href='<?php echo $parent_params['url']; ?>'>
		          <i class='nav-icon <?php echo $parent_params['icon']; ?>'></i> 
		          <p><?php echo lang_param($parent_params['name']); ?></p>
		        </a>
		      </li>

		<?php else: ?>

<!-- Added by jose
	Original: $parent_active = ($ctrler==$parent);
-->
			<?php
				if(preg_match('/'.$module.'\/(.*?)\/'.$ctrler.'/', $_SERVER['REQUEST_URI'],$match)==1){
					$parent_active=($parent_params['url']==$match[1]);
				}else{
					$parent_active = ($ctrler==$parent);
				}
			?>
<!-- Added by jose end-->
			<li class='nav-item has-treeview <?php if ($parent_active) echo 'menu-open'; ?>'>
				<a href='#' class="nav-link <?php if ($parent_active) echo 'active'; ?>">
			        <i class='nav-icon <?php echo $parent_params['icon']; ?>'></i> 
			        <p><?php echo lang_param($parent_params['name']); ?>
		            	<i class="right fas fa-angle-left"></i>
		          	</p>
				</a>
				<ul class='nav nav-treeview'>
					<?php foreach ($parent_params['children'] as $name => $url): ?>
						<?php if ( empty($page_auth[$url]) || $this->ion_auth->in_group($page_auth[$url]) ): ?>
						<?php $child_active = ($current_uri==$url); ?>
			            <li class='nav-item'>
			              <a href='<?php echo $url; ?>' class='nav-link <?php if ($child_active) echo 'active'; ?>'>
			                <i class='nav-icon far fa-circle'></i>
			                <p><?php echo lang_param($name); ?></p>
			              </a>
			            </li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</li>

		<?php endif; ?>
		<?php endif; ?>

	<?php endforeach; ?>
	
	<?php if ( !empty($useful_links) ): ?>
		<li class="header"><span>USEFUL LINKS</span></li>
		<?php foreach ($useful_links as $link): ?>
			<?php if ($this->ion_auth->in_group($link['auth']) ): ?>
			<li class="nav-item">
				<a href="<?php echo starts_with($link['url'], 'http') ? $link['url'] : base_url($link['url']); ?>" target='<?php echo $link['target']; ?>' class="nav-link">
					<i class="fa fa-circle-o <?php echo $link['color']; ?>"></i> 
					<p class="text"><?php echo lang_param($link['name']); ?></p>
				</a>
			</li>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

</ul>

</nav>
















