<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simba_Model extends Query_Model
{
    public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
    public $listviewdefs = array();
    public $table = '';
    public $record = '';
    public $user_id = '';
    public $simbanic_id = '';

	public function __construct()
	{
		parent::__construct();
	}

	public function save()
	{
        $this->pre_user_save();
        $this->preProcessSave();
        $this->db_data = $this->setDbData($this->request_data, $this->vardefs);
        $simbanic_id = $this->query_model->save($this->table, $this->db_data, $this->record);
        $this->simbanic_id = $simbanic_id;

        $this->postProcessSave();
        $this->post_user_save();
	}

    public function pre_user_save()
    {
        $id = $this->record;
        if(empty($id))
        {
            if($this->simba_init->saveCustomerIDTable($this->module))
            {
                $customer_id = $this->simba_init->getCustomerID($this->request_data['home_state']);
                
                //$password = $this->input->post('password');
                $email = '';

                $password = substr($this->input->post('account_no'), -4);

                $additional_data = array(
                    'full_name' => $this->input->post('full_name'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'user_type' => $this->input->post('user_type'),
                    'sponsor_id' => $this->input->post('sponsor_id'),
                );

                $group_ids = $this->input->post('group_ids');

                $user_id = $this->ion_auth->register($customer_id, $password, $email, $additional_data, $group_ids);

                if($this->module == 'customer')
                {
                    $customer_info = $this->customer->getCustomerInfo($this->input->post('sponsor_id'));
                    if($customer_info)
                    {
                        $this->request_data['tree_id'] = $customer_info->tree_id + 1;
                    }
                }
                
                $this->user_id = $user_id;
                $this->request_data['customer_id'] = $customer_id;
                $this->request_data['user_id'] = $user_id;
                $this->request_data['password'] = $password;
            }
        }
    }

    public function post_user_save()
    {
        $id = $this->record;
        if(empty($id))
        {
            if($this->simba_init->saveCustomerIDTable($this->module))
            {
                $simbanic_id = $this->simbanic_id;
                $user_id = $this->user_id;
                $user_update = array('simbanic_id' => $simbanic_id);

                $this->query_model->save('user', $user_update, $user_id);

                $this->load->model('sms/sms');
                $this->sms->createCustomer($user_id);

                $this->session->set_flashdata('success_message', $this->request_data['customer_id'] . ' ' . $this->request_data['full_name'] . ' Created Successfully');
            }
        }
        else
        {
            if($this->simba_init->saveCustomerIDTable($this->module))
            {
                $simba_user_id = (int)$this->data['user_id'];
                $old_password = $this->data['password'];
                $customer_id = $this->data['customer_id'];
                $sponsor_id = $this->data['sponsor_id'];
                $full_name = $this->data['full_name'];
                $mobile_no = $this->data['mobile_no'];

                $post_password = $this->input->post('password');
                $sponsor_id = $this->input->post('sponsor_id');
                $full_name = $this->input->post('full_name');
                $mobile_no = $this->input->post('mobile_no');


                if(!empty($old_password) && !empty($post_password) && $old_password != $post_password)
                {
                    $this->ion_auth->reset_password($customer_id, $post_password);
                    $this->load->model('sms/sms');
                    $this->sms->changePassword($simba_user_id);
                }

                $user_update = array(
                    'full_name' => $full_name
                );
                if(isset($sponsor_id))
                {
                    $user_update['sponsor_id'] = $sponsor_id;
                }
                if(isset($mobile_no))
                {
                    $user_update['mobile_no'] = $mobile_no;
                }
                $this->query_model->save('user', $user_update, $simba_user_id);
            }
        }
    }

	public function validate($request_data, $vardefs_data)
    {
        $this->load->library('form_validation');
        $this->load->helper('inflector');
        $field_vardefs = $vardefs_data['fields'];
        
        foreach($request_data as $req_key => $req_val)
        {
            if(array_key_exists($req_key, $field_vardefs))
            {
                if(array_key_exists('required', $field_vardefs[$req_key]))
                {
                    if($field_vardefs[$req_key]['required'])
                    {
                        $this->form_validation->set_rules($req_key, humanize($req_key), $field_vardefs[$req_key]['rule']);
                    }
                }
            }
        }

        if ($this->form_validation->run() == FALSE)
        {
            return $this->form_validation->run();
        }
        else
        {
            return true;
        }
    }

    public function preProcessSave()
    {
        $field_vardefs = $this->vardefs['fields'];
        $request_data = $this->request_data;

        foreach($request_data as $req_key => $req_val)
        {
            if(array_key_exists($req_key, $field_vardefs))
            {
                if(array_key_exists('method', $field_vardefs[$req_key]))
                {
                    $this->request_data[$req_key] = implode(",", $req_val);
                }
                if(array_key_exists('type', $field_vardefs[$req_key]))
                {
                    if($field_vardefs[$req_key]['type'] == 'date' || $field_vardefs[$req_key]['type'] == 'datetime')
                    {
                        if (strpos($req_val, '/') !== false) 
                        {
                            $this->request_data[$req_key] = convertDMYtoYMD('/', $req_val);
                        }
                        else
                        {
                            $this->request_data[$req_key] = convertDMYtoYMD('-', $req_val);
                        }
                    }
                }
            }
        }

        $this->preProcessCommon();
    }

    public function preProcessCommon()
    {
        $id = $this->record;
        if(!empty($id))
        {
            $this->request_data['date_modified'] = CURRENT_DATETIME;
        }
        else
        {
            $this->request_data['created_by'] = $this->ion_auth->get_user_id();
            $this->request_data['date_created'] = CURRENT_DATETIME;
            $this->request_data['date_modified'] = CURRENT_DATETIME;
        }
    }

    public function postProcessSave()
    {
        $this->session->set_flashdata('success_message', 'Successfully Saved.');
    }

    public function loadVarDefs()
    {
        $load_module = $this->module;
        if(isset($load_module) && !empty($load_module))
        {
            if(file_exists(APPPATH . 'vardefs/' . strtolower($this->module) . '/vardefs.php'))
            {
                require_once(APPPATH . 'vardefs/' . strtolower($this->module) . '/vardefs.php');
                if(isset($dictionary))
                {
                    $this->setVarDefs($dictionary);
                }
            }
        }
    }

    public function loadListViewDefs()
    {
        if(file_exists(APPPATH . 'vardefs/' . strtolower($this->module) . '/listviewdefs.php'))
        {
            require_once(APPPATH . 'vardefs/' . strtolower($this->module) . '/listviewdefs.php');
            $this->listviewdefs = $listViewDefs[strtolower($this->module)];
        }
    }

    public function setVarDefs($dictionary)
    {
        $this->vardefs = $dictionary[strtolower($this->module)];
    }

    public function setListViewDefs($module)
    {
        if(file_exists(APPPATH . 'vardefs/' . strtolower($module) . '/listviewdefs.php'))
        {
            require_once(APPPATH . 'vardefs/' . strtolower($module) . '/listviewdefs.php');
            $this->listviewdefs = $listViewDefs[strtolower($module)];
        }
    }

    public function loadDefs($folder_name, $file_name)
    {
        if(file_exists(APPPATH . 'vardefs/' . strtolower($folder_name) . '/' . strtolower($file_name) . '.php'))
        {
            require_once(APPPATH . 'vardefs/' . strtolower($folder_name) . '/' . strtolower($file_name) . '.php');
            
            $this_name = $$file_name;
            $this->$file_name = $this_name[strtolower($folder_name)];
        }
    }

    public function setRequestData()
    {
        $this->request_data = array_merge($_GET, $_POST);
    }

    public function setDbData($request_data, $vardefs_data)
    {
        $field_vardefs = $vardefs_data['fields'];
        $db_data = array();
        foreach($request_data as $req_key => $req_val)
        {
            if(array_key_exists($req_key, $field_vardefs))
            {
                $db_data[$req_key] = $req_val;
            }
        }
        return $db_data;
    }

    public function delete()
    {
        $id = $this->record;
        if(!empty($id))
        {
            $delete_data = array('deleted' => '1');
            $this->query_model->delete($this->table, $this->record, $delete_data);
        }
        else
        {
            simba_die('something went wrong. record not found');
        }
    }

    public function retrieve($module, $record)
    {
        if(!empty($record))
        {
            $data = $this->query_model->get($this->table, $record);
            $setData = $this->afterRetrieve($data);
            return $setData;
        }
        else
        {
            simba_die('something went wrong. record not found');
        }
    }

    public function afterRetrieve($data)
    {
        $field_vardefs = $this->vardefs['fields'];
        $db_data = $data;
        if($db_data)
        {
            foreach($db_data as $db_key => $db_val)
            {
                if(array_key_exists($db_key, $field_vardefs))
                {
                    if(array_key_exists('type', $field_vardefs[$db_key]))
                    {
                        if($field_vardefs[$db_key]['type'] == 'date' || $field_vardefs[$db_key]['type'] == 'datetime')
                        {
                            $data->$db_key = convertYMDtoDMY('-', $db_val);
                        }
                    }
                }
            }
        }

        
        return $data;
    }

    public function search($table_name, $data, $limit = '', $start = '', $order_by = 'ASC', $search_relate = 'autosuggestion')
    {
        foreach($data as $key => $value)
        {
            if($search_relate == 'autosuggestion')
            {
                if($key == 'customer_id')
                {
                    if($this->input->post('type'))
                    {
                        $this->db->select('customer_id as id');
                        $this->db->select("CONCAT( customer_id , ' - ', full_name) as text", FALSE);
                    }
                    elseif($this->input->post('user_type'))
                    {
                        $this->db->select('id');
                        $this->db->select("CONCAT( customer_id , ' - ', full_name) as text", FALSE);
                    }
                    else
                    {
                        $this->db->select('customer_id as id');
                        $this->db->select("CONCAT( customer_id , ' - ', full_name) as text", FALSE);
                    }
                    
                }
            }
            if($this->input->post('type'))
            {
                $customer_id_array = array('customer', 'admin');
                $this->db->where_in('user_type', $customer_id_array);
                $this->db->where($key. ' !=', '');
                $this->db->like($key, $value);
            }
            else
            {
                $this->db->like($key, $value);
                $this->db->where($key. ' !=', '');
            }
        }
        
        if(isset($limit) && !empty($limit))
        {
            if(isset($start) && !empty($start))
            {
                $this->db->limit($limit, $start);
            }
            else
            {
                $this->db->limit($limit, 0);
            }
        }

        $this->db->order_by('id', $order_by);
        $res = $this->db->get($table_name);
        //echo $this->db->last_query();
        
        if ($res->num_rows() > 0)
        {
            return $res->result();
        }
        else
        {
            return false;
        }
    }

    public function search_customer_id($search_data, $limit = '', $start = '')
    {
        foreach($search_data as $key => $value)
        {
            if($key == 'customer_id')
            {
                if($this->input->get_post('select'))
                {
                    $this->db->select($this->input->get_post('select') . ' as id');
                    $this->db->select('full_name');
                    $this->db->select('customer_id');
                }
                $this->db->select("CONCAT( customer_id , ' - ', full_name) as text", FALSE);
                if($this->input->get_post('display'))
                {
                    //$this->db->or_where('user_id', 1);
                }
                else
                {
                    if($this->input->get_post('select'))
                    {
                        $this->db->where('user_id !=', 1);
                    }
                }
            }

            $this->db->like($key, $value);
            $this->db->where($key. ' !=', '');
            
        }

        if(isset($limit) && !empty($limit))
        {
            if(isset($start) && !empty($start))
            {
                $this->db->limit($limit, $start);
            }
            else
            {
                $this->db->limit($limit, 0);
            }
        }

        $this->db->order_by('id', 'ASC');
        $res = $this->db->get('customer');
        //echo $this->db->last_query();
        //die();
        if ($res->num_rows() > 0)
        {
            return $res->result();
        }
        else
        {
            return false;
        }
    }

    public function search_customer_medical_store($search_data, $limit = '', $start = '')
    {
        $this->db->select('user_id as id');
        $this->db->select('full_name as text');
        $this->db->select('customer_id');

        foreach($search_data as $key => $value)
        {
            $this->db->like($key, $value);
            $this->db->where($key. ' !=', '');
        }

        if(isset($limit) && !empty($limit))
        {
            if(isset($start) && !empty($start))
            {
                $this->db->limit($limit, $start);
            }
            else
            {
                $this->db->limit($limit, 0);
            }
        }

        $this->db->order_by('id', 'ASC');
        $res = $this->db->get('customer');
        
        if ($res->num_rows() > 0)
        {
            return $res->result();
        }
        else
        {
            return false;
        }
    }

    
}
?>