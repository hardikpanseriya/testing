<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Customer Form
			</div>
			<div class="panel-body simba_customer_form" id="customer_form">
				<?php $this->load->view(BACKEND . '/customer/form'); ?>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view(BACKEND . '/common/footer'); ?>

<script type="text/javascript">

jQuery(function(){
    $("#sponsor_id").select2({
        ajax: {
            url: base_url + "search/customer_id",
            dataType: 'json',
            type: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page,
                    type: 'customer',
                    select: 'customer_id',
                    display: 'all'
                };
            },
            processResults: function (data, page) {
				return {
					results: data
				};
		    },
        }
    });
});

jQuery(function(){
    $("#related_medical").select2({
        placeholder: "Select a Medical Store",
        ajax: {
            url: base_url + "search/customer/medical_store",
            dataType: 'json',
            type: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page,
                    state: 'customer',
                    district: 'customer_id',
                    area: 'customer_id'
                };
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            },
        }
    });
});

</script>