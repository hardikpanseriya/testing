	
    <?php 
    if(!$this->ion_auth->is_depot())
    {
    ?>
    <div class="row">
        <div class="col-md-12 customer_report">
            <div class="col-md-6">
                <select id="customer_report_month" name="date" class="form-control">
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
            <div class="col-md-6 txt_right">

            </div>
        </div>
    </div>
    <?php
    }
    else
    {
        ?>
        <input type="hidden" name="date" id="customer_report_month" value="">
        <?php
    }
    ?>

    <div class="col-md-12">
        <div class="table-responsive">
            <table id="customer_report_list" class="table table-bordered">
                <?php echo displayGrid($gridDefs); ?>
            </table>
        </div>
    </div>

<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;

    var bootgrid_table_id = jQuery('table').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);

    var grid = simbanic_grid_list.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/point/customer/",
        requestHandler: function(request)
        {
            var customer_report_month = jQuery('#customer_report_month').val();
            
            if(customer_report_month)
            {
                request.date = customer_report_month;
            }

            return request;
        },
        formatters: {
            
        }
    }).on("loaded.rs.jquery.bootgrid", function(e)
    {
        simbanicGridWidth(griddefs);
    });

    jQuery('#customer_report_month').on('change', function(){
        simbanic_grid_list.bootgrid("reload");
    });

</script>