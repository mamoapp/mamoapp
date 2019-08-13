<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseDetailController extends CI_Controller {
	private $parentPurchase;
	private $loggedInUserInfo;
	
	public function __construct()
	{
		parent::__construct();
		$parentId = $this->uri->segment(2);
		
		$this->load->model('PurchaseModel','purchase_model');
		$this->parentPurchase = $this->purchase_model->getById($parentId);

		$this->load->model('UserModel','user_model');
		$this->loggedInUserInfo = $this->user_model->getById($this->session->userdata('loggedInUser')['id']);

		$this->load->model('PurchaseDetailModel','model');


	}

	public function index()
	{
		$data['parentPurchase'] =  $this->parentPurchase;
		$data['totalAmount'] = 0.0;
		
		

		$burgerMenus = $this->model->fetchProductByType('burger');
		$data['burgerMenus'] = $burgerMenus;

		$friesMenus = $this->model->fetchProductByType('fries');
		$data['friesMenus'] = $friesMenus;

		$drinksMenus = $this->model->fetchProductByType('drinks');
		$data['drinksMenus'] = $drinksMenus;
		
        

		$this->load->helper('url');
		$this->load->view('purchase_detail', $data);
	}

	public function addOrder($productId)
	{
		$dt = new DateTime();
		$data = array(
			'purchase_id' => $this->input->post('purchase_id'),
			'product_id' => $productId,
			'created_date' => $dt->format('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('loggedInUser')['id'],
			'qty' => $this->input->post('qty'.$productId) ,				
		);

		$success = $this->model->addOrder($data);

		$this->computeTotalAmount($data['purchase_id']);
		

		echo json_encode(array("status" => TRUE));
	}

	private function computeTotalAmount($parentId){
		$totalAmount = $this->model->fetchTotalAmount($parentId)->totalAmount;
		$purchase = array('total_amount' => $totalAmount);
		return $this->purchase_model->update(array('id' => $parentId), $purchase);

	}

	public function cancelOrder($id)
	{
		$parentId = $this->model->fetchParentId($id);

		$this->model->delete_by_id($id);
		$success = $this->computeTotalAmount($parentId);

		echo json_encode(array("status" => $success > 0));
	}

	public function doneCheckout($parentId)
	{
		
		$dt = new DateTime();
		$data = array(
			'purchase_id' => $parentId,
			'invoice_number' => rand(100000,999999),
			'invoice_date' => $dt->format('Y-m-d H:i:s'),
			'cash_received' => $this->input->post('cash_received'),
		);

		$invoiceId = $this->model->doneCheckout($data);

		echo json_encode(array("status" => TRUE, "invoiceId" => $invoiceId));
	}


	public function list($parent_id)
	{
		$this->load->helper('url');

		$list = $this->model->get_datatables($parent_id);
		$data = array();
		$no = $_POST['start'];

		$totalAmount = 0.0;
		foreach ($list as $detail) {
			$no++;
			$row = array();
			/*
			$row[] = $detail->qty;
			$row[] = $detail->product_code.' '.$detail->product_name;
			$row[] = $detail->amount;
			$row[] = '<button type="button" onclick="cancelOrder('.$detail->id.')" class="btn btn-warning btn-xs">Cancel</button>';
			*/

			$txt = '<strong>';
			$txt = $txt.$detail->qty.'x';
			$txt = $txt.'&emsp;'.$detail->product_code.' '.$detail->product_name;
			$txt = $txt.'&emsp;'.number_format((float) $detail->amount, 2, '.', '');;
			$txt = $txt.'&emsp; <button type="button" onclick="cancelOrder('.$detail->id.')" class="btn btn-warning btn-xs " style="float:right;"><span class="fa fa-times" /> Cancel</button> ' ;
			$txt = $txt.'</strong>';


			$row[] = $txt;

			
			$totalAmount = $totalAmount + $detail->amount;
			$data[] = $row;
		}

		$output = array(

						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model->count_all_by_parent($parent_id),
						"recordsFiltered" => $this->model->count_filtered($parent_id),
						"data" => $data,
				);

		$this->computeTotalAmount($parent_id);		

		//output to json format
		echo json_encode($output);
	}
}
