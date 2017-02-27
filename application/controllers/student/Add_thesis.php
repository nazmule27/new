<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_thesis extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("student/Add_thesis_model", "Add_thesis_model");
		/*if((($this->session->userdata('role'))!=='Admin')&&(($this->session->userdata('role'))!=='Officer')&&(($this->session->userdata('role'))!=='Student')) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}*/
	}
	public function index()
	{
		$data['faculty'] = $this->Add_thesis_model->getFaculty();
		$this->load->view('student/add_thesis', $data);
	}
	public function save_thesis() {
		$submitted_by='';
		$partner1='';
		$partner2='';
		$par1='';
		$par2='';
		$submitted_by_val=$this->input->post('partner1');
		$partner1_val=$this->input->post('partner1');
		$partner2_val=$this->input->post('partner1');
		if(isset($submitted_by_val)) {
			$submitted_by=$this->input->post('submitted_by');
		}
		if(isset($partner1_val)) {
			$partner1='-'.$this->input->post('partner1');
			$par1=', '.$this->input->post('partner1');
		}
		if(isset($partner2_val)) {
			$partner2='-'.$this->input->post('partner2');
			$par2=', '.$this->input->post('partner2');
		}
		$config['upload_path'] = 'assets/docs/student_thesis/';
		$config['allowed_types'] = 'pdf|doc|docx';
		$file_rename=$submitted_by.$partner1.$partner2;
		$students=$submitted_by.$par1.$par2;
		$config['file_name'] = $file_rename;
		$this->load->library('upload', $config);
		$meeting_doc = $_FILES["scan_doc"]["name"];
		$status = $this->Add_thesis_model->validateThesis($submitted_by);
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		if(empty($status)) {
			if($meeting_doc){
				if (!$this->upload->do_upload('scan_doc'))
				{
					$upload_error = array('error' => $this->upload->display_errors(), 'faculty'=>$this->Add_thesis_model->getFaculty());
					$this->load->view('student/add_thesis', $upload_error);
				}
				else
				{
					$upload_data = $this->upload->data();
					$data = array(
						'file_name' => $upload_data['file_name'],
						'thesis_title' => $this->input->post('thesis_title'),
						'thesis_advisor' => $this->input->post('thesis_advisor'),
						'thesis_date' => $this->input->post('thesis_date'),
						'thesis_abs' => $this->input->post('abstract'),
						'thesis_students' => $students,
					);
					$this->Add_thesis_model->saveThesis($data);
					$data['faculty'] = $this->Add_thesis_model->getFaculty();
					$data['success_msg'] = '<div class="alert alert-success text-center">Your thesis saved with document successfully! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
					$this->load->view('student/add_thesis', $data);
				}
			}
			else {
				$data = array(
					'thesis_title' => $this->input->post('thesis_title'),
					'thesis_advisor' => $this->input->post('thesis_advisor'),
					'thesis_date' => $this->input->post('thesis_date'),
					'thesis_abs' => $this->input->post('abstract'),
					'thesis_students' => $students,
				);
				$this->Add_thesis_model->saveThesis($data);
				$data['faculty'] = $this->Add_thesis_model->getFaculty();
				$data['success_msg'] = '<div class="alert alert-success text-center">Your thesis saved <b>without</b> document successfully! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
				$this->load->view('student/add_thesis', $data);
			}
		}
		else {
			$data['faculty'] = $this->Add_thesis_model->getFaculty();
			$data['success_msg'] = '<div class="alert alert-danger text-center">Sorry, Your thesis already exist. Please try again! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('student/add_thesis', $data);
		}

	}
	public function get_serial()
	{
		$type=$this->input->post('type');
		$getAnswer=$this->File_keeper_model->getSerial($type);
		echo json_encode($getAnswer);

	}

}
