    <div id="notification">
    </div>

    <div class="row">
        <div class="col-md-12" style="margin-bottom: 10px;">
            <div class="col-md-12">
                <span class="pull-left">
                    <?php 
                    if(isset($previous_order) && !empty($previous_order) && count($previous_order) == 1)
                    {
                        ?>
                        <!--<a class="btn yellow btn-sm previous_btn" href="<?= redirect_backend_url('order/view/'.$previous_order[0]->id) ?>">
                            <i class="fa fa-arrow-circle-left"></i>
                            Previous
                        </a>-->
                        <?php
                    }
                    ?>
                </span>
                <span class="pull-right">
                    <?php 
                    if(isset($next_order) && !empty($next_order) && count($next_order) == 1)
                    {
                        ?>
                        <!--<a class="btn yellow btn-sm next_btn" href="<?= redirect_backend_url('order/view/'.$next_order[0]->id) ?>">
                            <i class="fa fa-arrow-circle-right"></i>
                            Next
                        </a>-->
                        <?php
                    }
                    ?>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
            if(isset($order->created_by))
            {
                $user_info = $this->ion_auth->getSimbanicUser($order->created_by);
            }
            else if(isset($order->retailer_id))
            {
                $user_info = $this->ion_auth->getSimbanicUser($order->retailer_id);
            }
            if(isset($order->created_by) || isset($order->retailer_id))
            {
            ?>
                <div class="simbanic_user_view">
                    <span class="pull-left"><?= $user_info->customer_id . " : " . $user_info->full_name; ?></span>
                    <span class="pull-right"><?= "Order No.:" . $order_id; ?></span>
                </div>
                <?php 
            }
            ?>
        </div>
    </div>

    <?php if($this->ion_auth->is_admin() && $order->status == 'Pending') { ?>
    <div class="col-md-12 margin_btm_10">
        <div class="pull-right">
            <a class="btn simba_btn green pull-right" href="<?= redirect_backend_url('order/convert/'.$order->id); ?>">Create Invoice</a>
        </div>
    </div>
    <?php } ?>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#review_order">Order No.: <?= $order->id; ?></a>
                    </li>
                    <?php if($order->status == 'Pending') { ?>
                    <li class="">
                        <a data-toggle="tab" href="#order_product_list">Add New Product</a>
                    </li>
                    <?php } ?>
                </ul>

                <div class="tab-content">

                    <div id="review_order" class="tab-pane fade active in">
                        <?php $this->load->view( BACKEND . '/cart/info'); ?>
                    </div>

                    <?php if($order->status == 'Pending') { ?>
                    <div id="order_product_list" class="tab-pane fade">
                        <div class="table-responsive">

                            <table id="order_product_list_view" class="table table-condensed table-bordered">
                                <?php echo displayGrid($gridDefs); ?>
                            </table>

                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var order_info = <?= json_encode($order); ?>;

    appendData();

    function appendData()
    {
        append = '<textarea name="comment" class="simba-form-control form-control order_comment" placeholder="Add Comments About Your Order">';
        append += '<?= $order->comment; ?>';
        append += '</textarea>';
        if(order_info['status'] == 'Pending')
        {
            append += '<a class="btn simba_btn green pull-right margin_btm_20" onclick="return orderSave(this)">';
            append += '<i class="fa fa-save"></i>';
            append += ' Save Order';
            append += '</a>';
        }
        
        jQuery('#order_info').html(append);
    }
</script>

<?php if($order->status == 'Pending') { ?>
<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;
    var order_id = <?= (int)$order_id; ?>;

    var bootgrid_table_id = jQuery('table#order_product_list_view').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);
    
    var product_grid = simbanic_grid_list.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "order/create/products",
        formatters: {
            "quantity": function(column, row)
            {
                return '<input type="text" name="'+ row.id +'_quantity" class="form-control input-sm order_quantity" placeholder="Enter Quantity">';
            },
            "action": function(column, row)
            {
                return "<a class=\"btn btn-sm yellow \" onclick=\"return addToCart('" + row.id + "')\"><i class=\"fa fa-shopping-cart \"></i> Add to Order</a>";
            },
        }
    });

    function removeProduct(module_id)
    {
        if(confirm("Are you sure?"))
        {
            var delete_data = { deleted: 1 };

            jQuery.ajax({
                url: base_url + 'grid/onclick/update/depot_order_product/' + module_id,
                type: 'POST',
                data: delete_data,
                success:function(data){
                    if(data)
                    {
                        simbanic_grid_list.bootgrid("reload");
                    }
                    else
                    {
                        alert('Something went wrong');
                    }
                }
            });
        }
    }

    function orderSave()
    {
        var comment = jQuery('textarea[name="comment"]').val();
        var order_save = {
            comment: comment,
            order_id: '<?= $order->id; ?>',
        };

        jQuery.ajax({
            url: base_url + 'cart/save',
            type: 'POST',
            data: order_save,
            dataType: 'json',
            success: function(json)
            {
                if(json['error'])
                {
                    alert(json['error']);
                }
                if(json['success'])
                {
                    responseSuccess(json['success']);
                    cart_order_list_data.bootgrid("reload");
                    location = base_url + 'order';
                }
            }
        });
    }
</script>
<?php } ?>