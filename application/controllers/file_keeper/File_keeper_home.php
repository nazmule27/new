<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_keeper_home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("file_keeper/File_keeper_model", "File_keeper_model");
		if((($this->session->userdata('role'))!=='Admin')&&(($this->session->userdata('role'))!=='Officer')) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}
	}
	public function index()
	{
		$data['files'] = $this->File_keeper_model->getFiles();
		$this->load->view('file_keeper/file_list', $data);
	}
	public function save_file() {
		$config['upload_path'] = 'assets/docs/file_keeper/';
		$config['allowed_types'] = 'pdf|doc|docx|jpg';
		$config['file_name'] = $this->input->post('file_serial').'-'.$_FILES["scan_doc"]["name"];
		$this->load->library('upload', $config);
		$meeting_doc = $_FILES["scan_doc"]["name"];
		$track_no= $this->input->post('file_serial');
		$status = $this->File_keeper_model->validateTrackNo($track_no);
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		if(empty($status)) {
			if($meeting_doc){
				if (!$this->upload->do_upload('scan_doc'))
				{
					$upload_error = array('error' => $this->upload->display_errors(), 'file_type'=>$this->File_keeper_model->getFileType(), 'destination'=>$this->File_keeper_model->getDestination());
					$this->load->view('file_keeper/file_save', $upload_error);
				}
				else
				{
					$upload_data = $this->upload->data();
					$data = array(
						'track_no' => $track_no,
						'file_name' => $upload_data['file_name'],
						'reference_no' => $this->input->post('reference_no'),
						'destination' => $this->input->post('file_destination'),
						'created_by' => $username,
					);
					$this->File_keeper_model->saveFile($data);
					$data['file_type'] = $this->File_keeper_model->getFileType();
					$data['destination'] = $this->File_keeper_model->getDestination();
					$data['success_msg'] = '<div class="alert alert-success text-center">Your file track saved with document successfully! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
					$this->load->view('file_keeper/file_save', $data);
				}
			}
			else {
				$data = array(
					'track_no' => $track_no,
					'reference_no' => $this->input->post('reference_no'),
					'destination' => $this->input->post('file_destination'),
					'created_by' => $username,
				);
				$this->File_keeper_model->saveFile($data);
				$data['file_type'] = $this->File_keeper_model->getFileType();
				$data['destination'] = $this->File_keeper_model->getDestination();
				$data['success_msg'] = '<div class="alert alert-success text-center">Your file track saved <b>without</b> document successfully! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
				$this->load->view('file_keeper/file_save', $data);
			}
		}
		else {
			$data['file_type'] = $this->File_keeper_model->getFileType();
			$data['destination'] = $this->File_keeper_model->getDestination();
			$data['success_msg'] = '<div class="alert alert-danger text-center">Sorry, Your file track no already exist. Please try again! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('file_keeper/file_save', $data);
		}

	}
	public function add_file()
	{
		$data['file_type'] = $this->File_keeper_model->getFileType();
		$data['destination'] = $this->File_keeper_model->getDestination();
		$this->load->view('file_keeper/file_save', $data);
	}
	public function add_type()
	{
		$this->load->view('file_keeper/add_type');
	}
	public function save_type()
	{
		$status = $this->File_keeper_model->validateType($this->input->post('file_type'));
		if(empty($status)) {
			$data = array(
				'type_name' => $this->input->post('file_type'),
			);
			$this->File_keeper_model->saveType($data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Type successfully added! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('file_keeper/add_type', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-danger text-center">Sorry, this type already exist. Please try another one! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('file_keeper/add_type', $data);
		}
	}
	public function add_destination()
	{
		$this->load->view('file_keeper/add_destination');
	}
	public function save_destination()
	{
		$status = $this->File_keeper_model->validateDestination($this->input->post('destination_name'));
		if(empty($status)) {
			$data = array(
				'destination_name' => $this->input->post('destination_name'),
			);
			$this->File_keeper_model->saveDestination($data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Destination successfully added! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('file_keeper/add_destination', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-danger text-center">Sorry, this destination already exist. Please try another one! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('file_keeper/add_destination', $data);
		}
	}
	public function get_serial()
	{
		$type=$this->input->post('type');
		$getAnswer=$this->File_keeper_model->getSerial($type);
		echo json_encode($getAnswer);

	}

}
