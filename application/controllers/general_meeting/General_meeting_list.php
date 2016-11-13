<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_meeting_list extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("general_meeting/General_meeting_model", "General_meeting_model");
		if((($this->session->userdata('role'))!=='Admin')&&(($this->session->userdata('role'))!=='Supervisor')) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}
	}
	public function index()
	{
		$data['meetings'] = $this->General_meeting_model->getMeetings();
		$this->load->view('general_meeting/meeting_list', $data);
	}
	public function meeting_detail($id)
	{
		$data['meeting'] = $this->General_meeting_model->getMeetingDetails($id);
		$this->load->view('general_meeting/meeting_detail', $data);
	}

}
