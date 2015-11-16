    <div id="notification">
    </div>

    <div class="col-md-12 margin_btm_10">
        <div class="pull-left table-responsive col-md-8" style="padding-left: 0px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= ucfirst($product->name). ' ' . ucfirst($product->packing_size). ' '. ucfirst($product->unit); ?></td>
                        <td><?= ucfirst($product->price); ?></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <?php 
        if($this->ion_auth->is_admin())
        {
            ?>
            <div class="pull-right">
                <a class="btn simba_btn green pull-right" id="add_stock"><i class="fa fa-plus"></i> Add Stock</a>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="col-md-12">
        <div class="table-responsive">
            <table id="product_stock_list" class="table table-bordered">
                <?php echo displayGrid($gridDefs); ?>
            </table>
        </div>
    </div>
        
<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;
    var product_id = <?= (int)$product_id; ?>;

    var bootgrid_table_id = jQuery('table#product_stock_list').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);
    var user_type = '<?= $this->ion_auth->user()->row()->user_type ?>';

    var grid = simbanic_grid_list.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/product/stock/" + product_id,
        formatters: {

            "batch_no": function(column, row)
            {
                if(user_type == 'admin')
                {
                    return "<span class='simba_edit_row' data-simba-text='"+ row.batch_no +"' onclick=\"return inputField(this)\">" + row.batch_no + "</span>";
                }
                else
                {
                    return row.batch_no;
                }
            },
            "quantity": function(column, row)
            {
                if(user_type == 'admin')
                {
                    return "<span class='simba_edit_row' data-simba-text='"+ row.quantity +"' onclick=\"return inputField(this)\">" + row.quantity + "</span>";
                }
                else
                {
                    return row.quantity;
                }
            },
            "expiry_date": function(column, row)
            {
                if(user_type == 'admin')
                {
                    return "<span class='simba_edit_row' data-simba-text='"+ row.expiry_date +"' onclick=\"return inputField(this)\">" + row.expiry_date + "</span>";
                }
                else
                {
                    return row.expiry_date;
                }
            },
            "action": function(column, row)
            {
                if(user_type == 'admin')
                {
                    return "<a class=\"btn btn-sm red\" onclick=\"return simbanicRemove('stock', "+ row.id +")\"><i class=\"fa fa-trash-o\"></i> Delete</a>";    
                }
            },
        }
    })
    .on("loaded.rs.jquery.bootgrid", function(e)
    {
        //var current_rows = simbanic_grid_list.bootgrid("getCurrentRows");

        //simbanicGridAttribute(current_rows, 'stock', 'id');
        simbanicGridWidth(griddefs, true);
        if(jQuery( "table tr" ).hasClass( "success" ))
        {
            jQuery( "table tr" ).removeClass("success");
            //jQuery( "table tr" ).addClass("123");
        }
    });

    jQuery(document).ready(function(){
        if(jQuery( "table tr" ).hasClass( "success" ))
        {
            jQuery( "table tr" ).removeClass("success");
            //jQuery( "table tr" ).addClass("123");
        }
    });

</script>