<div class="row">
    <div class="col-md-12">
        <div class="simbanic_user_view">

            <?php
            $user_info = $this->ion_auth->getSimbanicUser($id);
            ?>
                
                <span class="pull-left">
                    <?= $user_info->customer_id . " : " . $user_info->full_name; ?>
                </span>
        </div>
    </div>
</div>

    <div class="col-md-12">
        <div class="payment_history_view">
            <div class="pull-right">
                <a href="<?= redirect_backend_url('payment/customer/create/?depot_id='.$depot_id.'&retailer_id='.$retailer_id); ?>" class="btn simba_btn green pull-right" id="add_payment1"><i class="fa fa-plus"></i> Add Payment</a>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="table-responsive">
            <table id="payment_view_list" class="table table-striped table-bordered table-hover">
                <?php echo displayGrid($gridDefs); ?>
            </table>
        </div>
    </div>

<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;
    var id = <?= (int)$id; ?>;

    var bootgrid_table_id = jQuery('table').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);
    var user_type = '<?= $this->ion_auth->user()->row()->user_type ?>';
    
    var payment_grid = simbanic_grid_list.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: -1,
        url: base_url + "get/payment/customer/history/" + id,
        formatters: {
            "status": function(column, row)
            {
                return '<span class="simba_edit_row label label-sm '+ row.status_class +'">' + row.status + '</span>';
            },
            "action": function(column, row)
            {
                if(row.status == 'Pending')
                {
                    return "<a class=\"btn btn-sm purple\" href=\"" + base_url + "payment/customer/edit/" + row.id + "?depot_id="+ row.depot_id +"&retailer_id="+ row.retailer_id +"\"><i class=\"fa fa-trash-o\"></i> Edit</a> <a class=\"btn btn-sm red\" onclick=\"return simbanicRemove('retailer_payment', "+ row.id +")\"><i class=\"fa fa-trash-o\"></i> Delete</a>";
                }
                else if(row.status == 'Done')
                {
                    if(user_type == 'depot')
                    {
                        return "<a class=\"btn btn-sm purple\" href=\"" + base_url + "payment/generate/" + row.id + "?view=customer\"><i class=\"fa fa-print\"></i> View Receipt</a>";
                    }
                    else
                    {
                        return "<a class=\"btn btn-sm purple\" href=\"" + base_url + "payment/generate/" + row.id + "\"><i class=\"fa fa-print\"></i> View Receipt</a>";
                    }
                    
                }
            },
        }
    }).on("loaded.rs.jquery.bootgrid", function(e)
    {
        var current_rows = simbanic_grid_list.bootgrid("getCurrentRows");
        simbanicGridAttribute(current_rows, 'depot_payment', 'id');

        simbanicGridWidth(griddefs, true);
    });

</script>

<script type="text/javascript">



</script>