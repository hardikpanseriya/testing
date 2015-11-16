<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('public_url'))
{
    function public_url()
    {
   		return base_url().'public/';
	}

	function simba_die($msg = '')
	{
		die($msg);
	}
	function simba_print($msg = '')
	{
		echo '<pre>';
		print_r($msg);
		echo '</pre>';
	}

	function simbanic_validation_check()
    {
        $error = 'field is required';
        $this->form_validation->set_message('simbanic_validation_check', $error);
        return FALSE;
    }
}

if ( ! function_exists('public_backend_url'))
{
	function public_backend_url()
    {
   		return base_url(). '' . BACKEND . '/';
	}
}

if ( ! function_exists('redirect_backend_url'))
{
	function redirect_backend_url($url = '')
    {
   		return base_url($url );
	}
}

if ( ! function_exists('public_frontend_url'))
{
	function public_frontend_url()
    {
   		return base_url().'public/';
	}
}

if ( ! function_exists('convertDMYtoYMD'))
{
	function convertDMYtoYMD($separator, $date)
    {
    	if (strpos($date, ':') !== false)
        {
        	// return datetime
        	$c_date = str_replace($separator, '-', $date);
            return date('Y-m-d H:i:s', strtotime($c_date));
        }
        else
        {
        	// return date
        	$c_date = str_replace($separator, '-', $date);
        	return date('Y-m-d', strtotime($c_date));
        }
	}
}

if ( ! function_exists('convertYMDtoDMY'))
{
    function convertYMDtoDMY($separator, $date)
    {
        if (strpos($date, ':') !== false)
        {
            // return datetime
            $c_date = str_replace($separator, '-', $date);
            return date('d-m-Y H:i:s', strtotime($c_date));
        }
        else
        {
            // return date
            $c_date = str_replace($separator, '-', $date);
            return date('d-m-Y', strtotime($c_date));
        }
    }
}

if ( ! function_exists('gridDisplayDate'))
{
    function gridDisplayDate($db_date)
    {
        return date('d-m-Y', strtotime($db_date));
    }
}

if ( ! function_exists('displayGrid'))
{
    function displayGrid($griddefs)
    {
        $return_grid = '<thead>';
        $return_grid .= '<tr>';
        foreach ($griddefs as $key => $value)
        {
            if(array_key_exists('default', $griddefs[$key]))
            {
                if($value['default'])
                {
                    if(array_key_exists('width', $griddefs[$key]))
                    {
                        $width = $value['width'];
                    }
                    else
                    {
                        $width = '';
                    }

                    if(array_key_exists('formatter', $griddefs[$key]))
                    {
                        if($value['formatter'])
                        {
                            $return_grid .= '<th data-column-id="'. $key .'" data-simba-field="'. $key .'" data-formatter="'. $key .'" width="'. $width .'" style="width:'. $width .'">'. $value['label'] .'</th>';
                        }
                        else
                        {
                            $return_grid .= '<th data-column-id="'. $key .'" data-simba-field="'. $key .'" width="'. $width .'" style="width:'. $width .'">'. $value['label'] .'</th>';
                        }
                    }
                    else
                    {
                        $return_grid .= '<th data-column-id="'. $key .'" data-simba-field="'. $key .'" width="'. $width .'" style="width:'. $width .'">'. $value['label'] .'</th>';
                    }
                }
            }
        }
        $return_grid .= '</tr>';
        $return_grid .= '</thead>';
        
        return $return_grid;
    }
}