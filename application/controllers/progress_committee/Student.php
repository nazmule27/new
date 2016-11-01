<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("progress_committee/Student_model", "Student_model");
		if((($this->session->userdata('role'))!=='Student')) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}
	}
	public function index()
	{
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		$data['committee'] = $this->Student_model->getSingleCommittee($username);
		$data['committees'] = $this->Student_model->getSingleCommitteeMembers($username);
		$data['meetings'] = $this->Student_model->getMeetings($username);
		$this->load->view('progress_committee/student/home', $data);
	}

	public function document_detail($mid)
	{
		$data['committee'] = $this->Student_model->getSingleMeetingCommittee($mid);
		$data['document'] = $this->Student_model->getDocumentList($mid);
		$this->load->view('progress_committee/student/document_detail',$data);
	}

}
