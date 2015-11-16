<?= form_open("payment/save"); ?>
	<?php
	if(isset($record))
	{
		echo form_hidden('record', $record);
	}
	if(isset($depot_id))
	{
		echo form_hidden('depot_id', $depot_id);
	}

	if($this->ion_auth->is_admin())
	{
		echo form_hidden('created_at', 'admin');
	}
	elseif($this->ion_auth->is_depot())
	{
		echo form_hidden('created_at', 'depot');
	}
	?>
	<div class="row">
		<div class="col-md-6 form-group">
			<?php
				$date_data = array('readonly' => 'readonly');
				$payment_method_option = array('Cash' => 'Cash', 'Cheque' => 'Cheque', 'NEFT' => 'NEFT');
				$cash_type_option = array('cash_on_hand' => 'Cash on hand', 'cash_in_account' => 'Cash in account');
			?>
			<?= 
				simbanic_select('Payment Method', 'method', $payment_method_option, isset($method) ? $method : 'Cash');
			?>
			
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Amount', 'amount', isset($amount) ? $amount : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group payment_cash">
			<?=
				simbanic_select('Cash Type', 'cash_type', $cash_type_option, isset($cash_type) ? $cash_type : 'cash_on_hand');
			?>
		</div>
		<div class="col-md-6 form-group payment_cash">
			<?=
				simbanic_input('Receipt No.', 'receipt_no', isset($receipt_no) ? $receipt_no : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group payment_cheque">
			<?=
				simbanic_input('Cheque No.', 'cheque_no', isset($cheque_no) ? $cheque_no : '');
			?>
		</div>
		<div class="col-md-6 form-group payment_cheque">
			<?=
				simbanic_input('Bank Name', 'bank_name', isset($bank_name) ? $bank_name : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group payment_cheque">
			<?=
				simbanic_input('Bank Branch', 'bank_branch', isset($bank_branch) ? $bank_branch : '');
			?>
		</div>
		<div class="col-md-6 form-group payment_neft">
			<?=
				simbanic_input('Transfer ID', 'transfer_id', isset($transfer_id) ? $transfer_id : '');
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 form-group">
			<?=
				simbanic_input('Release Date', 'date', isset($date) ? $date : '', $date_data);
			?>
		</div>
		<div class="col-md-6 form-group">
			<?=
				simbanic_textarea('Remark', 'remark', isset($remark) ? $remark : '');
			?>
		</div>
	</div>

	<div class="row">
		<?php
		if($this->ion_auth->is_admin())
		{
			?>
			<div class="col-md-6 form-group">
				<?=
					simbanic_input('Confirm Date', 'confirm_date', isset($confirm_date) && $confirm_date != '01-01-1970' && $confirm_date != '30-11--0001' ? $confirm_date : '', $date_data);
				?>
			</div>
			<?php 
		}
		?>
		<div class="col-md-6 form-group">
			<?php
			if($this->ion_auth->is_admin())
			{
				$payment_status_option = array('Pending' => 'Pending', 'Done' => 'Done');
			}
			else
			{
				$payment_status_option = array('Pending' => 'Pending');
			}
			?>
			<?= 
				simbanic_select('Payment Status', 'status', $payment_status_option, isset($status) ? $status : 'Pending');
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