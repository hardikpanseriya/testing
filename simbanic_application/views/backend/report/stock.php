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
    var date_range, start_date, end_date, filter_user_id;
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
        url: base_url + "get/report/stock",
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
            request.filter = {};
            request.filter['start_date'] = start_date;
            request.filter['end_date'] = end_date;
            request.filter_user_id = filter_user_id;
            
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
        simbanic_grid_list.bootgrid("reload");
    }

</script>