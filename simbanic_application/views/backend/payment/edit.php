<?php if(isset($simbanic_id)) { ?>
<div class="row">
    <div class="simbanic_user_view">
        <?php
        $user_info = $this->ion_auth->getSimbanicUser($depot_id);
        ?>
            
            <span class="pull-left">
                <?= $user_info->customer_id . " : " . $user_info->full_name; ?>
            </span>
    </div>
</div>
<?php } ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Payment Form
			</div>
			<div class="panel-body simba_customer_form">
				<?php $this->load->view(BACKEND . '/payment/form'); ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				WalartPharma Account Detail
			</div>
			<div class="panel-body">
				<?php $this->load->view(BACKEND . '/payment/detail'); ?>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view(BACKEND . '/common/footer'); ?>

<script type="text/javascript">

var method = '<?= isset($method) ? $method : ''; ?>';

function payment_cash_show()
{
    jQuery('.payment_cash').show();
}
function payment_cash_hide()
{
    jQuery('.payment_cash').hide();
}

function payment_cheque_show()
{
    jQuery('.payment_cheque').show();
}
function payment_cheque_hide()
{
    jQuery('.payment_cheque').hide();
}
function payment_neft_show()
{
    jQuery('.payment_neft').show();
}
function payment_neft_hide()
{
    jQuery('.payment_neft').hide();
}

payment_cash_show();
payment_cheque_hide();
payment_neft_hide();

if(method)
{
	console.log(method);
	payment_method(method);
}

function payment_method(method)
{
	if(method == 'Cheque')
	{
		payment_cash_hide();
		payment_neft_hide();
		payment_cheque_show();
	}
	else if(method == 'NEFT')
	{
		payment_cash_hide();
		payment_cheque_hide();
		payment_neft_show();
	}
	else
	{
		payment_cash_show();
		payment_cheque_hide();
		payment_neft_hide();
	}
}

jQuery("#method").on('change', function(){
	var method = this.value;
	payment_method(method);
});

jQuery(function(){
    jQuery('#date').datepicker({
        minDate: 'today',
        maxDate: "+60D",
        dateFormat: 'dd-mm-yy',
    });
});

jQuery(function(){
    jQuery('#confirm_date').datepicker({
        minDate: '-30D',
        maxDate: "+60D",
        dateFormat: 'dd-mm-yy',
    });
});

</script>