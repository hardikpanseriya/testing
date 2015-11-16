    <?php $date = new DateTime('now'); $current_date = $date->format('d-m-Y'); ?>

    <?php $this->load->view( BACKEND . '/report/common/filter'); ?>
    
    <div class="col-md-12 margintop20">
        <div class="table-responsive">
            <table id="report_prescription" class="table table-bordered">
                <?php echo displayGrid($gridDefs); ?>
            </table>
        </div>
    </div>
        
<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">

    var griddefs = <?= json_encode($gridDefs); ?>;
    var date_range, start_date, end_date, filter_user_id, filter_view, filter_customer_id;
    var bootgrid_table_id = jQuery('table').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);
    var user_type = '<?= $this->ion_auth->user()->row()->user_type ?>';
    var is_doctor = '<?= $this->ion_auth->is_doctor(); ?>';

    var grid = simbanic_grid_list.bootgrid({
        ajax: true,
        sorting: false,
        navigation: 0,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/report/payment",
        requestHandler: function(request)
        {
            if(jQuery('#filter_user_id').val())
            {
                filter_user_id = jQuery('#filter_user_id').val();    
            }
            else
            {
                filter_user_id = '';
            }
            if(jQuery('#filter_customer_id').val())
            {
                filter_customer_id = jQuery('#filter_customer_id').val();    
            }
            else
            {
                filter_customer_id = '';
            }
            if(jQuery('#filter_view').val())
            {
                filter_view = jQuery('#filter_view').val();
            }
            
            request.filter = {};
            request.filter['start_date'] = start_date;
            request.filter['end_date'] = end_date;
            request.filter_user_id = filter_user_id;
            request.filter_customer_id = filter_customer_id;
            request.filter_view = filter_view;
            return request;
        },
        formatters: {
            "action": function(column, row)
            {
                
            },
        }
    }).on("loaded.rs.jquery.bootgrid", function(e)
    {
        simbanicGridWidth(griddefs);
    });

    jQuery('#product_purchase_month').on('change', function(){
        simbanic_grid_list.bootgrid("reload");
    });

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
        if(user_type == 'admin')
        {
            if(jQuery('#filter_user_id').val())
            {
                simbanic_grid_list.bootgrid("reload");
            }
            else
            {
                alert('Select Depot');
            }
        }
        else if(user_type == 'depot')
        {
            if(jQuery('#filter_view').val() == 'admin')
            {
                simbanic_grid_list.bootgrid("reload");
            }
            if(jQuery('#filter_view').val() == 'customer')
            {
                if(jQuery('#filter_user_id').val())
                {
                    simbanic_grid_list.bootgrid("reload");
                }
                else
                {
                    alert('Select Customer');
                }
            }
        }
        else if(user_type == 'customer')
        {
            if(jQuery('#filter_user_id').val())
            {
                simbanic_grid_list.bootgrid("reload");
            }
            else
            {
                alert('Select Depot');
            }
        }
    }

</script>