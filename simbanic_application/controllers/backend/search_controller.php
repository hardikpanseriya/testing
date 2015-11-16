<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Search_Controller extends Simba_Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		
	}

	public function get($module_name, $field_name)
    {
        $this->setup($module_name);
        $q = $this->input->post('q');

        $search_array = array(
        				$field_name => $q
        				);
        $limit = $this->config->item('simba_sponsorid_limit');

        $search_json = $this->model->search($this->model->table, $search_array, $limit);
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($search_json));
    }

    public function customer_id()
    {
        $q = $this->input->get_post('q');
        
        $search_array = array(
        				'customer_id' => $q
        				);
        
        if($this->input->post('user_type'))
        {
            //$search_array['user_type'] = $this->input->post('user_type');
        }
        if($this->input->post('type'))
        {
            //$search_array['user_type'] = $this->input->post('type');
        }
        $limit = $this->config->item('simba_sponsorid_limit');
        
        $search_json = $this->simba_model->search_customer_id($search_array, $limit);
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($search_json));
    }

    public function customer_medical_store()
    {
        $q = $this->input->get_post('q');
        
        $search_array = array(
                        'full_name' => $q,
                        'customer_type' => 'medical_store'
                        );
        
        $limit = $this->config->item('simba_sponsorid_limit');

        $search_json = $this->simba_model->search_customer_medical_store($search_array, $limit);
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($search_json));
    }

	public function mail()
    {
        $emailsubject = $email_content->subject;
        $emailbody = $email_content->message;
        $from = $this->config->item('smtp_user');
        $to = $user_email;
        $activation_url = anchor('verify/' . $verificationCode, 'Click here', 'title="Verify Your Email"');
        $subject = str_replace('%firstname%', $user_firstname, str_replace('%lastname%', $user_lastname, str_replace('%emailid%', $user_email, $emailsubject)));

        $message = str_replace('%firstname%', $user_firstname, str_replace('%lastname%', $user_lastname, str_replace('%emailid%', $user_email, str_replace('%activationurl%', $activation_url, $emailbody))));
        $mailstatus = $this->emailmodel->sendemail($to, $from, $subject, $message);
        if ($mailstatus)
        {
                redirect('register/nextstep/verificationmail/' . $register_id);
        }
    }

}
?>