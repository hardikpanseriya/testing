
    <div id="notification">
    </div>
    
	<div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="margin_btm_20">
                    <?php $customer_option = array('' => 'Please Select Customer'); ?>
                    <?= simbanic_select('Select Customer', 'retailer_id', $customer_option, isset($retailer_id) ? $retailer_id : ''); ?>
                </div>

                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#order_form">Make New Invoice</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#review_order">Review Your Product</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="order_form" class="tab-pane fade active in">
                        <div class="table-responsive">
                            <table id="invoice_create_product_list" class="table table-striped table-bordered table-hover">
                                <?php echo displayGrid($gridDefs); ?>
                            </table>
                        </div>
                    </div>
                    <div id="review_order" class="tab-pane fade">
                        <?php $this->load->view( BACKEND . '/cart/info'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">

    var griddefs = <?= json_encode($gridDefs); ?>;

    var bootgrid_table_id = jQuery('table#invoice_create_product_list').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);
    
    var grid = simbanic_grid_list.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/product",
        formatters: {
            "quantity": function(column, row)
            {
                return '<input type="text" name="'+ row.product_id +'_quantity" class="form-control input-sm order_quantity" placeholder="Enter Quantity">';
            },
            "action": function(column, row)
            {
                return "<a class=\"btn btn-sm yellow \" onclick=\"return addToCart('" + row.product_id + "')\"><i class=\"fa fa-shopping-cart \"></i> Add to Order</a>";
            },
        }
    }).on("loaded.rs.jquery.bootgrid", function(e)
    {
        simbanicGridWidth(griddefs, 'false', 'invoice_create_product_list');
    });

    appendData();

    function appendData()
    {
        append = '<textarea name="comment" class="simba-form-control form-control order_comment" placeholder="Add Comments About Your Order">';
        append += '</textarea>';
        append += '<a class="btn simba_btn green pull-right margin_btm_20" onclick="return orderSave(this)">';
        append += '<i class="fa fa-save"></i>';
        append += ' Create Invoice';
        append += '</a>';

        jQuery('#order_info').html(append);
    }    

    function orderSave()
    {
        var comment = jQuery('textarea[name="comment"]').val();
        var retailer_id = jQuery('#retailer_id').val();

        var order_save = { };
        order_save['comment'] = comment;
        order_save['retailer_id'] = retailer_id;
        order_save['order_type'] = 'retailer';

        if(retailer_id)
        {
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
                        location = base_url + 'invoice/customer';
                    }
                }
            });
        }
        else
        {
            alert('Please select customer');
        }
    }

</script>


<script type="text/javascript">
    function formatResult (result) 
    {
        return result.customer_id;
    }

jQuery(function(){

    jQuery("#retailer_id").select2({
        ajax: {
            url: base_url + "search/customer_id",
            dataType: 'json',
            type: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page,
                    user_type: 'customer',
                    select: 'user_id',
                };
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            }
        },
        templateResult: formatResult,
    });

});

</script>