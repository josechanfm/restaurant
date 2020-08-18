<div class="wrapper">

	<?php $this->load->view('_partials/navbar'); ?>

	<?php // Left side column. contains the logo and sidebar ?>
	 <aside class="main-sidebar sidebar-dark-primary elevation-4">
	    <!-- Brand Logo -->
	    <a href="index3.html" class="brand-link">
	      <img src="../assets/dist/images/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
	           style="opacity: .8">
	      <span class="brand-text font-weight-light">MAIN NAVIGATION</span>
	    </a>
	    <!-- Sidebar -->
	    <div class="sidebar">
	      <!-- Sidebar user panel (optional) -->
	      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="image">
	          <img src="../assets/dist/images/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
	        </div>
	        <div class="info">
	          <a href="#" class="d-block"><?php echo $user->first_name; ?></a>
	        </div>
	      </div>
		<?php $this->load->view('_partials/sidemenu'); ?>
	</aside>

	<?php // Right side column. Contains the navbar and content of the page ?>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
       		 <div class="row mb-2">
          		<div class="col-sm-6">
					<h1><?php echo $page_title; ?></h1>
				</div><!-- /.col -->
          		<div class="col-sm-6">
					<?php $this->load->view('_partials/breadcrumb'); ?>
				</div>
		</section>
		<section class="content">
			 <div class="container-fluid">
				<?php $this->load->view($inner_view); ?>
				<?php $this->load->view('_partials/back_btn'); ?>
			</div>
		</section>
	</div>

	<?php // Footer ?>
	<?php $this->load->view('_partials/footer'); ?>

</div>