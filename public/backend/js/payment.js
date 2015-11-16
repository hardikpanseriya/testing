    jQuery('#add_payment').on('click', function(){
        
        if(!jQuery( "table tr" ).hasClass( "add_payment_row" ))
        {
            var add_payment = '<tr class="add_payment_row">';
            for(var key in griddefs)
            {
                if(griddefs[key].hasOwnProperty('edit'))
                {
                    if(griddefs[key].hasOwnProperty('default'))
                    {
                        if(griddefs[key]['default'] && key != 'action')
                        {
                            add_payment += '<td>';
                            if(griddefs[key]['edit'])
                            {
                                if(griddefs[key].hasOwnProperty('type'))
                                {
                                    if(griddefs[key]['type'] == 'input')
                                    {
                                        add_payment += '<input id="'+ key +'" type="text" name="'+ key +'" class="form-control simba_inline_form_control" placeholder="Enter '+ griddefs[key]['label'] +'">';        
                                    }
                                    else if(griddefs[key]['type'] == 'select')
                                    {
                                        add_payment += '<select id="'+ key +'" type="text" name="'+ key +'" class="form-control simba_inline_form_control" placeholder="Enter '+ griddefs[key]['label'] +'">';

                                        for(var option_key in griddefs[key]['options'])
                                        {
                                            add_payment += '<option value="'+ option_key +'">';
                                            add_payment += griddefs[key]['options'][option_key];
                                            add_payment += '</option>';
                                        }
                                        add_payment += '</select>';
                                    }
                                }
                            }
                            add_payment += '</td>';
                        }
                    }
                }
                
                if(key == 'action')
                {
                    add_payment += '<td>';
                    add_payment += '<a class="btn btn-sm green" onclick="return simbanicSave(this)"><i class="fa fa-save"></i> Save</a> ';
                    add_payment += ' <a class="btn btn-sm red" onclick="return simbanicCancel(this)"><i class="fa fa-times"></i> Cancel</a>';
                    add_payment += '</td>';
                }
                
            }
            add_payment += '<input type="hidden" name="depot_id" value="'+ depot_id +'">';
            add_payment += '</tr>';
            
            simbanic_grid_list.prepend(add_payment);
        }
        
    });

    function simbanicSave(save)
    {
        var payment_save = jQuery('.add_payment_row input[type=\'text\'], .add_payment_row input[type=\'hidden\'], .add_payment_row select');
        
        $.ajax({
            url: base_url + 'payment/save',
            type: 'POST',
            data: payment_save,
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