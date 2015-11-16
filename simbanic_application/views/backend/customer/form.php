<?= form_open("customer/save"); ?>
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
				simbanic_input('Full Name', 'full_name', isset($full_name) ? $full_name : '');
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
		<?php
		$customer_type_option = array('doctor' => 'Doctor', 'medical_store' => 'Medical Store');
		$sponsor_option = array('' => 'Please Select Sponsor ID');
		if(isset($sponsor_id) && !empty($sponsor_id))
		{
			if(isset($full_name) && !empty($full_name))
			{
				$append_sponsor = ' - ' . $full_name;
			}
			else
			{
				$append_sponsor = '';
			}
			$sponsor_option[$sponsor_id] = $sponsor_id;
		}
		?>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('IFSC Code', 'ifsc_code', isset($ifsc_code) ? $ifsc_code : '');
			?>
		</div>
		<div class="col-md-6 form-group sponsor_div">
			<?= simbanic_select('Sponsor ID', 'sponsor_id', $sponsor_option, isset($sponsor_id) ? $sponsor_id : ''); ?>
		</div>
	</div>

	<div class="row">
		
		<div class="col-md-6 form-group">
			<?= 
				simbanic_select('Customer Type', 'customer_type', $customer_type_option, isset($customer_type) ? $customer_type : 'doctor');
			?>
		</div>
		<div class="col-md-6 form-group">
			<?= form_hidden('user_type', 'customer'); ?>
			<?= form_hidden('group_ids[]', 3); ?>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Related Medical Store
		</div>
		<div class="panel-body">
			<!--<div class="row">
				<div class="col-md-4 form-group">
					<?= 
						simbanic_select('State', 'state', $options = array(), isset($home_state) ? $home_state : '', $home_state);
					?>
				</div>
				<div class="col-md-4 form-group">
					<?=
						simbanic_select('District', 'district', $options = array(), isset($home_district) ? $home_district : '', $home_district);
					?>
				</div>
				<div class="col-md-4 form-group">
					<?= 
						simbanic_select('Area', 'area', $options = array(), isset($home_area) ? $home_area : '');
					?>
				</div>
			</div>-->
			<div class="col-md-12 form-group">
				<select id="related_medical" class="form-control" name="related_medical[]" multiple="multiple" style="width:100%;">
					<?php 
					if(isset($related_medical) && !empty($related_medical))
					{
						$exp_store = explode(",", $related_medical);
						for($k = 0; $k < count($exp_store); $k++)
						{
							?>
							<option value="<?= $exp_store[$k]; ?>" selected><?= $this->ion_auth->user($exp_store[$k])->row()->full_name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>
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