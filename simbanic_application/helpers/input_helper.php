<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('simbanic_validation'))
{
	function simbanic_validation($input_name)
	{
		return form_error($input_name, '<div class="simba_form_error">', '</div>');
	}
}


// text box input (name, value, another data as array)
if ( ! function_exists('simbanic_input'))
{
	function simbanic_input($label_name, $input_name, $input_value = '', $data = array())
	{
		$input_data = array(
			'name'   => $input_name,
			'id'     => $input_name,
			'value'  => isset($input_value) && !empty($input_value) ? $input_value : '',
		);
		if(array_key_exists('class', $data))
		{
			$data['class'] .= ' form-control simba_form_control';	
		}
		else
		{
			$data['class'] = 'form-control simba_form_control';
		}
		/*if (!empty(form_error($input_name)))
		{
			$data['class'] .= " simba_form_error";
		}*/

		$input = array_merge($input_data, $data);
		
		return simbanic_label($label_name) . form_input($input) . simbanic_validation($input_name);
	}
}

// text box password
if ( ! function_exists('simbanic_password'))
{
	function simbanic_password($label_name, $input_password, $input_value = '', $data = array())
	{
		$input_data = array(
			'name'   => $input_password,
			'id'     => $input_password,
			'value'  => isset($input_value) ? $input_value : '',
			'autocomplete' => 'off'
		);
		if(array_key_exists('class', $data))
		{
			$data['class'] .= ' form-control simba_form_control';	
		}
		else
		{
			$data['class'] = 'form-control simba_form_control';
		}

		$input = array_merge($input_data, $data);

		return simbanic_label($label_name) . form_password($input) . simbanic_validation($input_password);
	}
}

// select box (name, options as array, default selected value, pass another data)
if ( ! function_exists('simbanic_select'))
{
	function simbanic_select($label_name, $select_name, $options = array(), $default_select = '', $data = array())
	{
		$data['id'] = $select_name;
		if(isset($data['class']) && array_key_exists('class', $data))
		{
			$data['class'] = $data['class'] . ' form-control simba_form_control';
		}
		else
		{
			$data['class'] = 'form-control simba_form_control';	
		}
		
		if(!empty($data))
		{
			$static_data = '';
			foreach($data as $key => $value)
			{
				$static_data .= $key . '=' . '"' . $value . '" ';
			}
		}
		else
		{
			$static_data = '';
		}
		
		return simbanic_label($label_name) . form_dropdown($select_name, $options, 
			$default_select, $static_data) . simbanic_validation($select_name);
	}
}

// multiselect box (name, options as array, default selected value as array, pass another data)
if ( ! function_exists('simbanic_multiselect'))
{
	function simbanic_multiselect($multiselect_name, $options = array(), $default_selectmulti = array(), $data = array())
	{
		if(!empty($data))
		{
			$static_data = '';
			foreach($data as $key => $value)
			{
				$static_data .= $key . '=' . '"' . $value . '" ';
			}
		}
		else
		{
			$static_data = '';
		}

		return form_multiselect($multiselect_name, $options, $default_selectmulti, $static_data) . simbanic_validation($multiselect_name);
	}
}

// check box (name, value, selected or not, pass another data as array)
if ( ! function_exists('simbanic_checkbox'))
{
	function simbanic_checkbox($checkbox_name, $checkbox_value = '', $checked = FALSE, $data = array())
	{
		$checkbox_data = array(
			'name'   => $checkbox_name,
			'id'     => $checkbox_name,
			'value'  => isset($checkbox_value) && !empty($checkbox_value) ? $checkbox_value : '',
			'checked' => $checked,
		);

		$checkbox = array_merge($checkbox_data, $data);

		return form_checkbox($checkbox) . simbanic_validation($checkbox_name);
	}
}

// radio button (name, value, selected or not, pass another data as array)
if ( ! function_exists('simbanic_radio'))
{
	function simbanic_radio($radio_name, $radio_value = '', $checked = FALSE, $data = array())
	{
		$radio_data = array(
			'name'   => $radio_name,
			//'id'     => $radio_name,
			'value'  => isset($radio_value) ? $radio_value : '',
			'checked' => $checked,
		);

		$radio = array_merge($radio_data, $data);

		return form_radio($radio) . simbanic_validation($radio_name);
	}
}

// text box input (name, value, another data as array)
if ( ! function_exists('simbanic_textarea'))
{
	function simbanic_textarea($label_name, $textarea_name, $textarea_value = '', $data = array())
	{
		if(isset($data['class']) && array_key_exists('class', $data))
		{
			$data['class'] = $data['class'] . ' form-control simba_form_control';
		}
		else
		{
			$data['class'] = 'form-control simba_form_control';	
		}
		if(isset($data['rows']) && array_key_exists('rows', $data))
		{
			$data['rows'] = $data['rows'];
		}
		else
		{
			$data['rows'] = '3';
		}
		
		$input_data = array(
			'name'   => $textarea_name,
			'id'     => $textarea_name,
			'value'  => isset($textarea_value) && !empty($textarea_value) ? $textarea_value : '',
		);

		$textarea = array_merge($input_data, $data);

		return simbanic_label($label_name) . form_textarea($textarea) . simbanic_validation($textarea_name);
	}
}

// file upload (name, value, another data as array)
if ( ! function_exists('simbanic_upload'))
{
	function simbanic_upload($upload_name, $upload_value = '', $data = array())
	{
		$upload_data = array(
			'name'   => $upload_name,
			'id'     => $upload_name,
			'value'  => isset($upload_value) && !empty($upload_value) ? $upload_value : '',
		);

		$upload = array_merge($upload_data, $data);

		return form_upload($input);
	}
}

// file upload (name, value, another data as array)
if ( ! function_exists('simbanic_label'))
{
	function simbanic_label($label_name, $label_for = '', $data = array())
	{
		if(!empty($label_name))
		{
			$data['class'] = 'simba_form_label';
			return form_label($label_name, $label_for, $data);	
		}
		else
		{
			return '';
		}
		
	}
}