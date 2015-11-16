<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Created By: SimbaNIC */

class Query_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function save($table_name, $data, $record = NULL)
	{
		if(!empty($record))
		{
			return $this->updateData($table_name, $record, $data);
		}
		else
		{
			return $this->insertData($table_name, $data);
		}
	}

	public function save_multiple($table_name, $data = array())
	{
	    $this->db->insert_batch($table_name, $data);
	    return $this->db->affected_rows();
	}

	public function insertData($table_name, $data)
    {
        $this->db->set($data);
        $this->db->insert($table_name, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function updateData($table_name, $record, $data)
	{
		$this->db->where('id', $record);
		$this->db->update($table_name, $data);
		return $record;
	}

	public function update_Data($table_name, $update_data, $update_where)
	{
		$this->db->set($update_data);
		$this->db->update($table_name, $update_data, $update_where);
		return $this->db->affected_rows() > 0;
	}

	public function delete($table_name, $record, $data = NULL)
	{
		$this->db->where('id', $record);
		$this->db->update($table_name, $data);
		return true;
	}

	public function delete_hard($table_name, $data = array())
	{
		$this->db->delete($table_name, $data);
		return $this->db->affected_rows();
	}

	public function get($table_name, $record)
	{
		$this->db->where('id', $record);
		$res = $this->db->get($table_name);
		if ($res->num_rows() == 1)
        {
            return $res->row();
        }
        else
        {
            return false;
        }
	}

	
}
?>