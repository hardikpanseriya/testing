<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Simba_Loader extends CI_Loader 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function render($template_name, $data = array(), $footer_return = TRUE, $return = FALSE)
    {
        if(!empty($data))
        {
            $this->data = $data;
        }
        else
        {
            $this->data = array();
        }

        $content  = $this->view( BACKEND . '/common/header', $data, $return);
        $content .= $this->view( BACKEND . '/'. $template_name, $data, $return);
        if($footer_return)
        {
            $content .= $this->view( BACKEND . '/common/footer', $data, $return);
        }

        if ($return)
        {
            return $content;
        }
    }
}