<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseDetailModel extends CI_Model {

	var $table = 'purchase_detail';
	var $column_order = array('b.product_code','b.product_name','b.unit_price','a.qty','(a.qty * b.o_price)',null); //set column field database for datatable orderable
	var $column_search = array('b.product_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('a.id' => 'asc'); // default order 


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function addOrder($data)
	{
		return $this->db->insert("purchase_detail", $data);
	}

	/* Returns inserted Invoice ID */
	public function doneCheckout($data)
	{
		$this->db->insert("invoice", $data);
		return $this->db->insert_id();
	}

	public function fetchParentId($id){
		$this->db->select('purchase_id as parentId');
		$this->db->from('purchase_detail');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row()->parentId;
	}

	public function fetchTotalAmount($parentId)
	{
		$this->db->select('sum(a.qty * b.unit_price) as totalAmount');
		$this->db->from('purchase_detail a');
		$this->db->join('product b', 'a.product_id = b.id', 'left');
		$this->db->where('a.purchase_id', $parentId);
		$query = $this->db->get();

		return $query->row();
	}

	public function fetchProductByType($type){
		$this->db->select('a.* ');
		$this->db->from('product a');
		$this->db->where('a.type', $type);
		$query = $this->db->get();

		return $query->result();
	}


	private function _get_main_clause_query(){
		$this->db->select('a.id, 
		a.product_id, 
		a.qty, 
		b.product_code, 
		b.product_name, 
		b.unit_price, 
		(a.qty * b.o_price) as amount');
		$this->db->from('purchase_detail a');
		$this->db->join('product b', 'a.product_id = b.id', 'left');
		
	}

	private function _get_datatables_query()
	{
		$this->_get_main_clause_query();

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

	function get_datatables($parent_id)
	{
		$this->_get_datatables_query();
		$this->db->where('a.purchase_id', $parent_id);

		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function count_filtered($parent_id)
	{
		$this->_get_datatables_query();
		$this->db->where('a.purchase_id', $parent_id);
		
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_by_parent($parent_id)
	{
		$this->_get_main_clause_query($parent_id);
		$this->db->where('a.purchase_id', $parent_id);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
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
		$this->db->where('id', $id);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}

	


}
