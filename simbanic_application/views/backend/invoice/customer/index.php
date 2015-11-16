
<div class="col-md-12">
    <div class="table-responsive">
        <table id="customer_invoice_list" class="table table-striped table-bordered table-hover">
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
        url: base_url + "get/invoice/customer",
        formatters: {
            "action": function(column, row)
            {
                return '<a href="'+ base_url +'invoice/view/'+ row.id +'?view=customer" class="btn btn-xs box_shadow default" href="javascript:;"><i class="fa fa-search"></i>View Invoice</a>&nbsp;&nbsp;' + '<a href="'+ base_url +'invoice/generate/'+ row.id +'?view=customer" class="btn btn-xs box_shadow default" href="javascript:;"><i class="fa fa-print"></i>Print Invoice</a>';
            },
            "confirm": function(column, row)
            {
                if(row.invoice_total == '0')
                {
                    return '<span class="label label-sm cancel"> Cancel </span>';
                }
                if(row.date_confirm != null)
                {
                    return '<span class="label label-sm complete"> Done </span>';
                }
                else if(row.date_confirm == null)
                {
                    return '<span class="label label-sm pending"> Pending </span>';
                }
                return '';
            },
        }
    });

</script>