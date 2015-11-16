	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Full Name', 'full_name', isset($full_name) ? $full_name : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Mobile No.', 'mobile_no', isset($mobile_no) ? $mobile_no : '');
			?>
		</div>
	</div>