<?= form_open("depot/save"); ?>
	<?php
	$date_data = array('readonly' => 'readonly');
	if(isset($record))
	{
		echo form_hidden('record', $record);
	}
	?>
	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Depot Name', 'full_name', isset($full_name) ? $full_name : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Mobile No.', 'mobile_no', isset($mobile_no) ? $mobile_no : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_password('Password', 'password', isset($password) ? $password : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?= simbanic_label('Gender'); ?>
			<?= simbanic_radio('gender', isset($gender) && $gender == 'male' ? $gender : 'male', isset($gender) && $gender == 'male' ? TRUE : TRUE); ?> Male
			<?= simbanic_radio('gender', isset($gender) && $gender == 'female' ? $gender : 'female', isset($gender) && $gender == 'female' ? TRUE : FALSE); ?> Female
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Date of Birth', 'dob', isset($dob) ? $dob : '', $date_data);
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?= 
				simbanic_textarea('Home Address', 'home_address', isset($home_address) ? $home_address : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?= 
				simbanic_textarea('Work Address', 'work_address', isset($work_address) ? $work_address : ''); 
			?>
		</div>
	</div>

	<?php

		$home_state = array(
						'onchange' => 'getDistrict(this)',
						);
		$home_district = array(
						'onchange' => 'getArea(this)',
						);
	?>

	<div class="row">
		<div class="col-md-6 form-group">
			<?= 
				simbanic_select('Home State', 'home_state', $options = array(), isset($home_state) ? $home_state : '', $home_state);
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_select('Home District', 'home_district', $options = array(), isset($home_district) ? $home_district : '', $home_district);
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?= 
				simbanic_select('Home Area', 'home_area', $options = array(), isset($home_area) ? $home_area : '');
			?>
		</div>
		<?php if(isset($panseriya)) { ?>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Refer to', 'refer_to', isset($refer_to) ? $refer_to : '');
			?>
		</div>
		<?php } ?>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?= 
				simbanic_input('Marriage Anni', 'marriage_anni', isset($marriage_anni) ? $marriage_anni : '', $date_data);
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Designation', 'designation', isset($designation) ? $designation : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?= 
				simbanic_input('Pancard No', 'pancard_no', isset($pancard_no) ? $pancard_no : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Blood Group', 'blood_group', isset($blood_group) ? $blood_group : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?= 
				simbanic_input('Nominee', 'nominee', isset($nominee) ? $nominee : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Nominee Relation', 'nominee_relation', isset($nominee_relation) ? $nominee_relation : '');
			?>
		</div>
	</div>
	<?php if(isset($panseriya)) { ?>
	<div class="row">
		<div class="col-md-6 form-group">
			<?= 
				simbanic_input('Nominee Dob', 'nominee_dob', isset($nominee_dob) ? $nominee_dob : '', $date_data);
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Income', 'income', isset($income) ? $income : '');
			?>
		</div>
	</div>
	<?php } ?>

	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Bank Name', 'bank_name', isset($bank_name) ? $bank_name : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Account No', 'account_no', isset($account_no) ? $account_no : '');
			?>
		</div>
	</div>

	<div class="row">
		
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('IFSC Code', 'ifsc_code', isset($ifsc_code) ? $ifsc_code : '');
			?>
		</div>
		
	</div>

	<div class="row">
		
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Transportation 1', 'transportation', isset($transportation) ? $transportation : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Transportation 2', 'transportation_2', isset($transportation_2) ? $transportation_2 : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('TIN No.', 'tin_no', isset($tin_no) ? $tin_no : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('DL No.', 'dl_no', isset($dl_no) ? $dl_no : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Contact Person', 'contact_person', isset($contact_person) ? $contact_person : '');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Contact Person Mobile No.', 'contact_person_mobile_no', isset($contact_person_mobile_no) ? $contact_person_mobile_no : '');
			?>
		</div>
	</div>

	<div class="row">
		<?= form_hidden('user_type', 'depot'); ?>
		<?= form_hidden('group_ids[]', 4); ?>
	</div>
	<?php
	if($this->ion_auth->is_admin())
	{
		if(isset($record))
		{
			echo form_submit('submit', 'Update', 'class="btn simba_btn green pull-right"');
		}
		else
		{
			echo form_submit('submit', 'Submit', 'class="btn simba_btn green pull-right"');
		}
	}
	?>

<?= form_close(); ?>