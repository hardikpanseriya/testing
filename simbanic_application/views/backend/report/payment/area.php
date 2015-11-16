    <?php $date = new DateTime('now'); $current_date = $date->format('d-m-Y'); ?>

    <?php $this->load->view( BACKEND . '/report/common/filter'); ?>
    
    <div class="col-md-12 margintop20">
        <div class="table-responsive" id="display_all_payment_report">
            
        </div>
        <button id="print_invoice" class="btn btn-sm green pull-right" onclick="printPayment()" disabled="disabled">
            <i class="fa fa-print"></i>
            Print
        </button>
    </div>

        
<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">

    var griddefs = <?= json_encode($gridDefs); ?>;
    var date_range, start_date, end_date;
    var bootgrid_table_id = jQuery('table').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);
    var user_type = '<?= $this->ion_auth->user()->row()->user_type ?>';
    var is_doctor = '<?= $this->ion_auth->is_doctor(); ?>';

</script>

<script type="text/javascript">

    jQuery(function() {
        jQuery('#daterange').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Clear'
            },
            maxDate: "<?= $current_date; ?>",
        }, 
        function(start, end, label) {

            start_date = start.format('YYYY-MM-DD');
            end_date = end.format('YYYY-MM-DD');

        });
    });

    jQuery('#daterange').val('');

    function daterangeFilter() 
    {
        jQuery.ajax({
            url: base_url + 'get/report/payment/area',
            type: 'POST',
            data: { start_date: start_date, end_date: end_date },
            dataType: "html",
            success: function(json)
            {
               jQuery('#display_all_payment_report').html(json);
               jQuery('#print_invoice').prop('disabled', false);
            }
        });
    }

    function printPayment() 
    {
        location = base_url + 'get/report/payment/area?start_date=' + start_date + '&end_date=' + end_date;
    }

</script>