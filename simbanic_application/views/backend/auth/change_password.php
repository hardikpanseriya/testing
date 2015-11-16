	<div class="loginInfoMessage" style="margin-top: 10px; margin-bottom: 20px;">
		<?php echo $message;?>
	</div>

	<?= form_open("auth/change_password", array('autocomplete' => 'off')); ?>

	<div class="row">
		<div class="col-md-12 form-group">
			<?= simbanic_label('Old Password'); ?>
            <?php echo form_input($old_password);?>
		</div>
		
		<div class="col-md-12 form-group packing_size">
			<?= simbanic_label('New Password(at least 5 characters long)'); ?>
            <?php echo form_input($new_password);?>
		</div>
		<div class="col-md-12 form-group">
			<?= simbanic_label('Confirm New Password'); ?>
            <?php echo form_input($new_password_confirm); ?>
		</div>
		
			<?php echo form_input($user_id);?>
		
	</div>

	<?=  form_submit('submit', 'Submit', 'class="btn simba_btn green pull-right"'); ?>

	<?= form_close(); ?>