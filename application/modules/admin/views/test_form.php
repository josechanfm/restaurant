
<script src='https://cdnjs.cloudflare.com/ajax/libs/imask/6.0.7/imask.min.js' ></script>

<label>Date <span class="desc">'dd.mm.yyyy' in range [01.01.1990, 01.01.2020]</span></label>
<input id="date-mask" type="text" value="">

<?php echo $form->messages(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="card card-warning">
			<div class="card-header">
				<h3 class="card-title">Add Service</h3>
			</div>
			<?php echo $form->open(); ?>
			<div class="card-body">
				<?php echo $form->bs3_text('Title', 'service_title'); ?>
				<div class="row">
					<div class="col-md-6">
						<?php echo $form->bs3_date('Start date', 'start_date'); ?>
					</div>
					<div class="col-md-6">
						<?php echo $form->bs3_date('End date', 'end_date'); ?>
					</div>
				</div>
					<?php echo $form->bs3_textarea('Description', 'description'); ?>
					<?php echo $form->bs3_submit(); ?>
					<a class="btn btn-default" href="<?=$ctrler?>">Cancel</a>
			</div>
			<?php echo $form->close(); ?>
		</div>
	</div>
	
</div>


<script type="text/javascript">
	var dateMask = IMask(
  document.getElementById('date-mask'),
  {
    mask: Date,
    pattern: 'Y/`m/`d',
    
    min: new Date(1990, 0, 0),
    max: new Date(2020, 0, 0),
    lazy: false,
    
  });

</script>

