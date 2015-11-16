<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simba_Init
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
    	require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');
    }

    public function checkModule($module_name)
    {
    	$module_list = array(
    					'customer',
                        'depot',
                        'pharma',
                        'product',
                        'stock',
                        'order',
                        'invoice',
                        'payment',
    					);
    	if(in_array($module_name, $module_list))
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function checkTableNameExist($table_name) 
    {
        $this->ci =& get_instance();
        if ($this->ci->db->table_exists($table_name))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveCustomerIDTable($module_name)
    {
        $module_list = array(
                        'customer',
                        'depot',
                        'pharma',
                        );
        
        if(in_array($module_name, $module_list))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getInvoiceID()
    {
        $this->ci =& get_instance();
        $this->ci->load->helper('string');

        return random_string('numeric',6);
    }

    public function getCustomerID($state_name = 'gujarat')
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('string');

        if(file_exists(APPPATH . 'vardefs/' . 'simbanic' . '/vardefs.php'))
        {
            require_once(APPPATH . 'vardefs/' . 'simbanic' . '/vardefs.php');
        }

        if(array_key_exists($state_name, $simbanic['state']))
        {
            return $this->getMaxCustomerID($simbanic[$state_name]['code']);
            //return $simbanic[$state_name]['code'] . random_string('numeric', 4);
        }
        else
        {
            return false;
        }
    }

    public function getMaxCustomerID($state_code)
    {
        $this->CI =& get_instance();

        $simba_customer_id_start_value = $this->CI->config->item('simba_customer_id_start_value');
        $simba_customer_id_state_code = $this->CI->config->item('simba_customer_id_state_code');
        $simba_customer_id_unique_digit = $this->CI->config->item('simba_customer_id_unique_digit');
        $null_start_value = $simba_customer_id_start_value - 1;

        $this->CI->db->select( 'IFNULL(MAX( SUBSTRING( customer_id, ' . $simba_customer_id_unique_digit . ', '. $simba_customer_id_unique_digit .' )), '. $null_start_value .') as customer_id_digit ', FALSE);
        $this->CI->db->where('LEFT(customer_id, 3) =', $state_code);
        $this->CI->db->where('user_type !=', 'admin');
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('user');
        //echo $this->CI->db->last_query();
        //die();
        if($result->num_rows() > 0)
        {
            $next_code = str_pad($result->row()->customer_id_digit + 1, 4, '0', STR_PAD_LEFT);

            if($this->CI->input->post('user_type') == 'depot')
            {
                return $state_code . $next_code . 'D';
            }
            else
            {
                return $state_code . $next_code;    
            }
        }
        else
        {
            if($this->CI->input->post('user_type') == 'depot')
            {
                return $state_code . $simba_customer_id_start_value . 'D';
            }
            else
            {
                return $state_code . $simba_customer_id_start_value;
            }
        }
    }

    public function getAllAdminID()
    {
        return array(1);
    }

    
}

/* End of file Someclass.php */