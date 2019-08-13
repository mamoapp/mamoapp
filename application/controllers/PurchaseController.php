<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseController extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PurchaseModel','model');
	}

	public function index()
	{
		$this->load->view('purchase');
	}

	public function payNow(){
		$this->createNewPurchase(true);
	}

	public function payLater(){
		$this->createNewPurchase(false);
	}

	public function createNewPurchase($payNow){
		$dt = new DateTime();
		$data = array(
			'customer_name' => $this->input->post('customer_name'),
			'created_date' => $dt->format('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('loggedInUser')['id'],
			'total_amount' => '',				
		);

		$success = $this->model->insert($data);
		$insertedId = $this->db->insert_id();

		echo json_encode(array("status" => $success, "id" => $insertedId));
	}
	
}
