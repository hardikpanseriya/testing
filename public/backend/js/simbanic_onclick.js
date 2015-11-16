var count = 0;
    function inputField(field)
    {
        var field_name = jQuery(field).parent().attr('data-simba-field');
        var field_value = jQuery(field).html();
        var module_id = jQuery(field).parent().parent().attr('data-simba-id');
        var data_simba_text = jQuery(field).attr('data-simba-text');

        count += 1;
        if (count == 1)
        {
            if(griddefs[field_name]['edit'])
            {
                if(griddefs[field_name]['type'] == 'input')
                {
                    jQuery(field).html('<input type="text" name="'+ field_name +'" class="form-control" id="'+ field_name + '_'+ module_id +'" value="'+ field_value +'"><i class="fa fa-save fa-simba-save" onclick="return simbanicUpdate(this);"></i><i class="fa fa-times fa-simba-cancel" onclick="return simbanicUpdateCancel(this);"></i>');
                }
                else if(griddefs[field_name]['type'] == 'select')
                {
                    var simba_select = '<select id="'+ field_name + '_' + module_id + '" type="text" name="'+ field_name +'" class="form-control simba_inline_form_control">';

                    for(var option_key in griddefs[field_name]['options'])
                    {
                        if(data_simba_text == option_key)
                        {
                            simba_select += '<option value="'+ option_key +'" selected>';
                        }
                        else
                        {
                            simba_select += '<option value="'+ option_key +'">';    
                        }
                        
                        simba_select += griddefs[field_name]['options'][option_key];
                        simba_select += '</option>';
                    }

                    simba_select += '</select><i class="fa fa-save fa-simba-save" onclick="return simbanicUpdate(this);"></i><i class="fa fa-times fa-simba-cancel" onclick="return simbanicUpdateCancel(this);"></i>';

                    jQuery(field).html(simba_select);
                }
            }
            else
            {
                count = 0;
            }
        }
        else
        {
            if(jQuery('td .form-control').length)
            {

            }
            else
            {
                count = 0;
            }
        }
        if(field_name == 'expiry_date')
        {
            jQuery('input[name="expiry_date"]').prop('readonly', true);
            jQuery('input[name="expiry_date"]').datepicker({
                minDate: 'today',
                maxDate: "+2920D",
                dateFormat: 'dd-mm-yy',
                changeYear: true
            });
        }
        
    }

    function simbanicUpdate(save)
    {
        var field_name = jQuery(save).parent().parent().attr('data-simba-field');
        var module_id = jQuery(save).parent().parent().parent().attr('data-simba-id');
        var module_name = jQuery(save).parent().parent().parent().attr('data-simba-table');
        var field_value = jQuery('#'+field_name+'_'+module_id).val();

        if(field_name && module_id && module_name && field_value)
        {
            var data_simba_text = jQuery(save).parent().attr('data-simba-text');
            if(data_simba_text != field_value)
            {
                var grid_data = {};
                if(field_name == 'expiry_date')
                {
                    var field_date = field_value;
                    var field_newdate = field_date.split("-").reverse().join("-");
                    grid_data[field_name] = field_newdate;
                }
                else
                {
                    grid_data[field_name] = field_value;
                }
                
                
                jQuery.ajax({
                    url: base_url + 'grid/onclick/update/' + module_name + '/' + module_id,
                    type: 'POST',
                    data: grid_data,
                    success:function(json){

                        if (json['error'])
                        {
                            alert(json['error']);
                        }
                        
                        if (json['success'])
                        {
                            responseSuccess(json['success']);
                            jQuery(save).parent('span').html(field_value);
                            simbanic_grid_list.bootgrid("reload");
                        }
                    }
                });
            }
            else
            {
                jQuery(save).parent('span').html(field_value);
            }  
        }
        else
        {
            alert("Please Enter Value");
        }
    }

    function simbanicUpdateCancel(cancel)
    {
        var data_simba_text = jQuery(cancel).parent().attr('data-simba-text');
        jQuery(cancel).parent().html(data_simba_text);
    }