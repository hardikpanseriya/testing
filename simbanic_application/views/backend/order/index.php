
<div class="col-md-12">
    <div class="table-responsive">
        <!--define the table using the proper table tags, leaving the tbody tag empty -->
        <table id="order_list_data" class="table table-striped table-bordered table-hover">
            <?php echo displayGrid($gridDefs); ?>
        </table>
    </div>
</div>
        
<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;
    var order_list_data = jQuery("#order_list_data");

    var grid = order_list_data.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/order",
        formatters: {
            "status": function(column, row)
            {
                return '<span class="label label-sm '+ row.status_class +'">' + row.status + '</span>';
            },
            "action": function(column, row)
            {
                var order_action = '<a href="'+ base_url +'order/view/'+ row.id +'" class="btn btn-sm box_shadow default" href="javascript:;"><i class="fa fa-search"></i>View Order</a>';
                if(row.invoice_id)
                {
                    order_action += '&nbsp;&nbsp;&nbsp;';
                    order_action += '<a target="_blank" href="'+ base_url +'invoice/view/'+ row.invoice_id +'" class="btn btn-sm box_shadow default" href="javascript:;"><i class="fa fa-search"></i>View Invoice</a>';
                }
                return order_action;
            },
        }
    });

</script>