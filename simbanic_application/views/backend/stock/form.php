<?= form_open("product/save"); ?>
	<?php
	if(isset($record))
	{
		echo form_hidden('record', $record);
	}
	?>
	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Product Name', 'name', isset($name) ? $name : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Product Price', 'price', isset($price) ? $price : '');
			?>
		</div>
	</div>

	<div class="row">
		<?php
			$unit_option = array('kilogram' => 'Kilogram', 'gram' => 'Gram');
		?>
		<div class="col-md-6 form-group">
			<?= 
				simbanic_select('Product Unit', 'unit', $unit_option, isset($unit) ? $unit : 'kilogram');
			?>
		</div>
	</div>
	<?php
	if(isset($record))
	{
		echo form_submit('submit', 'Update', 'class="btn btn-outline btn-primary pull-right"');
	}
	else
	{
		echo form_submit('submit', 'Submit', 'class="btn btn-outline btn-primary pull-right"');
	}
	?>

<?= form_close(); ?>