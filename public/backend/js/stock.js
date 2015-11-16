    jQuery('#add_stock').on('click', function(){
        
        if(!jQuery( "table tr" ).hasClass( "add_stock_row" ))
        {
            var add_stock = '<tr class="add_stock_row">';
            for(var key in griddefs)
            {
                if(griddefs[key].hasOwnProperty('edit'))
                {
                    if(griddefs[key]['edit'])
                    {
                        add_stock += '<td>';
                        if(griddefs[key].hasOwnProperty('type'))
                        {
                            if(griddefs[key]['type'] == 'input')
                            {
                                add_stock += '<input id="'+ key +'" type="text" name="'+ key +'" class="form-control simba_inline_form_control" placeholder="Enter '+ griddefs[key]['label'] +'">';
                            }
                        }
                        add_stock += '</td>';
                    }
                }
                
                if(key == 'action')
                {
                    add_stock += '<td>';
                    add_stock += '<a class="btn btn-sm green" onclick="return simbanicSave(this)"><i class="fa fa-save"></i> Save</a> ';
                    add_stock += ' <a class="btn btn-sm red" onclick="return simbanicCancel(this)"><i class="fa fa-times"></i> Cancel</a>';
                    add_stock += '</td>';
                }
                
            }
            add_stock += '<input type="hidden" name="product_id" value="'+ product_id +'">';
            add_stock += '</tr>';
            
            simbanic_grid_list.prepend(add_stock);
        }
        jQuery('input[name="expiry_date"]').prop('readonly', true);

        jQuery('input[name="expiry_date"]').datepicker({
            minDate: 'today',
            maxDate: "+2920D",
            dateFormat: 'dd-mm-yy',
            changeYear: true
        });
        
    });

    function simbanicSave(save)
    {
        var stock_save = jQuery('.add_stock_row input[type=\'text\'], .add_stock_row input[type=\'hidden\']');
        
        $.ajax({
            url: base_url + 'product/stock/save',
            type: 'POST',
            data: stock_save,
            success:function(json) {
                
                if (json['error'])
                {
                    alert(json['error']);
                }
                
                if (json['success'])
                {
                    responseSuccess(json['success']);
                    simbanic_grid_list.bootgrid("reload");
                }
            }
        });
    }

    function simbanicCancel(cancel)
    {
        jQuery(cancel).parent().parent().remove();
    }
    
    