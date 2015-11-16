    
    <div class="row">
        <div class="col-md-12">
            <div class="order_stock">
                <?php
                if(isset($order_stock_info) && !empty($order_stock_info))
                {
                    $i = 0;
                    foreach($order_stock_info as $order_stock)
                    {
                        if($order_stock->sufficient_qty == 0)
                        {
                            $i++;
                            ?>
                            <a target="_blank" href="<?= redirect_backend_url('stock/'.$order_stock->product_id); ?>">
                                <?= $order_stock->simbanic_product_name; ?>
                            </a>
                            <br/>
                            <?php
                        }
                    }
                    if($i > 0)
                    {
                        ?>
                        <br/>do not have sufficient quantity.<br/>
                        <a class="btn btn-sm red" href="<?= redirect_backend_url('order/convert/'.$order_id) ?>">
                            <i class="fa fa-refresh"></i> 
                            Try Again
                        </a>
                        <?php
                    }
                }
                ?>
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

    <div class="col-md-12 search_none">
        <div class="table-responsive">
            <table id="order_convert_list" class="table table-bordered">
                <?php echo displayGrid($gridDefs); ?>
            </table>
        </div>
    </div>

    <div class="col-md-12">
        <div id="order_convert_info">

        </div>
    </div>

<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;
    var order_id = <?= (int)$order_id; ?>;

    var bootgrid_table_id = jQuery('table').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);

    var cart_grid = simbanic_grid_list.bootgrid({
        ajax: true,
        navigation: 1,
        sorting: false,
        columnSelection: true,
        rowCount: -1,
        url: base_url + "get/order/product/" + order_id,
        formatters: {
            "order_quantity": function(column, row)
            {
                return '<input type="text" name="quantity['+ row.product_id +']" class="form-control input-sm order_quantity" placeholder="Enter Quantity">';
            },
        }
    });

    function confirmOrder()
    {
        var confirm_order_data = jQuery('#'+ bootgrid_table_id +' input[type=\'text\'], #order_convert_info textarea');

        jQuery.ajax({
            url: base_url + 'order/confirm/' + order_id,
            type: 'POST',
            data: confirm_order_data,
            dataType: 'json',
            success: function(json)
            {
                if(json['error'])
                {
                    alert(json['error']);
                }
                if (json['redirect'])
                {
                    location = json['redirect'];
                }
            }
        });
    }

    appendData();

    function appendData()
    {
        append = '<textarea name="comment" class="simba-form-control form-control order_comment" placeholder="Add Comments About Order">';
        append += '</textarea>';
        append += '<a id="simba_create_invoice" class="btn simba_btn green pull-right margin_btm_20" onclick="return confirmOrder(this)">';
        append += '<i class="fa fa-save"></i>';
        append += ' Create Invoice';
        append += '</a>';

        jQuery('#order_convert_info').html(append);
    }

    <?php
    if(isset($i) && $i > 0)
    {
        ?>
        jQuery(document).ready(function(){
            jQuery('.order_stock').addClass('order_stock_info');
            jQuery('#simba_create_invoice').hide();
        });
        <?php
    }
    ?>
    

</script>