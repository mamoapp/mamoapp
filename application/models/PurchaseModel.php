<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function getById($id)
	{
		$this->db->from("purchase");
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	} 

	public function insert($data)
	{
		return $this->db->insert("purchase", $data);
	}

	public function update($where, $data)
	{
		$this->db->update("purchase", $data, $where);
		return $this->db->affected_rows();
	}

	public function fetchLatestCustomerOrder(){
		$query = $this->db->query("SELECT a.*, b.qty, c.product_code, c.product_name, (b.qty * c.unit_price) as amount
									FROM purchase a	
									JOIN purchase_detail b ON a.id = b.purchase_id
									JOIN product c ON b.product_id = c.id
									WHERE a.id = (SELECT max(id) FROM purchase)
									AND NOT EXISTS(SELECT 1 FROM invoice WHERE purchase_id = a.id)
		;");
		$results = $query->result();	

		return $results;



	}





	

	
}
