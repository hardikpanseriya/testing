    <?php
    if($this->ion_auth->is_admin())
    {
        ?>
    	<div class="col-md-12 margin_btm_10">
            <a class="btn simba_btn green pull-right" href="<?= redirect_backend_url('product/create'); ?>"><i class="fa fa-plus"></i> Create</a>
        </div>
        <?php
    }
    ?>
    
    <?php 
    if($this->ion_auth->is_customer())
    {
    ?>
    <div class="row">
        <div class="col-md-12 product_filter">
            <div class="col-md-6">
                <select id="product_purchase_month" name="filter[MONTH-date_confirm]" class="form-control">
                    <option value="">Total Stock</option>
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
            <div class="col-md-6 txt_right">
                <h3 class="margin_top_0">Total Unit: <span class="total_unit"> </span></h3>
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
            <table id="pharma_list" class="table table-bordered">
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
        url: base_url + "get/product",
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
                    if(is_doctor)
                    {
                        request.filter['MONTH-date_confirm'] = '<?= CURRENT_DATE; ?>';
                    }
                    else
                    {
                        //request.filter['MONTH-date_confirm'] = '<?= CURRENT_DATE; ?>';
                    }
                }
            }
            return request;
        },
        formatters: {
            "action": function(column, row)
            {
                if(user_type == 'admin')
                {
                    return "<a href=\"" + base_url + "product/edit/" + row.id + "\" class=\"btn btn-sm purple\"><i class=\"fa fa-edit\"></i> Edit</a> <a href=\"" + base_url + "stock/" + row.id + "\" class=\"btn btn-sm green\"><i class=\"fa fa-plus\"></i> Add Stock</a>";
                }
                else if(user_type == 'depot')
                {
                    return "<a href=\"" + base_url + "stock/" + row.product_id + "\" class=\"btn btn-sm green\"><i class=\"fa fa-search\"></i> View Stock</a>";
                }
                
            },
        }
    }).on("loaded.rs.jquery.bootgrid", function(e)
    {
        simbanicGridWidth(griddefs);
    });

    jQuery('#product_purchase_month').on('change', function(){
        simbanic_grid_list.bootgrid("reload");
        getTotalUnit();
    });

    getTotalUnit();

    function getTotalUnit()
    {
        if(is_doctor)
        {
            var total_unit = {};
            total_unit.filter = {};
            var product_purchase_month = jQuery('#product_purchase_month').val();
            if(product_purchase_month)
            {
                total_unit.filter['MONTH-date_confirm'] = product_purchase_month;    
            }
            else
            {
                total_unit.filter['MONTH-date_confirm'] = '<?= CURRENT_DATE; ?>';
            }

            jQuery.ajax({
                url: base_url + 'product/unit',
                type: 'POST',
                data: total_unit,
                dataType: 'json',
                success: function(json)
                {
                    if (json['success'])
                    {
                        jQuery('.total_unit').html(json['success']);
                    }
                }
            });
        }
        else
        {
            jQuery('.total_unit').html('0.00');
        }
    }

</script>