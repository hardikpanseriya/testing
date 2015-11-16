    <?php 
    if($this->ion_auth->is_customer())
    {
    ?>
    <div class="row">
        <div class="col-md-12 product_filter">
            <div class="col-md-6">
                <select id="invoice_purchase_month" name="filter[MONTH-date_created]" class="form-control">
                    <option value="">Current Month</option>
                    <?php 
                    for($m = 1; $m <= 3; $m++)
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
        <input type="hidden" name="filter[MONTH-date_created]" id="invoice_purchase_month" value="">
        <?php
    }
    ?>

<div class="col-md-12">
    <div class="table-responsive">
        <!--define the table using the proper table tags, leaving the tbody tag empty -->
        <table id="invoice_list_data" class="table table-striped table-bordered table-hover">
            <?php echo displayGrid($gridDefs); ?>
        </table>
    </div>
</div>
        
<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;
    var invoice_list_data = jQuery("#invoice_list_data");
    var user_type = '<?= $this->ion_auth->user()->row()->user_type ?>';

    var grid = invoice_list_data.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/invoice",
        requestHandler: function(request)
        {
            request.filter = {};
            if(user_type == 'customer')
            {
                var invoice_purchase_month = jQuery('#invoice_purchase_month').val();
                if(invoice_purchase_month)
                {
                    request.filter['MONTH-date_created'] = invoice_purchase_month;    
                }
                else
                {
                    request.filter['MONTH-date_created'] = '<?= CURRENT_DATE; ?>';
                }
            }
            return request;
        },
        formatters: {
            "action": function(column, row)
            {
                var invoice_action = '<a href="'+ base_url +'invoice/view/'+ row.id +'" class="btn btn-xs box_shadow default" href="javascript:;"><i class="fa fa-search"></i>View Invoice</a>';

                if(user_type == 'admin' || user_type == 'depot')
                {
                    invoice_action += '&nbsp;&nbsp;';
                    invoice_action += '<a href="'+ base_url +'invoice/generate/'+ row.id +'" class="btn btn-xs box_shadow default" href="javascript:;"><i class="fa fa-print"></i>Print Invoice</a>';
                }

                if(row.depot_order_id)
                {
                    invoice_action += '&nbsp;&nbsp;';
                    invoice_action += '<a target="_blank" href="'+ base_url +'order/view/'+ row.depot_order_id +'" class="btn btn-sm box_shadow default" href="javascript:;"><i class="fa fa-search"></i>View Order</a>';
                }
                return invoice_action;
            },
            "confirm": function(column, row)
            {
                if(row.invoice_total == '0')
                {
                    return '<span class="label label-sm cancel"> Cancel </span>';
                }
                else if(row.date_confirm != null)
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

    jQuery('#invoice_purchase_month').on('change', function(){
        invoice_list_data.bootgrid("reload");
    });

</script>