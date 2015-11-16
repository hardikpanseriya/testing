<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class m_pdf {
    
    function m_pdf()
    {
        $CI = & get_instance();
    }

    function load($param = NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
        
        if ($params == NULL)
        {
            $param = '"c", "A4", "", "", 20, 15, 38, 25, 10, 10';
        }
        
        //return new mPDF($param);
    }
}