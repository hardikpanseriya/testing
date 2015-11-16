<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pharma extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'pharma';
	public $grid_search_field = array('full_name', 'customer_id');

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	public function init()
	{
		$this->setTableName($this->table);
		$this->loadVarDefs();
	}

	public function setTableName($table)
	{
		$this->table = $table;
	}

	public function get($id = 0)
	{
		$this->db->where('created_by', $id);
		$this->db->where('deleted', '0');
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get($this->table);
		if ($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
	}

	public function getPharma($id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$admin_ids = $this->simba_init->getAllAdminID();

		if(in_array($id, $admin_ids))
		{
			$this->db->where_in('created_by', $admin_ids);
		}
		else
		{
			$this->db->where('created_by', $id);
		}
		
		$this->db->where('deleted', '0');

		if($search_text != '')
		{
			if(count($this->grid_search_field) > 0)
			{
				foreach($this->grid_search_field as $search_field)
				{
					if(count($this->grid_search_field) == 1)
					{
						$this->db->like($search_field, $search_text);	
					}
					else
					{
						$this->db->or_like($search_field, $search_text);
					}
				}
			}
		}
		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$this->db->limit($limit, $start);
			}
		}

		$this->db->order_by('id', 'DESC');

		$result = $this->db->get($this->table);
		
		if(empty($count))
		{
			if ($result->num_rows() > 0)
	        {
	            return $result->result();
	        }
	        else
	        {
	            return false;
	        }
		}
		else
		{
			return $result->num_rows();
		}
	}

}
?>