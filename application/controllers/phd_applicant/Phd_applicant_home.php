<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phd_applicant_home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("phd_applicant/Phd_applicant_model", "Phd_applicant_model");
		if((($this->session->userdata('role'))!=='Admin')&&(($this->session->userdata('role'))!=='Phdapplicant')) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}
	}
	public function index()
	{
		$data['files'] = $this->Phd_applicant_model->getFiles();
		$this->load->view('phd_applicant/file_list', $data);
	}
	public function upload_file()
	{
		$data['file_type'] = $this->Phd_applicant_model->getFileType();
		$this->load->view('phd_applicant/file_upload', $data);
	}
	public function save_file() {
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		$config['upload_path'] = 'assets/docs/phd_applicant/';
		$config['overwrite'] = TRUE;
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['file_name'] = $username.'-'.$this->input->post('file_type');
		$this->load->library('upload', $config);
		$file_type= $this->input->post('file_type');
		$status = $this->Phd_applicant_model->validateFileType($file_type, $username);
		if(empty($status)) {
			if (!$this->upload->do_upload('scan_doc'))
			{
				$upload_error = array('error' => $this->upload->display_errors(), 'file_type'=>$this->Phd_applicant_model->getFileType());
				$this->load->view('phd_applicant/file_upload', $upload_error);
			}
			else
			{
				$upload_data = $this->upload->data();
				$data = array(
					'file_type' => $this->input->post('file_type'),
					'file_name' => $upload_data['file_name'],
					'created_by' => $username,
				);
				$this->Phd_applicant_model->saveFile($data);
				$data['file_type'] = $this->Phd_applicant_model->getFileType();
				$data['success_msg'] = '<div class="alert alert-success text-center">Your file saved with document successfully! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
				$this->load->view('phd_applicant/file_upload', $data);
			}
		}
		else {
			if (!$this->upload->do_upload('scan_doc'))
			{
				$upload_error = array('error' => $this->upload->display_errors(), 'file_type'=>$this->Phd_applicant_model->getFileType());
				$this->load->view('phd_applicant/file_upload', $upload_error);
			}
			else
			{
				$upload_data = $this->upload->data();
				$data = array(
					'file_type' => $this->input->post('file_type'),
					'file_name' => $upload_data['file_name'],
					'created_by' => $username,
					'updated_at' => date('Y-m-d H:i:s'),
				);
				$this->Phd_applicant_model->updateFile($this->input->post('file_type'), $username, $data);
				$data['file_type'] = $this->Phd_applicant_model->getFileType();
				$data['success_msg'] = '<div class="alert alert-success text-center">Your file <b>updated</b> successfully! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
				$this->load->view('phd_applicant/file_upload', $data);
			}
		}
	}

}
