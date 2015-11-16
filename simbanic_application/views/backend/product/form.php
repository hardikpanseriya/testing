<?= form_open("product/save"); ?>
	<?php
	$unit_data = array('style' => 'float: right; width: 35%;');
	$packing_size_data = array('style' => 'width: 32%;');
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
		<?php
			$unit_option = array('gm' => 'Gram', 'ml' => 'Milliliter', 'kg' => 'Kilogram', 'ltr' => 'Liter');
		?>
		<div class="col-md-6 form-group packing_size">
			<?= simbanic_label('Packing Size'); ?>

			<?= simbanic_input('', 'packing_size', isset($packing_size) ? $packing_size : '', $packing_size_data); ?>

			<?= 
				simbanic_select('', 'unit', $unit_option, isset($unit) ? $unit : 'gram', $unit_data);
			?>
		</div>
		
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Product MRP', 'mrp', isset($mrp) ? $mrp : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Product Rate', 'price', isset($price) ? $price : '');
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('VAT', 'vat', isset($vat) ? $vat : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('CST', 'cst', isset($cst) ? $cst : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('ST', 'st', isset($st) ? $st : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('GST', 'gst', isset($gst) ? $gst : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('OCTR', 'octr', isset($octr) ? $octr : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Excise', 'excise', isset($excise) ? $excise : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_textarea('Remark', 'remark', isset($remark) ? $remark : '');
			?>
		</div>
	</div>

	<?php
	if(isset($record))
	{
		echo form_submit('submit', 'Update', 'class="btn simba_btn green pull-right"');
	}
	else
	{
		echo form_submit('submit', 'Submit', 'class="btn simba_btn green pull-right"');
	}
	?>

<?= form_close(); ?>