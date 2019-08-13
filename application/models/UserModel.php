<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	var $table = 'user';
	var $column_order = array(null,'first_name', 'last_name',null); //set column field database for datatable orderable
	var $column_search = array('first_name','last_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getById($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}







	private function _get_datatables_query()
	{
		
		$this->db->select('a.*,b.description as year_level_description');
		$this->db->from('participant a');
		$this->db->join('look_up b', 'a.year_level = b.look_up_id', 'left');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		$this->db->where('super_user', FALSE);

		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$this->db->where('super_user', FALSE);
		
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		$this->db->where('super_user', FALSE);
		
		return $this->db->count_all_results();
	}



	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('participant_id', $id);
		$this->db->delete($this->table);
	}
	
	public function mark_as_admin($id)
	{
		$sql = "UPDATE ".$this->table." SET admin_user = TRUE WHERE playlist_id = " . (int)$id; 
		$this->db->query($sql);
		
		$data['aaa'] = $sql;
		error_log(json_encode($data));

		return $this->db->affected_rows();

	}



}
