<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationMsgController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('NotificationMsgModel','model');
	}

	public function index()
	{
		$this->load->view('notification_msg');
	}
	
	public function sent()
	{
		$this->load->view('notification_msg_list');
	}

	public function createNotificationMsg(){
		$dt = new DateTime();
		$data = array(
			'category' => $this->input->post('subject'),
			'created_date' => $dt->format('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('loggedInUser')['id'],
			'description' => $this->input->post('description'),				
		);
		
		
		$success = $this->model->insert($data);

		echo json_encode(array("status" => TRUE));
	}

	public function delete($id){
		$success = $this->model->delete($id);

		echo json_encode(array("status" => TRUE));	
	}

	public function list()
	{

		$list = $this->model->get_datatables();
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



			$row[] = $detail->category;
			$row[] = $detail->description;
			$date=date_create($detail->created_date.'');
			$row[] = date_format($date, "M-d-Y");
			
			if($this->session->userdata('loggedInUser')['permission'] == 'admin'){
			$row[] = '<button type="button" onclick="ajax_delete('.$detail->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash"/></button>';
			}
			
			$data[] = $row;
		}

		$output = array(

						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model->count_all(),
						"recordsFiltered" => $this->model->count_filtered(),
						"data" => $data,
				);


		//output to json format
		echo json_encode($output);
	}
}
