<?php 
if(isset($account_info))
{
	?>
	<div class="row">
		<div class="col-md-6 form-group">
			<label class="simba_form_label">Account Name</label>
			<input class="form-control simba_form_control" type="text" value="<?= $account_info->full_name; ?>" disabled>
		</div>
		<div class="col-md-6 form-group">
			<label class="simba_form_label">Account No.</label>
			<input class="form-control simba_form_control" type="text" value="<?= $account_info->account_no; ?>" disabled>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<label class="simba_form_label">Bank Name</label>
			<input class="form-control simba_form_control" type="text" value="<?= $account_info->bank_name; ?>" disabled>
		</div>
		<div class="col-md-6 form-group">
			<label class="simba_form_label">IFSC Code</label>
			<input class="form-control simba_form_control" type="text" value="<?= $account_info->ifsc_code; ?>" disabled>
		</div>
	</div>

	<?php
}
else
{
	?>
	<div class="row">
		<div class="col-md-6 form-group">
			<label class="simba_form_label">Account Name</label>
			<input class="form-control simba_form_control" type="text" value="WalArtPharma" disabled>
		</div>
		<div class="col-md-6 form-group">
			<label class="simba_form_label">Account No.</label>
			<input class="form-control simba_form_control" type="text" value="30932112124" disabled>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<label class="simba_form_label">Bank Name</label>
			<input class="form-control simba_form_control" type="text" value="State Bank of India" disabled>
		</div>
		<div class="col-md-6 form-group">
			<label class="simba_form_label">Branch code.</label>
			<input class="form-control simba_form_control" type="text" value="60434" disabled>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<label class="simba_form_label">IFSC Code</label>
			<input class="form-control simba_form_control" type="text" value="SBIN0060434" disabled>
		</div>
	</div>
	<?php
}
?>
