<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simba_Backend_Controller extends Simba_Controller
{
    public $request_data = array();
    public $db_data = array();
    public $data = array();
    public $vardefs = array();
    public $table = '';
    public $module = '';
    public $model = '';
    public $record = '';

	public function __construct()
	{
    	parent::__construct();
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login');
        }
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
   	}

   	public function setup($module = '')
   	{
		if(empty($module) && !empty($_REQUEST['module']))
		{
			$module = $_REQUEST['module'];
		}
		
		//set the module
		if(!empty($module))
		{
			$this->setModule($module);
		}
		
		// Load request
		$this->loadRequest();
        $this->loadModel();
        $this->setRecord();
	}

	public function setModule($module)
	{
		$this->module = $module;
	}

   	public function loadRequest()
    {
        if(!$this->simba_init->checkModule($this->module))
        {
            redirect('/');
        }

        if(!empty($_REQUEST['module']))
            $this->module = $_REQUEST['module'];
        if(!empty($_REQUEST['action']))
            $this->action = $_REQUEST['action'];
        if(!empty($_REQUEST['record']))
            $this->record = $_REQUEST['record'];
        if(!empty($_REQUEST['view']))
            $this->view = $_REQUEST['view'];
        if(!empty($_REQUEST['return_module']))
            $this->return_module = $_REQUEST['return_module'];
        if(!empty($_REQUEST['return_action']))
            $this->return_action = $_REQUEST['return_action'];
        if(!empty($_REQUEST['return_id']))
            $this->return_id = $_REQUEST['return_id'];

    }

    public function loadModel()
    {
        $this->load->model($this->module.'/'.$this->module);
        $this->setModelName();
    }

    public function save()
    {
        $this->model->setRequestData();

        if($this->validate())
        {
            $this->pre_action();
            $this->model->save();
            $this->post_action();
        }
        else
        {
            //$this->data = returnFilledData($this->request_data, $this->vardefs);
            $this->data = $_POST;
            $this->edit();
        }
    }

    public function pre_action()
    {
        $this->return_module = $this->module;

        if(!empty($this->uri->segment(3)))
        {
            $this->return_action = $this->uri->segment(3);
        }
        else
        {
            $this->return_action = 'index';
        }
    }

    public function post_action()
    {
        if(!empty($this->return_module))
        {
            //redirect($this->return_module . '/' . $this->return_action);
            redirect($this->return_module);
        }
    }

    public function setModelName()
    {
        $module = $this->module;
        $this->model = $this->$module;
    }

    public function validate()
    {
        if($this->simba_model->validate($this->model->request_data, $this->model->vardefs))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function delete($id)
    {
        $this->pre_action();
        $this->record = $id;
        $this->model->delete();
        $this->post_action();
    }

    public function setRecord()
    {
        if(!empty($this->record))
        {
            $this->record = $this->record;
        }
        elseif(isset($_POST['record']))
        {
            $this->record = $_POST['record'];
        }
        elseif(($this->uri->segment(3) != '') && (is_numeric($this->uri->segment(3))) && $this->uri->segment(2) != 'create' && $this->uri->segment(2) != 'view')
        {
            $this->record = $this->uri->segment(3);
        }
        else
        {
            $this->record = NULL;
        }
        $this->dataRetrieve();
    }

    protected function dataRetrieve()
    {
        if(!empty($this->record))
        {
            $retrieve_data = $this->model->retrieve($this->module, $this->record);
            if($retrieve_data)
            {
                foreach($retrieve_data as $key => $value)
                {
                    $this->data[$key] = $value;
                }
            }
            
            $this->data['record'] = $this->record;
            $this->model->record = $this->record;
        }
    }

    public function loadSimbaVarDefs()
    {
        if(file_exists(APPPATH . 'vardefs/' . 'simbanic' . '/vardefs.php'))
        {
            require_once(APPPATH . 'vardefs/' . 'simbanic' . '/vardefs.php');
            $this->data['simbanic'] = $simbanic;
        }
    }

    public function grid_edit($module_name, $field_name)
    {
        $this->setModule($module_name);
        $this->loadModel();
        $field_value = $this->input->get_post('field_value');
        $module_id = $this->input->get_post('module_id');
        if(isset($module_name) && !empty($module_name) && isset($field_name) && !empty($field_name) && isset($field_value) && !empty($field_value) && isset($module_id) && !empty($module_id))
        {
            $grid_data = array($field_name => $field_value);
            echo $this->model->updateData($this->model->table, $module_id, $grid_data);
        }
        else
        {
            echo "false";
        }
    }

    public function onclick_update($table_name, $record)
    {
        $json = array();
        $tableexist = $this->simba_init->checkTableNameExist($table_name);
        if($tableexist)
        {
            foreach($this->input->post() as $key => $value)
            {
                if(!empty($value))
                {
                    $update = 1;
                    $update_data[$key] = $value;    
                }
                else
                {
                    $update = 0;
                    $json['error'] = 'Please Enter Value.';
                    break;
                }
            }
            
            if($update)
            {
                $this->query_model->save($table_name, $update_data, $record);
                $json['success'] = 'Updated Successfully.';
            }
            else
            {
                $json['error'] = 'Please Enter Value.';
            }
        }
        else
        {
            $json['error'] = 'Something went wrong.';
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($json));
    }

    public function ajax_save($module_name)
    {
        $this->setup($module_name);
        $this->model->setRequestData();

        if($this->validate())
        {
            //$this->pre_action();
            $this->model->save();
            //$this->post_action();
            return true;
        }
        else
        {
            
        }
    }

    /*public function render($view, $data)
    {
    	if(!empty($data))
    	{
    		$this->data = $data;
    	}
    	else
    	{
    		$this->data = array();
    	}
    	
    	return $this->load->view(BACKEND . '/' . $view, $this->data);
    }*/

}

?>