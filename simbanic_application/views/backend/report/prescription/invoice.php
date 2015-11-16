    <?php 
    if($this->ion_auth->is_customer())
    {
    ?>
    <div class="row">
        <div class="col-md-12 product_filter">
            <div class="col-md-6">
                <select id="product_purchase_month" name="filter[MONTH-date_confirm]" class="form-control">
                    <option value="">Current Month</option>
                    <?php 
                    for($m = 1; $m <= 1; $m++)
                    {
                        ?>
                        <option value="<?= date("Y-m-d", strtotime("-$m Months")); ?>"><?= date("F", strtotime("-$m Months")); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <?php
    }
    else
    {
        ?>
        <input type="hidden" name="filter[MONTH-date_created]" id="product_purchase_month" value="">
        <?php
    }
    ?>
    

    <div class="col-md-12">
        <div class="table-responsive">
            <table id="report_prescription" class="table table-bordered">
                <?php echo displayGrid($gridDefs); ?>
            </table>
        </div>
    </div>
        
<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;

    var bootgrid_table_id = jQuery('table').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);
    var user_type = '<?= $this->ion_auth->user()->row()->user_type ?>';
    var is_doctor = '<?= $this->ion_auth->is_doctor(); ?>';

    var grid = simbanic_grid_list.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/report/prescription/invoice",
        requestHandler: function(request)
        {
            request.filter = {};
            if(user_type == 'customer')
            {
                var product_purchase_month = jQuery('#product_purchase_month').val();
                if(product_purchase_month)
                {
                    request.filter['MONTH-date_confirm'] = product_purchase_month;    
                }
                else
                {
                    request.filter['MONTH-date_confirm'] = '<?= CURRENT_DATE; ?>';
                }
            }
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