    
    var cart_order_list_data = jQuery("#cart_order_list_data");
    
    var cart_grid = cart_order_list_data.bootgrid({
        ajax: true,
        navigation: 1,
        sorting: false,
        columnSelection: true,
        rowCount: 1000,
        url: base_url + "cart/info",
        formatters: {
            "action": function(column, row)
            {
                if(row.rowid)
                {
                    return "<a id='"+ row.rowid +"' class=\"btn btn-sm purple\" onclick=\"return updateInputQty(this)\"><i class=\"fa fa-edit\"></i> Edit Qty</a>&nbsp;<a class=\"btn btn-sm red\" onclick=\"return removeToCart('" + row.rowid + "')\"><i class=\"glyphicon glyphicon-remove-circle\"></i> Remove Product</a>";    
                }
            },
        }
    });

    function addToCart(product_id)
    {
        var product_id = product_id;
        var quantity = jQuery('input[name="'+ product_id +'_quantity"]').val();

        var cart_data = {
            product_id : product_id,
            quantity : quantity,
        }

        if(quantity)
        {
            jQuery.ajax({
                url: base_url + 'cart/add',
                type: 'POST',
                data: cart_data,
                dataType: 'json',
                success: function(json)
                {
                    
                    if (json['error'])
                    {
                        alert(json['error']);
                    }

                    if (json['redirect'])
                    {
                        location = json['redirect'];
                    }
                    
                    if (json['success'])
                    {
                        responseSuccess(json['success']);
                        cart_order_list_data.bootgrid("reload");
                        appendData();
                    }   
                }
            });
        }
        return false;
    }

    function updateCart(rowid, qty)
    {
        var cart_update = {
            rowid: rowid,
            qty: qty,
        };

        jQuery.ajax({
            url: base_url + 'cart/update',
            type: 'POST',
            data: cart_update,
            dataType: 'json',
            success: function(json)
            {
                cart_order_list_data.bootgrid("reload");
            }
        });
    }

    function refreshCart()
    {
        cart_order_list_data.bootgrid("reload");
    }

    function removeToCart(rowid)
    {
        updateCart(rowid, 0);
    }

    function isNumber(n) 
    {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function updateQty(rowid)
    {
        var qty = jQuery('.cart_qty_input').val();
        if(qty.indexOf('-') == -1)
        {
            if(isNumber(qty) && qty != 0)
            {
                updateCart(rowid, qty);
            }
            else
            {
                alert('Please Enter Numeric Value');
            }
        }
        else
        {
            alert('Please Enter Numeric Value');
        }
    }

    function updateInputQty(field)
    {
        if(cart_order_list_data.find('input').length == 0)
        {
            var rowid = jQuery(field).attr('id');
            var qty_position = jQuery(field).parent('td').parent('tr').children('td').eq(2);
            var qty_value = jQuery(qty_position).text();
            var input_qty = "<input id=\"\" class=\"form-control cart_qty_input\" type=\"number\" value='"+ qty_value +"' name=\"quantity\">";
            jQuery(qty_position).html(input_qty);
            jQuery(jQuery(field).parent('td')).html("<a class=\"btn btn-sm purple\" onclick=\"return updateQty('"+ rowid +"')\"><i class=\"fa fa-edit\"></i> Save</a>&nbsp;<a class=\"btn btn-sm red\" onclick=\"return refreshCart()\"><i class=\"glyphicon glyphicon-remove-circle\"></i> Cancel</a>");
        }
    }