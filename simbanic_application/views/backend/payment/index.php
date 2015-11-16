	<div class="col-md-12">
        <div class="table-responsive">
            <table id="payment_list" class="table table-bordered">
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

    var grid = simbanic_grid_list.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/payment",
        formatters: {
            "action": function(column, row)
            {
                if(user_type == 'customer')
                {
                    return '<a href="'+ base_url +'payment/customer/view/'+ row.id +'" class="btn btn-sm box_shadow default" href="javascript:;"><i class="fa fa-search"></i>View</a>';
                }
                else
                {
                    return '<a href="'+ base_url +'payment/view/'+ row.view_id +'" class="btn btn-sm box_shadow default" href="javascript:;"><i class="fa fa-search"></i>View</a>';
                }
            },
        }
    }).on("loaded.rs.jquery.bootgrid", function(e)
    {
        simbanicGridWidth(griddefs);
    });

</script>