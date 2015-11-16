    <?php $this->load->view( BACKEND . '/invoice/view/header'); ?>

    <div class="col-md-12 search_none">
        <div class="table-responsive">
            <table id="invoice_product_list" class="table table-striped table-bordered table-hover">
                <?php echo displayGrid($gridDefs); ?>
            </table>
        </div>
    </div>

    <?php $this->load->view( BACKEND . '/invoice/view/footer'); ?>

<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;
    var invoice_id = <?= (int)$invoice_id; ?>;
    var view_status = "<?= $this->input->get_post('view') ? $this->input->get_post('view') : ''; ?>";
    var user_type = '<?= $this->ion_auth->user()->row()->user_type ?>';

    var bootgrid_table_id = jQuery('table').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);
    
    var product_grid = simbanic_grid_list.bootgrid({
        ajax: true,
        navigation: 1,
        sorting: false,
        columnSelection: true,
        rowCount: -1,
        url: base_url + "get/invoice/product/" + invoice_id + '?view='+view_status,
        formatters: {
            "order_quantity": function(column, row)
            {
                if(row.order_quantity)
                {
                    if(row.order_quantity == 'Total')
                    {
                        return row.order_quantity;
                    }
                    else
                    {
                        if(user_type == 'admin' || (row.date_confirm == null && view_status == 'customer'))
                        {
                            return "<span class='simba_edit_row' data-simba-text='"+ row.order_quantity +"' onclick=\"return inputField(this)\">" + row.order_quantity + "</span>";
                        }
                        else
                        {
                            return row.order_quantity;
                        }
                    }
                }
            },
            "action": function(column, row)
            {
                if(row.id)
                {
                    if(user_type == 'admin')
                    {
                        return "<a class=\"btn btn-sm red\" onclick=\"return simbanicRemove('depot_invoice_product', "+ row.id +")\"><i class=\"fa fa-trash-o\"></i> Delete</a>";
                    }
                    else if(row.date_confirm == null && view_status == 'customer')
                    {
                        return "<a class=\"btn btn-sm red\" onclick=\"return simbanicRemove('retailer_invoice_product', "+ row.id +")\"><i class=\"fa fa-trash-o\"></i> Delete</a>";
                    }
                }
            },
        }
    }).on("loaded.rs.jquery.bootgrid", function(e)
    {
        var current_rows = simbanic_grid_list.bootgrid("getCurrentRows");
        if(user_type == 'admin')
        {
            simbanicGridAttribute(current_rows, 'depot_invoice_product', 'id');
        }
        else if(view_status == 'customer')
        {
            simbanicGridAttribute(current_rows, 'retailer_invoice_product', 'id');
        }
        simbanicGridWidth(griddefs, true);
    });

    function print_invoice()
    {
        var transportation_name = jQuery('#transportation_name').val();
        var lr_no = jQuery('#lr_no').val();
        if(transportation_name && lr_no)
        {
            var get_str = '?transportation_name=' + transportation_name + '&lr_no=' + lr_no;
            location = base_url + 'invoice/generate/' + invoice_id + get_str;
        }
        else
        {
            alert('Please Complete All Fields.');
        }
    }

    function save_comment_invoice()
    {
        var comment = jQuery('#comment').val();
        var suffix = "<?= '?'.http_build_query($_GET, '', '&'); ?>";
        
        if(comment)
        {
            jQuery.ajax({
                url: base_url + 'invoice/comment/' + invoice_id + suffix,
                type: 'POST',
                data: { comment: comment },
                dataType: 'json',
                success: function(json)
                {
                    if (json['error'])
                    {
                        alert(json['error']);
                    }
                    if (json['success'])
                    {
                        responseSuccess(json['success']);
                    }   
                }
            });
        }
        else
        {
            alert('Please Enter Comment');
        }
    }

</script>